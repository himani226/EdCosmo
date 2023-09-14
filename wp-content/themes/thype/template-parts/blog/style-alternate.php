<?php
/**
 * Template part for displaying posts
 * Alternate Style
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
    <div class="cl-entry__alternate-wrapper">
	<?php 
	
	$post_format = get_post_format();
	/**
	 * Generate Post Thumbnail for Single Post and Blog Page
	 */ 
	
	if ( ( has_post_thumbnail() || $post_format == 'image' ) && $post_format != 'gallery' && ( ! is_single() || ( is_single() && codeless_get_post_style() == 'classic' ) ) ) :
		
		get_template_part( 'template-parts/blog/parts/entry', 'thumbnail' );
	
	endif; ?>
	
	
	<?php

	/**
	 * Generate Slider if needed
	 */ 
	if ( get_post_format() == 'gallery' && !empty( codeless_post_galleries_data(get_post(get_the_ID()) ) ) ):
		
		get_template_part( 'template-parts/blog/parts/entry', 'slider' );
	
	endif; ?>
	
	
	<?php
	
	/**
	 * Generate Audio Output
	 */ 
	if ( get_post_format() == 'audio' ):
	
		get_template_part( 'template-parts/blog/parts/entry', 'audio' );
	
	endif; ?>
		
	
	<div class="cl-entry__wrapper">
	
	
		<div class="cl-entry__wrapper-content">
		
			<?php

				/**
				 * Entry Header
				 * Output Entry Meta and title
				 */ 
			?>
			
			<header class="cl-entry__header">

				<?php if( codeless_get_mod( 'blog_entry_meta_author_category', true ) ): ?>
				<div class="cl-entry__author">
					<?php 
					$avatar = get_avatar( get_the_author_meta('user_email') , 30 ) ;

					if($avatar !== FALSE)
						echo codeless_complex_esc( $avatar );
					?>
					<div class="cl-entry__author-data">
						<div class="cl-entry__categories"><?php echo get_the_category_list( ' ' ) ?></div>
						<?php echo esc_attr__( 'by', 'thype' ) . ' ' . get_the_author() ?>
					</div>
				</div><!-- .cl-entry__author -->
				<?php endif; ?>
					
				<?php the_title( '<h2 class="cl-entry__title cl-custom-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				
				<div class="cl-entry__details">
					<?php get_template_part( 'template-parts/blog/parts/entry', 'meta' ); ?>
					<?php get_template_part( 'template-parts/blog/parts/entry', 'tools' ); ?>
				</div><!-- .cl-entry__details -->

			</header><!-- .cl-entry__header -->
				
			<?php get_template_part( 'template-parts/blog/formats/content', get_post_format() ) ?>

            <?php get_template_part( 'template-parts/blog/parts/entry', 'readmore' ); ?>
	
		<?php
		/**
		 * Close Entry Wrapper
		 */ 
		?>
		
		</div><!-- .cl-entry__wrapper-content -->
		
	</div><!-- .cl-entry__wrapper -->
    </div><!-- .cl-entry__alternate-wrapper -->
</article><!-- #post-## -->
