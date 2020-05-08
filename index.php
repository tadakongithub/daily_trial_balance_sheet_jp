<?php
    session_start();

    require 'db.php';

    $statement = $myPDO->prepare("SELECT * FROM password WHERE store = ?");

    $statement->execute(array('ibaraki'));//店ごとに名前を変える

    $row = $statement -> fetch();
   

    if($_POST['login']) {
        if($_POST['pass'] == $row['password']) {
            $_SESSION['logged_in'] = 'logged_in';
            header('Location: iba/q_1_3.php');
        } else {
            $incorrect_password = 'パスワードが違います';
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="home-container">
            <div>LMJ 茨城店</div>
            <form action="" method="post">
                <input type="text" name="pass">
                <input type="submit" value="ログイン" name="login">
            </form>
            <?php if($incorrect_password):?>
            <div><?php echo $incorrect_password; ?></div>
            <?php endif ;?>
        </div>
    </body>
</html>