<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.1
 */

$yolox_theme_obj = wp_get_theme();
?>
<div class="yolox_admin_notice yolox_welcome_notice update-nag">
	<?php
	// Theme image
	$yolox_theme_img = yolox_get_file_url( 'screenshot.jpg' );
	if ( '' != $yolox_theme_img ) {
		?>
		<div class="yolox_notice_image"><img src="<?php echo esc_url( $yolox_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'yolox' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="yolox_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'yolox' ),
				$yolox_theme_obj->name . ( YOLOX_THEME_FREE ? ' ' . __( 'Free', 'yolox' ) : '' ),
				$yolox_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="yolox_notice_text">
		<p class="yolox_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $yolox_theme_obj->description ) );
			?>
		</p>
		<p class="yolox_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'yolox' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="yolox_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=yolox_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'yolox' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="yolox_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="yolox_hide_notice_text"><?php esc_html_e( 'Dismiss', 'yolox' ); ?></span></a>
	</div>
</div>
