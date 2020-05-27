<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['q_6_7']) {
        $_SESSION['next_day_change'] = $_POST['next_day_change'];
        $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
        header('Location: q_8_10.php');
    }
?>
<html>
<head>
<?php require '../semantic.php';?>
<link rel="stylesheet" href="iba.css" >
</head>
<body>
    <div class="q-container">
        <h1 class="ui header">茨城店　日計表</h1>
        <form action="" method="post" class="ui form">
            <div class="each-field field">
                <label for="next_day_change">6. 翌日のつり銭額を入力してください</label>
                <input type="number" name="next_day_change" id="next_day_change" required>
            </div>
                
            <div class="each-field field">
                <label for="next_day_deposit">7. 翌日預入の金額を入力してください(0円の場合も記入)。</label>
                <input type="number" name="next_day_deposit" id="next_day_deposit" required>
            </div>

            <input type="hidden" name="q_6_7" value="q_6_7">
            <div class="submit-container">
                <button type="submit" class="submit-btn">次へ</button>
            </div>
        </form>
    </div>
</body>
</html>