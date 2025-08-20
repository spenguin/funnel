<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCampaignEmails extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'campaign_id'   => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],
            'email_type_id'  => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],
            'subject'       => [
                'type'      => 'VARCHAR',
                'constraint'=> 255
            ],
            'body'          => [
                'type'      => 'TEXT'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('campaign_emails'); 
    } 
    public function down()
    {
        $this->forge->dropTable('campaign_emails');    
    }    
}           
