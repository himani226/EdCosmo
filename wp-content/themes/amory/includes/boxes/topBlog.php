<?php 
$postmeta = get_post_custom(get_the_id()); 
?>
	
	<div class="topBlog">	
		<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
		<?php if (has_post_format( 'quote' , get_the_id())) { ?>
		<h2 class="title"><?php the_title(); ?></h2>
		<?php } else { ?>
		<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>		
		<?php  } ?>
		<?php if(amory_globals('display_post_meta')) { ?>
		<div class = "post-meta">
			<?php 
			$day = get_the_time('d');
			$month= get_the_time('m');
			$year= get_the_time('Y');
			?>
			<?php if (!has_post_format( 'quote' , get_the_id())) { ?>
			<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php echo get_the_date() ?></a><a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>		
			<?php } ?>
		</div>
		<?php } ?> <!-- end of post meta -->
	</div>	
