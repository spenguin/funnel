<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Config\Email;

class Files extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns  = model(CampaignsModel::class);
        // $this->_memail_types= model(EmailTypesModel::class);
        $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        $this->_mfiles      = model(FilesModel::class);
        $this->_mfile_types = model(FileTypesModel::class);
        $this->_mfile_meta  = model(FileMetaModel::class);
        // $this->_mcampaign_email_type = model(CampaignEmailTypesModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');

        helper(['Tools', 'form']);
    }

    /**
     * Create/Edit File for Campaign
     * @param (int) Campaign Id
     * @param (int) File Type Id - optional
     */
    public function edit( $campaignId = NULL, $fileTypeId = NULL )
    {
        
        if( is_null($campaignId) ) return redirect()->to( site_url() . 'campaign' ); // Not sure about this

        $data   = [
            'campaignId'    => $campaignId,
            'fileTypeId'    => $fileTypeId
        ];

        $file_types = $this->_mfile_types->findAll();
        $data['file_types'] = extract_options_array( $file_types, 'id', 'name' );

        $campaigns  = $this->_mcampaigns->findAll();
        $data['campaigns']  = extract_options_array( $campaigns, 'id', 'name' );

        return view( 'admin/files/edit', $data);
    }

    public function save()
    {
        if( $this->_request->getPost('submit') )
        {
            $input = $this->_request->getPost();
            $this->_validation->setRule( 'subject', 'Subject', 'trim' );
            $this->_validation->setRule( 'body', 'Body', 'required');

            if( ! $this->_validation->run($input) )
            {
                return $this
                    ->getResponse(
                        $this->validator->getErrors(),
                        ResponseInterface::HTTP_BAD_REQUEST
                    );
            }
            else
            {
                
                // Create new File
                $fileName   = sha1(rand()) . '.txt';
                $filePath   = WRITEPATH  . 'files/' . $fileName;

                if( !is_dir( WRITEPATH . 'files' ) )
                {
                    mkdir( WRITEPATH . 'files', 0755, TRUE );
                }

                file_put_contents( $filePath, $input['body'] );

                // Add File to db
                $data = [
                    'file_type_id'  => $input['file_type_id'],
                    'campaign_id'   => $input['campaignId'],
                    'name'          => $fileName
                ];

                $fileId     = $this->_mfiles->insert( $data );

                // Add Subject to File Meta
                $data   = [
                    'file_id'       => $fileId,
                    'meta_name'     => 'Subject',
                    'meta_value'    => $input['subject']
                ];

                $this->_mfile_meta->insert( $data );    
                
                return redirect()->to( site_url() . 'campaigns/details/' . $campaignId );

            }
            
        }
        return redirect()->to( site_url() . 'campaigns/' );

    }

    /**
     * Display File 
     * @param (str) file name
     */
    public function view( $fileName )
    {
        $filePath = WRITEPATH . 'files/' . $fileName;

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }

        $file   = $this->_mfiles->getFileByName( $fileName );
        $data['file']       = $file;
        $data['body']       = file_get_contents($filePath);

        return view( 'admin/files/view', $data );

    //     $file       = new \CodeIgniter\Files\File($filePath);
    //     $mimeType   = $file->getMimeType();
        
    //     return $this->response
    //         ->setStatusCode(200)
    //         ->setContentType($mimeType)
    //         ->setBody(file_get_contents($filePath));        
    }

    /**
     * Send test email to provided email address
     * @param (str) filename
     */
    public function sendTest( $fileName )
    {
        $filePath = WRITEPATH . 'files/' . $fileName;

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }   
        
        $input = $this->_request->getPost(); 
        $email = new Email(); 

        $to         = $input['testEmail'];
        $subject    = "Test email";
        $body       = file_get_contents($filePath);

        if( !$email->sendEmail($to, $subject, $body) )
        {
            return "Something went wrong with sending the email. Please try again!";
        }        
    }

}