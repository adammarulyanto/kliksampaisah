<?php

namespace App\Controllers;

use App\Models\TemplateModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/login')->send();
            exit();
        }

        $this->templateModel = new TemplateModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $totalUndangan = $this->db->table('undangan')
            ->where('user_id', $userId)
            ->countAllResults();

        $statsRow = $this->db->query("
            SELECT 
                COUNT(g.id)                  AS total_tamu,
                COALESCE(SUM(g.rsvp), 0)     AS total_rsvp,
                COUNT(g.viewed_date)         AS total_views
            FROM undangan u
            LEFT JOIN guest g ON g.undangan_id = u.id
            WHERE u.user_id = ?
        ", [$userId])->getRow();

        $undanganList = $this->db->query("
            SELECT 
                u.id,
                u.url_name,
                u.nickname_men,
                u.nickname_women,
                t.template_name,
                e.event_date,
                e.event_name,
                t.cover,
                COUNT(g.id)              AS total_tamu,
                COALESCE(SUM(g.rsvp), 0) AS total_rsvp
            FROM undangan u
            LEFT JOIN events e   ON e.undangan_id = u.id AND e.main_event = 1
            LEFT JOIN guest g    ON g.undangan_id = u.id
            LEFT JOIN template t ON t.id = u.template_id
            WHERE u.user_id = ?
            GROUP BY u.id, u.url_name, u.nickname_men, u.nickname_women,
                    t.template_name, e.event_date, e.event_name, t.cover
            ORDER BY u.id DESC
            LIMIT 3
        ", [$userId])->getResult();

        $recentActivity = $this->db->query("
            SELECT
                g.guest_name,
                g.rsvp,
                g.viewed_date,
                u.nickname_men,
                u.nickname_women,
                u.url_name
            FROM guest g
            JOIN undangan u ON u.id = g.undangan_id
            WHERE u.user_id = ?
            ORDER BY g.viewed_date DESC NULLS LAST
            LIMIT 10
        ", [$userId])->getResult();

        $data = [
            'title'           => 'Dashboard',
            'user'            => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar'),
            ],
            'total_undangan'  => $totalUndangan,
            'total_tamu'      => $statsRow->total_tamu   ?? 0,
            'total_rsvp'      => $statsRow->total_rsvp   ?? 0,
            'total_views'     => $statsRow->total_views  ?? 0,
            'undangan_list'   => $undanganList,
            'recent_activity' => $recentActivity,
        ];

        return view('dashboard/dashboard.php', $data);
    }

    public function undangan_saya()
    {
        $db     = \Config\Database::connect();
        $userId = session()->get('user_id');

        $query = $db->query("
            SELECT 
                u.id, u.url_name, t.template_name,
                u.nickname_men, u.nickname_women,
                e.event_name, e.event_date, e.start_at, e.end_at, e.location,
                COUNT(g.id) as tamu,
                COUNT(g.viewed_date) as viewed,
                COALESCE(SUM(g.rsvp), 0) as rsvp,
                e.event_date - current_date as days_left
            FROM undangan u
            LEFT JOIN events e   ON e.undangan_id = u.id AND e.main_event = 1
            LEFT JOIN guest g    ON g.undangan_id = u.id
            LEFT JOIN template t ON t.id = u.template_id
            WHERE u.user_id = ?
            GROUP BY u.id, u.url_name, t.template_name,
                     u.nickname_men, u.nickname_women,
                     e.event_name, e.event_date, e.start_at, e.end_at, e.location
        ", [$userId]);

        $data = [
            'title'        => 'Undangan Saya',
            'user'         => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
            'wedding_data' => $query->getResult()
        ];

        return view('dashboard/undangan_saya.php', $data);
    }

    // ════════════════════════════════════════════════════════════════
    //  BUAT UNDANGAN
    //  Perubahan: tambah $formSections dari tabel form_template,
    //  di-pass ke view sebagai JSON agar JS wizard bisa rebuild
    //  pages secara dinamis sesuai template yang dipilih user.
    // ════════════════════════════════════════════════════════════════
    public function buat_undangan()
    {
        $user_id = session()->get('user_id');

        $templates = $this->templateModel->getOwnedButUnusedTemplates($user_id);

        // ── Ambil semua form_template, group by template_id → section ──
        // Struktur hasil: [ template_id => [ 'SectionName' => [ ['form_name'=>..., 'form_html'=>...], ... ], ... ], ... ]
        $formSections = $this->getFormSectionsGrouped();

        $data = [
            'title'            => 'Buat Undangan',
            'user'             => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
            'templates'        => $templates,
            'current_template' => $templates[0] ?? null,

            // ← BARU: dikirim ke view, di-embed ke window.DB_FORM_SECTIONS
            'formSections'     => $formSections,
        ];

        return view('dashboard/buat_undangan.php', $data);
    }

    // ════════════════════════════════════════════════════════════════
    //  SAVE UNDANGAN
    //  Perubahan:
    //  1. Ambil field custom dari form_template berdasarkan template_id
    //     yang dipilih (yang bukan field standar hardcoded).
    //  2. Field standar tetap di-save seperti biasa.
    //  3. Field custom (name berasal dari form_html input[name]) di-save
    //     ke undangan_param dengan key = name attribute-nya.
    // ════════════════════════════════════════════════════════════════
    public function save_undangan()
    {
        // ── VALIDASI ─────────────────────────────────────────────
        $validation = \Config\Services::validation();
        $validation->setRules([
            'template_id' => 'required',
            'url_name'    => 'required|min_length[3]|regex_match[/^[a-z0-9_-]+$/]',
        ]);

        $postData = $this->request->getPost();

        if (isset($postData['groom_name'])) {
            $validation->setRule('groom_name', 'Nama Pengantin Pria', 'required');
        }
        if (isset($postData['bride_name'])) {
            $validation->setRule('bride_name', 'Nama Pengantin Wanita', 'required');
        }

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $validation->getErrors()
            ]);
        }

        // ── INPUT LANGSUNG KE TABEL undangan ─────────────────────
        $template_id           = $postData['template_id']            ?? null;
        $ownership_template_id = $postData['ownership_template_id']  ?? null;
        $url_name              = $postData['url_name']               ?? '';
        $groom_name            = $postData['groom_name']             ?? '';
        $groom_nickname        = $postData['groom_nickname']         ?? '';
        $bride_name            = $postData['bride_name']             ?? '';
        $bride_nickname        = $postData['bride_nickname']         ?? '';
        $acaraRaw              = $postData['acara']                  ?? [];
        $mainEventIndex        = (int) ($postData['main_event']      ?? 0);
        $userId                = session()->get('user_id')           ?? null;

        // ── ROUTING FIELD → undangan_param ───────────────────────
        //
        //  Logika baru: FLIP dari whitelist ke skiplist.
        //  - $skipKeys     : field yang TIDAK disimpan ke mana pun
        //                    (metadata form / sudah diproses manual)
        //  - $directFields : field yang sudah masuk tabel `undangan`
        //                    langsung via INSERT di bawah
        //  - Semua sisa POST key → otomatis masuk undangan_param
        //
        //  Tidak perlu lagi $standardParamKeys / $customParamKeys.
        //  Field custom dari form_template akan tersimpan otomatis
        //  tanpa perlu mengubah kode controller.

        $skipKeys = [
            'template_id',
            'ownership_template_id',
            'main_event',
            // 'acara' dan 'gallery' adalah array, sudah difilter via is_array()
        ];

        $directFields = [
            'url_name',
            'groom_name',
            'groom_nickname',
            'bride_name',
            'bride_nickname',
        ];

        // ── AMBIL GALLERY ─────────────────────────────────────────
        $galleryFiles = [];
        if (!empty($_FILES['gallery']['name'][0])) {
            $count = count($_FILES['gallery']['name']);
            for ($i = 0; $i < $count; $i++) {
                if ($_FILES['gallery']['error'][$i] === UPLOAD_ERR_OK) {
                    $galleryFiles[] = [
                        'name'     => $_FILES['gallery']['name'][$i],
                        'tmp_name' => $_FILES['gallery']['tmp_name'][$i],
                        'size'     => $_FILES['gallery']['size'][$i],
                        'type'     => $_FILES['gallery']['type'][$i],
                    ];
                }
            }
        }

        // ── CEK URL DUPLIKAT ─────────────────────────────────────
        $exists = $this->db->table('undangan')
            ->where('url_name', $url_name)
            ->get()->getRow();

        if ($exists) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => ['url_name' => 'URL sudah digunakan.']
            ]);
        }

        // ── TRANSACTION ──────────────────────────────────────────
        $this->db->transStart();

        // 1. INSERT undangan
        $this->db->table('undangan')->insert([
            'template_id'    => $template_id,
            'url_name'       => $url_name,
            'fullname_men'   => $groom_name,
            'nickname_men'   => $groom_nickname,
            'fullname_women' => $bride_name,
            'nickname_women' => $bride_nickname,
            'user_id'        => $userId,
        ]);

        $undangan_id = $this->db->insertID();

        // 2. INSERT events
        foreach ($acaraRaw as $i => $item) {
            $this->db->table('events')->insert([
                'undangan_id' => $undangan_id,
                'event_name'  => $item['nama']    ?? null,
                'event_date'  => $item['tanggal'] ?? null,
                'start_at'    => $item['mulai']   ?? null,
                'end_at'      => $item['selesai'] ?? null,
                'location'    => $item['tempat']  ?? null,
                'main_event'  => ($i === $mainEventIndex) ? 1 : 0,
            ]);

            $event_id = $this->db->insertID();

            $this->insertParams($undangan_id, [
                "acara_{$i}_hari"     => $item['hari']   ?? null,
                "acara_{$i}_alamat"   => $item['alamat'] ?? null,
                "acara_{$i}_maps"     => $item['maps']   ?? null,
                "acara_{$i}_event_id" => $event_id,
            ]);
        }

        // 3. INSERT undangan_param — semua field sisa POST otomatis
        $paramsToSave = [];
        foreach ($postData as $key => $value) {
            // Field metadata / sudah diproses manual
            if (in_array($key, $skipKeys, true))     continue;
            // Field yang sudah masuk tabel undangan langsung
            if (in_array($key, $directFields, true)) continue;
            // Array (acara[0][nama], gallery[], dll) — sudah ditangani terpisah
            if (is_array($value))                    continue;
            // Nilai kosong tidak perlu disimpan
            if ($value === null || $value === '')     continue;

            $paramsToSave[$key] = $value;
        }

        $this->insertParams($undangan_id, $paramsToSave);

        // 4. GALLERY UPLOAD
        $templateRow = $this->db->table('template')
            ->where('id', $template_id)
            ->get()->getRow();
        $maxPhoto = $templateRow->max_photo ?? 10;

        if (!empty($galleryFiles)) {
            $uploadPath = FCPATH . 'assets/gallery/' . $undangan_id . '/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $count = 0;
            foreach ($galleryFiles as $file) {
                if ($count >= $maxPhoto) break;

                $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $newName = uniqid('gallery_') . '.' . $ext;

                move_uploaded_file($file['tmp_name'], $uploadPath . $newName);

                $this->insertParams($undangan_id, [
                    'gallery_' . $count => 'assets/gallery/' . $undangan_id . '/' . $newName,
                ]);

                $count++;
            }
        }

        // ── Gift: delete-insert ────────────────────────────────
        $this->db->table('undangan_param')
            ->where('undangan_id', $undangan_id)   // was $id
            ->where('param_name LIKE', 'gift_%')
            ->delete();

        if (isset($postData['gift']) && is_array($postData['gift'])) {  // was $input['gift']
            foreach ($postData['gift'] as $i => $gift) {
                $type = $gift['type'] ?? 'rekening';
                $this->db->table('undangan_param')->insert([
                    'undangan_id' => $undangan_id,  // was $id
                    'param_name'  => "gift_{$i}_type",
                    'param_value' => $type,
                ]);
                if ($type === 'rekening') {
                    foreach (['rekening_nama', 'rekening_bank', 'rekening_nomor'] as $f) {
                        if (!empty($gift[$f])) {
                            $this->db->table('undangan_param')->insert([
                                'undangan_id' => $undangan_id,  // was $id
                                'param_name'  => "gift_{$i}_{$f}",
                                'param_value' => $gift[$f],
                            ]);
                        }
                    }
                } else {
                    foreach (['alamat_nama', 'alamat_detail'] as $f) {
                        if (!empty($gift[$f])) {
                            $this->db->table('undangan_param')->insert([
                                'undangan_id' => $undangan_id,  // was $id
                                'param_name'  => "gift_{$i}_{$f}",
                                'param_value' => $gift[$f],
                            ]);
                        }
                    }
                }
            }
        }

        // 5. UPDATE USED TEMPLATE
        $this->db->table('ownership_template')
            ->where([
                'user_id' => $userId,
                'id'      => $ownership_template_id,
            ])
            ->update([
                'undangan_id'  => $undangan_id,
                'last_used_at' => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => ['db' => 'Gagal menyimpan data, silakan coba lagi.']
            ]);
        }

        return redirect()->to(base_url('undangan-saya'))
            ->with('success', 'Undangan berhasil dibuat!');
    }

    /**
     * Ambil semua name attribute dari form_html di form_template
     * untuk template tertentu, exclude standardKeys.
     */
    public function getCustomParamKeysForTemplate(int $templateId, array $standardKeys = []): array
    {
        $rows = $this->db->table('form_template')
            ->where('template_id', $templateId)
            ->get()->getResultArray();

        $keys = [];
        foreach ($rows as $row) {
            $html = $row['form_html'] ?? '';
            preg_match_all('/\bname=["\']([^"\']+)["\']/', $html, $matches);
            foreach ($matches[1] as $nameAttr) {
                if (strpos($nameAttr, '[') !== false) continue;
                if (in_array($nameAttr, $standardKeys, true)) continue;
                $keys[] = $nameAttr;
            }
        }

        return array_unique($keys);
    }

    // ════════════════════════════════════════════════════════════════
    //  HELPER: getFormSectionsGrouped
    //  Query form_template, group by template_id → form_section.
    //  Dipakai oleh buat_undangan() dan edit_undangan() di Undangan.php.
    // ════════════════════════════════════════════════════════════════
    public function getFormSectionsGrouped(): array
    {
        $rows = $this->db->table('form_template')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();

        $grouped = [];
        foreach ($rows as $row) {
            $tid = $row['template_id'];
            $sec = $row['form_section'];
            if (!isset($grouped[$tid])) {
                $grouped[$tid] = [];
            }
            if (!isset($grouped[$tid][$sec])) {
                $grouped[$tid][$sec] = [];
            }
            $grouped[$tid][$sec][] = [
                'form_name' => $row['form_name'],
                'form_html' => $row['form_html'],
            ];
        }

        return $grouped;
    }

    // ── HELPER: batch insert ke undangan_param ───────────────────
    private function insertParams(int $undangan_id, array $params): void
    {
        $rows = [];
        foreach ($params as $name => $value) {
            if ($value === null || $value === '') continue;
            $rows[] = [
                'undangan_id' => $undangan_id,
                'param_name'  => $name,
                'param_value' => $value,
            ];
        }

        if (!empty($rows)) {
            $this->db->table('undangan_param')->insertBatch($rows);
        }
    }

    // ── CEK URL (AJAX) ───────────────────────────────────────────
    public function checkUrl()
    {
        $slug = $this->request->getGet('slug');

        if (!$slug) {
            return $this->response->setJSON([
                'available' => false,
                'message'   => 'URL tidak boleh kosong.'
            ]);
        }

        if (!preg_match('/^[a-z0-9_-]{3,}$/', $slug)) {
            return $this->response->setJSON([
                'available' => false,
                'message'   => 'Format URL tidak valid.'
            ]);
        }

        $exists = $this->db->table('undangan')
            ->where('url_name', $slug)
            ->get()->getRow();

        return $this->response->setJSON([
            'available' => !$exists,
            'message'   => $exists ? 'URL sudah digunakan.' : 'URL tersedia ✓'
        ]);
    }

    public function cek_template()
    {
        $data['templates'] = $this->templateModel->findAll();
        return view('template_selector', $data);
    }

    public function loadTemplate($filename = null)
    {
        if (empty($filename)) return "No template specified";

        $template = $this->templateModel->getTemplateByFilePath($filename);
        if (!$template) return "Template not found in database: " . $filename;

        $viewName = 'templates/' . str_replace('.php', '', $filename);
        $fullPath = APPPATH . 'Views/' . $viewName . '.php';

        if (!file_exists($fullPath)) return "File not found at: " . $fullPath;

        try {
            return view($viewName);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getTemplatesJson()
    {
        $templates = $this->templateModel->getActiveTemplates();
        return $this->response->setJSON($templates);
    }

    public function template()
    {
        $templateModel    = new \App\Models\TemplateModel();
        $globalParamModel = new \App\Models\GlobalParamModel();

        $templates = $templateModel->findAll();

        foreach ($templates as &$template) {
            $featureIds = $this->parsePostgresArray($template['feature']);
            $fitToIds   = $this->parsePostgresArray($template['fit_to']);

            if (!empty($featureIds)) {
                $features = $globalParamModel->getFeaturesByIds($featureIds);
                $template['feature_names'] = array_column($features, 'param_name');
                $template['feature']       = $featureIds;
            } else {
                $template['feature_names'] = [];
                $template['feature']       = [];
            }

            if (!empty($fitToIds)) {
                $fitTo = $globalParamModel->getFitToByIds($fitToIds);
                $template['fit_to_names'] = array_column($fitTo, 'param_name');
                $template['fit_to']       = $fitToIds;
            } else {
                $template['fit_to_names'] = [];
                $template['fit_to']       = [];
            }
        }

        $data = [
            'title'     => 'Template',
            'templates' => $templates,
            'user'      => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
        ];

        return view('dashboard/template.php', $data);
    }

    private function parsePostgresArray($postgresArray): array
    {
        if (empty($postgresArray))    return [];
        if (is_array($postgresArray)) return $postgresArray;

        if (is_string($postgresArray)) {
            $trimmed = trim($postgresArray, '{}');
            if (empty($trimmed)) return [];
            return array_map('intval', explode(',', $trimmed));
        }

        return [];
    }

    public function format_rupiah($angka)
    {
        return "Rp " . number_format($angka, 0, ',', '.');
    }

    private function buildGiftArray(array $params): array
    {
        $gift = [];
        $i = 0;
        while (isset($params["gift_{$i}_type"])) {
            $type = $params["gift_{$i}_type"];
            $item = ['type' => $type];
            if ($type === 'rekening') {
                $item['rekening_nama']  = $params["gift_{$i}_rekening_nama"]  ?? '';
                $item['rekening_bank']  = $params["gift_{$i}_rekening_bank"]  ?? '';
                $item['rekening_nomor'] = $params["gift_{$i}_rekening_nomor"] ?? '';
            } else {
                $item['alamat_nama']   = $params["gift_{$i}_alamat_nama"]   ?? '';
                $item['alamat_detail'] = $params["gift_{$i}_alamat_detail"] ?? '';
            }
            $gift[] = $item;
            $i++;
        }
        return $gift;
    }
}