<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductInventory extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "inventory_id"=>[
                    "type"=>"int",
                    "auto_increment"=>true
                ],
                "size"=>[
                    "type"=>"int"
                ],
                "stock"=>[
                    "type"=>"int"
                ],
                "color"=>[
                    "type"=>"varchar",
                    "constraint"=>30
                ],
                "sku"=>[
                    "type"=>"varchar",
                    "constraint"=>30
                ],
                "price"=>[
                    "type"=>"bigint"
                ],
                "product_id"=>[
                    "type"=>"bigint"
                ],
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp on update current_timestamp'
            ]
        );

        $this->forge->addKey("inventory_id",true);
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("product_inventories");
    }

    public function down()
    {
        $this->forge->dropTable("product_inventories");
    }
}
