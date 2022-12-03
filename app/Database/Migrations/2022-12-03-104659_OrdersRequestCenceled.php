<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersRequestCenceled extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "order_cencel_request_id"=>[
                "type"=>"bigint",
                "auto_increment"=>true
            ],
            "content"=>[
                "type"=>"text"
            ],
            "order_id"=>[
                "type"=>"bigint"
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey("order_cencel_request_id",true);
        $this->forge->addForeignKey("order_id","orders","order_id","CASCADE","CASCADE");
        $this->forge->createTable("order_cencel_request");
    }
    
    public function down()
    {
        $this->forge->dropTable("order_cencel_request");
    }
}
