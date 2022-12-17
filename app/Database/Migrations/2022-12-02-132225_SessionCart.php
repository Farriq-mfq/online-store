<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SessionCart extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "session_cart_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true
                ],
                "user_id"=>[
                    "type"=>"bigint"
                ],
                "product_id"=>[
                    "type"=>"bigint"
                ],
                "product_inventories_id"=>[
                    "type"=>"int",
                    "null"=>true
                ],
                "content"=>[
                    "type"=>"text",
                    "null"=>true
                ],
                "discount"=>[
                    "type"=>"double",
                    "null"=>true
                ],
                "quantity"=>[
                    "type"=>"int"
                ],
                "price"=>[
                    "type"=>"bigint"
                ],
                "total"=>[
                    "type"=>"bigint"
                ],
            ]
        );

        $this->forge->addKey("session_cart_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","CASCADE","CASCADE");
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->addForeignKey("product_inventories_id","product_inventories","inventory_id","NULL","NULL");
        $this->forge->createTable("session_cart");
        
    }
    
    public function down()
    {
        $this->forge->dropTable("session_cart");
    }
}
