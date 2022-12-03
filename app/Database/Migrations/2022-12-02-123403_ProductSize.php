<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductSize extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "size_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true
                ],
                "size"=>[
                    "type"=>"int"
                ],
                "stock"=>[
                    "type"=>"int"
                ],
                "price"=>[
                    "type"=>"bigint"
                ],
                "product_id"=>[
                    "type"=>"bigint"
                ]
            ]
        );

        $this->forge->addKey("size_id",true);
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("product_size");
    }

    public function down()
    {
        $this->forge->dropTable("product_size");
    }
}
