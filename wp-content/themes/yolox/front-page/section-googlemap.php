<div class="front_page_section front_page_section_googlemap<?php
	$yolox_scheme = yolox_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! yolox_is_inherit( $yolox_scheme ) ) {
		echo ' scheme_' . esc_attr( $yolox_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( yolox_get_theme_option( 'front_page_googlemap_paddings' ) );
?>"
		<?php
		$yolox_css      = '';
		$yolox_bg_image = yolox_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$yolox_anchor_icon = yolox_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$yolox_anchor_text = yolox_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $yolox_anchor_icon ) || ! empty( $yolox_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $yolox_anchor_icon ) ? ' icon="' . esc_attr( $yolox_anchor_icon ) . '"' : '' )
									. ( ! empty( $yolox_anchor_text ) ? ' title="' . esc_attr( $yolox_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
	<?php
	if ( yolox_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
		echo ' yolox-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$yolox_css      = '';
			$yolox_bg_mask  = yolox_get_theme_option( 'front_page_googlemap_bg_mask' );
			$yolox_bg_color_type = yolox_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $yolox_bg_color_type ) {
				$yolox_bg_color = yolox_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
			$yolox_layout = yolox_get_theme_option( 'front_page_googlemap_layout' );
		if ( 'fullwidth' != $yolox_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$yolox_caption     = yolox_get_theme_option( 'front_page_googlemap_caption' );
			$yolox_description = yolox_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $yolox_caption ) || ! empty( $yolox_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $yolox_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $yolox_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $yolox_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $yolox_caption, 'yolox_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $yolox_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $yolox_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $yolox_description ), 'yolox_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $yolox_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$yolox_content = yolox_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $yolox_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $yolox_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $yolox_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $yolox_content, 'yolox_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $yolox_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $yolox_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
			<?php
			if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
				dynamic_sidebar( 'front_page_googlemap_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! yolox_exists_trx_addons() ) {
					yolox_customizer_need_trx_addons_message();
				} else {
					yolox_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
				}
			}
			?>
			</div>
			<?php

			if ( 'columns' == $yolox_layout && ( ! empty( $yolox_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
