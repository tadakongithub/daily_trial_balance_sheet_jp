<?php

session_start();

if(!$_SESSION['admin_logged_in']) {
    header('Location: index.php');
}

?>

<html>
<head>
    <?php require 'semantic.php'; ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
        <div id="admin-header" class="ui two item menu">
            <a class="item ui">
                管理画面
            </a>
    
            <a class="ui item" href="admin-logout.php">
                ログアウト
            </a>
        </div>
            
        </div>

        <div class="admin-container">
            <a href="admin-pass.php">フォーム用パスワード変更</a>
            <a href="list.php">ダウンロードページ</a>
        </div>
</body>
</html>