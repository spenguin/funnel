<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    
    public function __construct()
    {
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
		// $this->muser	    = model( 'UserModel' );  
        $this->_muser       = model(UserModel::class);
    }

    public function index()
    {
        // Should check for cookie first

        if( $this->_request->getPost('submit') )
        {
        
            $data = $this->_request->getPost();
            $this->_validation->setRule( 'username', 'Username', 'trim|required' );
            $this->_validation->setRule( 'password', 'Password', 'trim|required' );

            if( ! $this->_validation->run($data) )
            {
                // Provide error messages
            }
            else
            {
                if( $validated = $this->_muser->validateLogin() )
                {
                    return redirect()->to( site_url() . 'admin' );
                }
                else
                {
                    // Provide error message
                    echo 'Username or password not valid';
                }
            }
        }
        $data['_controller'] = "auth";
        
        return view('auth/login', $data);
    }

}