<?php

namespace App\Controllers;

use Exception;
use Config\Email; 

class Emails extends BaseController
{

    // var $_funnelName;

    function __construct()
    {
        $this->_memail_types    = model(EmailTypesModel::class);
        $this->_mcustomers      = model(CustomersModel::class);
        $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        $this->_mcampaign_emails    = model(CampaignEmailsModel::class);
        $this->_mcampaigns      = model(CampaignsModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');
        helper('Tools');
    }

    public function index()
    {
        $data   = [
            'campaign_emails'   => $this->_mcampaign_emails->getCampaignEmail(),
            'title'             => 'Campaign Emails'
        ];
        $data['campaigns']  = $this->_mcampaigns->organiseCampaignNames();
        $data['email_types']    = $this->_memail_types->organiseEmailTypes();
        
        echo view( 'templates/header', $data );
        echo view( 'emails/overview', $data );
        echo view( 'templates/footer', $data );      
    }

    /**
     * Create or Edit Email
     */
    public function edit($id= NULL)
    {
        
        if(!is_null($id))
        {
            $data = [
                'campaign_email'    => $this->_mcampaign_emails->getCampaignEmail($id),
                'title'     => "Update Campaign Email",
                'action'    => "/emails/{$id}"
            ];
        }
        else 
        {
            $data = [
                'campaign_email'  => [
                    'campaign_id'   => '',
                    'email_type_id' => '',
                    'subject'       => '',
                    'body'          => ''
                ],
                'title'     => 'Create Campaign Email',
                'action'    => '/emails'
            ];
        }

        $campaigns  = $this->_mcampaigns->getCampaign();
        $data['campaign_options']    = \Tools::extract_options_array( $campaigns, 'id', 'name' );

        $email_types= $this->_memail_types->findAll(); 
        $data['email_type_options']  = \Tools::extract_options_array( $email_types, 'id', 'name' );

        echo view( 'templates/header', $data );
        echo view( 'emails/edit', $data );
        echo view( 'templates/footer', $data );
    }  
    
    /**
     * Update existing Campaign Email
     */
    public function update($id)
    {
        $input      = $this->_request->getPost(); //die(var_dump($input));

        try {
            $this->_mcampaign_emails->update( $id, $input ); 
            
            return redirect()->to( site_url() . 'emails' );

        } catch (Exception $exception) {
            echo $exception;
        }
    }

    /**
     * Create new Campaign Email
     */
    public function store()
    {
        $this->_validation->setRule( 'subject', 'Subject', 'trim|required' );
        $this->_validation->setRule( 'body', 'Body', 'trim|required' );


        $input = $this->_request->getPost(); 

        if (!$this->_validation->run($input)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        } 
        $campaign_email = new $this->_mcampaign_emails();
        $campaign_email->save($input);

        return redirect()->to( site_url() . 'emails' );
    }    
    
    public function daily()
    {
        $email_types = $this->_memail_types->findAll(); //var_dump($email_types);
        foreach( $email_types as $email_type )
        { 
            if( $email_type['id'] == 1 ) continue;
            $campaign_customers = $this->_mcampaign_customers->getCustomersByEmailTypeAndDateGrouped($email_type['follows'], $email_type['delay']); 
            foreach( $campaign_customers as $campaign_customer )
            { 
                $paid_status = ( $campaign_customer['paid'] == "0000-00-00 00:00:00" ) ? "0" : "1"; 
                if( $email_type['paid_status'] == $paid_status )
                {
                    // Get the email by type and by campaign
                    $campaign_email = $this->_mcampaign_emails->getCampaignEmailByCampaignId_EmailTypeId( $campaign_customer['campaign_id'],  $email_type['id'] );
                    $campaign       = $this->_mcampaigns->getCampaign($campaign_customer['campaign_id'] );

                    $customer = $this->_mcustomers->getCustomer($campaign_customer['customer_id']);
                    
                    $email  = new Email();

                    $to     = $customer['email'];
                    $subject= sprintf($campaign_email['subject'], $campaign['name'] );
                    $body   = $campaign_email['body'];

                    if( !$email->sendEmail($to, $subject, $body) )
                    {
                        die( "Something went wrong with sending the email. Please try again!");
                    } 
                    
                    // Update the Campaign Email

                }

            }
        }
    }
}