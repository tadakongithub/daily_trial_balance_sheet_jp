<?php

    session_start();

    if($_SESSION['logged_in'] !== 'logged_in') {
        header('Location: ../index.php');
    }

    $date = $_SESSION['date'];

    require '../db.php';
    $result = $myPDO->query("SELECT * FROM ibaraki WHERE date = '$date'");
    $record = $result->fetch();

    //表示する項目のデータを変数に入れる
    $name = $record['name'];

    $unixtime = strtotime($date);
    $year = date('Y', $unixtime);
    $month = date('m', $unixtime);
    $dateDisplay = date('d', $unixtime);

    $change = $record['change1'];
    $earning = $record['earning'];
    $received_from = unserialize($record['received_from']);
    $total_received = unserialize($record['total_received']);
    $content_received = unserialize($record['content_received']);
    $sent_to = unserialize($record['sent_to']);
    $total_sent = unserialize($record['total_sent']);
    $content_sent = unserialize($record['content_sent']);
    $next_day_change = $record['next_day_change'];
    $next_day_deposit = $record['next_day_deposit'];
    $prem_count = $record['prem_count'];
    $prem_total = $record['prem_total'];
    $for_selling_count = $record['for_selling_count'];
    $for_selling_total = $record['for_selling_total'];
    $thousand_count = $record['thousand_count'];
    $thousand_total = $record['thousand_total'];
    $five_count = $record['five_count'];
    $five_total = $record['five_total'];
    $two_count = $record['two_count'];
    $two_total = $record['two_total'];
    $client_name = unserialize($record['client_name']);
    $urikake_total = unserialize($record['urikake_total']);
    $dc_how_much = unserialize($record['dc_how_much']);
    $jcb_how_much = unserialize($record['jcb_how_much']);
    $paypay_count = $record['paypay_count'];
    $paypay_total = $record['paypay_total'];
    $nanaco_count = $record['nanaco_count'];
    $nanaco_total = $record['nanaco_total'];
    $edy_count = $record['edy_count'];
    $edy_total = $record['edy_total'];
    $suica_count = $record['suica_count'];
    $suica_total = $record['suica_total'];
    
    
        if($_POST['name']) {
            $name = $_POST['name'];
        }

        if($_POST['change']){
            $change = $_POST['change'];
        }

        if($_POST['earning']) {
            $earning = $_POST['earning'];
        }
    
        if($_POST['received_from']){
            $received_from = $_POST['received_from'];
        }

        if($_POST['total_received']) {
            $total_received = $_POST['total_received'];
        }

        if($_POST['content_received']) {
            $content_received = $_POST['content_received'];
        }

        if($_POST['sent_to']){
            $sent_to = $_POST['sent_to'];
        }

        if($_POST['total_sent']) {
            $total_sent = $_POST['total_sent'];
        }

        if($_POST['content_sent']) {
            $content_sent = $_POST['content_sent'];
        }

        if($_POST['next_day_change']) {
            $next_day_change = $_POST['next_day_change'];
        }

        if($_POST['next_day_deposit']) {
            $next_day_deposit = $_POST['next_day_deposit'];
        }

?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="iba.css">
</head>
<body>
    
    <div class="confirmation-container">
        <div>
            <span class="item-name">記入者：</span>
            <span class="item-value"><?php echo $name;?></span>
            <button class="edit name">編集</button>
        </div>

        <div>
            <span class="item-name">日付：</span>
            <span><?php echo $year;?>月<?php echo $month;?>月<?php echo $dateDisplay;?>日</span>
        </div>

        <div>店舗名：茨城店</div>

        <div>
            
            <table>
                <tr class="row-1">
                    <td>釣り銭</td>
                    <td><?php echo $change;?></td>
                    <td>内訳</td>
                </tr>

                <tr class="row-2">
                    <td>現金売り上げ</td>
                    <td><?php echo $earning;?></td>
                    <td>購入取引先名</td>
                    <td>明細</td>
                </tr>

                <?php for($i = 0; $i < count($received_from); $i++):?>
                    <tr class="row-2">
                        <td>入金</td>
                        <td><?php echo $total_received[$i];?></td>
                        <td><?php echo $received_from[$i];?></td>
                        <td><?php echo $content_received[$i];?></td>
                    </tr>
                <?php endfor;?>

                <?php for($i = 0; $i < count($sent_to); $i++):?>
                    <tr class="row-2">
                        <td>出金</td>
                        <td><?php echo $total_sent[$i];?></td>
                        <td><?php echo $sent_to[$i];?></td>
                        <td><?php echo $content_sent[$i];?></td>
                    </tr>
                <?php endfor;?>

                <tr class="row-2">
                    <td>支払い計</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>レジ残計</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>現金過不足</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>実践合計</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>翌日つり銭</td>
                    <td><?php echo $next_day_change;?></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>翌日預入</td>
                    <td><?php echo $next_day_deposit;?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <button class="edit firstTable">ここまでを編集</button>

            <table>
                <tr class="table-2-row-1">
                    <td class="table-cell-no-border">※食事券計は、ジャーナルの食事券計と合致すること。</td>
                    <td>食事券計</td>
                    <td></td>
                </tr>

                <tr class="table-2-row-2">
                    <td></td>
                    <td>プレミアム食事券</td>
                    <td>販売用回収</td>
                    <td>サービス用回収</td>
                </tr>

                <tr class="table-2-row-3">
                    <td>千円券</td>
                    <td><?php echo $prem_count;?>枚</td>
                    <td><?php echo $prem_total;?>円</td>
                    <td><?php echo $for_selling_count;?>枚</td>
                    <td><?php echo $for_selling_total;?>円</td>
                    <td><?php echo $thousand_count;?>枚</td>
                    <td><?php echo $thousand_total;?>円</td>
                </tr>

                <tr class="table-2-row-4">
                    <td>500円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $five_count;?>枚</td>
                    <td><?php echo $five_total;?>円</td>
                </tr>

                <tr class="table-2-row-5">
                    <td>200円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $two_count;?>枚</td>
                    <td><?php echo $two_total;?>円</td>
                </tr>

            </table>

            <table>
                <div class="table-title">売掛け金</div>

                <tr class="client-row">
                    <?php for($i = 0; $i < count($client_name); $i++):?>
                        <td><?php echo $client_name[$i];?>様</td>
                        <td><?php echo $urikake_total[$i];?>円</td>
                    <?php endfor;?>
                </tr>
            </table>

            <table>
                <div class="table-title">DC売り上げ内訳</div>

                <tr class="dc-each-row">
                    <?php for($i = 0; $i < count($dc_how_much); $i++):?>
                        <td style="text-align: center"><?php echo $dc_how_much[$i];?>円</td>
                    <?php endfor;?>
                </tr>

                <tr class="dc-total">
                    <td>DC売り上げ合計</td>
                    <td><?php echo count($dc_how_much);?>件</td>
                    <td><?php echo array_sum($dc_how_much);?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">JCB売り上げ内訳</div>

                <tr class="dc-each-row">
                    <?php for($i = 0; $i < count($jcb_how_much); $i++):?>
                        <td style="text-align: center"><?php echo $jcb_how_much[$i];?>円</td>
                    <?php endfor;?>
                </tr>

                <tr class="dc-total">
                    <td>JCB売り上げ合計</td>
                    <td><?php echo count($jcb_how_much);?>件</td>
                    <td><?php echo array_sum($jcb_how_much);?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">PayPay売り上げ合計</div>
                <tr class="paypay">
                    <td><?php echo $paypay_count;?>件</td>
                    <td><?php echo $paypay_total;?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">その他</div>

                <tr class="other-total">
                    <td>nanaco</td>
                    <td><?php echo $nanaco_count;?>件</td>
                    <td><?php echo $nanaco_total;?>円</td>
                </tr>

                <tr class="other-total">
                    <td>edy</td>
                    <td><?php echo $edy_count;?>件</td>
                    <td><?php echo $edy_total;?>円</td>
                </tr>

                <tr class="other-total">
                    <td>suica</td>
                    <td><?php echo $suica_count;?>件</td>
                    <td><?php echo $suica_total;?>円</td>
                </tr>
            </table>
        </div>

        <button class="send-data"><a href="submit.php">送信</a></button>
    </div>

 
   
    <!-- modal for name -->
    <div class="ui modal name">
        <i class="close icon"></i>
        <div class="header">
            記入者
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field">
                    <input type="text" name="name" value="<?php echo $name;?>">
                </div>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for first-table -->
    <div class="ui modal firstTable">
        <i class="close icon"></i>
        <div class="header">
            釣り銭〜翌日預け入れ
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field">
                    <label for="change">釣り銭</label>
                    <input type="number" name="change" id="change" value="<?php echo $change;?>">
                </div>
                <div class="field">
                    <label for="earning">現金売り上げ</label>
                    <input type="number" name="earning" id="earning" value="<?php echo $earning;?>">
                </div>
                <div>
                    <?php for($i = 0; $i < count($received_from); $i++):?>
                        <div class="field">
                            <label for="total_received">入金額</label>
                            <input type="number" id="total_received" name="total_received[]" value="<?php echo $total_received[$i];?>">
                        </div>
                        <div class="field">
                            <label for="received_from">入金相手</label>
                            <input type="text" id="received_from" name="received_from[]" value="<?php echo $received_from[$i];?>">
                        </div>
                        <div class="field">
                            <label for="content_received">入金内容</label>
                            <input type="text" id="content_received" name="content_received[]" value="<?php echo $content_received[$i];?>">
                        </div>
                    <?php endfor ;?>
                </div>
                <div>
                    <?php for($i = 0; $i < count($sent_to); $i++):?>
                        <div class="field">
                            <label for="total_sent">出金額</label>
                            <input type="number" id="total_sent" name="total_sent[]" value="<?php echo $total_sent[$i];?>">
                        </div>
                        <div class="field">
                            <label for="sent_to">出金先</label>
                            <input type="text" id="sent_to" name="sent_to[]" value="<?php echo $sent_to[$i];?>">
                        </div>
                        <div class="field">
                            <label for="content_sent">出金内容</label>
                            <input type="text" id="content_sent" name="content_sent[]" value="<?php echo $content_sent[$i];?>">
                        </div>
                    <?php endfor ;?>
                </div>
                <div class="field">
                    <label for="next_day_change">翌日つり銭</label>
                    <input type="number" id="next_day_change" name="next_day_change" value="<?php echo $next_day_change;?>">
                </div>
                <div class="field">
                    <label for="next_day_deposit">翌日預入</label>
                    <input type="number" id="next_day_deposit" name="next_day_deposit" value="<?php echo $next_day_deposit;?>">
                </div>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>


    <script>
        
        $(document).ready(function(){
            var edit = $(".edit");

            $(edit).on('click', function(e){
                e.preventDefault();

                if($(this).hasClass('name')){
                    $('.ui.modal.name').modal('show');
                } else if($(this).hasClass('firstTable')) {
                    $('.ui.modal.firstTable').modal('show');
                }
                
            });

            


        });

    </script>
</body>
</html>