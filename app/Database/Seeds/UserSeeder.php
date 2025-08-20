<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'      => 'John',
            'username'  => 'admin',
            'pwhash'    => sha1('admin' . getenv('salt')),
            'email'     => 'info@weirdspace.com'
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}