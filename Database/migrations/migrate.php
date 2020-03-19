<?php

use \App\Database\Connectors\MysqlConnector;

require '../../vendor/autoload.php';

$queries = ['create table articles (
id int primary key auto_increment,
title varchar (255),
text text,
date DATETIME)',
    'create table users (
id int primary key auto_increment,
admin tinyint null,
email varchar (255),
name varchar (255),
password varchar (255))',
    'create table  articles_likes (
article_id int unsigned not null, 
user_id int unsigned not null)',
    'create table articles_comments (
id int primary key auto_increment,
article_id int unsigned not null,
user_id int unsigned not null,
user_name varchar (255),
body text,
date DATETIME)',
    'create table  articles_images (
id int primary key auto_increment,
article_id int unsigned not null, 
path varchar(255) not null )',
    'create table  tags (
id int primary key auto_increment,, 
name varchar(255) not null )',
    'create table  articles_tags (
article_id int unsigned not null, 
tag_id int unsigned not null)'];

$pdo = MysqlConnector::getConnection();

foreach ($queries as $query) {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}
