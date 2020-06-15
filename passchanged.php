<?php
    session_start();
    session_destroy();
?>
<html>
    <head>
        <?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="home-container">
            <div class="success-message">パスワードが変更されました。</div>
            <a href="index.php" class="back_to_top">トップページに戻る</a>
        </div>
    </body>
</html>