<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Funnel extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    public function preview($slug = NULL)
    {
        if(is_null($slug))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        $campaign   = $this->_mcampaigns->getCampaignBySlug($slug); 
        if( is_null($campaign))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        return '<p>Campaign found. Display Offer</p>';
    }

}


// namespace App\Controllers;

// class Funnel extends BaseController
// {

//     var $_funnelName;

//     function __construct()
//     {
//         $this->_funnelName = "test";
//     }
    
//     public function index()
//     {
//         $data['_controller'] = "funnel";
//         return view('funnel/' . $this->_funnelName . '/landing', $data);
//     }
// }