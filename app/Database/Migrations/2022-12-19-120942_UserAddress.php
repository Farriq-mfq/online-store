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
            ],
            "city" => [
                "type" => "int",
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
