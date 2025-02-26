<?php
/*
* include fields for custom content
*/

// ### Add all related fields for custom types to be used

// include('fields/options.inc'); 
// include('fields/homepage.inc');
// include('fields/page.inc');
// include('fields/contact.inc');




//setup options page title and code
function _mytheme_createOptions(){

    if( function_exists('acf_add_options_page') ) {
        $sitename = get_bloginfo('name');
        //$sitename = 'Test';
        acf_add_options_page(array(
            'page_title' 	=> $sitename.' Theme Options',
            'menu_title'	=> $sitename.' Theme Options',
            'menu_slug' 	=> 'kg-theme-options',
            'capability'	=> 'edit_posts',
            'redirect'		=> true
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'General Settings',
            'menu_title'	=> 'General',
            'parent_slug'	=> 'kg-theme-options',
        ));
    }
}
add_action('init', '_mytheme_createOptions');
