<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';

    protected $allowedFields = ['name', 'email', 'token'];

    public function getCustomerByEmail($email = NULL)
    {
        if (is_null($email) ) {
            return NULL;
        }
    
        return $this->where(['email'=>$email])->first();
    } 
    
    public function getCustomerByToken($token = NULL)
    {
        if (is_null($token) ) {
            return NULL;
        }
    
        return $this->where(['token'=>$token])->first();        
    }

}