<?php


// http://178.62.10.143/vote.php?vote=1&id=f60d7ac87d224b3168bfc79a8ecf25e578335c77

require_once 'config.php'; // Settings & Configuration

// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$id = mysqli_real_escape_string($conn, $_GET['id']);
$vote = (int)$_GET['vote'];

 
if ($vote == '1'){ 
	$sql = "UPDATE feeds SET votes = votes - 1 WHERE id = '$id'";
	
	print $sql;
}
if ($vote == '2'){
	$sql = "UPDATE feeds SET votes = votes + 1 WHERE id = '$id'";	
} else {
	echo 'error with vote';
}

// Connect to the database
$result = mysqli_execute_query($conn, $sql);

// close down any connections to the database.
mysqli_close($conn);

header('Location: index.php');

?>