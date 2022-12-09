<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'image_id'=>[
                "type"=>"int",
                "auto_increment"=>true,
            ],
            "image"=>[
                "type"=>"varchar",
                "constraint"=>150,
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>150,
            ],
            "mime"=>[
                "type"=>"varchar",
                "constraint"=>20,
            ],
            "is_primary"=>[
                "type"=>"boolean",
                "default"=>false
            ],
            "product_id"=>[
                "type"=>"bigint",
            ]
        ]);
        $this->forge->addKey("image_id",true);
        // on to many to product
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable('product_images');
    }

    public function down()
    {
        $this->forge->dropTable('product_images');
    }
}
