<?php
session_destroy();
?>
<html>
<head>
<?php require 'head.php'; ?>
</head>
<body>
    <div class="home-container">
    <div class="success-message">あなたが入力中に、他のユーザーが同日のデータを送信しました。<br>
    そのデータを更新する場合は、トップページからやり直してください。</div>
    <a href="index.php" class="back_to_top">トップページに戻る</a>
    </div>
</body>
</html>