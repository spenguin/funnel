<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Files extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns  = model(CampaignsModel::class);
        $this->_memail_types= model(EmailTypesModel::class);
        $this->_mcampaign_customers = model(CampaignCustomersModel::class);
        // $this->_mcampaign_email_type = model(CampaignEmailTypesModel::class);
        $this->_request     = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    /**
     * Create/Edit File for Campaign
     * @param (int) Campaign Id
     * @param (int) File Type Id - optional
     */
    public function edit( $campaignId, $fileTypeId = NULL )
    {
        if( is_null($campaignId) ) return redirect()->to( site_url() . 'campaign' ); // Not sure about this

        $data   = [];
        return view( 'admin/files/edit', $data);
    }

    /**
     * Display File 
     * @param (str) file name
     */
    public function displayFile( $fileName )
    {
        $filePath = WRITEPATH . 'files/' . $fileName;

        if( !file_exists( $filePath ) )
        {
            throw  new \CodeIgniter\Exceptions\PageNotFoundException("File not found.");
        }

        $data['body']   = file_get_contents($filePath);

        return view( 'admin/files/display', $data );

    //     $file       = new \CodeIgniter\Files\File($filePath);
    //     $mimeType   = $file->getMimeType();
        
    //     return $this->response
    //         ->setStatusCode(200)
    //         ->setContentType($mimeType)
    //         ->setBody(file_get_contents($filePath));        
    }

}