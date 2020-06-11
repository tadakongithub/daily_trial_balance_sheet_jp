<?php

    session_start();

    if($_SESSION['logged_in'] != 'logged_in') {
        header('Location: login.php');
    }
?>

<html>
    <head>
        <?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="ui two item menu">
            <a class="item" href="index.php">トップ</a>
            <a class="item" href="list.php">ダウンロードページ</a>
        </div>
        <div class="home-container">
            <a href="./iba/date.php" class="to-form">フォームへ</a>
        </div>
        
    </body>
</html>