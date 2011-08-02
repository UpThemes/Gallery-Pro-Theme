<?php
/*
Template Name Posts: Blog Post
*/
?>

<?php get_header() ?>
<div id="container">
    <div id="content">
        <?php get_sidebar('single-top') ?>
        <?php the_post() ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
            <?php gpro_postheader(); ?>
            <div class="entry-content">
                <?php the_content() ?>
                <?php edit_post_link(__('Edit', 'gpro'),'<span class="edit-link">','</span>') ?>
            </div>
        </div><!-- .post -->
        <?php get_sidebar('single-insert') ?>
        <?php gpro_navigation_below();?>
        <?php gpro_comments_template(); ?>  
        <?php get_sidebar('single-bottom') ?>
    </div><!-- #content -->
</div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>