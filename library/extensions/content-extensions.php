<?php

// Located in archives.php
// Just after the content
function gpro_archives() {
		do_action('gpro_archives');
} // end gpro_archives


// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just before the content
function gpro_navigation_above() {
		do_action('gpro_navigation_above');
} // end gpro_navigation_above

// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just after the content
function gpro_navigation_below() {
		do_action('gpro_navigation_below');
} // end gpro_navigation_below

// Located in index.php 
// Just before the loop
function gpro_above_indexloop() {
    do_action('gpro_above_indexloop');
} // end gpro_above_indexloop

// Located in archive.php
// The Loop
function gpro_archiveloop() {
		do_action('gpro_archiveloop');
} // end gpro_archiveloop

// Located in author.php
// The Loop
function gpro_authorloop() {
		do_action('gpro_authorloop');
} // end gpro_authorloop

// Located in category.php
// The Loop
function gpro_categoryloop() {
		do_action('gpro_categoryloop');
} // end gpro_categoryloop

// Located in index.php
// The Loop
function gpro_indexloop() {
		do_action('gpro_indexloop');
} // end gpro_indexloop

// Located in search.php
// The Loop
function gpro_searchloop() {
		do_action('gpro_searchloop');
} // end gpro_searchloop

// Located in single.php
// The Post
function gpro_singlepost() {
		do_action('gpro_singlepost');
} //end gpro_singlepost

// Located in tag.php
// The Loop
function gpro_tagloop() {
		do_action('gpro_tagloop');
} // end gpro_tagloop

// Located in index.php 
// Just after the loop
function gpro_below_indexloop() {
    do_action('gpro_below_indexloop');
} // end gpro_below_indexloop


// Located in category.php 
// Just before the loop
function gpro_above_categoryloop() {
    do_action('gpro_above_categoryloop');
} // end gpro_above_categoryloop


// Located in category.php 
// Just after the loop
function gpro_below_categoryloop() {
    do_action('gpro_below_categoryloop');
} // end gpro_below_categoryloop


// Located in search.php 
// Just before the loop
function gpro_above_searchloop() {
    do_action('gpro_above_searchloop');
} // end gpro_above_searchloop


// Located in search.php 
// Just after the loop
function gpro_below_searchloop() {
    do_action('gpro_below_searchloop');
} // end gpro_below_searchloop


// Located in tag.php 
// Just before the loop
function gpro_above_tagloop() {
    do_action('gpro_above_tagloop');
} // end gpro_above_tagloop


// Located in tag.php 
// Just after the loop
function gpro_below_tagloop() {
    do_action('gpro_below_tagloop');
} // end gpro_below_tagloop


// Filter the page title
// located in archive.php, attachement.php, author.php, category.php, search.php, tag.php
function gpro_page_title() {
    $content = '';
    if (is_attachment()) {
        $content .= '<h2 class="page-title"><a href="';
        $content .= get_permalink($post->post_parent);
        $content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
        $content .= get_the_title($post->post_parent);
        $content .= '</a></h2>';
    } elseif (is_author()) {
        $content .= '<h1 class="page-title author">';
        $author = get_the_author();
        $content .= __('Author Archives: ', 'gpro');
        $content .= '<span>';
        $content .= $author;
        $content .= '</span></h1>';
    } elseif (is_category()) {
        $content .= '<h1 class="page-title">';
        $content .= __('Category Archives:', 'gpro');
        $content .= ' <span>';
        $content .= single_cat_title('', FALSE);
        $content .= '</span></h1>' . "\n";
        $content .= '<div class="archive-meta">';
        if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
        $content .= '</div>';
    } elseif (is_search()) {
        $content .= '<h1 class="page-title">';
        $content .= __('Search Results for:', 'gpro');
        $content .= ' <span id="search-terms">';
        $content .= wp_specialchars(stripslashes($_GET['s']), true);
        $content .= '</span></h1>';
    } elseif (is_tag()) {
        $content .= '<h1 class="page-title">';
        $content .= __('Tag Archives:', 'gpro');
        $content .= ' <span>';
        $content .= __(gpro_tag_query());
        $content .= '</span></h1>';
    }	elseif (is_day()) {
        $content .= '<h1 class="page-title">';
        $content .= sprintf(__('Daily Archives: <span>%s</span>', 'gpro'), get_the_time(get_option('date_format')));
        $content .= '</h1>';
    } elseif (is_month()) {
        $content .= '<h1 class="page-title">';
        $content .= sprintf(__('Monthly Archives: <span>%s</span>', 'gpro'), get_the_time('F Y'));
        $content .= '</h1>';
    } elseif (is_year()) {
        $content .= '<h1 class="page-title">';
        $content .= sprintf(__('Yearly Archives: <span>%s</span>', 'gpro'), get_the_time('Y'));
        $content .= '</h1>';
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
        $content .= '<h1 class="page-title">';
        $content .= __('Blog Archives', 'gpro');
        $content .= '</h1>';
    }
    $content .= "\n";
    echo apply_filters('gpro_page_title', $content);
}

// Action to create the above navigation
function gpro_nav_above() {
    if (is_single()) { ?>
        <div id="nav-above" class="navigation">
                <div class="nav-previous"><?php gpro_previous_post_link() ?></div>
                <div class="nav-next"><?php gpro_next_post_link() ?></div>
        </div>
    <?php } else { ?>
	<div id="nav-above" class="navigation">
            <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
            <?php } else { ?>  
                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'gpro')) ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'gpro')) ?></div>
	    <?php } ?>
	</div>	
    <?php }
}
add_action('gpro_navigation_above', 'gpro_nav_above', 2);

// The Archive Loop
function gpro_archive_loop() {
    while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID() ?>" class="<?php post_class(); ?>">
    	    <?php gpro_postheader(); ?>
	    <div class="entry-content">
                <?php gpro_content(); ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	</div><!-- .post -->
    <?php endwhile;
}
add_action('gpro_archiveloop', 'gpro_archive_loop');

// The Author Loop
function gpro_author_loop() {
    rewind_posts();
    while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
    	    <?php gpro_postheader(); ?>
	    <div class="entry-content ">
                <?php gpro_content(); ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	</div><!-- .post -->
    <?php endwhile;
}
add_action('gpro_authorloop', 'gpro_author_loop');

// The Category Loop
function gpro_category_loop() {
    while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
    	    <?php gpro_postheader(); ?>
	    <div class="entry-content">
                <?php gpro_content(); ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	</div><!-- .post -->
    <?php endwhile;
}
add_action('gpro_categoryloop', 'gpro_category_loop');

// The Index Loop
function gpro_index_loop() {
    /* Count the number of posts so we can insert a widgetized area */ $count = 1;
    while ( have_posts() ) : the_post() ?>
        <div id="post-<?php the_ID() ?>" class="<?php post_class(); ?>">
            <?php gpro_postheader(); ?>
            <div class="entry-content">
                <?php gpro_content(); ?>
		<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'gpro') . '&after=</div>') ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	</div><!-- .post -->
	<?php comments_template();

        if ($count==$thm_insert_position) {
            get_sidebar('index-insert');
        }
        $count = $count + 1;
    endwhile;
}
add_action('gpro_indexloop', 'gpro_index_loop');

// The Single Post
function gpro_single_post() { ?>
    <div id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
        <?php gpro_postheader(); ?>
        <div class="entry-content">
            <?php gpro_content(); ?>
	    <?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'gpro') . '&after=</div>') ?>
	</div>
	<?php gpro_postfooter(); ?>
    </div><!-- .post -->
<?php }
add_action('gpro_singlepost', 'gpro_single_post');

// The Search Loop
function gpro_search_loop() {
    while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID() ?>" class="<?php post_class(); ?>">
    	    <?php if(has_post_thumbnail()): ?>
    		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    	    <?php endif; ?>
    	    <?php gpro_postheader(); ?>
	    <div class="entry-content">
		<?php gpro_content(); ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	    <div class="clear"></div>
	</div><!-- .post -->
    <?php endwhile;
}
add_action('gpro_searchloop', 'gpro_search_loop');

// The Tag Loop
function gpro_tag_loop() {
    while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
    	    <?php gpro_postheader(); ?>
	    <div class="entry-content">
                <?php gpro_content() ?>
	    </div>
	    <?php gpro_postfooter(); ?>
	</div><!-- .post -->
    <?php endwhile;
}
add_action('gpro_tagloop', 'gpro_tag_loop');

// Filter to create the time url title displayed in Post Header
function gpro_time_title() {
  $time_title = 'Y-m-d\TH:i:sO';
	// Filters should return correct 
	$time_title = apply_filters('gpro_time_title', $time_title);
	return $time_title;
} // end gpro_time_title


// Filter to create the time displayed in Post Header
function gpro_time_display() {
  $time_display = get_option('date_format');
	// Filters should return correct 
	$time_display = apply_filters('gpro_time_display', $time_display);
	return $time_display;
} // end gpro_time_display


// Information in Post Header
function gpro_postheader() {
    global $id, $post, $authordata;
    // Create $posteditlink
    $posteditlink = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
    $posteditlink .= '" title="' . __('Edit post', 'gpro') .'">';
    $posteditlink .= __('Edit', 'gpro') . '</a>';
    $posteditlink = apply_filters('gpro_postheader_posteditlink',$posteditlink); 

    if (is_single() || is_page()) {
        $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
    } elseif (is_404()) {    
        $posttitle = '<h1 class="entry-title">' . __('Not Found', 'gpro') . "</h1>\n";
    } else {
        $posttitle = '<h2 class="entry-title"><a href="';
        $posttitle .= get_permalink();
        $posttitle .= '" title="';
        $posttitle .= __('Permalink to ', 'gpro') . the_title_attribute('echo=0');
        $posttitle .= '" rel="bookmark">';
        $posttitle .= get_the_title();   
        $posttitle .= "</a></h2>\n";
    }
    $posttitle = apply_filters('gpro_postheader_posttitle',$posttitle); 
    $postmeta = '<div class="entry-meta">';
    $postmeta .= '<span class="meta-prep meta-prep-author">' . __('By ', 'gpro') . '</span>';
    $postmeta .= '<span class="author vcard">'. '<a class="url fn n" href="';
    $postmeta .= get_author_posts_url($authordata->ID);
    $postmeta .= '" title="' . __('View all posts by ', 'gpro') . get_the_author() . '">';
    $postmeta .= get_the_author();
    $postmeta .= '</a></span><span class="meta-sep meta-sep-entry-date"> | </span>';
    $postmeta .= '<span class="meta-prep meta-prep-entry-date">' . __('Published: ', 'gpro') . '</span>';
    $postmeta .= '<span class="entry-date"><abbr class="published" title="';
    $postmeta .= get_the_time(gpro_time_title()) . '">';
    $postmeta .= get_the_time(gpro_time_display());
    $postmeta .= '</abbr></span>';
    // Display edit link
    if (current_user_can('edit_posts')) {
        $postmeta .= ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . $posteditlink . '</span>';
    }               
    $postmeta .= "</div><!-- .entry-meta -->\n";
    $postmeta = apply_filters('gpro_postheader_postmeta',$postmeta); 

    if ($post->post_type == 'page' || is_404()) {
        $postheader = $posttitle;        
    } else {
        $postheader = $posttitle . $postmeta;    
    }
    
    echo apply_filters( 'gpro_postheader', $postheader ); // Filter to override default post header
} // end gpro_postheader

//creates the content
function gpro_content() {
    
    if (is_home() || is_front_page()) { 
        $content = 'full';
    } elseif (is_single()) {
        $content = 'full';
    } elseif (is_tag()) {
        $content = 'excerpt';
    } elseif (is_search()) {
        $content = 'excerpt';	
    } elseif (is_category()) {
        $content = 'excerpt';
    } elseif (is_author()) {
        $content = 'excerpt';
    } elseif (is_archive()) {
        $content = 'excerpt';
    }
    
    $content = apply_filters('gpro_content', $content);

    if ( strtolower($content) == 'full' ) {
        $post = get_the_content(more_text());
        $post = apply_filters('the_content', $post);
        $post = str_replace(']]>', ']]&gt;', $post);
    } elseif ( strtolower($content) == 'excerpt') {
        $post = get_the_excerpt();
    } elseif ( strtolower($content) == 'none') {
    } else {
        $post = get_the_content(more_text());
        $post = apply_filters('the_content', $post);
        $post = str_replace(']]>', ']]&gt;', $post);
    }
    echo apply_filters('gpro_post', $post);
} // end gpro_content

// Functions that hook into gpro_archives()

// Open .archives-page
function gpro_archivesopen() { ?>
    <ul id="archives-page" class="xoxo">
<?php }
add_action('gpro_archives', 'gpro_archivesopen', 1);

// Display the Category Archives
function gpro_category_archives() { ?>
    <li id="category-archives" class="content-column">
        <h2><?php _e('Archives by Category', 'gpro') ?></h2>
        <ul>
            <?php wp_list_categories('optioncount=1&feed=RSS&title_li=&show_count=1') ?> 
        </ul>
    </li>
<?php }
add_action('gpro_archives', 'gpro_category_archives', 3);

// Display the Monthly Archives
function gpro_monthly_archives() { ?>
    <li id="monthly-archives" class="content-column">
        <h2><?php _e('Archives by Month', 'gpro') ?></h2>
        <ul>
            <?php wp_get_archives('type=monthly&show_post_count=1') ?>
        </ul>
    </li>
<?php }
add_action('gpro_archives', 'gpro_monthly_archives', 5);

// Close .archives-page
function gpro_archivesclose() { ?>
    </ul>
<?php }
add_action('gpro_archives', 'gpro_archivesclose', 9);
		
// End of functions that hook into gpro_archives()


// Action hook called in 404.php
function gpro_404() {
    do_action('gpro_404');
} // end gpro_404


// 404 content injected into gpro_404
function gpro_404_content() { ?>
    <?php gpro_postheader(); ?>
    <div class="entry-content">
        <p><?php _e('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'gpro') ?></p>
    </div>
    <form id="error404-searchform" method="get" action="<?php bloginfo('home') ?>">
        <div>
            <input id="error404-s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="40" />
            <input id="error404-searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'gpro') ?>" />
        </div>
    </form>
<?php } // end gpro_404_content
add_action('gpro_404','gpro_404_content');

// creates the $more_link_text for the_content
function more_text() {
    $content = ''.__('Read More <span class="meta-nav">&raquo;</span>', 'gpro').'';
    return apply_filters('more_text', $content);
} // end more_text


// creates the $more_link_text for the_content
function list_bookmarks_args() {
    $content = 'title_before=<h2>&title_after=</h2>';
    return apply_filters('list_bookmarks_args', $content);
} // end more_text


// Information in Post Footer
function gpro_postfooter() {
    global $id, $post;
    // Create $posteditlink    
    $posteditlink .= '<span class="edit"><a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
    $posteditlink .= '" title="' . __('Edit post', 'gpro') .'">';
    $posteditlink .= __('Edit', 'gpro') . '</a></span>';
    $posteditlink = apply_filters('gpro_postfooter_posteditlink',$posteditlink); 
    
    // Display the post categories  
    $postcategory .= '<span class="cat-links">';
    if (is_single()) {
        $postcategory .= __('This entry was posted in ', 'gpro') . get_the_category_list(', ');
        $postcategory .= '</span>';
    } elseif ( is_category() && $cats_meow = gpro_cats_meow(', ') ) { /* Returns categories other than the one queried */
        $postcategory .= __('Also posted in ', 'gpro') . $cats_meow;
        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
    } else {
        $postcategory .= __('Posted in ', 'gpro') . get_the_category_list(', ');
        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
    }
    $postcategory = apply_filters('gpro_postfooter_postcategory',$postcategory); 
    
    // Display the tags
    if (is_single()) {
        $tagtext = __(' and tagged', 'gpro');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span>');
    } elseif ( is_tag() && $tag_ur_it = gpro_tag_ur_it(', ') ) { /* Returns tags other than the one queried */
        $posttags = '<span class="tag-links">' . __(' Also tagged ', 'gpro') . $tag_ur_it . '</span> <span class="meta-sep meta-sep-comments-link">|</span>';
    } else {
        $tagtext = __('Tagged', 'gpro');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span> <span class="meta-sep meta-sep-comments-link">|</span>');
    }
    $posttags = apply_filters('gpro_postfooter_posttags',$posttags); 
    
    // Display comments link and edit link
    if (comments_open()) {
        $postcommentnumber = get_comments_number();
        if ($postcommentnumber > '1') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'gpro') . the_title_attribute('echo=0') . '">';
            $postcomments .= get_comments_number() . __(' Comments', 'gpro') . '</a></span>';
        } elseif ($postcommentnumber == '1') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'gpro') . the_title_attribute('echo=0') . '">';
            $postcomments .= get_comments_number() . __(' Comment', 'gpro') . '</a></span>';
        } elseif ($postcommentnumber == '0') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'gpro') . the_title_attribute('echo=0') . '">';
            $postcomments .= __('Leave a comment', 'gpro') . '</a></span>';
        }
    } else {
        $postcomments = ' <span class="comments-link comments-closed-link">' . __('Comments closed', 'gpro') .'</span>';
    }
    // Display edit link
    if (current_user_can('edit_posts')) {
        $postcomments .= ' <span class="meta-sep meta-sep-edit">|</span> ' . $posteditlink;
    }               
    $postcomments = apply_filters('gpro_postfooter_postcomments',$postcomments); 
    
    // Display permalink, comments link, and RSS on single posts
    $postconnect .= __('. Bookmark the ', 'gpro') . '<a href="' . get_permalink() . '" title="' . __('Permalink to ', 'gpro') . the_title_attribute('echo=0') . '">';
    $postconnect .= __('permalink', 'gpro') . '</a>.';
    if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Comments are open */
        $postconnect .= ' <a class="comment-link" href="#respond" title ="' . __('Post a comment', 'gpro') . '">' . __('Post a comment', 'gpro') . '</a>';
        $postconnect .= __(' or leave a trackback: ', 'gpro');
        $postconnect .= '<a class="trackback-link" href="' . trackback_url(FALSE) . '" title ="' . __('Trackback URL for your post', 'gpro') . '" rel="trackback">' . __('Trackback URL', 'gpro') . '</a>.';
    } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Only trackbacks are open */
        $postconnect .= __(' Comments are closed, but you can leave a trackback: ', 'gpro');
        $postconnect .= '<a class="trackback-link" href="' . trackback_url(FALSE) . '" title ="' . __('Trackback URL for your post', 'gpro') . '" rel="trackback">' . __('Trackback URL', 'gpro') . '</a>.';
    } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Only comments open */
        $postconnect .= __(' Trackbacks are closed, but you can ', 'gpro');
        $postconnect .= '<a class="comment-link" href="#respond" title ="' . __('Post a comment', 'gpro') . '">' . __('post a comment', 'gpro') . '</a>.';
    } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Comments and trackbacks closed */
        $postconnect .= __(' Both comments and trackbacks are currently closed.', 'gpro');
    }
    // Display edit link on single posts
    if (current_user_can('edit_posts')) {
        $postconnect .= ' ' . $posteditlink;
    }
    $postconnect = apply_filters('gpro_postfooter_postconnect',$postconnect); 
    
    
    // Add it all up
    if ($post->post_type == 'page' && current_user_can('edit_posts')) { /* For logged-in "page" search results */
        $postfooter = '<div class="entry-utility">' . '<span class="edit">' . $posteditlink . '</span>';
        $postfooter .= "</div><!-- .entry-utility -->\n";    
    } elseif ($post->post_type == 'page') { /* For logged-out "page" search results */
        $postfooter = '';
    } else {
        if (is_single()) {
            $postfooter = '<div class="entry-utility">' . $postcategory . $posttags . $postconnect;
        } else {
            $postfooter = '<div class="entry-utility">' . $postcategory . $posttags . $postcomments;
        }
        $postfooter .= "</div><!-- .entry-utility -->\n";    
    }
    
    // Put it on the screen
    echo apply_filters( 'gpro_postfooter', $postfooter ); // Filter to override default post footer
} // end gpro_postfooter


// Action to create the below navigation
function gpro_nav_below() {
    if (is_single()) { ?>
        <div id="nav-below" class="navigation">
            <div class="nav-previous"><?php gpro_previous_post_link() ?></div>
            <div class="nav-next"><?php gpro_next_post_link() ?></div>
        </div>
    <?php } else { ?>
        <div id="nav-below" class="navigation">
            <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
            <?php } else { ?>  
                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'gpro')) ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'gpro')) ?></div>
	    <?php } ?>
	</div>	
    <?php }
}
add_action('gpro_navigation_below', 'gpro_nav_below', 2);


// creates the previous_post_link
function gpro_previous_post_link() {
	$args = array (
            'format' => '%link',
	    'link' => '<span class="meta-nav">&laquo;</span> %title',
	    'in_same_cat' => FALSE,
	    'excluded_categories' => '');
	$args = apply_filters('gpro_previous_post_link_args', $args );
	previous_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end gpro_previous_post_link

// creates the next_post_link
function gpro_next_post_link() {
    $args = array (
        'format' => '%link',
        'link' => '%title <span class="meta-nav">&raquo;</span>',
        'in_same_cat' => FALSE,
        'excluded_categories' => '');
    $args = apply_filters('gpro_next_post_link_args', $args );
    next_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end gpro_next_post_link


// Produces an avatar image with the hCard-compliant photo class for author info
function gpro_author_info_avatar() {
    global $wp_query; $curauth = $wp_query->get_queried_object();
    $email = $curauth->user_email;
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar("$email") );
    echo $avatar;
} // end gpro_author_info_avatar


// For category lists on category archives: Returns other categories except the current one (redundant)
function gpro_cats_meow($glue) {
    $current_cat = single_cat_title( '', false );
    $separator = "\n";
    $cats = explode( $separator, get_the_category_list($separator) );
    foreach ( $cats as $i => $str ) {
        if ( strstr( $str, ">$current_cat<" ) ) {
            unset($cats[$i]);
            break;
        }
    }
    if ( empty($cats) ) return false;
    return trim(join( $glue, $cats ));
} // end gpro_cats_meow


// For tag lists on tag archives: Returns other tags except the current one (redundant)
function gpro_tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
            if ( strstr( $str, ">$current_tag<" ) ) {
                unset($tags[$i]);
                break;
            }
	}
	if ( empty($tags) ) return false;
	return trim(join( $glue, $tags ));
} // end gpro_tag_ur_it

function is_video_post(){
    if(function_exists('p75HasVideo')) { 
        if(p75HasVideo($post->ID)) 
            return "video"; 
        else 
            return false;
    }
}

function metadata_designed_by(){
    if( get_post_meta(get_the_ID(), 'designed-by', true) ){
        echo '<li class="designer">Designed by: ' . get_post_meta(get_the_ID(), 'designed-by', true) . '</li>';
    }
}
add_action('single_postmeta','metadata_designed_by');

function metadata_web_url(){
    if( get_post_meta(get_the_ID(), 'web-url', true) ){
    	echo '<li class="site-link"><a rel="source" href="' . get_post_meta(get_the_ID(), 'web-url', true) . '">' . get_post_meta(get_the_ID(), 'web-url', true) . '</a></li>';
    }
}
add_action('single_postmeta','metadata_web_url');

function metadata_delicious(){
    if( get_post_meta(get_the_ID(), 'web-url', true) ){
	echo '<li class="delicious"><a href="http://del.icio.us/post?url=' . get_post_meta(get_the_ID(), 'web-url', true) . '&amp;' . get_the_title() . '">Bookmark This (' . get_post_meta(get_the_ID(), 'web-url', true) . ')</a></li>';
    }
}
add_action('single_postmeta','metadata_delicious');

function build_tweetlink( $title_length = false ){
    global $post, $up_options;
    $title_attribute = str_replace(' ', '+', the_title_attribute('echo=0'));
    if( $title_length ) $title_attribute = substr( $title_attribute, $title_length );
    $shortlink = wp_get_shortlink();
    $tweet = $title_attribute . '+' . $shortlink;
    if( isset($up_options->twitter) ) $tweet .= "+(via+@" . $up_options->twitter . ")";
    return $tweet;
}

function metadata_twitter(){
    global $up_options;
    $tweet = build_tweetlink();
    $length = strlen($tweet);
    if( $length > 140 ):
        $overage = $length-140;
        $tweet = build_tweetlink($overage);
    endif;
    if( $up_options->twitter ):
        echo '<li class="twitter"><a href="http://www.twitter.com/home?status=' . $tweet . '" title="' . sprintf( "Share %s on Twitter", the_title_attribute('echo=0') ) . '">Tweet This</a></li>';
    endif;
}
add_action('single_postmeta','metadata_twitter');

function custom_metadata(){
    global $up_options;	
    if(isset($up_options->custom_metadata)){
        foreach($up_options->custom_metadata as $metadata){
            $metaslug = "custom-".strtolower(preg_replace('/ /', '_', $metadata));
            if( get_post_meta(get_the_ID(), $metaslug, true) )
                echo "<li>" . $metadata . ": " . get_post_meta(get_the_ID(), $metaslug, true) . "</li>";
        }
    }

}
add_action('single_postmeta','custom_metadata');
?>