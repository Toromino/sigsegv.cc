<?php require_once('post.inc.php'); ?>

<h2>Posts</h2>
<div class="pill-menu">
<ul>
    <li><a href="#">All</a></li>
    <li><a href="#">Technology</a></li>
</ul>
</div>

<ul class="blog-posts">
<?php
  $list = new PostCollection();
  $list->format();
?>
</ul>
