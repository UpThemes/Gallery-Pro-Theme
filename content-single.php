<?php
/**
 * The template for displaying single post content.
 *
 * @package WordPress
 * @subpackage Gallery Pro
 * @since Gallery Pro 2.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php gallery_post_thumbnail('full-width'); ?>

		<header class="entry-header">
			<?php echo get_avatar( get_the_author_meta('user_email'), 64 ); ?>
			<h1 class="entry-title"><?php the_title() ?></h1>
			<div class="post-meta before-content">
				<span class="author"><?php echo __('Posted by','gallery'); ?> <?php the_author_posts_link(); ?></span> 
				<span class="category"><?php _e("in","gallery"); ?> <?php the_category(', '); ?></span>
			</div><!--/.post-meta-->
		</header><!--/.entry-header-->

		<div class="post-content">
				<?php the_content(); ?>
		</div><!--/.post-content-->

		<div class="post-meta after-content">
		  <div class="tags"><?php the_tags(__("Tags:","gallery") . " ",', '); ?></div>
		</div><!--/.post-meta-->

	  <?php comments_template(); ?>
	</article><!--/.post-->