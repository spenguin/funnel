<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmailTypes extends Migration
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
            ],
            'delay'  => [
                'type'      => 'INT',
                'constraint'=> 2,
                'null'      => TRUE
            ],
            'follows'   => [
                'type'  => 'INT',
                'unsigned'  => TRUE
            ],
            'paid_status'   => [
                'type'          => 'BOOL',
                'default'       => 0
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('email_types'); 
    } 
    public function down()
    {
        $this->forge->dropTable('email_types');    
    }    
}           
