<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    }

    if($_POST['q_6_7']) {
        $_SESSION['next_day_change'] = $_POST['next_day_change'];
        $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
        header('Location: q_8_10.php');
    }
?>
<html>
<head>
</head>
<body>
    <form action="" method="post">
        <div>
            <div>6. 翌日のつり銭額を入力してください</div>
            <input type="number" name="next_day_change" required>

            <div>7. 翌日預入の金額を入力してください(0円の場合も記入をしてください）</div>
            <input type="number" name="next_day_deposit" required>
        </div>

        <input type="submit" value="次へ" name="q_6_7">
    </form>
</body>
</html>