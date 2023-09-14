<?php
/**
 * Template part for displaying posts
 * Headlines2 Style
 * Switch styles at Theme Options (WP Customizer)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thype
 * @subpackage Templates
 * @since 1.0.0
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?>>

	<div class="cl-entry__headline2-wrapper">

		<div class="cl-entry__wrapper">

			<div class="cl-entry__wrapper-content">
			
				<?php

					/**
					 * Entry Header
					 * Output Entry Meta and title
					 */ 
				?>
				
				<header class="cl-entry__header">
                    
					<?php the_title( '<h2 class="cl-entry__title cl-custom-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				
				</header><!-- .cl-entry__header -->
		
			<?php
			/**
			 * Close Entry Wrapper
			 */ 
			?>
			
			</div><!-- .cl-entry__wrapper-content -->
			
		</div><!-- .cl-entry__wrapper -->

	</div><!-- .cl-entry__headlines2-wrapper -->	
</article><!-- #post-## -->