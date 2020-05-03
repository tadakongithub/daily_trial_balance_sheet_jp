<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    }

    if($_POST['q_5']) {
        $_SESSION['sent_to'] = $_POST['sent_to'];
        $_SESSION['total_sent'] = $_POST['total_sent'];
        $_SESSION['content_sent'] = $_POST['content_sent'];
        header('Location: q_6_7.php');
    }
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post" id="form_received">
    <div>5. 出金額、取引先やスタッフ名、出金の内容</div>
    <div class="input_fields_wrapper">
        <div>
            <label for="sent_to">取引先</label>
            <input type="text" name="sent_to[]" id="sent_to" required>

            <label for="total_sent">出金額</label>
            <input type="number" name="total_sent[]" id="total_sent" required>

            <label for="content_sent">出金の内容</label>
            <input type="text" name="content_sent[]" id="content_sent" required>            
        </div>
    </div>

    <input type="submit" value="次へ" name="q_5">
    </form>

    <button class="add_button">追加</button>

    <script>
        $(document).ready(function(){
            var add_button = $(".add_button");
            var wrapper = $(".input_fields_wrapper");

            $(add_button).click(function(){
                $(wrapper).append(
                    '<div>' +
                    '<label for="sent_to">取引先</label>' +
                    '<input type="text" name="sent_to[]" id="sent_to" required>' +
                    '<label for="total_sent">出金額</label>' +
                    '<input type="number" name="total_sent[]" id="total_sent" required>' +
                    '<label for="content_sent">出金の内容</label>' +
                    '<input type="text" name="content_sent[]" id="content_sent" required>' +
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