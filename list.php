<?php

session_start();

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
    <div id="admin-header" class="ui three item menu">
        <a href="admin-dashboard.php" class="item">管理画面</a>
        
        <a href="admin-pass.php" class="item">パスワード変更</a>
    
        <a class="item" href="admin-logout.php">ログアウト</a>
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
