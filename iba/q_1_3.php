<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
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
<?php require '../semantic.php';?>
    <link rel="stylesheet" href="iba.css">
</head>
<body>

    <div class="q-container">
        <h1 class="ui header">茨城店　日計表</h1>
        <form action="" method="post" class="ui form">
            <div class="each-field field">
                <label for="name">1. 名前</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="each-field field">
                <label for="change">2. 釣り銭金額</label>
                <input type="number" name="change" id="change" required>
            </div>

            <div class="each-field field">
                <label for="earning">3. 現金売り上げ</label>
                <input type="number" name="earning" id="earning" required>
            </div>
            <input type="hidden" name="q_1_3" value="q_1_3">
            <div class="submit-container">
                <button type="submit" class="submit-btn">次へ</button>
            </div>
        </form>
    </div>
</body>
</html>