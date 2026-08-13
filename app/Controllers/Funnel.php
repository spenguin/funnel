<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Config\Email; 

class Funnel extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns  = model(CampaignsModel::class);
        $this->_mcustomers  = model(CustomersModel::class);
        // $this->_mcampaign_emails    = model(CampaignEmailsModel::class);
        $this->_mcampaign_customer  = model(CampaignCustomersModel::class);
        $this->_mfiles      = model(FilesModel::class);
        $this->_mfile_meta  = model(FileMetaModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    /**
     * Route the URL to the appropriate Controller/View 
     * @param (str) $slug
     *  
     */
    public function routing( $slug = NULL )
    {
        if(is_null($slug))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }

        $campaign = $this->_mcampaigns->getCampaignBySlug( $slug ); 
        if( !is_null( $campaign ) ) return redirect()->to( site_url() . 'preview/' . $slug );
    }

    /**
     * Generates the Landing Page for the Preview of the Product
     */
    public function preview($slug = NULL)
    {
        if(is_null($slug))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        $campaign   = $this->_mcampaigns->getCampaignBySlug($slug);
        if( is_null($campaign))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }

        $fileData   = $this->_mfiles->getFileByCampaignIdFileType( $campaign['id'], 1 ); 

        $filePath   = WRITEPATH . 'files/' . $fileData['name'];

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }

        $file       = new \CodeIgniter\Files\File($filePath);
        $mimeType   = $file->getMimeType();
        
        return $this->response
            ->setStatusCode(200)
            ->setContentType($mimeType)
            ->setBody(file_get_contents($filePath));

    }

    
    /**
     * Handles the Post data from someone signing up to see the Preview
     */
    public function signup($slug=NULL)
    {
        if(is_null($slug))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        $campaign   = $this->_mcampaigns->getCampaignBySlug($slug);
        if( is_null($campaign))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        
        $this->_validation->setRule( 'name', 'Name', 'trim|required' );
        $this->_validation->setRule( 'email', 'Email', 'trim|required' );

        $input = $this->_request->getPost(); 

        if (!$this->_validation->run($input)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        } 
        // Save input
        // Create Customer if new; else return existing
        $customer = $this->_mcustomers->getCustomerByEmail( $input['email'] );
        
        if( is_null( $customer ) )
        {
            $customer = new $this->_mcustomers();
            $input['token'] = md5(microtime());
            $customer->save($input);
            $token  = $input['token'];
        } else {
            $token  = $customer['token'];
        }
        
        // Trigger first email sent

        $emailFile = $this->_mfiles->getNextFileByCampaignIdAndFileId( $campaign['id'], 1 ); 


        $filePath = WRITEPATH . 'files/' . $emailFile['name'];

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }
        
        $subject    = $this->_mfile_meta->getMetaValueByFileIdAndMetaName( $emailFile['id'], 'Subject' ); 
        $body       = file_get_contents($filePath); 
        

        $email = new Email(); 
 
        $to    = $input['email']; //'weirdspace'; 

        if( !$email->sendEmail($to, $subject['meta_value'], $body) )
        {
            return "Something went wrong with sending the email. Please try again!";
        }

        // We need to record that the email went out

        // Find out what the next Campaign step is
        $nextStep = $this->_mfiles->getNextFileByCampaignIdAndFileId( $campaign['id'], $emailFile['id'] ); 

        if( $nextStep['file_type_id'] == 3 ) return redirect()->to( site_url() . 'special-offer/' . $slug . '?token=' . $token );

        if( $nextStep['file_type_id'] == 4 ) return redirect()->to( site_url() . 'thank-you/' . $slug );
       
    }

    public function special_offer( $slug )
    {
        if(is_null($slug))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        $campaign   = $this->_mcampaigns->getCampaignBySlug($slug);

        $token      = $this->_request->getGet('token');
        $customer   = $this->_mcustomers->getCustomerByToken( $token );


        if( is_null($campaign))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($slug);
        }
        
        $fileData    = $this->_mfiles->getFileByCampaignIdFileType( $campaign['id'], 3 );

        $filePath   = WRITEPATH . 'files/' . $fileData['name'];

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        } 
        
        $file       = new \CodeIgniter\Files\File($filePath);
        $mimeType   = $file->getMimeType();
        $body       = file_get_contents($filePath);
        $body       = str_replace( '{{title}}', $campaign['name'], $body );

        if( is_null( $customer ) )
        {
            $formContent = '<label for="name">Name: <input type="text" name="name" required/></label>
            <label for="email">Email: <input type="email" name="email" required/></label>';

        } else {

            $formContent = '<input type="hidden" name="token" value="' . $token . '" />';

        }

        $body       = str_replace( '{{formContent}}', $formContent, $body );
        
        return $this->response
            ->setStatusCode(200)
            ->setContentType($mimeType)
            ->setBody($body);        
    }

    function special_offer_taken($slug = NULL)
    {
        if( is_null( $slug ) )
        {
            exit( 'Campaign slug is required' );
        }

        $campaign = $this->_mcampaigns->getCampaignBySlug($slug);
        
        $input = $this->_request->getPost();

        if( isset($input['token'] ) )
        {
            try {
                $customer = $this->_mcustomers->getCustomerByToken($input['token']);
            } catch (\Exception $e) {
                exit('Token not valid');
            }
        } else {
            $customer = new $this->_mcustomers();
            $input['token'] = md5(microtime());
            $customer->save($input);
        } 
        $env = getenv('CI_ENVIRONMENT');
        return redirect()->to( getenv('stripe_buynow_link.' . $env) . '?utm_source=' . $input['token'] . '&utm_campaign=' . $campaign['id'] );
            
    } 
    
    public function payment_successful()
    {
        $params = $this->_request->getGet(); 

        $customer   = $this->_mcustomers->getCustomerByToken( $params['utm_source'] );
        $campaign   = $this->_mcampaigns->getCampaign( $params['utm_campaign'] );

        $campaign_customer = new $this->_mcampaign_customer();

        $input  = [
            'campaign_id'   => $params['utm_campaign'],
            'customer_id'   => $customer['id'],
            'paid'          => date('Y-m-d H:i:s'),
            'campaign_email_sent'   => 1,
            'campaign_email_sent_date'  => date('Y-m-d H:i:s')
        ];
        $campaign_customer->save($input);

        $pledgeFile         = $this->_mfiles->getFileByCampaignIdFileType( $campaign['id'], 3 );
        $landingPageFile    = $this->_mfiles->getNextFileByCampaignIdAndFileId( $campaign['id'], $pledgeFile['id'] );

        $filePath   = WRITEPATH . 'files/' . $landingPageFile['name'];

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }   
        
        $file       = new \CodeIgniter\Files\File($filePath);
        $mimeType   = $file->getMimeType();
        $body       = file_get_contents($filePath);

        // if( is_null( $customer ) )
        // {
        //     $formContent = '<label for="name">Name: <input type="text" name="name" required/></label>
        //     <label for="email">Email: <input type="email" name="email" required/></label>';

        // } else {

        //     $formContent = '<input type="hidden" name="token" value="' . $token . '" />';

        // }

        // $body       = str_replace( '{{formContent}}', $formContent, $body );
        
        return $this->response
            ->setStatusCode(200)
            ->setContentType($mimeType)
            ->setBody($body);

        // $data   = [
        //     '_controller'   => 'funnel', 
        //     'slug'          => strtolower($campaign['slug']),
        //     'description'   => $campaign['description'],
        //     'title'         => $campaign['name'],
        //     'heading'       => '<h1>Meanwhile... The Best</h1>
        //     <h2>Thank you so much for your support.</h2>
        //     <p>The campaign will start shortly; and we will, of course, let you know</p>',
        //     // 'token'         => $token
        // ];        
        // echo view( 'campaigns/' . $campaign['id'] . '/header', $data );
        // echo view( 'campaigns/common/paymentmade', $data );
        // echo view( 'campaigns/' . $campaign['id'] . '/footer', $data );        

    }    


}