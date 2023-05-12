<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;


class LoginController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userModel->findByUserName($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /products');
                // Rediriger l'utilisateur vers la page de son choix
                // après la connexion réussie.
            } else {
                $errors = ['Mauvais nom d\'utilisateur ou mot de passe.'];
                $this->render('login/login.html.twig', ['errors' => $errors]);
            }
        } else {
            $this->render('login/login.html.twig', []);
        }
    }

    // public function handleLogin()
    // {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];

    //     $user = $this->userModel->findByUsername($username);

    //     if ($user && password_verify($password, $user['password'])) {
    //         $_SESSION['user_id'] = $user['id'];
    //         header('Location: /products');
    //         exit();
    //     } else {
    //         $this->render('login/loginError.html.twig', ['error' => 'Invalid username or password']);
    //     }
    // }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}































?>