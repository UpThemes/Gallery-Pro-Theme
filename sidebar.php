<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 2.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>
		<div id="primary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-primary' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>