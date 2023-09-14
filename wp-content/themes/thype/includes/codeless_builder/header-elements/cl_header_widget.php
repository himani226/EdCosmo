<?php

extract($element['params']);

$device_visibility_classes = '';
if( !empty( $device_visibility ) )
    $device_visibility_classes = implode(" ", $device_visibility);

?>

<div class="cl-header__widget cl-header__element-container <?php echo esc_attr( $device_visibility_classes ) ?> <?php echo esc_attr( $this->generateClasses('.cl-header__element-container') ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?>>

<?php dynamic_sidebar( $widget_sidebar ); ?>

</div>