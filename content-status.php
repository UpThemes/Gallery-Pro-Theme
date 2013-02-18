<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-content">
    	<?php the_content(); ?>
    </div><!--/.post-content-->

    <div class="post-meta">
      <a href="<?php the_permalink(); ?>">#</a>
    </div><!--/.post-meta-->
	</article><!--/.post-->