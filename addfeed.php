<?php



// Grab some essentials
require_once 'config.php'; // Settings & Configuration
require_once 'functions.php'; // Useful functions
require_once 'ext/Feed.php';



pubheader(); // Load the header




// Create connection
$conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// We might have foreign entities, so force a character set.
mysqli_set_charset($conn, "utf8mb4");



if (isset($_POST['url'])) {
	

$url = mysqli_real_escape_string($conn, $_POST['url']);

$rss = Feed::loadRss(''.$url.'');

$name = mysqli_real_escape_string($conn, $rss->title);


$insert = "INSERT IGNORE INTO crawler (id, name, url, failed, success, lastcrawl) VALUES (NULL, '$name', '$url', NULL, NULL, current_timestamp());";

mysqli_execute_query($conn, $insert);

$crawlerid = mysqli_insert_id($conn);



ingest($url,$crawlerid);

}


echo'
<form action="addfeed.php" method="post">
<div class="field is-large is-grouped">
  <p class="control is-expanded">
	<input class="input" type="text" name="url" id="url" placeholder="Add a feed">
  </p>
  <p class="control">
	<input type="submit" class="button is-info">
	</p>
  </p>
</div>
</form>

<br />
<br />
';


$sql = "SELECT * FROM crawler"; // Default

// Connect to the database
$result = mysqli_execute_query($conn, $sql);

// Check if there is anything to display
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	 
	 echo' 
	  <article class="message">
		<div class="message-header">
		  <p>'.$row['name'].'</p>
		</div>
		<div class="message-body">
		<ul>
		<li>ID: '. $row['id'].'</li>
		<li>Name: '. $row['name'].'</li>
		<li>URL: '. $row['url'].'</li>
		<li>Failed attempts: '. $row['failed'].'</li>
		<li>Successes: '. $row['success'].'</li>
		<li>Last Crawl: '. $row['lastcrawl'].'</li>
		</ul>
		</div>
	  </article>';
	
  }
} else {
  echo "0 results";
}


	

// close down any connections to the database.
mysqli_close($conn);


pubfooter(); // Load the footer



?>