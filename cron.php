<?php

$today = date("Ymd"); 

// Todo

// Check last run was more than 1 hour ago
// Find a way to log fails
// Mark success
// Set actual cron to run



ini_set("error_log", "log/".$today."-php_errors.txt");

include 'functions.php';

$url = 'http://viveecosse.com/feed/';
$cid = '99';

ingest($url, $cid);

?>