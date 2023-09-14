<div class="front_page_section front_page_section_about<?php
	$yolox_scheme = yolox_get_theme_option( 'front_page_about_scheme' );
	if ( ! yolox_is_inherit( $yolox_scheme ) ) {
		echo ' scheme_' . esc_attr( $yolox_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( yolox_get_theme_option( 'front_page_about_paddings' ) );
?>"
		<?php
		$yolox_css      = '';
		$yolox_bg_image = yolox_get_theme_option( 'front_page_about_bg_image' );
		if ( ! empty( $yolox_bg_image ) ) {
			$yolox_css .= 'background-image: url(' . esc_url( yolox_get_attachment_url( $yolox_bg_image ) ) . ');';
		}
		if ( ! empty( $yolox_css ) ) {
			echo ' style="' . esc_attr( $yolox_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$yolox_anchor_icon = yolox_get_theme_option( 'front_page_about_anchor_icon' );
	$yolox_anchor_text = yolox_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $yolox_anchor_icon ) || ! empty( $yolox_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $yolox_anchor_icon ) ? ' icon="' . esc_attr( $yolox_anchor_icon ) . '"' : '' )
									. ( ! empty( $yolox_anchor_text ) ? ' title="' . esc_attr( $yolox_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( yolox_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' yolox-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$yolox_css           = '';
			$yolox_bg_mask       = yolox_get_theme_option( 'front_page_about_bg_mask' );
			$yolox_bg_color_type = yolox_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $yolox_bg_color_type ) {
				$yolox_bg_color = yolox_get_theme_option( 'front_page_about_bg_color' );
			} elseif ( 'scheme_bg_color' == $yolox_bg_color_type ) {
				$yolox_bg_color = yolox_get_scheme_color( 'bg_color', $yolox_scheme );
			} else {
				$yolox_bg_color = '';
			}
			if ( ! empty( $yolox_bg_color ) && $yolox_bg_mask > 0 ) {
				$yolox_css .= 'background-color: ' . esc_attr(
					1 == $yolox_bg_mask ? $yolox_bg_color : yolox_hex2rgba( $yolox_bg_color, $yolox_bg_mask )
				) . ';';
			}
			if ( ! empty( $yolox_css ) ) {
				echo ' style="' . esc_attr( $yolox_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$yolox_caption = yolox_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $yolox_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $yolox_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $yolox_caption, 'yolox_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$yolox_description = yolox_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $yolox_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $yolox_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $yolox_description ), 'yolox_kses_content' ); ?></div>
				<?php
			}

			// Content
			$yolox_content = yolox_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $yolox_content ) ? 'filled' : 'empty'; ?>">
				<?php
					$yolox_page_content_mask = '%%CONTENT%%';
				if ( strpos( $yolox_content, $yolox_page_content_mask ) !== false ) {
					$yolox_content = preg_replace(
						'/(\<p\>\s*)?' . $yolox_page_content_mask . '(\s*\<\/p\>)/i',
						sprintf(
							'<div class="front_page_section_about_source">%s</div>',
							apply_filters( 'the_content', get_the_content() )
						),
						$yolox_content
					);
				}
					yolox_show_layout( $yolox_content );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
