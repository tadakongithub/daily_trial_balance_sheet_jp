<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['q_9_11']) {
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
        header('Location: q_12_15.php');
    }
?>
<html>
<head>
<?php require '../semantic.php';?>
<link rel="stylesheet" href="iba.css">
</head>
<body>
    <div class="q-container-add">
        <h1 class="ui header">茨城店　日計表</h1>
        <form action="" method="post" class="ui form">
        
            <div class="each-ticket">
                <h2 class="ui header">9. プレミアム食事券の枚数と金額を入力してください</h2>

                <div class="field">
                    <label for="prem_count">枚数</label>
                    <input type="number" name="prem_count" id="prem_count" placeholder="取引なしは0" required>
                </div>
                <div class="field">
                    <label for="prem_total">金額</label>
                    <input type="number" name="prem_total" id="prem_total" placeholder="取引なしは0" required>
                </div>
            </div>

            <div class="each-ticket">
                <h2 class="ui header">10. 販売用食事券の枚数と金額を入力してください</h2>

                <div class="field">
                    <label for="for_selling_count">枚数</label>
                    <input type="number" name="for_selling_count" id="for_selling_count" placeholder="取引なしは0" required>
                </div>
                <div class="field">
                    <label for="for_selling_total">金額</label>
                    <input type="number" name="for_selling_total" id="for_selling_total" placeholder="取引なしは0" required>
                </div>
            </div>

            <div class="service_wrapper each-ticket">
                <h2 class="ui header">11. サービス用回収の種類、枚数、金額を入力してください。</h2>

                <div class="field">
                    <label for="thousand_count">1000円券枚数</label>
                    <input type="number" name="thousand_count" id="thousand_count" placeholder="取引なしは0" required>
                </div>
                   
                <div class="field">
                    <label for="five_count">500円券枚数</label>
                    <input type="number" name="five_count" id="five_count" placeholder="取引なしは0" required>
                </div>
                   
                <div class="field">
                    <label for="two_count">200円券枚数</label>
                    <input type="number" name="two_count" id="two_count" placeholder="取引なしは0" required>
                </div>       
            </div>

            <input type="hidden" name="q_9_11" value="q_9_11">
            <div class="submit-container">
                <button type="submit" class="submit-btn">次へ</button>
            </div>
        </form>
    </div>

</body>
</html>