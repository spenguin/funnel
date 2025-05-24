<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssetTypes extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'name'  => [
                'type'      => 'TEXT',
                'constraint'=> 100,
                'null'      => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('asset_types'); 
    } 
    public function down()
    {
        $this->forge->dropTable('asset_types');    
    }    
}           
