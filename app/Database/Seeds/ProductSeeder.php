<?php

namespace App\Database\Seeds;

use App\Models\Product;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i <10 ; $i++) { 
            $title = $faker->text(20);
            $data = [
                "title"=>$title,
                "slug"=>url_title($title),
                "description"=>$faker->text(150),
                "short_description"=>$faker->text(50),
                "category_id"=> mt_rand(1,9),
                "price"=>$faker->randomDigit(),
                "weight"=>$faker->randomDigit(),
                "featured"=>true,
                "new_label"=>false,
                "content"=>"hallo bang",
                "status"=>false,
                "sku"=>$faker->randomDigit(),
                "sku"=>1,
            ];
    
            $this->db->table("products")->insert($data);
        }
        
    }
}
