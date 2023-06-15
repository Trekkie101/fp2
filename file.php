<?php


$file = 'log/addsite.txt';
$data1 = 'test';


file_put_contents($file, $data1, FILE_APPEND);


?>