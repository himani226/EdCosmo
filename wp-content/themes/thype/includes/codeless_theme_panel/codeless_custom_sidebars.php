<?php
/**
 * Option Page for adding custom sidebars
 *
 * @package Thype WordPress Theme
 * @subpackage Framework
 * @version 1.0.0 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'CodelessCustomSidebars' ) ) {

	class CodelessCustomSidebars {


		public function __construct() {

			// Create admin pages
			if ( is_admin() ) { 
				add_action( 'admin_menu', array( 'CodelessCustomSidebars', 'addPage' ), 10 );
				add_action( 'admin_init', array( 'CodelessCustomSidebars', 'registerOptions' ) );
				
			}
			add_action( 'admin_enqueue_scripts', array( 'CodelessCustomSidebars', 'scripts' ) );
		}

		public static function scripts( $hook ){
			if( $hook != 'codeless_page_codeless-panel-sidebars' )
				return;

			wp_enqueue_style( 'select2', get_template_directory_uri() . '/includes/codeless_theme_panel/assets/css/select2.min.css' );
			wp_enqueue_script( 'cl-select2', get_template_directory_uri() . '/includes/codeless_theme_panel/assets/js/select2.full.min.js' );
		}


		public static function addPage() {
			if( function_exists( 'codeless_add_submenu_page' ) )
				codeless_add_submenu_page(
					'codeless-panel',
					esc_html__( 'Custom Sidebars', 'thype' ),
					esc_html__( 'Custom Sidebars', 'thype' ),
					'administrator',
					'codeless-panel' . '-sidebars',
					array( 'CodelessCustomSidebars', 'createPage' )
				);
		}


		public static function registerOptions() {
			register_setting( 'codeless_custom_sidebars', 'codeless_custom_sidebars', array( 'CodelessCustomSidebars', 'admin_sanitize' ) ); 
		}


		public static function admin_sanitize( $options ) {

			foreach( $options as $key => $value ) {

				if ( ! empty( $value ) ) {
					set_theme_mod( 'codeless_custom_sidebars_' . $key, $value );
				} else {
					remove_theme_mod( 'codeless_custom_sidebars_' . $key );
				}
			}

			$options = '';
			return $options;

		}


		public static function createPage() {


			?>

			<div class="wrap">

				<h2><?php esc_html_e( 'Custom Sidebars', 'thype' ); ?></h2>

				<p><?php esc_html_e( 'In this Options Section you can define Custom Sidebars for pages, categories or a completely custom sidebar to be used on page builder (header or content).', 'thype' ); ?></p>


				

				<form method="post" action="options.php">
					<?php settings_fields( 'codeless_custom_sidebars' ); 
					?>
					<table class="form-table">
						

							<tr valign="top">
								
								<td>
									<label><?php esc_html_e('Custom Sidebar for pages:', 'thype') ?></label>
									<select class="codeless-multiple-select" name="codeless_custom_sidebars[pages][]" multiple="multiple">
									  <?php
									  $selected = codeless_get_custom_sidebar_pages();
									  
									  $pages = get_pages(); 
									  
									  foreach ( $pages as $page ) {
									  	$selected_c = '';
									  	if( isset($selected[$page->ID]) ){
									  		$selected_c = 'selected="selected"';
									  	}
									  	var_dump($selected_c);
									  	$option = '<option '.$selected_c.' value="' . $page->ID . '">';
										$option .= $page->post_title;
										$option .= '</option>';
										echo codeless_complex_esc( $option );
									  }
									  
									  ?>
									</select>

								</td>
							</tr>

							<tr valign="top">
								
								<td>
									<label><?php esc_html_e('Custom Sidebar for categories:', 'thype') ?></label>
									<select class="codeless-multiple-select" name="codeless_custom_sidebars[categories][]" multiple="multiple">
									  <?php
									  $selected = codeless_get_custom_sidebar_categories();
									  $categories = get_categories(); 
									  
									  foreach ( $categories as $category ) {
									  	$selected_c = '';
									  	if( isset($selected[$category->term_id]) ){
									  		$selected_c = 'selected="selected"';
									  	}

									  	$option = '<option  '.$selected_c.' value="' . $category->term_id . '">';
										$option .= $category->name;
										$option .= '</option>';
										echo codeless_complex_esc( $option );
									  }
									  
									  ?>
									</select>

								</td>
							</tr>

							
				
						
					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->

			<script>
				( function( $ ) {
					"use strict";

				
					$(".codeless-multiple-select").select2();

					

				
				} ) ( jQuery );

			</script>

			<style type="text/css">
				.select2-container{
					width:400px !important;
				}
			</style>

		<?php
		}

	}

	new CodelessCustomSidebars();

}