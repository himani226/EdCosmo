<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( yolox_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php do_action( 'yolox_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$yolox_header_type = yolox_get_theme_option( 'header_type' );
			if ( 'custom' == $yolox_header_type && ! yolox_is_layouts_available() ) {
				$yolox_header_type = 'default';
			}
			get_template_part( apply_filters( 'yolox_filter_get_template_part', "templates/header-{$yolox_header_type}" ) );

			// Side menu
			if ( in_array( yolox_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-navi-mobile' ) );
			
			// Single posts banner after header
			yolox_show_post_banner( 'header' );
			?>

			<div class="page_content_wrap">
				<?php
				// Single posts banner on the background
				if ( is_singular( 'post' ) ) {

					yolox_show_post_banner( 'background' );

					$yolox_post_thumbnail_type  = yolox_get_theme_option( 'post_thumbnail_type' );
					$yolox_post_header_position = yolox_get_theme_option( 'post_header_position' );
					$yolox_post_header_align    = yolox_get_theme_option( 'post_header_align' );

					// Boxed post thumbnail
					if ( in_array( $yolox_post_thumbnail_type, array( 'boxed', 'fullwidth') ) ) {
						?>
						<div class="header_content_wrap header_align_<?php echo esc_attr( $yolox_post_header_align ); ?>">
							<?php
							if ( 'boxed' === $yolox_post_thumbnail_type ) {
								?>
								<div class="content_wrap">
								<?php
							}

                                // Post title and meta
                                if ( 'above' === $yolox_post_header_position ) {
                                    yolox_show_post_title_and_meta_custom();
                                }
                                   if ( 'default' === $yolox_post_header_position  ) {
                                       yolox_show_post_title_and_meta_custom();
                                   }
                                // Featured image
                                yolox_show_post_featured_image();

							if ( 'boxed' === $yolox_post_thumbnail_type ) {
								?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
				}

				if ( 'fullscreen' != yolox_get_theme_option( 'body_style' ) ) {
					?>
					<div class="content_wrap">
						<?php
				}

				// Widgets area above page content
				yolox_create_widgets_area( 'widgets_above_page' );
				?>

				<div class="content">
					<?php
					// Widgets area inside page content
					yolox_create_widgets_area( 'widgets_above_content' );
