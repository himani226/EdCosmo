<?php
/**
 * Plugin support: The Events Calendar
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Check if Tribe Events installed and activated
if (!function_exists('trx_addons_exists_tribe_events')) {
	function trx_addons_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}


// Return true, if current page is any TE page
if ( !function_exists( 'trx_addons_is_tribe_events_page' ) ) {
	function trx_addons_is_tribe_events_page() {
		$is = false;
		if (trx_addons_exists_tribe_events() && !is_search()) 
			$is = tribe_is_event() || tribe_is_event_query() || tribe_is_event_category() || tribe_is_event_venue() || tribe_is_event_organizer();
		return $is;
	}
}


// Merge specific styles into single stylesheet
if ( !function_exists( 'trx_addons_events_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_events_merge_styles');
	function trx_addons_events_merge_styles($list) {
		if (trx_addons_exists_tribe_events())
			$list[] = TRX_ADDONS_PLUGIN_API . 'the-events-calendar/_the-events-calendar.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_cpt_events_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_cpt_events_merge_styles_responsive');
	function trx_addons_cpt_events_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_API . 'the-events-calendar/_the-events-calendar.responsive.scss';
		return $list;
	}
}

	
// Add sort in the query for the events
if ( !function_exists( 'trx_addons_events_add_sort_order' ) ) {
	add_filter('trx_addons_filter_add_sort_order',	'trx_addons_events_add_sort_order', 10, 3);
	function trx_addons_events_add_sort_order($q, $orderby, $order='desc') {
		if ($orderby == 'event_date') {
			$q['order'] = $order;
			$q['orderby'] = 'meta_value';
			$q['meta_key'] = '_EventStartDate';
		}
		return $q;
	}
}

// Return taxonomy for current post type (this post_type has 2+ taxonomies)
if ( !function_exists( 'trx_addons_events_post_type_taxonomy' ) ) {
	add_filter( 'trx_addons_filter_post_type_taxonomy',	'trx_addons_events_post_type_taxonomy', 10, 2 );
	function trx_addons_events_post_type_taxonomy($tax='', $post_type='') {
		if (trx_addons_exists_tribe_events() && $post_type == Tribe__Events__Main::POSTTYPE)
			$tax = Tribe__Events__Main::TAXONOMY;
		return $tax;
	}
}

// Return current page title
if ( !function_exists( 'trx_addons_events_get_blog_title' ) ) {
	add_filter( 'trx_addons_filter_get_blog_title', 'trx_addons_events_get_blog_title');
	function trx_addons_events_get_blog_title($title='') {
		if (trx_addons_is_tribe_events_page() ) {
			if (is_archive())
				$title = apply_filters( 'tribe_events_title', tribe_get_events_title( false ) );
			else {
				global $wp_query;
				if (!empty($wp_query->post)) {
					$title = $wp_query->post->post_title;
				}
			}
		}
		return $title;
	}
}
	
// Add Google API key to the map's link
if ( !function_exists( 'trx_addons_events_google_maps_api' ) ) {
	add_filter('tribe_events_google_maps_api',	'trx_addons_events_google_maps_api');
	function trx_addons_events_google_maps_api($url) {
		$api_key = trx_addons_get_option('api_google');
		if ($api_key) {
			$url = trx_addons_add_to_url($url, array(
				'key' => $api_key
			));
		}
		return $url;
	}
}
	
// Repair current post after the Tribe Events spoofing it on priority 100!!!
if ( !function_exists( 'trx_addons_events_repair_spoofed_post' ) ) {
	add_action('wp_head',	'trx_addons_events_repair_spoofed_post', 101);
	function trx_addons_events_repair_spoofed_post() {

		if ( !trx_addons_exists_tribe_events() ) return;

		// hijack this method right up front if it's a password protected post and the password isn't entered
		if ( is_single() && post_password_required() || is_feed() ) {
			return;
		}

		global $wp_query;
		if ( $wp_query->is_main_query() && tribe_is_event_query() && tribe_get_option( 'tribeEventsTemplate', 'default' ) != '' ) {
			if (count($wp_query->posts) > 0) {
				$GLOBALS['post'] = $wp_query->posts[0];
			}
		}
	}
}

// Add hack on page 404 to prevent error message
if ( !function_exists( 'trx_addons_events_create_empty_post_on_404' ) ) {
	add_action( 'wp_head', 'trx_addons_events_create_empty_post_on_404', 1);
	function trx_addons_events_create_empty_post_on_404() {
		if (is_404() && !isset($GLOBALS['post'])) {
			$GLOBALS['post'] = new stdClass();
			$GLOBALS['post']->post_type = 'unknown';
			$GLOBALS['post']->post_content = '';
		}
	}
}

// Replace post date with event's date for RevSlider
if ( !function_exists( 'trx_addons_events_revslider_date' ) ) {
	add_filter('revslider_slide_setLayersByPostData_post', 'trx_addons_events_revslider_date', 10, 4);
	function trx_addons_events_revslider_date($attr, $postData, $sliderID, $sliderObj) {
		if ( trx_addons_exists_tribe_events() && !empty($postData['ID']) && !empty($postData['post_type']) && $postData['post_type'] == Tribe__Events__Main::POSTTYPE) {
	        $attr['date_start'] = tribe_get_start_date($postData['ID'], true, get_option('date_format'));
	        $attr['date_end'] = tribe_get_end_date($postData['ID'], true, get_option('date_format'));
	        $attr['date'] = $attr['postDate'] = $attr['date_start'] . ' - ' . $attr['date_end'];
	    }
	    return $attr;
	}
}


// trx_sc_events
//-------------------------------------------------------------
/*
[trx_sc_events id="unique_id" type="default" cat="category_slug or id" count="3" columns="3" slider="0|1"]
*/
if ( !function_exists( 'trx_addons_sc_events' ) ) {
	function trx_addons_sc_events($atts, $content=null) {	
		$atts = trx_addons_sc_prepare_atts('trx_sc_events', $atts, array(
			// Individual params
			"type" => "default",
			"columns" => "",
			"cat" => "",
			"count" => 3,
			"offset" => 0,
			"orderby" => '',
			"order" => '',
			"ids" => '',
			"past" => "0",
			"slider" => 0,
			"slider_pagination" => "none",
			"slider_controls" => "none",
			"slides_space" => 0,
			"slides_centered" => 0,
			"slides_overflow" => 0,
			"slider_mouse_wheel" => 0,
			"slider_autoplay" => 1,
			"more_text" => esc_html__('More info', 'trx_addons'),
			"title" => "",
			"subtitle" => "",
			"description" => "",
			"link" => '',
			"link_style" => 'default',
			"link_image" => '',
			"link_text" => esc_html__('Learn more', 'trx_addons'),
			"title_align" => "left",
			"title_style" => "default",
			"title_tag" => '',
			"title_color" => '',
			"title_color2" => '',
			"gradient_direction" => '',
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			));

		if (!empty($atts['ids'])) {
			$atts['ids'] = str_replace(array(';', ' '), array(',', ''), $atts['ids']);
			$atts['count'] = count(explode(',', $atts['ids']));
		}
		$atts['count'] = max(1, (int) $atts['count']);
		$atts['offset'] = max(0, (int) $atts['offset']);
		if (empty($atts['orderby'])) $atts['orderby'] = 'event_date';
		if (empty($atts['order'])) $atts['order'] = 'asc';
		$atts['slider'] = max(0, (int) $atts['slider']);
		if ($atts['slider'] > 0 && (int) $atts['slider_pagination'] > 0) $atts['slider_pagination'] = 'bottom';

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_API . 'the-events-calendar/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_API . 'the-events-calendar/tpl.default.php'
										),
									'trx_addons_args_sc_events',
									$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_events', $atts, $content);
	}
}


// Add [trx_sc_events] in the VC shortcodes list
if (!function_exists('trx_addons_sc_events_add_in_vc')) {
	function trx_addons_sc_events_add_in_vc() {

		if (!trx_addons_exists_tribe_events()) return;

		add_shortcode("trx_sc_events", "trx_addons_sc_events");

		if (!trx_addons_exists_vc()) return;

		vc_lean_map( "trx_sc_events", 'trx_addons_sc_events_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Events extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_events_add_in_vc', 20);
}

// Return params
if (!function_exists('trx_addons_sc_events_add_in_vc_params')) {
	function trx_addons_sc_events_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_events",
				"name" => esc_html__("Events", 'trx_addons'),
				"description" => wp_kses_data( __("Display events from specified group", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_events',
				"class" => "trx_sc_events",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							"admin_label" => true,
							"std" => "default",
					        'save_always' => true,
							"value" => array_flip(apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('api', 'the-events-calendar'), 'trx_sc_events')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "past",
							"heading" => esc_html__("Past events", 'trx_addons'),
							"description" => wp_kses_data( __("Show the past events if checked, else - show upcoming events", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							"admin_label" => true,
							"std" => "0",
							"value" => array(esc_html__("Show past events", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "cat",
							"heading" => esc_html__("Category", 'trx_addons'),
							"description" => wp_kses_data( __("Events category", 'trx_addons') ),
							"value" => array_merge(array(esc_html__('- Select category -', 'trx_addons') => 0), array_flip(trx_addons_get_list_terms(false, Tribe__Events__Main::TAXONOMY))),
							"std" => 0,
							"type" => "dropdown"
						)
					),
					trx_addons_vc_add_query_param(''),
					trx_addons_vc_add_slider_param(),
					trx_addons_vc_add_title_param(),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_events' );
	}
}




// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_events_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_events_add_in_elementor' );
	function trx_addons_sc_events_add_in_elementor() {

		if (!trx_addons_exists_tribe_events() || !class_exists('TRX_Addons_Elementor_Widget')) return;
		
		class TRX_Addons_Elementor_Widget_Events extends TRX_Addons_Elementor_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_events';
			}

			/**
			 * Retrieve widget title.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget title.
			 */
			public function get_title() {
				return __( 'Events list', 'trx_addons' );
			}

			/**
			 * Retrieve widget icon.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget icon.
			 */
			public function get_icon() {
				return 'eicon-countdown';
			}

			/**
			 * Retrieve the list of categories the widget belongs to.
			 *
			 * Used to determine where to display the widget in the editor.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return array Widget categories.
			 */
			public function get_categories() {
				return ['trx_addons-support'];
			}

			/**
			 * Register widget controls.
			 *
			 * Adds different input fields to allow the user to change and customize the widget settings.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function register_controls() {
				$this->start_controls_section(
					'section_sc_events',
					[
						'label' => __( 'Events list', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('api', 'the-events-calendar'), 'trx_sc_events'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'past',
					[
						'label' => __( 'Past events', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Show the past events if checked, else - show upcoming events", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Upcoming', 'trx_addons' ),
						'label_on' => __( 'Past', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'cat',
					[
						'label' => __( 'Category', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_array_merge(array(0 => esc_html__('- Select category -', 'trx_addons')), trx_addons_get_list_terms(false, Tribe__Events__Main::TAXONOMY)),
						'default' => '0'
					]
				);
				
				$this->add_query_param('');

				$this->end_controls_section();
				
				$this->add_slider_param();
				
				$this->add_title_param();
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Events() );
	}
}


// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_tribe_events_importer_required_plugins' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_tribe_events_importer_required_plugins', 10, 2 );
	function trx_addons_tribe_events_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'the-events-calendar')!==false && !trx_addons_exists_tribe_events() )
			$not_installed .= '<br>' . esc_html__('Tribe Events Calendar', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_tribe_events_importer_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_importer_options',	'trx_addons_tribe_events_importer_set_options' );
	function trx_addons_tribe_events_importer_set_options($options=array()) {
		if ( trx_addons_exists_tribe_events() && in_array('the-events-calendar', $options['required_plugins']) ) {
			$options['additional_options'][] = 'tribe_events_calendar_options';
		}
		return $options;
	}
}

// Prevent import plugin's specific options if plugin is not installed
if ( !function_exists( 'trx_addons_tribe_events_importer_check_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_import_theme_options', 'trx_addons_tribe_events_importer_check_options', 10, 4 );
	function trx_addons_tribe_events_importer_check_options($allow, $k, $v, $options) {
		if ($allow && $k == 'tribe_events_calendar_options') {
			$allow = trx_addons_exists_tribe_events() && in_array('the-events-calendar', $options['required_plugins']);
		}
		return $allow;
	}
}

// Check if the row will be imported
if ( !function_exists( 'trx_addons_tribe_events_importer_check_row' ) ) {
	if (is_admin()) add_filter('trx_addons_filter_importer_import_row', 'trx_addons_tribe_events_importer_check_row', 9, 4);
	function trx_addons_tribe_events_importer_check_row($flag, $table, $row, $list) {
		if ($flag || strpos($list, 'the-events-calendar')===false) return $flag;
		if (trx_addons_exists_tribe_events() ) {
			if ($table == 'posts')
				$flag = in_array($row['post_type'], array(Tribe__Events__Main::POSTTYPE, Tribe__Events__Main::VENUE_POST_TYPE, Tribe__Events__Main::ORGANIZER_POST_TYPE));
		}
		return $flag;
	}
}



// OCDI support
//------------------------------------------------------------------------
// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_ocdi_tribe_events_set_options' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_ocdi_options', 'trx_addons_ocdi_tribe_events_set_options' );
	function trx_addons_ocdi_tribe_events_set_options($ocdi_options){
		$ocdi_options['import_tribe_events_file_url'] = 'tribe_events.txt';
		return $ocdi_options;		
	}
}

// Export Tribe Events Calendar
if ( !function_exists( 'trx_addons_ocdi_tribe_events_export' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_ocdi_export_files', 'trx_addons_ocdi_tribe_events_export' );
	function trx_addons_ocdi_tribe_events_export($output){
		$list = array();
		if (trx_addons_exists_tribe_events() && in_array('tribe_events', trx_addons_ocdi_options('required_plugins'))) {
			// Get plugin data from database
			$options = array('tribe_events_calendar_options');
			$list = trx_addons_ocdi_export_options($options, $list);
			
			// Save as file
			$file_path = TRX_ADDONS_PLUGIN_OCDI . "export/tribe_events.txt";
			trx_addons_fpc(trx_addons_get_file_dir($file_path), serialize($list));
			
			// Return file path
			$output .= '<h4><a href="'. trx_addons_get_file_url($file_path).'" download>'.esc_html__('Tribe Events Calendar', 'trx_addons').'</a></h4>';
		}
		return $output;
	}
}

// Add plugin to import list
if ( !function_exists( 'trx_addons_ocdi_tribe_events_import_field' ) ) {
	if (is_admin()) add_filter( 'trx_addons_filter_ocdi_import_fields', 'trx_addons_ocdi_tribe_events_import_field' );
	function trx_addons_ocdi_tribe_events_import_field($output){
		$list = array();
		if (trx_addons_exists_tribe_events() && in_array('tribe_events', trx_addons_ocdi_options('required_plugins'))) {
			$output .= '<label><input type="checkbox" name="tribe_events" value="tribe_events">'. esc_html__( 'Tribe Events Calendar', 'trx_addons' ).'</label><br/>';
		}
		return $output;
	}
}

// Import Tribe Events Calendar
if ( !function_exists( 'trx_addons_ocdi_tribe_events_import' ) ) {
	if (is_admin()) add_action( 'trx_addons_action_ocdi_import_plugins', 'trx_addons_ocdi_tribe_events_import', 10, 1 );
	function trx_addons_ocdi_tribe_events_import( $import_plugins){
		if (trx_addons_exists_tribe_events() && in_array('tribe_events', $import_plugins)) {
			trx_addons_ocdi_import_dump('tribe_events');
			echo esc_html__('Tribe Events Calendar import complete.', 'trx_addons') . "\r\n";
		}
	}
}

// Fix for the version 6.0+ to enable posts are created in the previous version
if ( !function_exists( 'trx_addons_tribe_events_importer_import_end' ) ) {
    add_action( 'trx_addons_action_importer_import_end', 'trx_addons_tribe_events_importer_import_end', 10, 1 );
    function trx_addons_tribe_events_importer_import_end( $importer = null ) {

        if ( trx_addons_exists_tribe_events() && class_exists( 'TEC\Events\Custom_Tables\V1\Repository\Events' ) ) {

            $tec = new TEC\Events\Custom_Tables\V1\Repository\Events();

            // get_posts() is not work with old events,
            // because a plugin inject own conditions (its ignore an argument 'suppress_filters')
            // and a next call return an empty result
            /*
            $events = get_posts( array(
                'post_type' => Tribe__Events__Main::POSTTYPE,
                'posts_per_page' => -1
            ) );
            */
            // A direct query is used
            global $wpdb;
            $events = $wpdb->get_results( "SELECT ID FROM " . esc_sql( $wpdb->prefix . 'posts' ) . " WHERE post_type='" . Tribe__Events__Main::POSTTYPE . "'", OBJECT );

            if ( is_array( $events ) ) {
                foreach( $events as $event ) {
                    $tec->update( $event->ID, array() );
                }
            }
        }
    }
}


// Fix: Replace an 'orderby' values 'none', 'title' in the query arguments
//      to compatibility with Tribe Events Calendar v.6.0.2+ (a error message is appear about an undefined field name 'title' or 'none')
if ( !function_exists( 'trx_addons_events_fix_query_orderby_args' ) ) {
	add_filter( 'trx_addons_filter_add_sort_order_args', 'trx_addons_events_fix_query_orderby_args' );
	add_filter( 'trx_addons_filter_get_list_posts_args', 'trx_addons_events_fix_query_orderby_args' );
	function trx_addons_events_fix_query_orderby_args( $args ) {
		$post_type = is_array( $args )
						? ( ! empty( $args['post_type'] ) ? $args['post_type'] : '' )
						: $args->get( 'post_type' );
		if ( trx_addons_exists_tribe_events() && $post_type == Tribe__Events__Main::POSTTYPE ) {
			$orderby = is_array( $args )
						? ( ! empty( $args['orderby'] ) ? $args['orderby'] : '' )
						: $args->get( 'orderby' );
			// Remove 'orderby' if it's equal to 'none'
			if ( $orderby == 'none' ) {
				if ( is_array($args) ) {
					unset( $args['orderby'] );
					unset( $args['order'] );
				} else {
					$args->set( 'orderby', '' );
				}

			// Replace 'title' with 'post_title'
			} else if ( $orderby == 'title' ) {
				if ( is_array($args) ) {
					$args['orderby'] = 'post_title';
				} else {
					$args->set( 'orderby', 'post_title' );
				}

			// Replace 'date' with 'post_date'
			} else if ( $orderby == 'date' ) {
				if ( is_array($args) ) {
					$args['orderby'] = 'post_date';
				} else {
					$args->set( 'orderby', 'post_date' );
				}
			}
		}
		return $args;
	}
}



?>