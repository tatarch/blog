<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class UserRepository
{
    public function addUser(string $email, string $name, string $password)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO users (email, name, password)  VALUES (:email, :name, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email, 'name' => $name, 'password' => $password]);
    }

    public function getByNamePassword($email, $password)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query("SELECT * FROM users WHERE email='" . $email . "' AND password='" . $password . "'");
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);

    }

    public function getById($id)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM users WHERE id=' . $id);
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }
}
