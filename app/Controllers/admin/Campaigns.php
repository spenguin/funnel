<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Campaigns extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns  = model(CampaignsModel::class);
        $this->_memail_types= model(EmailTypesModel::class);
        $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        // $this->_mcampaign_email_type = model(CampaignEmailTypesModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    /**
     * Display Campaigns
     */
    public function index()
    {
        $data = [
            'campaigns' => $this->_mcampaigns->getCampaign(),
            'campaignCustomers' => $this->_mcampaign_customers->getCustomerGroupedByCampaign(),
            'title'     => 'Campaigns'
        ];

        return view('admin/campaigns', $data );      
    }

    /**
     * Display Campaign Details
     */
    public function details( $campaignId = NULL )
    {
        if( is_null($campaignId) ) return redirect()->to( site_url() . 'campaign' );

        $data   = [];

        $data['campaign']   = $this->_mcampaigns->getCampaign($campaignId);
        $data['customers']  = $this->_mcampaign_customers->getCampaignCustomers($campaignId);

        return view( 'admin/campaigns/details', $data );
    }

    public function create()
    {
        if( $this->_request->getPost('submit') )
        {
            $data = $this->_request->getPost();
            $this->_validation->setRule( 'name', 'Name', 'trim|required' );

            if( ! $this->_validation->run($data) )
            {
                // Provide error messages
            }
            else
            {
                // Create new Campaign

                // Create Landing Page
            }
        }
        $data   = [];
        return view( 'admin/campaigns/create', $data );
    }


}