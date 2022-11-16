<?php

// Connexion à la bdd


$connect = new PDO(
    "mysql:host=localhost;dbname=site_portfolio",
    "root",
    "root",
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    )
    );

    $alert = '';
    $error = '';

    // var_dump($connect);

    session_start();

    define('URL', 'http://localhost:8888/coyotech/');
    define('STYLE', 'http://localhost:8888/coyotech/css/style.css');

    require_once 'function.php';