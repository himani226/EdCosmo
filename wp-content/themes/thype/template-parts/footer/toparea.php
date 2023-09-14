<div class="cl-footer-toparea <?php echo codeless_get_mod('topfooter_section_container', 'container') ?>">
    <div class="row">
        <div class="col-12">
            <div class="cl-footer-toparea__wrapper" style="background-image:url('<?php echo esc_url( codeless_get_mod( 'topfooter_section_image' ) ) ?>');">
                <div class="cl-footer-toparea__content">
                    <?php if( is_active_sidebar('footer-toparea') ) dynamic_sidebar( 'footer-toparea' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>