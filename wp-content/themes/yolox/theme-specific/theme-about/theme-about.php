<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if ( ! function_exists( 'yolox_about_after_switch_theme' ) ) {
	add_action( 'after_switch_theme', 'yolox_about_after_switch_theme', 1000 );
	function yolox_about_after_switch_theme() {
		update_option( 'yolox_about_page', 1 );
	}
}
if ( ! function_exists( 'yolox_about_after_setup_theme' ) ) {
	add_action( 'init', 'yolox_about_after_setup_theme', 1000 );
	function yolox_about_after_setup_theme() {
		if ( ! defined( 'WP_CLI' ) && get_option( 'yolox_about_page' ) == 1 ) {
			update_option( 'yolox_about_page', 0 );
			wp_safe_redirect( admin_url() . 'themes.php?page=yolox_about' );
			exit();
		} else {
			if ( yolox_get_value_gp( 'page' ) == 'yolox_about' && yolox_exists_trx_addons() ) {
				wp_safe_redirect( admin_url() . 'admin.php?page=trx_addons_theme_panel' );
				exit();
			}
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if ( ! function_exists( 'yolox_about_add_menu_items' ) ) {
	add_action( 'admin_menu', 'yolox_about_add_menu_items' );
	function yolox_about_add_menu_items() {
		if ( ! yolox_exists_trx_addons() ) {
			$theme      = wp_get_theme();
			$theme_name = $theme->name . ( YOLOX_THEME_FREE ? ' ' . esc_html__( 'Free', 'yolox' ) : '' );
			add_theme_page(
				// Translators: Add theme name to the page title
				sprintf( esc_html__( 'About %s', 'yolox' ), $theme_name ),    
				// Translators: Add theme name to the menu title
				sprintf( esc_html__( 'About %s', 'yolox' ), $theme_name ),    
				'manage_options',                                               
				'yolox_about',                                                
				'yolox_about_page_builder'
			);
		}
	}
}


// Load page-specific scripts and styles
if ( ! function_exists( 'yolox_about_enqueue_scripts' ) ) {
	add_action( 'admin_enqueue_scripts', 'yolox_about_enqueue_scripts' );
	function yolox_about_enqueue_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos( $screen->id, '_page_yolox_about' ) ) {
			// Scripts
			if ( ! yolox_exists_trx_addons() && function_exists( 'yolox_plugins_installer_enqueue_scripts' ) ) {
				yolox_plugins_installer_enqueue_scripts();
			}
			// Styles
			$fdir = yolox_get_file_url( 'theme-specific/theme-about/theme-about.css' );
			if ( '' != $fdir ) {
				wp_enqueue_style( 'yolox-about', $fdir, array(), null );
			}
		}
	}
}


// Build 'About Theme' page
if ( ! function_exists( 'yolox_about_page_builder' ) ) {
	function yolox_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="yolox_about">

			<?php do_action( 'yolox_action_theme_about_start', $theme ); ?>

			<?php do_action( 'yolox_action_theme_about_before_logo', $theme ); ?>

			<div class="yolox_about_logo">
				<?php
				$logo = yolox_get_file_url( 'theme-specific/theme-about/icon.jpg' );
				if ( empty( $logo ) ) {
					$logo = yolox_get_file_url( 'screenshot.jpg' );
				}
				if ( ! empty( $logo ) ) {
					?>
					<img src="<?php echo esc_url( $logo ); ?>">
					<?php
				}
				?>
			</div>

			<?php do_action( 'yolox_action_theme_about_before_title', $theme ); ?>

			<h1 class="yolox_about_title">
			<?php
				echo esc_html(
					sprintf(
						// Translators: Add theme name and version to the 'Welcome' message
						__( 'Welcome to %1$s %2$s v.%3$s', 'yolox' ),
						$theme->name,
						YOLOX_THEME_FREE ? __( 'Free', 'yolox' ) : '',
						$theme->version
					)
				);
			?>
			</h1>

			<?php do_action( 'yolox_action_theme_about_before_description', $theme ); ?>

			<div class="yolox_about_description">
				<p>
					<?php
					echo wp_kses_data( __( 'In order to continue, please install and activate the <b>ThemeREX Addons plugin</b>', 'yolox' ) );
					?>
					<sup>*</sup>
				</p>
			</div>

			<?php do_action( 'yolox_action_theme_about_before_buttons', $theme ); ?>

			<div class="yolox_about_buttons">
				<?php yolox_plugins_installer_get_button_html( 'trx_addons' ); ?>
			</div>

			<?php do_action( 'yolox_action_theme_about_before_buttons', $theme ); ?>

			<div class="yolox_about_notes">
				<p>
					<sup>*</sup>
					<?php
					echo wp_kses_data( __( "<i>ThemeREX Addons plugin</i> will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'yolox' ) );
					?>
				</p>
			</div>

			<?php do_action( 'yolox_action_theme_about_end', $theme ); ?>

		</div>
		<?php
	}
}


// Hide TGMPA notice on the page 'About Theme'
if ( ! function_exists( 'yolox_about_page_disable_tgmpa_notice' ) ) {
	add_filter( 'tgmpa_show_admin_notice_capability', 'yolox_about_page_disable_tgmpa_notice' );
	function yolox_about_page_disable_tgmpa_notice($cap) {
		if ( yolox_get_value_gp( 'page' ) == 'yolox_about' ) {
			$cap = 'unfiltered_upload';
		}
		return $cap;
	}
}

require_once YOLOX_THEME_DIR . 'includes/plugins-installer/plugins-installer.php';
