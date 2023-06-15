<?php

// Let's record how long this actually takes - feeds can be slow if a remote server is offline
$starttime = microtime(true); 


require_once 'config.php';


// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// We might have foreign entities, so force a character set.
mysqli_set_charset($conn, "utf8mb4");



$sql = "SELECT * FROM feeds ORDER BY submit DESC";

$result = mysqli_execute_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	echo  '<a href='.$row["url"].'>' . $row["title"]. "</a> by " . $row["author"]. "<br />";
  }
} else {
  echo "0 results";
}


	

// close down any connections to the database.
mysqli_close($conn);


// and now we can stop recording time.
$endtime = microtime(true);

// Spit out how long it took
printf("Load time: %f seconds", $endtime - $starttime );



?>