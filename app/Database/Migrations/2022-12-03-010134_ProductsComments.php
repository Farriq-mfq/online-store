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
                "null"=>true
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
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey("comment_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","CASCADE","CASCADE");
        $this->forge->addForeignKey("product_id","products","product_id","CASCADE","CASCADE");
        $this->forge->addForeignKey("replay_id","product_comments","comment_id","SET NULL","SET NULL");
        $this->forge->createTable("product_comments");
    }
    
    public function down()
    {
        $this->forge->dropTable("product_comments");
    }
}
