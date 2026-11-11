<?php

namespace App\Models;

use CodeIgniter\Model;

class FilesModel extends Model
{
    protected $table            = 'files';

    protected $allowedFields = ['file_type_id', 'campaign_id', 'name'];


    public function getFileByCampaignIdFileType( $campaignId, $fileTypeId )
    {
        return $this->where(['campaign_id' => $campaignId, 'file_type_id' => $fileTypeId])->first(); 
    }

    public function getFilesByFileType( $fileTypeId = NULL )
    {
        if (is_null( $fileTypeId )) {
            return $this->findAll();
        }
    
        return $this->where(['file_type_id' => $fileTypeId])->findAll();
    }

    public function getFileByFileId( $fileId = NULL )
    {
        // if (is_null( $fileId )) {    // This should be treated as an error
        //     return $this->findAll();
        // }
    
        return $this->where(['id' => $fileId])->first();
    } 
    
    public function getFileByName( $name )
    {
        return $this->where(['name' => $name])->first();
    }

    public function getNextFileByCampaignIdAndFileId( $campaignId, $fileId )
    {
        return $this->where( ['campaign_id'=>$campaignId, 'preceding_file_id'=>$fileId])->first();
    }

}