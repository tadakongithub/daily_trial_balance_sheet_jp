<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    } 

    require '../db.php';

    if($_POST['dateForm']) {
        
        $results = $myPDO->query('SELECT * FROM ibaraki');

        //ユーザーが入力した日付のデータがすでにデータベースに存在するかチェック
        //同じ日付のデータを複数保存するので、どのレコードを編集できるようにするかでコードを変える
        $matchDate = '';
        while($result = $results->fetch()) {
            if($result['date'] == $_POST['date']) {
                global $matchDate;
                if($matchDate == '') {
                    $matchDate = $_POST['date'];
                }
            }
        }

        //ユーザーが入力した日付のデータがあれば編集ページに、なければ次の入力画面へ
        if($matchDate !== '') {
            $_SESSION['date'] = $matchDate;
            header('Location: edit.php');
        } else {
            $_SESSION['date'] = $_POST['date'];
            header('Location: q_1_3.php');
        }

    }

?>
<html>
<head>
    <link rel="stylesheet" href="iba.css">
</head>
<body>

    <div class="q-container">
        <h1>茨城店　日計表</h1>
        <form action="" method="post" >
            <div class="each-field">
                <label for="date">今日の日付を入力してください。</label>
                <input type="date" name="date" id="date" required>
            </div>
            
            <input type="submit" name="dateForm" class="next-btn" value="次へ">
        </form>
    </div>
</body>
</html>