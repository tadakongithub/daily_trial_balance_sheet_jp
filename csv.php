<?php
$filename = 'test.csv';
$users = array(
    ['tadashi', 28, 'male'],
    ['nicole', 27, 'female'],
    ['brandy', 30, 'female']
);

$file = fopen($filename, 'w');

foreach($users as $user) {
    fputcsv($file, $user);
}

fclose($file);

// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Type: application/csv; "); 

readfile($filename);

// deleting file
unlink($filename);
exit();

