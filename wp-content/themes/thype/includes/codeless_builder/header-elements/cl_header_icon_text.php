<?php

extract($element['params']); 

$device_visibility_classes = '';
if( !empty( $device_visibility ) )
    $device_visibility_classes = implode(" ", $device_visibility);

?>
<div class="cl-header__element-container cl-header__icontext <?php echo esc_attr( $this->generateClasses('.cl-header__element-container') ) ?> <?php echo esc_attr( $device_visibility_classes ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?>>
	
	<i class="cl-header__icontext-icon <?php echo esc_attr( $this->generateClasses('.cl-header__icontext-icon') ) ?>" <?php $this->generateStyle('.cl-header__icontext-icon', true ) ?> ></i>

	<span class="cl-header__icontext-title <?php echo esc_attr( $this->generateClasses('.cl-header__icontext-title') ) ?>" <?php $this->generateStyle('.cl-header__icontext-title', true ) ?> ><?php echo wp_kses_post( cl_remove_wpautop( $text_title ) ) ?></span>

</div>