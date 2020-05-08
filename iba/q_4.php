<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    }

    if($_POST['q_4']) {
        $_SESSION['received_from'] = $_POST['received_from'];
        $_SESSION['total_received'] = $_POST['total_received'];
        $_SESSION['content_received'] = $_POST['content_received'];
        header('Location: q_5.php');
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
        <form action="" method="post" id="form_received">
            <div>4. 入金額、取引先やスタッフ名、入金の内容</div>
            <div class="input_fields_wrapper">
                <div class="each-received">
                    <div class="each-field">
                        <label for="received_from">取引先</label>
                        <input type="text" name="received_from[]" id="received_from" required>
                    </div>

                    <div class="each-field">
                        <label for="total_received">入金額</label>
                        <input type="number" name="total_received[]" id="total_received" required>
                    </div>

                    <div class="each-field">
                        <label for="content_received">入金の内容</label>
                        <input type="text" name="content_received[]" id="content_received" required>            
                    </div>
                </div>
            </div>

            <button class="add_button">追加</button>
            <input type="submit" value="次へ" name="q_4">
        </form>
    </div>

    

    <script>
        $(document).ready(function(){
            var add_button = $(".add_button");
            var wrapper = $(".input_fields_wrapper");

            $(add_button).click(function(){
                $(wrapper).append(
                    '<div class="each-received">' +
                    '<div class="each-field">' +
                    '<label for="received_from">取引先</label>' +
                    '<input type="text" name="received_from[]" id="received_from" required>' +
                    '</div>' +
                    '<div class="each-field">' +
                    '<label for="total_received">入金額</label>' +
                    '<input type="number" name="total_received[]" id="total_received" required>' +
                    '</div>' +
                    '<div class="each-field">' +
                    '<label for="content_received">入金の内容</label>' +
                    '<input type="text" name="content_received[]" id="content_received" required>' +
                    '</div>' +
                    '<button class="remove_field">削除</button>' +
                    '</div>'
                );
            });

            $(wrapper).on('click', '.remove_field', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            });
        });
    </script>
</body>
</html>