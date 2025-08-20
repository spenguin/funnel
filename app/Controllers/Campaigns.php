<?php

namespace App\Controllers;

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
            'title'     => 'Campaigns'
        ];
        
        echo view( 'templates/header', $data );
        echo view( 'campaigns/overview', $data );
        echo view( 'templates/footer', $data );        
    }

    /**
     * Create or Edit Campaign
     */
    public function edit($id= NULL)
    {
        if(!is_null($id))
        {
            $data = [
                'campaign'  => $this->_mcampaigns->getCampaign($id),
                'title'     => "Update Campaign",
                'action'    => "/campaigns/{$id}"
            ];
        }
        else 
        {
            $data = [
                'campaign'  => [
                    'name'          => '',
                    'description'   => '',
                    'pledge_goal'   => 0,
                    'sample_url'    => ''
                ],
                'title'     => 'Create Campaign',
                'action'    => '/campaigns'
            ];
        }

        echo view( 'templates/header', $data );
        echo view( 'campaigns/edit', $data );
        echo view( 'templates/footer', $data );
    }


    /**
     * Create new Campaign
     */
    public function store()
    {
        $this->_validation->setRule( 'name', 'Name', 'trim|required' );

        $input = $this->_request->getPost(); 

        if (!$this->_validation->run($input)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        } 
        $input['slug']  = url_title( $input['name'] );
        $campaign = new $this->_mcampaigns();
        $campaign->save($input);
        $campaign_id = $this->_mcampaigns->db->insertID(); 

        // Create the Campaign email_types
        // $email_types = $this->_memail_types->getEmailTypes();
        // foreach($email_types as $email_type )
        // {
        //     $campaign_email_type    = new $this->_mcampaign_email_type();
        //     $args   = [
        //         'email_type_id' => $email_type['id'],
        //         'campaign_id'   => $campaign_id
        //     ];
        //     $campaign_email_type->save($args);
        // }
        
        return redirect()->to( site_url() . 'campaigns' );
    }

    /**
     * Update existing Campaign
     */
    public function update($id)
    {
        $campaign   = $this->_mcampaigns->getCampaign($id);

        $input      = $input = $this->_request->getPost(); 

        try {
            $this->_mcampaigns->update($id, $input );
            
            return redirect()->to( site_url() . 'campaigns' );

        } catch (Exception $exception) {
            echo $exception;
        }
    }

}