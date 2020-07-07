<?php

session_start();

if($_SESSION['logged_in'] !== 'logged_in') {
    header('Location: ../index.php');
}

if($_POST['q_16']) {
    $_SESSION['client_name'] = $_POST['client_name'];
    $_SESSION['urikake_total'] = $_POST['urikake_total'];
    header('Location: confirmation.php');
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
            <h2 class="ui header">16. 売掛金</h2>

            <div class="client-container">
                <div class="each-client">
                    <div class="each-field field">
                        <label for="client_name">お客様</label>
                        <input type="text" name="client_name[]" id="client_name"
                        value="<?php echo $_SESSION['client_name'][0];?>">
                    </div>
                    <div class="each-field field">
                        <label for="urikake_total">金額</label>
                        <input type="number" name="urikake_total[]" id="urikake_total"
                        value="<?php echo $_SESSION['urikake_total'][0];?>">
                    </div>
                </div>
            </div>
            

            <div class="add-container">
                <img class="add_button" src="../img/plus.png" alt="追加">
            </div>
            <input type="hidden" name="q_16" value="q_16">
            <div class="submit-container">
            <button type="submit" class="ui button">確認画面へ</button>
            </div>
        </form>
    </div> 

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
                    '<input type="text" name="client_name[]" id="client_name">' +
                    '</div>'+
                    '<div class="each-field field">'+
                    '<label for="urikake_total">金額</label>' +
                    '<input type="number" name="urikake_total[]" id="urikake_total">' +
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