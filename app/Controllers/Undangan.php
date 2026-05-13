<?php

namespace App\Controllers;

use App\Models\UndanganModel;
use App\Models\TemplateModel;

class Undangan extends BaseController
{
    protected $undanganModel;
    protected $db;
    protected $templateModel;

    public function __construct()
    {
        $this->undanganModel = new UndanganModel();
        $this->templateModel = new TemplateModel();
        $this->db = \Config\Database::connect();
    }

    public function index($urlName = null)
    {
        if ($urlName === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan = $this->undanganModel->getUndanganWithTemplate($urlName);

        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan_id = $undangan['id'];
        $template_id = $undangan['template_id'];

        // ── CEK AKSES ─────────────────────────────────────────────
        $toParam = $this->request->getGet('to');

        if ($toParam !== null) {
            $guest = $this->db->table('guest')
                ->where('undangan_id', $undangan_id)
                ->where('guest_name', $toParam)
                ->get()->getRowArray();

            if (!$guest) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $nama_tamu = $guest['guest_name'];

            if (!empty($nama_tamu)) {
                $this->db->table('guest')
                    ->where('undangan_id', $undangan_id)
                    ->where('guest_name', $nama_tamu)
                    ->update(['viewed_date' => date('Y-m-d H:i:s')]);
            }
        } else {
            $sessionUserId = session()->get('user_id');

            if (!$sessionUserId || $sessionUserId != $undangan['user_id']) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $nama_tamu = '';
        }

        // ── AMBIL SEMUA PARAMS ────────────────────────────────────
        $params = $this->getParamsAsKV($undangan_id);

        // ── AMBIL EVENTS ──────────────────────────────────────────
        $acara = $this->buildAcaraArray($undangan_id, $params);

        // ── AMBIL CUSTOM PARAMS DARI form_template ────────────────
        // Field custom yang didaftarkan admin di form_template untuk
        // template ini akan otomatis tersedia di $data['custom_params']
        // sehingga view template bisa mengaksesnya tanpa perubahan controller.
        $customParams = $this->getCustomParamsForTemplate($template_id, $params);

        // ── GIFT & WISHES (masih hardcoded, sesuai kode asal) ─────
        $wishes = [
            ['nama' => 'Siti Rahmawati',  'kehadiran' => 'hadir',  'ucapan' => 'Semoga menjadi keluarga yang sakinah mawaddah warahmah. Barakallahu lakuma!'],
            ['nama' => 'Budi Santoso',    'kehadiran' => 'hadir',  'ucapan' => 'Selamat menempuh hidup baru! Semoga selalu diberkahi dan dilancarkan rezeki.'],
            ['nama' => 'Anissa Putri',    'kehadiran' => 'tidak',  'ucapan' => 'Maaf tidak bisa hadir, tetapi doa terbaik selalu menyertai perjalanan kalian.'],
            ['nama' => 'Rizky Pratama',   'kehadiran' => 'hadir',  'ucapan' => 'Akhirnya tiba juga hari yang ditunggu-tunggu. Semoga menjadi pasangan yang saling menguatkan.'],
            ['nama' => 'Dewi Kusuma',     'kehadiran' => 'hadir',  'ucapan' => 'Semoga rumah tangga kalian penuh dengan kebahagiaan dan kasih sayang yang abadi.'],
        ];

        $rekening = [
            ['bank' => 'BCA',     'nama' => 'Zahra Aulia',  'nomor' => '1234567890'],
            ['bank' => 'Mandiri', 'nama' => 'Ahmad Fauzan', 'nomor' => '0987654321'],
        ];

        $alamat_rumah = [
            'nama'   => 'Rumah Mempelai Wanita',
            'alamat' => 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310',
            'maps'   => 'https://maps.google.com/?q=-6.186486,106.834091',
        ];

        // ── GALLERY ───────────────────────────────────────────────
        $gallery = $this->buildGalleryArray($params);

        // ── SUSUN $data ───────────────────────────────────────────
        $data = [
            'undangan'       => $undangan,
            'nama_tamu'      => $nama_tamu,

            'template_id'    => $template_id,

            // Data undangan
            'url_name'       => $undangan['url_name'],
            'judul_undangan' => $params['judul_undangan'] ?? null,
            'keterangan'     => $params['keterangan']     ?? null,

            // Pasangan
            'groom_name'     => $undangan['fullname_men'],
            'groom_nickname' => $undangan['nickname_men'],
            'bride_name'     => $undangan['fullname_women'],
            'bride_nickname' => $undangan['nickname_women'],

            // Orang tua
            'groom_father'   => $params['groom_father'] ?? null,
            'bride_father'   => $params['bride_father'] ?? null,
            'groom_mother'   => $params['groom_mother'] ?? null,
            'bride_mother'   => $params['bride_mother'] ?? null,

            // Cerita & ucapan
            'quote_text'            => $params['quote_text'] ?? null,
            'love_story'            => $params['love_story'] ?? null,
            'msg_to_guest_bot'      => $params['msg_to_guest_bot'] ?? null,

            // Musik
            'music_choice'   => $params['music_choice'] ?? null,

            // Acara
            'acara'          => $acara,
            'acara_utama'    => array_values(array_filter($acara, fn($a) => $a['main_event'] == 1))[0] ?? null,

            // RSVP, gift
            'wishes'         => $wishes,
            'rekening'       => $rekening,
            'alamat_rumah'   => $alamat_rumah,

            // Gallery
            'gallery'        => $gallery,

            // ← BARU: semua field custom dari form_template tersedia flat
            // di $data, view bisa langsung pakai $custom_param_name
            // Contoh: form_html punya name="foto_prewedding" →
            //         view bisa echo $foto_prewedding
            'custom_params'  => $customParams,
        ];

        // Merge custom params ke $data supaya view bisa akses langsung
        // sebagai variabel (tanpa harus $custom_params['key'])
        $data = array_merge($data, $customParams);

        $filename = $undangan['file_path'];
        $viewName = 'templates/' . str_replace('.php', '', $filename);

        try {
            return view($viewName, $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Template {$filename} tidak ditemukan"
            );
        }
    }

    public function edit_undangan($urlName = null)
    {
        if ($urlName === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan = $this->undanganModel->getUndanganWithTemplate($urlName);

        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan_id = $undangan['id'];
        $template_id = $undangan['template_id'];

        // ── AMBIL PARAMS ──────────────────────────────────────────
        $params = $this->getParamsAsKV($undangan_id);

        // ── AMBIL EVENTS ──────────────────────────────────────────
        $eventsRaw = $this->db->table('events')
            ->where('undangan_id', $undangan_id)
            ->orderBy('main_event', 'DESC')
            ->orderBy('event_date', 'ASC')
            ->get()->getResult();

        $acara = [];
        foreach ($eventsRaw as $i => $event) {
            $acara[] = [
                'event_id'   => $event->id,
                'nama'       => $event->event_name,
                'tanggal'    => $event->event_date,
                'mulai'      => $event->start_at,
                'selesai'    => $event->end_at,
                'tempat'     => $event->location,
                'main_event' => $event->main_event,
                'hari'       => $params["acara_{$i}_hari"]   ?? null,
                'alamat'     => $params["acara_{$i}_alamat"] ?? null,
                'maps'       => $params["acara_{$i}_maps"]   ?? null,
            ];
        }

        // ── AMBIL GALLERY ─────────────────────────────────────────
        $gallery = $this->buildGalleryArray($params);
        
        
        $giftJson = json_encode($this->buildGiftArray($params), JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        // ── AMBIL form_template SECTIONS untuk template ini ───────
        // Dipakai view edit agar wizard juga dinamis saat edit
        $dashboardCtrl = new Dashboard();
        $allFormSections = $dashboardCtrl->getFormSectionsGrouped();
        $formSections    = $allFormSections[$template_id] ?? [];

        // ── AMBIL CUSTOM PARAMS ───────────────────────────────────
        $customParams = $this->getCustomParamsForTemplate($template_id, $params);

        $rekening = [
            ['bank' => 'BCA',     'nama' => 'Zahra Aulia',  'nomor' => '1234567890'],
            ['bank' => 'Mandiri', 'nama' => 'Ahmad Fauzan', 'nomor' => '0987654321'],
        ];

        $alamat_rumah = [
            'nama'   => 'Rumah Mempelai Wanita',
            'alamat' => 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310',
            'maps'   => 'https://maps.google.com/?q=-6.186486,106.834091',
        ];

        $templates = $this->templateModel->where('id', $template_id)->findAll();
        $currentTpl = array_values(array_filter($templates, fn($t) => $t['id'] == $template_id));

        $data = [
            'title'            => 'Edit Undangan',
            'existingParams' => $params,
            'user'             => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
            'templates'        => $templates,
            'current_template' => $template_id,

            // Form sections untuk rebuild wizard di halaman edit
            // (sama dengan buat_undangan, tapi hanya untuk template ini)
            'formSections'     => $allFormSections,

            // Data undangan
            'undangan_id'      => $undangan_id,
            'url_name'         => $undangan['url_name'],
            'judul_undangan'   => $params['judul_undangan'] ?? '',
            'keterangan'       => $params['keterangan']     ?? '',

            // Pasangan
            'groom_name'       => $undangan['fullname_men'],
            'groom_nickname'   => $undangan['nickname_men'],
            'bride_name'       => $undangan['fullname_women'],
            'bride_nickname'   => $undangan['nickname_women'],

            // Orang tua
            'groom_father'     => $params['groom_father'] ?? '',
            'groom_mother'     => $params['groom_mother'] ?? '',
            'bride_father'     => $params['bride_father'] ?? '',
            'bride_mother'     => $params['bride_mother'] ?? '',

            // Cerita
            'quote_text'       => $params['quote_text'] ?? '',
            'love_story'       => $params['love_story'] ?? '',

            // Musik
            'music_choice'     => $params['music_choice'] ?? '',

            // Acara & gallery
            'acara'            => $acara,
            'gallery'          => $gallery,

            // Template info
            'template_file'         => $undangan['file_path'] ?? '',
            'current_template_name' => $currentTpl[0]['template_name'] ?? '',
            'current_max_photo'     => $currentTpl[0]['max_photo'] ?? 10,

            // Gift
            'gift'         => $this->buildGiftArray($params),

            // ← BARU: custom params dari form_template (flat & dalam array)
            'custom_params' => $customParams,
        ];

        // Merge custom params flat supaya view edit bisa pre-fill
        $data = array_merge($data, $customParams);

        return view('dashboard/edit_undangan', $data);
    }

    public function update($id = null)
    {
        $input = $this->request->getPost();

        $this->db->transStart();

        try {
            $oldUndangan = $this->undanganModel->find($id);
            if (!$oldUndangan) {
                throw new \Exception("Undangan tidak ditemukan");
            }

            $template_id = $input['template_id'] ?? $oldUndangan['template_id'];

            // ── Update tabel undangan ─────────────────────────────
            $undanganData = [];
            if (isset($input['template_id']))    $undanganData['template_id']    = $input['template_id'];
            if (isset($input['groom_name']))     $undanganData['fullname_men']   = $input['groom_name'];
            if (isset($input['groom_nickname'])) $undanganData['nickname_men']   = $input['groom_nickname'];
            if (isset($input['bride_name']))     $undanganData['fullname_women'] = $input['bride_name'];
            if (isset($input['bride_nickname'])) $undanganData['nickname_women'] = $input['bride_nickname'];
            if (isset($input['url_name']))       $undanganData['url_name']       = $input['url_name'];

            if (!empty($undanganData)) {
                $this->undanganModel->update($id, $undanganData);
            }

            // ── Tentukan semua param key yang perlu di-upsert ──────
            $standardParamKeys = [
                'judul_undangan', 'keterangan',
                'groom_father', 'groom_mother',
                'bride_father', 'bride_mother',
                'quote_text', 'love_story',
                'music_choice',
            ];

            $dashboardCtrl = new Dashboard();
            $customKeys    = $dashboardCtrl->getCustomParamKeysForTemplate(
                (int) $template_id,
                $standardParamKeys
            );

            $allParamKeys = array_unique(array_merge($standardParamKeys, $customKeys));

            // ── Upsert params (bukan gallery) ──────────────────────
            $paramsToUpsert = [];
            foreach ($allParamKeys as $key) {
                if (isset($input[$key])) {
                    $paramsToUpsert[$key] = $input[$key]; // bisa string kosong → akan di-handle
                }
            }
            $this->upsertParams($id, $paramsToUpsert);

            // ── Upsert events ──────────────────────────────────────
            if (isset($input['acara']) && is_array($input['acara'])) {
                // Ambil event_id existing berurutan (ordered by main_event DESC, event_date ASC)
                $existingEvents = $this->db->table('events')
                    ->where('undangan_id', $id)
                    ->orderBy('main_event', 'DESC')
                    ->orderBy('event_date', 'ASC')
                    ->get()->getResultArray();

                $existingEventIds  = array_column($existingEvents, 'id');
                $submittedAcara    = $input['acara'];

                foreach ($submittedAcara as $i => $acara) {
                    $mainEvent = (isset($input['main_event']) && (int)$input['main_event'] == (int)$i) ? 1 : 0;

                    $eventData = [
                        'undangan_id' => $id,
                        'event_name'  => $acara['nama']    ?? '',
                        'event_date'  => $acara['tanggal'] ?? null,
                        'start_at'    => $acara['mulai']   ?? null,
                        'end_at'      => $acara['selesai'] ?? null,
                        'location'    => $acara['tempat']  ?? '',
                        'main_event'  => $mainEvent,
                    ];

                    if (isset($existingEventIds[$i])) {
                        // Update event existing
                        $this->db->table('events')
                            ->where('id', $existingEventIds[$i])
                            ->update($eventData);

                        $eventId = $existingEventIds[$i];
                    } else {
                        // Insert event baru (user tambah acara)
                        $this->db->table('events')->insert($eventData);
                        $eventId = $this->db->insertID();
                    }

                    // Upsert acara params (hari, alamat, maps)
                    $acaraParams = [];
                    foreach (['hari', 'alamat', 'maps'] as $field) {
                        $acaraParams["acara_{$i}_{$field}"] = $acara[$field] ?? '';
                    }
                    $acaraParams["acara_{$i}_event_id"] = $eventId;
                    $this->upsertParams($id, $acaraParams);
                }

                // Hapus event yang sudah dihapus user (jumlah submit < jumlah existing)
                $countSubmitted = count($submittedAcara);
                $countExisting  = count($existingEventIds);

                if ($countExisting > $countSubmitted) {
                    $idsToDelete = array_slice($existingEventIds, $countSubmitted);
                    $this->db->table('events')
                        ->whereIn('id', $idsToDelete)
                        ->delete();

                    // Hapus juga acara params untuk index yang sudah dihapus
                    for ($i = $countSubmitted; $i < $countExisting; $i++) {
                        $this->db->table('undangan_param')
                            ->where('undangan_id', $id)
                            ->groupStart()
                                ->where('param_name', "acara_{$i}_hari")
                                ->orWhere('param_name', "acara_{$i}_alamat")
                                ->orWhere('param_name', "acara_{$i}_maps")
                                ->orWhere('param_name', "acara_{$i}_event_id")
                            ->groupEnd()
                            ->delete();
                    }
                }
            }

            // ── Gallery: tetap delete-insert karena file management ─
            // (path berubah saat upload baru, existing path bisa berkurang)
            $keptFiles = $input['existing_gallery'] ?? [];
            if (!is_array($keptFiles)) $keptFiles = [];

            $this->db->table('undangan_param')
                ->where('undangan_id', $id)
                ->where('param_name LIKE', 'gallery_%')
                ->delete();

            $galleryIndex = 0;
            foreach ($keptFiles as $filePath) {
                if (!empty($filePath)) {
                    $this->db->table('undangan_param')->insert([
                        'undangan_id' => $id,
                        'param_name'  => "gallery_{$galleryIndex}",
                        'param_value' => $filePath,
                    ]);
                    $galleryIndex++;
                }
            }

            // ── Gift: delete-insert ────────────────────────────────
            $this->db->table('undangan_param')
                ->where('undangan_id', $id)
                ->where('param_name LIKE', 'gift_%')
                ->delete();

            if (isset($input['gift']) && is_array($input['gift'])) {
                foreach ($input['gift'] as $i => $gift) {
                    $type = $gift['type'] ?? 'rekening';
                    $this->db->table('undangan_param')->insert([
                        'undangan_id' => $id,
                        'param_name'  => "gift_{$i}_type",
                        'param_value' => $type,
                    ]);
                    if ($type === 'rekening') {
                        foreach (['rekening_nama', 'rekening_bank', 'rekening_nomor'] as $f) {
                            if (!empty($gift[$f])) {
                                $this->db->table('undangan_param')->insert([
                                    'undangan_id' => $id,
                                    'param_name'  => "gift_{$i}_{$f}",
                                    'param_value' => $gift[$f],
                                ]);
                            }
                        }
                    } else {
                        foreach (['alamat_nama', 'alamat_detail'] as $f) {
                            if (!empty($gift[$f])) {
                                $this->db->table('undangan_param')->insert([
                                    'undangan_id' => $id,
                                    'param_name'  => "gift_{$i}_{$f}",
                                    'param_value' => $gift[$f],
                                ]);
                            }
                        }
                    }
                }
            }

            $uploadedFiles = $this->request->getFiles();
            if (!empty($uploadedFiles['gallery'])) {
                $uploadPath = ROOTPATH . 'public/uploads/gallery/' . $id;
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                foreach ($uploadedFiles['gallery'] as $file) {
                    if ($file instanceof \CodeIgniter\HTTP\Files\UploadedFile
                        && $file->isValid()
                        && !$file->hasMoved()
                    ) {
                        $newName = $file->getRandomName();
                        $file->move($uploadPath, $newName);
                        $this->db->table('undangan_param')->insert([
                            'undangan_id' => $id,
                            'param_name'  => "gallery_{$galleryIndex}",
                            'param_value' => 'uploads/gallery/' . $id . '/' . $newName,
                        ]);
                        $galleryIndex++;
                    }
                }
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                $error = $this->db->error();
                throw new \Exception("DB Error: " . ($error['message'] ?? 'Unknown'));
            }

            return redirect()->to(base_url('dashboard'))
                ->with('success', 'Undangan berhasil diperbarui');

        } catch (\Exception $e) {
            $this->db->transRollback();

            log_message('error', 'Update Error: ' . $e->getMessage());
            log_message('error', 'File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());

            $urlName = $undanganData['url_name'] ?? $oldUndangan['url_name'] ?? '';
            return redirect()->to(base_url('undangan/' . $urlName . '/edit'))
                ->with('error', $e->getMessage());
        }
    }

    public function live_preview($template_id = null)
    {
        if ($template_id === null || !is_numeric($template_id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Template ID tidak valid');
        }

        $template = $this->templateModel->where('id', (int)$template_id)->first();

        if (!$template) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Template tidak ditemukan');
        }

        $filename = $template['file_path'];
        $viewName = 'templates/' . str_replace('.php', '', $filename);

        $data = [
            'template_id'   => $template['id'],
            'template_name' => $filename,
            'is_preview'    => true,
            'preview_data'  => $this->getDemoDataForPreview(),
        ];

        try {
            return view($viewName, $data);
        } catch (\Exception $e) {
            log_message('error', 'Preview error: ' . $e->getMessage());
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Template file {$filename} tidak ditemukan di folder views/templates/"
            );
        }
    }

    // ════════════════════════════════════════════════════════════════
    //  PRIVATE HELPERS
    // ════════════════════════════════════════════════════════════════

    /**
     * Ambil semua undangan_param sebagai key=>value array.
     */
    private function getParamsAsKV(int $undangan_id): array
    {
        $paramsRaw = $this->db->table('undangan_param')
            ->where('undangan_id', $undangan_id)
            ->get()->getResult();

        $params = [];
        foreach ($paramsRaw as $row) {
            $params[$row->param_name] = $row->param_value;
        }

        return $params;
    }

    /**
     * Bangun array $acara dari tabel events + params (hari, alamat, maps).
     */
    private function buildAcaraArray(int $undangan_id, array $params): array
    {
        $eventsRaw = $this->db->table('events')
            ->where('undangan_id', $undangan_id)
            ->orderBy('event_date', 'ASC')
            ->get()->getResult();

        $acara = [];
        foreach ($eventsRaw as $i => $event) {
            $acara[] = [
                'event_id'   => $event->id,
                'nama'       => $event->event_name,
                'tanggal'    => $event->event_date,
                'mulai'      => $event->start_at,
                'selesai'    => $event->end_at,
                'tempat'     => $event->location,
                'main_event' => $event->main_event,
                'hari'       => $params["acara_{$i}_hari"]   ?? null,
                'alamat'     => $params["acara_{$i}_alamat"] ?? null,
                'maps'       => $params["acara_{$i}_maps"]   ?? null,
            ];
        }

        return $acara;
    }

    /**
     * Bangun array gallery dari params (gallery_0, gallery_1, ...).
     */
    private function buildGalleryArray(array $params): array
    {
        $gallery = [];
        $i = 0;
        while (isset($params['gallery_' . $i])) {
            $gallery[] = $params['gallery_' . $i];
            $i++;
        }
        return $gallery;
    }

    /**
     * Ambil custom param values dari $params berdasarkan field
     * yang terdaftar di form_template untuk template_id ini.
     * Kembalikan [ 'param_name' => 'nilai', ... ]
     *
     * Field standar + field tabel undangan tidak dimasukkan
     * supaya tidak overwrite variabel yang sudah ada di $data.
     */
    private function getCustomParamsForTemplate(int $templateId, array $params): array
    {
        $standardKeys = [
            'judul_undangan', 'keterangan',
            'groom_father', 'groom_mother',
            'bride_father', 'bride_mother',
            'quote_text', 'love_story', 'music_choice',
            // Field tabel undangan — sudah ada di $data utama
            'groom_name', 'bride_name', 'groom_nickname', 'bride_nickname',
            'url_name', 'template_id',
        ];

        $rows = $this->db->table('form_template')
            ->where('template_id', $templateId)
            ->get()->getResultArray();

        $customParams = [];
        foreach ($rows as $row) {
            $html = $row['form_html'] ?? '';
            preg_match_all('/\bname=["\']([^"\']+)["\']/', $html, $matches);

            foreach ($matches[1] as $nameAttr) {
                // Skip array syntax (acara[x][y], gallery[])
                if (strpos($nameAttr, '[') !== false) continue;
                // Skip standar
                if (in_array($nameAttr, $standardKeys, true)) continue;

                // Ambil nilai dari params jika ada
                $customParams[$nameAttr] = $params[$nameAttr] ?? null;
            }
        }

        return $customParams;
    }

    /**
     * Insert params batch ke undangan_param.
     */
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

    /**
     * Upsert ke undangan_param berdasarkan (undangan_id, param_name).
     * - Jika param_name sudah ada → UPDATE param_value
     * - Jika belum ada dan value tidak kosong → INSERT
     * - Jika value kosong → DELETE (bersihkan param yang dikosongkan user)
     */
    private function upsertParams(int $undangan_id, array $params): void
    {
        if (empty($params)) return;

        // Ambil semua param_name existing untuk undangan ini (1 query)
        $existingKeys = $this->db->table('undangan_param')
            ->select('param_name')
            ->where('undangan_id', $undangan_id)
            ->get()->getResultArray();

        $existingKeySet = array_flip(array_column($existingKeys, 'param_name'));

        foreach ($params as $name => $value) {
            $isEmpty = ($value === null || $value === '');

            if (isset($existingKeySet[$name])) {
                if ($isEmpty) {
                    // Value dikosongkan → hapus param
                    $this->db->table('undangan_param')
                        ->where('undangan_id', $undangan_id)
                        ->where('param_name', $name)
                        ->delete();
                } else {
                    // Update value existing
                    $this->db->table('undangan_param')
                        ->where('undangan_id', $undangan_id)
                        ->where('param_name', $name)
                        ->update(['param_value' => $value]);
                }
            } elseif (!$isEmpty) {
                // Insert baru
                $this->db->table('undangan_param')->insert([
                    'undangan_id' => $undangan_id,
                    'param_name'  => $name,
                    'param_value' => $value,
                ]);
            }
            // Jika tidak ada di DB dan value kosong → skip (tidak perlu action)
        }
    }

    private function getDemoDataForPreview(): array
    {
        return [
            'nama_mempelai_pria'   => 'Andika Putra',
            'nama_mempelai_wanita' => 'Citra Dewi',
            'tanggal_akad'         => 'Sabtu, 15 Juni 2025',
            'waktu_akad'           => '09:00 WIB',
            'tempat_akad'          => 'Masjid Agung, Jakarta',
            'tanggal_resepsi'      => 'Sabtu, 15 Juni 2025',
            'waktu_resepsi'        => '11:00 - 15:00 WIB',
            'tempat_resepsi'       => 'Gedung Serbaguna, Jakarta',
            'google_maps_link'     => 'https://maps.google.com/...',
            'nama_ayah'            => 'Bapak Susanto',
            'nama_ibu'             => 'Ibu Siti Aminah',
            'rekening'             => ['bank' => 'BCA', 'nomor' => '1234567890', 'an' => 'Andika & Citra'],
            'gallery'              => ['gallery1.jpg', 'gallery2.jpg', 'gallery3.jpg'],
            'story'                => [
                ['title' => 'Pertemuan Pertama', 'desc' => 'Kisah kami bertemu...'],
                ['title' => 'Lamaran',           'desc' => 'Momen spesial...'],
            ],
        ];
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