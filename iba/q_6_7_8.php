<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['q_6_7_8']) {
        $_SESSION['next_day_change'] = $_POST['next_day_change'];
        $_SESSION['jisen_total'] = $_POST['jisen_total'];
        $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
        header('Location: q_9_11.php');
    }
?>
<html>
<head>
<?php require './form-head.php';?>
</head>
<body>
    <div class="q-container">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
        <form action="" method="post" class="ui form">
            <div class="each-field field">
                <label for="next_day_change">6. 翌日のつり銭額を入力してください</label>
                <input type="number" name="next_day_change" id="next_day_change" 
                value="<?php echo $_SESSION['next_day_change']; ?>" required>
            </div>

            <div class="each-field field">
                <label for="jisen_total">7. 実残合計</label>
                <input type="number" name="jisen_total" id="jisen_total"
                value="<?php echo $_SESSION['jisen_total']; ?>" required>
            </div>
                
            <div class="each-field field">
                <label for="next_day_deposit">8. 翌日預入の金額を入力してください(0円の場合も記入)。</label>
                <input type="number" name="next_day_deposit" id="next_day_deposit" 
                value="<?php echo $_SESSION['next_day_deposit']; ?>" required>
            </div>

            <input type="hidden" name="q_6_7_8" value="q_6_7_8">
            <button type="submit" class="ui button">次へ</button>
        </form>
    </div>
</body>
</html>