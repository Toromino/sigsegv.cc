<div class="pagination">
  <ul>
   <li><a href="<?php gen_url("", "introduction");?>">Introduction</a></li>
   <li><a href="<?php gen_url("", "interests");?>">Interests</a></li>
   <li><a href="<?php gen_url("", "friends");?>">Friends</a></li>
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
        default:
            print(parse_md('pages/about', 'introduction'));
            break;
    }
?>
