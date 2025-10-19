<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignEmailTypesModel extends Model
{
    protected $table = 'campaign_email_types';

    protected $allowedFields = ['email_type_id', 'campaign_id'];
   
}