<?php

$today = date("Ymd"); 


ini_set("error_log", "log/".$today."-php_errors.txt");

include 'functions.php';

$url = 'http://viveecosse.com/feed/';
$cid = '99';

ingest($url, $cid);

?>