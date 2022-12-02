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
                "constraint"=>30,
            ],
            "slug"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            "description"=>[
                "type"=>"text",
            ],
            "short_description"=>[
                "type"=>"varchar",
                "constraint"=>100,
                "null"=>true
            ],
            "discount"=>[
                "type"=>"varchar",
                "constraint"=>100,
                "null"=>true
            ],
            // one to many
            "product_categories_id"=>[
                "type"=>"bigint",
            ],
            "price"=>[
                "type"=>"bigint",
            ],
            "stock"=>[
                "type"=>"int",
            ],
            "feature"=>[
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
            // one to many
            "product_discount_id"=>[
                "type"=>"bigint",
                "null"=>true
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('product_id');
        $this->forge->createTable('products',true);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
