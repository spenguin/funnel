<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Just call the page view; CodeIgniter handles the layout inheritance automatically
        return view('home');
    }
}
