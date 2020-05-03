<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    } 

    if($_POST["q_1_3"]) {
        $_SESSION['date'] = $_POST['date'];
        $_SESSION['change'] = $_POST['change'];
        $_SESSION['earning'] = $_POST['earning'];
        header('Location: q_4.php');
    }

?>
<html>
<head>
</head>
<body>
    <div>茨城店　日計表</div>
    <form action="" method="post">
        <div>1. 今日の日付を入力してください。</div>
        <input type="date" name="date" required>

        <div>2. 釣り銭金額</div>
        <input type="number" name="change" required>

        <div>3. 現金売り上げ</div>
        <input type="number" name="earning" required>

        <input type="submit" value="次へ" name="q_1_3">
    </form>
</body>
</html>