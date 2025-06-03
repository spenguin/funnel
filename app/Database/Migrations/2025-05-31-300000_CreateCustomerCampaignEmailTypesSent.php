<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerCampaignEmailTypesSent extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'customer_campaign_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],
            'email_type_id'  => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],
            'sent_on timestamp default now()',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('customer_campaign_email_types_sent'); 
    } 
    public function down()
    {
        $this->forge->dropTable('customer_campaign_email_types_sent');    
    }    
}           
