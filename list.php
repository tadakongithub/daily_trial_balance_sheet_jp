<?php

require 'db.php';

//all data in ibaraki table
$results = $myPDO->query('SELECT * FROM ibaraki');

$yearMonthArray = array();
//fetching each record
while($result = $results->fetch()) {
    $timestamp = strtotime($result['date']);
    $value = date('Y-m', $timestamp);
    if(!in_array($value, $yearMonthArray)) {
        $yearMonthArray[] = $value;
    }
}

?>
<html>
<head>
    <?php require 'semantic.php'; ?>
    <link rel="stylesheet" href="style.css">
    <script>
        $(document).ready(function(){
            $('.select.dropdown').dropdown();
        });
    </script>
</head>
<body>
    <div class="ui two item menu">
        <a class="item" href="index.php">トップ</a>
        <a class="item" href="list.php">ダウンロードページ</a>
    </div>

    <div class="home-container">
        <form action="download.php" method="post" class="ui form">
            <div class="field">
                <label for="tableName">茨城店</label>
                <input type="hidden" value="ibaraki" name="tableName"/>
            </div>
                
            <div class="field">
                <select name="yearMonth" class="ui select dropdown" id="yearMonth">
                    <?php foreach($yearMonthArray as $yearMonth):?>
                        <option value="<?php echo $yearMonth;?>"><?php echo $yearMonth;?></option>
                    <?php endforeach;?>
                </select>
            </div>
                   
            <input type="hidden" name="ibaraki" value="ibaraki">
            <div class="submit-container">
                <button type="submit" class="submit-btn">ダウンロード</button>
            </div>
        </form>
    </div>               |
</body>
</html>
