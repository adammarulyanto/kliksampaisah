<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        
        $data = [
            'title' => 'Dashboard',
            'user' => [
                'full_name' => session()->get('full_name'),
                'email' => session()->get('email'),
                'username' => session()->get('username'),
                'avatar' => session()->get('avatar')
            ]
        ];
        
        return view('home/index', $data);
    }
    
    public function profile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));
        
        $data = [
            'title' => 'Profil Saya',
            'user' => $user
        ];
        
        return view('home/profile', $data);
    }
}