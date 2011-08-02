<?php
global $up_options;
get_header() ?>
<div id="container">    
    <div id="content">
        <?php
        while( have_posts() ): the_post();
            // Navigation
            gpro_navigation_above();
            // Top Single Page Widget Area
            get_sidebar('single-top');?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( is_video_post() ); ?>>
                <div class="entry-content">
                    <?php if(function_exists('the_ratings')) echo the_ratings(); ?>
                    <h1><?php the_title(); ?></h1>
                    <?php
                    /* 1. Check for Featured Image */
                    gpro_featured_image();
                    /* 2. Check for Image from Custom Field */
                    gpro_image_from_custom_field();
                    /* 3. Check if images in the content */
                    if($up_options->contentimages == "yes"):
                        /* 3. Add images in content to slider */
                        gpro_images_from_content();
                        /* Strip images from content */
                        echo gpro_strip_images_from_content();
                    else: /* Insert the entire content in the meta area */
                        the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'gpro').''); 
                    endif;?>
                    <ul class="meta">
                        <?php /* 4. Check for Attachment Images */
                        do_action('single_postmeta'); ?>
                    </ul>
                    <?php gpro_nav_below(); ?>
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
        <?php endwhile; ?>
    </div><!-- #content -->
</div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>
