<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Gallery already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Gallery
 * @since Gallery 1.0
 */

get_header(); ?>

  <div id="container" class="cf">

    <div id="content">

      <header class="archive-header">
        <h1 class="archive-title"><?php
          if ( is_day() ) :
            printf( __( 'Daily Archives: %s', 'gallery' ), '<span>' . get_the_date() . '</span>' );
          elseif ( is_month() ) :
            printf( __( 'Monthly Archives: %s', 'gallery' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'gallery' ) ) . '</span>' );
          elseif ( is_year() ) :
            printf( __( 'Yearly Archives: %s', 'gallery' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'gallery' ) ) . '</span>' );
          else :
            _e( 'Archives', 'gallery' );
          endif;
        ?></h1>
      </header><!-- .archive-header -->

      <div id="masonry">

        <?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

        <?php endwhile; else: ?>

        <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

      </div><!-- /#masonry -->

    </div><!-- /#content -->

    <?php gallery_navigation_below(); ?>

	</div><!-- /#container -->

<?php get_footer() ?>