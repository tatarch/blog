<?php



$queries = ['create table articles (
id int primary key auto_increment,
title varchar (255),
text text,
image varchar,
date DATETIME
),',
    'create table users (
id int primary key auto_increment,
email varchar (255),
name varchar (255),
password varchar (255)
)'];

$pdo = \App\Database\Connectors\MysqlConnector::getConnection();

foreach ($queries as $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
