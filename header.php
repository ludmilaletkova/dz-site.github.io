<?php
include 'cfg.php';
?>
<html lang="ru">
    <head>
        <title>Rick and Morty Fandom</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="icon" href="/favicon.png">
    </head>
<body>
    <div class="header">
        <?php
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        ?>
        <a class="login-link" href="/logout.php">Выход</a>
        <div class="login-name">Здравствуйте, <?=$_SESSION['user']['name']?></div>
        <?php
        } else {
        ?>
        <a class="login-link" href="/login.php">Вход</a>
        <?php
        }
        ?>
        <a class="logo" href="/"></a>
    </div>
    <div class="content">
