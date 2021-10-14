<?php 

namespace App\Controllers;

use DateTime;
use App\Core\Form;
use App\Models\ArticleModel;
use App\Models\AnnoncesModel;
use App\Models\CommentModel;
use App\Models\ContactModel;
use App\Models\UsersModel;

class AdminController extends Controller
{
    public function index()
    {
        if($this->isAdmin())
        {

            $userModel = new UsersModel;
            $users = $userModel->getCount();

            $articleModel = new ArticleModel;
            $articles = $articleModel->getCount();

            $contactModel = new ContactModel;
            $contacts = $contactModel->getCount();


            $this->render('admin/index', [
                'articles' => $articles,
                'users' => $users,
                'contacts' => $contacts
            ], 'admin');
        }
    }

    private function isAdmin()
    {
        if(isset($_SESSION['user']) && in_array("ROLE_ADMIN", $_SESSION['user']['roles']))
        {
            return true;
        }
        else 
        {
            $_SESSION['error'] = "Vous n'avez pas accès à cette page";
            header('Location: ' . PATH . '');
            exit;
        }
    }

    //Articles
    public function articles()
    {
        if($this->isAdmin())
        {
            $articleModel = new ArticleModel;
            $articles = $articleModel->findAll();

            $this->render('admin/articles/articles', [
                'articles' => $articles
            ], 'admin');
        }
    }

    public function activeArticle(int $id)
    {
        if($this->isAdmin())
        {
            $articleModel = new ArticleModel;
            $articleArray = $articleModel->find($id);

            if($articleArray)
            {
                $article = $articleModel->hydrate($articleArray);
                $article->setActive($article->getActive() ? 0 : 1);
                $article->update();
            }
        }   
    }

    public function addArticle()
    {
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) 
        {

            if(Form::validate($_POST, ['title', 'content']))
            {
                $title = strip_tags($_POST['title']);
                $content = strip_tags($_POST['content']);
                $shortDescription = strip_tags($_POST['short_description']);

                move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/public/assets/images/" . $_FILES["image"]["name"]);

                $article = new ArticleModel;
                $article->setTitle($title)
                        ->setContent($content)
                        ->setAuthorId($_SESSION['user']['id'])
                        ->setShortDescription($shortDescription)
                        ->setImage($_FILES['image']['name'])
                        ->setActive(true);

                $article->create();
                
                $_SESSION['message'] = "Votre article a été enregistrée avec succès";
                header('Location: ' . PATH);
                exit;
            }
            else 
            {
                $_SESSION['error'] =  !empty($_POST) ? "Le formulaire est incomplet" : '';
                $title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
                $content = isset($_POST['content']) ? strip_tags($_POST['content']) : '';
                $shortDescription = isset($_POST['content']) ? strip_tags($_POST['content']) : '';
            }

            $form = new Form();

            $form->startForm('post', '#', [
                "enctype" => "multipart/form-data"
            ])
            ->addLabel('title', 'Titre de l\'article')
            ->addInput('text', 'title', [
                'id' => 'title', 
                'class' => 'form-control',
                'value' => $title,
            ])
            ->addLabel('content', 'Texte de l\'article')
            ->addTextarea('content', $content, [
                'id' => 'content', 
                'class' => 'form-control'
            ])
            ->addLabel('short_description', 'Description courte de l\'article')
            ->addTextarea('short_description', $shortDescription, [
                'id' => 'short_description', 
                'class' => 'form-control'
            ])
            ->addLabel('image', 'Image')
            ->addInput('file', 'image', [
                'id' => 'image',
                'class' => 'form-control',
                'accept' => 'image/*'
            ])
            ->addBtn('submit', 'Créer', ['class' => 'btn btn-primary mt-2'])
            ->endForm();

            $this->render('admin/articles/add-article', [
                'form' => $form->create()
            ], 'admin');
        }
    }

    public function editArticle(int $id)
    {
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) 
        {

            $articleModel = new ArticleModel;
            $article = $articleModel->find($id);

            if(!$article)
            {
                http_response_code(404);
                $_SESSION['error'] = "L'article recherchée n'existe pas";
                header('Location: ' . PATH . 'articles');
                exit;
            }

            if($article->author_id != $_SESSION['user']['id'])
            {
                if(!in_array('ROLE_ADMIN', $_SESSION['user']['roles']))
                {
                    $_SESSION['error'] = 'Vous n\'avez pas accès à cette page';
                    header('Location: ' . PATH . 'articles');
                    exit;
                }
            }

            if(Form::validate($_POST, ['title', 'content']))
            {
                $title = strip_tags($_POST['title']);
                $content = strip_tags($_POST['content']);
                $shortDescription = strip_tags($_POST['short_description']);

                move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/public/assets/images/" . $_FILES["image"]["name"]);

                $articleEdit = new ArticleModel;
                $articleEdit->setId($article->id)
                            ->setTitle($title)
                            ->setShortDescription($shortDescription)
                            ->setImage($_FILES['image']['name'])
                            ->setContent($content);

                $articleEdit->update();

                $_SESSION['message'] = "Votre article a été modifiée avec succès";
                header('Location: ' . PATH);
                exit;
            }

            $form = new Form;

            $form->startForm('post', '#', [
                "enctype" => "multipart/form-data"
            ])
            ->addLabel('title', 'Titre de l\'article')
            ->addInput('text', 'title', [
                'id' => 'title', 
                'class' => 'form-control',
                'value' => $article->title,
            ])
            ->addLabel('content', 'Texte de l\'article')
            ->addTextarea('content', $article->content, [
                'id' => 'content', 
                'class' => 'form-control'
            ])
            ->addLabel('short_description', 'Description courte de l\'article')
            ->addTextarea('short_description', $article->short_description, [
                'id' => 'short_description', 
                'class' => 'form-control'
            ])
            ->addLabel('image', 'Image')
            ->addInput('file', 'image', [
                'id' => 'image',
                'class' => 'form-control',
                'accept' => 'image/*'
            ])
            ->addBtn('submit', 'Modifier', ['class' => 'btn btn-primary mt-2'])
            ->endForm();

            $this->render('admin/articles/edit-article', [
                'form' => $form->create()
            ], 'admin');

        }
        else 
        {
            $_SESSION['error'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: ' . PATH . 'users/login');
            exit;
        }

    }

    public function deleteArticle(int $id)
    {
        if($this->isAdmin())
        {
            $article = new ArticleModel;

            $article->delete($id);

            $_SESSION['message'] = "Votre article a été supprimé avec succès";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    //Contact
    public function contacts()
    {
        $contact = new ContactModel;

        $contacts = $contact->findAll();

        $this->render('admin/contacts/contacts', [
            'contacts' => $contacts
        ], 'admin');
    }

    public function deleteContact(int $id)
    {
        if($this->isAdmin())
        {
            $contact = new ContactModel;
    
            $contact->delete($id);
    
            $_SESSION['message'] = "Le contact a été supprimé avec succès";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }

    //Comments

    public function comments()
    {
        $commentModel = new CommentModel;

        $comments = $commentModel->findBy(['active' => 0]);

        $this->render('admin/comments/index', [
            'comments' => $comments
        ], 'admin');

    }

    public function activeComment(int $id)
    {
        if($this->isAdmin())
        {
            $commentModel = new CommentModel;
            $comment = $commentModel->find($id);

            $commentEdit = new CommentModel;

            $commentEdit->setId($comment->id)
                        ->setActive(1);
            $commentEdit->update();

            $this->render('admin/comments/index', [
                'comments' => $commentModel->findBy(['active' => 0])
            ], 'admin');
        }   
    }


    public function deleteComment(int $id)
    {
        if($this->isAdmin())
        {
            $comment = new CommentModel;

            $comment->delete($id);

            $_SESSION['message'] = "Le commentaire a été supprimé avec succès";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    

}