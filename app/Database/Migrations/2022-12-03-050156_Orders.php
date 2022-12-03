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
            ],
            "token"=>[
                "type"=>"varchar",
                "constraint"=>30,
            ],
            "user_id"=>[
                "type"=>"bigint",
            ],
            "shipping"=>[
                "type"=> "bigint",
            ],
            "shipping_type"=>[
                "type"=>"bigint",
            ],
            "shipping_tracking"=>[
                "type"=>"bigint",
                "null"=>true
            ],
            "shipping_service"=>[
                "type"=>"varchar",
            ],
            "destination_origin"=>[
                "type"=>"varchar",
                "null"=>true
            ],
            "origin"=>[
                "type"=>"varchar",
                "null"=>true
            ],
            "status"=>[
                "type"=>"enum",
                "constraint"=>[
                    "PENDING",
                    "PROCESS",
                    "DONE"
                ],
                "default"=>"PENDING"
            ],
            "subtotal"=>[
                "type"=> "bigint",
            ],
        ]);
        $this->forge->addKey("order_id",true);
        $this->forge->createTable("order");
    }

    public function down()
    {
        //
    }
}
