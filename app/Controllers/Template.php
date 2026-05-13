<?php

namespace App\Controllers;

use App\Models\TemplateModel;

class Template extends BaseController
{
    protected $templateModel;
    
    public function __construct()
    {
        // Cek login user
        if (!session()->get('user_id')) {
            redirect()->to('/auth/login');
        }
        
        $this->templateModel = new TemplateModel();
    }
    
    // Method untuk menampilkan halaman template
    public function index()
    {
        $data['templates'] = $this->templateModel->findAll();
        return view('template/index', $data);
    }
    
    // Method untuk purchase template
    public function purchase()
    {
        $template_id = $this->request->getPost('template_id');
        $user_id = session()->get('user_id');

        if (!$template_id) {
            return redirect()->to('/template');
        }

        // Ambil harga dari DB
        $template = $this->templateModel->find($template_id);
        if (!$template) {
            return redirect()->to('/template');
        }

        $db = \Config\Database::connect();

        // Cek jika template gratis
        if ($template['price'] == 0) {
            // Langsung insert ownership untuk template gratis
            $db->table('ownership_template')->insert([
                'template_id' => $template_id,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            
            session()->setFlashdata('success', 'Template berhasil ditambahkan!');
            return redirect()->to('/undangan-saya');
        }

        // Untuk template berbayar, insert transaksi
        $db->table('template_transaction')->insert([
            'user_id' => $user_id,
            'template_id' => $template_id,
            'template_price' => $template['price'],
            'paid_amount' => $template['price'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $transaction_id = $db->insertID();

        // Insert ownership
        $db->table('ownership_template')->insert([
            'template_id' => $template_id,
            'user_id' => $user_id,
            'template_transaction_id' => $transaction_id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Template berhasil ditambahkan!');
        return redirect()->to('/undangan-saya');
    }
    
    // Method untuk preview template
    public function preview($id)
    {
        $template = $this->templateModel->find($id);
        if (!$template) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return view('template/preview', ['template' => $template]);
    }
}