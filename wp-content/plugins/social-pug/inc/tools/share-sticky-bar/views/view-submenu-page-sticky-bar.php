<form method="post" action="options.php">
	<div class="dpsp-page-wrapper dpsp-page-sticky-bar wrap">

		<?php
			$dpsp_location_sticky_bar = Mediavine\Grow\Settings::get_setting( 'dpsp_location_sticky_bar', 'not_set' );
			settings_fields( 'dpsp_location_sticky_bar' );
		?>


		<!-- Page Title -->
		<h1 class="dpsp-page-title">
			<?php esc_html_e( 'Configure Sticky Bar Sharing Buttons', 'social-pug' ); ?>

			<input type="hidden" name="dpsp_buttons_location" value="dpsp_location_sticky_bar" />
			<input type="hidden" name="dpsp_location_sticky_bar[active]" value="<?php echo ( isset( $dpsp_location_sticky_bar['active'] ) ? 1 : '' ); ?>" <?php echo ( ! isset( $dpsp_location_sticky_bar['active'] ) ? 'disabled' : '' ); ?> />
		</h1>


		<!-- Networks Selectable and Sortable Panels -->
		<div id="dpsp-social-platforms-wrapper" class="dpsp-card">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Social Networks', 'social-pug' ); ?>
				<a id="dpsp-select-networks" class="dpsp-button-secondary" href="#"><?php esc_html_e( 'Select Networks', 'social-pug' ); ?></a>
			</div>

			<div id="dpsp-sortable-networks-empty" class="dpsp-card-inner <?php echo ( empty( $dpsp_location_sticky_bar['networks'] ) ? 'dpsp-active' : '' ); ?>">
				<p><?php esc_html_e( 'Select which social buttons to display', 'social-pug' ); ?></p>
			</div>

			<?php echo dpsp_output_sortable_networks( ( ! empty( $dpsp_location_sticky_bar['networks'] ) ? $dpsp_location_sticky_bar['networks'] : [] ), 'dpsp_location_sticky_bar' );  // @codingStandardsIgnoreLine — escaping is done in the function ?>

			<?php
				$available_networks = dpsp_get_networks();
				echo dpsp_output_selectable_networks( $available_networks, ( ! empty( $dpsp_location_sticky_bar['networks'] ) ? $dpsp_location_sticky_bar['networks'] : [] ) );  // @codingStandardsIgnoreLine — escaping is done in the function
			?>

		</div>


		<!-- General Display Settings -->
		<div class="dpsp-card">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Display Settings', 'social-pug' ); ?>
			</div>

			<div class="dpsp-card-inner">

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][shape]',
					( isset( $dpsp_location_sticky_bar['display']['shape'] ) ? $dpsp_location_sticky_bar['display']['shape'] : '' ),
					__( 'Button shape', 'social-pug' ),
					[
						'rectangular' => __( 'Rectangular', 'social-pug' ),
						'rounded'     => __( 'Rounded', 'social-pug' ),
						'circle'      => __(
							'Circle',
							'social-pug'
						),
					]
				);
?>

				<?php dpsp_settings_field( 'switch', 'dpsp_location_sticky_bar[display][icon_animation]', ( isset( $dpsp_location_sticky_bar['display']['icon_animation'] ) ? $dpsp_location_sticky_bar['display']['icon_animation'] : '' ), __( 'Show icon animation', 'social-pug' ), [ 'yes' ], __( 'Will animate the social media icon when the user hovers over the button.', 'social-pug' ) ); ?>

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][show_on_device]',
					( isset( $dpsp_location_sticky_bar['display']['show_on_device'] ) ? $dpsp_location_sticky_bar['display']['show_on_device'] : '' ),
					__( 'Show on device', 'social-pug' ),
					[
						'mobile'  => __( 'Mobile Only', 'social-pug' ),
						'desktop' => __( 'Desktop Only', 'social-pug' ),
						'all'     => __(
							'All Devices',
							'social-pug'
						),
					]
				);
?>

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][position_desktop]',
					( isset( $dpsp_location_sticky_bar['display']['position_desktop'] ) ? $dpsp_location_sticky_bar['display']['position_desktop'] : '' ),
					__( 'Desktop position', 'social-pug' ),
					[
						'top'    => __( 'Top', 'social-pug' ),
						'bottom' => __(
							'Bottom',
							'social-pug'
						),
					]
				);
?>

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][position_mobile]',
					( isset( $dpsp_location_sticky_bar['display']['position_mobile'] ) ? $dpsp_location_sticky_bar['display']['position_mobile'] : '' ),
					__( 'Mobile position', 'social-pug' ),
					[
						'top'    => __( 'Top', 'social-pug' ),
						'bottom' => __(
							'Bottom',
							'social-pug'
						),
					]
				);
?>

				<?php dpsp_settings_field( 'text', 'dpsp_location_sticky_bar[display][screen_size]', ( isset( $dpsp_location_sticky_bar['display']['screen_size'] ) ? $dpsp_location_sticky_bar['display']['screen_size'] : '' ), __( 'Mobile screen width (pixels)', 'social-pug' ), [], __( 'For screen widths smaller than this value ( in pixels ) the Mobile Sticky will be displayed on screen.', 'social-pug' ) ); ?>

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][intro_animation]',
					( isset( $dpsp_location_sticky_bar['display']['intro_animation'] ) ? $dpsp_location_sticky_bar['display']['intro_animation'] : '' ),
					__( 'Intro Animation', 'social-pug' ),
					[
						'-1' => __( 'No Animation', 'social-pug' ),
						'1'  => __( 'Fade In', 'social-pug' ),
						'2'  => __(
							'Slide In',
							'social-pug'
						),
					]
				);
?>

				<?php dpsp_settings_field( 'switch', 'dpsp_location_sticky_bar[display][show_after_scrolling]', ( isset( $dpsp_location_sticky_bar['display']['show_after_scrolling'] ) ? $dpsp_location_sticky_bar['display']['show_after_scrolling'] : '' ), __( 'Show after user scrolls', 'social-pug' ), [ 'yes' ] ); ?>

				<?php dpsp_settings_field( 'text', 'dpsp_location_sticky_bar[display][scroll_distance]', ( isset( $dpsp_location_sticky_bar['display']['scroll_distance'] ) ? $dpsp_location_sticky_bar['display']['scroll_distance'] : '' ), __( 'Scroll distance (%)', 'social-pug' ), [ '30' ], __( 'The distance in percentage (%) of the total page height the user has to scroll before the buttons will appear.', 'social-pug' ) ); ?>

			</div>

		</div>


		<!-- Share Counts -->
		<div class="dpsp-card">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Buttons Share Counts', 'social-pug' ); ?>
			</div>

			<div class="dpsp-card-inner">

				<?php dpsp_settings_field( 'switch', 'dpsp_location_sticky_bar[display][show_count]', ( isset( $dpsp_location_sticky_bar['display']['show_count'] ) ? $dpsp_location_sticky_bar['display']['show_count'] : '' ), __( 'Show share count', 'mediavine' ), [ 'yes' ], __( 'Display the share count for each social network.<br /><br />Please note: You may see a zero share count for Facebook if the share count is under 100 shares due to limitations with Facebook’s API.', 'mediavine' ) ); ?>

				<?php dpsp_settings_field( 'switch', 'dpsp_location_sticky_bar[display][show_count_total]', ( isset( $dpsp_location_sticky_bar['display']['show_count_total'] ) ? $dpsp_location_sticky_bar['display']['show_count_total'] : '' ), __( 'Show total share count', 'social-pug' ), [ 'yes' ], __( 'Display the share count for all social networks. Is available only when the buttons are displayed on a desktop.', 'social-pug' ) ); ?>

				<?php
				dpsp_settings_field(
					'select',
					'dpsp_location_sticky_bar[display][total_count_position]',
					( isset( $dpsp_location_sticky_bar['display']['total_count_position'] ) ? $dpsp_location_sticky_bar['display']['total_count_position'] : '' ),
					__( 'Total count position', 'social-pug' ),
					[
						'before' => __( 'Before Buttons', 'social-pug' ),
						'after'  => __(
							'After Buttons',
							'social-pug'
						),
					]
				);
?>

				<?php dpsp_settings_field( 'switch', 'dpsp_location_sticky_bar[display][count_round]', ( isset( $dpsp_location_sticky_bar['display']['count_round'] ) ? $dpsp_location_sticky_bar['display']['count_round'] : '' ), __( 'Share count round', 'social-pug' ), [ 'yes' ], __( 'If the share count for each network is bigger than 1000 it will be rounded to one decimal ( eg. 1267 will show as 1.2k ).', 'social-pug' ) ); ?>

				<?php dpsp_settings_field( 'text', 'dpsp_location_sticky_bar[display][minimum_count]', ( isset( $dpsp_location_sticky_bar['display']['minimum_count'] ) ? $dpsp_location_sticky_bar['display']['minimum_count'] : '' ), __( 'Minimum global share count', 'social-pug' ), [], __( 'Display share counts only if the total share count is higher than this value.', 'social-pug' ) ); ?>

				<?php dpsp_settings_field( 'text', 'dpsp_location_sticky_bar[display][minimum_individual_count]', ( isset( $dpsp_location_sticky_bar['display']['minimum_individual_count'] ) ? $dpsp_location_sticky_bar['display']['minimum_individual_count'] : '' ), __( 'Minimum individual share count', 'social-pug' ), [], __( 'Display share counts for an individual network only if the share count for that network is higher than this value.', 'social-pug' ) ); ?>

			</div>

		</div>


		<!-- Custom Colors Settings -->
		<div class="dpsp-card">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Buttons Custom Colors', 'social-pug' ); ?>
			</div>

			<div class="dpsp-card-inner">

				<?php dpsp_settings_field( 'color-picker', 'dpsp_location_sticky_bar[display][custom_color]', ( isset( $dpsp_location_sticky_bar['display']['custom_color'] ) ? $dpsp_location_sticky_bar['display']['custom_color'] : '' ), __( 'Buttons color', 'social-pug' ), [] ); ?>
				<?php dpsp_settings_field( 'color-picker', 'dpsp_location_sticky_bar[display][custom_hover_color]', ( isset( $dpsp_location_sticky_bar['display']['custom_hover_color'] ) ? $dpsp_location_sticky_bar['display']['custom_hover_color'] : '' ), __( 'Buttons hover color', 'social-pug' ), [] ); ?>
				<?php dpsp_settings_field( 'color-picker', 'dpsp_location_sticky_bar[display][custom_background_color]', ( isset( $dpsp_location_sticky_bar['display']['custom_background_color'] ) ? $dpsp_location_sticky_bar['display']['custom_background_color'] : '' ), __( 'Bar background color', 'social-pug' ), [] ); ?>

			</div>

		</div>


		<!-- Post Type Display Settings -->
		<div class="dpsp-card">

			<div class="dpsp-card-header">
				<?php esc_html_e( 'Post Type Display Settings', 'social-pug' ); ?>
			</div>

			<div class="dpsp-card-inner">

				<?php dpsp_settings_field( 'checkbox', 'dpsp_location_sticky_bar[post_type_display][]', ( isset( $dpsp_location_sticky_bar['post_type_display'] ) ? $dpsp_location_sticky_bar['post_type_display'] : [] ), '', dpsp_get_post_types() ); ?>

			</div>

		</div>


		<!-- Save Changes Button -->
		<input type="hidden" name="action" value="update" />
		<p class="submit"><input type="submit" class="dpsp-button-primary" value="<?php esc_html_e( 'Save Changes' ); ?>" /></p>

	</div>
</form>
