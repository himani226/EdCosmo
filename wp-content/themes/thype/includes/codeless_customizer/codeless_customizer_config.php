<?php

/**
 * Used to configure all Customizer, load needed files and config
 * 
 * @package june WordPress Theme
 * @subpackage Framework
 * @version 1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if( !class_exists( 'CodelessCustomizerConfig' ) ) {
    
    class CodelessCustomizerConfig {
        
        public function __construct() {
            
            
            // Force KIRKI to load all font weights

            if( !class_exists( 'Kirki' ) )
                return;

            if( class_exists( 'Kirki_Fonts_Google' ) )
                Kirki_Fonts_Google::$force_load_all_variants = true;
            $this->load_custom_codeless_kirki();
            
            // Load Customizer Preview Scripts for live edit options
            add_action( 'customize_preview_init', array(
                 &$this,
                'register_preview_scripts' 
            ) );

            // Load Customizer Controls Pane Scripts
            add_action( 'customize_controls_enqueue_scripts', array(
                 &$this,
                'register_customizePane_scripts' 
            ) );
            
            // Register New Panel/Section Types
            add_action( 'customize_register', array(
                 &$this,
                'register_custom_types' 
            ) );
            add_filter( 'kirki/panel_types', array(
                 &$this,
                'load_custom_panel' 
            ) );
            add_filter( 'kirki/section_types', array(
                 &$this,
                'load_custom_section' 
            ) );
        

            
            
            global $cl_theme_mods;
            $cl_theme_mods = apply_filters( 'codeless_theme_mods', get_theme_mods() );
            

            
            $this->load_options();
        }


        function load_custom_codeless_kirki(){
            require_once 'codeless_controls.php';
        }
        
        
        function register_preview_scripts() {

            // Load WebFont Script to dynamically load fonts with JS
            wp_enqueue_script( 'codeless_google_fonts', get_template_directory_uri() . '/js/webfont.js', array(
                 'customize-preview',
                'jquery' 
            ) );
            
            // Live Edit Options JS Functions
            wp_enqueue_script( 'codeless_css_preview', get_template_directory_uri() . '/includes/codeless_customizer/js/codeless_postMessages.js', array(
                 'customize-preview',
                'jquery',
                'codeless_google_fonts' 
            ) );
            
            
            wp_localize_script( 'codeless_css_preview', 'cl_options', codeless_dynamic_css_register_tags() );
        }
        
        
        function register_customizePane_scripts() {
            
            $fields = Kirki::$fields;
            
            $newvars = array();
            
            foreach( $fields as $setting => $field ) {
                if( isset( $field['required'] ) && count( $field['required'] ) > 0 ) {
                    foreach( $field['required'] as $ac ) {
                        if( isset( $ac['transport'] ) && $ac['transport'] == 'postMessage' ) {
                            $ac['current'] = $setting;
                            $setting_      = $ac['setting'];
                            if( !isset( $newvars[$setting_] ) ) {
                                $newvars[$setting_] = array();
                            }
                            
                            $newvars[$setting_][] = $ac;
                        }
                    }
                }
            }
            
            //wp_localize_script( 'codeless_pane_script', 'newvars', $newvars );
            wp_enqueue_style( 'codeless-icons', CODELESS_BASE_URL . 'css/codeless-icons.css' );
            wp_enqueue_style(
                'codeless-customizer-styles',
                get_template_directory_uri() . '/includes/codeless_customizer/css/styles.css'
            );

            wp_enqueue_script( 'codeless_js_fix', get_template_directory_uri() . '/includes/codeless_customizer/js/codeless_js_fix.js', array(
                'jquery'
           ) );
        }
        
        public function register_custom_types() {
            global $wp_customize;
            require_once 'codeless_custom_panel.php';
            require_once 'codeless_custom_section.php';
            $wp_customize->register_panel_type( 'WP_Customize_Codeless_Panel' );
            $wp_customize->register_section_type( 'WP_Customize_Codeless_Section' );
        }
        

        
        public function load_custom_panel( $panels ) {
            
            $panels['codeless'] = 'WP_Customize_Codeless_Panel';
            return $panels;
        }
        
        public function load_custom_section( $sections ) {
            
            $sections['codeless'] = 'WP_Customize_Codeless_Section';
            return $sections;
        }
        
        public function load_options() {

            if( !class_exists( 'Kirki' ) )
                return;

            Kirki::add_config( 'cl_thype', array(
                'capability' => 'edit_theme_options',
                'option_type' => 'theme_mod',
                'disable_loader' => true
            ) );
            
            require_once 'codeless_options/general.php';
            require_once 'codeless_options/header.php';
            require_once 'codeless_options/layout.php';
            require_once 'codeless_options/colors.php';
            require_once 'codeless_options/typography.php';
            require_once 'codeless_options/buttons.php';
            require_once 'codeless_options/blog.php';
            
            
            require_once 'codeless_options/footer.php';
            //require_once 'codeless_options/custom_types.php';
        }
        
    }
}

new CodelessCustomizerConfig();

?>