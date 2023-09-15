<div class="site-menu-outer">
    <div class="site-menu-container clearfix">
	<?php            
    $args = array(
        'theme_location' => 'primary',
        'container' => 'div',
        'container_class' => 'site-nav',
        'menu_id' => 'site-menu',
		'fallback_cb' => 'baxel_assign_primary_menu'
    );    
    wp_nav_menu( $args );    
    ?>
	</div>
</div>