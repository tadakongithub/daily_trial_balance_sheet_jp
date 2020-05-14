<?php

$myPDO = new PDO('mysql:host=localhost;dbname=ljm', 'root', 'root');
$myPDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$results = $myPDO->query("SELECT * FROM ibaraki");
$count = $myPDO->prepare("SELECT count(*) FROM ibaraki");
$count->execute();

$recordCount = $count->fetchColumn();



require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//ワークブックを作る
$spreadsheet = new Spreadsheet();

//日付ごとループ
$i = 0;
while($record = $results->fetch()) {
    if($i == 0) {
        $spreadsheet->getActiveSheet()->setTitle($record['date']);
    } else {
        $spreadsheet->createSheet()->setTitle($record['date']);
    }

    //現在のシートを変数にする
    $activeSheet = $spreadsheet->getSheet($i);

    //1 ~ 5行目
    $activeSheet
    ->setCellValue('J1', '記入者')
    ->setCellValue('K1', $record['name'])
    ->setCellValue('A2', '日付')
    ->setCellValue('B2', $record['date'])
    ->setCellValue('J3', '店舗名')
    ->setCellValue('K3', '茨城店')
    ->setCellValue('A4', 'つり銭')
    ->mergeCells('A4:C4')
    ->mergeCells('D4:G4')
    ->setCellValue('D4', $record['change1'])
    ->mergeCells('H4:M4')
    ->setCellValue('H4', '内訳')
    ->mergeCells('A5:C5')
    ->setCellValue('A5', '現金売上')
    ->mergeCells('D5:G5')
    ->setCellValue('D5', $record['earning'])
    ->mergeCells('H5:J5')
    ->setCellValue('H5', '取引・購入先名')
    ->mergeCells('K5:M5')
    ->setCellValue('K5', '明細')
    ;

    
    //入金のデータを配列に戻す
    $received_from_array = unserialize($record['received_from']);
    $total_received_array = unserialize($record['total_received']);
    $content_received_array = unserialize($record['content_received']);

    //入金の個数（回数）
    $received_count = count($received_from_array);

    //A列のセルを結合「入金」
    $activeSheet
        ->mergeCells("A6:A".(5+$received_count))
        ->setCellValue('A6', '入金');
    
    //入金のデータ入力
        for($j = 0; $j < $received_count; $j++) {
            $activeSheet
                ->mergeCells('B'.(6+$j).':C'.(6+$j))
                ->setCellValue('B'.(6+$j), $total_received_array[$j])
                ->mergeCells('D'.(6+$j).':G'.(6+$j))
                ->mergeCells('H'.(6+$j).':J'.(6+$j))
                ->setCellValue('H'.(6+$j), $received_from_array[$j])
                ->mergeCells('K'.(6+$j).':M'.(6+$j))
                ->setCellValue('K'.(6+$j), $content_received_array[$j]);
        }
    
    //出金のデータを配列に戻す
    $sent_to_array = unserialize($record['sent_to']);
    $total_sent_array = unserialize($record['total_sent']);
    $content_sent_array = unserialize($record['content_sent']);

    //出金の個数（回数）
    $sent_count = count($sent_to_array);

    //A列のセルを結合「出金」
    $activeSheet
        ->mergeCells("A".(6+$received_count).":A".(7+$sent_count))
        ->setCellValue('A'.(6+$received_count), '出金');

    //出金のデータ入力
        for($j = 0; $j < $sent_count; $j++) {
            $activeSheet
                ->mergeCells('B'.(6+$received_count+$j).':C'.(6+$received_count+$j))
                ->setCellValue('B'.(6+$received_count+$j), $total_sent_array[$j])
                ->mergeCells('D'.(6+$received_count+$j).':G'.(6+$received_count+$j))
                ->mergeCells('H'.(6+$received_count+$j).':J'.(6+$received_count+$j))
                ->setCellValue('H'.(6+$received_count+$j), $sent_to_array[$j])
                ->mergeCells('K'.(6+$received_count+$j).':M'.(6+$received_count+$j))
                ->setCellValue('K'.(6+$received_count+$j), $content_sent_array[$j]);
        }

    //現時点で最終行を変数に入れ、「支払計」〜「翌日預け入れ」までの
    //行番号を変数に格納する
    $lastRow = 5+$received_count+$sent_count;
    $shiharai = $lastRow + 1;
    $reji = $lastRow + 2;
    $genkin = $lastRow + 3;
    $jissen = $lastRow + 4;
    $tsuri = $lastRow + 5;
    $azuke = $lastRow + 6;

    //セルを結合し項目名を記入
    $activeSheet
        ->mergeCells('A'.$shiharai.':C'.$shiharai)
        ->mergeCells('A'.$reji.':C'.$reji)
        ->mergeCells('A'.$genkin.':C'.$genkin)
        ->mergeCells('A'.$jissen.':C'.$jissen)
        ->mergeCells('A'.$tsuri.':C'.$tsuri)
        ->mergeCells('A'.$azuke.':C'.$azuke)
        ->setCellValue('A'.$shiharai, '支払計')
        ->setCellValue('A'.$reji, 'レジ残計')
        ->setCellValue('A'.$genkin, '現金過不足')
        ->setCellValue('A'.$jissen, '実践合計')
        ->setCellValue('A'.$tsuri, '翌日つり銭')
        ->setCellValue('A'.$azuke, '翌日預け入れ')
        ->setCellValue('D'.$tsuri, $record['next_day_change'])
        ->setCellValue('D'.$azuke, $record['next_day_deposit']);

    //「支払計」〜「翌日預け入れ」の残り
    $activeSheet
        ->mergeCells('D'.$shiharai.':G'.$shiharai)
        ->mergeCells('D'.$reji.':G'.$reji)
        ->mergeCells('D'.$genkin.':G'.$genkin)
        ->mergeCells('D'.$jissen.':G'.$jissen)
        ->mergeCells('D'.$tsuri.':G'.$tsuri)
        ->mergeCells('D'.$azuke.':G'.$azuke)
        
        ->setCellValue('J'.$shiharai, '本部記入欄')
        ->setCellValue('J'.$reji, '8%')
        ->setCellValue('J'.$genkin, '10%')
        ->setCellValue('J'.$jissen, '計')
        ->setCellValue('J'.$tsuri, 'クーポン計')
        ->setCellValue('J'.$azuke, 'クーポン差額')

        ->mergeCells('K'.$shiharai.':M'.$shiharai)
        ->mergeCells('K'.$reji.':M'.$reji)
        ->mergeCells('K'.$genkin.':M'.$genkin)
        ->mergeCells('K'.$jissen.':M'.$jissen)
        ->mergeCells('K'.$tsuri.':M'.$tsuri)
        ->mergeCells('K'.$azuke.':M'.$azuke);

    //食事券らんの行番号
    $ticketRow1 = $azuke + 2;
    $ticketRow2 = $ticketRow1 + 1;
    $ticketRow3 = $ticketRow2 + 1;
    $ticketRow4 = $ticketRow3 + 1;
    $ticketRow5 = $ticketRow4 + 1;

    //食事券のらん
    $activeSheet
        ->mergeCells('A'.$ticketRow1.':G'.$ticketRow1)
        ->mergeCells('H'.$ticketRow1.':I'.$ticketRow1)
        ->mergeCells('J'.$ticketRow1.':L'.$ticketRow1)
        ->mergeCells('B'.$ticketRow2.':E'.$ticketRow2)
        ->mergeCells('F'.$ticketRow2.':I'.$ticketRow2)
        ->mergeCells('J'.$ticketRow2.':M'.$ticketRow2)
        ->setCellValue('A'.$ticketRow1, '※食事券計は、ジャーナルの食事券計と合致すること。')
        ->setCellValue('H'.$ticketRow1, '食事券計')
        ->setCellValue('M'.$ticketRow1, '円')
        ->setCellValue('B'.$ticketRow2, 'プレミアム食事券')
        ->setCellValue('F'.$ticketRow2, '販売用回収')
        ->setCellValue('J'.$ticketRow2, 'サービス用回収')
        ->setCellValue('A'.$ticketRow3, '千円券')
        ->setCellValue('C'.$ticketRow3, '枚')
        ->setCellValue('E'.$ticketRow3, '円')
        ->setCellValue('G'.$ticketRow3, '枚')
        ->setCellValue('I'.$ticketRow3, '円')
        ->setCellValue('K'.$ticketRow3, '枚')
        ->setCellValue('M'.$ticketRow3, '円')
        ->setCellValue('K'.$ticketRow4, '枚')
        ->setCellValue('M'.$ticketRow4, '円')
        ->setCellValue('K'.$ticketRow5, '枚')
        ->setCellValue('M'.$ticketRow5, '円')
        ->setCellValue('A'.$ticketRow4, '500円')
        ->setCellValue('A'.$ticketRow5, '200円');

    
    //売掛の名前と金額の配列
    $client_name_array = unserialize($record['client_name']);
    $urikake_total_array = unserialize($record['urikake_total']);
    //売掛の数
    $urikake_count = count($client_name_array);
    //売掛金らん
    $urikakeRow1 = $ticketRow5 + 3;

    $activeSheet
        ->mergeCells('A'.$urikakeRow1.':B'.$urikakeRow1)
        ->setCellValue('A'.$urikakeRow1, '売掛金');

        for($j = 0; $j < $urikake_count; $j++) {
            $activeSheet
                ->mergeCells('C'.($urikakeRow1+$j).':D'.($urikakeRow1+$j))
                ->setCellValue('C'.($urikakeRow1+$j), $client_name_array[$j].'様')
                ->mergeCells('E'.($urikakeRow1+$j).':F'.($urikakeRow1+$j))
                ->setCellValue('E'.($urikakeRow1+$j), $urikake_total_array[$j].'円');
        }

    //DC,JCBの値を配列に戻す
    $dc_how_much = unserialize($record['dc_how_much']);
    $jcb_how_much = unserialize($record['jcb_how_much']);

    //dc,jcbの数
    $dc_count = count($dc_how_much);
    $jcb_count = count($jcb_how_much);
    $dcRow1 = $urikakeRow1 + $urikake_count + 1;
    $activeSheet
        ->mergeCells('A'.$dcRow1.':B'.$dcRow1)
        ->mergeCells('E'.$dcRow1.':F'.$dcRow1)
        ->mergeCells('G'.$dcRow1.':H'.$dcRow1)
        ->mergeCells('K'.$dcRow1.':L'.$dcRow1)

        ->setCellValue('A'.$dcRow1, 'DC売上内訳')
        ->setCellValue('G'.$dcRow1, 'JCB売上内訳');

        for($j = 0; $j < $dc_count; $j++) {
            $activeSheet
                ->setCellValue('E'.($dcRow1+$j), $dc_how_much[$j].'円');
        }

        for($j = 0; $j < $jcb_count; $j++) {
            $activeSheet
                ->setCellValue('K'.($dcRow1+$j), $jcb_how_much[$j].'円');
        }

    //dc,jcb合計の行
    $dc_jcb_total_row;
    if($dc_count > $jcb_count) {
        $dc_jcb_total_row = $dcRow1 + $dc_count;
    } else {
        $dc_jcb_total_row = $dcRow1 + $jcb_count;
    }

    $activeSheet
        ->mergeCells('A'.$dc_jcb_total_row.':B'.$dc_jcb_total_row)
        ->mergeCells('C'.$dc_jcb_total_row.':D'.$dc_jcb_total_row)
        ->mergeCells('E'.$dc_jcb_total_row.':F'.$dc_jcb_total_row)
        ->mergeCells('G'.$dc_jcb_total_row.':H'.$dc_jcb_total_row)
        ->mergeCells('I'.$dc_jcb_total_row.':J'.$dc_jcb_total_row)
        ->mergeCells('K'.$dc_jcb_total_row.':L'.$dc_jcb_total_row)

        ->setCellValue('A'.$dc_jcb_total_row, 'DC売上合計')
        ->setCellValue('C'.$dc_jcb_total_row, $dc_count.'件')
        ->setCellValue('E'.$dc_jcb_total_row, array_sum($dc_how_much).'円')
        ->setCellvalue('G'.$dc_jcb_total_row, 'JCB売上合計')
        ->setCellValue('I'.$dc_jcb_total_row, $jcb_count.'件')
        ->setCellValue('K'.$dc_jcb_total_row, array_sum($jcb_how_much).'円');

    //paypay
    $paypayRow = $dc_jcb_total_row + 3;

    $activeSheet
        ->mergeCells('A'.$paypayRow.':B'.$paypayRow)
        ->mergeCells('C'.$paypayRow.':D'.$paypayRow)
        ->mergeCells('E'.$paypayRow.':F'.$paypayRow)
        ->setCellValue('A'.$paypayRow, 'PAYPAY売上合計')
        ->setCellValue('C'.$paypayRow, $record['paypay_count'].'件')
        ->setCellValue('E'.$paypayRow, $record['paypay_total'].'円');

    //others
    $othersRow1 = $paypayRow + 3;
    $othersRow2 = $othersRow1 + 1;

    $activeSheet
        ->mergeCells('A'.$othersRow1.':B'.$othersRow1)
        ->mergeCells('C'.$othersRow1.':D'.$othersRow1)
        ->mergeCells('E'.$othersRow1.':F'.$othersRow1)
        ->mergeCells('G'.$othersRow1.':H'.$othersRow1)
        ->mergeCells('I'.$othersRow1.':J'.$othersRow1)
        ->mergeCells('K'.$othersRow1.':L'.$othersRow1)
        ->mergeCells('A'.$othersRow2.':B'.$othersRow2)
        ->mergeCells('C'.$othersRow2.':D'.$othersRow2)
        ->mergeCells('E'.$othersRow2.':F'.$othersRow2)
        ->mergeCells('G'.$othersRow2.':H'.$othersRow2)
        ->mergeCells('I'.$othersRow2.':J'.$othersRow2)
        ->mergeCells('K'.$othersRow2.':L'.$othersRow2)
        ->setCellValue('A'.$othersRow1, 'nanaco')
        ->setCellValue('C'.$othersRow1, $record['nanaco_count'].'件')
        ->setCellValue('E'.$othersRow1, $record['nanaco_total'].'円')
        ->setCellValue('G'.$othersRow1, 'suica')
        ->setCellValue('I'.$othersRow1, $record['suica_count'].'件')
        ->setCellValue('K'.$othersRow1, $record['suica_total'].'円')
        ->setCellValue('A'.$othersRow2, 'edy')
        ->setCellValue('C'.$othersRow2, $record['edy_count'].'件')
        ->setCellValue('E'.$othersRow2, $record['edy_total'].'円')
        ->setCellValue('G'.$othersRow2, 'その他交通IC');

    //メモらん
    $noteTitleRow = $othersRow2 + 2;
    $noteRow = $noteTitleRow + 1;

    $activeSheet
        ->mergeCells('A'.$noteTitleRow.':C'.$noteTitleRow)
        ->mergeCells('A'.$noteRow.':L'.($noteRow+4))
        ->setCellValue('A'.$noteTitleRow, 'メモ、伝達事項：');





    
    $i++;
}




$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');



?>
<html>
<head>
</head>
<body>
    <div><a href="hello world.xlsx" download>download</a></div>
</body>
</html>