<?php
use FeedIo\FeedIo;
use FeedIo\Feed;
use Michelf\MarkdownExtra;

class Post {
    public $title;
    public $visibility;
    public $file;
    public $date;
    public $tags;
    public $data;

    function format() {
        echo("<h1>" . $this->title . "</h1>");
        echo("<p><i>" . date('d M, Y', $this->date) . "</p></i>");
        echo("<content>" . $this->data . "</content>");
    }
}

class PostCollection {
    private $list = [];

    function __construct($limit = 100) {
	$files = glob('posts/*.md');
	
	foreach ($files as $file) {
		array_push($this->list, read_post(basename($file, '.md'), true));
	}

	usort($this->list, function ($a, $b) {
		if ($a->date == $b->date) {
			return 0;
		}
		
		return ($a->date > $b->date) ? -1 : 1;
	});

	$this->list = array_slice($this->list, 0, $limit);

    }

    function format() {
	    foreach($this->list as $post) {
		    if ($post->visibility == "public") {

	    echo("<li><span><i>");
            $formattedDate = date('d M, Y', $post->date);
            echo('<time datetime="' . $formattedDate . '" pubdate="">');
            echo($formattedDate);
            echo("</time></i></span>");	
	    echo('<a href="index.php');
            gen_url($page='post');
            echo('&post_title=' . $post->file .'">' . $post->title . "</a>");
	    echo("</li>");
		    }
        }
    }

    function feed() {
	    $feed = new Feed();
	    $client = new \FeedIo\Adapter\Http\Client(new Symfony\Component\HttpClient\HttplugClient());
	$feedIo = new FeedIo($client);
	$feed->setLink('https://sigsegv.cc');
	$feed->setTitle('SIGSEGV');
	$feed->setDescription('Toromino\'s blog!');

	foreach($this->list as $post) {
	    $item = $feed->newItem();
	    $item->setTitle($post->title);
	    $item->setLink('index.php?page=post&post_title=' . $post->file);
	    $item->setContent($post->data);
	    $item->setLastModified(new DateTime('@' . $post->date));
	    $feed->add($item);
	}

	return $feedIo->format($feed, 'atom');
    }
}

function read_post($title, $only_header=false) {
    $post = new Post();
    $file = fopen('posts/' . $title . '.md', 'r');
    $head = json_decode(fgets($file));

    $post->title = $head->{'title'};
    $post->file = $title;
    $post->date = strtotime($head->{'date'});
    $post->tags = $head->{'tags'};
    $post->visibility = $head->{'visibility'};

    if (!$only_header) {
        while(($str = fgets($file)) !== false) {
            $post->data .= $str;
        }
        $post->data = MarkdownExtra::defaultTransform($post->data);
    }

    fclose($file);
    return $post;
}

?>
