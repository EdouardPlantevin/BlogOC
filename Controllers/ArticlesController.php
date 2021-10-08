<?php 

namespace App\Controllers;

use App\Models\ArticleModel;

class ArticlesController extends Controller
{
    public function index()
    {
        $articlesModel = new ArticleModel;

        $articles = $articlesModel->findBy(['active' => 1]);

        $this->render('articles/index', [
            'articles' => $articles
        ]);
    }

    public function show($id)
    {
        $articlesModel = new ArticleModel;

        $article = $articlesModel->find($id);

        $this->render('articles/show', [
            'article' => $article
        ]);
    }
}