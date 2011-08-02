<?php
// Filter to create the sidebar
function gpro_sidebar() {
  $show = TRUE;

    // Filters should return Boolean 
    $show = apply_filters('gpro_sidebar', $show);
    if ($show) { get_sidebar();}
    return;
} // end gpro_sidebar

/* Main Aside Hooks */

    // Located in sidebar.php 
    // Just before the main asides (commonly used as sidebars)
    function gpro_abovemainasides() {
        do_action('gpro_abovemainasides');
    } // end gpro_abovemainasides
            
            
    // Located in sidebar.php 
    // Between the main asides (commonly used as sidebars)
    function gpro_betweenmainasides() {
        do_action('gpro_betweenmainasides');
    } // end gpro_betweenmainasides
            
            
    // Located in sidebar.php 
    // after the main asides (commonly used as sidebars)
    function gpro_belowmainasides() {
        do_action('gpro_belowmainasides');
    } // end gpro_belowmainasides
	

// Index Aside Hooks

    // Located in sidebar-index-top.php
    function gpro_aboveindextop() {
            do_action('gpro_aboveindextop');
    } // end gpro_aboveindextop
    
    
    // Located in sidebar-index-top.php
    function gpro_belowindextop() {
            do_action('gpro_belowindextop');
    } // end gpro_belowindextop
    
    
    // Located in sidebar-index-insert.php
    function gpro_aboveindexinsert() {
            do_action('gpro_aboveindexinsert');
    } // end gpro_aboveindexinsert
    
    
    // Located in sidebar-index-insert.php
    function gpro_belowindexinsert() {
            do_action('gpro_belowindexinsert');
    } // end gpro_belowindexinsert	
    

    // Located in sidebar-index-bottom.php
    function gpro_aboveindexbottom() {
            do_action('gpro_aboveindexbottom');
    } // end gpro_aboveindexbottom
    
    
    // Located in sidebar-index-bottom.php
    function gpro_belowindexbottom() {
            do_action('gpro_belowindexbottom');
    } // end gpro_belowindexbottom	
	
// Single Post Asides

    // Located in sidebar-single-top.php
    function gpro_abovesingletop() {
            do_action('gpro_abovesingletop');
    } // end gpro_abovesingletop
    
    
    // Located in sidebar-single-top.php
    function gpro_belowsingletop() {
            do_action('gpro_belowsingletop');
    } // end gpro_belowsingletop
    
    
    // Located in sidebar-single-insert.php
    function gpro_abovesingleinsert() {
            do_action('gpro_abovesingleinsert');
    } // end gpro_abovesingleinsert
    
    
    // Located in sidebar-single-insert.php
    function gpro_belowsingleinsert() {
            do_action('gpro_belowsingleinsert');
    } // end gpro_belowsingleinsert	
    

    // Located in sidebar-single-bottom.php
    function gpro_abovesinglebottom() {
            do_action('gpro_abovesinglebottom');
    } // end gpro_abovesinglebottom
    
    
    // Located in sidebar-single-bottom.php
    function gpro_belowsinglebottom() {
            do_action('gpro_belowsinglebottom');
    } // end gpro_belowsinglebottom	

// Page Aside Hooks

    // Located in sidebar-page-top.php
    function gpro_abovepagetop() {
            do_action('gpro_abovepagetop');
    } // end gpro_abovepagetop
    
    
    // Located in sidebar-page-top.php
    function gpro_belowpagetop() {
            do_action('gpro_belowpagetop');
    } // end gpro_belowpagetop

    // Located in sidebar-page-bottom.php
    function gpro_abovepagebottom() {
            do_action('gpro_abovepagebottom');
    } // end gpro_abovepagebottom
    
    
    // Located in sidebar-page-bottom.php
    function gpro_belowpagebottom() {
            do_action('gpro_belowpagebottom');
    } // end gpro_belowpagebottom	

// Subsidiary Aside Hooks

    // Located in sidebar-subsidiary.php
    function gpro_abovesubasides() {
            do_action('gpro_abovesubasides');
    } // end gpro_abovesubasides
    

    // Located in sidebar-subsidiary.php
    function gpro_belowsubasides() {
            do_action('gpro_belowsubasides');
    } // end gpro_belowsubasides
    

    // Located in sidebar-subsidiary.php
    function gpro_before_first_sub() {
            do_action('gpro_before_first_sub');
    } // end gpro_before_first_sub


    // Located in sidebar-subsidiary.php
    function gpro_between_firstsecond_sub() {
            do_action('gpro_between_firstsecond_sub');
    } // end gpro_between_firstsecond_sub


    // Located in sidebar-subsidiary.php
    function gpro_between_secondthird_sub() {
            do_action('gpro_between_secondthird_sub');
    } // end gpro_between_secondthird_sub
    
    
    // Located in sidebar-subsidiary.php
    function gpro_after_third_sub() {
            do_action('gpro_after_third_sub');
    } // end gpro_after_third_sub	