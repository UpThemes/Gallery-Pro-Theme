<?php get_header() ?>
<div id="container">
    <div id="content">
        <?php the_post() ?>
        <?php gpro_page_title() ?>		
        <?php gpro_navigation_above();?>
            <div id="author-info" class="vcard">
                <h2 class="entry-title"><?php echo $authordata->first_name; ?> <?php echo $authordata->last_name; ?></h2> 
                <?php gpro_author_info_avatar(); ?>
                <div class="author-bio note">
                    <?php if ( !(''== $authordata->user_description) ) : echo apply_filters('archive_meta', $authordata->user_description); endif; ?>
                </div>  			
                <div id="author-email">
                    <a class="email" title="<?php echo antispambot($authordata->user_email); ?>" href="mailto:<?php echo antispambot($authordata->user_email); ?>"><?php _e('Email ', 'gpro') ?><span class="fn n"><span class="given-name"><?php echo $authordata->first_name; ?></span> <span class="family-name"><?php echo $authordata->last_name; ?></span></span></a>
                    <a class="url"  style="display:none;" href="<?php echo get_option('home') ?>/"><?php bloginfo('name') ?></a>   
                </div>
            </div><!-- #author-info -->
        <?php gpro_author_loop() ?>
	<?php gpro_navigation_below();?>
    </div><!-- #content -->
</div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>