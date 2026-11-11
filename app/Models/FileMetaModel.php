<?php

namespace App\Models;

use CodeIgniter\Model;

class FileMetaModel extends Model
{
    protected $table            = 'file_meta';

    protected $allowedFields = ['file_id', 'meta_name', 'meta_value'];

    public function getMetaValueByFileIdAndMetaName( $fileId, $metaName )
    {
        return $this->where(['file_id'=>$fileId,'meta_name'=>$metaName])->first();
    }

}