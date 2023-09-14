<?php
/**
 * Option Page for adding custom image sizes from user.
 *
 * @package Thype WordPress Theme
 * @subpackage Framework
 * @version 1.0.0 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'CodelessImageSizes' ) ) {

	class CodelessImageSizes {


		public function __construct() {

			// Add Images
			add_action( 'init', array( 'CodelessImageSizes', 'addSizes' ), 0 );

			// Remove the WP functionality of Image auto crop
			if ( codeless_get_mod( 'optimize_image_resizing', true ) ) {
				add_filter( 'intermediate_image_sizes_advanced', array( 'CodelessImageSizes', 'removeWpCrop' ) );
			}

			// Create admin pages
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'CodelessImageSizes', 'addPage' ), 10 );
				add_action( 'admin_init', array( 'CodelessImageSizes', 'registerOptions' ) );
			}

		}


		public static function getSizes() {
			return apply_filters( 'codeless_image_sizes', array(
				
			
			) );
		}


		public static function removeWpCrop( $sizes ) {

			// Get sizes
			$default_sizes = self::getSizes();

			if ( ! empty ( $default_sizes ) ) {
				foreach( $default_sizes as $size => $args ) {
					unset( $sizes[$size] );
				}
			}

			return $sizes;

		}


		public static function addSizes() {
			

			$sizes = self::getSizes();


			foreach ( $sizes as $size => $args ) {



				$defaults       = ! empty( $args['defaults'] ) ? $args['defaults'] : '';
				$default_width  = isset( $defaults['width'] ) ? $defaults['width'] : '9999';
				$default_height = isset( $defaults['height'] ) ? $defaults['height'] : '9999';
				$default_crop   = isset( $defaults['crop'] ) ? $defaults['crop'] : 'center-center';


				$width  = codeless_get_mod( $args['width'], $default_width );
				$height = codeless_get_mod( $args['height'], $default_height );
				$crop   = codeless_get_mod( $args['crop'], $default_crop  );
				$crop   = $crop ? $crop : 'center-center';

				$crop = ( 'center-center' == $crop ) ? 1 : explode( '-', $crop );

				if ( $width || $height ) {
					add_image_size( $size, $width, $height, $crop );
				}

				

			}

		}

		public static function addPage() {
			if( function_exists( 'codeless_add_submenu_page' ) )
				codeless_add_submenu_page(
					'codeless-panel',
					esc_html__( 'Image Sizes', 'thype' ),
					esc_html__( 'Image Sizes', 'thype' ),
					'administrator',
					'codeless-panel' . '-image-sizes',
					array( 'CodelessImageSizes', 'createPage' )
				);
		}


		public static function registerOptions() {
			register_setting( 'codeless_image_sizes', 'codeless_image_sizes', array( 'CodelessImageSizes', 'admin_sanitize' ) ); 
		}


		public static function admin_sanitize( $options ) {


			if ( ! is_array( $options ) || empty( $options ) || ( false === $options ) ) {
				return array();
			}


			$checkboxes = array('optimize_image_resizing' );
			$custom_img_sizes = array('cl_custom_img_sizes' );


			foreach ( $checkboxes as $checkbox ) {
				if ( isset( $options[$checkbox] ) ) {
					set_theme_mod( $checkbox, 1 );
				} else {
					set_theme_mod( $checkbox, 0 );
				}
			}

			foreach( $options as $key => $value ) {
				if ( in_array( $key, $checkboxes ) ) {
					continue; 
				}
				if ( in_array( $key, $custom_img_sizes ) ) {
					continue; 
				}
				if ( ! empty( $value ) ) {
					set_theme_mod( $key, $value );
				} else {
					remove_theme_mod( $key );
				}
			}
			
			if( !empty($options['cl_custom_img_sizes']) ){
				$value = get_theme_mod( 'cl_custom_img_sizes' );

				if( ! is_array($value) )
					$value = array();

				$value[] = $options['cl_custom_img_sizes'];

				set_theme_mod( 'cl_custom_img_sizes', $value );
			}		

			$options = '';
			return $options;

		}


		public static function createPage() {


			$sizes          = self::getSizes();
			$crop_positions = codeless_image_crop_positions(); ?>

			<div class="wrap">

				<h2><?php esc_html_e( 'Image Sizes', 'thype' ); ?></h2>

				<p><?php esc_html_e( 'In this Options Section you can define all image sizes of site. Leave the width and height empty to display the full image. Leave empty the height attribute to disable the crop.', 'thype' ); ?></p>
				
				<h2 class="nav-tab-wrapper codeless-image-sizes-admin-tabs" style="margin-top:20px;">
					<?php

					$tabs = apply_filters( 'codeless_image_sizes_tabs', array(
						'general' => esc_html__( 'General', 'thype' ),
						'blog'    => esc_html__( 'Blog', 'thype' ),
						'portfolio'    => esc_html__( 'Portfolio', 'thype' ),
						'team'    => esc_html__( 'Team', 'thype' ),
					) );

					
					$tabs['other'] = esc_html__( 'Other', 'thype' );

					$count = '';

					$cl_custom_img_sizes = codeless_get_mod('cl_custom_img_sizes', array() );

					foreach ( $tabs as $key => $val ) {
						$count ++;
						$classes = 'nav-tab';
						if ( 1 == $count ) {
							$classes .=' nav-tab-active';
						}

						if( $key != 'other' )
							echo '<a href="#'. esc_attr( $key ) .'" class="'. esc_attr( $classes ) .'">'. esc_html( $val ) .'</a>';
						else if( $key == 'other' && !empty( $cl_custom_img_sizes ) )
							echo '<a href="#'. esc_attr( $key ) .'" class="'. esc_attr( $classes ) .'">'. esc_html( $val ) .'</a>';

					} ?>
				</h2>

				<form method="post" action="options.php">
					<?php settings_fields( 'codeless_image_sizes' ); ?>
					<table class="form-table codeless-image-sizes-admin-table">
						<tr valign="top" data-codeless-section="general">
							<th scope="row"><?php esc_html_e( 'Image Resizing', 'thype' ); ?></th>
							<td>
								<fieldset>
									<label>
										<input id="codeless_optimize_image_resizing" type="checkbox" name="codeless_image_sizes[optimize_image_resizing]" <?php checked( codeless_get_mod( 'optimize_image_resizing', true ) ); ?>>
											<?php esc_html_e( 'Optimized Image Sizes', 'thype' ); ?>
											<p class="description"><?php esc_html_e( 'Codeless Theme has the ability to create only the needed thumbnails. For ex, if you add a blog featured image, it will not create automatically all image sizes, it will create only the blog featured image size. Disable this feature if you use CDN. If you disable this feature you need to regenerate thumbnails.', 'thype' ); ?></p>
									</label>
								</fieldset>
							</td>
						</tr>

						<tr valign="top" data-codeless-section="general">
							<th scope="row"><?php esc_html_e( 'Add Custom Size', 'thype' ); ?></th>
							<td>
								<fieldset>
									<label>
										<input id="cl_custom_img_sizes" type="text" name="codeless_image_sizes[cl_custom_img_sizes]" value="">
									
											<p class="description"><?php esc_html_e( 'Here you can add a new id for a custom image size. You can edit width, height after Save. The new size will be shown at Other Section. After setting the new image size you can use it over your webpage.', 'thype' ); ?></p>
									</label>
								</fieldset>
							</td>
						</tr>
						
						

						<?php
						
						foreach ( $sizes as $size => $args ) : ?>

							<?php
						
							extract( $args );

					
							if ( ! $label ) {
								continue;
							}

						
							$section = isset( $args['section'] ) ? $args['section'] : 'other';

						
							$defaults       = ! empty( $args['defaults'] ) ? $args['defaults'] : '';
							$default_width  = isset( $defaults['width'] ) ? $defaults['width'] : null;
							$default_height = isset( $defaults['height'] ) ? $defaults['height'] : null;
							$default_crop   = isset( $defaults['crop'] ) ? $defaults['crop'] : null;

						
							$width_value  = codeless_get_mod( $width, $default_width );
							$height_value = codeless_get_mod( $height, $default_height );
							$crop_value   = codeless_get_mod( $crop, $default_crop ); ?>

							<tr valign="top" data-codeless-section="<?php echo esc_attr( $section ); ?>" style="display:none;">
								<th scope="row"><?php echo strip_tags( $label ); ?><p style="color:#999;"><?php echo strip_tags( $description ); ?></p></th>
								<td>
									<label for="<?php echo esc_attr( $width ); ?>"><?php esc_html_e( 'Width', 'thype' ); ?></label>
									<input name="codeless_image_sizes[<?php echo esc_attr( $width ); ?>]" type="number" step="1" min="0" value="<?php echo esc_attr( $width_value ); ?>" class="small-text" />

									<label for="<?php echo esc_attr( $height ); ?>"><?php esc_html_e( 'Height', 'thype' ); ?></label>
									<input name="codeless_image_sizes[<?php echo esc_attr( $height ); ?>]" type="number" step="1" min="0" value="<?php echo esc_attr( $height_value ); ?>" class="small-text" />
									<label for="<?php echo esc_attr( $crop ); ?>"><?php esc_html_e( 'Crop Location', 'thype' ); ?></label>

									<select name="codeless_image_sizes[<?php echo esc_attr( $crop ); ?>]">
										<?php foreach ( $crop_positions as $key => $label ) { ?>
											<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $crop_value, true ); ?>><?php echo strip_tags( $label ); ?></option>
										<?php } ?>
									</select>

								</td>
							</tr>

						<?php endforeach; ?>

						<tr valign="top" data-codeless-section="other" style="display:none;">
								<p>Here will show all custom image sizes added by you. Please add a new custom image size at General Section.</p>
							</tr>
						
					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->

			<script>
				( function( $ ) {
					"use strict";

				
					$( '.codeless-image-sizes-admin-tabs a' ).on( 'click', function() {
						$( '.codeless-image-sizes-admin-tabs a' ).removeClass( 'nav-tab-active' );
						$(this).addClass( 'nav-tab-active' );
						var $hash = $( this ).attr( 'href' ).substring(1);
						$( '.codeless-image-sizes-admin-table tr' ).hide();
						$( '[data-codeless-section="'+ $hash +'"]' ).show();
						return false;
					} );

					

				
				} ) ( jQuery );

			</script>
		<?php
		}

	}

	new CodelessImageSizes();

}