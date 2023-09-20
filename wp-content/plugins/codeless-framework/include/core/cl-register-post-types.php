<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Register Portfolio
global $post_types;

$post_types = array();

$post_types['portfolio'] = array(

	'post_type' => 'portfolio',

	'taxonomy' => 'portfolio_entries',

	'labels' => array( 

		'name' => _x('Portfolio Items', 'post type general name', 'codeless-builder' ),

		'singular_name' => _x('Portfolio Entry', 'post type singular name', 'codeless-builder' ),

		'add_new' => _x('Add New', 'portfolio', 'codeless-builder' ),

		'add_new_item' => esc_attr__('Add New Portfolio Entry', 'codeless-builder' ),

		'edit_item' => esc_attr__('Edit Portfolio Entry', 'codeless-builder' ),

		'new_item' => esc_attr__('New Portfolio Entry', 'codeless-builder' ),

		'view_item' => esc_attr__('View Portfolio Entry', 'codeless-builder' ),

		'search_items' => esc_attr__('Search Portfolio Entries', 'codeless-builder' ),

		'not_found' =>  esc_attr__('No Portfolio Entries found', 'codeless-builder' ),

		'not_found_in_trash' => esc_attr__('No Portfolio Entries found in Trash', 'codeless-builder' ), 
 
		'parent_item_colon' => ''

	),

	'taxonomy_label' => esc_attr__( 'Portfolio Categories', 'codeless-builder' ),

	'slugRule' => 'portfolio',

	'show_in_customizer' => true

);





// Register Staff

$post_types['staff'] = array(

	'post_type' => 'staff',

	'taxonomy' => 'staff_entries',

	'labels' => array(

		'name' => _x('Team', 'post type general name', 'codeless-builder' ),

		'singular_name' => _x('Staff Entry', 'post type singular name', 'codeless-builder' ),

		'add_new' => _x('Add New', 'staff', 'codeless-builder' ),

		'add_new_item' => esc_attr__('Add New Staff Entry', 'codeless-builder' ),

		'edit_item' => esc_attr__('Edit Staff Entry', 'codeless-builder' ),

		'new_item' => esc_attr__('New Staff Entry', 'codeless-builder' ),

		'view_item' => esc_attr__('View Staff Entry', 'codeless-builder' ),

		'search_items' => esc_attr__('Search Staff Entries', 'codeless-builder' ),

		'not_found' =>  esc_attr__('No Staff Entries found', 'codeless-builder' ),

		'not_found_in_trash' => esc_attr__('No Staff Entries found in Trash', 'codeless-builder' ), 

		'parent_item_colon' => ''
	),

	'taxonomy_label' => esc_attr__( 'Staff Categories', 'codeless-builder' ),

	'slugRule' => 'staff',

	'show_in_customizer' => true

);





// Register Testimonial

$post_types['testimonial'] = array(

	'post_type' => 'testimonial',

	'taxonomy' => 'testimonial_entries',

	'labels' => array(

		'name' => _x('Testimonials', 'post type general name', 'codeless-builder' ),

		'singular_name' => _x('Testimonial Entry', 'post type singular name', 'codeless-builder' ),

		'add_new' => _x('Add New', 'testimonial', 'codeless-builder' ),

		'add_new_item' => esc_attr__('Add New Testimonial Entry', 'codeless-builder' ),

		'edit_item' => esc_attr__('Edit Testimonial Entry', 'codeless-builder' ),

		'new_item' => esc_attr__('New Testimonial Entry', 'codeless-builder' ),

		'view_item' => esc_attr__('View Testimonial Entry', 'codeless-builder' ),

		'search_items' => esc_attr__('Search Testimonial Entries', 'codeless-builder' ),

		'not_found' =>  esc_attr__('No Testimonial Entries found', 'codeless-builder' ),

		'not_found_in_trash' => esc_attr__('No Testimonial Entries found in Trash', 'codeless-builder' ), 

		'parent_item_colon' => ''

	),

	'taxonomy_label' => esc_attr__( 'Testimonial Categories', 'codeless-builder' ),

	'slugRule' => 'testimonial',

	'show_in_customizer' => true


);


$post_types['codeless_slider'] = array(

	'post_type' => 'codeless_slider',

	'taxonomy' => 'codeless_sliders',

	'labels' => array(

		'name' => _x('Codeless Sliders', 'post type general name', 'codeless-builder' ),

		'singular_name' => _x('Codeless Slider', 'post type singular name', 'codeless-builder' ),

		'add_new' => _x('Add New', 'content_block', 'codeless-builder' ),

		'add_new_item' => esc_attr__('Add New Codeless Slider', 'codeless-builder' ),

		'edit_item' => esc_attr__('Edit Codeless Slider', 'codeless-builder' ),

		'new_item' => esc_attr__('New Codeless Slider', 'codeless-builder' ),

		'view_item' => esc_attr__('View Codeless Slider', 'codeless-builder' ),

		'search_items' => esc_attr__('Search Codeless Sliders', 'codeless-builder' ),

		'not_found' =>  esc_attr__('No Codeless Sliders found', 'codeless-builder' ),

		'not_found_in_trash' => esc_attr__('No Codeless Sliders found in Trash', 'codeless-builder' ), 

		'parent_item_colon' => ''

	),

	'taxonomy_label' => esc_attr__( 'Codeless Sliders Categories', 'codeless-builder' ),

	'slugRule' => 'codeless_slider',

	'show_in_customizer' => false


);

function codeless_load_post_types( $args ){
	global $post_types;

	if( is_array( $args ) && !empty( $args ) ){
		foreach( $args as $post_type ){
			if( isset( $post_types[$post_type] ) )
				new Cl_Register_Post_Type( $post_types[$post_type] );
		}
	}
}
