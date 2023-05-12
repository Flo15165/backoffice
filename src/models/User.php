<?php


namespace src\models;

use core\BaseModel;


class User extends BaseModel
{
    public function __construct()
    {
        $this->table = 'users';
        $this->getConnection();
    }

    public function updateUsers($data)
    {


        $id = $data['id'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $username = $data['username'];
        $password = $data['password'];
        $budget = $data['budget'];
        $is_admin = $data['is_admin'];

        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, password = :password, budget = :budget, is_admin = :is_admin WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->bindParam(':id', $id);
        $query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':budget', $budget);
        $query->bindParam(':is_admin', $is_admin);

        $resultat = $query->execute();

        if ($resultat) {
            // Retourne le nombre de lignes affectées par la mise à jour
            return $query->rowCount();
        } else {
            // Retourne false si la mise à jour a échoué
            return false;
        }
    }

    public function addToDBUsers($data){
        $id = $data['id'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $username = $data['username'];
        $password = $data['password'];
        $budget = $data['budget'];
        $is_admin = $data['is_admin'];

        $sql = "INSERT INTO users (id, first_name, last_name, username, password, budget, is_admin) VALUES (:id, :first_name, :last_name, :username, :password, :budget, :is_admin)";
        $query = $this->_connexion->prepare($sql);

        $query->bindParam(':id', $id);
        $query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':budget', $budget);
        $query->bindParam(':is_admin', $is_admin);

        $resultat = $query->execute();
        if ($resultat) {
            // Retourne le nombre de lignes affectées par la mise à jour
            return $query->rowCount();
        } else {
            // Retourne false si la mise à jour a échoué
            return false;
        }
    }

    public function deleteUsers($data){
        $id = $data['id'];

        $sql = "DELETE FROM users WHERE id = :id";
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

    public function findByUserName($username)
    {
        $stmt = $this->_connexion->prepare('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }
}
