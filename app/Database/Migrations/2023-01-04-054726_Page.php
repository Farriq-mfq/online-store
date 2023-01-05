<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Page extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "page_id" => [
                    "type" => "int",
                    "auto_increment" => true
                ],
                "page_title" => [
                    "type" => "varchar",
                    "constraint" => 100
                ],
                "path" => [
                    "type" => "varchar",
                    "constraint" => 100
                ],
                "status" => [
                    "type" => "boolean",
                    "default" => false
                ],
                "content" => [
                    "type" => "text",
                ],
            ]
        );
        $this->forge->addKey("page_id", true);
        $this->forge->createTable("pages");
    }

    public function down()
    {
        $this->forge->dropTable("pages");
    }
}
