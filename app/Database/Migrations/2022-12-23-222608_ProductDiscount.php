<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductDiscount extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "discount_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "discount_type" => [
                "type"=>"enum",
                "constraint"=>[
                    "PERCENTAGE",
                    "VALUE",
                ],
                "default"=>"PERCENTAGE"
            ],
            "discount_value" => [
                "type" => "double",
            ],
            "product_id" => [
                "type" => "bigint",
            ],
        ]);
        $this->forge->addKey("discount_id", true);
        $this->forge->addForeignKey("product_id", "products", "product_id", "CASCADE", "CASCADE");
        $this->forge->createTable("product_discount");
    }

    public function down()
    {
        $this->forge->dropTable("product_discount");
    }
}
