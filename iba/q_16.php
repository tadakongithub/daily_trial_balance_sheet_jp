<?php

session_start();

if($_SESSION['logged_in'] !== 'logged_in') {
    header('Location: ../index.php');
}

if($_POST['next']) {
    $_SESSION['client_name'] = $_POST['client_name'];
    $_SESSION['urikake_total'] = $_POST['urikake_total'];
    header('Location: confirmation.php');
}

if($_POST['back']) {
    $_SESSION['client_name'] = $_POST['client_name'];
    $_SESSION['urikake_total'] = $_POST['urikake_total'];
    header('Location: q_12_15.php');
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
            <h2 class="ui header">16. 売掛金</h2>

            <div class="client-container">
                <?php for($i = 0; $i < count($_SESSION['client_name']); $i++): ?>
                <div class="each-client">
                    <div class="icon-container">
                        <img class="remove_field" src="../img/close.png" alt="削除">
                    </div>
                    <div class="each-field field">
                        <label for="client_name">お客様</label>
                        <input type="text" name="client_name[]" id="client_name"
                        value="<?php echo $_SESSION['client_name'][$i];?>" required>
                    </div>
                    <div class="each-field field">
                        <label for="urikake_total">金額</label>
                        <input type="number" name="urikake_total[]" id="urikake_total"
                        value="<?php echo $_SESSION['urikake_total'][$i];?>" required>
                    </div>
                </div>
                <?php endfor ;?>
            </div>
            

            <div class="add-container">
                <img class="add_button" src="../img/plus.png" alt="追加">
            </div>
            <!-- <input type="hidden" name="q_16" value="q_16"> -->
            <div class="back_next_container">
                <input type="submit" name="next" value="確認画面へ" class="next_button"/>
                <?php if($_SESSION['went_to_confirmation']):?>
                <input type="submit" name="back" value="戻る" class="back_button"/>
                <?php else:?>
                <a href="q_12_15.php" class="back_button">戻る</a>
                <?php endif ;?>
            </div>
            <?php require 'back_to_top.php';?>
        </form>
    </div> 

    <?php require 'back_to_top_modal.php';?>

        <script>
            $(document).ready(function(){
                var add = $('.add_button');
                var wrapper = $('.client-container');

                $(add).click(function(e){
                    e.preventDefault();
                    $(wrapper).append('<div class="each-client">' +
                    '<div class="icon-container">' +
                    '<img class="remove_field" src="../img/close.png" alt="削除">' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="client_name">お客様</label>' +
                    '<input type="text" name="client_name[]" id="client_name" required>' +
                    '</div>'+
                    '<div class="each-field field">'+
                    '<label for="urikake_total">金額</label>' +
                    '<input type="number" name="urikake_total[]" id="urikake_total" required>' +
                    '</div>' +
                    '</div>');
                });

                $(wrapper).on('click', '.remove_field', function(e){
                    e.preventDefault();
                    $(this).parent('div').parent('div').remove();
                });

            });
        </script>
    </body>
</html>