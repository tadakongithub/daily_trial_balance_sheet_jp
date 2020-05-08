<?php

$myPDO = new PDO('mysql:host=localhost;dbname=ljm', 'root', 'root');
$myPDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>