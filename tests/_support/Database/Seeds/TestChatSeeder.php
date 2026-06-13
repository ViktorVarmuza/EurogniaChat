<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestChatSeeder extends Seeder
{
    public function run(): void
    {
        
        $this->db->table('users')->insert([
            'username' => 'testuser',
            'password_hash' => password_hash('secret', PASSWORD_DEFAULT),
        ]);

        $userId = $this->db->insertID();

        
        $this->db->table('messages')->insert([
            'user_id' => $userId,
            'content' => 'Hello from test user',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('messages')->insert([
            'user_id' => $userId,
            'content' => 'Second test message',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
