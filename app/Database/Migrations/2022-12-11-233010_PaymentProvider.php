<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentProvider extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_provider_id'=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "provider"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
        ]); 

        $this->forge->addKey("payment_provider_id",true);
        $this->forge->createTable("payment_provider");
    }
    
    public function down()
    {
        $this->forge->dropTable("payment_provider");
    }
}
