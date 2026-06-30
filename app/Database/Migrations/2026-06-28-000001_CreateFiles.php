<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFiles extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
           'file_type_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],    
           'campaign_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
            ],                     
            'name'       => [
                'type'      => 'VARCHAR',
                'constraint'=> 255
            ],
           'preceding_file_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'default'   => 0
            ],  
            'file_delay'        => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'default'   => 0
            ]           

        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('files'); 
    } 
    public function down()
    {
        $this->forge->dropTable('files');    
    }  
}