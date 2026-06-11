<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('cs_CZ');

        $this->db->table('users')->truncate();

        for ($i = 0; $i < 20; $i++) {
            $data = [
                'username' => $faker->userName,
                'password_hash' => password_hash('password', PASSWORD_DEFAULT)
            ];

            $this->db->table('users')->insert($data);
        }
    }
}
