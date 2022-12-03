<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "order_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true,
            ],
            "midtrans_id"=>[
                "type"=>"varchar",
                "constraint"=>100,
                "unique"=>true
            ],
            "token"=>[
                "type"=>"varchar",
                "constraint"=>30,
                "unique"=>true
            ],
            "user_id"=>[
                "type"=>"bigint",
            ],
            "shipping"=>[
                "type"=> "bigint",
            ],
            "shipping_type"=>[
                "type"=>"varchar",
                "constraint"=>20
            ],
            "shipping_tracking"=>[
                "type"=>"bigint",
                "null"=>true
            ],
            "shipping_service"=>[
                "type"=>"varchar",
                "constraint"=>30,
            ],
            "origin"=>[
                "type"=>"varchar",
                "constraint"=>30,
                "null"=>true
            ],
            "destination_origin"=>[
                "type"=>"varchar",
                "constraint"=>30,
                "null"=>true
            ],
            "status"=>[
                "type"=>"enum",
                "constraint"=>[
                    "PENDING",
                    "PROCESS",
                    "DONE",
                    "REJECT"
                ],
                "default"=>"PENDING"
            ],
            "discount"=>[
                "type"=> "double",
                "null"=>true
            ],
            "notes"=>[
                "type"=> "text",
                "null"=>true
            ],
            "subtotal"=>[
                "type"=> "bigint",
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey("order_id",true);
        $this->forge->addForeignKey("user_id","users","user_id","CASCADE","CASCADE");
        $this->forge->createTable("orders");
    }
    
    public function down()
    {
        $this->forge->dropTable("orders");
    }
}
