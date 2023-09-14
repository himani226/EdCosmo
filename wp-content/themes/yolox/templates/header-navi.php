<?php
/**
 * The template to display the main menu
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */
?>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_fixed sc_layouts_row_fixed_always sc_layouts_row_delimiter
	<?php
	if ( yolox_is_on( yolox_get_theme_option( 'header_mobile_enabled' ) ) ) {
		?>
		sc_layouts_hide_on_mobile
		<?php
	}
	?>
">
	<div class="content_wrap">
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_4">
				<div class="sc_layouts_item">
					<?php
					// Logo
					get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-logo' ) );
					?>
				</div>
			</div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left sc_layouts_column_fluid column-3_4">
				<div class="sc_layouts_item">
					<?php
					// Main menu
					$yolox_menu_main = yolox_get_nav_menu(
						array(
							'location' => 'menu_main',
							'class'    => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile',
						)
					);
					// Show any menu if no menu selected in the location 'menu_main'
					if ( yolox_get_theme_setting( 'autoselect_menu' ) && empty( $yolox_menu_main ) ) {
						$yolox_menu_main = yolox_get_nav_menu(
							array(
								'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile',
							)
						);
					}
					yolox_show_layout( $yolox_menu_main );
					// Mobile menu button
					?>
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div>
				<?php
				if ( yolox_exists_trx_addons() ) {
					?>
					<div class="sc_layouts_item">
						<?php
						// Display search field
						do_action( 'yolox_action_search', 'fullscreen', 'header_search', false );
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div><!-- /.columns_wrap -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->
