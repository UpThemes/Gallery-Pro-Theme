<?php
/**
 * Gallery functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1240;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Gallery supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Gallery 1.0
 */
function gallery_setup() {
	/*
	 * Makes Gallery available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Gallery, use a find and replace
	 * to change 'gallery' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gallery', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'video', 'image', 'link', 'quote', 'status', 'gallery' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary_nav', __( 'Primary Menu', 'gallery' ) );
	register_nav_menu( 'footer_nav', __( 'Footer Menu', 'gallery' ) );

  add_image_size('full-width',700,99999,false);
  add_image_size('full-width-2x',1400,99999,false);
  add_image_size('grid',232,9999,false);
  add_image_size('grid-2x',464,9999,false);

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'f2f2f2f2',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'gallery_setup' );

/**
 * Adds support for a custom header image.
 */
include_once( get_template_directory() . '/library/custom-header.php' );

/**
 * Adds support for custom gallery sliders
 */
include_once( get_template_directory() . '/library/gallery-slider.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Gallery 1.0
 */
function gallery_scripts_styles() {

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

  wp_enqueue_script( 'gallery-hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'), false );
  wp_enqueue_script( 'gallery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), false );
  wp_enqueue_script( 'gallery-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', array('jquery') );
  wp_enqueue_script( 'gallery-masonry', get_template_directory_uri() . '/js/jquery.masonry.js', array('gallery-infinitescroll') );
  wp_enqueue_script( 'gallery-fitvids', get_template_directory_uri() . '/js/fitvids.js', false );
  wp_enqueue_script( 'gallery-view', get_template_directory_uri() . '/js/view.js', false );
  wp_enqueue_script( 'gallery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery') );
  wp_enqueue_script( 'gallery-superfish', get_template_directory_uri() . '/js/superfish.js' );
  wp_enqueue_script( 'gallery-supersubs', get_template_directory_uri() . '/js/supersubs.js', array('gallery-superfish') );
	wp_enqueue_script( 'gallery-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery','gallery-superfish','gallery-supersubs'), false );
  wp_enqueue_script( 'gallery-global', get_template_directory_uri() . '/js/global.js', array('gallery-sticky','gallery-flexslider','gallery-fitvids','gallery-infinitescroll','gallery-supersubs','gallery-navigation') );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'gallery-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'gallery_scripts_styles' );

function gallery_set_loading_gif_location(){
	$template_directory = get_template_directory_uri();
	echo "<script>"."\n";
	echo "var global = {"."\n";
	echo "	loading : '$template_directory/images/loading.gif'"."\n";
	echo "}"."\n";
	echo "</script>"."\n\n";
}

add_action("wp_head","gallery_set_loading_gif_location",0);

function gallery_post_thumbnail( $size ){

  global $post;

  if( isset($post->ID) && has_post_thumbnail($post->ID) ){

	  if( $size == 'grid' ):
	    $normal_size = 'grid';
	    $retina_size = 'grid-2x';
	  elseif( $size == 'full-width' ):
	    $normal_size = 'full-width';
	    $retina_size = 'full-width-2x';
	  else:
	    $normal_size = 'medium';
	    $retina_size = 'large';
	  endif;

	  $post_thumbnail_id = get_post_thumbnail_id($post->ID);

	  $normal_image = wp_get_attachment_image_src( $post_thumbnail_id, $normal_size);
	  $normal_image_src = $normal_image[0];
	  $normal_width = $normal_image[1];
	  $normal_height = $normal_image[2];
	  $retina_image = wp_get_attachment_image_src( $post_thumbnail_id, $retina_size);
	  $retina_image_src = $retina_image[0];
	  $retina_width =  $retina_image[1] ? $retina_image[1] : '200';
	  $retina_height = $retina_image[2] ? $retina_image[2] : '200';

	  if( $retina_image_src ){
	 		$retina_image = " data-retina=\"$retina_image_src\"";
	  }

	  if( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) )
	    $alt_text = ' alt="' . get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) . '"';
	  else
	    $alt_text = '';

	  echo "<img class=\"wp-post-image\" width=\"$normal_width\" height=\"$normal_height\" src=\"$normal_image_src\"$retina_image$alt_text>";
	} else {
		echo false;
	}

}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Gallery 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function gallery_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'gallery' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'gallery_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Gallery 1.0
 */
function gallery_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'gallery_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Gallery 1.0
 */
function gallery_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'gallery' ),
		'id' => 'sidebar-primary',
		'description' => __( 'Appears on posts and pages.', 'gallery' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'gallery' ),
		'id' => 'sidebar-footer',
		'description' => __( 'Appears on footer.', 'gallery' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'gallery_widgets_init' );

if ( ! function_exists( 'gallery_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Gallery 1.0
 */
function gallery_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'gallery' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gallery' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gallery' ) ); ?></div>
		</nav><!-- #<?php echo $nav_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'gallery_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own gallery_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Gallery 1.0
 */
function gallery_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'gallery' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'gallery' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <span class="says">said:</span>', 'gallery' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() )
						);
					?>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'gallery' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'gallery' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for gallery_comment()

/**
 * Modifies the text fields for the comment form.
 *
 * @since Gallery 2.0
 */
function upthemes_form_fields($fields) {
	global $commenter,$aria_req;
  $fields = array(
  	'author' => '<p class="comment-form-author"><span class="text-field-holder"><input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></span></p>',
  	'email'  => '<p class="comment-form-email"><span class="text-field-holder"><input id="email" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></span></p>',
  	'url'    => '<p class="comment-form-url"><span class="text-field-holder"><input id="url" name="url" placeholder="Web URL" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></span></p>'
  );

  return $fields;
}

add_filter('comment_form_default_fields','upthemes_form_fields');

if ( ! function_exists( 'gallery_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own gallery_entry_meta() to override in a child theme.
 *
 * @since Gallery 1.0
 */
function gallery_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'gallery' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'gallery' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'gallery' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'gallery' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'gallery' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'gallery' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Gallery 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function gallery_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'gallery-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'gallery_body_class' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Gallery 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function gallery_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'gallery_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Gallery 1.0
 */
function gallery_customize_preview_js() {
	wp_enqueue_script( 'gallery-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'gallery_customize_preview_js' );


/**
 * Displays heading text with post count
 *
 * @since Gallery 1.0
 */
function gallery_list_header(){
	
	global $wpdb,$wp_query;
	
	if(is_category()):
		$catID = get_query_var('cat');
		$post_count = (int) get_category($catID)->count;
	elseif(is_tag()):
		$tagID = get_query_var('tag');
		$post_count = (int) get_category($tagID)->count;
	elseif(is_home() || is_front_page()):
		$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type ='post'");
		if (0 < $post_count)
			$post_count = (int)$post_count; 
	endif;

	$page = get_query_var('paged');
	$posts_per_page = get_option('posts_per_page');
						
	if($page == 0):
		$starting_post = 1;
		$ending_post = (int)$posts_per_page;
	else:
		$starting_post = (int)(($page-1) * $posts_per_page);
		$ending_post = (int)((($page-1) * $posts_per_page) + $posts_per_page);
	endif;

	if($ending_post > $post_count)
		$ending_post = $post_count;
	
	?>

  <h2>
    <?php
    if(is_category()):
      echo single_cat_title() . " ";               
    elseif(is_tag()):
      echo single_tag_title() . " ";               
    endif;
    ?>
    <span class="pagination">
    <?php
    $pagination = __('Showing %1$s - %2$s of %3$s','gallery');
    printf($pagination, $starting_post, $ending_post, $post_count); ?>
    </span>
  </h2>
<?php
}

/**
 *  Post navigation functionality
 *
 * @since Gallery 1.0
 */
function gallery_navigation_below() {
  if ( is_single() ): ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php gallery_previous_post_link() ?></div>
		<div class="nav-next"><?php gallery_next_post_link() ?></div>
	</div>
<?php else: ?>
  <div id="more">
	  <?php next_posts_link( __('Load More', 'gallery') ) ?>
  </div>
<?php
  endif;
}