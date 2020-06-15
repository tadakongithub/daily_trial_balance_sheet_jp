<?php

    session_start();
    require '../db.php';

    if($_SESSION['logged_in'] !== 'logged_in') {
        header('Location: ../index.php');
    }

    if(!$_SESSION['date']) {
        session_destroy();
        header('Location: ../index.php');
    }

    //もし日付のセッションがないか、その日付のデータがデータベースにない場合はトップページに
    $checkDate = $_SESSION['date'];
    $stmt = $myPDO->query("SELECT * FROM ibaraki WHERE date = '$checkDate'");
    $result = $stmt->fetch(FETCH_ASSOC);
    $rowCount = count($result);

    if($rowCount = 0) {
        session_destroy();
        header('Location: ../index.php');
    }

    if($_SESSION["from_date"] == "from_date") {
        unset($_SESSION['from_date']);
        $_SESSION['from_edit'] = true;



        $results = $myPDO->query("SELECT * FROM ibaraki WHERE date = '$checkDate'");
        $record;
        $time_created = 0;
        while($row = $results->fetch()) {
            global $record;
            global $time_created;
            if($row['time_created'] > $time_created) {
                $time_created = $row['time_created'];
                $record = $row;
            }
        }

        //表示する項目のデータを変数に入れる
        $_SESSION['name'] = $record['name'];

        $unixtime = strtotime($_SESSION['date']);
        $_SESSION['year'] = date('Y', $unixtime);
        $_SESSION['month'] = date('m', $unixtime);
        $_SESSION['displayDate'] = date('d', $unixtime);


        $_SESSION['change'] = $record['change1'];
        $_SESSION['earning'] = $record['earning'];
        $_SESSION['received_from'] = unserialize($record['received_from']);
        $_SESSION['total_received'] = unserialize($record['total_received']);
        $_SESSION['content_received'] = unserialize($record['content_received']);
        $_SESSION['sent_to'] = unserialize($record['sent_to']);
        $_SESSION['total_sent'] = unserialize($record['total_sent']);
        $_SESSION['content_sent'] = unserialize($record['content_sent']);
        $_SESSION['next_day_change'] = $record['next_day_change'];
        $_SESSION['jisen_total'] = $record['jisen_total'];
        $_SESSION['next_day_deposit'] = $record['next_day_deposit'];
        $_SESSION['prem_count'] = $record['prem_count'];
        $_SESSION['prem_total'] = $record['prem_total'];
        $_SESSION['for_selling_count'] = $record['for_selling_count'];
        $_SESSION['for_selling_total'] = $record['for_selling_total'];
        $_SESSION['thousand_count'] = $record['thousand_count'];
        $_SESSION['thousand_total'] = $record['thousand_total'];
        $_SESSION['five_count'] = $record['five_count'];
        $_SESSION['five_total'] = $record['five_total'];
        $_SESSION['two_count'] = $record['two_count'];
        $_SESSION['two_total'] = $record['two_total'];
        $_SESSION['client_name'] = unserialize($record['client_name']);
        $_SESSION['urikake_total'] = unserialize($record['urikake_total']);
        $_SESSION['dc_how_much'] = unserialize($record['dc_how_much']);
        $_SESSION['jcb_how_much'] = unserialize($record['jcb_how_much']);
        $_SESSION['paypay_count'] = $record['paypay_count'];
        $_SESSION['paypay_total'] = $record['paypay_total'];
        $_SESSION['nanaco_count'] = $record['nanaco_count'];
        $_SESSION['nanaco_total'] = $record['nanaco_total'];
        $_SESSION['edy_count'] = $record['edy_count'];
        $_SESSION['edy_total'] = $record['edy_total'];
        $_SESSION['suica_count'] = $record['suica_count'];
        $_SESSION['suica_total'] = $record['suica_total'];
    }



        if($_POST['name']) {
            $_SESSION['name'] = $_POST['name'];
        }

        if($_POST['change']){
            $_SESSION['change'] = $_POST['change'];
        }

        if($_POST['earning']) {
            $_SESSION['earning'] = $_POST['earning'];
        }

        if($_POST['received_from']){
            $_SESSION['received_from'] = $_POST['received_from'];
        }

        if($_POST['total_received']) {
            $_SESSION['total_received'] = $_POST['total_received'];
        }

        if($_POST['content_received']) {
            $_SESSION['content_received'] = $_POST['content_received'];
        }

        if($_POST['sent_to']){
            $_SESSION['sent_to'] = $_POST['sent_to'];
        }

        if($_POST['total_sent']) {
            $_SESSION['total_sent'] = $_POST['total_sent'];
        }

        if($_POST['content_sent']) {
            $_SESSION['content_sent'] = $_POST['content_sent'];
        }

        if($_POST['next_day_change']) {
            $_SESSION['next_day_change'] = $_POST['next_day_change'];
        }

        if($_POST['jisen_total']) {
            $_SESSION['jisen_total'] = $_POST['jisen_total'];
        }

        if($_POST['next_day_deposit']) {
            $_SESSION['next_day_deposit'] = $_POST['next_day_deposit'];
        }

        if($_POST['prem_count']) {
            $_SESSION['prem_count'] = $_POST['prem_count'];
        }

        if($_POST['prem_total']) {
            $_SESSION['prem_total'] = $_POST['prem_total'];
        }

        if($_POST['for_selling_count']) {
            $_SESSION['for_selling_count'] = $_POST['for_selling_count'];
        }

        if($_POST['for_selling_total']) {
            $_SESSION['for_selling_total'] = $_POST['for_selling_total'];
        }

        if($_POST['thousand_count']) {
            $_SESSION['thousand_count'] = $_POST['thousand_count'];
            $_SESSION['thousand_total'] = $_POST['thousand_count'] * 1000;
        }

        if($_POST['five_count']) {
            $_SESSION['five_count'] = $_POST['five_count'];
            $_SESSION['five_total'] = $_POST['five_count'] * 500;
        }

        if($_POST['two_count']) {
            $_SESSION['two_count'] = $_POST['two_count'];
            $_SESSION['two_total'] = $_POST['two_count'] * 200;
        }

        if($_POST['client_name']) {
            $_SESSION['client_name'] = $_POST['client_name'];
        }

        if($_POST['urikake_total']) {
            $_SESSION['urikake_total'] = $_POST['urikake_total'];
        }

        if($_POST['dc_how_much']) {
            $_SESSION['dc_how_much'] = $_POST['dc_how_much'];
        }

        if($_POST['jcb_how_much']) {
            $_SESSION['jcb_how_much'] = $_POST['jcb_how_much'];
        }

        if($_POST['paypay_count']) {
            $_SESSION['paypay_count'] = $_POST['paypay_count'];
        }

        if($_POST['paypay_total']) {
            $_SESSION['paypay_total'] = $_POST['paypay_total'];
        }

        if($_POST['nanaco_count']) {
            $_SESSION['nanaco_count'] = $_POST['nanaco_count'];
        }

        if($_POST['nanaco_total']) {
            $_SESSION['nanaco_total'] = $_POST['nanaco_total'];
        }

        if($_POST['edy_count']) {
            $_SESSION['edy_count'] = $_POST['edy_count'];
        }

        if($_POST['edy_total']) {
            $_SESSION['edy_total'] = $_POST['edy_total'];
        }

        if($_POST['suica_count']) {
            $_SESSION['suica_count'] = $_POST['suica_count'];
        }

        if($_POST['suica_total']) {
            $_SESSION['suica_total'] = $_POST['suica_total'];
        }


?>
<html>
<head>
<?php require '../semantic.php';?>
<link rel="stylesheet" href="iba.css">
</head>
<body>

    <div class="confirmation-container">
        <h2 class="ui header">
            <span class="item-name">記入者：</span>
            <span class="item-value"><?php echo $_SESSION['name'];?></span>
            <button class="edit name" id="edit-btn">編集</button>
        </h2>

        <h2 class="ui header">
            <span class="item-name">日付：</span>
            <span><?php echo $_SESSION['year'];?>月<?php echo $_SESSION['month'];?>月<?php echo $_SESSION['displayDate'];?>日</span>
        </h2>

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
            <div class="edit-button-container">
                <button class="edit firstTable" id="edit-section-btn">ここまでを編集</button>
            </div>


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
            <div class="edit-button-container">
            <button class="edit secondTable" id="edit-section-btn">ここまでを編集</button>
            </div>


            <table>
                <div class="table-title">売掛金</div>

                <tr class="client-row">
                    <?php for($i = 0; $i < count($_SESSION['client_name']); $i++):?>
                        <td><?php echo $_SESSION['client_name'][$i];?>様</td>
                        <td><?php echo $_SESSION['urikake_total'][$i];?>円</td>
                    <?php endfor;?>
                </tr>
            </table>
            <div class="edit-button-container">
            <button class="edit thirdTable" id="edit-section-btn">ここまで編集</button>
            </div>


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
            <div class="edit-button-container">
            <button class="edit fourthTable" id="edit-section-btn">ここまで編集</button>
            </div>


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
            <div class="edit-button-container">
            <button class="edit fifthTable center" id="edit-section-btn">ここまで編集</button>
            </div>

        </div>

        <div class="submit-container">
        <a href="submit.php" id="send-btn" class="send-data">送信</a>
        </div>

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
                    <input type="text" name="name" value="<?php echo $_SESSION['name'];?>">
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
                    <input type="number" name="change" id="change" value="<?php echo $_SESSION['change'];?>">
                </div>
                <div class="field">
                    <label for="earning">現金売上</label>
                    <input type="number" name="earning" id="earning" value="<?php echo $_SESSION['earning'];?>">
                </div>
                <div>
                    <?php for($i = 0; $i < count($_SESSION['received_from']); $i++):?>
                        <div class="field">
                            <label for="total_received">入金額</label>
                            <input type="number" id="total_received" name="total_received[]" value="<?php echo $_SESSION['total_received'][$i];?>">
                        </div>
                        <div class="field">
                            <label for="received_from">入金相手</label>
                            <input type="text" id="received_from" name="received_from[]" value="<?php echo $_SESSION['received_from'][$i];?>">
                        </div>
                        <div class="field">
                            <label for="content_received">入金内容</label>
                            <input type="text" id="content_received" name="content_received[]" value="<?php echo $_SESSION['content_received'][$i];?>">
                        </div>
                    <?php endfor ;?>
                </div>
                <div>
                    <?php for($i = 0; $i < count($_SESSION['sent_to']); $i++):?>
                        <div class="field">
                            <label for="total_sent">出金額</label>
                            <input type="number" id="total_sent" name="total_sent[]" value="<?php echo $_SESSION['total_sent'][$i];?>">
                        </div>
                        <div class="field">
                            <label for="sent_to">出金先</label>
                            <input type="text" id="sent_to" name="sent_to[]" value="<?php echo $_SESSION['sent_to'][$i];?>">
                        </div>
                        <div class="field">
                            <label for="content_sent">出金内容</label>
                            <input type="text" id="content_sent" name="content_sent[]" value="<?php echo $_SESSION['content_sent'][$i];?>">
                        </div>
                    <?php endfor ;?>
                </div>
                <div class="field">
                    <label for="next_day_change">翌日つり銭</label>
                    <input type="number" id="next_day_change" name="next_day_change" value="<?php echo $_SESSION['next_day_change'];?>">
                </div>
                <div class="field">
                    <label for="jisen_total">実践合計</label>
                    <input type="number" id="jisen_total" name="jisen_total" value="<?php echo $_SESSION['jisen_total'];?>">
                </div>
                <div class="field">
                    <label for="next_day_deposit">翌日預入</label>
                    <input type="number" id="next_day_deposit" name="next_day_deposit" value="<?php echo $_SESSION['next_day_deposit'];?>">
                </div>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for secondTable -->
    <div class="ui modal secondTable">
        <i class="close icon"></i>
        <div class="header">
            食事券
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field">
                    <label for="prem_count">プレミアム枚数</label>
                    <input type="number" name="prem_count" value="<?php echo $_SESSION['prem_count'];?>">
                </div>
                <div class="field">
                    <label for="prem_total">プレミアム金額</label>
                    <input type="number" name="prem_total" value="<?php echo $_SESSION['prem_total'];?>">
                </div>
                <div class="field">
                    <label for="for_selling_count">販売用枚数</label>
                    <input type="number" name="for_selling_count" value="<?php echo $_SESSION['for_selling_count'];?>">
                </div>
                <div class="field">
                    <label for="for_selling_total">販売用金額</label>
                    <input type="number" name="for_selling_total" value="<?php echo $_SESSION['for_selling_total'];?>">
                </div>
                <div class="field">
                    <label for="thousand_count">サービス千円枚数</label>
                    <input type="number" name="thousand_count" value="<?php echo $_SESSION['thousand_count'];?>">
                </div>
                <div class="field">
                    <label for="five_count">サービス500円枚数</label>
                    <input type="number" name="five_count" value="<?php echo $_SESSION['five_count'];?>">
                </div>
                <div class="field">
                    <label for="two_count">サービス200円枚数</label>
                    <input type="number" name="two_count" value="<?php echo $_SESSION['two_count'];?>">
                </div>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for thirdTable -->
    <div class="ui modal thirdTable">
        <i class="close icon"></i>
        <div class="header">
            売掛金
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <?php for($i = 0; $i < count($_SESSION['client_name']); $i++):?>
                    <div class="field">
                        <label for="client_name">お客様</label>
                        <input type="text" name="client_name[]" id="client_name" value="<?php echo $_SESSION['client_name'][$i];?>">
                    </div>
                    <div class="field">
                        <label for="urikake_total">金額</label>
                        <input type="number" name="urikake_total[]" id="urikake_total" value="<?php echo $_SESSION['urikake_total'][$i];?>">
                    </div>
                <?php endfor ;?>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for fourthTable -->
    <div class="ui modal fourthTable">
        <i class="close icon"></i>
        <div class="header">
            DC, JCB, PAYPAY
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div>
                    <?php for($i = 0; $i < count($_SESSION['dc_how_much']); $i++):?>
                        <div class="field">
                            <label for="dc_how_much">DC</label>
                            <input type="number" name="dc_how_much[]" value="<?php echo $_SESSION['dc_how_much'][$i];?>">
                        </div>
                    <?php endfor;?>
                </div>
                <div>
                    <?php for($i = 0; $i < count($_SESSION['jcb_how_much']); $i++):?>
                        <div class="field">
                            <label for="jcb_how_much">JCB</label>
                            <input type="number" name="jcb_how_much[]" value="<?php echo $_SESSION['jcb_how_much'][$i];?>">
                        </div>
                    <?php endfor;?>
                </div>
                <div class="field">
                    <label for="paypay_count">PAYPAY件数</label>
                    <input type="number" id="paypay_count" name="paypay_count" value="<?php echo $_SESSION['paypay_count'];?>">
                </div>
                <div class="field">
                    <label for="paypay_total">PAYPAY合計額</label>
                    <input type="number" id="paypay_total" name="paypay_total" value="<?php echo $_SESSION['paypay_total'];?>">
                </div>
                <button class="ui button" type="submit" >編集を完了</button>
            </form>
        </div>
    </div>

    <!-- modal for fifthTable -->
    <div class="ui modal fifthTable">
        <i class="close icon"></i>
        <div class="header">
            その他
        </div>
        <div class="content">
            <form class="ui form" action="" method="post">
                <div class="field">
                    <label for="nanaco_count">nanaco件数</label>
                    <input type="number" name="nanaco_count" id="nanaco_count" value="<?php echo $_SESSION['nanaco_count'];?>">
                </div>
                <div class="field">
                    <label for="nanaco_total">nanaco金額</label>
                    <input type="number" name="nanaco_total" id="nanaco_total" value="<?php echo $_SESSION['nanaco_total'];?>">
                </div>
                <div class="field">
                    <label for="edy_count">edy件数</label>
                    <input type="number" name="edy_count" id="edy_count" value="<?php echo $_SESSION['edy_count'];?>">
                </div>
                <div class="field">
                    <label for="edy_total">edy金額</label>
                    <input type="number" name="edy_total" id="edy_total" value="<?php echo $_SESSION['edy_total'];?>">
                </div>
                <div class="field">
                    <label for="suica_count">suica件数</label>
                    <input type="number" name="suica_count" id="suica_count" value="<?php echo $_SESSION['suica_count'];?>">
                </div>
                <div class="field">
                    <label for="suica_total">suica金額</label>
                    <input type="number" name="suica_total" id="suica_total" value="<?php echo $_SESSION['suica_total'];?>">
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
                } else if($(this).hasClass('secondTable')) {
                    $('.ui.modal.secondTable').modal('show');
                } else if($(this).hasClass('thirdTable')) {
                    $('.ui.modal.thirdTable').modal('show');
                } else if($(this).hasClass('fourthTable')) {
                    $('.ui.modal.fourthTable').modal('show');
                } else if($(this).hasClass('fifthTable')) {
                    $('.ui.modal.fifthTable').modal('show');
                }

            });




        });

    </script>
</body>
</html>
