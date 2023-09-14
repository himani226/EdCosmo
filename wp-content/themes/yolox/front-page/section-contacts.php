<div class="front_page_section front_page_section_contacts<?php
	$yolox_scheme = yolox_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! yolox_is_inherit( $yolox_scheme ) ) {
		echo ' scheme_' . esc_attr( $yolox_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( yolox_get_theme_option( 'front_page_contacts_paddings' ) );
?>"
		<?php
		$yolox_css      = '';
		$yolox_bg_image = yolox_get_theme_option( 'front_page_contacts_bg_image' );
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
	$yolox_anchor_icon = yolox_get_theme_option( 'front_page_contacts_anchor_icon' );
	$yolox_anchor_text = yolox_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $yolox_anchor_icon ) || ! empty( $yolox_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $yolox_anchor_icon ) ? ' icon="' . esc_attr( $yolox_anchor_icon ) . '"' : '' )
									. ( ! empty( $yolox_anchor_text ) ? ' title="' . esc_attr( $yolox_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( yolox_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' yolox-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$yolox_css      = '';
			$yolox_bg_mask  = yolox_get_theme_option( 'front_page_contacts_bg_mask' );
			$yolox_bg_color_type = yolox_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $yolox_bg_color_type ) {
				$yolox_bg_color = yolox_get_theme_option( 'front_page_contacts_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$yolox_caption     = yolox_get_theme_option( 'front_page_contacts_caption' );
			$yolox_description = yolox_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $yolox_caption ) || ! empty( $yolox_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $yolox_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $yolox_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $yolox_caption, 'yolox_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $yolox_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $yolox_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $yolox_description ), 'yolox_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$yolox_content = yolox_get_theme_option( 'front_page_contacts_content' );
			$yolox_layout  = yolox_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $yolox_layout && ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $yolox_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $yolox_content, 'yolox_kses_content' );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $yolox_layout && ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$yolox_sc = yolox_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $yolox_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $yolox_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					yolox_show_layout( do_shortcode( $yolox_sc ) );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $yolox_layout && ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
