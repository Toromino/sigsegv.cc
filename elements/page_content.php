<div id="content">
<?php
if (isset($_GET['page'])) {
    if (file_exists('pages/' . $_GET['page'] . '.md')) {
        print(parse_md('pages', $_GET['page']));
    } elseif (file_exists('pages/' . $_GET['page'] . '.php'))  {
        require_once('pages/' . $_GET['page'] . '.php');
    } else {
        print(parse_md('pages', 'error'));
    }
} else {
    require_once('pages/about.php');
}
?>
</div>
