<?php

namespace App\Controllers;

use App\Models\GuestModel;
use App\Models\UndanganModel;

class Guest extends BaseController
{
    protected $guestModel;
    protected $undanganModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->undanganModel = new UndanganModel();
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
    }

    /**
     * Display guest list page
     */
    public function index($urlName)
    {
        $undangan = $this->undanganModel->getByUrlName($urlName);
        $userId = session()->get('user_id');

        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Undangan not found");
        }

        // Pastikan $userId ada untuk query berikutnya
        if (!$userId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User not authenticated");
        }

        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }

        $mainEvent = $this->undanganModel->getMainEvent($undangan->id);
        $allEvents = $this->undanganModel->getEvents($undangan->id);
        $stats = $this->guestModel->getStatistics($undangan->id);

        $limit = 6;
        $offset = 0;
        $search = $this->request->getGet('search') ?? '';
        $rsvpFilter = $this->request->getGet('rsvp') ?? 'all';

        $filterValue = ($rsvpFilter !== 'all') ? (int)$rsvpFilter : null;
        $guestsData = $this->guestModel->getGuestsByUndanganId(
            $undangan->id, 
            $search, 
            $filterValue, 
            $limit, 
            $offset
        );

        // -- Data Stats Grid ----------------------------
        // Perbaikan: gunakan satu array untuk parameter binding
        $statsRow = $this->db->query("
            SELECT 
                COUNT(g.id)                  AS total_tamu,
                COALESCE(SUM(g.rsvp), 0)     AS total_rsvp,
                COUNT(g.viewed_date)         AS total_views,
                COUNT(CASE WHEN g.rsvp = 2 THEN 1 END) AS total_absen,
                COUNT(CASE WHEN g.rsvp = 0 THEN 1 END) AS total_belum
            FROM undangan u
            LEFT JOIN guest g ON g.undangan_id = u.id
            WHERE u.user_id = ? 
            AND u.id = ?
        ", [$userId, $undangan->id])->getRow(); // ← Perbaikan: satu array dengan dua parameter
        
        $data = [
            'title' => 'Daftar Tamu - ' . ($undangan->fullname_men ?? '') . ' & ' . ($undangan->fullname_women ?? ''),
            'undangan' => $undangan,
            'mainEvent' => $mainEvent,
            'allEvents' => $allEvents,
            'stats' => $stats,
            'guests' => $guestsData['guests'],
            'totalGuests' => $guestsData['total'],
            'currentPage' => 1,
            'perPage' => $limit,
            'search' => $search,
            'rsvpFilter' => $rsvpFilter,
            'baseUrl' => base_url("undangan/{$urlName}/guest-list"),
            'user'=> [
                'full_name' => session()->get('full_name'),
                'email'     => session()->get('email'),
                'username'  => session()->get('username'),
                'avatar'    => session()->get('avatar'),
            ],
            // stat grid
            'total_tamu'      => $statsRow->total_tamu   ?? 0,
            'total_rsvp'      => $statsRow->total_rsvp   ?? 0,
            'total_views'     => $statsRow->total_views  ?? 0,
            'total_absen'     => $statsRow->total_absen  ?? 0,
            'total_belum'     => $statsRow->total_belum  ?? 0,
        ];
        
        return view('guest/list', $data);
    }

    /**
     * Get events for dropdown (AJAX)
     */
    public function getEvents($urlName)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $undangan = $this->undanganModel->getByUrlName($urlName);
        if (!$undangan) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }
        
        $events = $this->undanganModel->getEvents($undangan->id);
        
        return $this->response->setJSON([
            'success' => true,
            'events' => $events
        ]);
    }

    /**
     * Filter guests with AJAX
     */
    public function filter($urlName)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $undangan = $this->undanganModel->getByUrlName($urlName);
        if (!$undangan) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }
        
        $page = $this->request->getPost('page') ?? 1;
        $search = $this->request->getPost('search') ?? '';
        $rsvpFilter = $this->request->getPost('rsvp') ?? 'all';
        $limit = 6;
        $offset = ($page - 1) * $limit;
        
        $filterValue = ($rsvpFilter !== 'all') ? (int)$rsvpFilter : null;
        $guestsData = $this->guestModel->getGuestsByUndanganId(
            $undangan->id,
            $search,
            $filterValue,
            $limit,
            $offset
        );
        
        $totalPages = ceil($guestsData['total'] / $limit);
        
        // Get stats for stat grid
        $stats = $this->guestModel->getStatistics($undangan->id);
        
        foreach ($guestsData['guests'] as $index => $guest) {
            $guestsData['guests'][$index]->event_names = $this->guestModel->getGuestEvents(
                $guest->events_id  // ← langsung dari data yang sudah ada
            );
            $guestsData['guests'][$index]->rsvp_text  = GuestModel::getRsvpText($guest->rsvp);
            $guestsData['guests'][$index]->rsvp_class = GuestModel::getRsvpClass($guest->rsvp);
        }
        
        return $this->response->setJSON([
            'success' => true,
            'guests' => $guestsData['guests'],
            'total' => $guestsData['total'],
            'currentPage' => (int)$page,
            'totalPages' => $totalPages,
            'perPage' => $limit,
            'startItem' => $guestsData['total'] > 0 ? ($page - 1) * $limit + 1 : 0,
            'endItem' => min($page * $limit, $guestsData['total']),
            'stats' => $stats
        ]);
    }
    
    /**
     * Add new guest with multiple events
     */
    public function addGuest($urlName)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $undangan = $this->undanganModel->getByUrlName($urlName);
        if (!$undangan) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }
        
        $rules = [
            'guest_name' => 'required|min_length[3]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        $guestName      = $this->request->getPost('guest_name');
        $phone          = $this->request->getPost('phone');
        $selectedEvents = $this->request->getPost('events');
        
        // Format events_id as PostgreSQL array
        $eventsId = null;
        if (!empty($selectedEvents)) {
            if (is_array($selectedEvents)) {
                $eventsId = '{' . implode(',', $selectedEvents) . '}';
            } else {
                $eventsId = '{' . $selectedEvents . '}';
            }
        } else {
            // Default to main event
            $mainEvent = $this->undanganModel->getMainEvent($undangan->id);
            if ($mainEvent) {
                $eventsId = '{' . $mainEvent->id . '}';
            }
        }
        
        $data = [
            'guest_name'  => $guestName,
            'phone_no'    => !empty($phone) ? $phone : null,   // ← kolom terpisah
            'undangan_id' => $undangan->id,
            'rsvp'        => GuestModel::RSVP_BELUM,
            'events_id'   => $eventsId
        ];
        
        $insertId = $this->guestModel->insert($data);
        
        if ($insertId) {
            return $this->response->setJSON([
                'success'  => true,
                'message'  => 'Tamu berhasil ditambahkan',
                'guest_id' => $insertId
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan tamu'
        ]);
    }
    
    /**
     * Edit guest
     */
    public function editGuest($urlName, $id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $guest = $this->guestModel->find($id);
        if (!$guest) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($guest)) {
            $guest = (object) $guest;
        }
        
        $name = $this->request->getPost('guest_name');
        $phone = $this->request->getPost('phone');
        $rsvp = $this->request->getPost('rsvp');
        $selectedEvents = $this->request->getPost('events');
        
        // Update name with phone
        $newName = $name;
        if (!empty($phone)) {
            $newName = $name . '|' . $phone;
        } elseif (strpos($guest->guest_name, '|') !== false) {
            $parts = explode('|', $guest->guest_name);
            $newName = $name . '|' . $parts[1];
        }
        
        $updateData = ['guest_name' => $newName];
        
        if ($rsvp !== null) {
            $updateData['rsvp'] = (int)$rsvp;
        }
        
        // Update events if provided
        if (!empty($selectedEvents)) {
            if (is_array($selectedEvents)) {
                $updateData['events_id'] = '{' . implode(',', $selectedEvents) . '}';
            } else {
                $updateData['events_id'] = '{' . $selectedEvents . '}';
            }
        }
        
        if ($this->guestModel->update($id, $updateData)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tamu berhasil diupdate'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengupdate tamu'
        ]);
    }
    
    /**
     * Delete guest
     */
    public function deleteGuest($urlName, $id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        if ($this->guestModel->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Tamu berhasil dihapus'
            ]);
        }
        
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus tamu'
        ]);
    }
    
    /**
     * Send WhatsApp message
     */
    public function sendWhatsApp($urlName)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $guestId = $this->request->getPost('guest_id');
        $message = $this->request->getPost('message');
        
        $guest = $this->guestModel->find($guestId);
        if (!$guest) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($guest)) {
            $guest = (object) $guest;
        }

        $guestName = $guest->guest_name;        // ← langsung, tidak perlu explode
        $phone     = $guest->phone_no ?? '';    // ← dari kolom phone_no
        
        if (empty($phone)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nomor WhatsApp tidak tersedia untuk tamu ini'
            ]);
        }
        
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($cleanPhone, 0, 1) === '0') {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        } elseif (substr($cleanPhone, 0, 2) !== '62') {
            $cleanPhone = '62' . $cleanPhone;
        }
        
        $message = str_replace('{{nama_encoded}}', rawurlencode($guestName), $message);
        $message = str_replace('{{nama}}', $guestName, $message);
        $this->guestModel->update($guestId, ['sent_date' => date('Y-m-d H:i:s')]);
        
        return $this->response->setJSON([
            'success' => true,
            'wa_url'  => "https://wa.me/{$cleanPhone}?text=" . urlencode($message)
        ]);
    }
    
    /**
     * Get templates for WhatsApp messages
     */
    public function getTemplates($urlName)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }
        
        $undangan = $this->undanganModel->getByUrlName($urlName);
        if (!$undangan) {
            return $this->response->setStatusCode(404);
        }
        
        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }
        
        $mainEvent = $this->undanganModel->getMainEvent($undangan->id);
        $eventDate = $mainEvent ? date('d F Y', strtotime($mainEvent->event_date)) : 'TBA';
        $eventLocation = $mainEvent ? $mainEvent->location : 'TBA';
        $coupleName = ($undangan->fullname_men ?? '') . ' & ' . ($undangan->fullname_women ?? '');
        $invitationLink = base_url("{$urlName}");
        
        $templates = [
            'pernikahan' => "Kepada Yth. {{nama}}\n\nAssalamu'alaikum Warahmatullahi Wabarakatuh\n\nTanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami:\n\n💍 *{$coupleName}*\n📅 {$eventDate}\n📍 {$eventLocation}\n\n🔗 {$invitationLink}?to={{nama_encoded}}\n\nMerupakan kebahagiaan bagi kami apabila berkenan hadir.\n\nWassalamu'alaikum Wr. Wb.\n{$coupleName}",
            'ulang_tahun' => "🎂 *UNDANGAN ULANG TAHUN* 🎂\n\nKepada Yth. {{nama}}\n\nAssalamu'alaikum Wr. Wb.\n\nKami mengundang Bapak/Ibu untuk hadir di acara ulang tahun:\n\n🎉 *" . ($undangan->fullname_men ?? 'Adam') . "*\n📅 {$eventDate}\n📍 {$eventLocation}\n\nKonfirmasi: {$invitationLink}?to={{nama_encoded}}\n\nWassalamu'alaikum",
            'wisuda' => "🎓 *SYUKURAN WISUDA* 🎓\n\nKepada Yth. {{nama}}\n\nAssalamu'alaikum Wr. Wb.\n\nDengan syukur, kami mengundang Bapak/Ibu untuk hadir di acara wisuda:\n\n🌟 *" . ($undangan->fullname_women ?? 'Anisa') . "*\n📅 {$eventDate}\n📍 {$eventLocation}\n\nLink: {$invitationLink}?to={{nama_encoded}}\n\nDoa restu sangat berarti bagi kami.\n\nWassalamu'alaikum"
        ];
        
        return $this->response->setJSON([
            'success' => true,
            'templates' => $templates
        ]);
    }
    
    /**
     * Export guest list to CSV
     */
    public function exportGuestList($urlName)
    {
        $undangan = $this->undanganModel->getByUrlName($urlName);
        if (!$undangan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Undangan not found");
        }
        
        if (is_array($undangan)) {
            $undangan = (object) $undangan;
        }
        
        $guests = $this->guestModel->where('undangan_id', $undangan->id)->findAll();
        
        $filename = "guest_list_{$urlName}_" . date('Y-m-d') . ".csv";
        
        $this->response->setHeader('Content-Type', 'text/csv');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Nama Tamu', 'Nomor WhatsApp', 'RSVP', 'Acara', 'Tanggal Dilihat', 'Tanggal Dikirim']);
        
        foreach ($guests as $guest) {
            if (is_array($guest)) {
                $guest = (object) $guest;
            }
            $nameParts = explode('|', $guest->guest_name);
            $name = $nameParts[0];
            $phone = isset($nameParts[1]) ? $nameParts[1] : '';
            $eventNames = implode(', ', $this->guestModel->getGuestEvents($guest->id));
            
            fputcsv($output, [
                $guest->id,
                $name,
                $phone,
                GuestModel::getRsvpText($guest->rsvp),
                $eventNames,
                $guest->viewed_date ?? '',
                $guest->sent_date ?? ''
            ]);
        }
        
        fclose($output);
        exit();
    }
}