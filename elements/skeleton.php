<?php 
use Michelf\MarkdownExtra;

/*
class Link {
    private $page;
    private $subpage;
    private $style;

    function generate() {
        echo("?page=" . (empty($this->page) ? $_GET['page'] : $this->page));
        echo(!empty($this->subpage) ? "&subpage=".$this->subpage : '');
        if(!empty($_GET['post_title']) && $_GET['page'] == 'post') {
            echo("&post_title=".$_GET['post_title']);
        }
        echo("&style=" . (empty($this->style) ? $_GET['style'] : $this->style));
    }
}*/

// Maybe use an array
function gen_url($page="", $subpage="", $style="") {
    print("?page=" . (empty($page) ? $_GET['page'] : $page));
    print(!empty($subpage) ? "&subpage=".$subpage : '');
    if (!empty($_GET['post_title']) && $_GET['page'] == 'post') {
        echo("&post_title=".$_GET['post_title']);
    }
    print("&style=" . (empty($style) ? $_GET['style'] : $style));
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
    <link rel="stylesheet" type="text/css" href="static/css/header.css">
    <link rel="stylesheet" type="text/css" href="static/css/markup.css">
    <link rel="stylesheet" type="text/css" href="static/css/skeleton.css">
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