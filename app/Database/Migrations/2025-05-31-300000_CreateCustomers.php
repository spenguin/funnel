<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomers extends Migration
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
            'email'  => [
                'type'      => 'TEXT',
                'null'      => false
            ],
            'token' => [
                'type'          => 'VARCHAR',
                'constraint'        => 255,
                'null'          => FALSE
            ],
            'created timestamp default now()',
            'status'        => [
                'type'      => 'INT',
                'constraint'=> 2,
                'unsigned'  => TRUE,
                'default'   => 1
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('customers'); 
    } 
    public function down()
    {
        $this->forge->dropTable('customers');    
    }    
}           
