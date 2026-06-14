<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder // spojuje oba seedery do jednoho aby se nemuseli volat postupne
{
    public function run()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');

        $this->call('UserSeeder');
        $this->call('ChatSeeder');

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
