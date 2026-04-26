<?php

namespace App\Models;

use CodeIgniter\Model;

class UndanganModel extends Model
{
    protected $table = 'undangan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['template_id', 'url_name'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
    
    public function getUndanganWithTemplate($urlName)
    {
        return $this->select('undangan.*, template.file_path')
                    ->join('template', 'template.id = undangan.template_id')
                    ->where('undangan.url_name', $urlName)
                    ->first();
    }
    
    // Optional: Method untuk case-sensitive search di PostgreSQL
    public function getUndanganCaseSensitive($urlName)
    {
        return $this->select('undangan.*, template.file_path')
                    ->join('template', 'template.id = undangan.template_id')
                    ->where('LOWER(undangan.url_name)', strtolower($urlName))
                    ->first();
    }
}
