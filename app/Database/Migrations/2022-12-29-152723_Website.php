<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Website extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'title_separator' => [
                'type' => "varchar",
                "constraint" => 50,
                'null' => true
            ],
            "logo" => [
                'type' => "varchar",
                "constraint" => 255,
                'null' => true
            ],
            "favicon" => [
                'type' => "varchar",
                "constraint" => 100,
                'null' => true
            ],
            "favicon_name" => [
                'type' => "varchar",
                "constraint" => 255,
                'null' => true
            ],
            "logo_name" => [
                'type' => "varchar",
                "constraint" => 100,
                'null' => true
            ],
            'support_content' => [
                'type' => "text",
                'null' => true
            ],
            'information_content' => [
                'type' => "text",
                'null' => true
            ],
            'extras_content' => [
                'type' => "text",
                'null' => true
            ],
            'footer_content' => [
                'type' => "text",
                'null' => true
            ],
            'company_address' => [
                'type' => 'text',
                'null' => true
            ],
            'company_phone' => [
                'type' => 'int',
                'null' => true
            ],
            'company_email' => [
                'type' => 'varchar',
                "constraint" => 150,
                'null' => true
            ],
            'shipping_origin' => [
                'type' => 'int',
                'null' => true
            ],
        ]);
        $this->forge->createTable("website");
    }

    public function down()
    {
        $this->forge->dropTable("website");
    }
}
