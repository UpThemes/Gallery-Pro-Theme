<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 2.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php gallery_post_thumbnail('full-width'); ?>
		<h1 class="page-title"><?php the_title() ?></h1>

		<div class="post-content">
				<?php the_content(); ?>
		</div><!--/.post-content-->

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'gallery' ), 'after' => '</div>' ) ); ?>

	  <?php comments_template(); ?>
	</article><!--/.post-->