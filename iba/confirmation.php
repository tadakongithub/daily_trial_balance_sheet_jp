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
                    <td>釣り銭</td>
                    <td><?php echo $_SESSION['change'];?></td>
                    <td>内訳</td>
                </tr>

                <tr class="row-2">
                    <td>現金売上</td>
                    <td><?php echo $_SESSION['earning'];?></td>
                    <td>購入取引先名</td>
                    <td>明細</td>
                </tr>

                <?php for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                    <tr class="row-2">
                        <td>入金</td>
                        <td><?php echo $_SESSION['total_received'][$i];?></td>
                        <td><?php echo $_SESSION['received_from'][$i];?></td>
                        <td><?php echo $_SESSION['content_received'][$i];?></td>
                    </tr>
                <?php endfor;?>

                <?php
                    if(count($_SESSION['received_from']) < 5) {
                        $num_of_blank_received_rows = 5 - count($_SESSION['received_from']);
                        for($i = 0; $i < $num_of_blank_received_rows; $i++) { ?>
                            <tr class="row-2">
                                <td>入金</td>
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
                        <td>出金</td>
                        <td><?php echo $_SESSION['total_sent'][$i];?></td>
                        <td><?php echo $_SESSION['sent_to'][$i];?></td>
                        <td><?php echo $_SESSION['content_sent'][$i];?></td>
                    </tr>
                <?php endfor;?>

                <?php
                    if(count($_SESSION['sent_to']) < 10) {
                        $num_of_blank_sent_to = 10 - count($_SESSION['sent_to']);
                        for($i = 0; $i < $num_of_blank_sent_to; $i++) { ?>
                            <tr class="row-2">
                                <td>出金</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                    }
                ?>

                <tr class="row-2">
                    <td>支払い計</td>
                    <td><?php echo array_sum($_SESSION['total_sent']);?></td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
                    $reji_zankei = $_SESSION['change'] + $_SESSION['earning'] 
                    + array_sum($_SESSION['total_received']) - array_sum($_SESSION['total_sent']);
                ?>

                <tr class="row-2">
                    <td>レジ残計</td>
                    <td><?php echo $reji_zankei;?></td>
                    <td></td>
                    <td></td>
                </tr>

                <?php
                    $kabusoku = $reji_zankei - $_SESSION['jisen_total'];
                ?>

                <tr class="row-2">
                    <td>現金過不足</td>
                    <td><?php echo $kabusoku;?></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>実残合計</td>
                    <td><?php echo $_SESSION['jisen_total'];?></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>翌日つり銭</td>
                    <td><?php echo $_SESSION['next_day_change'];?></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="row-2">
                    <td>翌日預入</td>
                    <td><?php echo $_SESSION['next_day_deposit'];?></td>
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
                    <td>食事券計</td>
                    <td><?php echo $shokuji;?>円</td>
                </tr>

                <tr class="table-2-row-2">
                    <td></td>
                    <td>プレミアム食事券</td>
                    <td>販売用回収</td>
                    <td>サービス用回収</td>
                </tr>

                <tr class="table-2-row-3">
                    <td>千円券</td>
                    <td><?php echo $_SESSION['prem_count'];?>枚</td>
                    <td><?php echo $_SESSION['prem_total'];?>円</td>
                    <td><?php echo $_SESSION['for_selling_count'];?>枚</td>
                    <td><?php echo $_SESSION['for_selling_total'];?>円</td>
                    <td><?php echo $_SESSION['thousand_count'];?>枚</td>
                    <td><?php echo $_SESSION['thousand_total'];?>円</td>
                </tr>

                <tr class="table-2-row-4">
                    <td>500円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $_SESSION['five_count'];?>枚</td>
                    <td><?php echo $_SESSION['five_total'];?>円</td>
                </tr>

                <tr class="table-2-row-5">
                    <td>200円券</td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td class="null"></td>
                    <td><?php echo $_SESSION['two_count'];?>枚</td>
                    <td><?php echo $_SESSION['two_total'];?>円</td>
                </tr>

            </table>

            <table>
                <div class="table-title">売掛金</div>

                
                    <?php for($i = 0; $i < count($_SESSION['client_name']); $i++):?>
                        <tr class="client-row">
                            <td><?php echo $_SESSION['client_name'][$i];?>様</td>
                            <td><?php echo $_SESSION['urikake_total'][$i];?>円</td>
                        </tr>
                    <?php endfor;?>
                
            </table>

            <table>
                <div class="table-title">DC売上内訳</div>


                    <?php for($i = 0; $i < count($_SESSION['dc_how_much']); $i++):?>
                        <tr class="dc-each-row">
                        <td style="text-align: center"><?php echo $_SESSION['dc_how_much'][$i];?>円</td>
                        </tr>
                    <?php endfor;?>


                <tr class="dc-total">
                    <td>DC売上合計</td>
                    <td><?php echo count($_SESSION['dc_how_much']);?>件</td>
                    <td><?php echo array_sum($_SESSION['dc_how_much']);?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">JCB売上内訳</div>


                    <?php for($i = 0; $i < count($_SESSION['jcb_how_much']); $i++):?>
                        <tr class="dc-each-row">
                        <td style="text-align: center"><?php echo $_SESSION['jcb_how_much'][$i];?>円</td>
                        </tr>
                    <?php endfor;?>


                <tr class="dc-total">
                    <td>JCB売上合計</td>
                    <td><?php echo count($_SESSION['jcb_how_much']);?>件</td>
                    <td><?php echo array_sum($_SESSION['jcb_how_much']);?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">PayPay売上合計</div>
                <tr class="paypay">
                    <td><?php echo $_SESSION['paypay_count'];?>件</td>
                    <td><?php echo $_SESSION['paypay_total'];?>円</td>
                </tr>
            </table>

            <table>
                <div class="table-title">その他</div>

                <tr class="other-total">
                    <td>nanaco</td>
                    <td><?php echo $_SESSION['nanaco_count'];?>件</td>
                    <td><?php echo $_SESSION['nanaco_total'];?>円</td>
                </tr>

                <tr class="other-total">
                    <td>edy</td>
                    <td><?php echo $_SESSION['edy_count'];?>件</td>
                    <td><?php echo $_SESSION['edy_total'];?>円</td>
                </tr>

                <tr class="other-total">
                    <td>交通IC</td>
                    <td><?php echo $_SESSION['transport_ic_count'];?>件</td>
                    <td><?php echo $_SESSION['transport_ic_total'];?>円</td>
                </tr>

                <tr class="other-total">
                    <td>Quick Pay</td>
                    <td><?php echo $_SESSION['quick_pay_count'];?>件</td>
                    <td><?php echo $_SESSION['quick_pay_total'];?>円</td>
                </tr>

                <tr class="other-total">
                    <td>WAON</td>
                    <td><?php echo $_SESSION['waon_count'];?>件</td>
                    <td><?php echo $_SESSION['waon_total'];?>円</td>
                </tr>
            </table>
        </div>

        <div class="submit-container">
            <a id="send-btn" class="send-data" href="submit.php">送信</a>
        </div>
    </div>

</body>
</html>
