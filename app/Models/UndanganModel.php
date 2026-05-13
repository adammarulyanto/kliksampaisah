<?php

namespace App\Models;

use CodeIgniter\Model;

class UndanganModel extends Model
{
    protected $table = 'undangan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['template_id', 'url_name', 'fullname_men', 'nickname_men', 'fullname_women', 'nickname_women'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
    
    // Override method untuk menggunakan timezone Jakarta
    protected function setTimestamps(bool $update = true)
    {
        // Gunakan waktu Jakarta (UTC+7)
        $date = date('Y-m-d H:i:s', time() + (7 * 3600));
        
        if ($update && ! empty($this->updatedField)) {
            $this->set($this->updatedField, $date);
        }
        
        if (! $update && ! empty($this->createdField) && empty($this->get($this->createdField))) {
            $this->set($this->createdField, $date);
        }
    }

    public function getByUrlName($urlName)
    {
        $result = $this->where('url_name', $urlName)->first();
        
        // Jika result masih array, konversi ke object
        if (is_array($result)) {
            return (object) $result;
        }
        
        return $result;
    }

    public function getUndanganWithTemplate($urlName)
    {
        $result = $this->db->table('undangan u')
            ->select('u.*, t.template_name, t.file_path, t.category, t.price')
            ->join('template t', 't.id = u.template_id', 'left')
            ->where('u.url_name', $urlName)
            ->get()
            ->getRowArray(); // ← Change to getRowArray()
        
        return $result; // Now returns array
    }

    public function getMainEvent($undanganId)
    {
        $result = $this->db->table('events')
            ->where('undangan_id', $undanganId)
            ->where('main_event', 1)
            ->get()
            ->getRow(); // <- getRow() mengembalikan object
        
        return $result;
    }

    public function getEvents($undanganId)
    {
        return $this->db->table('events')
            ->where('undangan_id', $undanganId)
            ->orderBy('main_event', 'DESC')
            ->orderBy('event_date', 'ASC')
            ->get()
            ->getResult(); // <- getResult() mengembalikan array of objects
    }

    public function getUndanganById($id)
    {
        $result = $this->find($id);
        
        if (is_array($result)) {
            return (object) $result;
        }
        
        return $result;
    }
    
    // Optional: Method untuk case-sensitive search di PostgreSQL
    public function getUndanganCaseSensitive($urlName)
    {
        return $this->select('undangan.*, template.file_path')
                    ->join('template', 'template.id = undangan.template_id')
                    ->where('LOWER(undangan.url_name)', strtolower($urlName))
                    ->first();
    }
    
    public function updateUndangan($id, $data)
    {
        // Skip validasi unique untuk update
        return $this->db->table('undangan')
            ->where('id', $id)
            ->update($data);
    }
}