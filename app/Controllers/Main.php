<?php

namespace App\Controllers;

use App\Models\Navbar;
use App\Models\Article;

class Main extends BaseController
{

    public function __construct(){
        
        $this->articleModel = new Article();
        
    }

    public function getArticles()
    {
        $data['article'] = $this->articleModel->where('published', 1)->where('top', 1)->orderBy('date', 'DESC')->findAll();
        //var_dump($data['article']);
        echo view('HomePage', $data);

    }

    public function show($id)
    {
        $article = $this->articleModel->find($id);
        return view('article', ['article' => $article]);
    }
}
