<?php
// Creates the DOCTYPE section
function gpro_create_doctype() {
    $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml"';
    echo apply_filters('gpro_create_doctype', $content);
} // end gpro_create_doctype

// Get the page number adapted from http://efficienttips.com/wordpress-seo-title-description-tag/
function pageGetPageNo() {
    if (get_query_var('paged')) {
        print ' | Page ' . get_query_var('paged');
    }
} // end pageGetPageNo

function set_sidebar_styles(){

    global $up_options;
    
    if((is_page() || is_search()) || ($up_options->showsidebar && (is_search() || is_page() || is_category() || is_archive || is_home() || is_front_page() || is_tag()))):?>
        <style type="text/css">
            #container,#content{ width: <?php echo 940-(int)$up_options->sidebarwidth."px"; ?>; margin: 0; padding: 0; }
            #primary,#secondary{ width: <?php echo (int)$up_options->sidebarwidth."px"; ?>; margin: 0; padding: 0;}
            .page #container, .page #content, .post-temp-blog-php #container, .post-temp-blog-php #content { width: <?php echo 940-20-(int)$up_options->sidebarwidth."px"; ?>; margin: 10px 0 0 0; padding: 0; }            
            <?php if(is_category()){ ?>
                #primary{margin-top: 52px;}
            <?php } ?>
        </style>
    <?php endif;
}
add_action('wp_head','set_sidebar_styles');

// Add fix for ie6 styles
function fix_ie6(){
    global $up_options;
    echo '<!--[if IE 6]><script src="' . get_bloginfo('template_directory') . '/js/DD_belatedPNG.js" type="text/javascript"></script>';
    if($up_options->theme=='dark'){
	echo '<script type="text/javascript">
            DD_belatedPNG.fix("body,#wrapper, ul.meta li,#blog-title a,#access,#access a,.twitter,.delicious,#blog-title a,#page-nav li.rss a,.s-category-iphone .entry-artwork,.new,.cover-up,#comments h3,#comments-list ul.children li,.home a");
	</script>';
    } elseif($up_options->theme =='light') {
	echo '<script type="text/javascript">
            DD_belatedPNG.fix("body,ul.meta li,#blog-title a,.twitter,.delicious,#blog-title a,#page-nav li.rss a,.s-category-iphone .entry-artwork,.new,.cover-up,#comments h3,#comments-list ul.children li");
	</script>';
    }
    echo '<style type="text/css">
            .post-temp-blog-php #container{
                height: auto;
                overflow: hidden;
            }
            .singular .artwork-container{
                overflow: visible;
                margin: -170px 0 0 0;
                padding: 0;
            }
        </style><![endif]-->
    ';
}
add_action('wp_head','fix_ie6');

// Enqueue Scripts
function add_scripts(){
  if(!is_admin()){
    global $wp_query;
    $stylesheet_dir = get_bloginfo('template_directory');
    wp_enqueue_script('global', $stylesheet_dir . '/js/global.js', array('jquery'), false );
    if($up_options->lazyload != "yes"):
        wp_enqueue_script('lazyload', $stylesheet_dir . '/js/jquery.lazyload.pack.js', array('jquery'), false );
    endif;

    if(!is_singular() || !is_page()):
        wp_enqueue_script('slideup', $stylesheet_dir . '/js/slideup.js', array('jquery'), false );
    endif;
    
    if(!is_home() || !is_page()):
	wp_enqueue_script('gallery', $stylesheet_dir . '/js/gallery.js', array('jquery'), false );
	wp_enqueue_script('thickbox', $stylesheet_dir . '/js/thickbox.js', array('jquery'), false );
    endif;
  }
}
add_action('init','add_scripts');

// Enqueue Styles
function add_styles(){
  if(!is_admin()){
    global $up_options;
    $stylesheet_dir = get_bloginfo('template_directory');
    $style = (isset($_COOKIE['style'])) ? $_COOKIE['style'] : '';
    if($style && $style=='dark' || $style=='light'):
        $theme_color = $style;
    elseif(isset($_REQUEST['style'])):
            $theme_color = $_REQUEST['style'];
    elseif($up_options->theme):
        $theme_color = $up_options->theme;
    else:
        $theme_color = 'dark';
    endif;
    $myStyleUrl =  $stylesheet_dir . "/style-" . $theme_color . ".css";
    wp_enqueue_style('gallery', $myStyleUrl, array(), false, 'screen');
    if(is_single()) wp_enqueue_style('thickbox_style',$stylesheet_dir . "/thickbox.css", array(), false, 'screen');
  }
}
add_action('wp_print_styles','add_styles');

function enable_lazyload(){
    global $up_options;
    if($up_options->lazyload!="yes"):?>
    
    <script type="text/javascript">
	$ = jQuery;
	(function($) {
            $(window).load(function(){
                // Lazy Load images below the fold
                $(".not-singular #content img").lazyload({
                    effect : "fadeIn",
                    threshhold: 300
                });
            });
	})(jQuery);
    </script>
<?php endif;
}
add_action('wp_head','enable_lazyload');

function custom_css(){
    global $up_options;
    if($up_options->logo || $up_options->linkcolor || $up_options->hovercolor || $up_options->activecolor):
        $custom_css = '<style type="text/css">';	
        if($up_options->logo) $custom_css .= "#blog-title a{background: url('".get_bloginfo('template_directory')."/timthumb/timthumb.php?w=250&h=50&zc=1&src=".$up_options->logo."') no-repeat left top; width: 250px; height: 50px;}";
        if($up_options->linkcolor) $custom_css .= "a{ color: ".$up_options->linkcolor.";}";
        if($up_options->hovercolor) $custom_css .= "a:hover{ color: ".$up_options->hovercolor.";}";
        if($up_options->activecolor) $custom_css .= "a:active{ color: ".$up_options->activecolor.";}";
        $custom_css .= '</style>';
        echo $custom_css;
    endif;
}
add_action('wp_head', 'custom_css');

function pagemenu(){
    global $up_options;
    $pagequery = 'title_li=';
    if($up_options->excludepages):
        $pages = $up_options->excludepages;
        $pagestoexclude = array();
        foreach ($pages as $key => $value) {
            $pageID = $pages[$key];
            if($pageID) array_push($pagestoexclude,$pageID);
        }
        $pagequery .= '&exclude='. implode(",",$pagestoexclude);
    endif; ?>

    <div id="page-menu" class="buffer">
        <ul id="page-nav" class="sf-menu">
            <li class="rss"><a href="<?php if(function_exists('rss')) rss(); ?>"><?php _e("RSS Feed","gpro"); ?></a></li>
            <?php wp_list_pages($pagequery); ?>                                
        </ul>
    </div>
    <?php
}

function catmenu(){

    global $up_options;
    $catquery = 'title_li=';                             
    if($up_options->excludecats):
        $categories = $up_options->excludecats;
        $cats = array();
        foreach ($categories as $key => $value) {
            $catID = get_cat_ID($categories[$key]);
            if($catID) array_push($cats,$catID);
        }
        $catquery .= '&exclude='. implode(",",$cats);
    endif;?>
	
    <div id="category-menu" class="buffer">
        <ul id="category-nav" class="sf-menu">
            <?php if(!$up_options->hide_home_link): ?>
                <li class="home"><a href="<?php bloginfo('url'); ?>"><?php _e("Home","gpro"); ?></a></li>
            <?php endif;
            echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span>$3</span></a>', wp_list_categories($catquery)); ?>
            <li class="blog-description"><span><?php bloginfo('description'); ?></span></li>
        </ul>
    </div>	
<?php }

function add_home_link($menu){
    global $up_options;
    $check = preg_match('/category/', $menu, $matches);
    if($matches && !$up_options->hide_home_link):
        $menu = '<li class="home"><a href="' . get_bloginfo('wpurl') . '">' . __('Home','gpro') . '</a></li>' . $menu;
    endif;
    return $menu;	
}
add_filter('wp_nav_menu_items','add_home_link');

// Located in header.php 
// Creates the content of the Title tag
// Credits: Tarski Theme
function gpro_doctitle() {
    $site_name = get_bloginfo('name');
    $separator = '|';       	
    if ( is_single() ) {
        $content = single_post_title('', FALSE);
    }
    elseif ( is_home() || is_front_page() ) { 
        $content = get_bloginfo('description');
    }
    elseif ( is_page() ) { 
        $content = single_post_title('', FALSE); 
    }
    elseif ( is_search() ) { 
        $content = __('Search Results for:', 'gpro'); 
        $content .= ' ' . wp_specialchars(stripslashes(get_search_query()), true);
    }   
    elseif ( is_category() ) {
        $content = __('Category Archives:', 'gpro');
        $content .= ' ' . single_cat_title("", false);;
    }
    elseif ( is_tag() ) { 
        $content = __('Tag Archives:', 'gpro');
        $content .= ' ' . gpro_tag_query();
    }   
    elseif ( is_404() ) { 
        $content = __('Not Found', 'gpro'); 
    }
    else { 
        $content = get_bloginfo('description');
    }
    if (get_query_var('paged')) {
        $content .= ' ' .$separator. ' ';
        $content .= 'Page';
        $content .= ' ';
        $content .= get_query_var('paged');
    }

    if($content) {
        if ( is_home() || is_front_page() ) {
            $elements = array(
                'site_name' => $site_name,
                'separator' => $separator,
                'content' => $content
            );
        }
        else {
            $elements = array(
                'content' => $content
            );
        }  
    } else {
        $elements = array(
            'site_name' => $site_name
        );
    }

    // Filters should return an array
    $elements = apply_filters('gpro_doctitle', $elements);
	
    // But if they don't, it won't try to implode
    if(is_array($elements)) {
        $doctitle = implode(' ', $elements);
    }
    else {
        $doctitle = $elements;
    }
    
    $doctitle = "\t" . "<title>" . $doctitle . "</title>" . "\n\n";
    
    echo $doctitle;
} // end gpro_doctitle


// Creates the content-type section
function gpro_create_contenttype() {
    $content  = "\t";
    $content .= "<meta http-equiv=\"Content-Type\" content=\"";
    $content .= get_bloginfo('html_type'); 
    $content .= "; charset=";
    $content .= get_bloginfo('charset');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('gpro_create_contenttype', $content);
} // end gpro_create_contenttype

// The master switch for SEO functions
function gpro_seo() {
    $content = TRUE;
    return apply_filters('gpro_seo', $content);
}

// Creates the canonical URL
function gpro_canonical_url() {
    if (gpro_seo()) {
    	if ( is_singular() ) {
            $canonical_url = "\t";
            $canonical_url .= '<link rel="canonical" href="' . get_permalink() . '" />';
            $canonical_url .= "\n\n";        
            echo apply_filters('gpro_canonical_url', $canonical_url);
	}
    }
} // end gpro_canonical_url


// switch use of gpro_the_excerpt() - default: ON
function gpro_use_excerpt() {
    $display = TRUE;
    $display = apply_filters('gpro_use_excerpt', $display);
    return $display;
} // end gpro_use_excerpt


// switch use of gpro_the_excerpt() - default: OFF
function gpro_use_autoexcerpt() {
    $display = FALSE;
    $display = apply_filters('gpro_use_autoexcerpt', $display);
    return $display;
} // end gpro_use_autoexcerpt


// Creates the meta-tag description
function gpro_create_description() {
    if (gpro_seo()) {
    	if (is_single() || is_page() ) {
      	    if ( have_posts() ) {
          	while ( have_posts() ) {
            	    the_post();
		    if (gpro_the_excerpt() == "") {
                    	if (gpro_use_autoexcerpt()) {
                            $content ="\t";
                            $content .= "<meta name=\"description\" content=\"";
                            $content .= gpro_excerpt_rss();
                            $content .= "\" />";
                            $content .= "\n\n";
                    	}
                    }
                else {
                    if (gpro_use_excerpt()) {
                        $content ="\t";
                        $content .= "<meta name=\"description\" content=\"";
                        $content .= gpro_the_excerpt();
                        $content .= "\" />";
                        $content .= "\n\n";
                    }
                }
            }
        }
        } elseif ( is_home() || is_front_page() ) {
            $content ="\t";
            $content .= "<meta name=\"description\" content=\"";
            $content .= get_bloginfo('description');
            $content .= "\" />";
            $content .= "\n\n";
        }
        if(!empty($content)) echo apply_filters ('gpro_create_description', $content);
    }
} // end gpro_create_description


// meta-tag description is switchable using a filter
function gpro_show_description() {
    $display = TRUE;
    $display = apply_filters('gpro_show_description', $display);
    if ($display) {
        gpro_create_description();
    }
} // end gpro_show_description


// create meta-tag robots
function gpro_create_robots() {
    if (gpro_seo()) {
        $content = "\t";
        if((is_home() && (get_query_var('paged') < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
            $content .= "<meta name=\"robots\" content=\"index,follow\" />";
        } elseif (is_search()) {
            $content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
        } else {	
            $content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
        }
        $content .= "\n\n";
        if (get_option('blog_public')) {
            echo apply_filters('gpro_create_robots', $content);
        }
    }
} // end gpro_create_robots

// meta-tag robots is switchable using a filter
function gpro_show_robots() {
    $display = TRUE;
    $display = apply_filters('gpro_show_robots', $display);
    if ($display) {
        gpro_create_robots();
    }
} // end gpro_show_robots


// Located in header.php
// creates link to style.css
function gpro_create_stylesheet() {
    $content = "\t";
    $content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
    $content .= get_bloginfo('stylesheet_url');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('gpro_create_stylesheet', $content);
}

// pingback usage is switchable using a filter
function gpro_show_pingback() {
    $display = TRUE;
    apply_filters('gpro_show_pingback', $display);
    if ($display) {
        $content = "\t";
        $content .= "<link rel=\"pingback\" href=\"";
        $content .= get_bloginfo('pingback_url');
        $content .= "\" />";
        $content .= "\n\n";
        echo $content;
    }
} // end gpro_show_pingback


// comment reply usage is switchable using a filter
function gpro_show_commentreply() {
    $display = TRUE;
    apply_filters('gpro_show_commentreply', $display);
    if ($display) if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); // support for comment threading
} // end gpro_show_commentreply

// Load scripts for the jquery Superfish plugin http://users.tpg.com.au/j_birch/plugins/superfish/#examples
function gpro_head_scripts() {
    $scriptdir_start = "\t";
    $scriptdir_start .= '<script type="text/javascript" src="';
    $scriptdir_start .= get_bloginfo('template_directory');
    $scriptdir_start .= '/library/scripts/';    
    $scriptdir_end = '"></script>';
    $scripts = "\n";
    $scripts .= $scriptdir_start . 'hoverIntent.js' . $scriptdir_end . "\n";
    $scripts .= $scriptdir_start . 'superfish.js' . $scriptdir_end . "\n";
    $scripts .= $scriptdir_start . 'supersubs.js' . $scriptdir_end . "\n";
    $dropdown_options = $scriptdir_start . 'gpro-dropdowns.js' . $scriptdir_end . "\n";
    $scripts = $scripts . apply_filters('gpro_dropdown_options', $dropdown_options);
    $scripts .= "\n";
    $scripts .= "\t";
    $scripts .= '<script type="text/javascript">' . "\n";
    $scripts .= "\t\t";
    $scripts .= 'jQuery.noConflict();' . "\n";
    $scripts .= "\t";
    $scripts .= '</script>' . "\n";

    // Print filtered scripts
    print apply_filters('gpro_head_scripts', $scripts);

}
add_action('wp_head','gpro_head_scripts');

// Just after the opening body tag, before anything else.
function gpro_before() {
    do_action('gpro_before');
} // end gpro_before

// Just before the header div
function gpro_aboveheader() {
    do_action('gpro_aboveheader');
} // end gpro_aboveheader
		
// Just after the header div
function gpro_belowheader() {
    do_action('gpro_belowheader');
} // end gpro_belowheader

?>