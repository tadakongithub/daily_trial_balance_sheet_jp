<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
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
<?php require './form-head.php';?>
<script>
    $(document).ready(function(){
        if($(window).width() < 480) {
            $('i.plus.square.icon.big').removeClass('big').addClass('massive');
        }
    });
</script>
</head>
<body>
    <div class="q-container-add">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
        <form action="" method="post" id="form_received" class="ui form">
            <h2 class="ui header" id="received_h2">4. 現金の<span class="received_blue">レジ入金</span>を記入してください。</h2>
            <h3 class="ui header">（取引先・お手伝いスタッフの源泉税など）</h3>
            <div class="input_fields_wrapper">
                <?php for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                    <div class="each-received">
                        <div class="icon-container">
                            <image class="remove_field" src="../img/close.png" alt="削除">
                        </div>
                        <div class="each-field field">
                            <label for="received_from">取引先・スタッフ名など</label>
                            <input type="text" name="received_from[]" id="received_from" value="<?php echo $_SESSION['received_from'][$i];?>" required>
                        </div>

                        <div class="each-field field">
                            <label for="total_received">入金額</label>
                            <input type="number" name="total_received[]" id="total_received" value="<?php echo $_SESSION['total_received'][$i];?>" required>
                        </div>

                        <div class="each-field field">
                            <label for="content_received">入金の内容</label>
                            <input type="text" name="content_received[]" id="content_received" value="<?php echo $_SESSION['content_received'][$i];?>" required>            
                        </div>
                    </div>
                <?php endfor;?>
            </div>

            <div class="add-container">
                <img class="add_button" src="../img/plus.png" alt="追加">
            </div>
            <input type="hidden" name="q_4" value="q_4">
            <div class="submit-container">
            <button type="submit" class="ui button">次へ</button>
            </div>
        </form>
    </div>

    

    <script>
        $(document).ready(function(){
            var add_button = $(".add_button");
            var wrapper = $(".input_fields_wrapper");

            $(add_button).click(function(){
                $(wrapper).append(
                    '<div class="each-received">' +
                    '<div class="icon-container">' +
                    '<image class="remove_field" src="../img/close.png" alt="削除">' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="received_from">取引先・スタッフ名など</label>' +
                    '<input type="text" name="received_from[]" id="received_from" required>' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="total_received">入金額</label>' +
                    '<input type="number" name="total_received[]" id="total_received" required>' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="content_received">入金の内容</label>' +
                    '<input type="text" name="content_received[]" id="content_received" required>' +
                    '</div>' +
                    '</div>'
                );
            });

            $(wrapper).on('click', '.remove_field', function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });
        });
    </script>
</body>
</html>