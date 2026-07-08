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
        $data['_controller'] = $this->request->uri->getSegment(1); ;
        return view('funnel/' . $this->_funnelName . '/landing', $data);
    }
}