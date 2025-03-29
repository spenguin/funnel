<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    // protected $primaryKey       = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;

    // protected $allowedFields    = ['username', 'email', 'pwhash', 'nonce'];

    /**
     *  Validate the user. If TRUE, add user data  Session variables
     *  @return TRUE or FALSE
     */
        public function validateLogin()
	{	
        $_request = \Config\Services::request();
        
        $username   = $_request->getPost('username');
        $password   = $_request->getPost('password');
        $pwhash     = sha1( $password . getenv('salt') );
        $user       = $this->where(['username' => $username, 'pwhash' => $pwhash])->first(); var_dump( $user);
        if( empty($user) ) return FALSE;
        $this->session = \Config\Services::session(); 

        $this->session->set('name',$user['name']);
        $this->session->set('logged', TRUE );
        $this->session->set('userId', $user['id'] );

        return TRUE;

	}    
}