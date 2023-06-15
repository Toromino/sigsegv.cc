<?php

require_once('post.inc.php');

function generate_feed() {
	
	if(!file_exists('feed.atom') || time() - filemtime('feed.atom') >= 3600) {
		$posts = new PostCollection(100, PostDataType::Raw);
		file_put_contents('feed.atom', $posts->feed());
	}
}
?>
