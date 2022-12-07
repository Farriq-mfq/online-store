<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductBrands extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "brand_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true
                ],
                "brand"=>[
                    "type"=>"varchar",
                    "constraint"=>50
                ],
            ]
        );
        $this->forge->addKey("brand_id",true);
        $this->forge->createTable("brands");
    }

    public function down()
    {
        $this->forge->dropTable("brands");
    }
}
