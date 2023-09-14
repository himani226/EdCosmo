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


if ( ! class_exists( 'CodelessModules' ) ) {

	class CodelessModules {


		public function __construct() {

			// Create admin pages
			if ( is_admin() ) { 
				add_action( 'admin_menu', array( 'CodelessModules', 'addPage' ), 10 );
				add_action( 'admin_init', array( 'CodelessModules', 'registerOptions' ) );
			}

		}


		public static function addPage() {
			if( function_exists( 'codeless_add_submenu_page' ) )
				codeless_add_submenu_page(
					'codeless-panel',
					esc_html__( 'Codeless Modules', 'thype' ),
					esc_html__( 'Codeless Modules', 'thype' ),
					'administrator',
					'codeless-panel' . '-modules',
					array( 'CodelessModules', 'createPage' )
				);
		}


		public static function registerOptions() {
			register_setting( 'codeless_modules', 'codeless_modules', array( 'CodelessModules', 'admin_sanitize' ) ); 
		}


		public static function admin_sanitize( $options ) {

			
			/*if ( ! is_array( $options ) || empty( $options ) || ( false === $options ) ) {
				return array();
			}*/

			
			$checkboxes = array('cl_custom_portfolio_overlay_color', 'cl_custom_header_boxed_per_page', 'cl_custom_header_background_per_page' );
		

			foreach ( $checkboxes as $checkbox ) {
				if ( isset( $options[$checkbox] ) && $options[$checkbox] ) {
					set_theme_mod( $checkbox, 1 );
				} else {
					set_theme_mod( $checkbox, 0 );
				}
			}
		

			$options = '';
			return $options;

		}


		public static function createPage() {


			?>

			<div class="wrap">

				<h2><?php esc_html_e( 'Modules', 'thype' ); ?></h2>

				<p><?php esc_html_e( 'In this Options Section you can define what modules you will use around Codeless Thype WordPress Theme.', 'thype' ); ?></p>
				

				<form method="post" action="options.php">
					<?php settings_fields( 'codeless_modules' ); ?>
					<table class="form-table">
						

							<tr valign="top">
								
								<td>
									<label>
										<input id="cl_custom_portfolio_overlay_color" type="checkbox" name="codeless_modules[cl_custom_portfolio_overlay_color]" <?php checked( codeless_get_mod( 'cl_custom_portfolio_overlay_color', false ) ); ?> />
											<?php esc_html_e( 'Individual Portfolio Overlay Color', 'thype' ); ?>
											<p class="description"><?php esc_html_e( 'By activating this module, a new option for each portfolio item will be created. From that moment you can add custom overlay color for each portfolio item.', 'thype' ); ?></p>
									</label>

								</td>
							</tr>

							<tr valign="top">
								
								<td>
									<label>
										<input id="cl_custom_header_boxed_per_page" type="checkbox" name="codeless_modules[cl_custom_header_boxed_per_page]" <?php checked( codeless_get_mod( 'cl_custom_header_boxed_per_page', false ) ); ?> />
											<?php esc_html_e( 'Custom Header Boxed Option for each page.', 'thype' ); ?>
											<p class="description"><?php esc_html_e( 'By activating this module, a new option for each page item will be created. From that moment you can active "header boxed" only for a specific page.', 'thype' ); ?></p>
									</label>

								</td>
							</tr>

							<tr valign="top">
								
								<td>
									<label>
										<input id="cl_custom_header_background_per_page" type="checkbox" name="codeless_modules[cl_custom_header_background_per_page]" <?php checked( codeless_get_mod( 'cl_custom_header_background_per_page', false ) ); ?> />
											<?php esc_html_e( 'Custom Header Background Option for each page.', 'thype' ); ?>
											<p class="description"><?php esc_html_e( 'By activating this module, a new option for each page item will be created. From that moment you can select "custom header background" for each page.', 'thype' ); ?></p>
									</label>

								</td>
							</tr>
				
						
					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->

		<?php
		}

	}

	new CodelessModules();

}