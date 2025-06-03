<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomersCampaign extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'customer_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],  
            'campaign_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],                       
            'created_on timestamp default now()',
            'status'        => [
                'type'      => 'INT',
                'constraint'=> 2,
                'unsigned'  => TRUE,
                'default'   => 1
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('customer_campaign'); 
    } 
    public function down()
    {
        $this->forge->dropTable('customer_campaign');    
    }    
}           
