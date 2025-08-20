<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function __construct()
    {
        $this->_model = model(NewsModel::class);
    }
    
    public function index()
    {
        $data = [
            'news'  => $this->_model->getNews(),
            'title' => 'News archive',
        ];
        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);        
    }

    public function view($slug = null)
    {
        $data['news'] = $this->_model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }
    
        $data['title'] = $data['news']['title'];
    
        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);        
    }
}