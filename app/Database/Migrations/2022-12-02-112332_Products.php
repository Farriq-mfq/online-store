<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id'=>[
                "type"=>"bigint",
                "auto_increment"=>true,
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>150,
            ],
            "slug"=>[
                "type"=>"varchar",
                "constraint"=>150,
            ],
            "description"=>[
                "type"=>"text",
            ],
            "short_description"=>[
                "type"=>"varchar",
                "constraint"=>255,
                "null"=>true
            ],
            // "discount"=>[
            //     "type"=>"double",
            //     "null"=>true
            // ],
            "category_id"=>[
                "type"=>"int",
                "null"=>true
            ],
            "price"=>[
                "type"=>"bigint",
            ],
            "weight"=>[  
                "type"=>"int",
            ],
            "featured"=>[
                "type"=>"boolean",
                "default"=>false
            ],
            "new_label"=>[
                "type"=>"boolean",
                "default"=>false
            ],
            "content"=>[
                "type"=>"text",
            ],
            "status"=>[
                "type"=>"boolean"
            ],
            "stock"=>[
                "type"=>"int"
            ],
            "sku"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "brand_id"=>[
                "type"=>"int",
                "null"=>true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime',
        ]);

        $this->forge->addKey('product_id',true);
        $this->forge->addForeignKey("brand_id","brands","brand_id","SET NULL","SET NULL");
        $this->forge->addForeignKey("category_id","categories","category_id","SET NULL","SET NULL");
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
