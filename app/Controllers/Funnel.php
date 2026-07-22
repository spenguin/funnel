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

}