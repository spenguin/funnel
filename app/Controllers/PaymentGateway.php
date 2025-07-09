<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Config\Email; 

use Tatter\Stripe\Config;

// require_once APPPATH . 'ThirdParty/CI4Stripe/src/Config'; 

class PaymentGateway extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_mcustomers = model(CustomersModel::class);
        $this->_mcampaign_emails = model(CampaignEmailsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
        $this->_stripe      = service('stripe');

        // $env = getenv('CI_ENVIRONMENT');
        // $stripe_api_key         = getenv('stripe_api_key' . $env); //'Your_API_Secret_key'; 
        // $stripe_publishable_key = getenv('stripe_publishable_key.' . $env); //'Your_API_Publishable_key'; 
        // $stripe_currency        = getenv('stripe_currency.' . $env); //'usd';

        // Set API key 
        // \Stripe\Stripe::setApiKey($stripe_api_key); 
        // \StripePHP::setApiKey($stripe_api_key);
    }

    function payment()
    {
        // Get values from hidden vars
        $input = $this->_request->getPost(); die(var_dump($input));

        // We either have a Customer Id or Customer Name and Email Address
    }

}