<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $el_id
 * @var $sidebar_id
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Widget_sidebar
 */
$title = $el_class = $el_id = $sidebar_id = '';
$sticky_widgets = 0;
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $sidebar_id ) {
	return null;
}

$el_class = $this->getExtraClass( $el_class );

ob_start();
dynamic_sidebar( $sidebar_id );
$sidebar_value = ob_get_contents();
ob_end_clean();

$sidebar_value = trim( $sidebar_value );
$sidebar_value = ( '<li' === substr( $sidebar_value, 0, 3 ) ) ? '<ul>' . $sidebar_value . '</ul>' : $sidebar_value;

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_widgetised_column wpb_content_element' . $el_class, $this->settings['base'], $atts );
$wrapper_attributes = array();
if ( ! empty( $el_id ) && (int)$sticky_widgets == 0 ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if( (int) $sticky_widgets != 0 ){
	$css_class .= ' cl-sticky';
	$extra_data = 'data-sticky-offset="'.(int)$sticky_widgets.'"';
}

$css_class .= ' cl-aside--widget-title-' . codeless_get_mod( 'aside_title_style', 'text' );


$output = '<aside ' . implode( ' ', $wrapper_attributes ) . ' class="cl-aside ' . esc_attr( $css_class ) . '" '.$extra_data.'>
		<div class="wpb_wrapper cl-sticky-wrapper">
			' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_widgetised_column_heading' ) ) . '
			' . $sidebar_value . '
		</div>
	</aside>
';

echo codeless_complex_esc($output);
