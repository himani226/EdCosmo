<?php if( codeless_get_post_entry_tools() ): ?>

<div class="cl-entry__tools">
		
	<?php foreach( codeless_get_post_entry_tools() as $entry_tool ): ?>
		<div class="cl-entry__tool <?php echo esc_attr( $entry_tool['id'] ) ?>">
			<?php echo codeless_complex_esc( $entry_tool['html'] ); ?>
		</div><!-- .cl-entry__tool -->
	<?php endforeach; ?>
		
</div><!-- .cl-entry__tools -->
<?php endif; ?>