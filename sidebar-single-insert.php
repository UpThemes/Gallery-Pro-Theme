<?php gpro_abovesingleinsert();
if ( is_sidebar_active('single-insert') ) { // there is active widgets for this sidebar
    echo '<div id="single-insert" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('single-insert');
    echo '</ul>' . "\n" . '</div><!-- #single-insert .aside -->' . "\n";
}
gpro_belowsingleinsert(); ?>