<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductColors extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "color_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true

                ],
                "color"=>[
                    "type"=>"int"
                ],
                "stock"=>[
                    "type"=>"int"
                ],
                "product_id"=>[
                    "type"=>"bigint"
                ]
            ]
        );

        $this->forge->addKey("color_id",true);
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("product_colors");
    }

    public function down()
    {
        $this->forge->dropTable("product_colors");
    }
}
