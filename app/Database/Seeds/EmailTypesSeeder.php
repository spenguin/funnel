<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmailTypesSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     'name'      => 'John',
        //     'username'  => 'admin',
        //     'pwhash'    => sha1('admin' . getenv('salt')),
        //     'email'     => 'info@weirdspace.com'
        // ];
        $data   = [
            [
                'name'  => 'Thank you; Further Offer',
                'delay' => 0,
                'follows'=> 0,
                'paid_status'   => 0
            ],
            [
                'name'  => 'Non-VIP Followup Email 1',
                'delay' => 2,
                'follows' => 0,
                'paid_status'   => 0                
            ],
            [
                'name'  => 'Non-VIP Followup Email 2',
                'delay' => 2,
                'follows' => 1,
                'paid_status'   => 0                 
            ],
            [
                'name'  => 'Non-VIP Followup Email 3',
                'delay' => 3,
                'follows' => 2,
                'paid_status'   => 0                 
            ],
            [
                'name'  => 'VIP Email; Fb link',
                'delay' => 0,
                'follows' => 0,
                'paid_status'   => 1                 
            ],
            [
                'name'  => 'VIP Followup Email 1',
                'delay' => 2,
                'follows' => 4,
                'paid_status'   => 1                 
            ],   
            [
                'name'  => 'VIP Followup Email 2',
                'delay' => 2,
                'follows' => 5,
                'paid_status'   => 1                 
            ], 
            [
                'name'  => 'VIP Followup Email 3',
                'delay' => 3,
                'follows' => 6,
                'paid_status'   => 1                 
            ]                                                                                 
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);
        if (count($data) == count($data, COUNT_RECURSIVE)) 
        {
            $this->db->table('email_types')->insert($data);
        }
        else
        {
            foreach( $data as $d )
            {
                $this->db->table('email_types')->insert($d);
            }
        }
                // Using Query Builder
        
    }
}