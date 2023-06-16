<?php

$today = date("Ymd"); 

$file = 'log/addsite'.$today.'.txt';
$data1 = "test";
$data1 .= "\n";


file_put_contents($file, $data1, FILE_APPEND);


?>