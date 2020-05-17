<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    } 

    if($_POST["q_1_3"]) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['change'] = $_POST['change'];
        $_SESSION['earning'] = $_POST['earning'];
        header('Location: q_4.php');
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
                <label for="name">1. 名前</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="each-field">
                <label for="change">2. 釣り銭金額</label>
                <input type="number" name="change" id="change" required>
            </div>

            <div class="each-field">
                <label for="earning">3. 現金売り上げ</label>
                <input type="number" name="earning" id="earning" required>
            </div>
            
            <input type="submit" name="q_1_3" class="next-btn" value="次へ">
        </form>
    </div>
</body>
</html>