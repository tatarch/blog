<?php
// форматируй код
use \App\Database\Connectors\MysqlConnector;
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
password varchar (255))',
    'create table  articles_likes (
article_id int unsigned not null, 
user_id int unsigned not null)'];

//ты поправила код, молодец. но теперь этот комментарий не актуален. удали его

// тут пишется полный путь к классу. убери полный путь, вверху файла напиши use \App\Database\Connectors\MysqlConnector
// а тут пиши просто MysqlConnector
$pdo = MysqlConnector::getConnection();

foreach ($queries as $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
