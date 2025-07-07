<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCampaignCustomers extends Migration
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
            'created timestamp default now()',
            'paid'          => [
                'type'      => 'TIMESTAMP'
            ],
            'campaign_email_sent'   => [
                'type'      => 'INT'
            ],
            'campaign_email_sent_date'  => [
                'type'      => 'TIMESTAMP'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('campaign_customers'); 
    } 
    public function down()
    {
        $this->forge->dropTable('campaign_customers');    
    }    
}           
