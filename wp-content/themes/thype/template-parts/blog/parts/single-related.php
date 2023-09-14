<?php
/**
 * Blog Template Part for displaying single blog related posts
 *
 * @package Thype
 * @subpackage Blog Parts
 * @since 1.0.0
 *
 */


$the_query = codeless_get_related_posts( get_the_ID(), 4 );
global $cl_from_element;
$cl_from_element['is_related'] = true;						
// Display posts
if ( $the_query->have_posts() ) : 

?>
<div class="cl-entry-single-section cl-entry-single-section--related">
	<h6 class="cl-entry-single-section__title cl-custom-font"><?php echo esc_attr__( 'Related Posts', 'thype' ) ?></h6>
	<div class="cl-blog cl-blog--style-simple-no_content cl-blog--module-carousel">
		<div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme" data-dots="1" data-nav="0" data-items="2" data-responsive='{"0": {"items":1}, "992": { "items":2 } }'>
			<?php $i = 0;
				while ( $the_query->have_posts() ) : $the_query->the_post();
				

				if( has_post_thumbnail() ){
					get_template_part( 'template-parts/blog/style-simple-no_content' );
					$i++;
				}
					
				if( $i == 2 )
					break;

				endwhile;
			?>
		</div>
	</div>
</div>

<?php endif; 

wp_reset_query();
$cl_from_element['is_related'] = false;
?>