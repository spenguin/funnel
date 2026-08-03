<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FileTypesSeeder extends Seeder
{
    public function run()
    {
        $data   = [
            ['name' => 'Signup Page'],
            ['name' => 'Landing Page'],
            ['name' => 'Pledge Page'],
            ['name' => 'Email'],
            ['name' => 'Email Not Following']
        ];
        if (count($data) == count($data, COUNT_RECURSIVE)) 
        {
            $this->db->table('files_types')->insert($data);
        }
        else
        {
            foreach( $data as $d )
            {
                $this->db->table('file_types')->insert($d);
            }
        }
    }
}