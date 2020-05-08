<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    }

    if($_POST['q_8_10']) {
        $_SESSION['prem_count'] = $_POST['prem_count'];
        $_SESSION['prem_total'] = $_POST['prem_total'];
        $_SESSION['for_selling_count'] = $_POST['for_selling_count'];
        $_SESSION['for_selling_total'] = $_POST['for_selling_total'];
        $_SESSION['thousand_count'] = $_POST['thousand_count'];
        $_SESSION['thousand_total'] = 1000 * $_POST['thousand_count'];
        $_SESSION['five_count'] = $_POST['five_count'];
        $_SESSION['five_total'] = 500 * $_POST['five_count'];
        $_SESSION['two_count'] = $_POST['two_count'];
        $_SESSION['two_total'] = 200 * $_POST['two_count'];
        header('Location: q_11.php');
    }
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="iba.css">
</head>
<body>
    <div class="q-container">
        <h1>茨城店　日計表</h1>
        <form action="" method="post">
        
            <div class="each-ticket">
                <div>8. プレミアム食事券の枚数と金額を入力してください</div>

                <div>
                    <label for="prem_count">枚数</label>
                    <input type="number" name="prem_count" id="prem_count" required>
                    <label for="prem_total">金額</label>
                    <input type="number" name="prem_total" id="prem_total" required>
                </div>
            </div>

            <div class="each-ticket">
                <div>9. 販売用食事券の枚数と金額を入力してください</div>

                <div>
                    <label for="for_selling_count">枚数</label>
                    <input type="number" name="for_selling_count" id="for_selling_count" required>
                    <label for="for_selling_total">金額</label>
                    <input type="number" name="for_selling_total" id="for_selling_total" required>
                </div>
            </div>

            <div class="service_wrapper each-ticket">
                <div>10. サービス用回収の種類、枚数、金額を入力してください。</div>

                <div>
                    <div class-"each-field">
                        <label for="thousand_count">1000円券枚数</label>
                        <input type="number" name="thousand_count" id="thousand_count" required>
                    </div>

                    <div class="each-field">
                        <label for="five_count">500円券枚数</label>
                        <input type="number" name="five_count" id="five_count" required>
                    </div>

                    <div class="each-field">
                        <label for="two_count">200円券枚数</label>
                        <input type="number" name="two_count" id="two_count" required>
                    </div>
                </div>
            </div>

            <input type="submit" value="次へ" name="q_8_10">
        </form>
    </div>

</body>
</html>