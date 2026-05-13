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

        // Ambil data undangan
        $undangan = $this->undanganModel->getUndanganWithTemplate($urlName);

        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan_id = $undangan['id'];
        $template_id = $undangan['template_id'];

        // ── CEK AKSES ────────────────────────────────────────────────
        $toParam = $this->request->getGet('to');

        if ($toParam !== null) {
            // Ada parameter ?to= → wajib ada di tabel guest
            $guest = $this->db->table('guest')
                ->where('undangan_id', $undangan_id)
                ->where('guest_name', $toParam)
                ->get()->getRowArray();

            if (!$guest) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $nama_tamu = $guest['guest_name'];
            
            // ✅ UPDATE viewed_at jika nama tamu tidak kosong dan berhasil ditemukan
            if (!empty($nama_tamu)) {
                $this->db->table('guest')
                    ->where('undangan_id', $undangan_id)
                    ->where('guest_name', $nama_tamu)
                    ->update([
                        'viewed_date' => date('Y-m-d H:i:s')
                    ]);
            }

        } else {
            // Tanpa parameter → wajib login sebagai pemilik undangan
            $sessionUserId = session()->get('user_id'); // sesuaikan dengan key session kamu

            if (!$sessionUserId || $sessionUserId != $undangan['user_id']) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                // atau redirect ke login:
                // return redirect()->to(base_url('login'));
            }

            $nama_tamu = '';
        }

        // ── AMBIL SEMUA PARAMS ────────────────────────────────────
        $paramsRaw = $this->db->table('undangan_param')
            ->where('undangan_id', $undangan_id)
            ->get()->getResult();

        $params = [];
        foreach ($paramsRaw as $row) {
            $params[$row->param_name] = $row->param_value;
        }

        // ── AMBIL EVENTS ──────────────────────────────────────────
        $eventsRaw = $this->db->table('events')
            ->where('undangan_id', $undangan_id)
            ->orderBy('event_date', 'ASC')
            ->get()->getResult();

        // Gabungkan events dengan param acara (hari, alamat, maps)
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

        $wishes = [
            [
                'nama'      => 'Siti Rahmawati',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Semoga menjadi keluarga yang sakinah mawaddah warahmah. Barakallahu lakuma!',
            ],
            [
                'nama'      => 'Budi Santoso',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Selamat menempuh hidup baru! Semoga selalu diberkahi dan dilancarkan rezeki.',
            ],
            [
                'nama'      => 'Anissa Putri',
                'kehadiran' => 'tidak',
                'ucapan'    => 'Maaf tidak bisa hadir, tetapi doa terbaik selalu menyertai perjalanan kalian.',
            ],
            [
                'nama'      => 'Rizky Pratama',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Akhirnya tiba juga hari yang ditunggu-tunggu. Semoga menjadi pasangan yang saling menguatkan.',
            ],
            [
                'nama'      => 'Dewi Kusuma',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Semoga rumah tangga kalian penuh dengan kebahagiaan dan kasih sayang yang abadi.',
            ],
            [
                'nama'      => 'Dewi Kusuma',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Semoga rumah tangga kalian penuh dengan kebahagiaan dan kasih sayang yang abadi.',
            ],
            [
                'nama'      => 'Dewi Kusuma',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Semoga rumah tangga kalian penuh dengan kebahagiaan dan kasih sayang yang abadi.',
            ],
            [
                'nama'      => 'Dewi Kusuma',
                'kehadiran' => 'hadir',
                'ucapan'    => 'Semoga rumah tangga kalian penuh dengan kebahagiaan dan kasih sayang yang abadi.',
            ],
            // ... dst dari database
        ];

        // GIFT
        $rekening = [
        ['bank' => 'BCA',     'nama' => 'Zahra Aulia',  'nomor' => '1234567890'],
        ['bank' => 'Mandiri', 'nama' => 'Ahmad Fauzan', 'nomor' => '0987654321'],
        ];

        $alamat_rumah = [
        'nama'   => 'Rumah Mempelai Wanita',
        'alamat' => 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310',
        'maps'   => 'https://maps.google.com/?q=-6.186486,106.834091',
        ];

        // ── AMBIL GALLERY ─────────────────────────────────────────
        $gallery = [];
        $i = 0;
        while (isset($params['gallery_' . $i])) {
            $gallery[] = $params['gallery_' . $i];
            $i++;
        }

        // ── SUSUN $data ───────────────────────────────────────────
        $data = [
            'undangan'       => $undangan,
            'nama_tamu'      => $nama_tamu,

            // Template
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
            'quote_text'     => $params['quote_text'] ?? null,
            'love_story'     => $params['love_story'] ?? null,

            // Musik
            'music_choice'   => $params['music_choice'] ?? null,

            // Acara (array)
            'acara'          => $acara,
            'acara_utama'    => array_values(array_filter($acara, fn($a) => $a['main_event'] == 1))[0] ?? null,

            // RSVP
            'wishes'         => $wishes,

            // GIFT
            'rekening'       => $rekening,
            'alamat_rumah'   => $alamat_rumah,

            // Gallery (array of path)
            'gallery'        => $gallery,
        ];

        // Ambil filename dari database
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

        // Ambil data undangan
        $undangan = $this->undanganModel->getUndanganWithTemplate($urlName);

        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $undangan_id = $undangan['id'];
        $template_id = $undangan['template_id'];

        // Ambil semua params
        $paramsRaw = $this->db->table('undangan_param')
            ->where('undangan_id', $undangan_id)
            ->get()->getResult();

        // Ubah jadi key => value
        $params = [];
        foreach ($paramsRaw as $row) {
            $params[$row->param_name] = $row->param_value;
        }

        // Ambil events
        $eventsRaw = $this->db->table('events')
            ->where('undangan_id', $undangan_id)
            ->orderBy('main_event', 'DESC')
            ->orderBy('event_date', 'ASC')
            ->get()->getResult();

        // Gabungkan events dengan param acara
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

        $rekening = [
        ['bank' => 'BCA',     'nama' => 'Zahra Aulia',  'nomor' => '1234567890'],
        ['bank' => 'Mandiri', 'nama' => 'Ahmad Fauzan', 'nomor' => '0987654321'],
        ];

        $alamat_rumah = [
        'nama'   => 'Rumah Mempelai Wanita',
        'alamat' => 'Jl. Mawar No. 12, RT 03/RW 05, Kel. Menteng, Jakarta Pusat 10310',
        'maps'   => 'https://maps.google.com/?q=-6.186486,106.834091',
        ];

        // Ambil gallery
        $gallery = [];
        $i = 0;
        while (isset($params['gallery_' . $i])) {
            $gallery[] = $params['gallery_' . $i];
            $i++;
        }

        // Ambil semua templates untuk dropdown
        $templates = $this->templateModel->where('id', $template_id)->findAll();

        // Ambil nama template yang aktif untuk preview label
        $currentTpl = array_values(array_filter($templates, fn($t) => $t['id'] == $template_id));
        

        $data = [
            'title'            => 'Edit Undangan',
            'user'             => [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar')
            ],
            'templates'        => $templates,
            'current_template' => $template_id,
            
            // Data undangan untuk diisi ke form
            'undangan_id'      => $undangan_id,
            'url_name'         => $undangan['url_name'],
            'judul_undangan'   => $params['judul_undangan'] ?? '',
            'keterangan'       => $params['keterangan'] ?? '',
            
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
            
            // Acara
            'acara'            => $acara,
            
            // Gallery
            'gallery'          => $gallery,
            
            // Template file
            'template_file'    => $undangan['file_path'] ?? '',

            'current_template_name' => $currentTpl[0]['template_name'] ?? '',
            'current_max_photo'     => $currentTpl[0]['max_photo'] ?? 10,

        ];

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

            // Update tabel undangan
            $undanganData = [];
            if (isset($input['template_id']))    $undanganData['template_id']    = $input['template_id'];
            if (isset($input['groom_name']))     $undanganData['fullname_men']   = $input['groom_name'];
            if (isset($input['groom_nickname'])) $undanganData['nickname_men']   = $input['groom_nickname'];
            if (isset($input['bride_name']))     $undanganData['fullname_women'] = $input['bride_name'];
            if (isset($input['bride_nickname'])) $undanganData['nickname_women'] = $input['bride_nickname'];
            if (isset($input['url_name'])) $undanganData['url_name'] = $input['url_name'];

            if (!empty($undanganData)) {
                $this->undanganModel->update($id, $undanganData);
            }

            // Hapus params lama (bukan gallery)
            $this->db->table('undangan_param')
                ->where('undangan_id', $id)
                ->where('param_name NOT LIKE', 'gallery_%')
                ->delete();

            // Insert params baru
            $paramsToSave = [
                'judul_undangan', 'keterangan', 'groom_father', 'groom_mother',
                'bride_father', 'bride_mother', 'quote_text', 'love_story', 'music_choice'
            ];
            foreach ($paramsToSave as $param) {
                if (isset($input[$param]) && $input[$param] !== '') {
                    $this->db->table('undangan_param')->insert([
                        'undangan_id' => $id,
                        'param_name'  => $param,
                        'param_value' => $input[$param],
                    ]);
                }
            }

            // Update events
            $this->db->table('events')->where('undangan_id', $id)->delete();

            if (isset($input['acara']) && is_array($input['acara'])) {
                foreach ($input['acara'] as $i => $acara) {
                    // FIX: gunakan == bukan === karena $i dari foreach adalah string
                    $mainEvent = (isset($input['main_event']) && (int)$input['main_event'] == (int)$i) ? 1 : 0;

                    $this->db->table('events')->insert([
                        'undangan_id' => $id,
                        'event_name'  => $acara['nama']    ?? '',
                        'event_date'  => $acara['tanggal'] ?? null,
                        'start_at'    => $acara['mulai']   ?? null,
                        'end_at'      => $acara['selesai'] ?? null,
                        'location'    => $acara['tempat']  ?? '',
                        'main_event'  => $mainEvent,
                    ]);

                    foreach (['hari', 'alamat', 'maps'] as $field) {
                        if (!empty($acara[$field])) {
                            $this->db->table('undangan_param')->insert([
                                'undangan_id' => $id,
                                'param_name'  => "acara_{$i}_{$field}",
                                'param_value' => $acara[$field],
                            ]);
                        }
                    }
                }
            }

            // ── GALLERY ──────────────────────────────────────────────
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

            $uploadedFiles = $this->request->getFiles();
            if (!empty($uploadedFiles['gallery'])) {
                $uploadPath = 'uploads/gallery/' . $id;
                $fullPath   = ROOTPATH . 'public/' . $uploadPath;
                if (!is_dir($fullPath)) {
                    mkdir($fullPath, 0777, true);
                }
                foreach ($uploadedFiles['gallery'] as $file) {
                    if ($file instanceof \CodeIgniter\HTTP\Files\UploadedFile
                        && $file->isValid()
                        && !$file->hasMoved()
                    ) {
                        $newName = $file->getRandomName();
                        $file->move($fullPath, $newName);
                        $this->db->table('undangan_param')->insert([
                            'undangan_id' => $id,
                            'param_name'  => "gallery_{$galleryIndex}",
                            'param_value' => $uploadPath . '/' . $newName,
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

            return redirect()->to(base_url('dashboard'))->with('success', 'Undangan berhasil diperbarui');

        } catch (\Exception $e) {
            $this->db->transRollback();
            
            // Log error ke file
            log_message('error', 'Update Error: ' . $e->getMessage());
            log_message('error', 'File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->to(base_url('undangan/'.$undanganData['url_name'].'/edit'))->with('error', $e->getMessage());
        }
    }

    public function live_preview($template_id = null)
    {
        if ($template_id === null || !is_numeric($template_id)) {
            throw PageNotFoundException::forPageNotFound('Template ID tidak valid');
        }

        $template = $this->templateModel->where('id', (int)$template_id)->first();

        if (!$template) {
            throw PageNotFoundException::forPageNotFound('Template tidak ditemukan');
        }
        
        $filename = $template['file_path'];
        $viewName = 'templates/' . str_replace('.php', '', $filename);
        
        $data = [
            'template_id' => $template['id'],
            'template_name' => $filename,
            'is_preview' => true,
            'preview_data' => $this->getDemoDataForPreview(),
        ];
        
        // ✅ Langsung gunakan try-catch tanpa view_exists()
        try {
            return view($viewName, $data);
        } catch (\Exception $e) {
            log_message('error', 'Preview error: ' . $e->getMessage());
            throw PageNotFoundException::forPageNotFound(
                "Template file {$filename} tidak ditemukan di folder views/templates/"
            );
        }
    }

    private function getDemoDataForPreview()
    {
        return [
            'nama_mempelai_pria' => 'Andika Putra',
            'nama_mempelai_wanita' => 'Citra Dewi',
            'tanggal_akad' => 'Sabtu, 15 Juni 2025',
            'waktu_akad' => '09:00 WIB',
            'tempat_akad' => 'Masjid Agung, Jakarta',
            'tanggal_resepsi' => 'Sabtu, 15 Juni 2025',
            'waktu_resepsi' => '11:00 - 15:00 WIB',
            'tempat_resepsi' => 'Gedung Serbaguna, Jakarta',
            'google_maps_link' => 'https://maps.google.com/...',
            'nama_ayah' => 'Bapak Susanto',
            'nama_ibu' => 'Ibu Siti Aminah',
            'rekening' => [
                'bank' => 'BCA',
                'nomor' => '1234567890',
                'an' => 'Andika & Citra'
            ],
            'gallery' => [
                'gallery1.jpg',
                'gallery2.jpg',
                'gallery3.jpg'
            ],
            'story' => [
                ['title' => 'Pertemuan Pertama', 'desc' => 'Kisah kami bertemu...'],
                ['title' => 'Lamaran', 'desc' => 'Momen spesial...']
            ]
        ];
    }
}