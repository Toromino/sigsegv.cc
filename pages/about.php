<?php require_once('post.inc.php'); ?>

<div class="pagination">
  <ul>
   <li><a href="<?php gen_url("", "introduction");?>">Introduction</a></li>
   <li><a href="<?php gen_url("", "interests");?>">Interests</a></li>
   <li><a href="<?php gen_url("", "friends");?>">Friends</a></li>
   <li><a href="<?php gen_url("", "fingerprint");?>">Fingerprint</a></li>
   <li><a href="<?php gen_url("", "links");?>">Links</a></li>
  </ul>
</div>

<?php
    switch ($_GET['subpage']) {
        case "interests":
            print(parse_md('pages/about', 'interests'));
            break;
        case "friends":
            print(parse_md('pages/about', 'friends'));
            break;
        case "links":
            print(parse_md('pages/about', 'links'));
	    break;
	case "fingerprint":
	    print(parse_md('pages/about', 'fingerprint'));
	    break;
        default:
	    print(parse_md('pages/about', 'introduction'));
	    print('<ul class="blog-posts">');
  	    $list = new PostCollection();
  	    $list->format();
	    print('</ul>');
            print(parse_md('pages/about', 'contact'));
            break;
    }
?>
