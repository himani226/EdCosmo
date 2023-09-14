<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Thype
 * @subpackage Templates
 * @since 1.0.0
 */

if( ! codeless_is_active_sidebar() )
    return;
    

?>

<aside id="secondary" class="widget-area <?php echo esc_attr( codeless_extra_classes( 'secondary' ) ) ?>" <?php echo codeless_extra_attr( 'secondary' ) ?>>

	<?php
        
    /**
     * Functions hooked into codeless_hook_secondary_begin action
     *
     * @hooked codeless_sticky_sidebar_wrapper                     - 0
     */
    codeless_hook_secondary_begin() ?>

	<?php dynamic_sidebar( codeless_get_sidebar_name() ); ?>

	<?php
        
    /**
     * Functions hooked into codeless_hook_secondary_end action
     *
     * @hooked codeless_sticky_sidebar_wrapper_end                 - 0
     */
    codeless_hook_secondary_end() ?>

</aside><!-- #secondary -->