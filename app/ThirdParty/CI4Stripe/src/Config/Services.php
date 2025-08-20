<?php

namespace Tatter\Stripe\Config;

use CodeIgniter\Config\BaseService;
use Stripe\Stripe;
use Stripe\StripeClient;
use Tatter\Stripe\Config\Stripe as StripeConfig;

class Services extends BaseService
{
    /**
     * Returns an initialized Stripe client
     *
     * @param StripeConfig $config Configuration settings to pass to setAppInfo
     */
    public static function stripe(?StripeConfig $config = null, bool $getShared = true): StripeClient
    {
        if ($getShared) {
            return static::getSharedInstance('stripe', $config);
        }

        if (null === $config) {
            $config = config('Stripe');
        }

        // Initialize the API
        $env = getenv('CI_ENVIRONMENT');
        $stripe_api_key         = getenv('stripe_api_key' . $env); //'Your_API_Secret_key'; 
        $stripe_publishable_key = getenv('stripe_publishable_key.' . $env); //'Your_API_Publishable_key'; 
        $stripe_currency        = getenv('stripe_currency.' . $env); //'usd';

        // Stripe::setApiKey(env('stripe.apiSecret'));
        Stripe::setApiKey($stripe_api_key);
        Stripe::setAppInfo($config->appName, $config->appVersion, $config->appUrl, $config->partnerID);
        Stripe::setApiVersion($config->apiVersion);

        // return new StripeClient(env('stripe.apiSecret'));
        return new StripeClient($stripe_api_key);
    }
}
