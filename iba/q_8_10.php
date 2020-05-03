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
        $_SESSION['service_name'] = $_POST['service_name'];
        $_SESSION['for_service_count'] = $_POST['for_service_count'];
        $_SESSION['for_service_total'] = $_POST['for_service_total'];
        header('Location: q_11.php');
    }
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
    
        <div>
            <div>プレミアム食事券の枚数と金額を入力してください</div>

            <div>
                <label for="prem_count">枚数</label>
                <input type="number" name="prem_count" id="prem_count" required>
                <label for="prem_total">金額</label>
                <input type="number" name="prem_total" id="prem_total" required>
            </div>
        </div>

        <div>
            <div>販売用食事券の枚数と金額を入力してください</div>

            <div>
                <label for="for_selling_count">枚数</label>
                <input type="number" name="for_selling_count" id="for_selling_count" required>
                <label for="for_selling_total">金額</label>
                <input type="number" name="for_selling_total" id="for_selling_total" required>
            </div>
        </div>

        <div class="service_wrapper">
            <div>サービス用回収の種類、枚数、金額を入力してください。</div>

            <div>
                <label for="service_name">種類</label>
                <input type="text" name="service_name[]" id="service_name" required>
                <label for="for_service_count">枚数</label>
                <input type="number" name="for_service_count[]" id="for_service_count" required>
                <label for="for_service_total">金額</label>
                <input type="number" name="for_service_total[]" id="for_service_total" required>
            </div>
        </div>
        <button class="add_button">サービス追加</button>

        <input type="submit" value="次へ" name="q_8_10">
    </form>

    <script>
        $(document).ready(function(){
            var add_button = $(".add_button");
            var wrapper = $(".service_wrapper");

            $(add_button).click(function(e){
                e.preventDefault();
                $(wrapper).append(
                    '<div>' +
                    '<label for="service_name">種類</label>' +
                    '<input type="text" name="service_name[]" id="service_name" required>' +
                    '<label for="for_service_count">枚数</label>' +
                    '<input type="number" name="for_service_count[]" id="for_service_count" required>' +
                    '<label for="for_service_total">金額</label>' +
                    '<input type="number" name="for_service_total[]" id="for_service_total" required>' +
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