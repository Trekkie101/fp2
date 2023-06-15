<?php

function pubheader(){

echo'

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Front Page</title>
	<link rel="stylesheet" href="ext/bulma.css">
	<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  </head>
  <body>

';	
	
}


function pubfooter(){
	
echo'
	</body>
	</html>
	
';
	
}

function colourarray(){
	
	$colourload = array("is-dark", "is-primary", "is-link", "is-info", "is-success", "is-warning", "is-danger");
	$rndcol = array_rand($colourload,1);
	echo $colourload[$rndcol];
}

?>