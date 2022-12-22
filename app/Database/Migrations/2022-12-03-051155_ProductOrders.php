<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductOrders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "order_items_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true
            ],
            "order_id"=>[
                "type"=>"bigint",
            ],
            "product_id"=>[
                "type"=>"bigint",
            ],
            "quantity"=>[
                "type"=>"int",
            ],
            "discount"=>[
                "type"=> "double",
                "null"=>true
            ],
            "total"=>[
                "type"=>"bigint",
            ],
        ]);
        $this->forge->addKey("order_items_id",true);
        $this->forge->addForeignKey("order_id","orders","order_id","CASCADE","CASCADE");
        $this->forge->createTable("order_items");
    }

    public function down()
    {
        $this->forge->dropTable("order_items");
    }
}
