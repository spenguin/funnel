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
                'constraint'    => '100',
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'null'          => FALSE,
            ],
            'pwhash' => [
                'type'          => 'VARCHAR',
                'null'          => FALSE
            ],
            'nonce' => [
                'type'          => 'VARCHAR',
                'null'          => FALSE
            ],
            // 'created' => [
            //     'type'          => 
            // ],
            'updated_at' => [
                'type'          => 'varchar',
                'null'          => TRUE,
                'on update'     => 'NOW()'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');    }

    public function down()
    {
        $this->forge->dropTable('blog');    
    }
}
