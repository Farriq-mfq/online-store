<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "category_id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "parent_category"=>[
                "type"=>"int",
                "null"=>true
            ],
            "category"=>[
                "type"=>"varchar",
                "constraint"=>30,
            ],
        ]);
        $this->forge->addKey("category_id",true);
        $this->forge->addForeignKey("parent_category","categories","category_id","SET NULL","SET NULL");
        $this->forge->createTable("categories");
    }
    
    public function down()
    {
        $this->forge->dropTable("categories");
    }
}
