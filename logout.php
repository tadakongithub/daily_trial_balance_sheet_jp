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
    <div class="success-message">ログアウトしました</div>
    <a href="login.php" class="back_to_top">ログインする</a>
    </div>
</body>
</html>