<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FileTypesSeeder extends Seeder
{
    public function run()
    {
        $data   = [
            ['name' => 'Landing Page'],
            ['name' => 'Signup Thank You Page'],
            ['name' => 'Pledge Page'],
            ['name' => 'Pledge Thank You Page'],
            ['name' => 'Email']
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