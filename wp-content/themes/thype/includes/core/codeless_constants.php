<?php

if(!defined('CODELESS_BASE')) define('CODELESS_BASE', get_template_directory().'/');

if(!defined('CODELESS_KIRKI_BASE')) define('CODELESS_KIRKI_BASE', get_template_directory().'/includes/codeless_customizer/kirki');

if(!defined('CODELESS_IMPORTER_BASE')) define('CODELESS_IMPORTER_BASE', get_template_directory().'/includes/codeless_theme_panel/importer');

if(!defined('CODELESS_BASE_URL' ) ) define( 'CODELESS_BASE_URL', get_template_directory_uri().'/'); 

if(!defined('CODELESS_KIRKI_PATH' ) ) define( 'CODELESS_KIRKI_PATH', get_parent_theme_file_path( '/includes/codeless_customizer/kirki' ) );

if(function_exists('wp_get_theme'))
{
	$wp_theme_obj = wp_get_theme();
	$codeless_base_data['prefix'] = $codeless_base_data['Title'] = $wp_theme_obj->get('Name');
    if(!defined('THEMENAME')) define('THEMENAME', $codeless_base_data['Title']);
}

if(!defined('CODELESS_THEMETITLE')) define('CODELESS_THEMETITLE', $codeless_base_data['Title']);


?>