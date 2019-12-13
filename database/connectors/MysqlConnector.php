<?php

class MysqlConnector
{
    static function getConnection()
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

        return $pdo;
    }
}