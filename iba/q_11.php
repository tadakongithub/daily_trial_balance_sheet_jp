<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['q_11']) {
        $_SESSION['dc_how_much'] = $_POST['dc_how_much'];
        $_SESSION['jcb_how_much'] = $_POST['jcb_how_much'];
        $_SESSION['paypay_count'] = $_POST['paypay_count'];
        $_SESSION['paypay_total'] = $_POST['paypay_total'];
        $_SESSION['nanaco_count'] = $_POST['nanaco_count'];
        $_SESSION['nanaco_total'] = $_POST['nanaco_total'];
        $_SESSION['edy_count'] = $_POST['edy_count'];
        $_SESSION['edy_total'] = $_POST['edy_total'];
        $_SESSION['suica_count'] = $_POST['suica_count'];
        $_SESSION['suica_total'] = $_POST['suica_total'];
        header('Location: q_12.php');
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
            <div class="dc_container each-card">
                <h2 class="ui header">11. DCカード金額（1取引ごと）</h2>

                <div class="field">
                    <label for="dc_how_much">金額</label>
                    <input type="number" name="dc_how_much[]" id="dc_how_much" required>
                </div>
            </div>
            <div class="add-container">
                <img class="add_button add_dc" src="../img/plus.png" alt="追加">
            </div>

            <div class="jcb_container each-card">
                <h2 class="ui header">12. JCBカード金額（1取引ごと）</h2>

                <div class="field">
                    <label for="jcb_how_much">金額</label>
                    <input type="number" name="jcb_how_much[]" id="jcb_how_much" required>
                </div>
            </div>
            <div class="add-container">
            <img class="add_button add_jcb" src="../img/plus.png" alt="追加">
            </div>

            <div class="paypay_container each-card">
                <h2 class="ui header">13. PayPay金額</h2>

                <div class="field">
                    <label for="paypay_count">件数</label>
                    <input type="number" name="paypay_count" id="paypay_count">
                </div>
                <div class="field">
                    <label for="paypay_total">総額</label>
                    <input type="number" name="paypay_total" id="paypay_total">
                </div>
            </div>

            <div class="others_container each-card">
                <h2 class="ui header">14. その他</h2>

                <div class="field">
                    <label for="nanaco_count">Nanaco枚数</label>
                    <input type="number" name="nanaco_count" id="nanaco_count">
                </div>
                <div class="field">
                    <label for="nanaco_total">Nanaco金額</label>
                    <input type="number" name="nanaco_total" id="nanaco_total">
                </div>


                <div class="field">
                    <label for="edy_count">Edy枚数</label>
                    <input type="number" name="edy_count" id="edy_count">
                </div>
                <div class="field">
                    <label for="edy_total">Edy金額</label>
                    <input type="number" name="edy_total" id="edy_total">
                </div>
                

                <div class="field">
                    <label for="suica_count">Suica枚数</label>
                    <input type="number" name="suica_count" id="suica_count">
                </div>
                <div class="field">
                    <label for="suica_total">Suica金額</label>
                    <input type="number" name="suica_total" id="suica_total">
                </div>

            </div>

            <input type="hidden" name="q_11" value="q_11">
            <div class="submit-container">
                <button type="submit" class="submit-btn">次へ</button>
            </div>
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
                    '<input type="number" name="dc_how_much[]" id="dc_how_much" required>' +
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
                    '<input type="number" name="jcb_how_much[]" id="jcb_how_much" required>' +
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