<?php

    session_start();

    if(!$_SESSION['logged_in'] == 'logged_in') {
        header('Location: index.php');
    }

    if($_POST['date']) {
        $_SESSION['date'] = $_POST['date'];
    }

    if($_POST['change']) {
        $_SESSION['change'] = $_POST['change'];
    }

    if($_POST['earning']) {
        $_SESSION['earning'] = $_POST['earning'];
    }

    if($_POST['received_from']) {
        $_SESSION['received_from'] = $_POST['received_from'];
        $_SESSION['total_received'] = $_POST['total_received'];
        $_SESSION['content_received'] = $_POST['content_received'];
    }

    if($_POST['sent_to']) {
        $_SESSION['sent_to'] = $_POST['sent_to'];
        $_SESSION['total_sent'] = $_POST['total_sent'];
        $_SESSION['content_sent'] = $_POST['content_sent'];
    }

    if($_POST['next_day_change']) {
        $_SESSION['next_day_change'] = $_POST['next_day_change'];
    }

    if($_POST['next_day_deposit']) {
        $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
    }

    if($_POST['prem_count']) {
        $_SESSION['prem_count'] = $_POST['prem_count'];
        $_SESSION['prem_total'] = $_POST['prem_total'];
    }

    if($_POST['for_selling_count']) {
        $_SESSION['for_selling_count'] = $_POST['for_selling_count'];
        $_SESSION['for_selling_total'] = $_POST['for_selling_total'];
    }

?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="iba.css">
</head>
<body>
    <div>
        <div>
            <div>
                <h4>1. 今日の日付</h4>
                <div><?php echo $_SESSION['date']; ?></div>
                <button id="date" class="edit_button date">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>2. 釣り銭金額</h4>
                <div><?php echo $_SESSION['change']; ?></div>
                <button id="change" class="edit_button number">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>3. 現金売り上げ</h4>
                <div><?php echo $_SESSION['earning']; ?></div>
                <button id="earning" class="edit_button number">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>4. 入金額、取引先やスタッフ名、入金の内容</h4>
                <?php for($i = 0 ; $i < count($_SESSION['received_from']) ; $i++) :?>
                <div class="each_received">
                    <div><?php echo $_SESSION['received_from'][$i];?></div>
                    <div><?php echo $_SESSION['total_received'][$i];?></div>
                    <div><?php echo $_SESSION['content_received'][$i];?></div>
                </div>
                <?php endfor; ?>
                <button class="edit_button received">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>5. 出金額、取引先やスタッフ名、出金の内容</h4>
                <?php for($i = 0 ; $i < count($_SESSION['sent_to']) ; $i++) :?>
                <div class="each_sent">
                    <div><?php echo $_SESSION['sent_to'][$i];?></div>
                    <div><?php echo $_SESSION['total_sent'][$i];?></div>
                    <div><?php echo $_SESSION['content_sent'][$i];?></div>
                </div>
                <?php endfor; ?>
                <button class="edit_button sent">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>6. 翌日のつり銭額</h4>
                <div><?php echo $_SESSION['next_day_change']; ?></div>
                <button id="next_day_change" class="edit_button number">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>7. 翌日預入の金額</h4>
                <div><?php echo $_SESSION['next_day_deposit']; ?></div>
                <button id="next_day_deposit" class="edit_button number">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>8. プレミアム食事券</h4>
                <div>枚数： <?php echo $_SESSION['prem_count']; ?></div>
                <div>金額：　<?php echo $_SESSION['prem_total'];?></div>
                <button class="edit_button prem">edit</button>
            </div>
        </div>

        <div>
            <div>
                <h4>9. 販売用食事券</h4>
                <div>枚数： <?php echo $_SESSION['for_selling_count']; ?></div>
                <div>金額：　<?php echo $_SESSION['for_selling_total'];?></div>
                <button class="edit_button for_selling">edit</button>
            </div>
        </div>

    </div>

    <!-- modal for date -->
    <div class="ui modal date">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field"><input type="date"></div>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for number -->
    <div class="ui modal number">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field"><input type="number"></div>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for text -->
    <div class="ui modal text">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field"><input type="text"></div>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for received -->
    <div class="ui modal received">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                <div id="each_received_edit">
                <label for="received_from">取引先</label>
                <input type="text" name="received_from[]" id="received_from" value="<?php echo $_SESSION['received_from'][$i];?>">
                <label for="total_received">金額</label>
                <input type="number" name="total_received[]" id="total_received" value="<?php echo $_SESSION['total_received'][$i];?>">
                <label for="content_received">内容</label>
                <input type="text" name="content_received[]" id="content_received" value="<?php echo $_SESSION['content_received'][$i];?>">
                </div>
                <?php endfor; ?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for sent -->
    <div class="ui modal sent">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php for($i = 0; $i < count($_SESSION['sent_to']); $i++):?>
                <div id="each_sent_edit">
                <label for="sent_to">出金先</label>
                <input type="text" name="sent_to[]" id="sent_to" value="<?php echo $_SESSION['sent_to'][$i];?>">
                <label for="total_sent">金額</label>
                <input type="number" name="total_sent[]" id="total_sent" value="<?php echo $_SESSION['total_sent'][$i];?>">
                <label for="content_sent">内容</label>
                <input type="text" name="content_sent[]" id="content_sent" value="<?php echo $_SESSION['content_sent'][$i];?>">
                </div>
                <?php endfor; ?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

     <!-- modal for prem -->
     <div class="ui modal prem">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <label for="prem_count">枚数</label>
                <input type="number" name="prem_count" id="prem_count" value="<?php echo $_SESSION['prem_count'];?>">
                <label for="prem_total">金額</label>
                <input type="number" name="prem_total" id="prem_total" value="<?php echo $_SESSION['prem_total'];?>">
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for for_selling -->
    <div class="ui modal for_selling">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <label for="for_selling_count">枚数</label>
                <input type="number" name="for_selling_count" id="for_selling_count" value="<?php echo $_SESSION['for_selling_count'];?>">
                <label for="for_selling_total">金額</label>
                <input type="number" name="for_selling_total" id="for_selling_total" value="<?php echo $_SESSION['for_selling_total'];?>">
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var edit_button = $(".edit_button");

            $(edit_button).on('click', function(){

                if($(this).hasClass('date')) {
                    $('.ui.modal.date').modal('show');
                } else if($(this).hasClass('number')) {
                    $('.ui.modal.number').modal('show');
                } else if($(this).hasClass('text')){
                    $('.ui.modal.text').modal('show');
                } else if($(this).hasClass('received')) {
                    $('.ui.modal.received').modal('show');
                } else if($(this).hasClass('sent')) {
                    $('.ui.modal.sent').modal('show');
                } else if($(this).hasClass('prem')) {
                    $('.ui.modal.prem').modal('show');
                } else if($(this).hasClass('for_selling')) {
                    $('.ui.modal.for_selling').modal('show');
                }
                
                
                var title = $(this).parent('div').children('h4').text();
                var data = $(this).parent('div').children('div').text();
                var id = $(this).attr('id');
        

                $(".title").text(title);
                $("div.field > input").attr('name', id);
                $("div.field > input").attr('value', data);
            });

            //if I close modal while editing, next time I open modal I don't want
            //to see the data from last time I was editing. I want to see the same
            //data as shown on the screen
            $('.ui.modal').modal({
                onHide: function() {
                    location.reload();
                }
            });
        });
    </script>
</body>
</html>