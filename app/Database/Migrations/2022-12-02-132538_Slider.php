<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slider extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "slider_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true,
            ],
            "image"=>[
                "type"=>"varchar",
                "constraint"=>50,
                "unique"=>true
            ],
            "title"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            "short_description"=>[
                "type"=>"varchar",
                "constraint"=>100,
            ],
            "link_label"=>[
                "type"=>"varchar",
                "constraint"=>20,
            ],
            "link"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ]
        ]);
        $this->forge->addKey("slider_id",true);
        $this->forge->createTable("sliders");
    }

    public function down()
    {
        $this->forge->dropTable("sliders");
    }
}
