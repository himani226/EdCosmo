<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_args = get_query_var( 'yolox_logo_args' );

// Site logo
$yolox_logo_type   = isset( $yolox_args['type'] ) ? $yolox_args['type'] : '';
$yolox_logo_image  = yolox_get_logo_image( $yolox_logo_type );
$yolox_logo_text   = yolox_is_on( yolox_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$yolox_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $yolox_logo_image['logo'] ) || ! empty( $yolox_logo_text ) ) {
    ?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
    <?php
    if ( ! empty( $yolox_logo_image['logo'] ) ) {
        if ( empty( $yolox_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $yolox_logo_image['logo'] ) && $yolox_logo_image['logo'] > 0 ) {
            the_custom_logo();
        } else {
            $yolox_attr = yolox_getimagesize( $yolox_logo_image['logo'] );
            echo '<img src="' . esc_url( $yolox_logo_image['logo'] ) . '"'
                . ( ! empty( $yolox_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $yolox_logo_image['logo_retina'] ) . ' 2x"' : '' )
                . ' alt="' . esc_attr( $yolox_logo_text ) . '"'
                . ( ! empty( $yolox_attr[3] ) ? ' ' . wp_kses_data( $yolox_attr[3] ) : '' )
                . '>';
        }
    } else {
        yolox_show_layout( yolox_prepare_macros( $yolox_logo_text ), '<span class="logo_text">', '</span>' );
        yolox_show_layout( yolox_prepare_macros( $yolox_logo_slogan ), '<span class="logo_slogan">', '</span>' );
    }
    ?>
    </a>
    <?php
}
