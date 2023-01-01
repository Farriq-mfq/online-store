<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Smtp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'protocol' => [
                'type' => 'varchar',
                'constraint' => 50,
                "null" => true
            ],
            'host' => [
                'type' => 'varchar',
                'constraint' => 200,
                "null" => true
            ],
            'user' => [
                'type' => 'varchar',
                'constraint' => 200,
                "null" => true
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 200,
                "null" => true
            ],
            'port' => [
                'type' => 'int',
                "null" => true
            ],
            'crypto' => [
                'type' => 'varchar',
                'constraint' => 50,
                "null" => true
            ],
            'type' => [
                'type' => 'enum',
                "constraint" => [
                    "text",
                    "html",
                ],
                "default" => "text"
            ],
            'useragent' => [
                'type' => 'varchar',
                'constraint' => 200,
                "null" => true
            ],
        ]);

        $this->forge->createTable('smtp');
    }

    public function down()
    {
        $this->forge->dropTable('smtp');
    }
}
