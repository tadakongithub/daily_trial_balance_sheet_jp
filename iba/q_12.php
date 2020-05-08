<?php

session_start();

if($_SESSION['logged_in'] !== 'logged_in') {
    header('Location: ../index.php');
}

if($_POST['q_12']) {
    $_SESSION['client_name'] = $_POST['client_name'];
    $_SESSION['urikake_total'] = $_POST['urikake_total'];
    header('Location: confirmation.php');
}

?>


<html>
<head>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="iba.css" >
</head>
<body>
    <div class="q-container">
        <h1>茨城店　日計表</h1> 
        <form action="" method="post">
            <div>売掛け金</div>

            <div class="client-container">
                <div class="each-client">
                    <div class="each-field">
                        <div>お客様</div>
                        <input type="text" name="client_name[]" id="client_name">
                    </div>
                    <div class="each-field">
                        <div>金額</div>
                        <input type="number" name="urikake_total[]" id="urikake_total">
                    </div>
                </div>
            </div>
            

            <button class="add">追加</button>

            <input type="submit" value="確認画面へ" name="q_12">
        </form>
    </div> 

        <script>
            $(document).ready(function(){
                var add = $('.add');
                var wrapper = $('.client-container');

                $(add).click(function(e){
                    e.preventDefault();
                    $(wrapper).append('<div class="each-client">' +
                    '<div class="each-field">' +
                    '<div>お客様</div>' +
                    '<input type="text" name="client_name[]" id="client_name">' +
                    '</div>'+
                    '<div class="each-field">'+
                    '<div>金額</div>' +
                    '<input type="number" name="urikake_total[]" id="urikake_total">' +
                    '</div>' +
                    '<button class="remove_field">削除</button>' +
                    '</div>'+
                    '</div>');
                });

                $(wrapper).on('click', '.remove_field', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove();
                });
            });
        </script>
    </body>
</html>