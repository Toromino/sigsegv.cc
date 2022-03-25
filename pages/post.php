<?php
require_once('post.inc.php');

if (isset($_GET['post_title'])) {
    if (file_exists('posts/' . $_GET['post_title'] . '.md')) {
        $post = read_post($_GET['post_title']);
        $post->format();
    } elseif (file_exists('posts/' . $_GET['post_title'] . '.php'))  {
        require_once('posts/' . $_GET['post_title'] . '.php');
    } else {
        print(parse_md('pages', 'error'));
    }
} else {
    print(parse_md('pages', 'error'));
}
?>
