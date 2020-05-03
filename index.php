<?php
    session_start();

    if($_POST['login']) {
        if($_POST['pass'] == '0000') {
            $_SESSION['logged_in'] = 'logged_in';
            header('Location: iba/q_1_3.php');
        } else {
            $incorrect_password = 'パスワードが違います';
        }
    }
?>

<html>
    <head>
    </head>
    <body>
        <div>LMJ 茨城店</div>
        <form action="" method="post">
            <input type="text" name="pass">
            <input type="submit" value="ログイン" name="login">
        </form>
        <div><?php echo $incorrect_password; ?></div>
    </body>
</html>