<?php
/**
 * Plugin support: Social Pug
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */


// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_social_pug' ) ) {
    function trx_addons_exists_social_pug() {
        return class_exists( 'Social_Pug' );
    }
}

// One-click import support
//------------------------------------------------------------------------

// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_social_pug_importer_required_plugins' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_social_pug_importer_required_plugins', 10, 2 );
    function trx_addons_social_pug_importer_required_plugins($not_installed='', $list='') {
        if (strpos($list, 'social-pug')!==false && !trx_addons_exists_give() )
            $not_installed .= '<br>' . esc_html__('Social Pug', 'trx_addons');
        return $not_installed;
    }
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_social_pug_importer_set_options' ) ) {
    if (is_admin()) add_filter( 'trx_addons_filter_importer_options',	'trx_addons_social_pug_importer_set_options' );
    function trx_addons_social_pug_importer_set_options($options=array()) {
        if ( trx_addons_exists_social_pug() && in_array('social-pug', $options['required_plugins']) ) {
            $options['additional_options'][]	= 'dpsp_%';
        }
        return $options;
    }
}

?>