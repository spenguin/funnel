<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignsModel extends Model
{
    protected $table = 'campaigns';
    // protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'slug', 'description', 'short_url', 'status', 'pledge_goal', 'pledge_count'];

    // protected $useTimestamps = false;
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function getCampaign($campaignId = NULL)
    {
        if (is_null($campaignId) ) {
            return $this->findAll();
        }
    
        return $this->where(['id' => $campaignId])->first();
    }    
}