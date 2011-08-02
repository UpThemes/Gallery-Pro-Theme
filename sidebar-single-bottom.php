<?php gpro_abovesinglebottom();
if ( is_sidebar_active('single-bottom') ) { // there is active widgets for this sidebar
    echo '<div id="single-bottom" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('single-bottom');
    echo '</ul>' . "\n" . '</div><!-- #single-bottom .aside -->'. "\n";
}
gpro_belowsinglebottom() ?>