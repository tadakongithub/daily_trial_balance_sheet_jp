<?php

    session_start();

    if($_SESSION['logged_in'] !== 'logged_in') {
        header('Location: ../index.php');
    }

    //もし１つでも項目がなかったら、トップページに戻る
    // if(!isset($_SESSION['branch']) or
    //     !isset($_SESSION['date']) or
    //     !isset($_SESSION['name']) or
    //     !isset($_SESSION['change']) or
    //     !isset($_SESSION['earning']) or
    //     !isset($_SESSION['received_from']) or
    //     !isset($_SESSION['total_received']) or
    //     !isset($_SESSION['content_received']) or
    //     !isset($_SESSION['sent_to']) or
    //     !isset($_SESSION['total_sent']) or
    //     !isset($_SESSION['content_sent']) or
    //     !isset($_SESSION['next_day_change']) or
    //     !isset($_SESSION['jisen_total']) or
    //     !isset($_SESSION['next_day_deposit']) or
    //     !isset($_SESSION['prem_count']) or
    //     !isset($_SESSION['prem_total']) or
    //     !isset($_SESSION['for_selling_count']) or
    //     !isset($_SESSION['for_selling_total']) or
    //     !isset($_SESSION['thousand_count']) or
    //     !isset($_SESSION['thousand_total']) or
    //     !isset($_SESSION['five_count']) or
    //     !isset($_SESSION['five_total']) or
    //     !isset($_SESSION['two_count']) or
    //     !isset($_SESSION['two_total']) or
    //     !isset($_SESSION['dc_how_much']) or
    //     !isset($_SESSION['jcb_how_much']) or
    //     !isset($_SESSION['paypay_count']) or
    //     !isset($_SESSION['paypay_total']) or
    //     !isset($_SESSION['nanaco_count']) or
    //     !isset($_SESSION['nanaco_total']) or
    //     !isset($_SESSION['edy_count']) or
    //     !isset($_SESSION['edy_total']) or
    //     !isset($_SESSION['transport_ic_count']) or
    //     !isset($_SESSION['transport_ic_total']) or
    //     !isset($_SESSION['quick_pay_count']) or
    //     !isset($_SESSION['quick_pay_total']) or
    //     !isset($_SESSION['waon_count']) or
    //     !isset($_SESSION['waon_total']) or
    //     !isset($_SESSION['client_name']) or
    //     !isset($_SESSION['urikake_total'])) {

    //     header('Location: ../lackofdata.php');

    // };


    $unixtime = strtotime($_SESSION['date']);

    $year = date('Y', $unixtime);
    $month = date('m', $unixtime);
    $date = date('d', $unixtime);

?>
<html>
<head>
    <?php require 'form-head.php';?>
</head>
<body>

    <div class="confirmation-container">
        <h2 class="ui header">記入者：<?php echo $_SESSION['name'];?></h2>

        <h2 class="ui header">日付：<?php echo $year;?>月<?php echo $month;?>月<?php echo $date;?>日</h2>

        <h2 class="ui header">店舗名：<?php echo $_SESSION['branch'];?></h2>

        <div>
            <table>
                <tr class="row-1">
                    <td class="item_name">釣り銭</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['change']);?>円</td>
                    <td class="item_name">内訳</td>
                </tr>

                <tr class="row-2">
                    <td class="item_name">現金売上</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['earning']);?>円</td>
                    <td class="item_name">購入取引先名</td>
                    <td class="item_name">明細</td>
                </tr>

                <?php for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                    <tr class="row-2">
                        <td class="item_name">入金</td>
                        <td class="number_cell"><?php echo number_format($_SESSION['total_received'][$i]);?>円</td>
                        <td><?php echo $_SESSION['received_from'][$i];?></td>
                        <td><?php echo $_SESSION['content_received'][$i];?></td>
                    </tr>
                <?php endfor;?>

                <?php
                    if(count($_SESSION['received_from']) < 5) {
                        $num_of_blank_received_rows = 5 - count($_SESSION['received_from']);
                        for($i = 0; $i < $num_of_blank_received_rows; $i++) { ?>
                            <tr class="row-2">
                                <td class="item_name">入金</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                    }
                ?>

                <?php for($i = 0; $i < count($_SESSION['sent_to']); $i++):?>
                    <tr class="<?php 
                        if($i == 0){
                            echo "row-2 first-sent";
                        } else {
                            echo "row-2";
                        };
                    ?>">
                        <td class="item_name">出金</td>
                        <td class="number_cell"><?php echo number_format($_SESSION['total_sent'][$i]);?>円</td>
                        <td><?php echo $_SESSION['sent_to'][$i];?></td>
                        <td><?php echo $_SESSION['content_sent'][$i];?></td>
                    </tr>
                <?php endfor;?>

                <?php
                    if(count($_SESSION['sent_to']) < 10) {
                        $num_of_blank_sent_to = 10 - count($_SESSION['sent_to']);
                        for($i = 0; $i < $num_of_blank_sent_to; $i++) { ?>
                            <tr class="row-2">
                                <td class="item_name">出金</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                    }
                ?>

                <tr class="row-2">
                    <td class="item_name">支払い計</td>
                    <td class="number_cell"><?php echo number_format(array_sum($_SESSION['total_sent']));?>円</td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
                    $reji_zankei = $_SESSION['change'] + $_SESSION['earning'] 
                    + array_sum($_SESSION['total_received']) - array_sum($_SESSION['total_sent']);
                ?>

                <tr class="row-2">
                    <td class="item_name">レジ残計</td>
                    <td class="number_cell"><?php echo number_format($reji_zankei);?>円</td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
                    $kabusoku = $reji_zankei - $_SESSION['jisen_total'];
                ?>

                <tr class="row-2">
                    <td class="item_name">現金過不足</td>
                    <td class="number_cell"><?php echo number_format($kabusoku);?>円</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td class="item_name">実残合計</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['jisen_total']);?>円</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td class="item_name">翌日つり銭</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['next_day_change']);?>円</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td class="item_name">翌日預入</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['next_day_deposit']);?>円</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <div>※食事券計は、ジャーナルの食事券計と合致すること。</div>

            <table>

                <?php
                    $shokuji = $_SESSION['prem_total'] + $_SESSION['for_selling_total'] +
                    $_SESSION['thousand_total'] + $_SESSION['five_total'] + $_SESSION['two_total'];
                ?>

                <tr class="table-2-row-1">
                    <td></td>
                    <td class="item_name">食事券計</td>
                    <td class="number_cell"><?php echo number_format($shokuji);?>円</td>
                </tr>

                <tr class="table-2-row-2">
                    <td></td>
                    <td class="item_name">プレミアム食事券</td>
                    <td class="item_name">販売用回収</td>
                    <td class="item_name">サービス用回収</td>
                </tr>

                <tr class="table-2-row-3">
                    <td class="item_name">千円券</td>
                    <td><?php echo $_SESSION['prem_count'];?>枚</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['prem_total']);?>円</td>
                    <td><?php echo $_SESSION['for_selling_count'];?>枚</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['for_selling_total']);?>円</td>
                    <td><?php echo $_SESSION['thousand_count'];?>枚</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['thousand_total']);?>円</td>
                </tr>

                <tr class="table-2-row-4">
                    <td class="item_name">500円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $_SESSION['five_count'];?>枚</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['five_total']);?>円</td>
                </tr>

                <tr class="table-2-row-5">
                    <td class="item_name">200円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $_SESSION['two_count'];?>枚</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['two_total']);?>円</td>
                </tr>

            </table>

            <table>
                <div class="table-title">売掛金</div>

                    <?php if(count($_SESSION['client_name']) === 0):?>
                        <tr><td class="no_client">データなし</td></tr>
                    <?php else:?>
                    <?php for($i = 0; $i < count($_SESSION['client_name']); $i++):?>
                        <tr class="client-row">
                            <td><?php echo $_SESSION['client_name'][$i];?>様</td>
                            <td class="number_cell"><?php echo number_format($_SESSION['urikake_total'][$i]);?>円</td>
                        </tr>
                    <?php endfor;?>
                    <?php endif ;?>
                
            </table>

            <div class="table-title">その他</div>

            <table>
                <tr class="other-total">
                    <th>種別</th>
                    <th>件数</th>
                    <th>金額</th>
                </tr>

                <?php for($i = 0; $i < count($_SESSION['dc_how_much']); $i++):?>
                    <tr class="other-total">
                        <td>DC</td>
                        <td>1件</td>
                        <td class="number_cell"><?php echo number_format($_SESSION['dc_how_much'][$i]);?>円</td>
                    </tr>
                <?php endfor;?>

                <tr class="other-total sum">
                    <td>DC合計</td>
                    <td><?php echo count($_SESSION['dc_how_much']);?>件</td>
                    <td class="number_cell"><?php echo number_format(array_sum($_SESSION['dc_how_much']));?>円</td>
                </tr>

                <?php for($i = 0; $i < count($_SESSION['jcb_how_much']); $i++):?>
                    <tr class="other-total">
                        <td>JCB</td>
                        <td>1件</td>
                        <td class="number_cell"><?php echo number_format($_SESSION['jcb_how_much'][$i]);?>円</td>
                    </tr>
                <?php endfor;?>

                <tr class="other-total sum">
                    <td>JCB合計</td>
                    <td><?php echo count($_SESSION['jcb_how_much']);?>件</td>
                    <td class="number_cell"><?php echo number_format(array_sum($_SESSION['jcb_how_much']));?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td>PayPay</td>
                    <td><?php echo $_SESSION['paypay_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['paypay_total']);?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td class="item_name">nanaco</td>
                    <td><?php echo $_SESSION['nanaco_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['nanaco_total']);?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td class="item_name">Edy</td>
                    <td><?php echo $_SESSION['edy_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['edy_total']);?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td class="item_name">交通IC</td>
                    <td><?php echo $_SESSION['transport_ic_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['transport_ic_total']);?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td class="item_name">Quick Pay</td>
                    <td><?php echo $_SESSION['quick_pay_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['quick_pay_total']);?>円</td>
                </tr>

                <tr class="other-total sum">
                    <td class="item_name">WAON</td>
                    <td><?php echo $_SESSION['waon_count'];?>件</td>
                    <td class="number_cell"><?php echo number_format($_SESSION['waon_total']);?>円</td>
                </tr>
            </table>
        </div>

        <div class="submit-container">
            <a href="q_16.php">戻る</a>
            <a id="send-btn" class="send-data" href="submit.php">送信</a>
        </div>
    </div>

</body>
</html>
