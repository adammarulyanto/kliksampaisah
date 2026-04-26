<?php

namespace App\Controllers;

use App\Models\UndanganModel;

class Undangan extends BaseController
{
    protected $undanganModel;
    
    public function __construct()
    {
        $this->undanganModel = new UndanganModel();
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
        
        $data = [
            'undangan' => $undangan,
            'params' => $this->request->getGet(),
            'nama_tamu' => $this->request->getGet('t') ?? '',
        ];
        
        // Ambil filename dari database (contoh: "template01.php")
        $filename = $undangan['file_path'];
        
        // Hapus ekstensi .php jika ada untuk view
        $viewName = 'templates/' . str_replace('.php', '', $filename);
        
        // Gunakan try-catch untuk menangkap error jika view tidak ditemukan
        try {
            // Load view
            return view($viewName, $data);
        } catch (\Exception $e) {
            // Jika view tidak ditemukan, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Template {$filename} tidak ditemukan");
        }
    }
}