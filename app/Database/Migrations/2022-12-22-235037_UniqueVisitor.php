<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UniqueVisitor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "visit_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "ip" => [
                "type" => "varchar",
                "constraint" => 50,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey("visit_id", true);
        $this->forge->createTable("unique_visitor");
    }

    public function down()
    {
        $this->forge->dropTable("unique_visitor");
    }
}
