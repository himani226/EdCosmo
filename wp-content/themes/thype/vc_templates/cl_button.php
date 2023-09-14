<?php

$args = array(
    "text"             => esc_attr__("Click Me", 'thype'),
    'link'             => '#',
    'button_color'     => 'default',
    'button_style'     => 'default',
    'button_size'      => 'default',
    'align'            => 'center'
);

extract(shortcode_atts($args, $atts));

$classes = array();

if( $button_color == 'default' )
    $button_color = codeless_get_mod( 'button_color', 'normal' );

if( $button_size == 'default' )
    $button_size = codeless_get_mod( 'button_size', 'medium' );

if( $button_style == 'default' )
    $button_style = codeless_get_mod( 'button_style', 'square' );


$classes[] = 'cl-btn';
$classes[] = 'cl-btn--color-' . $button_color;
$classes[] = 'cl-btn--style-' . $button_style;
$classes[] = 'cl-btn--size-' . $button_size;

?>

<div class="cl-element cl-button cl-button--align-<?php echo esc_attr( $align ) ?>">
    <a href="<?php echo esc_url($link) ?>" class="<?php echo esc_attr( codeless_button_classes( $classes, true ) ) ?>">
        <span><?php echo cl_remove_empty_p( cl_remove_wpautop($text, true) ) ?></span>
    </a>
</div>

