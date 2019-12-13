<?php

require 'database/connectors/MysqlConnector.php';

$queries = ['create table articles (
id int primary key auto_increment,
title varchar (255),
text text)',
    'create table users (
id int primary key auto_increment,
email varchar (255),
name varchar (255),
password varchar (255)
)'];

$pdo = MysqlConnector::getConnection();

foreach ($queries as $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
