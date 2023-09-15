<div class="top-sdw"></div>
<div class="site-logo-outer">
    <header class="site-logo-container">
        <?php
        // If a logo image is uploaded
        if ( get_theme_mod( 'baxel_logo_image' ) ) { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img alt="theme-logo-alt" src="<?php echo esc_url( get_theme_mod( 'baxel_logo_image' ) ); ?>" /></a>            
        <?php } else { // Use logo text ?>
            <h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <?php } ?>
	</header>
</div>
