<?php

namespace App\Controllers;

class Emails extends BaseController
{

    // var $_funnelName;

    function __construct()
    {
        $this->_memail_types    = model(EmailTypesModel::class);
        $this->_mcustomers      = model(CustomersModel::class);
        $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        $this->_mcampaign_emails    = model(CampaignEmailsModel::class);
    }

    public function index()
    {
        $data   = [
            'emails'    => $this->_mcampaign_emails->getEmail(),
            'title'     => 'Campaign Emails'
        ];
        
        echo view( 'emails/overview', $data );

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
                
            }
        }
    }
}