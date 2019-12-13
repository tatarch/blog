<?php


class UserRepository
{
    public $pdo;

    function __construct()
    {
        $username = "root";
        $password = "";
        $database = "blog";
        $servername = "localhost";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            die('Cannot connect to DB');
        }
        $this->pdo = $pdo;
    }

    function addUser(string $email, string $name, string $password)
    {
        $query = "INSERT INTO users (email, name, password)  VALUES (:email, :name, :password)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email, 'name' => $name, 'password' => $password]);
    }
}


