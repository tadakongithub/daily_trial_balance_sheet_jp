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
        $_SESSION['which_card'] = $_POST['which_card'];
        $_SESSION['others_count'] = $_POST['others_count'];
        $_SESSION['others_total'] = $_POST['others_total'];
        header('Location: confirmation.php');
    }
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <div class="dc_container">
            <div>DCカード金額（1取引ごと）</div>

            <div>
                <label for="dc_how_much">金額</label>
                <input type="number" name="dc_how_much[]" id="dc_how_much" required>
            </div>
        </div>
        <button class="add_dc">追加</button>

        <div class="jcb_container">
            <div>JCBカード金額（1取引ごと）</div>

            <div>
                <label for="jcb_how_much">金額</label>
                <input type="number" name="jcb_how_much[]" id="jcb_how_much" required>
            </div>
        </div>
        <button class="add_jcb">追加</button>

        <div class="paypay_container">
            <div>PayPay金額</div>

            <div>
                <label for="paypay_count">件数</label>
                <input type="number" name="paypay_count" id="paypay_count">
                <label for="paypay_total">総額</label>
                <input type="number" name="paypay_total" id="paypay_total">
            </div>
        </div>

        <div class="others_container">
            <div>その他</div>

            <div>
                <label for="which_card">カード</label>
                <select name="which_card" id="which_card">
                    <option value="nanaco">nanaco</option>
                    <option value="edy">edy</option>
                    <option value="suica">suica</option>
                </select>
                <label for="others_count">件数</label>
                <input type="number" name="others_count" id="others_count">
                <label for="others_total">金額</label>
                <input type="number" name="others_total" id="others_total">
            </div>
        </div>

        <input type="submit" value="確認画面へ" name="q_11">
    </form>

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