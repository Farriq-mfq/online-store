<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "role_id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "controller"=>[
                "type"=>"varchar",
                "constraint"=>200
            ],
            "method"=>[
                "type"=>"varchar",
                "constraint"=>200
            ],
            "admin_id"=>[
                "type"=>"bigint",
            ]
        ]);

        $this->forge->addKey("role_id",true);
        $this->forge->addForeignKey("admin_id","admin","admin_id","CASCADE","CASCADE");
        $this->forge->createTable("roles");
    }
    
    public function down()
    {
        $this->forge->dropTable("roles");
    }
}
