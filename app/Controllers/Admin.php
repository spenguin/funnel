<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('admin/home');
    }
}
   