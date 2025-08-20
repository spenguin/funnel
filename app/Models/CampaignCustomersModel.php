<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignCustomersModel extends Model
{
    protected $table = 'campaign_customers';

    protected $allowedFields = ['customer_id', 'campaign_id', 'paid', 'campaign_email_sent', 'campaign_email_sent_date'];

}