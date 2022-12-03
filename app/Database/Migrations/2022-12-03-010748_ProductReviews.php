<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductReviews extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "review_id"=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "review"=>[  
                "type"=>"text",
            ],
            "rating"=>[
                "type"=>"tinyint",
                "constraint"=>1
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
        $this->forge->addKey("review_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","NO ACTION","NO ACTION");
        $this->forge->addForeignKey("product_id","products","product_id","NO ACTION","NO ACTION");
        $this->forge->createTable("product_reviews");
    }
    
    public function down()
    {
        $this->forge->dropTable("product_reviews");
    }
}
