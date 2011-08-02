<?php
// Located in footer.php
// Just before the footer div
function gpro_abovefooter() {
    do_action('gpro_abovefooter');
} // end gpro_abovefooter

// located in footer.php
// the footer text can now be filtered and controlled from your own functions.php
function gpro_footertext($thm_footertext) {
    $thm_footertext = apply_filters('gpro_footertext', $thm_footertext);
    return $thm_footertext;
} // end gpro_footertext

// Located in footer.php
// Just after the footer div
function gpro_belowfooter() {
    do_action('gpro_belowfooter');
} // end gpro_belowfooter

// Located in footer.php 
// Just before the closing body tag, after everything else.
function gpro_after() {
    do_action('gpro_after');
} // end gpro_after
?>