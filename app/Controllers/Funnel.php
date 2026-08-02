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
        $this->_mcampaign_emails    = model(CampaignEmailsModel::class);
        $this->_mcampaign_customer  = model(CampaignCustomersModel::class);
        $this->_mfiles      = model(FilesModel::class);
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

        $campaign_email = $this->_mcampaign_emails->getCampaignEmail($campaign['id'], 1 );

        $email = new Email(); 
 
        $to = $input['email']; //'weirdspace'; 
        $subject = sprintf($campaign_email['subject'], $campaign['name']); //'Your Preview of ' . $campaign['name'] . ', as requested'; 
        $body = $campaign_email['body']; //sprintf($campaign_email['body'], $campaign['name'], $campaign['sample_url']); //'<h1>This is a test email</h1>'; 

        if( !$email->sendEmail($to, $subject, $body) )
        {
            return "Something went wrong with sending the email. Please try again!";
        }

        // We need to record that the email went out

        
        return redirect()->to( site_url() . 'special-offer/' . $slug . '?token=' . $token );
    }


}