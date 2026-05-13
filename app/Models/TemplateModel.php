<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table = 'template';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_path','template_name','category','price','max_photo','feature','fit_to','description','cover'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';
    
    // Untuk PostgreSQL, tambahkan jika perlu
    // protected $DBGroup = 'default'; // atau 'postgre'

    /**
     * Override findAll to parse PostgreSQL arrays
     */
    public function findAll(?int $limit = null, int $offset = 0)
    {
        $result = parent::findAll($limit, $offset);
        
        foreach ($result as &$row) {
            $row['feature'] = $this->parsePostgresArray($row['feature'] ?? null);
            $row['fit_to'] = $this->parsePostgresArray($row['fit_to'] ?? null);
        }
        
        return $result;
    }
    
    /**
     * Override find to parse PostgreSQL arrays
     */
    public function find($id = null)
    {
        $result = parent::find($id);
        
        if ($result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $result;
    }
    
    /**
     * Override first() to parse PostgreSQL arrays
     */
    public function first()
    {
        $result = parent::first();
        
        if ($result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $result;
    }
    
    /**
     * Parse PostgreSQL array string ke PHP array
     * Contoh: '{1,2,3}' => [1,2,3]
     * 
     * @param string|array|null $postgresArray
     * @return array
     */
    private function parsePostgresArray($postgresArray)
    {
        if (empty($postgresArray)) {
            return [];
        }
        
        // Jika sudah berupa array
        if (is_array($postgresArray)) {
            return $postgresArray;
        }
        
        // Jika berupa string PostgreSQL array format '{1,2,3}'
        if (is_string($postgresArray)) {
            // Remove curly braces
            $trimmed = trim($postgresArray, '{}');
            
            // Jika kosong setelah trim
            if (empty($trimmed)) {
                return [];
            }
            
            // Split by comma
            $parts = explode(',', $trimmed);
            
            // Convert to integers
            return array_map('intval', $parts);
        }
        
        return [];
    }
    
    /**
     * Convert PHP array to PostgreSQL array string
     * Contoh: [1,2,3] => '{1,2,3}'
     * 
     * @param array $array
     * @return string|null
     */
    public function toPostgresArray($array)
    {
        if (empty($array)) {
            return null;
        }
        
        if (!is_array($array)) {
            return null;
        }
        
        return '{' . implode(',', $array) . '}';
    }

    /**
     * Get template by file path
     */
    public function getTemplateByFilePath($filePath)
    {
        $result = $this->where('file_path', $filePath)->first();
        
        if ($result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $result;
    }

    /**
     * Get templates owned by specific user (with INNER JOIN)
     * Menghindari duplikasi dengan DISTINCT
     */
    public function getTemplatesByUser($user_id)
    {
        $results = $this->select('DISTINCT t.*')
            ->from('ownership_template ot')
            ->join('template t', 'ot.template_id = t.id', 'INNER')
            ->where('ot.user_id', $user_id)
            ->whereNull('ot.undangan_id')
            ->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Get templates by user using EXISTS (lebih efisien)
     */
    public function getTemplatesByUserExists($user_id)
    {
        $subquery = function($builder) use ($user_id) {
            $builder->select('1')
                ->from('ownership_template ot')
                ->where('ot.template_id = template.id')
                ->where('ot.user_id', $user_id)
                ->whereNull('ot.undangan_id');
        };
        
        $results = $this->where('EXISTS', $subquery)->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Get templates by user with LEFT JOIN (termasuk yang tidak punya relasi)
     */
    public function getTemplatesWithOwnership($user_id)
    {
        $results = $this->select('t.*, ot.user_id, ot.undangan_id')
            ->from('template t')
            ->join('ownership_template ot', 'ot.template_id = t.id AND ot.user_id = ' . $user_id, 'LEFT')
            ->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Get templates where undangan_id is NOT NULL (sudah digunakan)
     */
    public function getUsedTemplatesByUser($user_id)
    {
        $results = $this->select('DISTINCT t.*')
            ->from('ownership_template ot')
            ->join('template t', 'ot.template_id = t.id', 'INNER')
            ->where('ot.user_id', $user_id)
            ->whereNotNull('ot.undangan_id')  // Berbeda: NOT NULL
            ->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Get templates with pagination
     */
    public function getTemplatesByUserPaginated($user_id, $perPage = 10)
    {
        $results = $this->select('DISTINCT t.*')
            ->from('ownership_template ot')
            ->join('template t', 'ot.template_id = t.id', 'INNER')
            ->where('ot.user_id', $user_id)
            ->whereNull('ot.undangan_id')
            ->paginate($perPage);
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Check if user owns specific template
     */
    public function isUserOwnsTemplate($user_id, $template_id)
    {
        return $this->db->table('ownership_template')
            ->where('user_id', $user_id)
            ->where('template_id', $template_id)
            ->whereNull('undangan_id')
            ->countAllResults() > 0;
    }

    /**
     * Get count of templates per user (untuk dashboard)
     */
    public function countTemplatesByUser($user_id)
    {
        return $this->db->table('ownership_template ot')
            ->select('COUNT(DISTINCT ot.template_id) as total')
            ->where('ot.user_id', $user_id)
            ->whereNull('ot.undangan_id')
            ->get()
            ->getRow()
            ->total ?? 0;
    }

    /**
     * Get templates with additional info (join dengan users jika perlu)
     */
    public function getTemplatesWithUserDetails($user_id)
    {
        $results = $this->select('t.*, u.username, u.email')
            ->from('ownership_template ot')
            ->join('template t', 'ot.template_id = t.id', 'INNER')
            ->join('users u', 'u.id = ot.user_id', 'INNER')
            ->where('ot.user_id', $user_id)
            ->whereNull('ot.undangan_id')
            ->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    /**
     * Soft delete template (jika perlu)
     */
    public function softDeleteTemplate($id)
    {
        return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Debug query - untuk development
     */
    public function debugQuery($user_id)
    {
        $query = $this->select('DISTINCT t.*')
            ->from('ownership_template ot')
            ->join('template t', 'ot.template_id = t.id', 'INNER')
            ->where('ot.user_id', $user_id)
            ->whereNull('ot.undangan_id')
            ->get();
        
        // Return last query untuk debugging
        return $this->getLastQuery();
    }

    public function getOwnedButUnusedTemplates($user_id)
    {
        $results = $this->select('template.*, ot.id ownership_template_id')
            ->join('ownership_template ot', 'ot.template_id = template.id')
            ->where('ot.user_id', $user_id)
            ->where('ot.undangan_id is null')
            ->findAll();
        
        // Parse array fields for each result
        foreach ($results as &$result) {
            $result['feature'] = $this->parsePostgresArray($result['feature'] ?? null);
            $result['fit_to'] = $this->parsePostgresArray($result['fit_to'] ?? null);
        }
        
        return $results;
    }

    public function getTemplatesById(array $id)
    {   
        $result = $this->whereIn('id', $id)->findAll();
    
        if (empty($result)) {
            return ['error' => 'Template not found', 'id' => $id];
        }
        
        // Parse array fields for each result
        foreach ($result as &$row) {
            $row['feature'] = $this->parsePostgresArray($row['feature'] ?? null);
            $row['fit_to'] = $this->parsePostgresArray($row['fit_to'] ?? null);
        }

        // Jika hanya satu ID yang diminta, return single result
        if (count($id) === 1) {
            return $result[0] ?? ['error' => 'Template not found', 'id' => $id];
        }

        return $result;
    }
}