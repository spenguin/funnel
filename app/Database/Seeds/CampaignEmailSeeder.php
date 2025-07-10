<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CampaignEmailSeeder extends Seeder
{
    public function run()
    {

        $data   = [
            [
                'campaign_id'   => 1,
                'email_type_id' => 1,
                'subject'   => "Your Preview of %s",
                'body'      => "<p>I'm delighted to give you a glimpse of my upcoming book, %s, available at the following link: %s</p><p>When the campaign has begun, I'll email again to let you know. Kind regards, John Anderson Soaring Penguin Press</p>"
            ]
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);
        if (count($data) == count($data, COUNT_RECURSIVE)) 
        {
            $this->db->table('campaign_emails')->insert($data);
        }
        else
        {
            foreach( $data as $d )
            {
                $this->db->table('campaign_emails')->insert($d);
            }
        }
                // Using Query Builder
        
    }
}