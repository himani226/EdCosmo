<?php 

$menu_id = codeless_get_mod( 'header_menu_id', 'default' ); 

global $cl_from_element;
$cl_from_element['cl_menu_start'] = true;

?>

<div class="cl-fullscreen-overlay">
    <div class="cl-fullscreen-overlay__wrapper">
        <div class="cl-fullscreen-overlay__logo">
            <?php echo codeless_header_logo_helper() ?>
            <a href="#" class="cl-fullscreen-overlay__close">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <nav class="cl-fullscreen-overlay__menu">
                <?php 
                        if( $menu_id == 'default' )
                            $args = array("theme_location" => "main", "container" => true, "fallback_cb" => 'codeless_default_menu');
                        else{
                            $args = array( "menu" => (int) $menu_id, "container" => true, "fallback_cb" => 'codeless_default_menu'  );
                        }
                        wp_nav_menu($args);  
                ?> 
        </nav>
        <div class="cl-fullscreen-overlay__dynamic">
            <?php if( is_active_sidebar('fullscreen-overlay') ) dynamic_sidebar( 'fullscreen-overlay' ); ?>
        </div>
    </div>
    
</div>

<?php $cl_from_element['cl_menu_start'] = false; ?>