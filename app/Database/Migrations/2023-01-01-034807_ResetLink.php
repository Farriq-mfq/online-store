<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResetLink extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                "reset_id" => [
                    "type" => "int",
                    "auto_increment" => true
                ],
                "code" => [
                    "type" => "varchar",
                    "constraint" => 150
                ],
                'expired' => [
                    'type' => 'datetime',
                ],
                'type' => [
                    'type' => 'enum',
                    'constraint' => [
                        'RESET_PASSWORD_USER',
                        "CONFIRM_EMAIL_USER",
                        "CONFIRM_EMAIL_ADMIN",
                    ],
                ],
                "user_id" => [
                    "type" => "bigint",
                ],
            ]
        );
        $this->forge->addKey("reset_id", true);
        $this->forge->addForeignKey('user_id', "users", "user_id", "CASCADE", "CASCADE");
        $this->forge->createTable("reset_link");
    }

    public function down()
    {
        $this->forge->dropTable("reset_link");
    }
}
