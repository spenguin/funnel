<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTypesModel extends Model
{
    protected $table = 'email_types';

    public function getEmailTypes($email_type_id = NULL)
    {
        if (is_null( $email_type_id )) {
            return $this->findAll();
        }
    
        return $this->where(['id' => $email_type_id])->first();
    }    
}