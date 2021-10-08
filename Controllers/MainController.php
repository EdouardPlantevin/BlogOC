<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class MainController extends Controller
{
    public function index()
    {
        $url =  "/{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        if($url == "/localhost:8888/BDDPHP/public/")
        {
            header('Location: ' . PATH . 'edouard-plantevin');
        }

        $articlesModel = new ArticleModel;

        $articles = $articlesModel->findBy(['active' => 1]);

        $this->render('main/index', [
            'articles' => $articles
        ]);
    }
}