<?php

namespace App\Controllers;

use App\Models\Navbar;
use App\Models\Article;

class Main extends BaseController
{

    public function __construct(){
        $this->navbarModel = new Navbar();
        $this->articleModel = new Article();
        
    }

    public function getArticles()
    {
        $data['article'] = $this->articleModel->where('published', 1)->where('top', 1)->orderBy('date')->findAll();
        //var_dump($data['articlesTop']);
        echo view('HomePage', $data);

    }

    public function getNavbar()
    {
        $data['navbar'] = $this->navbarModel->findAll();
        return $data;
    }
}
