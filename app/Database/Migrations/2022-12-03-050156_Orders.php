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
            "shipping_provider"=>[
                "type"=>"varchar",
                "constraint"=>100
            ],
            "shipping_tracking"=>[
                "type"=>"varchar",
                "constraint"=>100,
                "null"=>true
            ],
            "shipping_service"=>[
                "type"=>"varchar",
                "constraint"=>30,
            ],
            "origin"=>[
                "type"=>"int",
                "null"=>true
            ],
            "destination_origin"=>[
                "type"=>"int",
                "null"=>true
            ],
            "status"=>[
                "type"=>"enum",
                "constraint"=>[
                    "WAITING",
                    "PROCESS",
                    "SHIPPED",
                    "DONE",
                    "REJECT"
                ],
                "default"=>"WAITING"
            ],
            "discount"=>[
                "type"=> "double",
                "null"=>true
            ],
            "is_cencel"=>[
                "type"=> "boolean",
                "default"=>false
            ],
            "notes"=>[
                "type"=> "text",
                "null"=>true
            ],
            "subtotal"=>[
                "type"=> "bigint",
            ],
            "user_address_id"=>[
                "type"=>"int"
            ],
            'created_at datetime default current_timestamp',
            'deleted_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
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
