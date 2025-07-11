<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$env = getenv('CI_ENVIRONMENT');
$config['stripe_api_key']         = getenv('stripe_api_key' . $env); //'Your_API_Secret_key'; 
$config['stripe_publishable_key'] = getenv('stripe_publishable_key.' . $env); //'Your_API_Publishable_key'; 
$config['stripe_currency']        = getenv('stripe_currency.' . $env); //'usd';