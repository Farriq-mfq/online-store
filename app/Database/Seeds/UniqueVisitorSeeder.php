<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UniqueVisitorSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 200; $i++) {
            $this->db->table('unique_visitor')->insert(['ip' => "18.44.45." . $i]);
        }
    }
}
