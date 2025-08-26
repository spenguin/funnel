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

    public function organiseEmailTypes()
    {
        $email_types    = $this->findAll();
        $o      = [];

        foreach( $email_types as $email_type )
        {
            $o[$email_type['id']] = $email_type['name'];
        }

        return $o;
    }

}