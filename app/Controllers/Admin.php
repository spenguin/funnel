<?php

namespace App\Controllers;

use App\Models\CampaignsModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->_mcampaigns = model(CampaignsModel::class);
        $this->_request = \Config\Services::request();
		$this->_validation	= service('validation');
    }

    public function index()
    {
        $data = [
            'campaigns' => $this->_mcampaigns->getCampaign(),
            'title'     => 'Campaigns'
        ];
        
        echo view( 'templates/header', $data );
        echo view( 'admin/overview', $data );
        echo view( 'templates/footer', $data );
        // return view('admin/home');
    }

    /**
     * Create new Campaign or Edit existing one
     */
    public function edit($id=NULL)
    {   
        if( $this->_request->getPost('submit') )
        {
            $data = $this->_request->getPost(); 
            $this->_validation->setRule( 'name', 'Name', 'trim|required' );

            if( ! $this->_validation->run($data) )
            {
                // Provide error messages
                // $errors = $this->_validation->getErrors();
                // die($errors);
                // die( 'Nope');
            }
            else
            {
                $insert = [
                    'name'  => $data['name'],
                    'slug'  => strtolower(url_title($data['name'])),
                    'description'   => $data['description'],
                    'sample_url'    => $data['sample_url'],
                    'pledge_goal'   => intval($data['goal'])
                ]; 
                try{
                    $this->_mcampaigns->insert($data);
                    // $session->setFlashdata('msg', 'Record Inserted successfully');

                }
                catch(\Exception $e){
                    // $session->setFlashdata('msg', 'Something went wrong');
                }

                return redirect()->to( site_url() . 'admin' );
                // $slug = url_title($string);
                // $slug = strtolower($slug);
            }            


        }
        
        
        
        $campaign = [];
        if( !is_null($id) )
        {
            $campaign = $this->_mcampaigns->getCampaign($id);
            
        } else {

        }
        $data['campaign']   = $campaign;
        $data['title']      = isset( $campaign['title'] ) ? 'Edit ' . $campaign['title']: 'Create New Campaign';

        echo view( 'templates/header', $data );
        echo view( 'admin/campaign/edit', $data );
        echo view( 'templates/footer', $data );
    }
}
   