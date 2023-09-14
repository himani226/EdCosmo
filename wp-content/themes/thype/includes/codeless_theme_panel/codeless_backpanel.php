<?php
class cl_backpanel
{
	/**
	  * Construction Function
	  *
	  * 
	  */
	function __construct(){
		 add_action('admin_enqueue_scripts', array($this, 'panel_enqueue'));
         add_action('admin_enqueue_scripts', array($this, 'metabox_load'));
	}

   /**
    *
    * Enqueue styles and scripts for the backend panel
    *
    */
    public function panel_enqueue($hook) {
       
        if($hook != 'appearance_page_codeless-panel' && $hook != 'toplevel_page_codeless-panel') {
            return;
        }

        wp_enqueue_style('theme-style', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/css/theme.css');
        wp_enqueue_style('jquery-ui', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/css/jquery-ui.css', false);
        wp_enqueue_style('panel', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/css/panel.css');
        wp_enqueue_style('qtip-css', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/css/jquery.qtip.min.css');
        wp_enqueue_script('script', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/js/script.js');
        
        wp_localize_script( 'script', 'codeless_js', array( 'codeless_import_header_nonce' => wp_create_nonce( 'codeless_import_header_nonce' ), 'codeless_import_demo_nonce' => wp_create_nonce( 'codeless_import_demo_nonce' ) ) );
        
        wp_enqueue_script('qtip', CODELESS_BASE_URL . '/includes/codeless_theme_panel/assets/js/jquery.qtip.js');
     
    }
     
    public function metabox_load($hook) {
       
        if ( 'post.php' != $hook && 'post-new.php' != $hook ) {
            return;
        }
    
        wp_enqueue_style( 'codeless_metabox_css', get_template_directory_uri() . '/includes/core/css/codeless_metabox.css' );
        wp_enqueue_script( 'codeless_metabox_js', get_template_directory_uri() . '/includes/core/js/codeless_metabox.js' );
     
    }
	
/*--------------------- End BackEnd Panel ------------------------------*/

public static function isLocalHost() {
        codeless_isLocalhost();
}

public static function isWpDebug() {
        return ( defined( 'WP_DEBUG' ) && WP_DEBUG == true );
    }        
    

public static function makeBoolStr( $var ) {
                if ( $var == false || $var == 'false' || $var == 0 || $var == '0' || $var == '' || empty( $var ) ) {
                    return 'false';
                } else {
                    return 'true';
                }
            }
private static function let_to_num( $size ) {
                $l   = substr( $size, - 1 );
                $ret = substr( $size, 0, - 1 );

                switch ( strtoupper( $l ) ) {
                    case 'P':
                        $ret *= 1024;
                    case 'T':
                        $ret *= 1024;
                    case 'G':
                        $ret *= 1024;
                    case 'M':
                        $ret *= 1024;
                    case 'K':
                        $ret *= 1024;
                }

                return $ret;
            }


     /**
     * Notify Users for wrong hosting configurations .
     *
     * @copyright	Codeless
     * @link		http://codeless.co
     * @since		Version 1.0
     * @package		codeless
     * @author		Eldo Roshi
     */

     public function template_warnings() {
        
        $max_execution_time = ini_get("max_execution_time");
        $max_input_time = ini_get("max_input_time");
        $upload_max_filesize = ini_get("upload_max_filesize");
        $incorrect_max_execution_time = ($max_execution_time < 60 && $max_execution_time > 0);
        $incorrect_max_input_time = ($max_input_time < 60 && $max_input_time > 0);
        $incorrect_memory_limit = (self::let_to_num(WP_MEMORY_LIMIT) < 100663296);
        $incorrect_upload_max_filesize = (self::let_to_num($upload_max_filesize) < 10485760);

        if ( $incorrect_max_execution_time || $incorrect_max_input_time || $incorrect_memory_limit || $incorrect_upload_max_filesize) {
            
            echo '<div class="error settings-error cp-messages">';
            
            echo '<br><strong>Please resolve these issues before installing any template.</strong>';
            echo '<ol>';
            if ($incorrect_max_execution_time) {
                echo '<li><strong>Maximum Execution Time (max_execution_time) : </strong>' . $max_execution_time . ' seconds. <span style="color:red"> Recommended max_execution_time should be at least 60 Seconds.</span></li>';
            }
            if ($incorrect_max_input_time) {
                echo '<li><strong>Maximum Input Time (max_input_time) : </strong>' . $max_input_time . ' seconds. <span style="color:red"> Recommended max_input_time should be at least 60 Seconds.</span></li>';
            }
            if ($incorrect_memory_limit) {
                echo '<li><strong>WordPress Memory Limit (WP_MEMORY_LIMIT) : </strong>' . WP_MEMORY_LIMIT . ' <span style="color:red"> Recommended memory limit should be at least 128MB. <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">Increasing memory allocated to PHP</a></span></li>';
            }
            if ($incorrect_upload_max_filesize) {
                echo '<li><strong>Maximum Upload File Size (upload_max_filesize) : </strong>' . $upload_max_filesize . ' <span style="color:red"> Recommended Maximum Upload Filesize should be at least 10MB.</li>';
            }
            
            echo '</ol>';
            
            echo '</div>';
        }
        
        echo '<div class="import_message"></div>';
    }

    /*
     * List Installable Templates
     *
     */

    public static function cl_templates(){

        $purchase_code = get_option('add_purchase_code');

        $request = wp_remote_get('http://codeless.co/register/login.php?check=1&code='.$purchase_code);

        if($request['body'] == '1')

            return 'ok';
                
    }


    /*
     * Register Product with purchase code into the WordPress Database
     * @var purchase_code
     *
     */

    public static function cl_registerproduct($purchase_code){

        $purchase_code = sanitize_text_field($purchase_code);

        if( update_option( 'add_purchase_code', $purchase_code, 'yes' ) )

                return true;

    }

    /* 
     * Remove Product from WordPress Databse
     *
     */
     
    public static function cl_removeproduct(){

        $purchase_code = get_option('add_purchase_code');

        $request = wp_remote_get('http://codeless.co/register/login.php?remove=1&code='.$purchase_code);

        if(delete_option('add_purchase_code') && !is_wp_error($request))

            return true;
    }


    public static function cl_version(){

        /*$raw_response = wp_remote_get('http://codeless.co/register/update.php');

        if (!is_wp_error($raw_response)) {
            
            $response = $raw_response['body'];
        
        } else {
            
            $response = is_wp_error($raw_response);
        }
       
        return $response;*/
     
    }

   /*
    * Show Announcements from codeless
    *
    *
    */

    public static function cl_announcements(){

           

            $raw_response = wp_remote_get('http://codeless.co/register/announcements.php');

            if (!is_wp_error($raw_response)) {
               $response = $raw_response['body'];
            } else {
               $response = is_wp_error($raw_response);
            }
       
            return unserialize($response);
     
    }

    /*
     * Show the Hosting System Status 
     *
     */

    public static function cl_SystemStatus($json_output = false, $remote_checks = false) {
        global $wpdb;
        
        $cl_sysinfo = array();
        
        $cl_sysinfo['home_url'] = home_url();
        $cl_sysinfo['site_url'] = site_url();
        
        // Only is a file-write check
       	$cl_sysinfo['wp_content_url'] = WP_CONTENT_URL;
        $cl_sysinfo['wp_ver'] = get_bloginfo('version');
        $cl_sysinfo['wp_multisite'] = is_multisite();
        $cl_sysinfo['permalink_structure'] = get_option('permalink_structure') ? get_option('permalink_structure') : 'Default';
        $cl_sysinfo['front_page_display'] = get_option('show_on_front');
        if ($cl_sysinfo['front_page_display'] == 'page') {
            $front_page_id = get_option('page_on_front');
            $blog_page_id = get_option('page_for_posts');
            
            $cl_sysinfo['front_page'] = $front_page_id != 0 ? get_the_title($front_page_id) . ' (#' . $front_page_id . ')' : 'Unset';
            $cl_sysinfo['posts_page'] = $blog_page_id != 0 ? get_the_title($blog_page_id) . ' (#' . $blog_page_id . ')' : 'Unset';
        }
        
        $cl_sysinfo['wp_mem_limit']['raw'] = self::let_to_num(WP_MEMORY_LIMIT);
        $cl_sysinfo['wp_mem_limit']['size'] = size_format($cl_sysinfo['wp_mem_limit']['raw']);
        
        $cl_sysinfo['db_table_prefix'] = 'Length: ' . strlen($wpdb->prefix) . ' - Status: ' . (strlen($wpdb->prefix) > 16 ? 'ERROR: Too long' : 'Acceptable');
        
        $cl_sysinfo['wp_debug'] = 'false';
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $cl_sysinfo['wp_debug'] = 'true';
        }
        
        $cl_sysinfo['wp_lang'] = get_locale();
        
        if (!class_exists('Browser')) {
            $file_path = pathinfo( __FILE__ );
            require_once  $file_path['dirname'] . '/browser.php';
        }
        
        $browser = new Browser();
        
        $cl_sysinfo['browser'] = array(
            'agent' => $browser->getUserAgent() ,
            'browser' => $browser->getBrowser() ,
            'version' => $browser->getVersion() ,
            'platform' => $browser->getPlatform() ,
            
            'mobile'   => $browser->isMobile() ? 'true' : 'false',
            
        );
        
        $cl_sysinfo['server_info'] = codeless_server_software();
        $cl_sysinfo['localhost'] = self::makeBoolStr(self::isLocalHost());
        $cl_sysinfo['php_ver'] = function_exists('phpversion') ? esc_html(phpversion()) : 'phpversion() function does not exist.';
        $cl_sysinfo['abspath'] = ABSPATH;
        
        if (function_exists('ini_get')) {
            $cl_sysinfo['php_mem_limit'] = size_format(self::let_to_num(ini_get('memory_limit')));
            $cl_sysinfo['php_post_max_size'] = size_format(self::let_to_num(ini_get('post_max_size')));
            $cl_sysinfo['php_time_limit'] = ini_get('max_execution_time');
            $cl_sysinfo['php_max_input_var'] = ini_get('max_input_vars');
            $cl_sysinfo['php_display_errors'] = self::makeBoolStr(ini_get('display_errors'));
        }
        
        $cl_sysinfo['suhosin_installed'] = extension_loaded('suhosin');
        $cl_sysinfo['mysql_ver'] = $wpdb->db_version();
        $cl_sysinfo['max_upload_size'] = size_format(wp_max_upload_size());
        
        $cl_sysinfo['def_tz_is_utc'] = 'true';
        if (date_default_timezone_get() !== 'UTC') {
            $cl_sysinfo['def_tz_is_utc'] = 'false';
        }
        
        $cl_sysinfo['fsockopen_curl'] = 'false';
        if (function_exists('fsockopen') || function_exists('curl_init')) {
            $cl_sysinfo['fsockopen_curl'] = 'true';
        }
        
        $cl_sysinfo['soap_client'] = 'false';
        if ( class_exists( 'SoapClient' ) ) {
           $cl_sysinfo['soap_client'] = 'true';
        }
        
        $cl_sysinfo['dom_document'] = 'false';
        if ( class_exists( 'DOMDocument' ) ) {
           $cl_sysinfo['dom_document'] = 'true';
        }
        
        $cl_sysinfo['gzip'] = 'false';
        if ( is_callable( 'gzopen' ) ) {
           $cl_sysinfo['gzip'] = 'true';
        }
        
        if ($remote_checks == true) {
            $response = wp_remote_post('https://www.paypal.com/cgi-bin/webscr', array(
                'sslverify' => false,
                'timeout' => 60,
                'user-agent' => 'Codeless/',
                'body' => array(
                    'cmd' => '_notify-validate'
                )
            ));
            
            if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300) {
                $cl_sysinfo['wp_remote_post'] = 'true';
                $cl_sysinfo['wp_remote_post_error'] = '';
            } 
            else {
                $cl_sysinfo['wp_remote_post'] = 'false';
                $cl_sysinfo['wp_remote_post_error'] = $response->get_error_message();
            }
            
            $response = wp_remote_get('http://codeless.co');
            
            if (!is_wp_error($response) && $response['response']['code'] >= 200 && $response['response']['code'] < 300) {
                $cl_sysinfo['wp_remote_get'] = 'true';
                $cl_sysinfo['wp_remote_get_error'] = '';
            } 
            else {
                $cl_sysinfo['wp_remote_get'] = 'false';
                
                try{
                    $cl_sysinfo['wp_remote_get_error'] = $response->get_error_message();

                } catch (Exception $e) {

                    $cl_sysinfo['wp_remote_get_error'] = $e->getMessage();
                }
                
            }
        }
        
        $active_plugins = (array)get_option('active_plugins', array());
        
        if (is_multisite()) {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }
        
        $cl_sysinfo['plugins'] = array();
        
        foreach ($active_plugins as $plugin) {
            $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
            $plugin_name = esc_html($plugin_data['Name']);
            
            $cl_sysinfo['plugins'][$plugin_name] = $plugin_data;
        }
        
        $active_theme = wp_get_theme();
        
        $cl_sysinfo['theme']['name'] = $active_theme->Name;
        $cl_sysinfo['theme']['version'] = $active_theme->Version;
        $cl_sysinfo['theme']['author_uri'] = $active_theme->{'Author URI'};
        $cl_sysinfo['theme']['is_child'] = self::makeBoolStr(is_child_theme());
        
        if (is_child_theme()) {
            $parent_theme = wp_get_theme($active_theme->Template);
            
            $cl_sysinfo['theme']['parent_name'] = $parent_theme->Name;
            $cl_sysinfo['theme']['parent_version'] = $parent_theme->Version;
            $cl_sysinfo['theme']['parent_author_uri'] = $parent_theme->{'Author URI'};
        }

        return $cl_sysinfo;

	}


    static function get_demos(){
        $demos = array(
            array(
                'id' => 'blog',
                'label' => 'Blog Default',
                'preview' => 'http://codeless.co/thype/blog',
                'parts' => 1,
                'home_slug' => 'home',
                'header' => 'main',
                'footer' => 'main'
            ),

            array(
                'id' => 'blog_image_1',
                'label' => 'Blog Image Slider #1',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2632',
                'parts' => 1,
                'home_slug' => 'home-2',
                'header' => 'main',
                'footer' => 'main'
            ),

            array(
                'id' => 'travel',
                'label' => 'Travel',
                'preview' => 'https://codeless.co/thype/travel',
                'parts' => 1,
                'home_slug' => 'home'
            ),

            array(
                'id' => 'blog_centered',
                'label' => 'Blog Centered',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2666',
                'parts' => 1,
                'home_slug' => 'home-3',
                'header' => 'blog7',
                'footer' => 'instafeed_white'
            ),

            array(
                'id' => 'blog_image_2',
                'label' => 'Blog Image Slider #2',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2680',
                'parts' => 1,
                'home_slug' => 'home-4',
                'header' => 'dark',
                'footer' => 'dark'
            ),

            array(
                'id' => 'blog_minimal_masonry',
                'label' => 'Blog Minimal Masonry',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2685',
                'parts' => 1,
                'home_slug' => 'home-5',
                'header' => 'blog5',
                'footer' => 'main_full'
            ),

            array(
                'id' => 'blog_slider_carousel',
                'label' => 'Blog Slider Carousel',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2692',
                'parts' => 1,
                'home_slug' => 'home-6',
                'header' => 'logo_center',
                'footer' => 'main_full'
            ),

            array(
                'id' => 'blog_slider_grid',
                'label' => 'Blog Slider Grid',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2709',
                'parts' => 1,
                'home_slug' => 'home-7',
                'header' => 'logo_center_2',
                'footer' => 'instafeed_white'
            ),

            array(
                'id' => 'blog_dark_slider',
                'label' => 'Blog Dark Slider',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2936',
                'parts' => 1,
                'home_slug' => 'home-8',
                'header' => 'main2',
                'footer' => 'center'
            ),

            array(
                'id' => 'blog_white_slider',
                'label' => 'Blog White Slider',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2949',
                'parts' => 1,
                'home_slug' => 'home-9',
                'header' => 'main2',
                'footer' => 'main_full'
            ),

            array(
                'id' => 'blog_image_3',
                'label' => 'Blog Image Slider 3',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2960',
                'parts' => 1,
                'home_slug' => 'home-10',
                'header' => 'main2',
                'footer' => 'dark'
            ),

            array(
                'id' => 'blog_alt_header',
                'label' => 'Blog ALT Header',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2971',
                'parts' => 1,
                'home_slug' => 'home-11',
                'header' => 'blog8',
                'footer' => 'center'
            ),








            array(
                'id' => 'magazine',
                'label' => 'Magazine Default',
                'preview' => 'http://codeless.co/thype/magazine',
                'parts' => 1,
                'home_slug' => 'home',
                'header' => 'magazine',
                'footer' => 'magazine',
                
            ),

            array(
                'id' => 'magazine_bold',
                'label' => 'Magazine Bold',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=2969',
                'parts' => 1,
                'home_slug' => 'home-2',
                'header' => 'magazine2',
                'footer' => 'magazine',
                'extra_options' => array('aside_title_style' => 'with_bg')
            ),

            array(
                'id' => 'magazine_fullwidth',
                'label' => 'Magazine Fullwidth Slider',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=2999',
                'parts' => 1,
                'home_slug' => 'home-3',
                'header' => 'magazine_dark',
                'footer' => 'magazine',
                'extra_options' => array('aside_title_style' => 'with_bg')
            ),

            array(
                'id' => 'magazine_boxed',
                'label' => 'Magazine Boxed',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3021',
                'parts' => 1,
                'home_slug' => 'home-4',
                'header' => 'magazine_image',
                'footer' => 'magazine',
                'extra_options' => array( 
                    'boxed_layout'=> true, 
                    'aside_title_style' => 'with_bg',
                    'boxed_layout_width' => 1240
                )
            ),

            array(
                'id' => 'magazine_dark_slider',
                'label' => 'Magazine Dark Slider',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3036',
                'parts' => 1,
                'home_slug' => 'home-5',
                'header' => 'dark_2',
                'footer' => 'magazine'
            ),

            array(
                'id' => 'magazine_slider_carousel',
                'label' => 'Magazine Slider Carousel',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3045',
                'parts' => 1,
                'home_slug' => 'home-6',
                'header' => 'colored',
                'footer' => 'magazine',
                'extra_options' => array('aside_title_style' => 'with_bg')
            ),

            array(
                'id' => 'magazine_classic_1',
                'label' => 'Magazine Classic #1',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3056',
                'parts' => 1,
                'home_slug' => 'home-7',
                'header' => 'magazine',
                'footer' => 'magazine'
            ),

            array(
                'id' => 'magazine_grid',
                'label' => 'Magazine Grid',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3072',
                'parts' => 1,
                'home_slug' => 'home-8',
                'header' => 'menu_top',
                'footer' => 'magazine',
                'extra_options' => array('aside_title_style' => 'with_bg')
            ),


            array(
                'id' => 'magazine_classic_2',
                'label' => 'Magazine Classic #2',
                'preview' => 'https://codeless.co/thype/magazine/?page_id=3107',
                'parts' => 1,
                'home_slug' => 'home-9',
                'header' => 'magazine',
                'footer' => 'magazine'
            ),

            



        );
        return $demos;
    }


    static function get_headers(){
        $demos = array(
            array(
                'id' => 'main',
                'label' => 'Blog 1',
                'preview' => 'http://codeless.co/thype/blog'
            ),
            array(
                'id' => 'magazine',
                'label' => 'Magazine Main',
                'preview' => 'http://codeless.co/thype/magazine'
            ),
            array(
                'id' => 'main2',
                'label' => 'Main 2',
                'preview' => 'http://codeless.co/thype/blog'
            ),
            array(
                'id' => 'blog2',
                'label' => 'Blog 2',
                'preview' => 'http://codeless.co/thype/blog'
            ),
            array(
                'id' => 'blog3',
                'label' => 'Blog 3',
                'preview' => 'http://codeless.co/thype/blog'
            ),
            array(
                'id' => 'blog4',
                'label' => 'Blog 4',
                'preview' => 'http://codeless.co/thype/blog'
            ),

            array(
                'id' => 'blog5',
                'label' => 'Blog Overlay',
                'preview' => 'http://codeless.co/thype/blog'
            ),

            array(
                'id' => 'blog6',
                'label' => 'Blog 6',
                'preview' => 'http://codeless.co/thype/blog'
            ),

            array(
                'id' => 'blog7',
                'label' => 'Blog Overlay 2',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2666'
            ),

            array(
                'id' => 'blog8',
                'label' => 'Blog 8',
                'preview' => 'https://codeless.co/thype/blog/'
            ),

            array(
                'id' => 'dark',
                'label' => 'Dark',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2680'
            ),

            array(
                'id' => 'logo_center',
                'label' => 'Logo in Center',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2692'
            ),

            array(
                'id' => 'logo_center_2',
                'label' => 'Logo in Center 2',
                'preview' => 'https://codeless.co/thype/blog/?page_id=2709'
            ),
            array(
                'id' => 'magazine2',
                'label' => 'Magazine Main 2',
                'preview' => 'http://codeless.co/thype/magazine'
            ),
            array(
                'id' => 'magazine_dark',
                'label' => 'Magazine Dark',
                'preview' => 'http://codeless.co/thype/magazine'
            ),
            array(
                'id' => 'magazine_image',
                'label' => 'Magazine with Image',
                'preview' => 'http://codeless.co/thype/magazine'
            ),

            array(
                'id' => 'dark_2',
                'label' => 'Dark 2',
                'preview' => 'http://codeless.co/thype/magazine'
            ),

            array(
                'id' => 'colored',
                'label' => 'Colored',
                'preview' => 'http://codeless.co/thype/magazine'
            ),

            array(
                'id' => 'menu_top',
                'label' => 'Menu on Top Row',
                'preview' => 'http://codeless.co/thype/magazine'
            ),
            
        );
        return $demos;
    }

    static function get_footers(){
        $demos = array(
            array(
                'id' => 'main',
                'label' => 'Footer 1',
                'preview' => 'http://codeless.co/thype/blog'
            ),

            array(
                'id' => 'magazine',
                'label' => 'Footer Magazine',
                'preview' => 'http://codeless.co/thype/magazine'
            ),

            array(
                'id' => 'main_full',
                'label' => 'Main Full',
                'preview' => 'http://codeless.co/thype/blog'
            ),
            array(
                'id' => 'instafeed_white',
                'label' => 'White with Instafeed',
                'preview' => 'http://codeless.co/thype/blog'
            ),

            array(
                'id' => 'dark',
                'label' => 'Blog Dark',
                'preview' => 'http://codeless.co/thype/blog/?page_id=2680'
            ),

            array(
                'id' => 'center',
                'label' => 'Center',
                'preview' => 'http://codeless.co/thype/magazine/'
            ),
            
        );
        return $demos;
    }



}

if( is_admin() )
    new cl_backpanel();
?>