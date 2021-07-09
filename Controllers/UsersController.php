<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{

    public function login()
    {

        if(Form::validate($_POST, ['email', 'password']))
        {
            $userModel = new UsersModel;
            $userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));

            if(!$userArray)
            {
                $_SESSION['error'] = "L'adresse e-mail et/ou le mot de passe est incorrect";
                header('Location: ' . PATH . '/users/login');
                exit;
            }

            $user = $userModel->hydrate($userArray);

            if(password_verify($_POST['password'], $user->getPassword()))
            {
                $user->setSession();
                header('Location: ' . PATH . '/');
                exit;
            }
            else 
            {
                $_SESSION['error'] = "L'adresse e-mail et/ou le mot de passe est incorrect";
                header('Location: ' . PATH . '/users/login');
                exit;
            }
        }

        $form = new Form;

        $form->startForm()
            ->addLabel('email', 'E-mail')
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabel('password', 'Mot de passe')
            ->addInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->addBtn('submit', 'Se connecter', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('users/login', [
            'form' => $form->create()
        ]);
    }

    public function register()
    {

        if(Form::validate($_POST, ['email', 'password']))
        {
            $email = strip_tags($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

            $user = new UsersModel;
            $user->setEmail($email)
                ->setPassword($password);

            $user->create();
        }

        $form = new Form();

        $form->startForm()
            ->addLabel('email', 'E-mail')
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabel('password', 'Mot de passe')
            ->addInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->addBtn('submit', 'M\'inscrire', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('users/register', [
            'form' => $form->create()
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

}