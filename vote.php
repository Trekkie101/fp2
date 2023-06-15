<?php


require_once 'config.php'; // Settings & Configuration

// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$id = mysqli_real_escape_string($conn, $_GET['id']);
$vote = (int)$_GET['vote'];
$sort = (int)$_GET['sort'];

 
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

header('Location: index.php?sort='.$sort.'');

?>