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
        for ($i = 0; $i < 111111; $i++) {
            $this->db->table('unique_visitor')->insert(['ip' => "102da232ds212.44.145." . $i,'created_at'=>$this->randomDate("2022-12-23","2022-12-30")]);
        }
    }
}
