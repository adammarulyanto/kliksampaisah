<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table = 'template';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_path'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    public function getTemplateByFilePath($filePath)
    {
        return $this->where('file_path', $filePath)->first();
    }
}

