<?php 

namespace App\Controllers;

use App\Core\Form;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function index()
    {
        if(Form::validate($_POST, ['name', 'email', 'message']))
        {
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $message = strip_tags($_POST['message']);

            $contact = new ContactModel;
            $contact->setName($name)
                    ->setEmail($email)
                    ->setMesssage($message);

            $contact->create();
            
            $_SESSION['message'] = "Votre message a été transmis avec succès";
            header('Location: ' . PATH);
            exit;
        }
        else 
        {
            $_SESSION['error'] =  !empty($_POST) ? "Le formulaire est incomplet" : '';
            $name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
            $email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
            $message = isset($_POST['message']) ? strip_tags($_POST['message']) : '';
        }

        $form = new Form();

        $form->startForm()
        ->addLabel('name', 'Nom/Prénom')
        ->addInput('text', 'name', [
            'id' => 'name', 
            'class' => 'form-control',
            'value' => $name,
        ])
        ->addLabel('email', 'Email')
        ->addInput('text', 'email', [
            'id' => 'email',
            'class' => 'form-control',
            'value' => $email
        ])
        ->addLabel('message', 'Message')
        ->addTextarea('message', $message, [
            'id' => 'message', 
            'class' => 'form-control',
            'value' => $message
        ])
        ->addBtn('submit', 'Envoyer', ['class' => 'btn btn-primary mt-2'])
        ->endForm();

        $this->render('contact/contact', [
            'form' => $form->create()
        ]);
    }
}