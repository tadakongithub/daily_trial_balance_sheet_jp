<?php

    session_start();

    if($_SESSION['logged_in'] !== 'logged_in') {
        header('Location: ../index.php');
    }

    //もし１つでも項目がなかったら、トップページに戻る
    if(!isset($_SESSION['date']) or
        !isset($_SESSION['name']) or
        !isset($_SESSION['change']) or
        !isset($_SESSION['earning']) or
        !isset($_SESSION['received_from']) or
        !isset($_SESSION['total_received']) or
        !isset($_SESSION['content_received']) or
        !isset($_SESSION['sent_to']) or
        !isset($_SESSION['total_sent']) or
        !isset($_SESSION['content_sent']) or
        !isset($_SESSION['next_day_change']) or
        !isset($_SESSION['jisen_total']) or
        !isset($_SESSION['next_day_deposit']) or
        !isset($_SESSION['prem_count']) or
        !isset($_SESSION['prem_total']) or
        !isset($_SESSION['for_selling_count']) or
        !isset($_SESSION['for_selling_total']) or
        !isset($_SESSION['thousand_count']) or
        !isset($_SESSION['thousand_total']) or
        !isset($_SESSION['five_count']) or
        !isset($_SESSION['five_total']) or
        !isset($_SESSION['two_count']) or
        !isset($_SESSION['two_total']) or
        !isset($_SESSION['dc_how_much']) or
        !isset($_SESSION['jcb_how_much']) or
        !isset($_SESSION['paypay_count']) or
        !isset($_SESSION['paypay_total']) or
        !isset($_SESSION['nanaco_count']) or
        !isset($_SESSION['nanaco_total']) or
        !isset($_SESSION['edy_count']) or
        !isset($_SESSION['edy_total']) or
        !isset($_SESSION['suica_count']) or
        !isset($_SESSION['suica_total']) or
        !isset($_SESSION['client_name']) or
        !isset($_SESSION['urikake_total'])) {

        header('Location: ../lackofdata.php');

    };


    $unixtime = strtotime($_SESSION['date']);

    $year = date('Y', $unixtime);
    $month = date('m', $unixtime);
    $date = date('d', $unixtime);

?>
<html>
<head>
    <?php require '../semantic.php';?>
<link rel="stylesheet" href="iba.css">
</head>
<body>

    <div class="confirmation-container">
        <h2 class="ui header">記入者：<?php echo $_SESSION['name'];?></h2>

        <h2 class="ui header">日付：<?php echo $year;?>月<?php echo $month;?>月<?php echo $date;?>日</h2>

        <h2 class="ui header">店舗名：茨城店</h2>

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
                        $num_of_blank_sent_to = 10 - count($_SESSION['received_from']);
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

                <tr class="client-row">
                    <?php for($i = 0; $i < count($_SESSION['client_name']); $i++):?>
                        <td><?php echo $_SESSION['client_name'][$i];?>様</td>
                        <td><?php echo $_SESSION['urikake_total'][$i];?>円</td>
                    <?php endfor;?>
                </tr>
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
                    <td>suica</td>
                    <td><?php echo $_SESSION['suica_count'];?>件</td>
                    <td><?php echo $_SESSION['suica_total'];?>円</td>
                </tr>
            </table>
        </div>

        <div class="submit-container">
            <a id="send-btn" class="send-data" href="submit.php">送信</a>
        </div>
    </div>


    <!-- modal for date
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
                -->

    <!-- modal for number
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
    -->

    <!-- modal for text
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
                -->

    <!-- modal for received
    <div class="ui modal received">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php //for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                <div class="each_received_edit">
                <label for="received_from">取引先</label>
                <input type="text" name="received_from[]" id="received_from" value="<?php //echo $_SESSION['received_from'][$i];?>">
                <label for="total_received">金額</label>
                <input type="number" name="total_received[]" id="total_received" value="<?php// echo $_SESSION['total_received'][$i];?>">
                <label for="content_received">内容</label>
                <input type="text" name="content_received[]" id="content_received" value="<?php //echo $_SESSION['content_received'][$i];?>">
                </div>
                <?php //endfor; ?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->

    <!-- modal for sent
    <div class="ui modal sent">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php //for($i = 0; $i < count($_SESSION['sent_to']); $i++):?>
                <div class="each_sent_edit">
                <label for="sent_to">出金先</label>
                <input type="text" name="sent_to[]" id="sent_to" value="<?php //echo $_SESSION['sent_to'][$i];?>">
                <label for="total_sent">金額</label>
                <input type="number" name="total_sent[]" id="total_sent" value="<?php //echo $_SESSION['total_sent'][$i];?>">
                <label for="content_sent">内容</label>
                <input type="text" name="content_sent[]" id="content_sent" value="<?php //echo $_SESSION['content_sent'][$i];?>">
                </div>
                <?php //endfor; ?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->

     <!-- modal for prem
     <div class="ui modal prem">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <label for="prem_count">枚数</label>
                <input type="number" name="prem_count" id="prem_count" value="<?php //echo $_SESSION['prem_count'];?>">
                <label for="prem_total">金額</label>
                <input type="number" name="prem_total" id="prem_total" value="<?php //echo $_SESSION['prem_total'];?>">
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->

    <!-- modal for for_selling
    <div class="ui modal for_selling">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <label for="for_selling_count">枚数</label>
                <input type="number" name="for_selling_count" id="for_selling_count" value="<?php //echo $_SESSION['for_selling_count'];?>">
                <label for="for_selling_total">金額</label>
                <input type="number" name="for_selling_total" id="for_selling_total" value="<?php //echo $_SESSION['for_selling_total'];?>">
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->

    <!-- modal for service
    <div class="ui modal service">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php //for($i = 0; $i < count($_SESSION['service_name']); $i++):?>
                    <div class="each_service_edit">
                        <label for="service_name">サービス名</label>
                        <input type="text" name="service_name[]" id="service_name" value="<?php //echo $_SESSION['service_name'][$i];?>">
                        <label for="for_service_count">枚数</label>
                        <input type="number" name="for_service_count[]" id="for_service_count" value="<?php //echo $_SESSION['for_service_count'][$i];?>">
                        <label for="for_service_total">金額</label>
                        <input type="number" name="for_service_total[]" id="for_service_total" value="<?php //echo $_SESSION['for_service_total'][$i];?>">
                    </div>
                    <?php //endfor ;?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->

    <!-- modal for dc
    <div class="ui modal dc">
        <i class="close icon"></i>
        <div class="header">
            <span class="title"></span>
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php //foreach($_SESSION['dc_how_much'] as $each_dc) :?>
                    <div><input type="number" name="dc_how_much[]" value="<?php //echo $each_dc;?>"></div>
                <?php// endforeach ;?>
                <button class="ui button" type="submit">編集を完了</button>
            </form>
        </div>
    </div>
                -->



    <script>
        /*
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
                } else if($(this).hasClass('service')) {
                    $('.ui.modal.service').modal('show');
                } else if($(this).hasClass('dc')) {
                    $('.ui.modal.dc').modal('show');
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
        */
    </script>
</body>
</html>
