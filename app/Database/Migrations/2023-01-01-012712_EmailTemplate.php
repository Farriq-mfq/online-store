<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailTemplate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'template_id' => [
                'type' => 'int',
                'auto_increment' => true
            ],
            'from_name' => [
                'type' => 'varchar',
                'constraint' => 150
            ],
            'from_email' => [
                'type' => 'varchar',
                'constraint' => 150
            ],
            'recipients' => [
                'type' => 'varchar',
                'constraint' => 150
            ],
            'content' => [
                'type' => 'text'
            ],
            'type' => [
                'type' => 'enum',
                'constraint' => [
                    'RESET_PASSWORD_USER',
                    "ORDER_RECEIVED",
                    "ORDER_PROCESS",
                    "ORDER_SHIPPED",
                    "ORDER_DONE",
                    "CONFIRM_EMAIL_USER",
                    "CONFIRM_EMAIL_ADMIN",
                    "PROMO"
                ],
                'unique' => true
            ]
        ]);

        $this->forge->addKey('template_id', true);
        $this->forge->createTable('email_template');
    }

    public function down()
    {
        $this->forge->dropTable('email_template');
    }
}
