<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CampaignCustomersModel;
use Exception;
use Config\Email; 

class Emails extends BaseController
{
    function __construct()
    {
        // $this->_memail_types    = model(EmailTypesModel::class);
        $this->_mfiles      = model(FilesModel::class);
        $this->_mfile_meta  = model(FileMetaModel::class);
        $this->_mcustomers  = model(CustomersModel::class);
        // $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        // $this->_mcampaign_emails    = model(CampaignEmailsModel::class);
        // $this->_mcampaigns      = model(CampaignsModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');
        // helper('Tools');
    }

    function index()
    {
        $data   = [];
        $data['emails'] = $this->_mfiles->getFilesByFileType(5);

        return view( 'admin/emails', $data );
    }

    function create()
    {
        if( $this->_request->getPost('submit') )
        {
            $data = $this->_request->getPost();
            $this->_validation->setRule( 'emailBody', 'Email Body', 'trim|required' );
            $this->_validation->setRule( 'emailSubject', 'Email Subject', 'trim|required' );
            $this->_validation->setRule( 'campaign', 'Campaign', 'trim|required' );

            if( ! $this->_validation->run($data) )
            {
                // Provide error messages
            }
            else
            {
                // Create new File
                $input      = $this->_request->getPost(); 
                $fileName   = sha1(rand()) . '.txt';
                $filePath   = WRITEPATH  . 'files/' . $fileName;

                if( !is_dir( WRITEPATH . 'files' ) )
                {
                    mkdir( WRITEPATH . 'files', 0755, TRUE );
                }

                file_put_contents( $filePath, $input['emailBody'] );

                // Add File to db
                $data   = [
                    'file_type_id'  => 5,
                    'campaign_id'   => $input['campaign'],
                    'name'          => $fileName
                ];

                $fileId     = $this->_mfiles->insert( $data );

                // Add Subject to File Meta
                $data   = [
                    'file_id'       => $fileId,
                    'meta_name'     => 'Subject',
                    'meta_value'    => $input['emailSubject']
                ];

                $this->_mfile_meta->insert( $data );

                // return to Email Landing Page

                return redirect()->to( site_url() . 'emails' );
            }
        }
    
        $data   = [];

        return view( 'admin/emails/create', $data );
    }

    function sendEmail( $emailId = NULL )
    {
        if( is_null( $emailId) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }

        $emailFile  = $this->_mfiles->getFileByFileId( $emailId );

        if( is_null( $emailFile ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }

        $filePath = WRITEPATH . 'files/' . $emailFile['name'];

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }
        
        
        // Send to all Customers
        $customers  = $this->_mcustomers->findAll(); 

        $subject    = $this->_mfile_meta->getMetaValueByFileIdAndMetaName( $emailId, 'Subject' ); 
        $body       = file_get_contents($filePath); 

        
        $email = new Email();

        foreach( $customers as $customer )
        {
            $customerBody   = str_ireplace( '{{Name}}', $customer['name'], $body );
            if( !$email->sendEmail( $customer['email'], $subject['meta_value'], $customerBody) )
            {
                return "Something went wrong with sending the email. Please try again!";
            }
        }

        return redirect()->to( site_url() . 'emails' );
    }
}