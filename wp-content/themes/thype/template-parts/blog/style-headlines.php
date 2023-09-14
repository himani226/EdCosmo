<?php
/**
 * Template part for displaying posts
 * Headlines Style
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

	<div class="cl-entry__headline-wrapper">

		<div class="cl-entry__wrapper">

			<div class="cl-entry__wrapper-content">
			
				<?php

					/**
					 * Entry Header
					 * Output Entry Meta and title
					 */ 
				?>
				
				<header class="cl-entry__header">

                    <span class="cl-entry__time"><?php echo get_the_date( 'h:i A' ) ?></span>
					<?php the_title( '<h2 class="cl-entry__title cl-custom-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				
				</header><!-- .cl-entry__header -->
		
			<?php
			/**
			 * Close Entry Wrapper
			 */ 
			?>
			
			</div><!-- .cl-entry__wrapper-content -->
			
		</div><!-- .cl-entry__wrapper -->

	</div><!-- .cl-entry__headlines-wrapper -->	
</article><!-- #post-## -->