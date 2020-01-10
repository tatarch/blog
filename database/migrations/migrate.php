<?php

require '../../vendor/autoload.php';

$queries = ['create table articles (
id int primary key auto_increment,
title varchar (255),
text text,
date DATETIME,
image varchar (255))',
    'create table users (
id int primary key auto_increment,
email varchar (255),
name varchar (255),
password varchar (255)
)'];

// тут пишется полный путь к классу. убери полный путь, вверху файла напиши use \App\Database\Connectors\MysqlConnector
// а тут пиши просто MysqlConnector
$pdo = \App\Database\Connectors\MysqlConnector::getConnection();

foreach ($queries as $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
