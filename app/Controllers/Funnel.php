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
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_mcustomers = model(CustomersModel::class);
        $this->_mcampaign_emails = model(CampaignEmailsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
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
        $data   = [
            '_controller'   => 'funnel', 
            'slug'          => $slug,
            'description'   => $campaign['description'],
            'title'         => $campaign['name'],
            'heading'       => '<h1>Meanwhile... The Best</h1>
            <h2>Lo, the possibilities of comics storytelling</h2>
            <p>A curated selection of stories from the first 15 volumes of the critically-acclaimed comics anthology</p>'
        ];
        echo view( 'campaigns/' . $campaign['id'] . '/header', $data );
        echo view( 'campaigns/common/landingpage', $data );
        echo view( 'campaigns/' . $campaign['id'] . '/footer', $data );
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
        $body = sprintf($campaign_email['body'], $campaign['name'], $campaign['sample_url']); //'<h1>This is a test email</h1>'; 

        if( !$email->sendEmail($to, $subject, $body) )
        {
            return "Something went wrong with sending the email. Please try again!";
        }

        // We need to record that the email went out
        
        return redirect()->to( site_url() . 'special-offer/' . $slug . '?token=' . $token );
    }

    /**
     * Geneates Special Offer page for Product
     */
    public function special_offer($slug)
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
        if( isset($_REQUEST['token'] ) )
        {

        }
        $data   = [
            '_controller'   => 'funnel', 
            'slug'          => $slug,
            'description'   => $campaign['description'],
            'title'         => $campaign['name'],
            'heading'       => '<h1>Meanwhile... The Best</h1>
            <h2>Get <soan class="shout">25%</span> off cover price!</h2>
            <p><em>Plus free shipping</em></p>
            <p>For £1 now!</p>'
        ];        
        echo view( 'campaigns/' . $campaign['id'] . '/header', $data );
        echo view( 'campaigns/common/specialoffer', $data );
        echo view( 'campaigns/' . $campaign['id'] . '/footer', $data );
        
    }


    function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = getenv('SMTPServer'); //'smtp.example.com';
        $mail->SMTPAuth = TRUE;
        $mail->Username = getenv('Username'); //'user@example.com';
        $mail->Password = getenv('Password'); //'********';
        $mail->SMTPSecure = getenv('Protocol'); //'ssl';
        $mail->Port     = getenv('Port'); //465;
        
        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('makecontact@weirdspace.com');
        
        // // Add cc or bcc 
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }    

}