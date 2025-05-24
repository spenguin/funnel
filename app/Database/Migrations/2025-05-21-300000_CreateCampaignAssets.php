<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CampaignAssets extends Migration
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
            'asset_type_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],                      
            'name'  => [
                'type'      => 'TEXT',
                'constraint'=> 100,
                'null'      => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('campaign_assets'); 
    } 
    public function down()
    {
        $this->forge->dropTable('campaign_assets');    
    }    
}           
