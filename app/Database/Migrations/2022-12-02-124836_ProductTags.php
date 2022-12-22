<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductTags extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "products_tags_id" => [
                    "type" => "int",
                    "auto_increment" => true
                ],
                "tag_id" => [
                    "type" => "int",
                    "null"=>true
                ],
                'product_id' => [
                    "type" => "bigint",
                ],
            ]
        );

        $this->forge->addKey("products_tags_id", true);
        $this->forge->addForeignKey("tag_id","tags","tag_id","SET NULL","SET NULL");
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("product_tags");
    }

    public function down()
    {
        $this->forge->dropTable("product_tags");
    }
}
