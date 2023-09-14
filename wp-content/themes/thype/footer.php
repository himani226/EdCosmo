<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #viewport #wrapper #main div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Thype WordPress Theme
 * @subpackage Templates
 * @since 1.0
 */

?>
        <?php codeless_hook_main_end(); ?>
        
	    </main><!-- #main -->
        
        <?php
        
        /**
         * Functions hooked into codeless_hook_main_after action
         *
         * @hooked codeless_show_footer                     - 0
         */
        codeless_hook_main_after() ?>

	    <?php codeless_hook_wrapper_end() ?>
	    
    </div><!-- #wrapper -->
    
    <?php 

		/**
		 * Functions hooked into codeless_hook_wrapper_after action
		 *
		 * @hooked codeless_creative_search 				- 10 
		 */   
    	codeless_hook_wrapper_after()
    ?>

    <?php 

        /**
         * Functions hooked into codeless_hook_viewport_end action
         *
         * @hooked codeless_layout_bordered                 - 10 
         */ 
        codeless_hook_viewport_end() 

    ?>
    
</div><!-- #viewport -->

<?php codeless_hook_viewport_after() ?>

<?php wp_footer(); ?>

</body>
</html>