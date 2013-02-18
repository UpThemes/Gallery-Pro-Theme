<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if( has_post_thumbnail() ): ?>
	  	<a href="<?php the_permalink(); ?>"><?php gallery_post_thumbnail('grid'); ?></a>
	  <?php endif; ?>

    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php the_excerpt(); ?>

    <div class="post-meta">
      <div class="category"><?php the_category(', '); ?></div>
      <div class="comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number(); ?></a></div>
    </div><!--/.post-meta-->
	</article><!--/.post-->