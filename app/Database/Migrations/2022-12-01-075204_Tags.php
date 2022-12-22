<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tags extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "tag_id" => [
                    "type" => "int",
                    "auto_increment" => true
                ],
                "tag" => [
                    "type" => "varchar",
                    "constraint" => 50
                ],
            ]
        );
        $this->forge->addKey("tag_id", true);
        $this->forge->createTable("tags");
    }
    
    public function down()
    {
        $this->forge->dropTable("tags");
    }
}
