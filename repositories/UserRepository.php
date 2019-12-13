<?php

class UserRepository
{
    function addUser(string $email, string $name, string $password)
    {
        $connector = new MysqlConnector();
        $pdo=$connector->getConnection();

        $query = "INSERT INTO users (email, name, password)  VALUES (:email, :name, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email, 'name' => $name, 'password' => $password]);
    }
}


