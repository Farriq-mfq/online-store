<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "user_id"=>[
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
        $this->forge->addKey("user_id",true);
        $this->forge->createTable("users",true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
