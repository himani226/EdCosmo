<?php

extract($element['params']); 

$image = cl_atts_to_array($image);

$device_visibility_classes = '';
    if( !empty( $device_visibility ) )
        $device_visibility_classes = implode(" ", $device_visibility);
?>
<div class="cl-header__element-container cl-header__image <?php echo esc_attr($device_visibility_classes) ?><?php echo esc_attr( $this->generateClasses('.cl-header__element-container') ) ?> <?php echo esc_attr( $device_visibility_classes ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?>>
    <?php if( isset( $image ) && is_array( $image ) && isset( $image['url'] ) ): ?>
        <div class="image" style="background-image:url('<?php echo esc_url( urldecode($image['url'] )) ?>');"></div>
    <?php endif; ?>
</div>