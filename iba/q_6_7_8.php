<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['next'] || $_POST['back']) {
        $_SESSION['next_day_change'] = $_POST['next_day_change'];
        $_SESSION['jisen_total'] = $_POST['jisen_total'];
        $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
        if($_POST['next']){
            header('Location: q_9_11.php');
        } else if($_POST['back']){
            header('Location: q_5.php');
        }
    }
?>
<html>
<head>
<?php require './form-head.php';?>
</head>
<body>
    <div class="q-container-add">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
        <form action="" method="post" class="ui form">
        <div class="each-field field">
                <label for="jisen_total">６. 実残合計</label>
                <input type="number" name="jisen_total" id="jisen_total"
                value="<?php echo $_SESSION['jisen_total']; ?>" required>
            </div>

            <div class="each-field field">
                <label for="next_day_change">７. 翌日のつり銭額を入力してください</label>
                <input type="number" name="next_day_change" id="next_day_change" 
                value="<?php echo $_SESSION['next_day_change']; ?>" required>
            </div>

            <div class="each-field field">
                <label for="next_day_deposit">8. 翌日預入の金額を入力してください(0円の場合も記入)。</label>
                <input type="number" name="next_day_deposit" id="next_day_deposit" 
                value="<?php echo $_SESSION['next_day_deposit']; ?>" required>
            </div>

            <?php require 'backnext.php'; ?>
        </form>
    </div>
</body>
</html>