<?php
/**
 * Custom Header Background for each page
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
if ( ! class_exists( 'CodelessHeaderBackgroundModule' ) ) {

	class CodelessHeaderBackgroundModule {


		function __construct(){
			// Load Customizer Preview Scripts for live edit options
            add_action( 'customize_preview_init', array(
                 &$this,
                'register_preview_scripts' 
            ), 999 );

			$this->add_custom_post_meta();

			add_filter( 'codeless_register_styles', array(
                 &$this,
                'add_custom_header_bg_color' 
            ), 999 );
		}

		function add_custom_post_meta(){
			if( class_exists('Cl_Post_Meta') ){
				Cl_Post_Meta::map(array(
	   
				   'post_type' => 'page',
				   'feature' => 'page_header_bg_color',
				   'meta_key' => 'page_header_bg_color',
				   'control_type' => 'kirki-color',
				   'label' => 'Header Background Color',
				   'priority' => 1,
				   'inline_control' => true,
				   'id' => 'page_header_bg_color',
				   'transport' => 'postMessage', 
				   'default' => '', 
				   
				));

			}
		}

		function register_preview_scripts(){
			wp_add_inline_script( 'codeless_css_preview', 
				'CL_POSTMESSAGE.meta_page_header_bg_color = function(to, value, postType, postID){
				  jQuery( \'.header_container > .main, .header_container.header-left, .heaer_container.header-right \' ).css({ backgroundColor: to });
				}' );
		}

		function add_custom_header_bg_color( $styles ){

			$page_bg_color = codeless_get_meta( 'page_header_bg_color', false );

			if( $page_bg_color !== false && $page_bg_color != '' )
				
				$styles .= '.header_container > .main, .header_container.header-left, .heaer_container.header-right{ background-color:'. $page_bg_color .' !important }';

			return $styles;
		}

	}	

	if( codeless_get_mod( 'cl_custom_header_background_per_page', false ) )
		new CodelessHeaderBackgroundModule();

}