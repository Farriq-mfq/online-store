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
            "email"=>[
                "type"=>"varchar",
                "constraint"=>50,
                "unique"=>true
            ],
            "password"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            "users_detail_id"=>[
                "type"=>"bigint",
            ],
            "role"=>[
                "type"=>"enum",
                "constraint"=>"'user','admin'",
                "default"=>"user"
            ]
        ]);
        $this->forge->addKey("user_id",true);
        $this->forge->createTable("users",true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
