<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['q_12_15']) {
        $_SESSION['dc_how_much'] = $_POST['dc_how_much'];
        $_SESSION['jcb_how_much'] = $_POST['jcb_how_much'];
        $_SESSION['paypay_count'] = $_POST['paypay_count'];
        $_SESSION['paypay_total'] = $_POST['paypay_total'];
        $_SESSION['nanaco_count'] = $_POST['nanaco_count'];
        $_SESSION['nanaco_total'] = $_POST['nanaco_total'];
        $_SESSION['edy_count'] = $_POST['edy_count'];
        $_SESSION['edy_total'] = $_POST['edy_total'];
        $_SESSION['transport_ic_count'] = $_POST['transport_ic_count'];
        $_SESSION['transport_ic_total'] = $_POST['transport_ic_total'];
        $_SESSION['quick_pay_count'] = $_POST['quick_pay_count'];
        $_SESSION['quick_pay_total'] = $_POST['quick_pay_total'];
        $_SESSION['waon_count'] = $_POST['waon_count'];
        $_SESSION['waon_total'] = $_POST['waon_total'];
        header('Location: q_16.php');
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
            <div class="dc_container each-card">
                <h2 class="ui header">12. DCカード金額（1取引ごと）</h2>

                <div class="field">
                    <label for="dc_how_much">金額</label>
                    <input type="number" name="dc_how_much[]" id="dc_how_much" 
                    value="<?php echo $_SESSION['dc_how_much'][0];?>" placeholder="取引なしは0" required>
                </div>
            </div>
            <div class="add-container">
                <img class="add_button add_dc" src="../img/plus.png" alt="追加">
            </div>

            <div class="jcb_container each-card">
                <h2 class="ui header">13. JCBカード金額（1取引ごと）</h2>

                <div class="field">
                    <label for="jcb_how_much">金額</label>
                    <input type="number" name="jcb_how_much[]" id="jcb_how_much"
                    value="<?php echo $_SESSION['jcb_how_much'][0];?>" placeholder="取引なしは0" required>
                </div>
            </div>
            <div class="add-container">
            <img class="add_button add_jcb" src="../img/plus.png" alt="追加">
            </div>

            <div class="paypay_container each-card">
                <h2 class="ui header">14. PayPay金額</h2>

                <div class="field">
                    <label for="paypay_count">件数</label>
                    <input type="number" name="paypay_count" placeholder="取引なしは0" 
                    value="<?php echo $_SESSION['paypay_count'];?>" id="paypay_count">
                </div>
                <div class="field">
                    <label for="paypay_total">総額</label>
                    <input type="number" name="paypay_total" placeholder="取引なしは0"
                    value="<?php echo $_SESSION['paypay_total'];?>" id="paypay_total">
                </div>
            </div>

            <div class="others_container each-card">
                <h2 class="ui header">15. その他</h2>

                <div class="field">
                    <label for="nanaco_count">nanaco件数</label>
                    <input type="number" name="nanaco_count" value="<?php echo $_SESSION['nanaco_count'];?>" placeholder="取引なしは0" id="nanaco_count">
                </div>
                <div class="field">
                    <label for="nanaco_total">nanaco金額</label>
                    <input type="number" name="nanaco_total" value="<?php echo $_SESSION['nanaco_total'];?>" placeholder="取引なしは0" id="nanaco_total">
                </div>


                <div class="field">
                    <label for="edy_count">Edy件数</label>
                    <input type="number" name="edy_count" value="<?php echo $_SESSION['edy_count'];?>" placeholder="取引なしは0" id="edy_count">
                </div>
                <div class="field">
                    <label for="edy_total">Edy金額</label>
                    <input type="number" name="edy_total" value="<?php echo $_SESSION['edy_total'];?>" placeholder="取引なしは0" id="edy_total">
                </div>
                

                <div class="field">
                    <label for="transport_ic_count">交通IC件数</label>
                    <input type="number" name="transport_ic_count" value="<?php echo $_SESSION['transport_ic_count'];?>" placeholder="取引なしは0">
                </div>
                <div class="field">
                    <label for="transport_ic_total">交通IC金額</label>
                    <input type="number" name="transport_ic_total" value="<?php echo $_SESSION['transport_ic_total'];?>" placeholder="取引なしは0" >
                </div>

                <div class="field">
                    <label for="quick_pay_count">Quick Pay 件数</label>
                    <input type="number" name="quick_pay_count" value="<?php echo $_SESSION['quick_pay_count'];?>" placeholder="取引なしは0">
                </div>
                <div class="field">
                    <label for="quick_pay_total">Quick Pay 金額</label>
                    <input type="number" name="quick_pay_total" value="<?php echo $_SESSION['quick_pay_total'];?>" placeholder="取引なしは0">
                </div>

                <div class="field">
                    <label for="waon_count">WAON 件数</label>
                    <input type="number" name="waon_count" value="<?php echo $_SESSION['waon_count'];?>" placeholder="取引なしは0">
                </div>
                <div class="field">
                    <label for="waon_total">WAON 金額</label>
                    <input type="number" name="waon_total" value="<?php echo $_SESSION['waon_total'];?>" placeholder="取引なしは0">
                </div>

            </div>

            <input type="hidden" name="q_12_15" value="q_12_15">
            <button type="submit" class="ui button">次へ</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){

            var add_dc = $(".add_dc");
            var wrapper_dc = $(".dc_container");

            $(add_dc).click(function(e){
                e.preventDefault();
                $(wrapper_dc).append('<div class="field">' +
                    '<div class="icon-container">' +
                    '<img class="remove_dc" src="../img/close.png" alt="削除">' +
                    '</div>' +
                    '<label for="dc_how_much">金額</label>' +
                    '<input type="number" name="dc_how_much[]" id="dc_how_much" placeholder="取引なしは0" required>' +
                    '</div>');
            });

            $(wrapper_dc).on('click', '.remove_dc', function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });

            var add_jcb = $(".add_jcb");
            var wrapper_jcb = $(".jcb_container");

            $(add_jcb).click(function(e){
                e.preventDefault();
                $(wrapper_jcb).append(
                    '<div class="field">' +
                    '<div class="icon-container">' +
                    '<img class="remove_jcb" src="../img/close.png" alt="削除">' +
                    '</div>' +
                    '<label for="jcb_how_much">金額</label>' +
                    '<input type="number" name="jcb_how_much[]" id="jcb_how_much" placeholder="取引なしは0" required>' +
                    '</div>'
                );
            });

            $(wrapper_jcb).on('click', '.remove_jcb', function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });

        });
    </script>
</body>
</html>