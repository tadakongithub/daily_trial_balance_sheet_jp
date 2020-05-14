<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
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
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="iba.css">
</head>
<body>
    <div class="q-container">
        <h1>茨城店　日計表</h1>
        <form action="" method="post">
            <div class="dc_container each-card">
                <div>11. DCカード金額（1取引ごと）</div>

                <div>
                    <label for="dc_how_much">金額</label>
                    <input type="number" name="dc_how_much[]" id="dc_how_much" required>
                </div>
            </div>
            <button class="add_dc">追加</button>

            <div class="jcb_container each-card">
                <div>12. JCBカード金額（1取引ごと）</div>

                <div>
                    <label for="jcb_how_much">金額</label>
                    <input type="number" name="jcb_how_much[]" id="jcb_how_much" required>
                </div>
            </div>
            <button class="add_jcb">追加</button>

            <div class="paypay_container each-card">
                <div>13. PayPay金額</div>

                <div>
                    <label for="paypay_count">件数</label>
                    <input type="number" name="paypay_count" id="paypay_count">
                    <label for="paypay_total">総額</label>
                    <input type="number" name="paypay_total" id="paypay_total">
                </div>
            </div>

            <div class="others_container each-card">
                <div>14. その他</div>

                <div>
                    <div>
                        <div>Nanaco:</div>
                        <label for="nanaco_count">枚数</label>
                        <input type="number" name="nanaco_count" id="nanaco_count">
                        <label for="nanaco_total">金額</label>
                        <input type="number" name="nanaco_total" id="nanaco_total">
                    </div>
                    <div>
                        <div>Edy:</div>
                        <label for="edy_count">枚数</label>
                        <input type="number" name="edy_count" id="edy_count">
                        <label for="edy_total">金額</label>
                        <input type="number" name="edy_total" id="edy_total">
                    </div>
                    <div>
                        <div>Suica:</div>
                        <label for="suica_count">枚数</label>
                        <input type="number" name="suica_count" id="suica_count">
                        <label for="suica_total">金額</label>
                        <input type="number" name="suica_total" id="suica_total">
                    </div>
                </div>
            </div>

            <input type="submit" value="次へ" name="q_11">
        </form>
    </div>

    <script>
        $(document).ready(function(){

            var add_dc = $(".add_dc");
            var wrapper_dc = $(".dc_container");

            $(add_dc).click(function(e){
                e.preventDefault();
                $(wrapper_dc).append('<div>' +
                    '<label for="dc_how_much">金額</label>' +
                    '<input type="number" name="dc_how_much[]" id="dc_how_much" required>' +
                    '<button class="remove_dc">削除</button>' +
                    '</div>');
            });

            $(wrapper_dc).on('click', '.remove_dc', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            });

            var add_jcb = $(".add_jcb");
            var wrapper_jcb = $(".jcb_container");

            $(add_jcb).click(function(e){
                e.preventDefault();
                $(wrapper_jcb).append(
                    '<div>' +
                    '<label for="jcb_how_much">金額</label>' +
                    '<input type="number" name="jcb_how_much[]" id="jcb_how_much" required>' +
                    '<button class="remove_jcb">削除</button>' +
                    '</div>'
                );
            });

            $(wrapper_jcb).on('click', '.remove_jcb', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            });

        });
    </script>
</body>
</html>