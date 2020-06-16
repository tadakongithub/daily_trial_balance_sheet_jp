<?php
    session_start();

    if($_POST['newpass']) {
        if($_POST['newpass'] !== $_POST['newpassconf']) {
            $wrongpass = "1回目と2回目のパスワードが一致しませんでした。";
        } else {
            $hashed_password = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
            require 'db.php';
            $sql = "UPDATE password SET password = ? WHERE store = 'ibaraki'";
            $stmt = $myPDO->prepare($sql);
            $stmt->execute([$hashed_password]);
            header('Location: passchanged.php');
        }
    }
?>

<html>
<head>
        <?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="admin-header" class="ui three item menu">
            <a href="admin-dashboard.php" class="item">管理画面</a>
            
            <a href="list.php" class="item">ダウンロード</a>
        
            <a class="item" href="admin-logout.php">ログアウト</a>
        </div>

        <div class="home-container">
        <p><?php echo $wrongpass;?></p>
            <form action="" method="post" class="ui form">
                <div class="field">
                    <label for="newpass">新しいパスワード</label>
                    <input type="password" name="newpass" id="newpass">
                </div>

                <div class="field">
                    <label for="newpassconf">もう一度入力</label>
                    <input type="password" name="newpassconf" id="newpassconf">
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-btn">変更</button>
                </div>
            </form>
        </div>
    </body>
</html>