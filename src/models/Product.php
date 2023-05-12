<?php


namespace src\models;

use core\BaseModel;


class Product extends BaseModel
{
    public function __construct()
    {
        $this->table = 'products';
        $this->getConnection();
    }
    // 3. créer méthode update($data)

    public function updateProducts($data)
    {


        $id = $data['id'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        $sql = "UPDATE products SET price = :price, quantity = :quantity WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->bindParam(':id', $id);
        $query->bindParam(':price', $price);
        $query->bindParam(':quantity', $quantity);

        $resultat = $query->execute();

        if ($resultat) {
            // Retourne le nombre de lignes affectées par la mise à jour
            return $query->rowCount();
        } else {
            // Retourne false si la mise à jour a échoué
            return false;
        }
    }

    public function addProducts($data){
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        $sql = "INSERT INTO products (id, name, price, quantity) VALUES (:id, :name, :price, :quantity)";
        $query = $this->_connexion->prepare($sql);

        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':price', $price);
        $query->bindParam(':quantity', $quantity);

        $resultat = $query->execute();

        if ($resultat) {
            // Retourne le nombre de lignes affectées par la mise à jour
            return $query->rowCount();
        } else {
            // Retourne false si la mise à jour a échoué
            return false;
        }
        
    }

    public function deleteProducts($data){
        $id = $data['id'];

        $sql = "DELETE FROM products WHERE id = :id";
        $query = $this->_connexion->prepare($sql);

        $query->bindParam(':id', $id);

        $resultat = $query->execute();

        if ($resultat) {
            // Retourne le nombre de lignes affectées par la mise à jour
            return $query->rowCount();
        } else {
            // Retourne false si la mise à jour a échoué
            return false;
        }
    }
}
