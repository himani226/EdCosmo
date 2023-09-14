<?php

extract($element['params']);

$output = '';
$device_visibility_classes = '';
if( !empty( $device_visibility ) )
    $device_visibility_classes = implode(" ", $device_visibility);
?>


<div class="cl-header__text cl-header__element-container <?php echo esc_attr( $device_visibility_classes ) ?> <?php echo esc_attr( $this->generateClasses('.cl-header__element-container') ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?>>
	<?php echo cl_remove_wpautop($content, true); ?>
</div>