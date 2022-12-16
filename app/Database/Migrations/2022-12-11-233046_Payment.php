<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id'=>[
                "type"=>"int",
                "auto_increment"=>true
            ],
            "key"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            "value"=>[
                "type"=>"varchar",
                "constraint"=>50,
            ],
            'payment_provider_id'=>[
                "type"=>"int",
            ],
        ]); 

        $this->forge->addKey("payment_id",true);
        $this->forge->addForeignKey("payment_provider_id","payment_provider","payment_provider_id","CASCADE","CASCADE");
        $this->forge->createTable("payment");
    }
    
    public function down()
    {
        $this->forge->dropTable("payment");
    }
}
