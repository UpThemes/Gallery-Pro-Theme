<?php
/*
Template Name Posts: iPhone
*/
?>
<?php get_header() ?>
    <div id="container">
	<div id="content">
            <?php the_post();
	    	gpro_navigation_above();
            get_sidebar('single-top');
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( is_video_post() ); ?>>
                <div class="entry-content">
                    <?php if( function_exists('the_ratings') ) { echo the_ratings(); } ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'gpro').''); ?>

                    <ul class="meta">
                        <?php do_action('single_postmeta'); ?>
                    </ul>

		            <?php gpro_nav_below();?>

                </div>
            </div><!-- .post -->
            <div class="artwork-container">
                <div class="entry-artwork">
				    <?php do_action('single_postmedia'); ?>
				</div>
		    </div>
            <?php get_sidebar('single-insert') ?>
            <?php gpro_navigation_below();?>
            <?php gpro_comments_template(); ?>
            <?php get_sidebar('single-bottom') ?>
	</div><!-- #content -->
    </div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>