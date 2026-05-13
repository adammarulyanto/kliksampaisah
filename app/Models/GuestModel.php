<?php

namespace App\Models;

use CodeIgniter\Model;

class GuestModel extends Model
{
    protected $table = 'guest';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // <- PASTIKAN INI 'object'
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'guest_name',
        'rsvp',
        'viewed_date',
        'undangan_id',
        'events_id',
        'sent_date',
        'phone_no'
    ];

    protected $useTimestamps = false;

    // RSVP status constants
    const RSVP_BELUM = 0;
    const RSVP_HADIR = 1;
    const RSVP_TIDAK_HADIR = 2;
    const RSVP_MUNGKIN = 3;

    /**
     * Get RSVP status text
     */
    public static function getRsvpText($status)
    {
        $statuses = [
            self::RSVP_BELUM => 'Belum Konfirmasi',
            self::RSVP_HADIR => 'Hadir',
            self::RSVP_TIDAK_HADIR => 'Tidak Hadir',
            self::RSVP_MUNGKIN => 'Mungkin Hadir'
        ];
        return $statuses[$status] ?? 'Unknown';
    }

    /**
     * Get RSVP status class for styling
     */
    public static function getRsvpClass($status)
    {
        $classes = [
            self::RSVP_BELUM => 'belum',
            self::RSVP_HADIR => 'hadir',
            self::RSVP_TIDAK_HADIR => 'tidak',
            self::RSVP_MUNGKIN => 'mungkin'
        ];
        return $classes[$status] ?? 'belum';
    }

    /**
     * Get guests by undangan_id with pagination and filters
     */
    public function getGuestsByUndanganId($undanganId, $search = '', $rsvpFilter = null, $limit = 6, $offset = 0)
    {
        $builder = $this->db->table('guest g')
            ->select('g.*, u.url_name, u.fullname_men, u.fullname_women')
            ->join('undangan u', 'u.id = g.undangan_id')
            ->where('g.undangan_id', $undanganId);

        if (!empty($search)) {
            $builder->like('g.guest_name', $search);
        }

        if ($rsvpFilter !== null && $rsvpFilter !== 'all') {
            $builder->where('g.rsvp', (int)$rsvpFilter);
        }

        $total = $builder->countAllResults(false);

        $guests = $builder->orderBy('g.id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->getResult(); // <- array of objects

        return [
            'guests' => $guests,
            'total' => $total
        ];
    }

    /**
     * Get guest by id - returns object
     */
    public function getGuestById($id)
    {
        $result = $this->db->table('guest g')
            ->select('g.*, u.url_name, u.fullname_men, u.fullname_women')
            ->join('undangan u', 'u.id = g.undangan_id')
            ->where('g.id', $id)
            ->get()
            ->getRow(); // <- getRow() untuk object
        
        return $result;
    }

    /**
     * Get event names for a guest
     */
    public function getGuestEvents($eventsId)
    {
        if (empty($eventsId)) {
            return [];
        }

        // Handle PostgreSQL array format {1,2,3}
        if (is_string($eventsId)) {
            $eventsId = trim($eventsId, '{}');
            $eventsId = $eventsId ? explode(',', $eventsId) : [];
        } elseif (!is_array($eventsId)) {
            $eventsId = (array) $eventsId;
        }

        if (empty($eventsId)) {
            return [];
        }

        $events = $this->db->table('events')
            ->select('event_name')
            ->whereIn('id', $eventsId)
            ->get()
            ->getResult();

        return array_map(fn($e) => $e->event_name, $events);
    }

    /**
     * Create new guest
     */
    public function createGuest($data)
    {
        return $this->insert($data);
    }

    /**
     * Update guest
     */
    public function updateGuest($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete guest
     */
    public function deleteGuest($id)
    {
        return $this->delete($id);
    }

    /**
     * Get statistics for undangan
     */
    public function getStatistics($undanganId)
    {
        $total = $this->where('undangan_id', $undanganId)->countAllResults(false);
        
        $hadir = $this->where('undangan_id', $undanganId)
            ->where('rsvp', self::RSVP_HADIR)
            ->countAllResults(false);
        
        $belum = $this->where('undangan_id', $undanganId)
            ->where('rsvp', self::RSVP_BELUM)
            ->countAllResults(false);
        
        $tidak = $this->where('undangan_id', $undanganId)
            ->where('rsvp', self::RSVP_TIDAK_HADIR)
            ->countAllResults(false);
        
        $mungkin = $this->where('undangan_id', $undanganId)
            ->where('rsvp', self::RSVP_MUNGKIN)
            ->countAllResults(false);

        return [
            'total' => $total,
            'hadir' => $hadir,
            'belum' => $belum,
            'tidak' => $tidak,
            'mungkin' => $mungkin
        ];
    }
}