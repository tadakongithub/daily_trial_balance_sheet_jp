<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }
    

    if($_SESSION['previousURI'] === '/lmj_okasato/iba/edit.php') {
        foreach($_SESSION as $key => $val){
            if ($key !== 'branch' && $key !== 'logged_in'){
                unset($_SESSION[$key]);
            }
        }
    }

    require '../db.php';

    if($_POST['next']) {
        
        $statement = $myPDO->query('SELECT * FROM okasato');

        //ログイン中の店舗と選んだ日付がどっちも入っているデータがあるか調べる
        $counter = 0;
        while($row = $statement->fetch()) {
            if($row['date'] === $_POST['date'] && $row['branch'] === $_SESSION['branch']) {
                $counter++;
            }
        }

        //あれば編集画面へ、なければ入力続ける
        if($counter > 0) {
            $_SESSION['date'] = $_POST['date'];
            header('Location: edit.php');
        } else {
            $_SESSION['date'] = $_POST['date'];
            header('Location: q_1_3.php');
        }

    }

    require 'back_to_top_handling.php';

?>
<html>
<head>
<?php require 'form-head.php';?>
</head>
<body>
    <div class="q-container">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="date">今日の日付を入力してください。</label>
                <input type="date" name="date" id="date" value="<?php echo $_SESSION['date'];?>" required>
            </div>
            
            <input type="submit" name="back" value="トップページに戻る" class="back_to_top"/>
            <input type="submit" name="next" value="次へ" />
        </form>
    </div>



    <?php require 'back_to_top_modal.php';?>
</body>
</html>