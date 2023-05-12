<?php



namespace src\controllers;

use core\BaseController;
use src\models\Product;


class ProductController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Product;
    }

    public function index()
    {
        $title = "Page products";
        $h2 = "Liste des produits";
        $products = $this->model->getAll();
        $this->render("products/listProducts.html.twig", [
            'title' => $title,
            'h2' => $h2,
            'products' => $products
        ]);
    }

    public function updateFormProducts()
    {

        $title = "Page modifier";
        $h2 = "Modification";
        //$this->model->id = $_GET['id'];
        $product = $this->model->getOne($_GET['id']);
        $this->render("products/modifProducts.html.twig", [
            'title' => $title,
            'h2' => $h2,
            'product' => $product
        ]);
    }

    

    public function updateInDBProducts()
    {
        // 2. transmettre au modèle ton tableau POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = [
                'id' => $_POST['id'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            ];

            $product = new Product();

            $resultat = $product->updateProducts($data);

            // 4. redirect vers /products
            header('Location: /products');
        }
    }

    public function addFormProducts(){
        $title = 'Page Ajout';
        $h2 = 'Ajouter';
        $this->render("products/addProducts.html.twig", [
            'title' => $title,
            'h2' => $h2,
        ]);
    }

    public function addToDBProducts() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            ];

            $product = new Product();

            $resultat = $product->addProducts($data);

            header('Location: /products');
        }
    }

    public function deleteFormProducts(){
        $title = 'Page suppression produits';
        $h2 = 'Suppression';
        $product = $this->model->getOne($_GET['id']);
        $this->render("products/deleteProducts.html.twig", [
            'title' => $title,
            'h2' => $h2,
            'product' => $product
        ]);
    }

    public function deleteToDBProducts(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $_POST['id'],
            ];

            $product = new Product();

            $resultat = $product->deleteProducts($data);

            header('Location: /products');
        }
    }
}
