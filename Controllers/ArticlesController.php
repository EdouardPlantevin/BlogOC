<?php 

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;
use App\Models\ArticleModel;
use App\Models\CommentModel;

class ArticlesController extends Controller
{
    public function index()
    {
        $articlesModel = new ArticleModel;

        $articles = $articlesModel->findAllOrder();

        $this->render('articles/index', [
            'articles' => $articles
        ]);
    }

    public function show($id)
    {
        $articlesModel = new ArticleModel;
        $userModel = new UsersModel;
        $commentModel = new CommentModel;

        $article = $articlesModel->find($id);
        $author = $userModel->find($article->author_id); 
        $comments = $commentModel->findBy(['article_id' => $article->id, 'active' => 1]);

        if(Form::validate($_POST, ['content']))
        {
            $content = strip_tags($_POST['content']);

            $comment = new CommentModel;
            $comment->setAuthor($_SESSION['user']['fullname'])
                    ->setArticleId($article->id)
                    ->setContent($content);

            $comment->create();

            $_SESSION['message'] = "Votre commentaire sera visible quand un administrateur l'aura validé";

            //header("Refresh:0");
        }

        $form = new Form;

        $form->startForm()
            ->addLabel('content', 'Écrit un commentaire')
            ->addTextarea('content', '', [
                'id' => 'content', 
                'class' => 'form-control',
                'placeholder' => "Écrit ici.."
            ])
            ->addBtn('submit', 'Envoyer', ['class' => 'btn btn-primary mt-2'])
            ->endForm();

        $articles = $articlesModel->findBy(['active' => 1]);


        $this->render('articles/article-detail', [
            'article' => $article,
            'articles' => $articles,
            'author' => $author,
            'comments' => $comments,
            'form' => $form->create()
        ]);
    }
}