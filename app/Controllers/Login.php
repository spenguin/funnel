<?php

namespace App\Controllers;

class Login extends BaseController
{
    
    public function __construct()
    {
        $this->_request = \Config\Services::request();
        $this->_session = \Config\Services::session(); 

		$this->_validation	= service('validation');
		// $this->muser	    = model( 'UserModel' );  
        $this->_muser       = model(UserModel::class);
    }

    public function index()
    {
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
                    return redirect()->to( site_url() . 'dashboard' );
                }
                else
                {
                    // Provide error message
                    echo 'Username or password not valid';
                }
            }
        }    
    
        return view('login');
    }

    public function forgotten()
    {

        return view('forgotten');
    }

    public function logout()
    {

        $this->_session->remove('logged');    
        $this->_session->remove('name');    
        $this->_session->remove('loggedUserId');    
        
        return redirect()->to( site_url() );
    }
}