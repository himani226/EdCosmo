<?php


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'yolox_trx_updater_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'yolox_trx_updater_theme_setup9', 9 );
    function yolox_trx_updater_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'yolox_filter_tgmpa_required_plugins', 'yolox_trx_updater_tgmpa_required_plugins' );
        }
    }
}



// Filter to add in the required plugins list
if ( ! function_exists( 'yolox_trx_updater_tgmpa_required_plugins' ) ) {
    function yolox_trx_updater_tgmpa_required_plugins( $list = array() ) {
        if ( yolox_storage_isset( 'required_plugins', 'trx_updater' ) ) {
            $path = yolox_get_plugin_source_path( 'plugins/trx_updater/trx_updater.zip' );
            if ( ! empty( $path ) || yolox_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => yolox_storage_get_array( 'required_plugins', 'trx_updater' ),
                    'slug'     => 'trx_updater',
                    'version'  => '2.0.0',
                    'source'   => ! empty( $path ) ? $path : 'upload://trx_updater.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}


// Check if trx_updater installed and activated
if ( ! function_exists( 'yolox_exists_trx_updater' ) ) {
    function yolox_exists_trx_updater() {
        return function_exists( 'trx_updater_load_plugin_textdomain' );
    }
}