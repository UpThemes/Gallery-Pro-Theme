<?php

/*
Plugin Name: Custom Write Panel
Plugin URI: http://wefunction.com/2008/10/tutorial-create-custom-write-panels-in-wordpress
Description: Allows custom fields to be added to the WordPress Post Page
Version: 1.0
Author: Spencer
Author URI: http://wefunction.com
/* ----------------------------------------------*/

$new_meta_boxes = array(
    "full-image" => array(
    "name" => "full-image",
    "std" => "",
    "title" => "Path to Custom Full-Size Image (500x375)",
    "description" => "If you'd like to override the generated image gallery medium-size image, please enter an image path here."),
    "thumbnail" => array(
    "name" => "thumbnail",
    "std" => "",
    "title" => "Path to Thumbnail Image",
    "description" => "If you'd like to override the generated image gallery thumbnail image, please enter an image path here."),
    "designed-by" => array(
    "name" => "designed-by",
    "std" => "",
    "title" => "Designed by",
    "description" => "Enter the name of the designer (if known or applicable). This will be displayed if entered and hidden if empty."),
    "web-url" => array(
    "name" => "web-url",
    "std" => "",
    "title" => "Website URL",
    "description" => "Enter the full website URL (if applicable). If you have entered a full-size image above, this will be linked to it. This will be displayed if entered and hidden if empty.")            
);

function new_meta_boxes() {
  global $post, $new_meta_boxes, $up_options;
  
    if($up_options->custom_metadata):
        foreach($up_options->custom_metadata as $metadata){
            $metaslug = "custom-".strtolower(preg_replace('/ /', '_', $metadata));
            $metabox = array(
              "name" => $metaslug,
              "std" => "",
              "title" => $metadata,
              "description" => "Custom metadata field from your theme options panel.");
            $new_meta_boxes[] = $metabox;
        }
    endif;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
        if($meta_box_value == "") $meta_box_value = $meta_box['std'];
        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
        echo'<label style="font-weight: bold; display: block; padding: 5px 0 2px 2px" for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        echo'<input type="text" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" size="55" /><br />';
        echo'<p><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></p>';
    }
}

function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Gallery Post Settings', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $new_meta_boxes, $up_options;
    if($up_options->custom_metadata):    
        foreach($up_options->custom_metadata as $metadata){
            $metaslug = "custom-".strtolower(preg_replace('/ /', '_', $metadata));
            $metabox = array(
                "name" => $metaslug,
                "std" => "",
                "title" => $metadata,
                "description" => "Custom metadata field from your theme options panel.");
            $new_meta_boxes[] = $metabox;
        }
    endif;
  
    foreach($new_meta_boxes as $meta_box) {
        // Verify
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
            return $post_id;
        }
      
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
        }
        $data = $_POST[$meta_box['name']];
        if(get_post_meta($post_id, $meta_box['name']) == "") add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true)) update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "") delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');