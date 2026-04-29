<?php

namespace App\Controllers;

use App\Models\UndanganModel;

class Undangan extends BaseController
{
    protected $undanganModel;
    protected $db;

    public function __construct()
    {
        $this->undanganModel = new UndanganModel();
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

        // ── AMBIL SEMUA PARAMS ────────────────────────────────────
        $paramsRaw = $this->db->table('undangan_param')
            ->where('undangan_id', $undangan_id)
            ->get()->getResult();

        // Ubah jadi key => value
        $params = [];
        foreach ($paramsRaw as $row) {
            $params[$row->param_name] = $row->param_value;
        }

        // ── AMBIL EVENTS ──────────────────────────────────────────
        $eventsRaw = $this->db->table('events')
            ->where('undangan_id', $undangan_id)
            ->orderBy('main_event', 'DESC')
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
            'nama_tamu'      => $this->request->getGet('t') ?? '',

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
}