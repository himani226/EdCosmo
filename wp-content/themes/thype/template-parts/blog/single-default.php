<?php
/**
 * Template part for single blog
 * Default Style
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
 
<article id="post-<?php the_ID(); ?>" <?php post_class(  ); ?>>
		
		<div class="cl-content">
			<?php
			/**
			* Load Floated Social Share
			*/
			if( codeless_get_mod( 'single_blog_share', false ) )
				get_template_part( 'template-parts/blog/parts/single', 'share' );
			?>
			<?php get_template_part( 'template-parts/blog/formats/content', get_post_format() ) ?>
	
		</div><!-- .cl-content -->
		
</article><!-- #post-## -->
