<?php

namespace App\Controllers;

class Debug extends BaseController
{
    public function checkDB()
    {
        echo "<h2>Database Debug</h2>";
        
        // Test koneksi database
        try {
            $db = \Config\Database::connect();
            echo "<p style='color:green'>✓ Database connected successfully</p>";
        } catch (\Exception $e) {
            echo "<p style='color:red'>✗ Database connection failed: " . $e->getMessage() . "</p>";
            return;
        }
        
        // Cek tabel users
        try {
            $userModel = new \App\Models\UserModel();
            
            // Coba buat tabel jika belum ada
            if (!$db->tableExists('users')) {
                echo "<p style='color:orange'>⚠ Table 'users' does not exist! Creating...</p>";
                $this->createUsersTable();
            } else {
                echo "<p style='color:green'>✓ Table 'users' exists</p>";
            }
            
            // Tampilkan data users
            $users = $userModel->findAll();
            echo "<h3>Data Users (" . count($users) . " records):</h3>";
            if (empty($users)) {
                echo "<p>No users found in database.</p>";
            } else {
                echo "<pre>";
                foreach ($users as $user) {
                    print_r($user);
                    echo "\n---\n";
                }
                echo "</pre>";
            }
            
            // Cek struktur tabel
            echo "<h3>Table Structure:</h3>";
            $fields = $db->getFieldNames('users');
            echo "<pre>";
            print_r($fields);
            echo "</pre>";
            
        } catch (\Exception $e) {
            echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
        }
        
        echo "<h2>Session Data:</h2>";
        echo "<pre>";
        print_r(session()->get());
        echo "</pre>";
    }
    
    private function createUsersTable()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();
        
        $fields = [
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'google_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'unique' => true],
            'avatar' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'is_verified' => ['type' => 'BOOLEAN', 'default' => false],
            'verification_code' => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'code_expiry' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ];
        
        $forge->addField($fields);
        $forge->addKey('id', true);
        $forge->createTable('users', true);
        
        echo "<p style='color:green'>✓ Table 'users' created successfully!</p>";
    }
    
    public function testGoogleSave()
    {
        echo "<h2>Test Save Google User</h2>";
        
        // Simulasi data dari Google
        $testData = [
            'email' => 'test_' . time() . '@gmail.com',
            'full_name' => 'Test User ' . time(),
            'google_id' => 'google_' . time(),
            'avatar' => 'https://via.placeholder.com/100',
            'username' => 'testuser_' . time(),
            'is_verified' => true
        ];
        
        echo "<pre>Data to save: " . print_r($testData, true) . "</pre>";
        
        $userModel = new \App\Models\UserModel();
        
        try {
            if ($userModel->insert($testData)) {
                echo "<p style='color:green'>✓ Save successful! ID: " . $userModel->getInsertID() . "</p>";
            } else {
                echo "<p style='color:red'>✗ Save failed!</p>";
                echo "<p>Errors: " . print_r($userModel->errors(), true) . "</p>";
            }
        } catch (\Exception $e) {
            echo "<p style='color:red'>Exception: " . $e->getMessage() . "</p>";
        }
    }
}