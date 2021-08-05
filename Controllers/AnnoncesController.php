<?php 

namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        $annoncesModel = new AnnoncesModel;

        $annonces = $annoncesModel->findBy(['actif' => 1]);

        $this->render('annonces/index', [
            'annonces' => $annonces,
        ]);
        
    }

    public function lire(int $id)
    {
        $annoncesModel = new AnnoncesModel;

        $annonce = $annoncesModel->find($id);

        $this->render('annonces/lire', [
            'annonce' => $annonce
        ]);
    }

    public function ajouter()
    {
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) 
        {

            if(Form::validate($_POST, ['title', 'description']))
            {
                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);

                $annonce = new AnnoncesModel;
                $annonce->setTitle($title)
                        ->setDescription($description)
                        ->setUserId($_SESSION['user']['id']);

                $annonce->create();
                
                $_SESSION['message'] = "Votre annonce a été enregistrée avec succès";
                header('Location: ' . PATH);
                exit;
            }
            else 
            {
                $_SESSION['error'] =  !empty($_POST) ? "Le formulaire est incomplet" : '';
                $title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
                $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }
            $form = new Form;

            $form->startForm('post', '#', ['enctype' => 'multipart/formdata'])
                ->addLabel('title', 'Titre de l\'annonce')
                ->addInput('text', 'title', [
                    'id' => 'title', 
                    'class' => 'form-control',
                    'value' => $title
                ])
                ->addLabel('description', 'Texte de l\'annonce')
                ->addTextarea('description', $description, ['id' => 'description', 'class' => 'form-control'])
                ->addLabel('image', 'Image')
                ->addInput('file', 'image', [
                    'id' => 'image', 
                    'class' => 'form-control'
                ])
                ->addBtn('submit', 'Ajouter', ['class' => 'btn btn-primary'])
                ->endForm();

            $this->render('annonces/ajouter', [
                'form' => $form->create()
            ]);
        }
        else 
        {
            $_SESSION['error'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: ' . PATH . 'users/login');
            exit;
        }

    }

    public function modifier(int $id)
    {
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) 
        {
            $annonceModel = new AnnoncesModel;
            $annonce = $annonceModel->find($id);

            if(!$annonce)
            {
                http_response_code(404);
                $_SESSION['error'] = "L'annonce recherchée n'existe pas";
                header('Location: ' . PATH . 'annonces');
                exit;
            }

            if($annonce->users_id != $_SESSION['user']['id'])
            {
                $_SESSION['error'] = 'Vous n\'avez pas accès à cette page';
                header('Location: ' . PATH . 'annonces');
            }

            if(Form::validate($_POST, ['title', 'description']))
            {
                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);

                $annonceEdit = new AnnoncesModel;
                $annonceEdit->setId($annonce->id)
                            ->setTitle($title)
                            ->setDescription($description);

                $annonceEdit->update();

                $_SESSION['message'] = "Votre annonce a été modifiée avec succès";
                header('Location: ' . PATH);
                exit;
            }

            $form = new Form;

            $form->startForm()
                ->addLabel('title', 'Titre de l\'annonce')
                ->addInput('text', 'title', [
                    'id' => 'title', 
                    'class' => 'form-control',
                    'value' => $annonce->title,
                ])
                ->addLabel('description', 'Texte de l\'annonce')
                ->addTextarea('description', $annonce->description, [
                    'id' => 'description', 
                    'class' => 'form-control'
                ])
                ->addBtn('submit', 'Modifier', ['class' => 'btn btn-primary'])
                ->endForm();

                $this->render('annonces/modifier', [
                    'form' => $form->create()
                ]);

        }
        else 
        {
            $_SESSION['error'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: ' . PATH . 'users/login');
            exit;
        }

    }
}