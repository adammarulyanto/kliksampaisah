<?php

namespace App\Controllers;

use App\Models\TemplateModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        // Cek login di constructor, akan berlaku untuk semua method
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/login')->send();
            exit();
        }

        $this->templateModel = new TemplateModel();
    }

    public function index()
    {
        

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'full_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ]
        ];
        
        return view('dashboard/dashboard.php', $data);
    }

    public function undangan_saya()
    {
        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $query = $db->query("
                    SELECT 
                        u.id,
                        u.url_name,
                        t.template_name,
                        u.nickname_men,
                        u.nickname_women,
                        e.event_name,
                        e.event_date,
                        e.start_at,
                        e.end_at,
                        e.location,
                        COUNT(g.id) as tamu,
                        count(g.viewed_date) as viewed,
                        COALESCE(SUM(g.rsvp), 0) as rsvp,
                        e.event_date-current_date as days_left
                    FROM 
                        undangan u
                        LEFT JOIN events e ON e.undangan_id = u.id AND e.main_event = 1
                        LEFT JOIN guest g ON g.undangan_id = u.id
                        LEFT JOIN template t ON t.id = u.template_id 
                    WHERE
                        u.user_id = ?
                    GROUP BY 
                        u.id,
                        u.url_name,
                        t.template_name,
                        u.nickname_men,
                        u.nickname_women,
                        e.event_name,
                        e.event_date,
                        e.start_at,
                        e.end_at,
                        e.location
                ", [$userId]);
                
        
        $data = [
            'title' => 'Undangan Saya',
            'user' => [
                'full_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ],
            'wedding_data' => $query->getResult()
        ];
        
        return view('dashboard/undangan_saya.php', $data);
    }

    public function buat_undangan()
    {
        // Ambil semua template dari database
        $templates = $this->templateModel->findAll();
        
        $data = [
            'title' => 'Buat Undangan',
            'user' => [
                'full_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ],
            'templates' => $templates,
            'current_template' => $templates[0] ?? null
        ];
        
        return view('dashboard/buat_undangan.php', $data);

    }

    public function cek_template()
    {
        $data['templates'] = $this->templateModel->findAll();
        return view('template_selector', $data);
    }

    public function loadTemplate($filename = null)
    {
        if (empty($filename)) {
            return "No template specified";
        }
        
        // Cek di database
        $template = $this->templateModel->getTemplateByFilePath($filename);
        
        if (!$template) {
            return "Template not found in database: " . $filename;
        }
        
        // **PERBAIKAN: Hapus ekstensi .php dan gunakan slash**
        // Contoh: "template01.php" -> "templates/template01"
        $viewName = 'templates/' . str_replace('.php', '', $filename);
        
        // Debug: cek apakah file benar-benar ada
        $fullPath = APPPATH . 'Views/' . $viewName . '.php';
        
        if (!file_exists($fullPath)) {
            return "File not found at: " . $fullPath;
        }
        
        // Load view - TANPA ekstensi .php
        try {
            return view($viewName);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // API untuk mengambil daftar template (jika perlu AJAX)
    public function getTemplatesJson()
    {
        $templates = $this->templateModel->getActiveTemplates();
        return $this->response->setJSON($templates);
    }

    public function template()
    {
        $data = [
            'title' => 'Template',
            'user' => [
                'full_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ]
        ];
        
        return view('dashboard/template.php', $data);
    }

    function format_rupiah($angka) {
        return "Rp " . number_format($angka, 0, ',', '.');
    }
}