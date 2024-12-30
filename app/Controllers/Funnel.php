<?php

namespace App\Controllers;

class Funnel extends BaseController
{

    var $_funnelName;

    function __construct()
    {
        $this->_funnelName = "test";
    }
    
    public function index()
    {
        $data['_controller'] = "funnel";
        return view('funnel/' . $this->_funnelName . '/landing', $data);
    }
}