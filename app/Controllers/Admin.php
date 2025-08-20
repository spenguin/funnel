<?php

namespace App\Controllers;

use App\Models\CampaignsModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    /**
     * Get all Campaigns
     * @return Response
     */
    public function index()
    {
        $data = [
            'campaigns' => $this->_mcampaigns->getCampaign(),
            'title'     => 'Campaigns'
        ];
        
        echo view( 'templates/header', $data );
        echo view( 'admin/overview', $data );
        echo view( 'templates/footer', $data );
    }

    /**
     * Create a new Client
     */
    public function store()
    {
        $this->_validation->setRule( 'name', 'Name', 'trim|required' );

        $input = $this->_request->getPost(); 

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        } 
        $campaign = new $this->_mcampaigns();
        $campaign->save($input);
        
        return redirect()->to( site_url() . 'admin' );
    }

    /**
     * Display a single Campaign by ID
     */
    public function show($id)
    {
        $campaign = $this->_mcampaigns->getCampaign($id);

        $data['campaign']   = $campaign;
        $data['title']      = !empty( $campaign['name'] ) ? 'Edit Campaign: ' . $campaign['name']: 'Create New Campaign';

        echo view( 'templates/header', $data );
        echo view( 'admin/campaign/edit', $data );
        echo view( 'templates/footer', $data );
    }

    /**
     * Update Campaign
     */
    public function update($id)
    {
        try {
            $campaign   = new $this->_mcampaigns;
            $campaign->getCampaign($id);

            $input      = $this->_request->getPost(); 

            $campaign->update($id, $input);

            return redirect()->to( site_url() . 'admin' );
        
        } catch (Exception $exception) { var_dump($exception->getMessage());
            // return $this->getResponse(
            //     [
            //         'message' => $exception->getMessage()
            //     ],
            //     ResponseInterface::HTTP_NOT_FOUND
            // );
        }
    }

    /**
     * Destroy Campaign
     */
    public function destroy ($id)
    {
        try {
            $campaign = new $this->_mcampaigns;
            $campaign->getCampaign($id);
            $campaign->delete($campaign);

            return redirect()->to( site_url() . 'admin' );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}