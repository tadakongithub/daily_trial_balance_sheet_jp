<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['next'] || $_POST['back']) {
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
        if($_POST['next']){
            header('Location: q_12_15.php');
        } else if($_POST['back']){
            header('Location: q_6_7_8.php');
        }
    }

    require 'back_to_top_handling.php';
?>
<html>
<head>
<?php require './form-head.php';?>
</head>
<body>
    <div class="q-container-add">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
        <form action="" method="post" class="ui form">
        
            <div class="each-ticket">
                <h2 class="ui header">9. プレミアム食事券の枚数と金額を入力してください</h2>

                <div class="field">
                    <label for="prem_count">枚数</label>
                    <input type="number" name="prem_count" id="prem_count"
                    value="<?php echo $_SESSION['prem_count'];?>" placeholder="取引なしは0" required>
                </div>
                <div class="field">
                    <label for="prem_total">金額</label>
                    <input type="number" name="prem_total" id="prem_total"
                    value="<?php echo $_SESSION['prem_total'];?>" placeholder="取引なしは0" required>
                </div>
            </div>

            <div class="each-ticket">
                <h2 class="ui header">10. 販売用食事券の枚数と金額を入力してください</h2>

                <div class="field">
                    <label for="for_selling_count">枚数</label>
                    <input type="number" name="for_selling_count" id="for_selling_count"
                    value="<?php echo $_SESSION['for_selling_count'];?>" placeholder="取引なしは0" required>
                </div>
                <div class="field">
                    <label for="for_selling_total">金額</label>
                    <input type="number" name="for_selling_total" id="for_selling_total"
                    value="<?php echo $_SESSION['for_selling_total'];?>" placeholder="取引なしは0" required>
                </div>
            </div>

            <div class="service_wrapper each-ticket">
                <h2 class="ui header">11. サービス用回収の種類、枚数、金額を入力してください。</h2>

                <div class="field">
                    <label for="thousand_count">1000円券枚数</label>
                    <input type="number" name="thousand_count" id="thousand_count" 
                    value="<?php echo $_SESSION['thousand_count'];?>" placeholder="取引なしは0" required>
                </div>
                   
                <div class="field">
                    <label for="five_count">500円券枚数</label>
                    <input type="number" name="five_count" id="five_count" 
                    value="<?php echo $_SESSION['five_count'];?>"placeholder="取引なしは0" required>
                </div>
                   
                <div class="field">
                    <label for="two_count">200円券枚数</label>
                    <input type="number" name="two_count" id="two_count"
                    value="<?php echo $_SESSION['two_count'];?>" placeholder="取引なしは0" required>
                </div>       
            </div>

        
            <div class="back_next_container">
                <input type="submit" name="next" value="次へ" class="next_button"/>
                <?php if($_SESSION['went_to_confirmation']):?>
                <input type="submit" name="back" value="戻る" class="back_button"/>
                <?php else:?>
                <a href="q_6_7_8.php" class="back_button">戻る</a>
                <?php endif ;?>
            </div>
            <?php require 'back_to_top.php';?>
        </form>
    </div>

    <?php require 'back_to_top_modal.php';?>

</body>
</html>