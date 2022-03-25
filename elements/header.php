<header>
<div id="nav-border">
<nav id="nav" class="nav">
        <?php foreach ($GLOBALS['navmenu'] as &$item): ?>
        <a class="nav-link" href="<?php gen_url($item[0]);?>"><?php echo $item[1]; ?></a>
        <?php endforeach;?>
</nav>
        </div>

<?php if ($_GET['style'] == 'none') { ?>
<h1>Toromino's blog</h1>
<?php } else { ?>
<div id="about-wrapper">
        <img id="about-picture" src="static/img/avatar.png"/>
        <div id="about-name">~toromino</div>
        <div id="about-shadow"></div>
</div>
<?php } ?>
</header>
