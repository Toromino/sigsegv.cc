<?php 
use Michelf\MarkdownExtra;

// Maybe use an array
function gen_url($page = "", $subpage = "", $style = "") {
    $url = "?page=" . (empty($page) ? $_GET['page'] : $page);
    $url .= (!empty($subpage) ? "&subpage=" . $subpage : '');
    if (!empty($_GET['post_title']) && $_GET['page'] == 'post') {
        $url .= "&post_title=" . $_GET['post_title'];
    }
    $url .= "&style=" . (empty($style) ? $_GET['style'] : $style);

    echo $url;
}

function parse_md($type, $title) {
    return MarkdownExtra::defaultTransform(file_get_contents($type . '/' . $title . '.md'));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SIGSEGV</title>
    <meta charset="utf-8">
    <?php if ($_GET['style'] != 'none') { ?>
    <link rel="stylesheet" type="text/css" href="static/css/markup.css">
    <link rel="stylesheet" type="text/css" href="static/css/skeleton.css?v=1.1">
    <?php } ?>
</head>
<body>
<?php
require_once('elements/header.php');
require_once('elements/page_content.php');
require_once('elements/footer.php');
?>
</body>
</html>
