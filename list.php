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
<head></head>
<body>
    <nav>   
        <ul>
            <li><a href="index.php">トップ</a></li>
            <li><a href="list.php">ダウンロードページ</a></li>
        </ul>
    </nav>

    <form action="download.php" method="post">
        <table>
            <tr>
                <td>茨城店<input type="hidden" value="ibaraki" name="tableName"/></td>
                <td>
                    <select name="yearMonth">
                        <?php foreach($yearMonthArray as $yearMonth):?>
                            <option value="<?php echo $yearMonth;?>"><?php echo $yearMonth;?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td><input type="submit" value="ダウンロード" name="ibaraki"></td>
            </tr>
        </table>
    </form>
</body>
</html>
