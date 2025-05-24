<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Funnel extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
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
            'title'         => $campaign['name']
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


        // $campaign = new $this->_mcampaigns();
        // $campaign->save($input);
        
        return redirect()->to( site_url() . 'special-offer/' . $slug );
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
        $data   = [
            '_controller'   => 'funnel', 
            'slug'          => $slug,
            'description'   => $campaign['description'],
            'title'         => $campaign['name']
        ];        
        echo view( 'campaigns/' . $campaign['id'] . '/header', $data );
        echo view( 'campaigns/common/specialoffer', $data );
        echo view( 'campaigns/' . $campaign['id'] . '/footer', $data );
        
    }

}