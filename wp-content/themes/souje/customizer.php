<?php
/* Customize Appearance Options */
if ( !function_exists( 'souje_customizer' ) ) {
	function souje_customizer( $wp_customize ) {

		/* Font Selector */
		class souje_font_selector extends WP_Customize_Control {

			public $type = 'select';

			public function render_content() { ?>

				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
					<select <?php $this->link(); ?>>
                    	<?php
						foreach ( souje_font_labels() as $key => $val ) {
							$add_underscore = str_replace( ' ', '_', $key ); ?>
							<option value="<?php echo esc_attr( $add_underscore ); ?>" <?php if( $this->value() == $add_underscore ) echo 'selected="selected"'; ?>><?php echo esc_attr( $key ); ?></option>
						<?php } ?>
					</select>
				</label>

			<?php }

		}
		/* */

		/* Radio Selector */
		class souje_radio_selector extends WP_Customize_Control {

			public $type = 'radio-image';

			public function render_content() { ?>

				<div id="<?php echo esc_attr( "input_{$this->id}" ); ?>" class="radio-selector-container">
					<span class="radio-selector-label"><?php echo esc_html( $this->label ); ?></span><br />
					<?php foreach ( $this->choices as $val => $args ) : ?>
					<input type="radio" value="<?php echo esc_attr( $val ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>" id="<?php echo esc_attr( "{$this->id}-{$val}" ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $val ); ?> />
					<label for="<?php echo esc_attr( "{$this->id}-{$val}" ); ?>"><img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" /></label>
					<?php endforeach; ?>
				</div>

			<?php }

		}
		/* */

		/* Sanitizers */
		function souje_get_font_list() {
			$font_list = array();
			foreach ( souje_font_labels() as $key => $val ) {
				$add_underscore = str_replace( ' ', '_', $key );
				$font_list[] = esc_attr( $add_underscore );
			}
			return $font_list;
		}

		function souje_sanitize_select( $input ) {
			$current_font_list = souje_get_font_list();
      return ( in_array( $input, $current_font_list ) ? $input : 'null' );
		}

		function souje_sanitize_file( $file, $setting ) {
      $mimes = array(
          'jpg|jpeg|jpe' => 'image/jpeg',
          'gif'          => 'image/gif',
          'png'          => 'image/png'
      );
      $file_ext = wp_check_filetype( $file, $mimes );
      return ( $file_ext['ext'] ? $file : $setting->default );
    }

		function souje_sanitize_null( $input ) {
			return 0;
		}

		function souje_sanitize_let_html( $input ) {
			return force_balance_tags( wp_kses_post( $input ) );
		}

		function souje_sanitize_checkbox( $input ) {
			if ( $input == 1 ) {
				return 1;
			} else {
				return '';
			}
		}

		function souje_sanitize_choices( $input, $setting ) {
			global $wp_customize;
			$control = $wp_customize->get_control( $setting->id );
			if ( array_key_exists( $input, $control->choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}

		function souje_sanitize_integer( $input ) {
			if( is_numeric( $input ) ) {
				return intval( $input );
			}
		}
		/* */

		/* Customizer Styles */
		function souje_print_styles() { ?>

			<style type="text/css">
				.radio-selector-label { font-weight: 500; font-size: 14px; }
				.radio-selector-container label { display: inline-block; cursor: pointer; margin: 7px 5px 0 0; }
				.radio-selector-container label img { border: 2px solid #EEE; }
				.radio-selector-container input[type="radio"] { position: absolute; left: -9999px; }
				.radio-selector-container input[type="radio"]:checked + label img { border: 2px solid #333; }
			</style>

		<?php }
		add_action( 'customize_controls_print_styles', 'souje_print_styles' );
		/* */

		/* Allowed HTML */
		$souje_allowed_html = array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'span' => array(
				'class' => array(),
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		);
		/* */

		////////////////////////////////////////////////////
		/*/////////////////// SECTIONS ///////////////////*/
		////////////////////////////////////////////////////

		$wp_customize->add_section( 'souje_section_posts', array( 'title' => esc_html__( '1. Post & Page Settings', 'souje' ), 'priority' => 0, ) );
		$wp_customize->add_section( 'souje_section_fonts', array( 'title' => esc_html__( '2. Font Settings', 'souje' ), 'priority' => 1, ) );
		$wp_customize->add_section( 'souje_section_colors', array( 'title' => esc_html__( '3. Colors', 'souje' ), 'priority' => 2, ) );
		$wp_customize->add_section( 'souje_section_header', array( 'title' => esc_html__( '4. Header', 'souje' ), 'priority' => 3, ) );
		$wp_customize->add_section( 'souje_section_slider', array( 'title' => esc_html__( '5. Slider Settings', 'souje' ), 'priority' => 4, ) );
		$wp_customize->add_section( 'souje_section_layout', array( 'title' => esc_html__( '6. Layout Options', 'souje' ), 'priority' => 5, ) );
		$wp_customize->add_section( 'souje_section_footer', array( 'title' => esc_html__( '7. Footer', 'souje' ), 'priority' => 6, ) );
		$wp_customize->add_section( 'souje_section_social', array( 'title' => esc_html__( '8. Social Accounts', 'souje' ), 'description' => wp_kses( __( 'Write the entire URL addresses.<br>Leave blank if not preferred.', 'souje' ), $souje_allowed_html ), 'priority' => 7, ) );
		$wp_customize->add_section( 'souje_section_maps', array( 'title' => esc_html__( '9. Google Maps', 'souje' ), 'priority' => 8, ) );
		$wp_customize->add_section( 'souje_section_translation', array( 'title' => esc_html__( '10. Translation', 'souje' ), 'priority' => 9, ) );
		$wp_customize->add_section( 'souje_section_woocommerce', array( 'title' => esc_html__( '11. WooCommerce', 'souje' ), 'priority' => 10, ) );

		////////////////////////////////////////////////////
		/*/////////////////// SETTINGS ///////////////////*/
		////////////////////////////////////////////////////

		/* Post & Page Settings */
		$wp_customize->add_setting( 'souje_featured_image_width', array( 'default' => 1140, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_featured_image_height', array( 'default' => 760, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_thumbnail_image_width', array( 'default' => 600, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_thumbnail_image_height', array( 'default' => 400, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_note_post_image', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_title_standard_posts', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_featured_image_standard', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_featured_image_gallery', array( 'default' => 'gal', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_gallery_position', array( 'default' => 'content', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_featured_image_video', array( 'default' => 'vid', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_related_post_base', array( 'default' => 'tag', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_related_post_count', array( 'default' => 2, 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_hidden_cats', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_hidden_posts', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_note_separate_ids', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_title_show_hide_elements', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_show_date', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_date_indexed', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_comments_icon', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_comments_icon_indexed', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_author', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_author_indexed', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_excerpt_indexed', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_read_more', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_categories', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_categories_indexed', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_share', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_author_box', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_related_posts', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_post_comments', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_share_page', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_page_comments', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_filter', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_filter_word', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_widget_date', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		/* */

		/* Font Settings */
		$wp_customize->add_setting( 'souje_note_google_fonts', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_font_primary', array( 'default' => 'Poppins', 'sanitize_callback' => 'souje_sanitize_select' ) );
		$wp_customize->add_setting( 'souje_font_secondary', array( 'default' => 'PT_Serif', 'sanitize_callback' => 'souje_sanitize_select' ) );
		$wp_customize->add_setting( 'souje_font_size_menu_item', array( 'default' => 14, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_font_size_post_title', array( 'default' => 60, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_font_size_post_title_mobile', array( 'default' => 40, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_font_size_post_content', array( 'default' => 16, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_font_size_widget_title', array( 'default' => 30, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_font_size_widget_post_title', array( 'default' => 13, 'sanitize_callback' => 'souje_sanitize_integer' ) );

		/* Colors */
		foreach ( souje_get_colors() as $key => $val ) {

			$the_color = 'souje_color' . esc_attr( $key );
			$label = '';
			$description = ucwords( str_replace( '_', ' ', esc_attr( $key ) ) );

			if ( $key == '_background' ) { $label = esc_html__( '3.1. General Colors', 'souje' ); }
			if ( $key == '_logo_text' ) { $label = esc_html__( '3.2. Header Colors', 'souje' ); }
			if ( $key == '_slider_primary' ) { $label = esc_html__( '3.3. Slider Colors', 'souje' ); }
			if ( $key == '_post_background' ) { $label = esc_html__( '3.4. Post Colors', 'souje' ); }
			if ( $key == '_widget_background' ) { $label = esc_html__( '3.5. Widget Colors', 'souje' ); }
			if ( $key == '_footer_background' ) { $label = esc_html__( '3.6. Footer Colors', 'souje' ); }

			$wp_customize->add_setting( $the_color, array( 'default' => $val, 'sanitize_callback' => 'sanitize_hex_color' ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $the_color,
				array(
					'label' => $label,
					'description' => esc_html( $description ),
					'section' => 'souje_section_colors',
					'settings' => $the_color,
				)
			) );

			if ( $key == '_logo_background' ) {

				$wp_customize->add_setting( 'souje_ignore_logo_background', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );

				$wp_customize->add_control( 'souje_ignore_logo_background', array(
					'label' => esc_html__( 'Ignore Logo Background Color', 'souje' ),
					'section' => 'souje_section_colors',
					'settings' => 'souje_ignore_logo_background',
					'type' => 'checkbox'
				) );

			}

		}
		/* */

		/* Header */
		$wp_customize->add_setting( 'souje_header_style', array( 'default' => 'lefted_mright_fboxed', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_font_logotype', array( 'default' => 'Montserrat_Alternates', 'sanitize_callback' => 'souje_sanitize_select' ) );
		$wp_customize->add_setting( 'souje_font_size_logo', array( 'default' => 30, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_logo_image', array( 'sanitize_callback' => 'souje_sanitize_file' ) );
		$wp_customize->add_setting( 'souje_max_logo_height', array( 'default' => 40, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_mobile_logo_image', array( 'sanitize_callback' => 'souje_sanitize_file' ) );
		$wp_customize->add_setting( 'souje_menu_container_height', array( 'default' => 80, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_trigger_slick_nav', array( 'default' => 960, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_slicknav_apl', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_header_social', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_header_search', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_top_search_width', array( 'default' => 240, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_logo_image_sticky', array( 'sanitize_callback' => 'souje_sanitize_file' ) );
		$wp_customize->add_setting( 'souje_trigger_sticky_menu', array( 'default' => 300, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_sticky_header', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_sticky_logo', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );

		/* */

		/* Slider Settings */
		$wp_customize->add_setting( 'souje_slider_image_width', array( 'default' => 1140, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_slider_image_height', array( 'default' => 570, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_note_slide_image', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_slider_shortcode', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_title_posts_in_slider', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_slider_posts', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_categories', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_slider_posts_number', array( 'default' => 5, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_title_other_options', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_slider_during_pagination', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_archive', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_post', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_exclude_posts', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_nav', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_dots', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_infinite', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_autoplay', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_slider_duration', array( 'default' => 4000, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		/* */

		/* Layout Options */
		$wp_customize->add_setting( 'souje_layout_style', array( 'default' => '1col_sidebar', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_z_count', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_layout_style_archive', array( 'default' => '1col_sidebar', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_z_count_archive', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_min_post_height', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_title_sidebars', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_null' ) );
		$wp_customize->add_setting( 'souje_show_sidebar_standard', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_sidebar_gallery', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_sidebar_video', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_sidebar_page', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_sidebar_static', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_enable_sidebar_post', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_enable_sidebar_page', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_enable_sidebar_static', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_enable_sidebar_archive', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		/* */

		/* Footer */
		$wp_customize->add_setting( 'souje_copyright_text', array( 'default' => '2019 Souje. All rights reserved.', 'sanitize_callback' => 'souje_sanitize_let_html' ) );
		$wp_customize->add_setting( 'souje_show_to_top', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_show_footer_social', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_footer_widgets_column', array( 'default' => '3col', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_show_footer_widgets', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_instagram_shortcode', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_instagram_label', array( 'default' => 'FOLLOW @ INSTAGRAM', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_instagram_position_top', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		/* */

		/* Social Accounts */
		foreach ( souje_social_labels() as $val ) {

			$the_label = 'souje_social_' . esc_attr( $val );

			$wp_customize->add_setting( $the_label, array( 'default' => 'http://', 'sanitize_callback' => 'esc_url_raw' ) );

			$wp_customize->add_control( $the_label, array(
				'description' => esc_html( $val ),
				'section' => 'souje_section_social',
				'settings' => $the_label,
				'type' => 'text',
			) );

		}
		/* */

		/* Google Maps */
		$wp_customize->add_setting( 'souje_map_page_id', array( 'default' => 0, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_map_coordinate_n', array( 'default' => 49.0138, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_map_coordinate_e', array( 'default' => 8.38624, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_setting( 'souje_map_zoom', array( 'default' => 15, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_map_height', array( 'default' => 500, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		$wp_customize->add_setting( 'souje_map_api', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
		/* */

		/* Translation */
		$wp_customize->add_setting( 'souje_ignore_pot', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );

		$wp_customize->add_control( 'souje_ignore_pot', array(
			'label' => esc_html__( 'Ignore .pot file and use the translations below.', 'souje' ),
			'section' => 'souje_section_translation',
			'settings' => 'souje_ignore_pot',
			'type' => 'checkbox',
		) );

		foreach ( souje_get_terms() as $key => $val ) {

			$the_term = 'souje_translate' . esc_html( $key );
			$label = '';

			if ( $key == '_Language' ) { $label = esc_html__( '10.1. Site Language', 'souje' ); }
			if ( $key == '_ReadMore' ) { $label = esc_html__( '10.2. General', 'souje' ); }
			if ( $key == '_SearchResults' ) { $label = esc_html__( '10.3. Archive Titles', 'souje' ); }
			if ( $key == '_Comment' ) { $label = esc_html__( '10.4. Post Comments', 'souje' ); }

			$wp_customize->add_setting( $the_term, array( 'default' => $val, 'sanitize_callback' => 'sanitize_text_field' ) );

			$wp_customize->add_control( $the_term, array(
				'label' => $label,
				'description' => esc_html__( 'Original:', 'souje' ) . ' "' . esc_html( $val ) . '"',
				'section' => 'souje_section_translation',
				'settings' => $the_term,
				'type' => 'text',
			) );

		}
		/* */

		/* WooCommerce Options */
		$wp_customize->add_setting( 'souje_woo_layout', array( 'default' => '2col_sidebar', 'sanitize_callback' => 'souje_sanitize_choices' ) );
		$wp_customize->add_setting( 'souje_show_woobar', array( 'default' => 1, 'sanitize_callback' => 'souje_sanitize_checkbox' ) );
		$wp_customize->add_setting( 'souje_product_per_page', array( 'default' => 10, 'sanitize_callback' => 'souje_sanitize_integer' ) );
		/* */

		////////////////////////////////////////////////////
		/*/////////////////// CONTROLS ///////////////////*/
		////////////////////////////////////////////////////

		/* Post & Page Settings */
		$wp_customize->add_control( 'souje_featured_image_width', array(
			'label' => esc_html__( '1.1. Featured Images', 'souje' ),
			'description' => esc_html__( 'Width (Theme default: 1140)', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_featured_image_width',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_featured_image_height', array(
			'description' => esc_html__( 'Height (Theme default: 760)', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_featured_image_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_thumbnail_image_width', array(
			'label' => esc_html__( '1.2. Thumbnail Images', 'souje' ),
			'description' =>  wp_kses( __( 'Used in related posts, widgets etc.<br><br>Width (Theme default: 600)', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_thumbnail_image_width',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_thumbnail_image_height', array(
			'description' => esc_html__( 'Height (Theme default: 400)', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_thumbnail_image_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_note_post_image', array(
			'description' =>  wp_kses( __( 'Important Note:<br>When you upload an image into your media library, it gets the sizes above. If you change these settings AFTER you uploaded an image, the image will NOT change its sizes. So, you have to re-upload it or use a plugin like <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> which is a very good practice.', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_note_post_image',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_title_standard_posts', array(
			'label' => esc_html__( '1.3. Standard Posts', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_title_standard_posts',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_featured_image_standard', array(
			'label' => esc_html__( 'Show Featured Image on Post Page', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_featured_image_standard',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_featured_image_gallery', array(
			'label' => esc_html__( '1.4. Gallery Posts', 'souje' ),
			'description' => '<br>' . esc_html__( 'Featured Image Options', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_featured_image_gallery',
			'type' => 'radio',
			'choices' => array(
				'fea' => esc_html__( 'Show Featured Image', 'souje' ),
				'gal' => esc_html__( 'Show Gallery', 'souje' )
			)
		) );
		$wp_customize->add_control( 'souje_gallery_position', array(
			'description' => esc_html__( 'Gallery Position on Post Page', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_gallery_position',
			'type' => 'radio',
			'choices' => array(
				'content' => esc_html__( 'Only in Content', 'souje' ),
				'iof' => esc_html__( 'Instead of Featured Image', 'souje' ),
				'both' => esc_html__( 'Both', 'souje' )
			)
		) );
		$wp_customize->add_control( 'souje_featured_image_video', array(
			'label' => esc_html__( '1.5. Video Posts', 'souje' ),
			'description' => '<br>' . esc_html__( 'Featured Image Options', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_featured_image_video',
			'type' => 'radio',
			'choices' => array(
				'fea' => esc_html__( 'Show Featured Image', 'souje' ),
				'vid' => esc_html__( 'Show Video', 'souje' )
			)
		) );
		$wp_customize->add_control( 'souje_related_post_base', array(
			'label' => esc_html__( '1.6. Related Posts', 'souje' ),
			'description' => '<br>' . esc_html__( 'Related Post Term', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_related_post_base',
			'type' => 'radio',
			'choices' => array(
				'author' => esc_html__( 'Author', 'souje' ),
				'tag' => esc_html__( 'Tag', 'souje' ),
				'category' => esc_html__( 'Category', 'souje' ),
				'random' => esc_html__( 'Random', 'souje' )
			)
		) );
		$wp_customize->add_control( 'souje_related_post_count', array(
			'description' => esc_html__( 'Related Posts Count', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_related_post_count',
			'type' => 'radio',
			'choices' => array(
				2 => 2,
				3 => 3,
				4 => 4,
				6 => 6
			)
		) );
		$wp_customize->add_control( 'souje_hidden_cats', array(
			'label' => esc_html__( '1.7. Hide Posts on Blog Homepage', 'souje' ),
			'description' => '<br>' . esc_html__( 'Write category IDs you want to hide.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_hidden_cats',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_hidden_posts', array(
			'description' => esc_html__( 'Write post IDs you want to hide.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_hidden_posts',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_note_separate_ids', array(
			'description' =>  wp_kses( __( 'Important Note:<br>Use comma (,) between IDs.<br>Example: 2,5,8', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_note_separate_ids',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_title_show_hide_elements', array(
			'label' => esc_html__( '1.8. Show/Hide Elements', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_title_show_hide_elements',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_show_date', array(
			'label' => esc_html__( 'Show Date', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_date',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_date_indexed', array(
			'label' => esc_html__( 'Show Date', 'souje' ),
			'description' => esc_html__( 'For indexed views like blog homepage.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_date_indexed',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_comments_icon', array(
			'label' => esc_html__( 'Show Comments Icon', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_comments_icon',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_comments_icon_indexed', array(
			'label' => esc_html__( 'Show Comments Icon', 'souje' ),
			'description' => esc_html__( 'For indexed views like blog homepage.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_comments_icon_indexed',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_author', array(
			'label' => esc_html__( 'Show Author', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_author',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_author_indexed', array(
			'label' => esc_html__( 'Show Author', 'souje' ),
			'description' => esc_html__( 'For indexed views like blog homepage.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_author_indexed',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_excerpt_indexed', array(
			'label' => esc_html__( 'Show Excerpt', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_excerpt_indexed',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_read_more', array(
			'label' => esc_html__( 'Show "Read More" Button', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_read_more',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_categories', array(
			'label' => esc_html__( 'Show Tags & Categories', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_categories',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_categories_indexed', array(
			'label' => esc_html__( 'Show Tags & Categories', 'souje' ),
			'description' => esc_html__( 'For indexed views like blog homepage.', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_categories_indexed',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_share', array(
			'label' => esc_html__( 'Show Share Icons on Post Pages', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_share',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_author_box', array(
			'label' => esc_html__( 'Show Author Box on Post Pages', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_author_box',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_related_posts', array(
			'label' => esc_html__( 'Show Related Posts', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_related_posts',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_post_comments', array(
			'label' => esc_html__( 'Show Post Comments', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_post_comments',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_share_page', array(
			'label' => esc_html__( 'Show Share Icons on Pages', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_share_page',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_page_comments', array(
			'label' => esc_html__( 'Show Page Comments', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_page_comments',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_filter', array(
			'label' => esc_html__( 'Show Filter Bar on Archive Pages', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_filter',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_filter_word', array(
			'label' => esc_html__( 'Show "Tag /", "Category /", "Author /" etc. on Filter Bar', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_filter_word',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_widget_date', array(
			'label' => esc_html__( 'Show Date in Widgets', 'souje' ),
			'section' => 'souje_section_posts',
			'settings' => 'souje_show_widget_date',
			'type' => 'checkbox',
		) );
		/* */

		/* Font Settings */
		$wp_customize->add_control( 'souje_note_google_fonts', array(
			'description' =>  wp_kses( __( '<a href="https://fonts.google.com/" target="_blank">See Google Fonts</a>', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_note_google_fonts',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( new souje_font_selector( $wp_customize, 'souje_font_primary', array(
			'label' => esc_html__( '2.1. Primary Font', 'souje' ),
			'section' => 'souje_section_fonts',
			'description' =>  wp_kses( __( 'Menu items, titles etc.<br>(Theme default: Poppins)', 'souje' ), $souje_allowed_html ),
			'settings' => 'souje_font_primary'
		) ) );
		$wp_customize->add_control( new souje_font_selector( $wp_customize, 'souje_font_secondary', array(
			'label' => esc_html__( '2.2. Secondary Font', 'souje' ),
			'section' => 'souje_section_fonts',
			'description' =>  wp_kses( __( 'Content, dates, miscellaneous.<br>(Theme default: PT Serif)', 'souje' ), $souje_allowed_html ),
			'settings' => 'souje_font_secondary',
		) ) );
		$wp_customize->add_control( 'souje_font_size_menu_item', array(
			'label' => esc_html__( '2.3. Font Sizes', 'souje' ),
			'description' => esc_html__( 'Menu Items (Theme default: 14)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_menu_item',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_font_size_post_title', array(
			'description' => esc_html__( 'Post Titles (Theme default: 60)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_post_title',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_font_size_post_title_mobile', array(
			'description' => esc_html__( 'Post Titles - Columned (Theme default: 40)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_post_title_mobile',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_font_size_post_content', array(
			'description' => esc_html__( 'Post Content (Theme default: 16)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_post_content',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_font_size_widget_title', array(
			'description' => esc_html__( 'Widget Titles (Theme default: 30)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_widget_title',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_font_size_widget_post_title', array(
			'description' => esc_html__( 'Widget Post Titles (Theme default: 13)', 'souje' ),
			'section' => 'souje_section_fonts',
			'settings' => 'souje_font_size_widget_post_title',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		/* */

		/* Colors */
		//////  Executed in "SETTINGS" section. //////
		/* */

		/* Header */
		$wp_customize->add_control( new souje_radio_selector( $wp_customize, 'souje_header_style', array(
			'label' => esc_html__( '4.1. Header Style', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_header_style',
			'choices' => array(
				'bottom_lefted_fboxed' => array( 'url' => get_template_directory_uri() . '/css/images/bottom_lefted_fboxed.png', 'label' => 'bottom_lefted_fboxed' ),
				'bottom_lefted_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/bottom_lefted_fulled.png', 'label' => 'bottom_lefted_fulled' ),
				'bottom_lefted_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/bottom_lefted_bboxed.png', 'label' => 'bottom_lefted_bboxed' ),
				'bottom_center_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/bottom_center_fulled.png', 'label' => 'bottom_center_fulled' ),
				'bottom_center_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/bottom_center_bboxed.png', 'label' => 'bottom_center_bboxed' ),
				'topped_lefted_fboxed' => array( 'url' => get_template_directory_uri() . '/css/images/topped_lefted_fboxed.png', 'label' => 'topped_lefted_fboxed' ),
				'topped_lefted_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/topped_lefted_fulled.png', 'label' => 'topped_lefted_fulled' ),
				'topped_lefted_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/topped_lefted_bboxed.png', 'label' => 'topped_lefted_bboxed' ),
				'topped_center_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/topped_center_fulled.png', 'label' => 'topped_center_fulled' ),
				'topped_center_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/topped_center_bboxed.png', 'label' => 'topped_center_bboxed' ),
				'lefted_lefted_fboxed' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_lefted_fboxed.png', 'label' => 'lefted_lefted_fboxed' ),
				'lefted_lefted_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_lefted_fulled.png', 'label' => 'lefted_lefted_fulled' ),
				'lefted_lefted_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_lefted_bboxed.png', 'label' => 'lefted_lefted_bboxed' ),
				'lefted_center_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_center_fulled.png', 'label' => 'lefted_center_fulled' ),
				'lefted_center_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_center_bboxed.png', 'label' => 'lefted_center_bboxed' ),
				'lefted_mright_fboxed' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_mright_fboxed.png', 'label' => 'lefted_mright_fboxed' ),
				'lefted_mright_fulled' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_mright_fulled.png', 'label' => 'lefted_mright_fulled' ),
				'lefted_mright_bboxed' => array( 'url' => get_template_directory_uri() . '/css/images/lefted_mright_bboxed.png', 'label' => 'lefted_mright_bboxed' ),
			)
		) ) );
		$wp_customize->add_control( new souje_font_selector( $wp_customize, 'souje_font_logotype', array(
			'label' => esc_html__( '4.2. Logo Settings', 'souje' ),
			'section' => 'souje_section_header',
			'description' => esc_html__( 'Logo Font (Theme default: Montserrat Alternates)', 'souje' ),
			'settings' => 'souje_font_logotype'
		) ) );
		$wp_customize->add_control( 'souje_font_size_logo', array(
			'description' => esc_html__( 'Logo Font Size (Theme default: 30)', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_font_size_logo',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'souje_logo_image', array(
			'description' => esc_html__( 'Logo Image', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_logo_image'
		) ) );
		$wp_customize->add_control( 'souje_max_logo_height', array(
			'description' => esc_html__( 'Logo Image Size (Theme default: 40)', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_max_logo_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'souje_mobile_logo_image', array(
			'description' => esc_html__( 'Mobile Logo Image', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_mobile_logo_image'
		) ) );
		$wp_customize->add_control( 'souje_menu_container_height', array(
			'label' => esc_html__( '4.3. Menu Settings', 'souje' ),
			'description' =>  wp_kses( __( 'Menu Container Height<br>(Theme default: 80 - Min value: 70)', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_header',
			'settings' => 'souje_menu_container_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_trigger_slick_nav', array(
			'description' => esc_html__( 'Trigger mobile menu when window width is smaller than:', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_trigger_slick_nav',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_slicknav_apl', array(
			'label' => esc_html__( 'Clickable Parent Menu Items in Mobile Menu', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_slicknav_apl',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_show_header_social', array(
			'label' => esc_html__( 'Show Social Account Icons', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_show_header_social',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_show_header_search', array(
			'label' => esc_html__( 'Show Search', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_show_header_search',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_top_search_width', array(
			'description' =>  wp_kses( __( 'Search Box Width<br>(Theme default: 240 - Min value: 240)', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_header',
			'settings' => 'souje_top_search_width',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'souje_logo_image_sticky', array(
			'label' => esc_html__( '4.4. Sticky Header', 'souje' ),
			'description' => esc_html__( 'Sticky Logo Image', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_logo_image_sticky'
		) ) );
		$wp_customize->add_control( 'souje_trigger_sticky_menu', array(
			'description' => esc_html__( 'Trigger sticky header when scroll position is higher than:', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_trigger_sticky_menu',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 60px;',
			),
		) );
		$wp_customize->add_control( 'souje_sticky_header', array(
			'label' => esc_html__( 'Sticky Header', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_sticky_header',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_show_sticky_logo', array(
			'label' => esc_html__( 'Show Sticky Logo', 'souje' ),
			'section' => 'souje_section_header',
			'settings' => 'souje_show_sticky_logo',
			'type' => 'checkbox'
		) );
		/* */

		/* Slider Settings */
		$wp_customize->add_control( 'souje_slider_image_width', array(
			'label' => esc_html__( '5.1. Slide Images', 'souje' ),
			'description' => esc_html__( 'Width (Theme default: 1140)', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_image_width',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_slider_image_height', array(
			'description' => esc_html__( 'Height (Theme default: 570)', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_image_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_note_slide_image', array(
			'description' =>  wp_kses( __( 'Important Note:<br>When you upload an image into your media library, it gets the sizes above. If you change these settings AFTER you uploaded an image, the image will NOT change its sizes. So, you have to re-upload it or use a plugin like <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> which is a very good practice.', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_note_slide_image',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_slider_shortcode', array(
			'label' => esc_html__( '5.2. Slider Shortcode', 'souje' ),
			'description' =>  wp_kses( __( 'Example usage:<br>[soujeslider group="your_group"]', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_shortcode',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_title_posts_in_slider', array(
			'label' => esc_html__( '5.3. Blog Posts in Slider', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_title_posts_in_slider',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_slider_posts', array(
			'label' => esc_html__( 'Show Blog Posts in Slider', 'souje' ),
			'description' => esc_html__( 'Disables the shortcode if checked.', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_posts',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_categories', array(
			'description' => esc_html__( 'Write a category slug to show the category posts in slider. Leave blank to show all posts.', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_categories',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_slider_posts_number', array(
			'description' => esc_html__( 'Number of the posts to show in slider', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_posts_number',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_title_other_options', array(
			'label' => esc_html__( '5.4. Other Options', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_title_other_options',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_slider_during_pagination', array(
			'label' => esc_html__( 'Show Slider During the Pagination', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_during_pagination',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_archive', array(
			'label' => esc_html__( 'Show Slider on Archive Pages', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_archive',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_post', array(
			'label' => esc_html__( 'Show Slider on Post Pages', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_post',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_exclude_posts', array(
			'label' => esc_html__( 'Exclude the Slider Posts From Feed', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_exclude_posts',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_nav', array(
			'label' => esc_html__( 'Show Prev/Next Arrows', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_nav',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_dots', array(
			'label' => esc_html__( 'Show Navigation Bullets', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_dots',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_slider_infinite', array(
			'label' => esc_html__( 'Infinite Loop', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_infinite',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_slider_autoplay', array(
			'label' => esc_html__( 'Autoplay Slides', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_autoplay',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_slider_duration', array(
			'description' => esc_html__( 'Autoplay Duration (Theme default: 4000)', 'souje' ),
			'section' => 'souje_section_slider',
			'settings' => 'souje_slider_duration',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		/* */

		/* Layout Options */
		$wp_customize->add_control( new souje_radio_selector( $wp_customize, 'souje_layout_style', array(
			'label' => esc_html__( '6.1. Blog Homepage Layout', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_layout_style',
			'choices' => array(
				'1col' => array( 'url' => get_template_directory_uri() . '/css/images/1col.png', 'label' => '1 Column' ),
				'1col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/1col_sidebar.png', 'label' => '1 Column + Sidebar' ),
				'2col' => array( 'url' => get_template_directory_uri() . '/css/images/2col.png', 'label' => '2 Columns' ),
				'2col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/2col_sidebar.png', 'label' => '2 Columns + Sidebar' ),
				'1_2col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/1_2col_sidebar.png', 'label' => '(1 + 2) Columns + Sidebar' ),
				'3col' => array( 'url' => get_template_directory_uri() . '/css/images/3col.png', 'label' => '3 Columns' ),
				'2_3col' => array( 'url' => get_template_directory_uri() . '/css/images/2_3col.png', 'label' => '(2 + 3) Columns' ),
			)
		) ) );
		$wp_customize->add_control( 'souje_z_count', array(
			'description' => esc_html__( 'Number of posts to show in "Style Z":', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_z_count',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( new souje_radio_selector( $wp_customize, 'souje_layout_style_archive', array(
			'label' => esc_html__( '6.2. Archive Layout', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_layout_style_archive',
			'choices' => array(
				'1col' => array( 'url' => get_template_directory_uri() . '/css/images/1col.png', 'label' => '1 Column' ),
				'1col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/1col_sidebar.png', 'label' => '1 Column + Sidebar' ),
				'2col' => array( 'url' => get_template_directory_uri() . '/css/images/2col.png', 'label' => '2 Columns' ),
				'2col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/2col_sidebar.png', 'label' => '2 Columns + Sidebar' ),
				'1_2col_sidebar' => array( 'url' => get_template_directory_uri() . '/css/images/1_2col_sidebar.png', 'label' => '(1 + 2) Columns + Sidebar' ),
				'3col' => array( 'url' => get_template_directory_uri() . '/css/images/3col.png', 'label' => '3 Columns' ),
				'2_3col' => array( 'url' => get_template_directory_uri() . '/css/images/2_3col.png', 'label' => '(2 + 3) Columns' ),
			)
		) ) );
		$wp_customize->add_control( 'souje_z_count_archive', array(
			'description' => esc_html__( 'Number of posts to show in "Style Z":', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_z_count_archive',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_min_post_height', array(
			'label' => esc_html__( '6.3. Post Heights', 'souje' ),
			'description' =>  wp_kses( __( 'While using 2 or 3 columned layouts for your blog homepage or archive pages, if you have problems about equalizing the heights of your posts, you can set a static size to make their heights equal.<br><br>Minimum Height (Theme default: 0)', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_min_post_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_title_sidebars', array(
			'label' => esc_html__( '6.4. Sidebars', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_title_sidebars',
			'input_attrs' => array(
				'style' => 'display: none;',
			),
		) );
		$wp_customize->add_control( 'souje_show_sidebar_standard', array(
			'label' => esc_html__( 'Show Sidebar on Standard Posts', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_show_sidebar_standard',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_sidebar_gallery', array(
			'label' => esc_html__( 'Show Sidebar on Gallery Posts', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_show_sidebar_gallery',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_sidebar_video', array(
			'label' => esc_html__( 'Show Sidebar on Video Posts', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_show_sidebar_video',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_sidebar_page', array(
			'label' => esc_html__( 'Show Sidebar on Pages', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_show_sidebar_page',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_show_sidebar_static', array(
			'label' => esc_html__( 'Show Sidebar on Static Front Page', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_show_sidebar_static',
			'type' => 'checkbox',
		) );
		$wp_customize->add_control( 'souje_enable_sidebar_post', array(
			'label' => esc_html__( 'Enable "Sidebar - Post"', 'souje' ),
			'description' => esc_html__( 'Uncheck to use the default sidebar.', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_enable_sidebar_post',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_enable_sidebar_page', array(
			'label' => esc_html__( 'Enable "Sidebar - Page"', 'souje' ),
			'description' => esc_html__( 'Uncheck to use the default sidebar.', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_enable_sidebar_page',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_enable_sidebar_static', array(
			'label' => esc_html__( 'Enable "Sidebar - Static Front Page"', 'souje' ),
			'description' => esc_html__( 'Uncheck to use the default sidebar.', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_enable_sidebar_static',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_enable_sidebar_archive', array(
			'label' => esc_html__( 'Enable "Sidebar - Archive"', 'souje' ),
			'description' => esc_html__( 'Uncheck to use the default sidebar.', 'souje' ),
			'section' => 'souje_section_layout',
			'settings' => 'souje_enable_sidebar_archive',
			'type' => 'checkbox'
		) );
		/* */

		/* Footer */
		$wp_customize->add_control( 'souje_copyright_text', array(
			'description' => esc_html__( 'Copyright Text', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_copyright_text',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_show_to_top', array(
			'label' => esc_html__( 'Show Back to Top Button', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_show_to_top',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_show_footer_social', array(
			'label' => esc_html__( 'Show Social Account Icons', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_show_footer_social',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_footer_widgets_column', array(
			'label' => esc_html__( '7.1. Footer Widgets', 'souje' ),
			'description' => '<br>' . esc_html__( 'Column Options', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_footer_widgets_column',
			'type' => 'radio',
			'choices' => array(
				'2col' => esc_html__( '2 Columns', 'souje' ),
				'3col' => esc_html__( '3 Columns', 'souje' ),
				'4col' => esc_html__( '4 Columns', 'souje' )
			)
		) );
		$wp_customize->add_control( 'souje_show_footer_widgets', array(
			'label' => esc_html__( 'Show Footer Widgets', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_show_footer_widgets',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_instagram_shortcode', array(
			'label' => esc_html__( '7.2. Instagram Slider Widget', 'souje' ),
			'description' =>  wp_kses( __( 'Instagram Widget Shortcode<br><a href="https://burnhambox.ticksy.com/article/9859/" target="_blank">Where is my shortcode?</a>', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_instagram_shortcode',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_instagram_label', array(
			'description' => esc_html__( 'Instagram Widget Title', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_instagram_label',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_instagram_position_top', array(
			'label' => esc_html__( 'Display Instagram Widget Above Footer Elements', 'souje' ),
			'section' => 'souje_section_footer',
			'settings' => 'souje_instagram_position_top',
			'type' => 'checkbox'
		) );
		/* */

		/* Social Accounts */
		//////  Executed in "SETTINGS" section. //////
		/* */

		/* Google Maps */
		$wp_customize->add_control( 'souje_map_page_id', array(
			'description' => esc_html__( 'Choose a Page', 'souje' ),
			'section' => 'souje_section_maps',
			'settings' => 'souje_map_page_id',
			 'type' => 'dropdown-pages',
		) );
		$wp_customize->add_control( 'souje_map_coordinate_n', array(
			'description' => esc_html__( 'Coordinate N', 'souje' ),
			'section' => 'souje_section_maps',
			'settings' => 'souje_map_coordinate_n',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_map_coordinate_e', array(
			'description' => esc_html__( 'Coordinate E', 'souje' ),
			'section' => 'souje_section_maps',
			'settings' => 'souje_map_coordinate_e',
			'type' => 'text',
		) );
		$wp_customize->add_control( 'souje_map_zoom', array(
			'type' => 'range',
			'section' => 'souje_section_maps',
			'description' => esc_html__( 'Zoom Level', 'souje' ),
			'input_attrs' => array(
				'min' => 5,
				'max' => 19,
				'step' => 1
			)
		) );
		$wp_customize->add_control( 'souje_map_height', array(
			'description' => esc_html__( 'Map Height', 'souje' ),
			'section' => 'souje_section_maps',
			'settings' => 'souje_map_height',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		$wp_customize->add_control( 'souje_map_api', array(
			'description' =>  wp_kses( __( 'API Key<br><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get your API Key</a>', 'souje' ), $souje_allowed_html ),
			'section' => 'souje_section_maps',
			'settings' => 'souje_map_api',
			'type' => 'text',
		) );
		/* */

		/* Translation */
		//////  Executed in "SETTINGS" section. //////
		/* */

		/* WooCommerce Options */
		$wp_customize->add_control( 'souje_woo_layout', array(
			'label' => esc_html__( 'Shop Layout Options', 'souje' ),
			'section' => 'souje_section_woocommerce',
			'settings' => 'souje_woo_layout',
			'type' => 'radio',
			'choices' => array(
				'2col' => '2 Columns',
				'2col_sidebar' => '2 Columns + Sidebar',
				'3col' => '3 Columns'
			)
		) );
		$wp_customize->add_control( 'souje_show_woobar', array(
			'label' => esc_html__( 'Show Sidebar on Product Pages', 'souje' ),
			'section' => 'souje_section_woocommerce',
			'settings' => 'souje_show_woobar',
			'type' => 'checkbox'
		) );
		$wp_customize->add_control( 'souje_product_per_page', array(
			'label' => esc_html__( 'Products per Page', 'souje' ),
			'section' => 'souje_section_woocommerce',
			'settings' => 'souje_product_per_page',
			'type' => 'number',
			'input_attrs' => array(
				'style' => 'width: 65px;',
			),
		) );
		/* */

	}
}
add_action( 'customize_register', 'souje_customizer' );
?>
