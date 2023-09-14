<?php
/**
 * Custom Header Options for each page
 * 
 * @package Thype WordPress Theme
 * @subpackage Modules
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'CodelessHeaderBoxedModule' ) ) {

	class CodelessHeaderBoxedModule {


		function __construct(){
			// Load Customizer Preview Scripts for live edit options
            add_action( 'customize_preview_init', array(
                 &$this,
                'register_preview_scripts' 
            ), 999 );

			$this->add_custom_post_meta();

			add_filter( 'codeless_is_header_boxed', array(
                 &$this,
                'custom_header_boxed' 
            ), 999 );
		}

		function add_custom_post_meta(){
			if( class_exists('Cl_Post_Meta') )
				Cl_Post_Meta::map(array(
	   
				   'post_type' => 'page',
				   'feature' => 'page_header_boxed',
				   'meta_key' => 'page_header_boxed',
				   'control_type' => 'kirki-switch',
				   'label' => 'Header Boxed',
				   'priority' => 1,
				   'inline_control' => true,
				   'id' => 'page_header_boxed',
				   'transport' => 'postMessage', 
				   'default' => '', 
				   'description' => 'Custom Header Option ( Boxed header ) only for this page. This will overwrite the default value on Theme Options -> Header'
				   
				));
		}

		function register_preview_scripts(){
			wp_add_inline_script( 'codeless_css_preview', 
				'CL_POSTMESSAGE.meta_page_header_boxed = function(to, value, postType, postID){
				  if(to == 1)
				    jQuery(\'.header_container\').addClass(\'boxed-style cl-added-from-meta\');
				  else  
				    jQuery(\'.header_container\').removeClass(\'boxed-style cl-added-from-meta\');
				  setTimeout(function(){
				  	CL_POSTMESSAGE.viewportPosition();
				  }, 10);
				}' );
		}

		function custom_header_boxed( $value ){
			return codeless_get_meta( 'page_header_boxed', $value );
		}

	}	

	if( codeless_get_mod( 'cl_custom_header_boxed_per_page', false ) )
		new CodelessHeaderBoxedModule();

}