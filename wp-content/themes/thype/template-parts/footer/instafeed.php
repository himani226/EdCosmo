<div class="cl-instafeed-wrapper <?php echo esc_attr( codeless_get_mod( 'footer_instafeed_container', 'container' ) ) ?>">

    <?php if( codeless_get_mod( 'footer_instafeed_container', 'container' ) == 'container' ): ?>
        <h3><?php echo esc_attr( codeless_get_mod( 'footer_instafeed_title', esc_attr__('Our Instafeed', 'thype') ) ); ?></h3>
        <div class="cl-instafeed owl-carousel owl-theme cl-carousel" data-token="<?php echo codeless_get_mod( 'show_instagram_feed_token' ); ?>" data-items="6" data-nav="0" data-dots="0" data-userid="<?php echo codeless_get_mod( 'show_instagram_feed_userid' ); ?>" data-margin="10" data-center="true">

        </div>
    <?php endif; ?>


    <?php if( codeless_get_mod( 'footer_instafeed_container', 'container' ) == 'container-fluid' ): ?>
        <div class="cl-instafeed owl-carousel owl-theme cl-carousel" data-token="<?php echo codeless_get_mod( 'show_instagram_feed_token' ); ?>" data-nav="0" data-dots="0" data-userid="<?php echo codeless_get_mod( 'show_instagram_feed_userid' ); ?>" data-items="12">

        </div>
    <?php endif; ?>
    
</div>
