<?php
/**
 * ThemeREX Addons Custom post type: Services
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// -----------------------------------------------------------------
// -- Custom post type registration
// -----------------------------------------------------------------

// Define Custom post type and taxonomy constants
if ( ! defined('TRX_ADDONS_CPT_SERVICES_PT') ) define('TRX_ADDONS_CPT_SERVICES_PT', trx_addons_cpt_param('services', 'post_type'));
if ( ! defined('TRX_ADDONS_CPT_SERVICES_TAXONOMY') ) define('TRX_ADDONS_CPT_SERVICES_TAXONOMY', trx_addons_cpt_param('services', 'taxonomy'));

// Register post type and taxonomy
if (!function_exists('trx_addons_cpt_services_init')) {
	add_action( 'init', 'trx_addons_cpt_services_init' );
	function trx_addons_cpt_services_init() {
		
		// Add Services parameters to the Meta Box support
		trx_addons_meta_box_register(TRX_ADDONS_CPT_SERVICES_PT, array(
			"price" => array(
				"title" => esc_html__("Price",  'trx_addons'),
				"desc" => wp_kses_data( __("The price of the item", 'trx_addons') ),
				"std" => "",
				"type" => "text"
			),
			"product" => array(
				"title" => __('Select linked product',  'trx_addons'),
				"desc" => __("Product linked with this service item", 'trx_addons'),
				"std" => '',
				"options" => array(),
				"type" => "select2"
			),
			"icon" => array(
				"title" => esc_html__("Item's icon", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"options" => array(),
				"style" => trx_addons_get_setting('icons_type'),
				"type" => "icons"
			),
			"icon_color" => array(
				"title" => esc_html__("Icon's color", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"type" => "color"
			),
			"image" => array(
				"title" => esc_html__("Item's pictogram", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"button_caption" => esc_html__('Choose', 'trx_addons'),
				"type" => "image"
			),
			"link" => array(
				"title" => esc_html__("Alternative link",  'trx_addons'),
				"desc" => wp_kses_data( __("Alternative link to the service's site. If empty - use this post's permalink", 'trx_addons') ),
				"std" => "",
				"type" => "text"
			),
		));
		
		// Register post type and taxonomy
		register_post_type(
			TRX_ADDONS_CPT_SERVICES_PT,
			apply_filters('trx_addons_filter_register_post_type',
				array(
					'label'               => esc_html__( 'Services', 'trx_addons' ),
					'description'         => esc_html__( 'Service Description', 'trx_addons' ),
					'labels'              => array(
						'name'                => esc_html__( 'Services', 'trx_addons' ),
						'singular_name'       => esc_html__( 'Service', 'trx_addons' ),
						'menu_name'           => esc_html__( 'Services', 'trx_addons' ),
						'parent_item_colon'   => esc_html__( 'Parent Item:', 'trx_addons' ),
						'all_items'           => esc_html__( 'All Services', 'trx_addons' ),
						'view_item'           => esc_html__( 'View Service', 'trx_addons' ),
						'add_new_item'        => esc_html__( 'Add New Service', 'trx_addons' ),
						'add_new'             => esc_html__( 'Add New', 'trx_addons' ),
						'edit_item'           => esc_html__( 'Edit Service', 'trx_addons' ),
						'update_item'         => esc_html__( 'Update Service', 'trx_addons' ),
						'search_items'        => esc_html__( 'Search Service', 'trx_addons' ),
						'not_found'           => esc_html__( 'Not found', 'trx_addons' ),
						'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'trx_addons' ),
					),
					'taxonomies'          => array(TRX_ADDONS_CPT_SERVICES_TAXONOMY),
					'supports'            => trx_addons_cpt_param('services', 'supports'),
					'public'              => true,
					'hierarchical'        => false,
					'has_archive'         => true,
					'can_export'          => true,
					'show_in_admin_bar'   => true,
					'show_in_menu'        => true,
					'show_in_rest'        => true,
					'menu_position'       => '53.6',
					'menu_icon'			  => 'dashicons-hammer',
					'capability_type'     => 'post',
					'rewrite'             => array( 'slug' => trx_addons_cpt_param('services', 'post_type_slug') )
				),
				TRX_ADDONS_CPT_SERVICES_PT
			)
		);

		register_taxonomy(
			TRX_ADDONS_CPT_SERVICES_TAXONOMY,
			TRX_ADDONS_CPT_SERVICES_PT,
			apply_filters('trx_addons_filter_register_taxonomy',
				array(
					'post_type' 		=> TRX_ADDONS_CPT_SERVICES_PT,
					'hierarchical'      => true,
					'labels'            => array(
						'name'              => esc_html__( 'Services Group', 'trx_addons' ),
						'singular_name'     => esc_html__( 'Group', 'trx_addons' ),
						'search_items'      => esc_html__( 'Search Groups', 'trx_addons' ),
						'all_items'         => esc_html__( 'All Groups', 'trx_addons' ),
						'parent_item'       => esc_html__( 'Parent Group', 'trx_addons' ),
						'parent_item_colon' => esc_html__( 'Parent Group:', 'trx_addons' ),
						'edit_item'         => esc_html__( 'Edit Group', 'trx_addons' ),
						'update_item'       => esc_html__( 'Update Group', 'trx_addons' ),
						'add_new_item'      => esc_html__( 'Add New Group', 'trx_addons' ),
						'new_item_name'     => esc_html__( 'New Group Name', 'trx_addons' ),
						'menu_name'         => esc_html__( 'Services Groups', 'trx_addons' ),
					),
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => trx_addons_cpt_param('services', 'taxonomy_slug') )
				),
				TRX_ADDONS_CPT_SERVICES_PT,
				TRX_ADDONS_CPT_SERVICES_TAXONOMY
			)
		);
	}
}
// Allow Gutenberg as main editor for taxonomies
if ( ! function_exists( 'trx_addons_cpt_services_add_taxonomy_to_gutenberg' ) ) {
    add_filter( 'trx_addons_filter_add_taxonomy_to_gutenberg', 'trx_addons_cpt_services_add_taxonomy_to_gutenberg', 10, 2 );
    function trx_addons_cpt_services_add_taxonomy_to_gutenberg( $allow, $tax ) {
        return $allow || in_array( $tax, array( TRX_ADDONS_CPT_SERVICES_TAXONOMY ) );
    }
}

// Fill 'options' arrays when its need in the admin mode
if (!function_exists('trx_addons_cpt_services_before_show_options')) {
	add_filter('trx_addons_filter_before_show_options', 'trx_addons_cpt_services_before_show_options', 10, 2);
	function trx_addons_cpt_services_before_show_options($options, $post_type, $group='') {
		if ($post_type == TRX_ADDONS_CPT_SERVICES_PT) {
			foreach ($options as $id=>$field) {
				// Recursive call for options type 'group'
				if ($field['type'] == 'group' && !empty($field['fields'])) {
					$options[$id]['fields'] = trx_addons_cpt_courses_before_show_options($field['fields'], $post_type, $id);
					continue;
				}
				// Skip elements without param 'options'
				if (!isset($field['options']) || count($field['options'])>0) {
					continue;
				}
				// Fill the 'product' array
				if ($id == 'product') {
					$options[$id]['options'] = trx_addons_get_list_posts(false, 'product');
				}
			}
		}
		return $options;
	}
}

/* ------------------- Old way - moved to the cpt.php now ---------------------
// Add 'Services' parameters in the ThemeREX Addons Options
if (!function_exists('trx_addons_cpt_services_options')) {
	add_filter( 'trx_addons_filter_options', 'trx_addons_cpt_services_options');
	function trx_addons_cpt_services_options($options) {
		trx_addons_array_insert_after($options, 'cpt_section', trx_addons_cpt_services_get_list_options());
		return $options;
	}
}

// Return parameters list for plugin's options
if (!function_exists('trx_addons_cpt_services_get_list_options')) {
	function trx_addons_cpt_services_get_list_options($add_parameters=array()) {
		return apply_filters('trx_addons_cpt_list_options', array(
			'services_info' => array(
				"title" => esc_html__('Services', 'trx_addons'),
				"desc" => wp_kses_data( __('Settings of the services archive', 'trx_addons') ),
				"type" => "info"
			),
			'services_style' => array(
				"title" => esc_html__('Style', 'trx_addons'),
				"desc" => wp_kses_data( __('Style of the services archive', 'trx_addons') ),
				"std" => 'default_2',
				"options" => apply_filters('trx_addons_filter_cpt_archive_styles', 
											trx_addons_components_get_allowed_layouts('cpt', 'services', 'arh'),
											TRX_ADDONS_CPT_SERVICES_PT),
				"type" => "select"
			)
		), 'services');
	}
}
------------------- /Old way --------------------- */


	
// Merge shortcode's specific styles to the single stylesheet
if ( !function_exists( 'trx_addons_cpt_services_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_cpt_services_merge_styles');
	function trx_addons_cpt_services_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'services/_services.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_cpt_services_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_cpt_services_merge_styles_responsive');
	function trx_addons_cpt_services_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'services/_services.responsive.scss';
		return $list;
	}
}

	
// Merge shortcode's specific scripts to the single file
if ( !function_exists( 'trx_addons_cpt_services_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_cpt_services_merge_scripts');
	function trx_addons_cpt_services_merge_scripts($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'services/services.js';
		return $list;
	}
}


// Return true if it's services page
if ( !function_exists( 'trx_addons_is_services_page' ) ) {
	function trx_addons_is_services_page() {
		return defined('TRX_ADDONS_CPT_SERVICES_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_SERVICES_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT)
						|| is_tax(TRX_ADDONS_CPT_SERVICES_TAXONOMY)
						);
	}
}


// Return current page title
if ( !function_exists( 'trx_addons_cpt_services_get_blog_title' ) ) {
	add_filter( 'trx_addons_filter_get_blog_title', 'trx_addons_cpt_services_get_blog_title');
	function trx_addons_cpt_services_get_blog_title($title='') {
		if ( defined('TRX_ADDONS_CPT_SERVICES_PT') ) {
			if (is_single() && get_post_type()==TRX_ADDONS_CPT_SERVICES_PT) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				$title = array(
					'text' => get_the_title(),
					'class' => 'services_page_title'
				);
				if (!empty($meta['product']) && (int) $meta['product'] > 0) {
					$title['link'] = get_permalink($meta['product']);
					$title['link_text'] = esc_html__('Order now', 'trx_addons');
				}
			} else if ( is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT) ) {
				$obj = get_post_type_object(TRX_ADDONS_CPT_SERVICES_PT);
				$title = $obj->labels->all_items;
			}

		}
		return $title;
	}
}



// Replace standard theme templates
//-------------------------------------------------------------

// Change standard single template for services posts
if ( !function_exists( 'trx_addons_cpt_services_single_template' ) ) {
	add_filter('single_template', 'trx_addons_cpt_services_single_template');
	function trx_addons_cpt_services_single_template($template) {
		global $post;
		if (is_single() && $post->post_type == TRX_ADDONS_CPT_SERVICES_PT)
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'services/tpl.single.php');
		return $template;
	}
}

// Change standard archive template for services posts
if ( !function_exists( 'trx_addons_cpt_services_archive_template' ) ) {
	add_filter('archive_template',	'trx_addons_cpt_services_archive_template');
	function trx_addons_cpt_services_archive_template( $template ) {
		if ( is_post_type_archive(TRX_ADDONS_CPT_SERVICES_PT) )
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'services/tpl.archive.php');
		return $template;
	}	
}

// Change standard category template for services categories (groups)
if ( !function_exists( 'trx_addons_cpt_services_taxonomy_template' ) ) {
	add_filter('taxonomy_template',	'trx_addons_cpt_services_taxonomy_template');
	function trx_addons_cpt_services_taxonomy_template( $template ) {
		if ( is_tax(TRX_ADDONS_CPT_SERVICES_TAXONOMY) )
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'services/tpl.archive.php');
		return $template;
	}	
}

// Show related posts
if ( !function_exists( 'trx_addons_cpt_services_related_posts_after_article' ) ) {
	add_action('trx_addons_action_after_article', 'trx_addons_cpt_services_related_posts_after_article', 20, 1);
	function trx_addons_cpt_services_related_posts_after_article( $mode ) {
		if ($mode == 'services.single' && apply_filters('trx_addons_filter_show_related_posts_after_article', true)) {
			do_action('trx_addons_action_related_posts', $mode);
		}
	}
}

if ( !function_exists( 'trx_addons_cpt_services_related_posts_show' ) ) {
	add_filter('trx_addons_filter_show_related_posts', 'trx_addons_cpt_services_related_posts_show');
	function trx_addons_cpt_services_related_posts_show( $show ) {
		if (!$show && is_single() && get_post_type() == TRX_ADDONS_CPT_SERVICES_PT) {
			do_action('trx_addons_action_related_posts', 'services.single');
			$show = true;
		}
		return $show;
	}
}

if ( !function_exists( 'trx_addons_cpt_services_related_posts' ) ) {
	add_action('trx_addons_action_related_posts', 'trx_addons_cpt_services_related_posts', 10, 1);
	function trx_addons_cpt_services_related_posts( $mode ) {
		if ($mode == 'services.single') {
			$trx_addons_related_style   = explode('_', trx_addons_get_option('services_style'));
			$trx_addons_related_type    = $trx_addons_related_style[0];
			$trx_addons_related_columns = empty($trx_addons_related_style[1]) ? 1 : max(1, $trx_addons_related_style[1]);

			trx_addons_get_template_part('templates/tpl.posts-related.php',
												'trx_addons_args_related',
												apply_filters('trx_addons_filter_args_related', array(
																	'class' => 'services_page_related sc_services sc_services_'.esc_attr($trx_addons_related_type),
																	'posts_per_page' => $trx_addons_related_columns,
																	'columns' => $trx_addons_related_columns,
																	'template' => TRX_ADDONS_PLUGIN_CPT . 'services/tpl.'.trim($trx_addons_related_type).'-item.php',
																	'template_args_name' => 'trx_addons_args_sc_services',
																	'post_type' => TRX_ADDONS_CPT_SERVICES_PT,
																	'taxonomies' => array(TRX_ADDONS_CPT_SERVICES_TAXONOMY)
																	)
															)
											);
		}
	}
}



// Admin utils
// -----------------------------------------------------------------

// Show <select> with services categories in the admin filters area
if (!function_exists('trx_addons_cpt_services_admin_filters')) {
	add_action( 'restrict_manage_posts', 'trx_addons_cpt_services_admin_filters' );
	function trx_addons_cpt_services_admin_filters() {
		trx_addons_admin_filters(TRX_ADDONS_CPT_SERVICES_PT, TRX_ADDONS_CPT_SERVICES_TAXONOMY);
	}
}
  
// Clear terms cache on the taxonomy save
if (!function_exists('trx_addons_cpt_services_admin_clear_cache')) {
	add_action( 'edited_'.TRX_ADDONS_CPT_SERVICES_TAXONOMY, 'trx_addons_cpt_services_admin_clear_cache', 10, 1 );
	add_action( 'delete_'.TRX_ADDONS_CPT_SERVICES_TAXONOMY, 'trx_addons_cpt_services_admin_clear_cache', 10, 1 );
	add_action( 'created_'.TRX_ADDONS_CPT_SERVICES_TAXONOMY, 'trx_addons_cpt_services_admin_clear_cache', 10, 1 );
	function trx_addons_cpt_services_admin_clear_cache( $term_id=0 ) {  
		trx_addons_admin_clear_cache_terms(TRX_ADDONS_CPT_SERVICES_TAXONOMY);
	}
}


// AJAX details
// ------------------------------------------------------------
if ( !function_exists( 'trx_addons_callback_ajax_services_details' ) ) {
	add_action('wp_ajax_trx_addons_post_details_in_popup',			'trx_addons_callback_ajax_services_details');
	add_action('wp_ajax_nopriv_trx_addons_post_details_in_popup',	'trx_addons_callback_ajax_services_details');
	function trx_addons_callback_ajax_services_details() {
		if ( !wp_verify_nonce( trx_addons_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();

		if (($post_type = $_REQUEST['post_type']) == TRX_ADDONS_CPT_SERVICES_PT) {
			$post_id = $_REQUEST['post_id'];

			$response = array('error'=>'', 'data' => '');
	
			if (!empty($post_id)) {
				global $post;
				$post = get_post($post_id);
				setup_postdata( $post );
				ob_start();
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_CPT . 'services/tpl.details.php');
				$response['data'] = ob_get_contents();
				ob_end_clean();
			} else {
				$response['error'] = '<article class="services_page">' . esc_html__('Invalid query parameter!', 'trx_addons') . '</article>';
			}
		
			echo json_encode($response);
			die();
		}
	}
}


// trx_sc_services
//-------------------------------------------------------------
/*
[trx_sc_services id="unique_id" type="default" cat="category_slug or id" count="3" columns="3" slider="0|1"]
*/
if ( !function_exists( 'trx_addons_sc_services' ) ) {
	function trx_addons_sc_services($atts, $content=null) {	

		// Exit to prevent recursion
		if (trx_addons_sc_stack_check('trx_sc_services')) return '';

		$atts = trx_addons_sc_prepare_atts('trx_sc_services', $atts, array(
			// Individual params
			"type" => "default",
			"featured" => "image",
			"featured_position" => "top",
			"tabs_effect" => "fade",
			"hide_excerpt" => 0,
			"hide_bg_image" => 0,
			"icons_animation" => 0,
			"columns" => '',
			"no_margin" => 0,
			'no_links' => false,
			"pagination" => "none",
			"page" => 1,
			'post_type' => TRX_ADDONS_CPT_SERVICES_PT,
			'taxonomy' => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
			"cat" => '',
			"count" => 3,
			"offset" => 0,
			"orderby" => '',
			"order" => '',
			"ids" => '',
			"popup" => 0,
			"slider" => 0,
			"slider_pagination" => "none",
			"slider_controls" => "none",
			"slides_space" => 0,
			"slides_centered" => 0,
			"slides_overflow" => 0,
			"slider_mouse_wheel" => 0,
			"slider_autoplay" => 1,
			"more_text" => esc_html__('Read more', 'trx_addons'),
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
			)
		);

		if (in_array($atts['type'], array('tabs', 'tabs_simple')) && trx_addons_is_on(trx_addons_get_option('debug_mode')))
			wp_enqueue_script( 'trx_addons-cpt_services', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT . 'services/services.js'), array('jquery'), null, true );

		if ($atts['type'] == 'chess')
			$atts['columns'] = max(1, min(3, (int) $atts['columns']));
		else if ($atts['type'] == 'timeline') {
			$atts['no_margin'] = 1;
			if ($atts['featured']!='none' && in_array($atts['featured_position'], array('left', 'right')))
				$atts['columns'] = 1;
		}
		if ($atts['featured_position'] == 'bottom' && !in_array($atts['type'], array('callouts', 'timeline')))
			$atts['featured_position'] = 'top';
		if (!empty($atts['ids'])) {
			$atts['ids'] = str_replace(array(';', ' '), array(',', ''), $atts['ids']);
			$atts['count'] = count(explode(',', $atts['ids']));
		}
		$atts['count'] = max(1, (int) $atts['count']);
		$atts['offset'] = max(0, (int) $atts['offset']);
		if (empty($atts['orderby'])) $atts['orderby'] = 'title';
		if (empty($atts['order'])) $atts['order'] = 'asc';
		$atts['popup'] = max(0, (int) $atts['popup']);
		if ($atts['popup']) $atts['class'] .= (!empty($atts['class']) ? ' ' : '') . 'sc_services_popup sc_post_details_popup';
		$atts['slider'] = max(0, (int) $atts['slider']);
		if ($atts['slider'] > 0 && (int) $atts['slider_pagination'] > 0) $atts['slider_pagination'] = 'bottom';
		if ($atts['slider'] > 0) $atts['pagination'] = 'none';

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_CPT . 'services/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_CPT . 'services/tpl.default.php'
										),
                                        'trx_addons_args_sc_services',
                                        $atts
                                    );
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_services', $atts, $content);
	}
}


// Add [trx_sc_services] in the VC shortcodes list
if (!function_exists('trx_addons_sc_services_add_in_vc')) {
	function trx_addons_sc_services_add_in_vc() {
		
		add_shortcode("trx_sc_services", "trx_addons_sc_services");
		
		if (!trx_addons_exists_vc()) return;
		
		vc_lean_map("trx_sc_services", 'trx_addons_sc_services_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Services extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_services_add_in_vc', 20);
}

// Return params
if (!function_exists('trx_addons_sc_services_add_in_vc_params')) {
	function trx_addons_sc_services_add_in_vc_params() {
		// If open params in VC Editor
		list($vc_edit, $vc_params) = trx_addons_get_vc_form_params('trx_sc_services');
		// Prepare lists
		$post_type = $vc_edit && !empty($vc_params['post_type']) ? $vc_params['post_type'] : TRX_ADDONS_CPT_SERVICES_PT;
		$taxonomy = $vc_edit && !empty($vc_params['taxonomy']) ? $vc_params['taxonomy'] : TRX_ADDONS_CPT_SERVICES_TAXONOMY;
		$tax_obj = get_taxonomy($taxonomy);
		$params = array_merge(
				array(
					array(
						"param_name" => "type",
						"heading" => esc_html__("Layout", 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-6',
						"std" => "default",
				        'save_always' => true,
						"value" => array_flip(apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'services', 'sc'), 'trx_sc_services')),
						"type" => "dropdown"
					),
					array(
						"param_name" => "tabs_effect",
						"heading" => esc_html__("Tabs change effect", 'trx_addons'),
						"description" => wp_kses_data( __("Select the tabs change effect", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-6',
						'dependency' => array(
							'element' => 'type',
							'value' => 'tabs'
						),
						"std" => "fade",
				        'save_always' => true,
						"value" => array_flip(trx_addons_get_list_sc_services_tabs_effects()),
						"type" => "dropdown"
					),
					array(
						"param_name" => "featured",
						"heading" => esc_html__("Featured", 'trx_addons'),
						"description" => wp_kses_data( __("What to use as featured element?", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-6 vc_new_row',
						'dependency' => array(
							'element' => 'type',
							'value' => array('default', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline')
						),
						"std" => "image",
				        'save_always' => true,
						"value" => array_flip(trx_addons_get_list_sc_services_featured()),
						"type" => "dropdown"
					),
					array(
						"param_name" => "featured_position",
						"heading" => esc_html__("Featured position", 'trx_addons'),
						"description" => wp_kses_data( __("Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-6',
						'dependency' => array(
							'element' => 'featured',
							'value' => array('image', 'icon', 'number', 'pictogram')
						),
						"std" => "top",
				        'save_always' => true,
						"value" => array_flip(trx_addons_get_list_sc_services_featured_positions()),
						"type" => "dropdown"
					),
					array(
						"param_name" => "no_links",
						"heading" => esc_html__("Disable links", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want disable links to the single posts", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4 vc_new_row',
						"std" => "0",
						"value" => array(esc_html__("Disable links", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "more_text",
						"heading" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array(
							'element' => 'no_links',
							'is_empty' => true
						),
						"std" => esc_html__('Read more', 'trx_addons'),
						"type" => "textfield"
					),
					array(
						"param_name" => "pagination",
						"heading" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"std" => 'none',
						"value" => array_flip(trx_addons_get_list_sc_paginations()),
						"type" => "dropdown"
					),
					array(
						"param_name" => "hide_excerpt",
						"heading" => esc_html__("Excerpt", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4 vc_new_row',
						"std" => "0",
						"value" => array(esc_html__("Hide excerpt", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "no_margin",
						"heading" => esc_html__("Remove margin", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want remove spaces between columns", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						"std" => "0",
						"value" => array(esc_html__("Remove margin", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "icons_animation",
						"heading" => esc_html__("Animation", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array(
							'element' => 'featured',
							'value' => array('icon')
						),
						"std" => "0",
						"value" => array(esc_html__("Animate icons", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "hide_bg_image",
						"heading" => esc_html__("Hide bg image", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide background image on the front item", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'dependency' => array(
							'element' => 'type',
							'value' => 'hover'
						),
						"std" => "0",
						"value" => array(esc_html__("Hide bg image", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "popup",
						"heading" => esc_html__("Open in the popup", 'trx_addons'),
						"description" => wp_kses_data( __("Open details in the popup or navigate to the single post (default)", 'trx_addons') ),
						"admin_label" => true,
						'edit_field_class' => 'vc_col-sm-4',
						"std" => "0",
						"value" => array(esc_html__("Popup", 'trx_addons') => "1" ),
						"type" => "checkbox"
					),
					array(
						"param_name" => "post_type",
						"heading" => esc_html__("Post type", 'trx_addons'),
						"description" => wp_kses_data( __("Select post type to show posts", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4 vc_new_row',
						'group' => esc_html__('Query', 'trx_addons'),
						"std" => TRX_ADDONS_CPT_SERVICES_PT,
						"value" => array_flip(trx_addons_get_list_posts_types()),
						"type" => "dropdown"
					),
					array(
						"param_name" => "taxonomy",
						"heading" => esc_html__("Taxonomy", 'trx_addons'),
						"description" => wp_kses_data( __("Select taxonomy to show posts", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'group' => esc_html__('Query', 'trx_addons'),
						"std" => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
						"value" => array_flip(trx_addons_get_list_taxonomies(false, $post_type)),
						"type" => "dropdown"
					),
					array(
						"param_name" => "cat",
						"heading" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Services group", 'trx_addons') ),
						'edit_field_class' => 'vc_col-sm-4',
						'group' => esc_html__('Query', 'trx_addons'),
						"value" => array_flip(trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																		 $taxonomy == 'category' 
																			? trx_addons_get_list_categories() 
																			: trx_addons_get_list_terms(false, $taxonomy)
																		)),
						"std" => "0",
						"type" => "dropdown"
					)
				),
				trx_addons_vc_add_query_param(),
				trx_addons_vc_add_slider_param(),
				trx_addons_vc_add_title_param(),
				trx_addons_vc_add_id_param()
		);
		
		// Add dependencies to params
		$params = trx_addons_vc_add_param_option($params, 'columns', array( 
																	'dependency' => array(
																		'element' => 'type',
																		'value' => array('default','callouts','light','list','iconed','hover','chess','timeline')
																		)
																	)
												);
		$params = trx_addons_vc_add_param_option($params, 'slider', array( 
																	'dependency' => array(
																		'element' => 'type',
																		'value' => array('default','callouts','light','list','iconed','hover','chess','timeline')
																		)
																	)
												);
												
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_services",
				"name" => esc_html__("Services", 'trx_addons'),
				"description" => wp_kses_data( __("Display services from specified group", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_services',
				"class" => "trx_sc_services",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => $params
			), 'trx_sc_services' );
	}
}




// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_services_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_services_add_in_elementor' );
	function trx_addons_sc_services_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Services extends TRX_Addons_Elementor_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_services';
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
				return __( 'Services', 'trx_addons' );
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
				return 'eicon-info-box';
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
				return ['trx_addons-cpt'];
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
				// If open params in Elementor Editor
				$params = $this->get_sc_params();
				// Prepare lists
				$post_type = !empty($params['post_type']) ? $params['post_type'] : TRX_ADDONS_CPT_SERVICES_PT;
				$taxonomy = !empty($params['taxonomy']) ? $params['taxonomy'] : TRX_ADDONS_CPT_SERVICES_TAXONOMY;
				$tax_obj = get_taxonomy($taxonomy);
				
				$this->start_controls_section(
					'section_sc_services',
					[
						'label' => __( 'Services', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'services', 'sc'), 'trx_sc_services'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'featured',
					[
						'label' => __( 'Featured', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_services_featured(),
						'default' => 'image',
						'condition' => [
							'type' => ['default', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
						]
					]
				);

				$this->add_control(
					'featured_position',
					[
						'label' => __( 'Featured position', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_services_featured_positions(),
						'default' => 'top',
						'condition' => [
							'featured' => ['image', 'icon', 'number', 'pictogram']
						]
					]
				);

				$this->add_control(
					'pagination',
					[
						'label' => __( 'Pagination', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_paginations(),
						'default' => 'none'
					]
				);

				$this->add_control(
					'post_type',
					[
						'label' => __( 'Post type', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_posts_types(),
						'default' => TRX_ADDONS_CPT_SERVICES_PT
					]
				);

				$this->add_control(
					'taxonomy',
					[
						'label' => __( 'Taxonomy', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_taxonomies(false, $post_type),
						'default' => TRX_ADDONS_CPT_SERVICES_TAXONOMY
					]
				);

				$this->add_control(
					'cat',
					[
						'label' => __( 'Group', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																		 $taxonomy == 'category' 
																			? trx_addons_get_list_categories() 
																			: trx_addons_get_list_terms(false, $taxonomy)
																		),
						'default' => '0'
					]
				);

				$this->add_query_param('', [
						'columns' => [ 
									'condition' => [
										'type' => ['default','callouts','light','list','iconed','hover','chess','timeline']
									]
						]
					]);

				$this->end_controls_section();

				$this->start_controls_section(
					'section_sc_services_details',
					[
						'label' => __( 'Details', 'trx_addons' ),
						'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
					]
				);

				$this->add_control(
					'tabs_effect',
					[
						'label' => __( 'Tabs change effect', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_services_tabs_effects(),
						'default' => 'fade',
						'condition' => [
							'type' => 'tabs'
						]
					]
				);

				$this->add_control(
					'hide_excerpt',
					[
						'label' => __( 'Excerpt', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Show', 'trx_addons' ),
						'label_on' => __( 'Hide', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'no_margin',
					[
						'label' => __( 'Remove margin', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'icons_animation',
					[
						'label' => __( 'Animation', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'hide_bg_image',
					[
						'label' => __( 'Hide bg image', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Check if you want hide background image on the front item", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'popup',
					[
						'label' => __( 'Open in the popup', 'trx_addons' ),
						'label_block' => false,
						'description' => wp_kses_data( __("Open details in the popup or navigate to the single post (default)", 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'no_links',
					[
						'label' => __( 'Disable links', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1'
					]
				);

				$this->add_control(
					'more_text',
					[
						'label' => __( "'More' text", 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__('Read more', 'trx_addons'),
						'condition' => [
							'no_links' => ''
						]
					]
				);

				$this->end_controls_section();
				
				$this->add_slider_param(false, [
					'slider' => [
								'condition' => [
									'type' => ['default','callouts','light','list','iconed','hover','chess','timeline']
								]
					]
				]);
				
				$this->add_title_param();
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Services() );
	}
}


// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_services_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_services_black_list' );
	function trx_addons_sc_services_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Services';
		return $list;
	}
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Services extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_services',
				esc_html__('ThemeREX Services', 'trx_addons'),
				array(
					'classname' => 'widget_services',
					'description' => __('Display services', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Services');
			// Prepare lists
			$post_type = $vc_edit && !empty($vc_params['post_type']) ? $vc_params['post_type'] : TRX_ADDONS_CPT_SERVICES_PT;
			$taxonomy = $vc_edit && !empty($vc_params['taxonomy']) ? $vc_params['taxonomy'] : TRX_ADDONS_CPT_SERVICES_TAXONOMY;
			$tax_obj = get_taxonomy($taxonomy);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'services', 'sc'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('type')
						),
						'type' => 'select'
					),
					"featured" => array(
						"label" => esc_html__("Featured", 'trx_addons'),
						"description" => wp_kses_data( __("What to use as featured element?", 'trx_addons') ),
						"default" => 'image',
						"options" => trx_addons_get_list_sc_services_featured(),
						"type" => "select"
					),
					"featured_position" => array(
						"label" => esc_html__("Featured position", 'trx_addons'),
						"description" => wp_kses_data( __("Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"type[callouts]" => array('show'),
							"type[light]" => array('show'),
							"type[list]" => array('show'),
							"type[tabs_simple]" => array('show'),
							"type[timeline]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => 'top',
						"options" => trx_addons_get_list_sc_services_featured_positions(),
						"type" => "select"
					),
					"tabs_effect" => array(
						"label" => esc_html__("Tabs change effect", 'trx_addons'),
						"description" => wp_kses_data( __("Select the tabs change effect", 'trx_addons') ),
						'state_handler' => array(
							"type[tabs]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => 'fade',
						"options" => trx_addons_get_list_sc_services_tabs_effects(),
						"type" => "select"
					),
					"hide_excerpt" => array(
						"label" => esc_html__("Hide excerpt", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
						'state_handler' => array(
							"type[hover]" => array('hide'),
							"_else[type]" => array('show')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"no_links" => array(
						"label" => esc_html__("Disable links", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want disable links to the single posts", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox",
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_links[default]: val==true',
								'use_links[hide]: val!=true',
							)
						),
					),
					"more_text" => array(
						"label" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						"default" => esc_html__('Read more', 'trx_addons'),
						"type" => "text",
						'state_handler' => array(
							"use_links[default]" => array('show'),
							"use_links[hide]" => array('hide')
						),
					),
					"no_margin" => array(
						"label" => esc_html__("Remove margin", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want remove spaces between columns", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					"icons_animation" => array(
						"label" => esc_html__("Icons animation", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"type[callouts]" => array('show'),
							"type[light]" => array('show'),
							"type[list]" => array('show'),
							"type[iconed]" => array('show'),
							"type[tabs]" => array('show'),
							"type[tabs_simple]" => array('show'),
							"type[timeline]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"hide_bg_image" => array(
						"label" => esc_html__("Hide bg image", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide background image on the front item", 'trx_addons') ),
						'state_handler' => array(
							"type[hover]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"popup" => array(
						"label" => esc_html__("Open in the popup", 'trx_addons'),
						"description" => wp_kses_data( __("Open details in the popup or navigate to the single post (default)", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					"pagination" => array(
						"label" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						"default" => 'none',
						"options" => trx_addons_get_list_sc_paginations(),
						"type" => "select"
					),
					"post_type" => array(
						"label" => esc_html__("Post type", 'trx_addons'),
						"description" => wp_kses_data( __("Select post type to show posts", 'trx_addons') ),
						"default" => TRX_ADDONS_CPT_SERVICES_PT,
						"options" => trx_addons_get_list_posts_types(),
						"type" => "select"
					),
					"taxonomy" => array(
						"label" => esc_html__("Taxonomy", 'trx_addons'),
						"description" => wp_kses_data( __("Select taxonomy to show posts", 'trx_addons') ),
						"default" => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
						"options" => trx_addons_get_list_taxonomies(false, $post_type),
						"type" => "select_dynamic"
					),
					"cat" => array(
						"label" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Services group to show posts", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																	 $taxonomy == 'category' 
																		? trx_addons_get_list_categories() 
																		: trx_addons_get_list_terms(false, $taxonomy)
																	),
						"type" => "select_dynamic"
					)
				),
				trx_addons_sow_add_query_param('', array(
					'columns' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[callouts]" => array('show'),
										"type[light]" => array('show'),
										"type[list]" => array('show'),
										"type[iconed]" => array('show'),
										"type[hover]" => array('show'),
										"type[chess]" => array('show'),
										"type[timeline]" => array('show'),
										"_else[type]" => array('hide')
									)
								)
				)),
				trx_addons_sow_add_slider_param(false, array(
					'slider' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[callouts]" => array('show'),
										"type[light]" => array('show'),
										"type[list]" => array('show'),
										"type[iconed]" => array('show'),
										"type[hover]" => array('show'),
										"type[chess]" => array('show'),
										"type[timeline]" => array('show'),
										"_else[type]" => array('hide')
									)
								)
				)),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_services', __FILE__, 'TRX_Addons_SOW_Widget_Services');


// TRX_Addons Widget
//------------------------------------------------------
} else {

	class TRX_Addons_SOW_Widget_Services extends TRX_Addons_Widget {
	
		function __construct() {
			$widget_ops = array('classname' => 'widget_services', 'description' => esc_html__('Show services items', 'trx_addons'));
			parent::__construct( 'trx_addons_sow_widget_services', esc_html__('ThemeREX Services', 'trx_addons'), $widget_ops );
		}
	
		// Show widget
		function widget($args, $instance) {
			extract($args);
	
			$widget_title = apply_filters('widget_title', isset($instance['widget_title']) ? $instance['widget_title'] : '');
	
			$output = trx_addons_sc_services(apply_filters('trx_addons_filter_widget_args',
														$instance,
														$instance, 'trx_addons_sow_widget_services')
														);
	
			if (!empty($output)) {
		
				// Before widget (defined by themes)
				trx_addons_show_layout($before_widget);
				
				// Display the widget title if one was input (before and after defined by themes)
				if ($widget_title) trx_addons_show_layout($before_title . $widget_title . $after_title);
		
				// Display widget body
				trx_addons_show_layout($output);
				
				// After widget (defined by themes)
				trx_addons_show_layout($after_widget);
			}
		}
	
		// Update the widget settings
		function update($new_instance, $instance) {
			$instance = array_merge($instance, $new_instance);
			$instance['hide_excerpt'] = isset( $new_instance['hide_excerpt'] ) ? 1 : 0;
			$instance['no_margin'] = isset( $new_instance['no_margin'] ) ? 1 : 0;
			$instance['no_links'] = isset( $new_instance['no_links'] ) ? 1 : 0;
			$instance['hide_bg_image'] = isset( $new_instance['hide_bg_image'] ) ? 1 : 0;
			$instance['icons_animation'] = isset( $new_instance['icons_animation'] ) ? 1 : 0;
			$instance['popup'] = isset( $new_instance['popup'] ) ? 1 : 0;
			$instance['slider'] = isset( $new_instance['slider'] ) ? 1 : 0;
			$instance['slides_centered'] = isset( $new_instance['slides_centered'] ) ? 1 : 0;
			$instance['slides_overflow'] = isset( $new_instance['slides_overflow'] ) ? 1 : 0;
			$instance['slider_mouse_wheel'] = isset( $new_instance['slider_mouse_wheel'] ) ? 1 : 0;
			$instance['slider_autoplay'] = isset( $new_instance['slider_autoplay'] ) ? 1 : 0;
			return apply_filters('trx_addons_filter_widget_args_update', $instance, $new_instance, 'trx_addons_sow_widget_services');
		}
	
		// Displays the widget settings controls on the widget panel
		function form($instance) {
			// Set up some default widget settings
			$instance = wp_parse_args( (array) $instance, apply_filters('trx_addons_filter_widget_args_default', array(
				'widget_title' => '',
				// Layout params
				"type" => "default",
				"featured" => "image",
				"featured_position" => "top",
				"tabs_effect" => "fade",
				"hide_excerpt" => 0,
				"hide_bg_image" => 0,
				"icons_animation" => 0,
				"popup" => 0,
				"no_margin" => 0,
				"no_links" => 0,
				"more_text" => __('Read more', 'trx_addons'),
				// Query params
				'pagination' => 'none',
				'post_type' => TRX_ADDONS_CPT_SERVICES_PT,
				'taxonomy' => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
				"cat" => '',
				"count" => 3,
				"columns" => '',
				"offset" => 0,
				"orderby" => 'date',
				"order" => 'desc',
				"ids" => '',
				// Slider params
				"slider" => 0,
				"slider_pagination" => "none",
				"slider_controls" => "none",
				"slides_space" => 0,
				"slides_centered" => 0,
				"slides_overflow" => 0,
				"slider_mouse_wheel" => 0,
				"slider_autoplay" => 1,
				// Title params
				"title" => "",
				"subtitle" => "",
				"description" => "",
				"link" => '',
				"link_style" => 'default',
				"link_image" => '',
				"link_text" => __('Learn more', 'trx_addons'),
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
				), 'trx_addons_sow_widget_services')
			);
		
			do_action('trx_addons_action_before_widget_fields', $instance, 'trx_addons_sow_widget_services');

			$this->show_field(array('name' => 'widget_title',
									'title' => __('Widget title:', 'trx_addons'),
									'value' => $instance['widget_title'],
									'type' => 'text'));
		
			do_action('trx_addons_action_after_widget_title', $instance, 'trx_addons_sow_widget_services');
			
			$this->show_field(array('title' => __('Layout parameters', 'trx_addons'),
									'type' => 'info'));
			
			$this->show_field(array('name' => 'type',
									'title' => __('Layout:', 'trx_addons'),
									'value' => $instance['type'],
									'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'services', 'sc'), 'trx_widget_services'),
									'type' => 'select'));
			
			$this->show_field(array('name' => 'featured',
									'title' => __('Featured element:', 'trx_addons'),
									'value' => $instance['featured'],
									'options' => trx_addons_get_list_sc_services_featured(),
									'type' => 'switch'));
			
			$this->show_field(array('name' => 'featured_position',
									'title' => __('Featured position:', 'trx_addons'),
									'description' => wp_kses_data( __("Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'", 'trx_addons') ),
									'value' => $instance['featured_position'],
									'options' => trx_addons_get_list_sc_services_featured_positions(),
									'type' => 'switch'));

			$this->show_field(array('name' => 'hide_excerpt',
									'title' => '',
									'label' => __('Hide excerpt', 'trx_addons'),
									'value' => (int) $instance['hide_excerpt'],
									'type' => 'checkbox'));

			$this->show_field(array('name' => 'no_margin',
									'title' => '',
									'label' => __('Remove margin between columns', 'trx_addons'),
									'value' => (int) $instance['no_margin'],
									'type' => 'checkbox'));

			$this->show_field(array('name' => 'no_links',
									'title' => '',
									'label' => __('Disable links', 'trx_addons'),
									'value' => (int) $instance['no_links'],
									'type' => 'checkbox'));
			
			$this->show_field(array('name' => 'more_text',
									'title' => __("'More' text", 'trx_addons'),
									'value' => (int) $instance['more_text'],
									'type' => 'text'));

			$this->show_field(array('name' => 'hide_bg_image',
									'title' => '',
									'label' => __('Hide bg image on "Hover" style', 'trx_addons'),
									'value' => (int) $instance['hide_bg_image'],
									'type' => 'checkbox'));

			$this->show_field(array('name' => 'icons_animation',
									'title' => '',
									'description' => __('Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon', 'trx_addons'),
									'label' => __('Animate icons', 'trx_addons'),
									'value' => (int) $instance['icons_animation'],
									'type' => 'checkbox'));

			$this->show_field(array('name' => 'popup',
									'title' => '',
									'label' => __('Details in the popup', 'trx_addons'),
									'value' => (int) $instance['popup'],
									'type' => 'checkbox'));

			$this->show_field(array('title' => __('Query parameters', 'trx_addons'),
									'type' => 'info'));

			$this->show_field(array('name' => 'pagination',
									'title' => __('Pagination:', 'trx_addons'),
									'value' => $instance['pagination'],
									'options' => trx_addons_get_list_sc_paginations(),
									'type' => 'select'));

			$this->show_field(array('name' => 'post_type',
									'title' => __('Post type:', 'trx_addons'),
									'value' => $instance['post_type'],
									'options' => trx_addons_get_list_posts_types(),
									'class' => 'trx_addons_post_type_selector',
									'type' => 'select'));
			
			$this->show_field(array('name' => 'taxonomy',
									'title' => __('Taxonomy:', 'trx_addons'),
									'value' => $instance['taxonomy'],
									'options' => trx_addons_get_list_taxonomies(false, $instance['post_type']),
									'class' => 'trx_addons_taxonomy_selector',
									'type' => 'select'));


			$tax_obj = get_taxonomy($instance['taxonomy']);

			$this->show_field(array('name' => 'cat',
									'title' => __('Services Group:', 'trx_addons'),
									'value' => $instance['cat'],
									'options' => trx_addons_array_merge(
											array(0 => sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
											trx_addons_get_list_terms(false, $instance['taxonomy'], array('pad_counts' => true))),
									'class' => 'trx_addons_terms_selector',
									'type' => 'select'));
			
			$this->show_fields_query_param($instance, '');
			$this->show_fields_slider_param($instance);
			$this->show_fields_title_param($instance);
			$this->show_fields_id_param($instance);
		
			do_action('trx_addons_action_after_widget_fields', $instance, 'trx_addons_sow_widget_services');
		}
	}

	// Load widget
	if (!function_exists('trx_addons_sow_widget_services_load')) {
		add_action( 'widgets_init', 'trx_addons_sow_widget_services_load' );
		function trx_addons_sow_widget_services_load() {
			register_widget('TRX_Addons_SOW_Widget_Services');
		}
	}
}




// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_services_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_services_editor_assets' );
	function trx_addons_gutenberg_sc_services_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-services',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT . 'services/gutenberg/services.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT . 'services/gutenberg/services.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_services_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_services_add_in_gutenberg' );
	function trx_addons_sc_services_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/services', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'tabs_effect'        => array(
							'type'    => 'string',
							'default' => 'fade',
						),
						'featured'           => array(
							'type'    => 'string',
							'default' => 'image',
						),
						'featured_position'  => array(
							'type'    => 'string',
							'default' => 'top',
						),
						'no_links'           => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'more_text'          => array(
							'type'    => 'string',
							'default' => esc_html__( 'Read more' ),
						),
						'pagination'         => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'hide_excerpt'       => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'no_margin'          => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'icons_animation'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_bg_image'      => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'popup'              => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'post_type'          => array(
							'type'    => 'string',
							'default' => TRX_ADDONS_CPT_SERVICES_PT,
						),
						'taxonomy'           => array(
							'type'    => 'string',
							'default' => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
						),
						'cat'                => array(
							'type'    => 'string',
							'default' => '0',
						),
						// Query attributes
						'ids'                => array(
							'type'    => 'string',
							'default' => '',
						),
						'count'              => array(
							'type'    => 'number',
							'default' => 2,
						),
						'columns'            => array(
							'type'    => 'number',
							'default' => 2,
						),
						'offset'             => array(
							'type'    => 'number',
							'default' => 0,
						),
						'orderby'            => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'order'              => array(
							'type'    => 'string',
							'default' => 'asc',
						),
						// Slider attributes
						'slider'             => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_space'       => array(
							'type'    => 'number',
							'default' => 0,
						),
						'slides_centered'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_overflow'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_mouse_wheel' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_autoplay'    => array(
							'type'    => 'boolean',
							'default' => true,
						),
						'slider_controls'    => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'slider_pagination'  => array(
							'type'    => 'string',
							'default' => 'none',
						),
						// Title attributes
						'title_style'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_tag'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_align'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color2'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'gradient_direction' => array(
							'type'    => 'string',
							'default' => '0',
						),
						'title'              => array(
							'type'    => 'string',
							'default' => esc_html__( 'Services', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
							'type'    => 'string',
							'default' => '',
						),
						// Button attributes
						'link'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_text'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_style'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'link_image_url'     => array(
							'type'    => 'string',
							'default' => '',
						),
						// ID, Class, CSS attributes
						'id'                 => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'                => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_services_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_services_render_block' ) ) {
	function trx_addons_gutenberg_sc_services_render_block( $attributes = array() ) {
		return trx_addons_sc_services( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_services_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_services_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_services_get_layouts( $array = array() ) {
		$array['trx_sc_services'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'cpt', 'services', 'sc' ), 'trx_sc_services' );

		return $array;
	}
}

// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_services_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_services_params' );
	function trx_addons_gutenberg_sc_services_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {

			$vars['CPT_SERVICES_PT']       = TRX_ADDONS_CPT_SERVICES_PT;
			$vars['CPT_SERVICES_TAXONOMY'] = TRX_ADDONS_CPT_SERVICES_TAXONOMY;

			// Return list of the featured elements in services
			$vars['sc_services_featured'] = trx_addons_get_list_sc_services_featured();

			// Return list of positions of the featured element in services
			$vars['sc_services_featured_positions'] = trx_addons_get_list_sc_services_featured_positions();

			// Return list of the tabs effects in services
			$vars['sc_services_tabs_effects'] = trx_addons_get_list_sc_services_tabs_effects();

			return $vars;
		}
	}
}
