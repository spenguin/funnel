<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignsModel extends Model
{
    protected $table = 'campaigns';
    // protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'slug', 'description', 'sample_url', 'status', 'pledge_goal', 'pledge_count'];

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

    public function getCampaignBySlug($campaignSlug = NULL)
    {
        if (is_null($campaignSlug) ) {
            return NULL;
        }

        return $this->where(['slug'=>$campaignSlug])->first();
    }
    
    
    // public function upsert( $id, $data )
    // {die($id);
    //     if( !empty($id) )
    //     {
    //         $record = $this->where(['id' => $campaignId])->first(); 
    //         $record->update( $id, $data );
    //     }
    //     else 
    //     {
    //         $this->insert( $data );
    //     }
    // }
}