<?php

function pubheader(){

echo'

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedit</title>
	<link rel="stylesheet" href="ext/bulma.css">
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
  
	  <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
		<span aria-hidden="true"></span>
		<span aria-hidden="true"></span>
		<span aria-hidden="true"></span>
	  </a>
	</div>
  
	<div id="navbarBasicExample" class="navbar-menu">
	  <div class="navbar-start">
		<a class="navbar-item" href="index.php">
		  Firehose
		</a>
  
		<div class="navbar-item has-dropdown is-hoverable">
		  <a class="navbar-link">
			Popular
		  </a>
  
		  <div class="navbar-dropdown">
			<a class="navbar-item" href="index.php?sort=1">
			  Today
			</a>
			<a class="navbar-item" href="index.php?sort=2">
			  Yesterday
			</a>
			<a class="navbar-item" href="index.php?sort=3">
			  Week
			</a>
			<a class="navbar-item" href="index.php?sort=4">
			  Month
			</a>
			<a class="navbar-item" href="index.php?sort=5">
			  Year
			</a>
			<a class="navbar-item" href="index.php?sort=6">
			  All-Time
			</a>
		  </div>
		</div>
	  </div>
  
	  <div class="navbar-end">
		<div class="navbar-item">
		  <div class="buttons">
			<a class="button is-primary">
			  <strong>Add Feed</strong>
			</a>
		  </div>
		</div>
	  </div>
	</div>
  </nav>
<br />

';	
	
}


function pubfooter(){
	
echo'
	</body>
	</html>
	
';
	
}


?>