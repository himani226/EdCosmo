<?php
/**
 * ThemeREX Addons Third-party plugins API
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.29
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Define list with api
if (!function_exists('trx_addons_api_load')) {
	add_action( 'after_setup_theme', 'trx_addons_api_load', 2 );
	function trx_addons_api_load() {
		static $loaded = false;
		if ($loaded) return;
		$loaded = true;
		global $TRX_ADDONS_STORAGE;
		$TRX_ADDONS_STORAGE['api_list'] = apply_filters('trx_addons_api_list', array(
			
			'elementor' => array(
							'title' => __('Elementor (free Page Builder)', 'trx_addons'),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'gutenberg' => array(
							'title' => __('Gutenberg', 'trx_addons'),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),

			'siteorigin-panels' => array(
							'title' => __('SiteOrigin Panels (free PageBuilder)', 'trx_addons'),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'js_composer' => array(
							'title' => __('WPBakery PageBuilder (previous name is Visual Composer)', 'trx_addons'),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'vc-extensions-bundle' => array(
							'title' => __('VC Extensions Bundle', 'trx_addons')
						),
			'bbpress' => array(
							'title' => __('BB Press & Buddy Press', 'trx_addons')
						),
			'booked' => array(
							'title' => __('Booked Appointments', 'trx_addons')
						),
			'calculated-fields-form' => array(
							'title' => __('Calculated Fields Form', 'trx_addons')
						),
			'contact-form-7' => array(
							'title' => __('Contact Form 7', 'trx_addons')
						),
			'content_timeline' => array(
							'title' => __('Content Timeline', 'trx_addons')
						),
			'easy-digital-downloads' => array(
							'title' => __('Easy Digital Downloads', 'trx_addons')
						),
			'essential-grid' => array(
							'title' => __('Essential Grid', 'trx_addons')
						),
			'give' => array(
							'title' => __('Give (Donations)', 'trx_addons')
						),
			'instagram-feed' => array(
							'title' => __('Instagram Feed', 'trx_addons')
						),
			'mailchimp-for-wp' => array(
							'title' => __('MailChimp for WordPress', 'trx_addons')
						),
			'mp-timetable' => array(
							'title' => __('MP TimeTable', 'trx_addons')
						),
			'revslider' => array(
							'title' => __('Revolution Slider', 'trx_addons')
						),
			'the-events-calendar' => array(
							'title' => __('The Events Calendar', 'trx_addons'),
							'layouts_sc' => array(
								'default'	=> esc_html__('Default', 'trx_addons'),
								'detailed'	=> esc_html__('Detailed', 'trx_addons'),
								'classic'	=> esc_html__('Classic', 'trx_addons'),
							)
						),
			'tourmaster' => array(
							'title' => __('Tour Master', 'trx_addons')
						),
			'trx_donations' => array(
							'title' => __('ThemeREX Donations', 'trx_addons')
						),
			'twitter' => array(
							'title' => __('Twitter', 'trx_addons'),
							// Always enabled!!!
							'std' => 1,
							'hidden' => false
						),
			'ubermenu' => array(
							'title' => __('UberMenu', 'trx_addons')
						),
			'woocommerce' => array(
							'title' => __('WooCommerce', 'trx_addons')
						),
			'sitepress-multilingual-cms' => array(
							'title' => __('WPML - Sitepress Multilingual CMS', 'trx_addons')
						),
			// GDPR Support: uncomment only one of the following plugins
//			'gdpr-framework' => array(
//							'title' => __( 'The GDPR Framework', 'trx_addons' ),
//						),
			'wp-gdpr-compliance' => array(
							'title' =>  esc_html__( 'Cookie Information', 'trx_addons' ),
						),
			'sitepress-multilingual-cms' => array(
							'title' => __('WPML - Sitepress Multilingual CMS', 'trx_addons')
						),
                'social-pug' => array(
                    'title' => __('Social Pug', 'trx_addons')
                )
			)
		);
		if (is_array($TRX_ADDONS_STORAGE['api_list']) && count($TRX_ADDONS_STORAGE['api_list']) > 0) {
			foreach ($TRX_ADDONS_STORAGE['api_list'] as $w=>$params) {
				if (empty($params['preloaded']) && trx_addons_components_is_allowed('api', $w)
					&& ($fdir = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_API . "{$w}/{$w}.php")) != '') { 
					include_once $fdir;
				}
			}
		}
	}
}


// Add 'Third-party API' block in the ThemeREX Addons Components
if (!function_exists('trx_addons_api_components')) {
	add_filter( 'trx_addons_filter_components_blocks', 'trx_addons_api_components');
	function trx_addons_api_components($blocks=array()) {
		$blocks['api'] = __('Third-party plugins API', 'trx_addons');
		return $blocks;
	}
}


// Store shapes list to use it in the Page Builders
if (!function_exists('trx_addons_api_shapes_list')) {
	add_action( 'init', 'trx_addons_api_shapes_list');
	function trx_addons_api_shapes_list() {
		// Get theme-specific shapes for sections and columns
		//-----------------------------------------------------
		$shapes_dir = trx_addons_get_folder_dir('css/shapes');
		$shapes_list = !empty($shapes_dir) ? list_files($shapes_dir, 1) : array();
		if (is_array($shapes_list)) {
			foreach ($shapes_list as $k=>$v) {
				if (trx_addons_get_file_ext($v) != 'svg')
					unset($shapes_list[$k]);
			}
		} else
			$shapes_list = array();
		if (count($shapes_list) > 0) {
			global $TRX_ADDONS_STORAGE;
			$TRX_ADDONS_STORAGE['shapes_list'] = $shapes_list;
			$TRX_ADDONS_STORAGE['shapes_url'] = esc_url(trailingslashit(trx_addons_get_folder_url('css/shapes')));
		}
	}
}


// Add shapes url to use it in the js
if ( !function_exists( 'trx_addons_api_localize_scripts' ) ) {
	add_filter( 'trx_addons_filter_localize_script_admin',	'trx_addons_api_localize_scripts');
	add_filter( 'trx_addons_filter_localize_script', 		'trx_addons_api_localize_scripts');
	function trx_addons_api_localize_scripts($vars = array()) {
		global $TRX_ADDONS_STORAGE;
		$vars['shapes_url'] = !empty($TRX_ADDONS_STORAGE['shapes_url']) ? $TRX_ADDONS_STORAGE['shapes_url'] : '';
		return $vars;
	}
}



//-----------------------------------------------------------------------------------
//-- CHECK FOR COMPONENTS EXISTS
//--  Attention! This functions are used in many files and must be declared here!!!
//-----------------------------------------------------------------------------------

// Check if plugin 'WPBakery PageBuilder' (old name is 'Visual Composer') is installed and activated
if ( !function_exists( 'trx_addons_exists_vc' ) ) {
	function trx_addons_exists_vc() {
		return class_exists('Vc_Manager');
	}
}

// Check if plugin 'SiteOrigin Panels' is installed and activated
if ( !function_exists( 'trx_addons_exists_sop' ) ) {
	function trx_addons_exists_sop() {
		return class_exists('SiteOrigin_Panels');
	}
}

// Check if plugin 'Elementor' is installed and activated
if ( !function_exists( 'trx_addons_exists_elementor' ) ) {
	function trx_addons_exists_elementor() {
		return class_exists('Elementor\Plugin');
	}
}

// Check if plugin 'Gutenberg' is installed and activated
if ( !function_exists( 'trx_addons_exists_gutenberg' ) ) {
	function trx_addons_exists_gutenberg() {
		return function_exists( 'register_block_type' );	// && function_exists( 'the_gutenberg_project' )
	}
}

// Check if any PageBuilder is installed and activated
if ( !function_exists( 'trx_addons_exists_page_builder' ) ) {
	function trx_addons_exists_page_builder() {
		return     ( trx_addons_exists_elementor() && trx_addons_components_is_allowed('api', 'elementor') )
				|| ( trx_addons_exists_gutenberg() && trx_addons_components_is_allowed('api', 'gutenberg') )
				|| ( trx_addons_exists_vc()        && trx_addons_components_is_allowed('api', 'js_composer') )
				|| ( trx_addons_exists_sop()       && trx_addons_components_is_allowed('api', 'siteorigin-panels') );
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'trx_addons_exists_revslider' ) ) {
	function trx_addons_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_woocommerce' ) ) {
	function trx_addons_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_edd' ) ) {
	function trx_addons_exists_edd() {
		return class_exists('Easy_Digital_Downloads');
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_wpml' ) ) {
	function trx_addons_exists_wpml() {
		return defined('ICL_SITEPRESS_VERSION') && class_exists('sitepress');
	}
}

// Check if current page is a PageBuilder preview mode
if ( ! function_exists( 'trx_addons_is_preview' ) ) {
    function trx_addons_is_preview( $builder = 'any' ) {
        return ( in_array( $builder, array( 'any', 'elm', 'elementor' ) ) && function_exists( 'trx_addons_elm_is_preview' ) && trx_addons_elm_is_preview() )
            ||
            ( in_array( $builder, array( 'any', 'gb', 'gutenberg' ) ) && function_exists( 'trx_addons_gutenberg_is_preview' ) && trx_addons_gutenberg_is_preview() );
    }
}
?>