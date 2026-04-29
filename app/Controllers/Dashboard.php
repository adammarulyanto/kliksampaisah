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

        // ── Total undangan milik user
        $totalUndangan = $this->db->table('undangan')
            ->where('user_id', $userId)
            ->countAllResults();

        // ── Total tamu, RSVP, views dari semua undangan user
        $statsRow = $this->db->query("
            SELECT 
                COUNT(g.id)                  AS total_tamu,
                COALESCE(SUM(g.rsvp), 0)     AS total_rsvp,
                COUNT(g.viewed_date)         AS total_views
            FROM undangan u
            LEFT JOIN guest g ON g.undangan_id = u.id
            WHERE u.user_id = ?
        ", [$userId])->getRow();

        // ── 3 undangan terbaru dengan event utama
        $undanganList = $this->db->query("
            SELECT 
                u.id,
                u.url_name,
                u.nickname_men,
                u.nickname_women,
                t.template_name,
                e.event_date,
                e.event_name,
                COUNT(g.id)              AS total_tamu,
                COALESCE(SUM(g.rsvp), 0) AS total_rsvp
            FROM undangan u
            LEFT JOIN events e   ON e.undangan_id = u.id AND e.main_event = 1
            LEFT JOIN guest g    ON g.undangan_id = u.id
            LEFT JOIN template t ON t.id = u.template_id
            WHERE u.user_id = ?
            GROUP BY u.id, u.url_name, u.nickname_men, u.nickname_women,
                    t.template_name, e.event_date, e.event_name
            ORDER BY u.id DESC
            LIMIT 3
        ", [$userId])->getResult();

        // ── Aktivitas terbaru (10 guest terakhir)
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

    public function buat_undangan()
    {
        $templates = $this->templateModel->findAll();

        $data = [
            'title'            => 'Buat Undangan',
            'user'             => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
            'templates'        => $templates,
            'current_template' => $templates[0] ?? null
        ];

        return view('dashboard/buat_undangan.php', $data);
    }

    public function save_undangan()
    {
        // ── VALIDASI ─────────────────────────────────────────────
        $validation = \Config\Services::validation();
        $validation->setRules([
            'template_id' => 'required',
            'url_name'    => 'required|min_length[3]|regex_match[/^[a-z0-9_-]+$/]',
            'groom_name'  => 'required',
            'bride_name'  => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $validation->getErrors()
            ]);
        }

        // ── AMBIL SEMUA INPUT ────────────────────────────────────
        $template_id    = $this->request->getPost('template_id');
        $url_name       = $this->request->getPost('url_name');
        $judul_undangan = $this->request->getPost('judul_undangan');
        $keterangan     = $this->request->getPost('keterangan');
        $groom_name     = $this->request->getPost('groom_name');
        $groom_nickname = $this->request->getPost('groom_nickname');
        $bride_name     = $this->request->getPost('bride_name');
        $bride_nickname = $this->request->getPost('bride_nickname');
        $groom_father   = $this->request->getPost('groom_father');
        $bride_father   = $this->request->getPost('bride_father');
        $groom_mother   = $this->request->getPost('groom_mother');
        $bride_mother   = $this->request->getPost('bride_mother');
        $quote_text     = $this->request->getPost('quote_text');
        $love_story     = $this->request->getPost('love_story');
        $music_choice   = $this->request->getPost('music_choice');
        $acaraRaw       = $this->request->getPost('acara') ?? [];
        $mainEventIndex = (int) $this->request->getPost('main_event');

        // ── AMBIL GALLERY DARI $_FILES LANGSUNG ──────────────────
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
            'user_id'        => session()->get('user_id') ?? null,
        ]);

        $undangan_id = $this->db->insertID();

        // 2. INSERT events (per acara)
        foreach ($acaraRaw as $i => $item) {
            $this->db->table('events')->insert([
                'undangan_id' => $undangan_id,
                'event_name'  => $item['nama']    ?? null,
                'event_date'  => $item['tanggal'] ?? null,
                'start_at'    => $item['mulai']   ?? null,
                'end_at'      => $item['selesai'] ?? null,
                'location'    => $item['tempat']  ?? null,
                'main_event'  => ($i === $mainEventIndex) ? 1 : 0,  // ← dari radio
            ]);

            $event_id = $this->db->insertID();

            $this->insertParams($undangan_id, [
                "acara_{$i}_hari"     => $item['hari']   ?? null,
                "acara_{$i}_alamat"   => $item['alamat'] ?? null,
                "acara_{$i}_maps"     => $item['maps']   ?? null,
                "acara_{$i}_event_id" => $event_id,
            ]);
        }

        // 3. INSERT undangan_param
        $this->insertParams($undangan_id, [
            'judul_undangan' => $judul_undangan,
            'keterangan'     => $keterangan,
            'groom_father'   => $groom_father,
            'bride_father'   => $bride_father,
            'groom_mother'   => $groom_mother,
            'bride_mother'   => $bride_mother,
            'quote_text'     => $quote_text,
            'love_story'     => $love_story,
            'music_choice'   => $music_choice,
        ]);

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
        $data = [
            'title' => 'Template',
            'user'  => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ]
        ];
        return view('dashboard/template.php', $data);
    }

    function format_rupiah($angka)
    {
        return "Rp " . number_format($angka, 0, ',', '.');
    }
}