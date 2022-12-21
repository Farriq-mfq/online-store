<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAddress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "user_address_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "firstname" => [
                "type" => "varchar",
                "constraint" => 150
            ],
            "lastname" => [
                "type" => "varchar",
                "constraint" => 150
            ],
            "phone" => [
                "type" => "varchar",
                "constraint" => 14
            ],
            "address1" => [
                "type" => "text",
            ],
            "address2" => [
                "type" => "text",
                "null"=>true
            ],
            "province" => [
                "type" => "int",
            ],
            "city" => [
                "type" => "int",
            ],
            "postcode_zip" => [
                "type" => "int",
            ],
            "address_notes"=>[
                "type"=>"text"
            ],
            "user_id"=>[
                "type"=>"bigint"
            ],
        ]);

        $this->forge->addKey("user_address_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","CASCADE","CASCADE");
        $this->forge->createTable("user_address");
    }

    public function down()
    {
        $this->forge->dropTable("user_address");
    }
}
