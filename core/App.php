<?php



namespace core;

use src\controllers\ProductController;
use src\controllers\UserController;
use src\controllers\LoginController;

class App
{

    public function __construct()
    {
        session_start();
    }

    public function run()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        if (isset($_SESSION['user_id'])) {
            if ($uri == '/index') {
                echo 'bonjour';
                //  -----------------------------------------------------------------------------           
            } else if ($uri == '/products') {
                $controller = new ProductController;
                $controller->index();
            } else if ($uri == '/modifProducts/') {
                $controller = new ProductController;
                $controller->updateFormProducts();
            } else if ($uri == '/products/update') {
                $controller = new ProductController;
                $controller->updateInDBProducts();
            } else if ($uri == '/addProducts') {
                $controller = new ProductController;
                $controller->addFormProducts();
            } else if ($uri == '/products/modify') {
                $controller = new ProductController;
                $controller->addToDBProducts();
            } else if ($uri == '/deleteProducts/') { // xxxxxxxxxxx
                $controller = new ProductController;
                $controller->deleteFormProducts();
            } else if ($uri == '/products/delete') {
                $controller = new ProductController;
                $controller->deleteToDBProducts();
            }
            //  -----------------------------------------------------------------------------
            else if ($uri == '/users') {
                $controller = new UserController();
                $controller->users();
            } else if ($uri == '/modifUsers/') {
                $controller = new UserController;
                $controller->updateFormUsers();
            } else if ($uri == '/users/update') {
                $controller = new UserController;
                $controller->updateInDBUsers();
            } else if ($uri == '/addUsers') {
                $controller = new UserController;
                $controller->addFormUsers();
            } else if ($uri == '/users/modify') {
                $controller = new UserController;
                $controller->addToDBUsers();
            } else if ($uri == '/deleteUsers/') {
                $controller = new UserController;
                $controller->deleteFormUsers();
            } else if ($uri == '/users/delete') {
                $controller = new UserController;
                $controller->deleteToDBUsers();
            } else if ($uri == '/logout') {
                $controller = new LoginController;
                $controller->logout();
            }
        } else {
            if ($uri == '/login') {
                $controller = new LoginController;
                $controller->login();
            } else {
                header('Location: /login');
            }
        }


        //  -----------------------------------------------------------------------------


    }
}
