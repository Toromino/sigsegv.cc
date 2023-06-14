<?php
use Michelf\MarkdownExtra;

class Post {
    public $title;
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

    function __construct() {
        $dir = array_diff(scandir('posts'), array('.', '..'));
 
        foreach ($dir as $value) {
            array_push($this->list, read_post(basename($value, '.md'), true));
	}

	usort($this->list, function ($a, $b) {
		if ($a->date == $b->date) {
			return 0;
		}
		
		return ($a->date > $b->date) ? -1 : 1;
	});

    }

    function format() {
        foreach($this->list as $post) {
            echo("<li><span><i>");
            echo('<time datetime="' . date('d M, Y', $post->date). '" pubdate="">');
            echo(date('d M, Y', $post->date));
            echo("</time></i></span>");
            echo('<a href="index.php');
            gen_url($page='post');
            echo('&post_title=' . $post->file .'">' . $post->title . "</a>");
            echo("</li>");
        }
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
