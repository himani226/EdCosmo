<?php
/**
 * Skins support: Main skin file for the skin 'Agency'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.46
 */


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'yolox_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'yolox_skin_theme_setup3', 3 );
	function yolox_skin_theme_setup3() {
        yolox_storage_set(
            'load_fonts', array(
                // Google font
                array(
                    'name'   => 'Overpass',
                    'family' => 'sans-serif',
                    'styles' => '400,600,700',     // Parameter 'style' used only for the Google fonts
                ),
                array(
                    'name'   => 'Roboto',
                    'family' => 'sans-serif',
                    'styles' => '300,400,500,700',     // Parameter 'style' used only for the Google fonts
                ),
            )
        );
        yolox_storage_set(
            'theme_fonts', array(
                'p'       => array(
                    'title'           => esc_html__( 'Main text', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'yolox' ),
                    'font-family'     => '"Roboto",sans-serif',
                    'font-size'       => '1rem',
                    'font-weight'     => '400',
                    'font-style'      => 'normal',
                    'line-height'     => '1.45em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '',
                    'margin-top'      => '0em',
                    'margin-bottom'   => '1.9em',
                ),
                'h1'      => array(
                    'title'           => esc_html__( 'Heading 1', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '2.118em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-1.5px',
                    'margin-top'      => '1.8em',
                    'margin-bottom'   => '0.6em',
                ),
                'h2'      => array(
                    'title'           => esc_html__( 'Heading 2', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1.706em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.0952em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-0.8px',
                    'margin-top'      => '1.95em',
                    'margin-bottom'   => '0.5em',
                ),
                'h3'      => array(
                    'title'           => esc_html__( 'Heading 3', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1.588em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.1515em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-0.3px',
                    'margin-top'      => '1.9em',
                    'margin-bottom'   => '0.4em',
                ),
                'h4'      => array(
                    'title'           => esc_html__( 'Heading 4', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1.294em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.2em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-0.5px',
                    'margin-top'      => '1.9em',
                    'margin-bottom'   => '0.85em',
                ),
                'h5'      => array(
                    'title'           => esc_html__( 'Heading 5', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1.118em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.35em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-0.5px',
                    'margin-top'      => '1.8em',
                    'margin-bottom'   => '0.9em',
                ),
                'h6'      => array(
                    'title'           => esc_html__( 'Heading 6', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.2em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '-0.5px',
                    'margin-top'      => '2.2em',
                    'margin-bottom'   => '1em',
                ),
                'logo'    => array(
                    'title'           => esc_html__( 'Logo text', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the text case of the logo', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1.8em',
                    'font-weight'     => '400',
                    'font-style'      => 'normal',
                    'line-height'     => '1.25em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'uppercase',
                    'letter-spacing'  => '1px',
                ),
                'button'  => array(
                    'title'           => esc_html__( 'Buttons', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '15px',
                    'font-weight'     => '500',
                    'font-style'      => 'normal',
                    'line-height'     => '15px',
                    'text-decoration' => 'none',
                    'text-transform'  => 'capitalize',
                    'letter-spacing'  => '0',
                ),
                'input'   => array(
                    'title'           => esc_html__( 'Input fields', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'yolox' ),
                    'font-family'     => 'inherit',
                    'font-size'       => '13px',
                    'font-weight'     => '400',
                    'font-style'      => 'normal',
                    'line-height'     => '1.5em', // Attention! Firefox don't allow line-height less then 1.5em in the select
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '0px',
                ),
                'info'    => array(
                    'title'           => esc_html__( 'Post meta', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'yolox' ),
                    'font-family'     => 'inherit',
                    'font-size'       => '0.824em',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
                    'font-weight'     => '400',
                    'font-style'      => 'normal',
                    'line-height'     => '1.5em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '0px',
                    'margin-top'      => '0.4em',
                    'margin-bottom'   => '',
                ),
                'menu'    => array(
                    'title'           => esc_html__( 'Main menu', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the main menu items', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '1em',
                    'font-weight'     => '600',
                    'font-style'      => 'normal',
                    'line-height'     => '1.5em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '0px',
                ),
                'submenu' => array(
                    'title'           => esc_html__( 'Dropdown menu', 'yolox' ),
                    'description'     => esc_html__( 'Font settings of the dropdown menu items', 'yolox' ),
                    'font-family'     => '"Overpass",sans-serif',
                    'font-size'       => '15px',
                    'font-weight'     => '500',
                    'font-style'      => 'normal',
                    'line-height'     => '1.5em',
                    'text-decoration' => 'none',
                    'text-transform'  => 'none',
                    'letter-spacing'  => '0px',
                ),
            )
        );
        yolox_storage_set(
            'schemes', array(

                // Color scheme: 'default'
                'default' => array(
                    'title'    => esc_html__( 'Default', 'yolox' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#ffffff',
                        'bd_color'         => '#e0e0e0',

                        // Text and links colors
                        'text'             => '#6e7783',
                        'text_light'       => '#888f96',
                        'text_dark'        => '#29313a',
                        'text_link'        => '#f25035',
                        'text_hover'       => '#ea3e21',
                        'text_link2'       => '#723cea',
                        'text_hover2'      => '#5d22e1',
                        'text_link3'       => '#f68d2b',
                        'text_hover3'      => '#e47915',

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#ffffff',
                        'alter_bg_hover'   => '#f7f9fa',
                        'alter_bd_color'   => '#ebebeb',
                        'alter_bd_hover'   => '#dae2e5',
                        'alter_text'       => '#6e7783',
                        'alter_light'      => '#888f96',
                        'alter_dark'       => '#29313a',
                        'alter_link'       => '#f25035',
                        'alter_hover'      => '#ea3e21',
                        'alter_link2'      => '#723cea',
                        'alter_hover2'     => '#5d22e1',
                        'alter_link3'      => '#f68d2b',
                        'alter_hover3'     => '#e47915',

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#141e29',
                        'extra_bg_hover'   => '#f7f9fa',
                        'extra_bd_color'   => '#26323f',
                        'extra_bd_hover'   => '#f7f9fa',
                        'extra_text'       => '#b4c2d1',
                        'extra_light'      => '#888f96',
                        'extra_dark'       => '#b4c2d1',
                        'extra_link'       => '#f25035',
                        'extra_hover'      => '#fe7259',
                        'extra_link2'      => '#141e29',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#fafbfc',
                        'extra_hover3'     => '#cdcfd3',

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#ffffff',
                        'input_bg_hover'   => '#ffffff',
                        'input_bd_color'   => '#e7eaed',
                        'input_bd_hover'   => '#d9d9d9',
                        'input_text'       => '#888f96',
                        'input_light'      => '#a7a7a7',
                        'input_dark'       => '#6e7783',

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#67bcc1',
                        'inverse_bd_hover' => '#5aa4a9',
                        'inverse_text'     => '#ffffff',
                        'inverse_light'    => '#333333',
                        'inverse_dark'     => '#29313a',
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#ffffff',
                    ),
                ),

                // Color scheme: 'dark'
                'dark'    => array(
                    'title'    => esc_html__( 'Dark', 'yolox' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#141e29',
                        'bd_color'         => '#26323f',

                        // Text and links colors
                        'text'             => '#b4c2d1',
                        'text_light'       => '#9ca9b6',
                        'text_dark'        => '#ffffff',
                        'text_link'        => '#f25035',
                        'text_hover'       => '#ea3e21',
                        'text_link2'       => '#723cea',
                        'text_hover2'      => '#5d22e1',
                        'text_link3'       => '#f68d2b',
                        'text_hover3'      => '#e47915',

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#0e161f',
                        'alter_bg_hover'   => '#18232f',
                        'alter_bd_color'   => '#1e2832',
                        'alter_bd_hover'   => '#4a4a4a',
                        'alter_text'       => '#b4c2d1',
                        'alter_light'      => '#9ca9b6',
                        'alter_dark'       => '#ffffff',
                        'alter_link'       => '#f25035',
                        'alter_hover'      => '#ea3e21',
                        'alter_link2'      => '#723cea',
                        'alter_hover2'     => '#5d22e1',
                        'alter_link3'      => '#f68d2b',
                        'alter_hover3'     => '#e47915',

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#ffffff',
                        'extra_bg_hover'   => '#f3f5f7',
                        'extra_bd_color'   => '#ebebeb',
                        'extra_bd_hover'   => '#f7f9fa',
                        'extra_text'       => '#6e7783',
                        'extra_light'      => '#d0d3da',
                        'extra_dark'       => '#6e7783',
                        'extra_link'       => '#f25035',
                        'extra_hover'      => '#fe7259',
                        'extra_link2'      => '#d0d3da',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#cdcfd3',
                        'extra_hover3'     => '#fafbfc',

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#141e29',
                        'input_bg_hover'   => '#121c26',
                        'input_bd_color'   => '#1d2733',
                        'input_bd_hover'   => '#29333e',
                        'input_text'       => '#b4c2d1',
                        'input_light'      => '#6f6f6f',
                        'input_dark'       => '#ffffff',

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#e36650',
                        'inverse_bd_hover' => '#cb5b47',
                        'inverse_text'     => '#f4f4f4',
                        'inverse_light'    => '#6f6f6f',
                        'inverse_dark'     => '#2b2b2d',
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#ffffff',
                    ),
                ),

            )
        );

	}
}
// Add new output types (layouts) in the shortcodes
if ( ! function_exists( 'yolox_skin_trx_addons_sc_type' ) ) {
    add_filter( 'trx_addons_sc_type', 'yolox_skin_trx_addons_sc_type', 10, 2 );
    function yolox_skin_trx_addons_sc_type( $list, $sc ) {
        // To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
        if ( 'trx_sc_blogger' == $sc ) {
            $list['extra'] = 'Extra';
        }

        return $list;
    }
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'yolox_skin_importer_set_options' ) ) {
    add_filter('trx_addons_filter_importer_options', 'yolox_skin_importer_set_options', 9);
    function yolox_skin_importer_set_options($options = array()) {
        if (is_array($options)) {
            // Agency News demo
            $options['demo_type'] = 'agency';
            $options['files']['agency'] = $options['files']['default'];
            $options['files']['agency']['title'] = esc_html__('Agency News Demo', 'yolox');
            $options['files']['agency']['domain_dev']  = esc_url( yolox_get_protocol() . '://agency.yolox.ancorathemes.com/' );
            $options['files']['agency']['domain_demo'] = esc_url( yolox_get_protocol() . '://agency.yolox.ancorathemes.com/' );   // Demo-site domain
            unset($options['files']['default']);
        }
        return $options;
    }
}



// Filter to add in the required plugins list
if ( ! function_exists( 'yolox_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'yolox_filter_tgmpa_required_plugins', 'yolox_skin_tgmpa_required_plugins' );
	function yolox_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( yolox_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => yolox_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
// Priority 1150 - after plugins-specific (1100), but before child theme (1200)
if ( ! function_exists( 'yolox_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'yolox_skin_frontend_scripts', 1150 );
	function yolox_skin_frontend_scripts() {
		$yolox_url = yolox_get_file_url( YOLOX_SKIN_DIR . 'skin.css' );
		if ( '' != $yolox_url ) {
			wp_enqueue_style( 'yolox-skin-' . esc_attr( YOLOX_SKIN_NAME ), $yolox_url, array(), null );
		}
	}
}

// Enqueue skin-specific responsive styles
// Priority 2050 - after theme responsive 2000
if ( ! function_exists( 'yolox_skin_styles_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'yolox_skin_styles_responsive', 2050 );
	function yolox_skin_styles_responsive() {
		$yolox_url = yolox_get_file_url( YOLOX_SKIN_DIR . 'skin-responsive.css' );
		if ( '' != $yolox_url ) {
			wp_enqueue_style( 'yolox-skin-' . esc_attr( YOLOX_SKIN_NAME ) . '-responsive', $yolox_url, array(), null );
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'yolox_skin_merge_scripts' ) ) {
    add_filter('yolox_filter_merge_scripts', 'yolox_skin_merge_scripts');
    function yolox_skin_merge_scripts($list)
    {
        if (yolox_get_file_dir(YOLOX_SKIN_DIR . 'skin.js') != '') {
            $list[] = YOLOX_SKIN_DIR . 'skin.js';
        }
        return $list;
    }

}

// Add slin-specific colors and fonts to the custom CSS
require_once YOLOX_THEME_DIR . YOLOX_SKIN_DIR . 'skin-styles.php';

