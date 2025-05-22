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
        $data   = ['_controller'=>'funnel'];
        echo view( 'campaigns/' . $campaign['id'] . '/header', $data );
        echo view( 'campaigns/common/landingpage', $data );
        echo view( 'campaigns/' . $campaign['id'] . '/footer', $data );
    }

}