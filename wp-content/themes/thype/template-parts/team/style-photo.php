<?php
/**
 * Template part for displaying team items
 * Photo Style
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

<div class="team-item <?php echo codeless_extra_classes( 'team_item' ) ?>" id="cl_team_item-<?php echo get_the_ID() ?>" <?php echo codeless_extra_attr( 'team_item' ) ?>>

	<div class="team-media-wrapper">
		
		<div class="team-thumbnail">
			
			<?php the_post_thumbnail( codeless_get_team_thumbnail_size() ); ?>

		</div><!-- .team-thumbnail -->
		<div class="team-overlay">
			<div class="team-overlay-wrapper">
				<div class="team-social">
					<?php 
						// Get Socials for this team member, TRUE is conditional for "echo"
						echo codeless_team_socials( ); 
					?>
				</div>
				<div class="team-content">
					<h3 class="team-name  <?php echo esc_attr( codeless_get_mod( 'team_title_typography', 'h3' ) ) ?> custom_font">
						<?php if( codeless_get_meta( 'staff_link', '', get_the_ID() ) != '' ): ?>
							<a href="<?php echo codeless_get_meta( 'staff_link', '', get_the_ID() ) ?>">
						<?php endif; ?>
							<?php echo get_the_title() ?>
						<?php if( codeless_get_meta( 'staff_link', '', get_the_ID() ) != '' ): ?>
							</a>
						<?php endif; ?>
					</h3>
					<span class="team-position"><?php echo codeless_get_meta('staff_position', 'Team Position', get_the_ID()); ?></span>
					<div class="team-desc">
						<?php echo get_the_content() ?>
					</div>
				</div><!-- team-content -->
			</div>
		</div>
	</div><!-- .team-overlay -->
	<?php codeless_hook_custom_post_end( 'staff', get_the_ID() ); ?>
</div>