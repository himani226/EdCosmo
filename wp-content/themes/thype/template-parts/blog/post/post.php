<?php
/**
 * Template part for displaying single post
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
	
	<?php 

	$post_format = get_post_format() || '';
	
	/**
	 * Generate Post Thumbnail for Single Post and Blog Page
	 */ 
	
	if ( has_post_thumbnail() && $post_format != 'gallery' ) :
		
		get_template_part( 'template-parts/blog/parts/entry', 'thumbnail' );
	
	endif; ?>
	
	
	<?php
	
	/**
	 * Generate Slider if needed
	 */ 
	if ( get_post_format() == 'gallery' && get_post_gallery() ):
	
		get_template_part( 'template-parts/blog/parts/entry', 'slider' );
	
	endif; ?>
	
	<?php
	
	/**
	 * Generate Video Output
	 */ 
	if ( get_post_format() == 'video' ):
	
		get_template_part( 'template-parts/blog/parts/entry', 'video' );
	
	endif; ?>
	
	<?php
	
	/**
	 * Generate Audio Output
	 */ 
	if ( get_post_format() == 'audio' ):
	
		get_template_part( 'template-parts/blog/parts/entry', 'audio' );
	
	endif; ?>
		
	
	<div class="entry-wrapper">

			
			<?php	
			/**
			 * Entry Header
			 * Output Entry Meta and title
			 */ 
			?>
			<header class="entry-header">
				
				<?php get_template_part( 'template-parts/blog/parts/entry', 'meta' ); ?>
				
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				
			</header><!-- .entry-header -->
				
			<?php get_template_part( 'template-parts/blog/formats/content', get_post_format() ) ?>		
	
	</div><!-- .entry-wrapper -->
	
	<?php if ( is_single() ) : ?>

	<?php endif; ?>

</article><!-- #post-## -->
