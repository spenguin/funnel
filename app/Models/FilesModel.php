<?php

namespace App\Models;

use CodeIgniter\Model;

class FilesModel extends Model
{
    protected $table            = 'files';


    public function getFileByCampaignIdFileType( $campaignId, $fileTypeId )
    {
        return $this->where(['campaign_id' => $campaignId, 'file_type_id' => $fileTypeId])->first(); 
    }

}