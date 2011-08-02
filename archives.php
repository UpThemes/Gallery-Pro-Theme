<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header(); ?>
<div id="container">
    <div id="content">
        <?php the_post() ?>
		<div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
	    	<?php gpro_postheader(); ?>
		    <div class="entry-content">
				<?php the_content(); ?>
				<?php gpro_archives(); ?>
				<?php edit_post_link(__('Edit', 'gpro'),'<span class="edit-link">','</span>'); ?>
		    </div>
		</div><!-- .post -->
	    <?php comments_template(); ?>
    </div><!-- #content -->
</div><!-- #container -->
<?php gpro_sidebar(); ?>
<?php get_footer(); ?>