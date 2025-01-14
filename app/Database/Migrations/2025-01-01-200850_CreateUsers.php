<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'unsigned'      => TRUE,
                'auto_increment'=> TRUE,
            ],
            'name' => [
                'type'          => 'TEXT',
                'constraint'    => 100,
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'        => 255,
                'null'          => FALSE,
            ],
            'pwhash' => [
                'type'          => 'VARCHAR',
                'constraint'        => 255,
                'null'          => FALSE
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'unique'        => TRUE
            ],
            'nonce' => [
                'type'          => 'VARCHAR',
                'constraint'        => 255,
                'null'          => FALSE
            ],
            'status' => [
                'type'          => 'BOOL',
                'default'       => 1
            ]
            // 'created' => [
            //     'type'          => 
            // ],
            // 'updated_at' => [
            //     'type'          => 'varchar',
            //     'null'          => TRUE,
            //     'on update'     => 'NOW()'
            // ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');    
    }

    public function down()
    {
        $this->forge->dropTable('blog');    
    }
}
