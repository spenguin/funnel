<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';

    public function getCustomerByEmail($email = NULL)
    {
        if (is_null($email) ) {
            return NULL;
        }
    
        return $this->where(['email'=>$email])->first();
    }     

}