<?php get_header(); ?>
    <div id="container">
	<div id="content">
            <?php get_sidebar('page-top'); ?>
            <?php the_post() ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php gpro_postheader(); ?>
		<div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'gpro'), "</div>\n", 'number'); ?>
                    <?php edit_post_link(__('Edit', 'gpro'),'<span class="edit-link">','</span>'); ?>
		</div>
	    </div><!-- .post -->
            <?php gpro_comments_template(); ?>
            <?php get_sidebar('page-bottom'); ?>
	</div><!-- #content -->
    </div><!-- #container -->
<?php gpro_sidebar(); ?>
<?php get_footer(); ?>