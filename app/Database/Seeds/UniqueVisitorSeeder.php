<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UniqueVisitorSeeder extends Seeder
{
    protected function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
    public function run()
    {
        for ($i = 0; $i < 11; $i++) {
            $this->db->table('unique_visitor')->insert(['ip' => "132ds212.44.145." . $i,'created_at'=>$this->randomDate("2021-03-23","2021-04-30")]);
        }
    }
}
