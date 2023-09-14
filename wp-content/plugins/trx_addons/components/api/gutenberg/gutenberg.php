<?php
/**
 * Plugin support: Gutenberg
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0.49
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Check if plugin 'Gutenberg' is installed and activated
// Attention! This function is used in many files and was moved to the api.php
/*
if ( !function_exists( 'trx_addons_exists_gutenberg' ) ) {
	function trx_addons_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}
*/

// Return true if Gutenberg exists and current mode is preview
if ( !function_exists( 'trx_addons_gutenberg_is_preview' ) ) {
	function trx_addons_gutenberg_is_preview() {
		return trx_addons_exists_gutenberg() 
				&& (
					trx_addons_gutenberg_is_block_render_action()
					||
					trx_addons_is_post_edit()
					);
	}
}

// Return true if current mode is "Block render"
if ( !function_exists( 'trx_addons_gutenberg_is_block_render_action' ) ) {
	function trx_addons_gutenberg_is_block_render_action() {
		return trx_addons_exists_gutenberg() 
				&& trx_addons_check_url('block-renderer') && !empty($_GET['context']) && $_GET['context']=='edit';
	}
}
	
// Merge specific styles into single stylesheet
if ( !function_exists( 'trx_addons_gutenberg_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_gutenberg_merge_styles');
	function trx_addons_gutenberg_merge_styles($list) {
		if (trx_addons_exists_gutenberg()) {
			//$list[] = TRX_ADDONS_PLUGIN_API . 'gutenberg/_gutenberg.scss';
		}
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_gutenberg_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_gutenberg_merge_styles_responsive');
	function trx_addons_gutenberg_merge_styles_responsive($list) {
		if (trx_addons_exists_gutenberg()) {
			$list[] = TRX_ADDONS_PLUGIN_API . 'gutenberg/_gutenberg.responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Backend Editor mode
if ( !function_exists( 'trx_addons_gutenberg_editor_load_scripts' ) ) {
	add_action("enqueue_block_editor_assets", 'trx_addons_gutenberg_editor_load_scripts');
	function trx_addons_gutenberg_editor_load_scripts() {
		trx_addons_load_scripts_admin(true);
		trx_addons_localize_scripts_admin();
		wp_enqueue_style( 'trx_addons', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'gutenberg/gutenberg-preview.css'), array(), null );
		if (trx_addons_get_setting('allow_gutenberg_blocks')) {
			wp_enqueue_style( 'trx_addons-gutenberg-blocks-editor', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'gutenberg/blocks/dist/blocks.editor.build.css'), array(), null );
			wp_enqueue_script( 'trx_addons-gutenberg-blocks', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'gutenberg/blocks/dist/blocks.build.js'), array('jquery'), null, true );

			// Load Swiper slider script and styles
			trx_addons_enqueue_slider();

			// Load Popup script and styles
			trx_addons_enqueue_popup();

			// Load merged scripts
			wp_enqueue_script( 'trx_addons', trx_addons_get_file_url( 'js/trx_addons.js' ), array( 'jquery' ), null, true );
		}
		do_action('trx_addons_action_pagebuilder_admin_scripts');
	}
}

// Load required scripts for both: Backend + Frontend mode
if ( !function_exists( 'trx_addons_gutenberg_preview_load_scripts' ) ) {
	add_action("enqueue_block_assets", 'trx_addons_gutenberg_preview_load_scripts');
	function trx_addons_gutenberg_preview_load_scripts() {
		if (trx_addons_get_setting('allow_gutenberg_blocks')) {
			wp_enqueue_style(  'trx_addons-gutenberg-blocks', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'gutenberg/blocks/dist/blocks.style.build.css'), array(), null );
		}
		do_action('trx_addons_action_pagebuilder_preview_scripts', 'gutenberg');
	}
}

// Add shortcode's specific vars to the JS storage
if ( !function_exists( 'trx_addons_gutenberg_localize_script' ) ) {
	add_filter("trx_addons_filter_localize_script", 'trx_addons_gutenberg_localize_script');
	function trx_addons_gutenberg_localize_script($vars) {
		return $vars;
	}
}

// Add shortcode's specific vars to the JS storage (admin area)
if ( ! function_exists( 'trx_addons_gutenberg_localize_scripts_admin' ) ) {
	add_filter( 'trx_addons_filter_localize_script_admin', 'trx_addons_gutenberg_localize_scripts_admin' );
	function trx_addons_gutenberg_localize_scripts_admin( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			$vars['gutenberg_allowed_blocks'] = trx_addons_gutenberg_get_list_allowed_blocks();
			$vars['gutenberg_sc_params']      = apply_filters(
													'trx_addons_filter_gutenberg_sc_params',
													array(
														'list_spacer_heights' => trx_addons_get_list_sc_empty_space_heights()
													)
												);
		}
		return $vars;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'trx_addons_gutenberg_save_css' ) ) {
	add_action( 'trx_addons_action_save_options', 'trx_addons_gutenberg_save_css', 30 );
	add_action( 'trx_addons_action_save_options_theme', 'trx_addons_gutenberg_save_css', 30 );
	function trx_addons_gutenberg_save_css() {

		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'trx_addons' )
				. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = trx_addons_fgc( trx_addons_get_file_dir( 'css/trx_addons.css' ) );

		// Add context class to each selector
		$css = trx_addons_css_add_context($css, '.edit-post-visual-editor');

		// Save styles to the file
		trx_addons_fpc( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_API . 'gutenberg/gutenberg-preview.css' ), $msg . $css );
	}
}


// Add compatibility with Gutenberg to our post types
if ( ! function_exists( 'trx_addons_gutenberg_enable_cpt' ) ) {
	add_filter( 'trx_addons_filter_register_post_type', 'trx_addons_gutenberg_enable_cpt', 10, 2 );
	function trx_addons_gutenberg_enable_cpt($args, $post_type) {
		if ( trx_addons_exists_gutenberg() ) {
			$args['show_in_rest'] = true;
		}
		return $args;
	}
}


//------------------------------------------------------------
//-- Compatibility Gutenberg and other PageBuilders
//-------------------------------------------------------------

// Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)
if ( ! function_exists( 'trx_addons_gutenberg_disable_cpt' ) ) {
	add_filter( 'gutenberg_can_edit_post_type', 'trx_addons_gutenberg_disable_cpt', 999, 2 );
	function trx_addons_gutenberg_disable_cpt($can, $post_type) {
		$safe_pb = trx_addons_get_setting( 'gutenberg_safe_mode' );
		if ( $can && !empty($safe_pb) ) {
			$disable = false;
			if ( !$disable && in_array('elementor', $safe_pb) && trx_addons_exists_elementor() ) {
				$post_types = get_post_types_by_support( 'elementor' );
				$disable = is_array($post_types) && in_array($post_type, $post_types);
			}
			if ( !$disable && in_array('vc', $safe_pb) && trx_addons_exists_vc() ) {
				$post_types = function_exists('vc_editor_post_types') ? vc_editor_post_types() : array();
				$disable = is_array($post_types) && in_array($post_type, $post_types);
			}
			if ($disable) {
				$can = false;
			}
		}
		return $can;
	}
}


//------------------------------------------------------------
//-- Shortcodes support
//-------------------------------------------------------------

// Add inline CSS to the shortcode's layout
// if called from AJAX with action 'block-render'
if ( ! function_exists( 'trx_addons_gutenberg_print_inline_css' ) ) {
	add_filter( 'trx_addons_sc_output', 'trx_addons_gutenberg_print_inline_css', 10, 4 );
	function trx_addons_gutenberg_print_inline_css( $output, $sc, $atts, $content ) {
		if (trx_addons_gutenberg_is_block_render_action()) {
			// Add inline styles
			$css = trx_addons_get_inline_css(true);
			if (!empty($css)) {
				$output .= sprintf('<style type="text/css">%s</style>', $css);
			}
		}
		return $output;
	}
}
// Add compatibility with Gutenberg to our taxonomies
if ( ! function_exists( 'trx_addons_gutenberg_enable_taxonomies' ) ) {

    add_filter( 'trx_addons_filter_register_taxonomy', 'trx_addons_gutenberg_enable_taxonomies', 10, 3 );
    function trx_addons_gutenberg_enable_taxonomies($args, $post_type, $taxonomy) {
        if ( trx_addons_exists_gutenberg() && ( ! isset( $args['meta_box_cb'] ) || $args['meta_box_cb'] !== false ) && apply_filters( 'trx_addons_filter_add_taxonomy_to_gutenberg', false, $taxonomy ) ) {
            $args['show_in_rest'] = true;
        }
        return $args;
    }
}


// Get list of blocks, allowed inside block-container (i.e. "Content area")
if ( ! function_exists( 'trx_addons_gutenberg_get_list_allowed_blocks' ) ) {
	function trx_addons_gutenberg_get_list_allowed_blocks( $exclude = '' ) {
		if ( !is_array($exclude) ) {
			$exclude = !empty($exclude) ? explode(',', $exclude) : array();
		}
		// This way not include many 'core/xxx' blocks
		//$list = trx_addons_gutenberg_get_list_registered_blocks();
		// Manual way
		global $TRX_ADDONS_STORAGE;
		$list = array( 'core/archives',			'core/block',			'core/categories',
						'core/latest-comments',	'core/latest-posts',	'core/shortcode',
						'core/heading',			'core/subheading',		'core/paragraph',
						'core/quote',			'core/list',			'core/image',
						'core/gallery',			'core/audio',			'core/video',
						'core/code',			'core/classic',			'core/custom-html',
						'core/table',			'core/columns',			'core/spacer',
						'core/separator',		'core/button',			'core/more',
						'core/preformatted'
					);
		$registry = WP_Block_Type_Registry::get_instance();
		foreach ( $TRX_ADDONS_STORAGE['sc_list'] as $key => $value ) {
			if ( $registry->is_registered( 'trx-addons/' . $key ) ) {
				$list[] = 'trx-addons/' . $key;
			}
		}
		foreach ( $TRX_ADDONS_STORAGE['widgets_list'] as $key => $value ) {
			if ( $registry->is_registered( 'trx-addons/' . $key ) ) {
				$list[] = 'trx-addons/' . $key;
			}
		}
		foreach ( $TRX_ADDONS_STORAGE['cpt_list'] as $key => $value ) {
			if ( $registry->is_registered( 'trx-addons/' . $key ) ) {
				$list[] = 'trx-addons/' . $key;
			}
		}
		return apply_filters('trx_addons_filter_gutenberg_allowed_blocks', $list);
	}
}


// Get list of registered blocks
// 'type' = 'all | dynamic | static'
if ( ! function_exists( 'trx_addons_gutenberg_get_list_registered_blocks' ) ) {
	function trx_addons_gutenberg_get_list_registered_blocks( $type='all' ) {
		$list = array();
		if ( trx_addons_exists_gutenberg() ) {
			$blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
			if (is_array($blocks)) {
				foreach($blocks as $block) {
					if ($type == 'all' || ($type=='dynamic' && $block->is_dynamic()) || ($type=='static' && !$block->is_dynamic()) ) {
						$list[] = $block->name;
					}
				}
			}
		}
		return apply_filters('trx_addons_filter_gutenberg_registered_blocks', $list);
	}
}


// Add new category to block categories
if ( ! function_exists( 'trx_addons_gutenberg_block_categories' ) ) {
    if ( version_compare( get_bloginfo( 'version' ), '5.8', '<' ) ) {
        add_filter( 'block_categories', 'trx_addons_gutenberg_block_categories', 10, 2 );
    } else {
        add_filter( 'block_categories_all', 'trx_addons_gutenberg_block_categories', 10, 2 );
    }
    function trx_addons_gutenberg_block_categories( $default_categories = array(), $post = false ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			$default_categories[] = array(
				'slug'  => 'trx-addons-blocks',
				'title' => __( 'TRX Addons Blocks', 'trx-addons' ),
			);
			$default_categories[] = array(
				'slug'  => 'trx-addons-widgets',
				'title' => __( 'TRX Addons Widgets', 'trx-addons' ),
			);
			$default_categories[] = array(
				'slug'  => 'trx-addons-cpt',
				'title' => __( 'TRX Addons Custom Post Types', 'trx-addons' ),
			);
			$default_categories[] = array(
				'slug'  => 'trx-addons-layouts',
				'title' => __( 'TRX Addons Layouts', 'trx-addons' ),
			);
		}
		return $default_categories;
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( !function_exists( 'trx_addons_gutenberg_is_preview' ) ) {
    function trx_addons_gutenberg_is_preview() {
        return trx_addons_exists_gutenberg()
                && (
                    trx_addons_gutenberg_is_block_render_action()
                    ||
                    trx_addons_is_post_edit()
                    ||
                    trx_addons_gutenberg_is_widgets_block_editor()
                    ||
                    trx_addons_gutenberg_is_site_editor()
                    );
    }
}

// Return true if current mode is "Widgets Block Editor" (a new widgets panel with Gutenberg support)
if ( ! function_exists( 'trx_addons_gutenberg_is_widgets_block_editor' ) ) {
    function trx_addons_gutenberg_is_widgets_block_editor() {
        return is_admin()
                && trx_addons_exists_gutenberg()
                && version_compare( get_bloginfo( 'version' ), '5.8', '>=' )
                && trx_addons_check_url( 'widgets.php' )
                && function_exists( 'wp_use_widgets_block_editor' )
                && wp_use_widgets_block_editor();
    }
}

// Return true if current mode is "Full Site Editor"
if ( ! function_exists( 'trx_addons_gutenberg_is_site_editor' ) ) {
    function trx_addons_gutenberg_is_site_editor() {
        return is_admin()
                && trx_addons_exists_gutenberg()
                && version_compare( get_bloginfo( 'version' ), '5.9', '>=' )
                && trx_addons_check_url( 'site-editor.php' )
                && function_exists( 'wp_is_block_theme' )
                && wp_is_block_theme();
    }
}

// Return dependencies for Backend Editor mode
if ( !function_exists( 'trx_addons_block_editor_dependencis' ) ) {
    function trx_addons_block_editor_dependencis( $only_core = false ) {
        return apply_filters( 'trx_addons_filter_block_editor_dependencis', array_merge(
                array(
                    'jquery',
                    'wp-blocks',
                    'wp-i18n',
                    'wp-element',
                    'wp-components',
// Not compatible with WordPress 5.8+ Widgets Block Editor
//                    'wp-editor',
                ),
                $only_core ? array() : array(
                    'trx_addons-admin',
                    'trx_addons-utils',
                    'trx_addons-gutenberg-blocks'
                ) ) );
    }
}