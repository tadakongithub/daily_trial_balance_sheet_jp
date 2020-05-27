<?php
    if($_POST['newpass']) {
        $hashed_password = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        require 'db.php';
        $sql = "UPDATE password SET password = ? WHERE store = 'ibaraki'";
        $stmt = $myPDO->prepare($sql);
        $stmt->execute([$hashed_password]);
        header('Location: passchanged.php');
    }
?>

<html>
<head>
        <?php require 'semantic.php'; ?>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="home-container">
            <form action="" method="post" class="ui form">
                <div class="field">
                    <label for="newpass">新しいパスワード</label>
                    <input type="password" name="newpass" id="newpass">
                    <div class="submit-container">
                    <button type="submit" class="submit-btn">変更</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </body>
</html>