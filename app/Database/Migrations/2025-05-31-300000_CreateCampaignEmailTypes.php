<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCampaignEmailTypes extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'campaign_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],  
            'email_type_id'    => [
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
        $this->forge->createTable('campaign_email_types'); 
    } 
    public function down()
    {
        $this->forge->dropTable('campaign_email_types');    
    }    
}           
