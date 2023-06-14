<?php

$starttime = microtime(true); // Top of page


require_once 'ext/Feed.php';

$rss = Feed::loadRss('http://www.simplemachines.org/community/index.php?action=.xml;sa=news;limit=5;type=rss2');
	
echo 'Site: ', $rss->title;

echo '<br ><br />';

$c = 0;

foreach ($rss->item as $item) {

	$c++;
		
	echo 'Title: ', $item->title;
	echo ' - ', $item->url;
	echo ' - ';
	echo sha1($item->title);
	echo '<br />';
}

print $c;


	echo '<br /><br /><br /><br />';

$endtime = microtime(true); // Bottom of page

printf("Load time: %f seconds", $endtime - $starttime );



?>