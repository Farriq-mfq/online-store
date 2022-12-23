<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Banner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "banner_id" => [
                "type" => "int",
                "auto_increment" => true
            ],
            "image" => [
                "type" => "varchar",
                "constraint" => 150,
            ],
            "image_name" => [
                "type" => "varchar",
                "constraint" => 150
            ],
            "banner_location" => [
                "type" => "enum",
                "constraint" => [
                    "BOTTOM_SLIDER",
                    "BOTTOM_OFFER",
                    "LONG_BANNER"
                ],
                "default" => "BOTTOM_SLIDER"
            ],
            "title"=>[
                "type" => "varchar",
                "constraint" => 150,
                "null"=>true
            ],
            "paragraph"=>[
                "type" => "varchar",
                "constraint" => 200,
                "null"=>true
            ],
            "link_label"=>[
                "type" => "varchar",
                "constraint" => 20,
                "null"=>true
            ],
            "link" => [
                "type" => "varchar",
                "constraint" => 150
            ],
        ]);
        $this->forge->addKey("banner_id", true);
        $this->forge->createTable("banners");
    }

    public function down()
    {
        $this->forge->dropTable("banners");
    }
}
