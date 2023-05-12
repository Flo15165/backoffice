<?php



namespace src\controllers;

use core\BaseController;
use src\models\User;


class UserController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User;
    }

    public function updateFormUsers()
    {

        $title = "Page modifier";
        $h2 = "Modification";
        // $this->model->id = $_GET['id'];
        $user = $this->model->getOne($_GET['id']);
        $this->render("users/modifUsers.html.twig", [
            'title' => $title,
            'h2' => $h2,
            'user' => $user
        ]);
    }

    public function updateInDBUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = [
                'id' => $_POST['id'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'budget' => $_POST['budget'],
                'is_admin' => $_POST['is_admin']
            ];

            $users = new User();

            $resultat = $users->updateUsers($data);

            // 4. redirect vers /products
            header('Location: /users');
        }
    }

    

    public function users()
    {
        $title = "Page utilisateurs";
        $h2 = "Utilisateurs";
        $users = $this->model->getAll();
        $this->render('users/listUsers.html.twig', [
            'title' => $title,
            'h2' => $h2,
            'users' => $users
        ]);
    }

    public function addFormUsers(){
        $title = 'Page Ajout Users';
        $h2 = 'Ajouter';

        $this->render("users/addUsers.html.twig", [
            'title' => $title,
            'h2' => $h2           
        ]);
    }

    public function addToDBUsers(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'budget' => $_POST['budget'],
                'is_admin' => $_POST['is_admin']
            ];

            $user = new User();

            $resultat = $user->addToDBUsers($data);

            header('Location: /users');
        }
    }

    public function deleteFormUsers(){
        $title = 'Page suppression utilisateurs';
        $h2 = 'Suppression';
        $user = $this->model->getOne($_GET['id']);
        $this->render('users/deleteUsers.html.twig', [
            'title' => $title,
            'h2' => $h2,
            'user' => $user
        ]);
    }

    public function deleteToDBUsers(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id']
            ];

            $user = new User();

            $resultat = $user->deleteUsers($data);

            header('Location: /users');
        }
    }
}
