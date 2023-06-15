<?php

// Let's record how long this actually takes - feeds can be slow if a remote server is offline
$starttime = microtime(true); 

// Grab some essentials
require_once 'config.php'; // Settings & Configuration
require_once 'functions.php'; // Useful functions

pubheader(); // Load the header




// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// We might have foreign entities, so force a character set.
mysqli_set_charset($conn, "utf8mb4");


// Sorts
// 9 - default
// 1 - Popular Today
// 2 - Popular Yesterday 
// 3 - Popular Last Week
// 4 - Popular Last Month
// 5 - Popular Last Year
// 6 - Popular All Time


$sort = isset($_GET['sort']) ? $_GET['sort'] : '9';

$sort = (int)$sort;


switch ($sort) {
	case 1:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-1 AND CURRENT_DATE+1 ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 2:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-2 AND CURRENT_DATE+1 ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 3:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-7 AND CURRENT_DATE+1 ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 4:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-31 AND CURRENT_DATE+1 ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 5:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-365 AND CURRENT_DATE+1 ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 6:
		$sql = "SELECT * FROM feeds ORDER BY votes DESC LIMIT 500"; // Default
		break;
	case 9:
		$sql = "SELECT * FROM feeds WHERE submit BETWEEN CURRENT_DATE-1 AND CURRENT_DATE+1 ORDER BY submit DESC LIMIT 500"; // Default
		break;
}


// Connect to the database
$result = mysqli_execute_query($conn, $sql);

// Check if there is anything to display
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	  
	  
 
	echo '<article class="message is-info"><div class="message-body">'; // Create the box for each entry
	
	// This builds the votes and authoriship box
	echo'<div class="tags has-addons">
			<span class="tag is-success"><a href="vote.php?vote=2&id='.$row["id"].'&sort='.$sort.'">
				<span class="icon"><i class="fas fa-arrow-up"></i></span></a>
			</span>
			<span class="tag is-dark">
				'.$row["votes"].'
			</span>
			<span class="tag is-danger"><a href="vote.php?vote=1&id='.$row["id"].'&sort='.$sort.'">
				<span class="icon"><i class="fas fa-arrow-down"></i></span></a>
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

echo'<div class="tags"><span class="tag is-danger"><a class="has-text-white" href="addfeed.php">Add Feed<a></span></div>';

echo'<div class="tags has-addons"><span class="tag is-dark">Generated in</span><span class="tag is-info">';
// Spit out how long it took
printf(" %f seconds", $endtime - $starttime );
echo'</span></div>';

echo'</div></section>';

pubfooter(); // Load the footer

?>