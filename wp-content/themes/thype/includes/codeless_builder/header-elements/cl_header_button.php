<?php 
    
    extract( $element['params'] ); 

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

    $device_visibility_classes = '';
    if( !empty( $device_visibility ) )
        $device_visibility_classes = implode(" ", $device_visibility);
?>

<div class="cl-header__element-container cl-header__button <?php echo esc_attr( $device_visibility_classes ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?> >
    <a href="<?php echo esc_url($link) ?>" class="<?php echo esc_attr( codeless_button_classes( $classes, true ) ) ?> cl_header_button">
        <span><?php echo cl_remove_empty_p( cl_remove_wpautop($btn_title, true) ) ?></span>
    </a>
</div>