<?php
    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: ../index.php');
    }

    if($_POST['next'] || $_POST['back']) {
        $_SESSION['sent_to'] = $_POST['sent_to'];
        $_SESSION['total_sent'] = $_POST['total_sent'];
        $_SESSION['content_sent'] = $_POST['content_sent'];
        if($_POST['next']){
            header('Location: q_6_7_8.php');
        } else if($_POST['back']){
            header('Location: q_4.php');
        }
    }
?>
<html>
<head>
<?php require './form-head.php';?>
</head>
<body>
    <div class="q-container-add">
        <h1 class="ui header"><?php echo $_SESSION['branch'];?>　日計表</h1>
            <form action="" method="post" id="form_received" class="ui form">
            <h2 class="ui header" id="sent_h2">5. 現金の<span class="sent_red">レジ出金</span>を記入してください。</h2>
            <h3 class="ui header">（消耗品購入・食材仕入・お手伝いスタッフの人件費など）</h3>

            <div class="input_fields_wrapper">
                <?php for($i = 0; $i < count($_SESSION['sent_to']); $i++):?>
                <div class="each-sent">
                    <div class="icon-container">
                        <image class="remove_field" src="../img/close.png" alt="削除">
                    </div>
                    <div class="each-field field">
                        <label for="sent_to">購入先・スタッフ名など
                            <br>※注意※　×シェル→〇関東礦油&nbsp;&nbsp;ブランド名ではなく、会社名を記載してください。</label>
                        <input type="text" name="sent_to[]" id="sent_to" value="<?php echo $_SESSION['sent_to'][$i];?>" required>
                    </div>
                    
                    <div class="each-field field">
                        <label for="total_sent">出金額</label>
                        <input type="number" name="total_sent[]" id="total_sent" value="<?php echo $_SESSION['total_sent'][$i];?>" required>
                    </div>
                    
                    <div class="each-field field">
                        <label for="content_sent">出金の内容</label>
                        <input type="text" name="content_sent[]" id="content_sent" value="<?php echo $_SESSION['content_sent'][$i];?>" required>
                    </div> 
                </div>
                <?php endfor;?>
            </div>

            <div class="add-container">
                <img class="add_button" src="../img/plus.png" alt="追加">
            </div>
            
            <?php require 'backnext.php';?>
    </form>

    

    <script>
        $(document).ready(function(){
            var add_button = $(".add_button");
            var wrapper = $(".input_fields_wrapper");

            $(add_button).click(function(){
                $(wrapper).append(
                    '<div class="each-sent">' +
                    '<div class="icon-container">' +
                    '<image class="remove_field" src="../img/close.png" alt="削除">' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="sent_to">購入先・スタッフ名など<br>※注意※　×シェル→〇関東礦油&nbsp;&nbsp;ブランド名ではなく、会社名を記載してください。</label>' +
                    '<input type="text" name="sent_to[]" id="sent_to" required>' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="total_sent">出金額</label>' +
                    '<input type="number" name="total_sent[]" id="total_sent" required>' +
                    '</div>' +
                    '<div class="each-field field">' +
                    '<label for="content_sent">出金の内容</label>' +
                    '<input type="text" name="content_sent[]" id="content_sent" required>' +
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