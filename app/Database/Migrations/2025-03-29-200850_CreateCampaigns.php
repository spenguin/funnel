<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCampaigns extends Migration
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
            'slug'  => [
                'type'      => 'TEXT',
                'constraint'=> 100,
                'null'      => FALSE
            ],
            'description'   => [
                'type'      => 'TEXT',
                'null'      => TRUE
            ],
            'sample_url'    => [
                'type'      => 'TEXT',
                'null'      => TRUE
            ],
            'createdAt timestamp default now()',
            'updatedAt timestamp default now() on update now()',
            'status'        => [
                'type'      => 'INT',
                'constraint'=> 2
            ],
            'pledge_goal'   => [
                'type'      => 'INT',
                'constraint'=> 3,
                'default'   => 0
            ],
            'pledge_count'   => [
                'type'      => 'INT',
                'constraint'=> 3,
                'default'   => 0
            ]            
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('campaigns');         
    }
    public function down()
    {
        $this->forge->dropTable('campaigns');    
    }
}
  