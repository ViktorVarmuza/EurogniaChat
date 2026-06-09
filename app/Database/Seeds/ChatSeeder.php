<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;

class ChatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('cs_CZ');

        $this->db->table('messages')->truncate();

        $users = $this->db->table('users')->select('id')->get()->getResultArray();

        $usersIds = array_column($users, 'id');


        if (empty($usersIds)) {
            return;
        }


        for ($i = 0; $i < 20; $i++) {
            $data = [
                'user_id' => $faker->randomElement($usersIds),
                'content' => $faker->sentence,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->table('messages')->insert($data);
        }
    }

    
}
