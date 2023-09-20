<?php

if ( ! function_exists( 'cl_framework' ) ) {
	
	function cl_framework() {
		return Cl_Framework_Manager::getInstance();
	}
}

if ( ! function_exists( 'cl_asset_url' ) ) {

	function cl_asset_url( $file ) {
		return cl_framework()->assetUrl( $file );
	}
}

if ( ! function_exists( 'cl_path_dir' ) ) {

	function cl_path_dir( $name, $file = '' ) {
		return cl_framework()->path( $name, $file );
	}
}

if ( ! function_exists( 'cl_header_builder' ) ) {

	function cl_header_builder() {
		return cl_framework()->header_builder();
	}
}

if ( ! function_exists( 'cl_page_builder' ) ) {

	function cl_page_builder() {
		return cl_framework()->page_builder();
	}
}

if ( ! function_exists( 'cl_post_meta' ) ) {

	function cl_post_meta() {
		return cl_framework()->post_meta();
	}
}

if ( ! function_exists( 'cl_output_header' ) ) {

	function cl_output_header() {
		cl_header_builder()->output();
	}
}


if ( ! function_exists( 'cl_builder_map' ) ) {

	function cl_builder_map($attrs) {
		if ( ! isset( $attrs['settings'] ) ) {
			trigger_error( __( 'Wrong cl_map object. Base attribute is required', 'codeless-builder' ), E_USER_ERROR );
			die();
		}

		Cl_Builder_Mapper::map($attrs['settings'], $attrs);
	}
}

if ( ! function_exists( 'cl_include_template' ) ) {
	
	function cl_include_template( $template, $variables = array(), $once = false ) {
		is_array( $variables ) && extract( $variables );
		if ( $once ) {
			return require_once cl_path_dir('TEMPLATES_DIR', $template );
		} else {
			return require cl_path_dir('TEMPLATES_DIR', $template );
		}
	}
}

if ( ! function_exists( 'cl_do_shortcode' ) ) {
	
	function cl_do_shortcode( $atts, $content = null, $tag = null ) {
		return Cl_Shortcode_Manager::getInstance()->getElementClass( $tag )
		                                 ->output( $atts, $content );
	}

}

function codeless_get_loadedUrl(){
	//$post_type = get_post_type( codeless_get_post_id() );

	$url = get_permalink( codeless_get_post_id() );

	return $url;
}

function cl_get_header_elements(){
	$header = codeless_get_mod('cl_header_builder');
	
	$elements = array();
	if(!empty($header) && is_array($header)){
		foreach($header as $row_id => $row){
			foreach($row as $col_id => $col){
				foreach($col as $el){
					$el['row'] = $row_id;
					$el['col'] = $col_id;
					$elements[] = $el;
				}
			}
		}
	}
	
	return $elements;
}


function cl_map_get_defaults( $tag ) {
	$shortcode = Cl_Builder_Mapper::getShortCode( $tag );
	$params = array();
	if ( is_array( $shortcode ) && isset( $shortcode['fields'] ) && ! empty( $shortcode['fields'] ) ) {
		$params = cl_map_get_params_defaults( $shortcode['fields'] );
	}

	return $params;
}


function cl_map_get_params_defaults( $params ) {
	$resultParams = array();
	foreach ( $params as $param_id => $param ) {
		if ( isset( $param_id ) && 'content' !== $param_id && 'tab_start' !== $param['type'] && 'show_tabs' !== $param['type'] && 'group_start' !== $param['type'] && 'group_end' !== $param['type'] && 'tab_end' !== $param['type'] ) {
			$value = '';
			if ( isset( $param['default'] ) ) {
				$value = $param['default'];
			} 
			
			$resultParams[ $param_id ] = $value;
		}
	}

	return $resultParams;
}


function cl_get_attributes( $tag, $atts = array() ) {
	return shortcode_atts( cl_map_get_defaults( $tag ), $atts, $tag );
	$final = array();	
}

function cl_atts_to_array($value){

	if( is_array($value) )
		return $value;

	if( strpos($value, '_-_json') !== false ){
		$value =  str_replace("'", '"', str_replace('_-_json', '', $value) );
		$value = json_decode($value, true);
	} else if( strpos($value, '__array__') !== false && strpos($value, '__array__end__') !== false){
		$value = str_replace("__array__", '[', str_replace('__array__end__', ']', $value) );
		$value = json_decode($value, true);
	}
	return $value;
}

function cl_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) {
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}

	return do_shortcode( shortcode_unautop( $content ) );
}

function cl_translateColumnWidthToSpan( $width ) {
	preg_match( '/(\d+)\/(\d+)/', $width, $matches );

	if ( ! empty( $matches ) ) {
		$part_x = (int) $matches[1];
		$part_y = (int) $matches[2];
		if ( $part_x > 0 && $part_y > 0 ) {
			$value = ceil( $part_x / $part_y * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width = 'col-sm-' . $value;
			}
		}
	}

	return $width;
}

function cl_is_customize_posts_active(){
	if( class_exists('Customize_Posts_Plugin') )
		return true;
	return false;
}



function codeless_shortcode_add( $tag, $func ){
	add_shortcode($tag, $func);
}


/*
 * Inserts a new key/value before the key in the array.
 *
 * @param $key
 *   The key to insert before.
 * @param $array
 *   An array to insert in to.
 * @param $new_key
 *   The key to insert.
 * @param $new_value
 *   An value to insert.
 *
 * @return
 *   The new array if the key exists, FALSE otherwise.
 *
 * @see array_insert_after()
 */
function array_insert_before($key, array &$array, $new_key, $new_value) {
  if (array_key_exists($key, $array)) {
    $new = array();
    foreach ($array as $k => $value) {
      if ($k === $key) {
        $new[$new_key] = $new_value;
      }
      $new[$k] = $value;
    }
    return $new;
  }
  return FALSE;
}


function cl_get_ajax_handlerUrl(){
	return cl_framework()->pluginUrl('cl-ajax-handler.php');
}


function cl_remove_empty_p( $content ){
	
	if( is_customize_preview() )
		return $content;

	if( substr_count($content, '<p') == 1 && substr_count($content, '<p>') == 1 )
		$content = str_replace( array('<p>', '</p>'), array('', ''), $content );
	else
		$content = str_replace( array('<p', '/p>'), array('<span', '/span>'), $content );

	$content = str_replace( array('<div', '/div>'), array('<span', '/span>'), $content );

	return $content;
}


global $cl_row_layouts;
$cl_row_layouts = array(

	array(
		'cells' => '11',
		'mask' => '12',
		'title' => '1/1',
		'icon_class' => 'l_11',
	),
	array(
		'cells' => '12_12',
		'mask' => '26',
		'title' => '1/2 + 1/2',
		'icon_class' => 'l_12_12',
	),
	array(
		'cells' => '23_13',
		'mask' => '29',
		'title' => '2/3 + 1/3',
		'icon_class' => 'l_23_13',
	),
	array(
		'cells' => '13_13_13',
		'mask' => '312',
		'title' => '1/3 + 1/3 + 1/3',
		'icon_class' => 'l_13_13_13',
	),
	array(
		'cells' => '14_14_14_14',
		'mask' => '420',
		'title' => '1/4 + 1/4 + 1/4 + 1/4',
		'icon_class' => 'l_14_14_14_14',
	),
	array(
		'cells' => '14_34',
		'mask' => '212',
		'title' => '1/4 + 3/4',
		'icon_class' => 'l_14_34',
	),
	array(
		'cells' => '14_12_14',
		'mask' => '313',
		'title' => '1/4 + 1/2 + 1/4',
		'icon_class' => 'l_14_12_14',
	),
	array(
		'cells' => '56_16',
		'mask' => '218',
		'title' => '5/6 + 1/6',
		'icon_class' => 'l_56_16',
	),
	array(
		'cells' => '16_16_16_16_16_16',
		'mask' => '642',
		'title' => '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6',
		'icon_class' => 'l_16_16_16_16_16_16',
	),
	array(
		'cells' => '16_23_16',
		'mask' => '319',
		'title' => '1/6 + 4/6 + 1/6',
		'icon_class' => 'l_16_46_16',
	),
	array(
		'cells' => '16_16_16_12',
		'mask' => '424',
		'title' => '1/6 + 1/6 + 1/6 + 1/2',
		'icon_class' => 'l_16_16_16_12',
	),
);


function codeless_dequeue_stylesandscripts() {
        wp_dequeue_style( 'select2' );
        wp_deregister_style( 'select2' );

        wp_dequeue_script( 'select2');
        wp_deregister_script('select2');

        wp_dequeue_script( 'selectWoo');
        wp_deregister_script('selectWoo');
} 

function codeless_decode_content($data){
	return base64_decode( $data );
}

function codeless_encode_content($data){
	return base64_encode( $data );
}

function codeless_builder_generic_read_file( $file ){
	$content = "";
    
    if( ! function_exists('codeless_decode_content') )
        return false;

    if ( file_exists($file) ) {
                
        $content = codeless_generic_get_content($file);

        if ($content) {

            if( ! empty( $content ) ){
                $decoded_content = codeless_decode_content($content);

                if( !empty( $decoded_content ) )
                    $unserialized_content = unserialize( $decoded_content );

                if ($unserialized_content) {
                    return $unserialized_content;
                }
            }else{
                return '';
            }
        }
        return false;
    }
}

function codeless_builder_generic_get_content($file){
	$content = '';
    if ( function_exists('realpath') )
        $filepath = realpath($file);

    if ( !$filepath || !@is_file($filepath) )
        return '';

    if( ini_get('allow_url_fopen') ) {
        $method = 'fopen';
    } else {
        $method = 'file_get_contents';
    }
    
    if ( $method == 'fopen' ) {
        $handle = fopen( $filepath, 'rw' );

        if( $handle !== false ) {
            if( filesize( $filepath ) > 0 ){
                while (!feof($handle)) {
                    $content .= fread($handle, filesize( $filepath ) );
                }
                fclose( $handle );
            }
        }
        return $content;
    } else {
        return file_get_contents($filepath);
    }
}

function codeless_builder_file_open( $filename, $mode ){
	return fopen( $filename, $mode );
}

function codeless_builder_file_close( $fp ){
	return fclose( $fp );
}

function codeless_builder_f_get_contents( $data ){
	return file_get_contents($data);
}

function codeless_http_user_agent(){
	return isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
}

function codeless_isLocalhost(){
	return ( $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '::1') ? 1 : 0;
}

function codeless_server_software(){
	return $_SERVER['SERVER_SOFTWARE'];
}


function codeless_add_submenu_page($a1, $a2, $a3, $a4, $a5, $a6){

	add_submenu_page( $a1, $a2, $a3, $a4, $a5, $a6 );
}

function codeless_add_menu_page($a1, $a2, $a3, $a4, $a5, $a6, $a7){
	add_menu_page( $a1, $a2, $a3, $a4, $a5, $a6, $a7 );
}

if( !function_exists ( 'vc_shortcode_add_param' ) ){
	function vc_shortcode_add_param( $param1, $param2, $param3 ){
		vc_add_shortcode_param( $param1, $param2, $param3 );
	}
}

if( !function_exists ( 'codeless_widget_register' ) ){
	function codeless_widget_register( $param1 ){
		register_widget( $param1 );
	}
}


function codeless_builder_generate_palettes(){
	return apply_filters( 'codeless_builder_color_palette', array(
        get_theme_mod( 'primary_color' ),
        get_theme_mod( 'border_accent_color' ),
        get_theme_mod( 'labels_accent_color' ),
        get_theme_mod( 'highlight_light_color' ),
        get_theme_mod( 'other_area_links' ),
        get_theme_mod( 'h1_dark_color' ),
        get_theme_mod( 'h1_light_color' )
    ));
}


?>