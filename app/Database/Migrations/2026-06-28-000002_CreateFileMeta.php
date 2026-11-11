<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFileMeta extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE,
                'auto_increment'    => TRUE
            ],
            'file_id'    => [
                'type'      => 'INT',
                'unsigned'  => TRUE
            ],            
            'meta_name'       => [
                'type'      => 'VARCHAR',
                'constraint'=> 255
            ],
            'meta_value'       => [
                'type'      => 'VARCHAR',
                'constraint'=> 255
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('file_meta'); 
    } 
    public function down()
    {
        $this->forge->dropTable('file_meta');    
    }  
}