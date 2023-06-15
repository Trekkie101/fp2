<?php

function pubheader(){

echo'

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedit</title>
	<link rel="stylesheet" href="ext/bulma.css?2">
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  </head>
  <body>
  
  
  
  <nav class="navbar is-link" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
	  <a class="navbar-item" href="index.php">
	  <span class="icon is-large">
		<i class="fas fa-newspaper is-large"></i>
	  </span>
	  <h3 class="title is-3 has-text-white">Feedit</h3>
	  </a>
	</div>
  </nav>
  
<br />

<section class="section"><div class="container">';

echo'
<div class="buttons">
  <button class="button is-link"><a class="has-text-white" href="index.php">🔥 Firehose</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=1">🩷 Today</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=2">❤️ Yesterday</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=3">🧡 Week</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=4">💛 Month</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=5">💚 Year</a></button>
  <button class="button is-link"><a class="has-text-white" href="index.php?sort=6">💙 All Time</a></button>
</div>

';	
	
}


function pubfooter(){
	
echo'
	</body>
	</html>
	
';
	
}

function ingest($urlrunner, $cid){
	
	// Let's record how long this actually takes - feeds can be slow if a remote server is offline
	$starttime = microtime(true); 
	
	// This is a feed parser.
	include_once 'ext/Feed.php';
	include 'config.php';
	
	
	
	// Create connection
	$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	
	
	
	// Set the URL to load
	$rss = Feed::loadRss(''.$urlrunner.'');
	
	// We might have foreign entities, so force a character set.
	mysqli_set_charset($conn, "utf8mb4");
	
	
	
	// This is effectively our 'author' of the content	
	$author = mysqli_real_escape_string($conn, $rss->title);
	
	
	// count the items returned
	$c = 0;
	
	foreach ($rss->item as $item) {
	
		$c++;
		
		$title = mysqli_real_escape_string($conn, $item->title);	
		
		$url = mysqli_real_escape_string($conn, $item->url);		
				
		$id = sha1($item->title);
			
		$submit = mysqli_real_escape_string($conn, $item->timestamp);		
		
		
		// Send it to the database! Ignore any duplicate ID's. 
		$sql = "INSERT IGNORE INTO feeds (id, author, title, url, submit, votes, cid) VALUES ('$id', '$author', '$title', '$url', FROM_UNIXTIME('$submit'), '', '$cid')";
		
		if (mysqli_execute_query($conn, $sql,)) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		
	}
	
	// Total all the items returned
	print $c;
			
	
	// close down any connections to the database.
	mysqli_close($conn);
	
	
	// and now we can stop recording time.
	$endtime = microtime(true);
	
	// Spit out how long it took
	printf("Load time: %f seconds", $endtime - $starttime );
	
	
}


?>