<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsComments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "comment_id"=>[
                "type"=>"int",  
                "auto_increment"=>true

            ],
            "replay_id"=>[  
                "type"=>"int",
            ],
            "comment"=>[
                "type"=>"text"
            ],
            "user_id"=>[
                "type"=>"bigint",
            ],
            "product_id"=>[
                "type"=>"bigint",
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey("comment_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","NO ACTION","NO ACTION");
        $this->forge->addForeignKey("product_id","products","product_id","NO ACTION","NO ACTION");
        $this->forge->createTable("comments");
    }
    
    public function down()
    {
        $this->forge->dropTable("comments");
    }
}
