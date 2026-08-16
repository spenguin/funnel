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
        $this->_mfiles      = model(FilesModel::class);
        // $this->_mcampaign_email_type = model(CampaignEmailTypesModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');

        helper(['Tools', 'form']);
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
        if( is_null($campaignId) ) return redirect()->to( site_url() . 'campaigns' );

        $data   = [];

        $data['campaign']   = $this->_mcampaigns->getCampaign($campaignId);
        $data['customers']  = $this->_mcampaign_customers->getCampaignCustomerDetails($campaignId);
        $data['files']      = $this->_mfiles->getFilesByCampaignId( $campaignId );

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
                return $this
                    ->getResponse(
                        $this->validator->getErrors(),
                        ResponseInterface::HTTP_BAD_REQUEST
                    );                
            }
            else
            {
                // Create new Campaign
                $data['slug']   = url_title( $data['name'] );
                $data['status'] = 1;
                $campaign = new $this->_mcampaigns();
                $campaign->save($data);
                $campaign_id = $this->_mcampaigns->db->insertID(); 

                // goto Create Signup File
                return redirect()->to( site_url() . 'files/edit/' . $campaign_id. '/' . '1' ); 
            }
        }
        $data   = [];
        return view( 'admin/campaigns/create', $data );
    }


}