<?php

namespace App\Models;

use CodeIgniter\Model;

class GlobalParamModel extends Model
{
    protected $table = 'global_param_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['global_param_id', 'param_name'];
    protected $useTimestamps = true;
    
    /**
     * Get features by list of IDs
     * 
     * @param array|string|null $ids
     * @return array
     */
    public function getFeaturesByIds($ids)
    {
        // Handle jika $ids bukan array
        if (empty($ids)) {
            return [];
        }
        
        // Jika $ids adalah string, coba parse
        if (is_string($ids)) {
            $ids = $this->parsePostgresArray($ids);
        }
        
        // Pastikan $ids adalah array
        if (!is_array($ids)) {
            return [];
        }
        
        if (empty($ids)) {
            return [];
        }
        
        return $this->whereIn('id', $ids)
                    ->where('global_param_id', 1)
                    ->findAll();
    }
    
    /**
     * Get fit_to/tags by list of IDs
     * 
     * @param array|string|null $ids
     * @return array
     */
    public function getFitToByIds($ids)
    {
        // Handle jika $ids bukan array
        if (empty($ids)) {
            return [];
        }
        
        // Jika $ids adalah string, coba parse
        if (is_string($ids)) {
            $ids = $this->parsePostgresArray($ids);
        }
        
        // Pastikan $ids adalah array
        if (!is_array($ids)) {
            return [];
        }
        
        if (empty($ids)) {
            return [];
        }
        
        return $this->whereIn('id', $ids)
                    ->where('global_param_id', 2)
                    ->findAll();
    }
    
    /**
     * Parse PostgreSQL array string ke PHP array
     */
    private function parsePostgresArray($postgresArray)
    {
        if (empty($postgresArray)) {
            return [];
        }
        
        if (is_array($postgresArray)) {
            return $postgresArray;
        }
        
        if (is_string($postgresArray)) {
            $trimmed = trim($postgresArray, '{}');
            if (empty($trimmed)) {
                return [];
            }
            $parts = explode(',', $trimmed);
            return array_map('intval', $parts);
        }
        
        return [];
    }
    
    /**
     * Get all features (global_param_id = 1)
     */
    public function getAllFeatures()
    {
        return $this->where('global_param_id', 1)->findAll();
    }
    
    /**
     * Get all fit_to options (global_param_id = 2)
     */
    public function getAllFitTo()
    {
        return $this->where('global_param_id', 2)->findAll();
    }
}