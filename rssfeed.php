<?
function admin_announcements()
{
//RSS feed for System messages
$feedurl = "http://idaadmin.blogspot.com/feed=rss2";

$rss = new DOMDocument();
$rss->load($feedurl);

$feed = array();
foreach ($rss->getElementsByTagName('item') as $node) {
	$item = array ( 
		'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
		'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		);
	array_push($feed, $item);
}

$limit = 5;
for($x=0;$x<$limit;$x++) {
	$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
	$link = $feed[$x]['link'];
	$content = $feed[$x]['content'];
	$date = date('l F d, Y', strtotime($feed[$x]['date']));
	echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
	echo '<small><em>Posted on '.$date.'</em></small></p>';
	echo $content;
	}
}
function PBMS_announcements()
{
//RSS feed for PBMS
$feedurl = "http://myserver.dyndns-home.com/?cat=5&feed=rss2";

$rss = new DOMDocument();
$rss->load($feedurl);

$feed = array();
foreach ($rss->getElementsByTagName('item') as $node) {
	$item = array ( 
		'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
		'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		);
	array_push($feed, $item);
}

$limit = 5;
for($x=0;$x<$limit;$x++) {
	$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
	$link = $feed[$x]['link'];
	$content = $feed[$x]['content'];
	$date = date('l F d, Y', strtotime($feed[$x]['date']));
	echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
	echo '<small><em>Posted on '.$date.'</em></small></p>';
	echo $content;
	}
}
?>
