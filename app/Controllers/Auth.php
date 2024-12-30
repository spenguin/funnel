<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        
        $data['_controller'] = "auth";
        
        return view('auth/login', $data);
    }

}