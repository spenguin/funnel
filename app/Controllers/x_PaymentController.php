<?php
namespace App\Controllers;
              
use App\Controllers\BaseController;
            use CodeIgniter\Database\BaseConnection;
class PaymentController extends BaseController {
    protected $session;
    
    public function __construct(){
        $this->session = \Config\Services::session();        
    }

    
	    // ---------------------------- Donation Page -------------------------------------
   	    public function donate(){
	        return view('stripe/index');
	    }
		    
	    // ---------------------------- Checkout Session ----------------------------------
	    public function payment() {
	        $secretKey = env('STRIPE_SECRET_KEY'); 
	        // \Stripe\Stripe::setApiKey($secretKey);
            StripePHP::setApiKey(getenv('stripe_api_key.development'));
	        $amount = $this->request->post('amount');
	        if ($amount < 1) {
		return $this->response->setStatusCode(400)->setJSON([
			 'error' => 'Invalid amount'
		 ]);
	        }
	        try {            
	            $session = \Stripe\Checkout\Session::create([
	                'payment_method_types' => ['card'],
	                'line_items' => [
	                    [
	                        'price_data' => [
	                            'currency' => 'usd',
	                            'product_data' => [
	                                'name' => 'Donation',
	                            ],
	                            'unit_amount' => $amount * 100, // Convert to cents
	                        ],
	                        'quantity' => 1,
	                    ]
	                ],
	                'mode' => 'payment',
	                'success_url' => base_url('stripe/payment-success'),
	                'cancel_url' => base_url('stripe/payment-cancel'),
	            ]);
	            return redirect()->to($session->url);
	        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
	                'error' => $e->getMessage()
	            ]);
	        }
	    }

	    // ---------------------------- Success Page --------------------------------------
	    public function payment_success() {
	        return view('payment_success');
	    }

	    // ---------------------------- Cancel Page ---------------------------------------
	    public function payment_cancel(){
	        return view('payment_cancle');
	    }
	}