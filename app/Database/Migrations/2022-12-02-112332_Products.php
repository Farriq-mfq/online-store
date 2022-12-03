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
                "unique"=>true
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
                "type"=>"double",
                "null"=>true
            ],
            // one to many
            "product_categorie_id"=>[
                "type"=>"int",
            ],
            "price"=>[
                "type"=>"bigint",
            ],
            "weight"=>[  
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
            "product_brand_id"=>[
                "type"=>"int",
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('product_id',true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
