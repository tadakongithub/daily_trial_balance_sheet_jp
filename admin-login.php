<?php

session_start();

require 'db.php';

$statement = $myPDO->prepare("SELECT * FROM admin_password WHERE store = ?");

    $statement->execute(array('ibaraki'));//店ごとに名前を変える

    $row = $statement -> fetch();
   

    if($_POST['login']) {
        if(password_verify($_POST['admin-pass'], $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin-dashboard.php');
        } else {
            $incorrect_password = 'パスワードが違います';
        }
    }

?>
<html>
<head>
<?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="home-container">
        <form action="" method="post" class="ui form"  name="login">
            <div class="field">
                <input type="password" name="admin-pass" placeholder="管理者パスワードを入力">
            </div>
            <input type="hidden" name="login" value="login">
            <div class="submit-container">
                <button type="submit" class="submit-btn">ログイン</button>
            </div>
        </form>
            <?php if($incorrect_password):?>
            <div><?php echo $incorrect_password; ?></div>
            <?php endif ;?>
</div>
</body>
</html>

