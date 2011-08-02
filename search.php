<?php get_header() ?>
    <div id="container">
	<div id="content">
            <?php if (have_posts()) :
		gpro_page_title();
		gpro_navigation_above();
                gpro_above_searchloop();
                gpro_searchloop();
                gpro_below_searchloop();
                gpro_navigation_below();
            else : ?>
		<div id="post-0" class="post noresults">
		    <h1 class="entry-title"><?php _e('Nothing Found', 'gpro') ?></h1>
		    <div class="entry-content">
			<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gpro') ?></p>
		    </div>
		    <form id="noresults-searchform" method="get" action="<?php bloginfo('home') ?>">
                        <div>
			    <input id="noresults-s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="40" />
			    <input id="noresults-searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'gpro') ?>" />
			</div>
		    </form>
                    <div class="clear"></div>
		</div><!-- .post -->
            <?php endif; ?>
	</div><!-- #content -->
    </div><!-- #container -->
<?php gpro_sidebar() ?>
<?php get_footer() ?>