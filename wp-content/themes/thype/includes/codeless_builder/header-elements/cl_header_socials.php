<?php 
    
    extract( $element['params'] ); 

    $device_visibility_classes = '';
    if( !empty( $device_visibility ) )
        $device_visibility_classes = implode(" ", $device_visibility);
?>

<div class="cl-header__element-container cl-header__socials <?php echo esc_attr( $device_visibility_classes ) ?> <?php echo esc_attr( $this->generateClasses('.cl-header__element-container') ) ?>" <?php $this->generateStyle('.cl-header__element-container', true ) ?> >
    <?php if( !empty( $socials ) ): ?>
        <?php foreach( $socials as $social ): ?>
            <a href="<?php echo esc_url( codeless_get_mod( $social.'_link', '#' ) ) ?>" title="<?php echo esc_attr( ucfirst( $social ) ) ?>">
                <i class="cl-icon-<?php echo esc_attr( $social ); ?>"></i>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>