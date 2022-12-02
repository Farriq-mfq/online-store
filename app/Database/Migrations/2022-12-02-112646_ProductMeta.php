<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductMeta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'meta_id'=>[
                "type"=>"bigint",
                "auto_increment"=>true,
                // "unsigned"=>true,
            ],
            "key"=>[
                "type"=>"varchar",
                "constraint"=>30,
            ],
            "content"=>[
                "type"=>"text",
            ],
            "product_id"=>[
                "type"=>"bigint",
            ],

        ]);
        $this->forge->addKey('meta_id',true);
        // on to many to product
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable('product_meta');
    }

    public function down()
    {
        $this->forge->dropTable('product_meta');
    }
}
