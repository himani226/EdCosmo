<div id="sticky-menu">
	<div class="sticky-menu-inner clearfix">
    	<div class="sticky-logo-outer">
			<div class="sticky-logo-container">
    			<?php if ( get_theme_mod( 'souje_show_sticky_logo', 1 ) ) {
					$stickyLogoPath = '';
                    if ( get_theme_mod( 'souje_logo_image' ) ) { $stickyLogoPath = get_theme_mod( 'souje_logo_image' ); }
                    if ( get_theme_mod( 'souje_logo_image_sticky' ) ) { $stickyLogoPath = get_theme_mod( 'souje_logo_image_sticky' ); }
                    if ( $stickyLogoPath ) { ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="theme-sticky-logo-alt" src="<?php echo esc_url( $stickyLogoPath ); ?>" /></a><?php } else { ?>    
                    <h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1><?php }
				} ?>
        	</div>
		</div>
        <div class="site-menu-outer">
            <div class="site-menu-container clearfix">
            <?php
            $args = array(
                'theme_location' => 'primary',
                'container'       => 'div',
                'container_class' => 'site-nav',
                'menu_id'         => 'site-menu-sticky',
                'fallback_cb' => 'souje_assign_primary_menu'
            );
            wp_nav_menu( $args );
            ?>
            </div>
        </div>
        <?php ob_start( 'souje_compress' ); ?>
        <div class="top-extra-outer">
            <div class="top-extra">
                <div class="top-extra-inner clearfix">
                    <?php if ( get_theme_mod( 'souje_show_header_social', 1 ) ) { echo souje_insert_social_icons( 'header-social' ); } ?>
                    <a class="btn-to-top" href="javascript:void(0);"><i class="fa fa-chevron-up"></i></a>
                </div>
            </div>
        </div>
        <?php ob_end_flush(); ?>
    </div>
</div>
