<?php

// Located in comments.php
// Just before #comments
function gpro_abovecomments() {
    do_action('gpro_abovecomments');
}


// Located in comments.php
// Just before #comments-list
function gpro_abovecommentslist() {
    do_action('gpro_abovecommentslist');
}


// Located in comments.php
// Just after #comments-list
function gpro_belowcommentslist() {
    do_action('gpro_belowcommentslist');
}


// Located in comments.php
// Just before #trackbacks-list
function gpro_abovetrackbackslist() {
    do_action('gpro_abovetrackbackslist');
}


// Located in comments.php
// Just after #trackbacks-list
function gpro_belowtrackbackslist() {
    do_action('gpro_belowtrackbackslist');
}


// Located in comments.php
// Just before the comments form
function gpro_abovecommentsform() {
    do_action('gpro_abovecommentsform');
}


// Adds the Subscribe to comments button
function gpro_show_subscription_checkbox() {
    if(function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); }
}
add_action('comment_form', 'gpro_show_subscription_checkbox', 98);


// Located in comments.php
// Just after the comments form
function gpro_belowcommentsform() {
    do_action('gpro_belowcommentsform');
}


// Adds the Subscribe without commenting button
function gpro_show_manual_subscription_form() {
    if(function_exists('show_manual_subscription_form')) { show_manual_subscription_form(); }
}
add_action('gpro_belowcommentsform', 'gpro_show_manual_subscription_form', 5);


// Located in comments.php
// Just after #comments
function gpro_belowcomments() {
    do_action('gpro_belowcomments');
}


// creates the list comments arguments
function list_comments_arg() {
    $content = 'type=comment&callback=gpro_comments';
    return apply_filters('list_comments_arg', $content);
}


// Produces an avatar image with the hCard-compliant photo class
function gpro_commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar_size = apply_filters( 'avatar_size', '80' ); // Available filter: avatar_size
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, $avatar_size ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end gpro_commenter_link


// A hook for the standard comments template
function gpro_comments_template() {
    do_action('gpro_comments_template');
} // end gpro_comments


// The standard comments template is injected into gpro_comments_template() by default
function gpro_include_comments() {
        comments_template('', true);
} // end gpro_include_comments
add_action('gpro_comments_template','gpro_include_comments',5);
?>