<?php
    session_start();
?>
<html>
    <head>
        <?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="home-container">
            <div class="success-message">パスワードが変更されました。</div>
            <a href="admin-dashboard.php" class="back_to_top">管理画面に戻る</a>
        </div>
    </body>
</html>