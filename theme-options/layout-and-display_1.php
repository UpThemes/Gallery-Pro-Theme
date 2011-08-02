<?php
/*  Array Options:
   
    name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
*/

$options = array (
    array(  "name" => "Thumbnail Size",
            "desc" => "Select a preset thumbnail size or set your own custom size below.",
            "id" => "thumbnail",
            "type" => "select",
            "default_text" => "Custom Thumbnail Size",
            "options" => array("Small (125px x 125px)" => "thumbnail", "Medium (226px x 180px)" => "thumb_medium", "Large (300px x 225px)" => "thumb_large")),
    
    array(  "name" => "Custom Thumbnail Width",
            "desc" => "Select the appropriate width for your thumbnails (Recommended: 125,226,300).",
            "id" => "thumbnail_w",
            "type" => "text",
            "value" => "226"),

    array(  "name" => "Custom Thumbnail Height",
            "desc" => "Select the appropriate height for your thumbnails.",
            "id" => "thumbnail_h",
            "type" => "text",
            "value" => "180"),

    array(  "name" => "Show Sidebar on Homepage/Categories/Archives",
            "desc" => "Do you want to have a sidebar on these pages?",
            "id" => "showsidebar",
            "type" => "select",
            "default_text" => "No",
            "options" => array("Yes"=>1)),

    array(  "name" => "Sidebar Width",
            "desc" => "How wide should the sidebar be (in pixels please)?",
            "id" => "sidebarwidth",
            "type" => "text",
            "value" => "270"),

    array(  "name" => "Index Insert Position",
            "desc" => "This allows for a widgetized area to be inserted in between your posts on the index page. Select the number of the post you'd like to insert a widgetized area after.",
            "id" => "insert_position",
            "type" => "select",
            "options" => array(
				"0" => 0,
				"1" => 1,
				"2" => 2,
				"3" => 3,
				"4" => 4,
				"5" => 5,
				"6" => 6,
				"7" => 7,
				"8" => 8,
				"9" => 9,
				"10" => 10,
				"11" => 11,
				"12" => 12,
				"13" => 13,
				"14" => 14,
				"15" => 15
			)),

);

/* ------------ Do not edit below this line ----------- */

//Check if theme options set
global $default_check;
global $default_options;

if(!$default_check):
    foreach($options as $option):
        if($option['type'] != 'image'):
            $default_options[$option['id']] = $option['value'];
        else:
            $default_options[$option['id']] = $option['url'];
        endif;
    endforeach;
    $update_option = get_option('up_themes_'.UPTHEMES_SHORT_NAME);
    if(is_array($update_option)):
        $update_option = array_merge($update_option, $default_options);
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $update_option);
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);
?>

<!-- Option Effects for Custom Size and Preset Thumbnails -->

<script type="text/javascript">
    jQuery(function($){
        var preset = $("#thumbnail").val();
        var custom = $("#container-thumbnail_w, #container-thumbnail_h");
        var height = $("#thumbnail_h");
        var width = $("#thumbnail_w");
        
        var thumbnail = new Object;
        thumbnail.height = 125;
        thumbnail.width = 125;
        
        var thumb_medium = new Object;
        thumb_medium.height = 180;
        thumb_medium.width = 220;
        
        var thumb_large = new Object;
        thumb_large.height = 226;
        thumb_large.width = 300;
        
        if(preset){
            custom.hide();
        }
        
        $(".feature-set").delegate("#thumbnail", "change", function(){
            var preset = $("#thumbnail").val();
            if(!preset){
                custom.css({background: '#D2E2F5'});
                custom.show();
                custom.animate({backgroundColor:"#fff"}, 750)
            }else{
                custom.hide();
                /* Set Custom Size to Current Preset */
                height.val(eval(preset+'.height'));
                width.val(eval(preset+'.width'));
            }
        });
    });
</script>