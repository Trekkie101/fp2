<?php

// Let's record how long this actually takes - feeds can be slow if a remote server is offline
$starttime = microtime(true); 


require_once 'config.php';
require_once 'functions.php';

pubheader();


echo'<section class="section"><div class="container">';


// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// We might have foreign entities, so force a character set.
mysqli_set_charset($conn, "utf8mb4");



$sql = "SELECT * FROM feeds ORDER BY submit DESC LIMIT 5";

$result = mysqli_execute_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	  
	  
 
	echo '<article class="message is-info"><div class="message-body">';
	echo'<div class="tags has-addons">
			<span class="tag is-success">
				<span class="icon"><i class="fas fa-arrow-up"></i></span>
			</span>
			<span class="tag is-dark">
				100
			</span>
			<span class="tag is-danger">
				<span class="icon"><i class="fas fa-arrow-down"></i></span>
			</span>
			<span class="tag is-link">
			<em>' . $row["author"]. '</em>
			</span>
		</div>';
	echo '<h2 class="title is-2"><a href="'.$row["url"].'">' . $row["title"]. '</a></h2>';
	echo '</div></article></p>';
  }
} else {
  echo "0 results";
}


	

// close down any connections to the database.
mysqli_close($conn);


// and now we can stop recording time.
$endtime = microtime(true);

echo'<div class="tags has-addons"><span class="tag is-dark">Generated in</span><span class="tag is-info">';
// Spit out how long it took
printf(" %f seconds", $endtime - $starttime );
echo'</span></div>';
echo'</div></section>';

pubfooter();

?>