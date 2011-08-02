<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php get_header() ?>
    <div id="container">
	<div id="content">
	    <div id="post-0" <?php post_class(); ?>>
		<?php gpro_404() ?>
	    </div><!-- .post -->
	</div><!-- #content -->
    </div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>