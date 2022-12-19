<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "admin_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true
            ],
            "name"=>[
                "type"=>"varchar",
                "constraint"=>150,
            ],
            "email"=>[
                "type"=>"varchar",
                "constraint"=>150,
                "unique"=>true
            ],
            "password"=>[
                "type"=>"varchar",
                "constraint"=>255,
            ],
        ]);
        $this->forge->addKey("admin_id",true);
        $this->forge->createTable("admin");
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
