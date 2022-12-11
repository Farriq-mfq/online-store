<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SessionEmoney extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "session_emoney_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            "method"=>[
                "type"=>"varchar",
                "constraint"=>5,
            ],
            "url"=>[
                "type"=>"varchar",
                "constraint"=>255,
            ],
            "user_id"=>[
                "type"=>"bigint",
            ],
            "expired"=>[
                "type"=>"datetime",
            ]
        ]);

        $this->forge->addKey("session_emoney_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","CASCADE","CASCADE");
        $this->forge->createTable("session_emoney");
    }
    
    public function down()
    {
        $this->forge->dropTable("session_emoney");
    }
}
