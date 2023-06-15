<?php

// Let's record how long this actually takes - feeds can be slow if a remote server is offline
$starttime = microtime(true); 


// This is a feed parser.
require_once 'ext/Feed.php';
require_once 'config.php';





// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}




// Set the URL to load
$rss = Feed::loadRss('https://viveecosse.com/feed/');

// We might have foreign entities, so force a character set.
mysqli_set_charset($conn, "utf8mb4");



// This is effectively our 'author' of the content	
$author = mysqli_real_escape_string($conn, $rss->title);


// count the items returned
$c = 0;

foreach ($rss->item as $item) {

	$c++;
	
	$title = mysqli_real_escape_string($conn, $item->title);	
	echo 'Title: ', $item->title;
	
	$url = mysqli_real_escape_string($conn, $item->url);
	echo ' - ', $item->url;
	
	
	echo ' - ';
	
	$id = sha1($item->title);
	echo sha1($item->title);
	
	echo ' - ';

	
	$submit = mysqli_real_escape_string($conn, $item->timestamp);
	echo $item->timestamp;
	echo '<br />';
	
	
	
	// Send it to the database! Ignore any duplicate ID's. 
	$sql = "INSERT IGNORE INTO feeds (id, author, title, url, submit, votes) VALUES ('$id', '$author', '$title', '$url', FROM_UNIXTIME('$submit'), '')";
	
	if (mysqli_execute_query($conn, $sql,)) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	
}

// Total all the items returned
print $c;


	echo '<br /><br /><br /><br />';
	

// close down any connections to the database.
mysqli_close($conn);


// and now we can stop recording time.
$endtime = microtime(true);

// Spit out how long it took
printf("Load time: %f seconds", $endtime - $starttime );



?>