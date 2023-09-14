<?php
/**
 * Template part for displaying posts
 * Big Style
 * Switch styles at Theme Options (WP Customizer)
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thype
 * @subpackage Templates
 * @since 1.0.0
 *
 */

global $cl_from_element;
$cl_from_element['blog_excerpt_length'] = 20;

$style = '';
if( codeless_get_mod( 'blog_featured_posts_image', 'no' ) == 'yes' ){
	$style = 'background-image:url(\' ' . get_the_post_thumbnail_url() . '\' );';
}

?>

<article id="slider-post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?> style="<?php echo esc_attr( $style ) ?>">
		
	<div class="cl-entry__overlay"></div>
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
						echo codeless_complex_esc($avatar);
					?>
					<div class="cl-entry__author-data">
						<div class="cl-entry__categories"><?php echo get_the_category_list( ' ' ) ?></div>
						<?php echo esc_attr__( 'by', 'thype' ) . ' ' . get_the_author() ?>
					</div>
				</div>
				<?php endif; ?>
					
				<?php the_title( '<h2 class="cl-entry__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				
			</header><!-- .cl-entry__header -->
				
			<?php get_template_part( 'template-parts/blog/formats/content' ) ?>
	
		<?php
		/**
		 * Close Entry Wrapper
		 */ 
		?>
		
		</div><!-- .cl-entry__wrapper-content -->
		
	</div><!-- .cl-entry__wrapper -->

</article><!-- #post-## -->
