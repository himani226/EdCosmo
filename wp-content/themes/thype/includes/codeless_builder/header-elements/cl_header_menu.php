<?php

extract($element['params']);
$menu_id = codeless_get_mod( 'header_menu_id', 'default' );
$style = codeless_get_mod( 'header_menu_style', 'simple' );

global $cl_from_element;
$cl_from_element['cl_menu_start'] = true;

?>
<?php if( $style == 'simple' || $style == 'border_top' || $style == 'background_color' ): ?>
	<div id="navigation" class="cl-header__nav-wrapper">
		<nav class="cl-header__navigation cl-header__navigation--dropdown">
			<?php 
					if( $menu_id == 'default' )
						$args = array("theme_location" => "main", "container" => true, "fallback_cb" => 'codeless_default_menu');
					else{
						$args = array( "menu" => $menu_id, "container" => true, "fallback_cb" => 'codeless_default_menu'  );
					}
					wp_nav_menu($args);  
			?> 
		</nav>
	</div>

	<div class="cl-header__mobile-button cl-header__mobile-button--<?php echo esc_attr( codeless_get_mod('header_mobile_menu_hamburger_color', 'dark') ) ?>">
		<span></span>
		<span></span>
		<span></span>
	</div> 
<?php endif; ?>

<?php if( $style == 'fullscreen-overlay' ): ?>

<div class="cl-header__hamburger-button">
	<span></span>
	<span></span>
	<span></span>
</div> 

<?php endif; ?>

<?php $cl_from_element['cl_menu_start'] = false; ?>

