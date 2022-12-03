<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "categorie_id"=>[
                "type"=>"int",
                "auto_increment"=>true

            ],
            "parent_categorie"=>[
                "type"=>"int",
            ],
            "categorie"=>[
                "type"=>"varhcar",
                "constraint"=>30
            ],
        ]);
        $this->forge->addKey("categorie_id",true);
        $this->forge->createTable("categories");
    }
    
    public function down()
    {
        $this->forge->dropTable("categories");
    }
}
