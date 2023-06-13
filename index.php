<?php 
// include Composer autoload
require __DIR__ . '/vendor/autoload.php';

if (!isset($_GET['page'])) {
    $_GET['page'] = 'about';
}

if (!isset($_GET['style'])) {
    $_GET['style'] = 'light';
}

if(!isset($_GET['subpage'])) {
    $_GET['subpage'] = '';
}

$GLOBALS['navmenu'] = array (
    array("about", "About"),
    array("inventory", "Inventory"),
    array("posts", "Posts"),
    array("projects", "Projects")
);

// render HTML skeleton
require_once('elements/skeleton.php');
?>
