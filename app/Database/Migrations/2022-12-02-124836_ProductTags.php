<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductTags extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "tag_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true

                ],
                "tag"=>[
                    "type"=>"int"
                ],
                "product_id"=>[
                    "type"=>"bigint"
                ]
            ]
        );

        $this->forge->addKey("tag_id",true);
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("product_tags");
    }
    
    public function down()
    {
        $this->forge->dropTable("product_tags");
    }
}
