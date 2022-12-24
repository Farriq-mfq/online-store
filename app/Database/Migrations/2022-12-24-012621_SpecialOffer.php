<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SpecialOffer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "offer_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "offer_start" => [
                "type" => "datetime"
            ],
            "offer_end" => [
                "type" => "datetime",
            ],
            "product_id" => [
                "type" => "bigint",
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey("offer_id", true);
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->createTable("offers");
    }
    
    public function down()
    {
        $this->forge->dropTable("offers");
    }
}
