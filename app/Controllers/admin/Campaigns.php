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

                // Create required files
                $templatesArray = [
                    1 => 'landing-page-template.txt',
                    5 => 'signup-email-template.txt',
                    3 => 'pledge-offer-page-template.txt',
                    2 => 'pledge-thank-you-page-template.txt'
                ];
                $preceding_file_id  = 0;
                foreach( $templatesArray as $key => $fileTemplateName )
                {
                    $fileName   = sha1(rand()) . '.txt';
                    $filePath   = WRITEPATH  . 'files/' . $fileName;
                    $fileTemplatePath       = WRITEPATH  . 'files/' . $fileTemplateName;

                    $fileTemplateContent    = file_get_contents($fileTemplatePath);
                    file_put_contents( $filePath, $fileTemplateContent );

                    // Add File to db
                    $data   = [
                        'file_type_id'  => $key,
                        'campaign_id'   => $campaign_id,
                        'name'          => $fileName,
                        'preceding_file_id' => $preceding_file_id
                    ];

                    $fileId     = $this->_mfiles->insert( $data );                    
                    $preceding_file_id  = $key;
                }

                // goto Create Signup File

                return redirect()->to( site_url() . 'files/edit/' . $campaign_id. '/' . '1' ); 
            }
        }
        $data   = [];
        return view( 'admin/campaigns/create', $data );
    }


}