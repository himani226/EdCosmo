<?php

// Action Header Hooks

function codeless_hook_viewport_before(){
    do_action( 'codeless_hook_viewport_before' );
}

function codeless_hook_wrapper_before(){
    do_action( 'codeless_hook_wrapper_before' );
}

function codeless_hook_wrapper_begin(){
    do_action( 'codeless_hook_wrapper_begin' );
}

function codeless_hook_main_before(){
    do_action( 'codeless_hook_main_before' );
}

function codeless_hook_main_begin(){
    do_action( 'codeless_hook_main_begin' );
}


// Action Index Hooks

function codeless_routing_template(){
    do_action( 'codeless_routing_template' );
}

function codeless_execute_query(){
    do_action( 'codeless_execute_query' );
}

function codeless_hook_content_before(){
    do_action( 'codeless_hook_content_before' );
}

function codeless_hook_content_begin(){
    do_action( 'codeless_hook_content_begin' );
}

function codeless_hook_content_end(){
    do_action( 'codeless_hook_content_end' );
}

function codeless_hook_content_after(){
    do_action( 'codeless_hook_content_after' );
}

function codeless_hook_content_column_before(){
    do_action( 'codeless_hook_content_column_before' );
}

function codeless_hook_content_column_begin(){
    do_action( 'codeless_hook_content_column_begin' );
}

function codeless_hook_content_column_end(){
    do_action( 'codeless_hook_content_column_end' );
}

function codeless_hook_content_column_after(){
    do_action( 'codeless_hook_content_column_after' );
}

function codeless_hook_secondary_begin(){
    do_action( 'codeless_hook_secondary_begin' );
}

function codeless_hook_secondary_end(){
    do_action( 'codeless_hook_secondary_end' );
}

function codeless_hook_main_end(){
    do_action( 'codeless_hook_main_end' );
}

function codeless_hook_main_after(){
    do_action( 'codeless_hook_main_after' );
}

function codeless_hook_wrapper_end(){
    do_action( 'codeless_hook_wrapper_end' );
}

function codeless_hook_wrapper_after(){
    do_action( 'codeless_hook_wrapper_after' );
}

function codeless_hook_viewport_end(){
    do_action( 'codeless_hook_viewport_end' );
}

function codeless_hook_viewport_after(){
    do_action( 'codeless_hook_viewport_after' );
}


// Single Post Content
function codeless_hook_post_content_begin(){
    do_action( 'codeless_hook_post_content_begin' );
}

function codeless_hook_post_content_end(){
    do_action( 'codeless_hook_post_content_end' );
}

// Single Post News
function codeless_hook_news_grid_item_before(){
    do_action( 'codeless_hook_news_grid_item_before' );
}
function codeless_hook_news_grid_item_after(){
    do_action( 'codeless_hook_news_grid_item_after' );
}


function codeless_hook_custom_post_end( $type, $id ){
    do_action( 'codeless_hook_custom_post_end', $type, $id );
}

function codeless_hook_custom_post_loop_end( $type ){
    do_action( 'codeless_hook_custom_post_loop_end', $type );
}


/**
 * Theme Hooks list
 * Don't modify this list
 * Use child theme and remove_action
 */


// Viewport Extra Class
add_filter( 'codeless_extra_classes_viewport', 'codeless_extra_classes_viewport');
// Viewport Extra Attr
add_filter( 'codeless_extra_attr_viewport',  'codeless_extra_attr_viewport' );

// Wrapper Extra Class
add_filter( 'codeless_extra_classes_wrapper', 'codeless_extra_classes_wrapper');

// Header Container:Extra Classes
add_filter( 'codeless_extra_classes_header', 'codeless_extra_classes_header' );
add_filter( 'codeless_extra_attr_header', 'codeless_extra_attr_header' );

// Content: Extra Classes
add_filter( 'codeless_extra_classes_content', 'codeless_extra_classes_content' );
// Content: Extra Attr
add_filter( 'codeless_extra_attr_content', 'codeless_page_background_color' );
// Inner-Content: Extra Classes
add_filter( 'codeless_extra_classes_inner_content', 'codeless_extra_classes_inner_content' );
// Inner-Content-Row: Extra Classes
add_filter( 'codeless_extra_classes_inner_content_row', 'codeless_extra_classes_inner_content_row' );
// Content Column: Extra Classes
add_filter( 'codeless_extra_classes_content_col', 'codeless_extra_classes_content_col' );

// Blog Entries: Extra Classes
add_filter( 'codeless_extra_classes_blog_entries', 'codeless_extra_classes_blog_entries' );
// Blog Entries: Extra Attributes
add_filter( 'codeless_extra_attr_blog_entries', 'codeless_extra_attr_blog_entries' );
// Blog Entries List: Extra Classes
add_filter( 'codeless_extra_classes_blog_entries_list', 'codeless_extra_classes_blog_entries_list' );
// Blog Entries List: Extra Attributes
add_filter( 'codeless_extra_attr_blog_entries_list', 'codeless_extra_attr_blog_entries_list' );

// Portfolio Entries: Extra Classes
add_filter( 'codeless_extra_classes_portfolio_entries', 'codeless_extra_classes_portfolio_entries' );
// Portfolio Entries: Extra Attributes
add_filter( 'codeless_extra_attr_portfolio_entries', 'codeless_extra_attr_portfolio_entries' );

// #Secondary Sidebar:Extra Classes
add_filter( 'codeless_extra_classes_secondary', 'codeless_extra_classes_secondary' );
// #Secondary Sidebar:Extra Attr
add_filter( 'codeless_extra_attr_secondary', 'codeless_extra_attr_secondary' );
// Entry:Extra Classes
add_filter( 'codeless_extra_classes_entry', 'codeless_extra_classes_entry' );
// Entry:Extra Attributes
add_filter( 'codeless_extra_attr_entry', 'codeless_extra_attr_entry' );

// Entry content:Extra Classes
add_filter( 'codeless_extra_classes_entry_content', 'codeless_extra_classes_entry_content' );

// Portfolio Item:Extra Classes
add_filter( 'codeless_extra_classes_portfolio_item', 'codeless_extra_classes_portfolio_item' );
// Portfolio Item:Extra Attributes
add_filter( 'codeless_extra_attr_portfolio_item', 'codeless_extra_attr_portfolio_item' );

// Team Item:Extra Classes
add_filter( 'codeless_extra_classes_team_item', 'codeless_extra_classes_team_item' );
// Team Item:Extra Attributes
add_filter( 'codeless_extra_attr_team_item', 'codeless_extra_attr_team_item' );

// Footer Wrapper: Extra Classes
add_filter( 'codeless_extra_classes_footer_wrapper', 'codeless_extra_classes_footer_wrapper' );
// Footer Content:Extra Classes
add_filter( 'codeless_extra_classes_footer_content', 'codeless_extra_classes_footer_content' );
// Footer Content Row:Extra Classes
add_filter( 'codeless_extra_classes_footer_content_row', 'codeless_extra_classes_footer_content_row' );

// Copyright Content:Extra Classes
add_filter( 'codeless_extra_classes_copyright_content', 'codeless_extra_classes_copyright_content' );
// Copyright Content Row:Extra Classes
add_filter( 'codeless_extra_classes_copyright_content_row', 'codeless_extra_classes_copyright_content_row' );

add_filter( 'body_class', 'codeless_manage_body_classes' );




// Viewport
add_action( 'codeless_hook_viewport_before', 'codeless_custom_html' );

add_action( 'codeless_hook_viewport_end', 'codeless_layout_bordered', 10 );



// Wrapper
add_action( 'codeless_hook_wrapper_begin', 'codeless_show_header', 0 );

add_action( 'codeless_hook_wrapper_after', 'codeless_back_to_top_button' );
add_action( 'codeless_hook_wrapper_after', 'codeless_show_sidenav' );
add_action( 'codeless_hook_wrapper_after', 'codeless_show_fullscreen_overlay' );


// Content
add_action( 'codeless_hook_content_before', 'codeless_single_portfolio_navigation', 0 );

add_action( 'codeless_hook_content_begin', 'codeless_add_page_header', 1 );
add_action( 'codeless_hook_content_begin', 'codeless_add_slider', 5 );
add_action( 'codeless_hook_content_begin', 'codeless_add_post_header', 10 );
add_action( 'codeless_hook_content_begin', 'codeless_layout_modern', 20 );
add_action( 'codeless_hook_content_begin', 'codeless_wrapper_page_layout' );

add_action( 'codeless_hook_content_end', 'codeless_close_wrapper_page_layout' );


// Content Column
add_action( 'codeless_hook_content_column_after', 'codeless_get_sidebar', 0 );


// #Secondary
add_action( 'codeless_hook_secondary_begin', 'codeless_sticky_sidebar_wrapper', 0 );

add_action( 'codeless_hook_secondary_end', 'codeless_sticky_sidebar_wrapper_end', 0 );


// Main
add_action( 'codeless_hook_main_after', 'codeless_show_footer', 0 );


// Entry News
add_action( 'codeless_hook_news_grid_item_before', 'codeless_news_grid_item_wrapper' );

add_action( 'codeless_hook_news_grid_item_after', 'codeless_news_grid_item_wrapper_close' );





?>