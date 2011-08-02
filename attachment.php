<?php get_header() ?>
<div id="container">
    <div id="content">
        <?php the_post(); ?>
        <?php gpro_page_title(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
            <?php gpro_postheader(); ?>
            <div class="entry-content">
                <div class="entry-attachment"><?php the_attachment_link($post->post_ID, true); ?></div>
                <?php the_content(more_text()); ?>
                <?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'gpro') . '&after=</div>') ?>
            </div>
            <?php gpro_postfooter(); ?>
        </div><!-- .post -->
        <?php comments_template(); ?>
    </div><!-- #content -->
</div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>