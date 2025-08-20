<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class Pages extends BaseController
{
    
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
    }
    
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        // Test if $page exists in the Campaigns datatable
        $campaign   = $this->_mcampaigns->getCampaignBySlug($page); 
        if( !is_null($campaign) )
        {
            return redirect()->to( site_url() . 'preview/' . $page );
        }
        
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
    
        $data['title'] = ucfirst($page); // Capitalize the first letter
    
        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);    
    }
}