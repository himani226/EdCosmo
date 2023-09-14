<?php
/**
 * Custom Portfolio Item Color
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
if ( ! class_exists( 'CodelessPortfolioItemColorModule' ) ) {

	class CodelessPortfolioItemColorModule {


		function __construct(){
			// Load Customizer Preview Scripts for live edit options
            add_action( 'customize_preview_init', array(
                 &$this,
                'register_preview_scripts' 
            ), 999 );

			$this->add_custom_post_meta();

			add_filter( 'codeless_portfolio_overlay_color', array(
                 &$this,
                'custom_portfolio_color' 
            ), 999, 2 );
		}

		function add_custom_post_meta(){
			if( class_exists('Cl_Post_Meta') )
				Cl_Post_Meta::map(array(
	   
				   'post_type' => 'portfolio',
				   'feature' => 'portfolio_overlay_color',
				   'meta_key' => 'portfolio_overlay_color',
				   'control_type' => 'kirki-color',
				   'label' => 'Portfolio Overlay Color',
				   'priority' => 1,
				   'inline_control' => true,
				   'id' => 'portfolio_overlay_color',
				   'transport' => 'postMessage', 
				   'default' => '', 
				   
				));
		}

		function register_preview_scripts(){
			wp_add_inline_script( 'codeless_css_preview', 
				'CL_POSTMESSAGE.meta_portfolio_overlay_color = function(to, value, postType, postID){
				  if( jQuery("#cl-portfolio-item-" + postID).length > 0 ){
				    var $overlay = jQuery( ".overlay-wrapper", "#cl-portfolio-item-"+postID);
				    if( $overlay.length > 0 ){
				      $overlay.css("background-color", to);
				    }
				  }
				}' );
		}

		function custom_portfolio_color( $value, $id ){
			return codeless_get_meta( 'portfolio_overlay_color', $value, $id );
		}

	}	

	if( codeless_get_mod( 'cl_custom_portfolio_overlay_color', false ) )
		new CodelessPortfolioItemColorModule();

}