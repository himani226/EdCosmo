<div class="cl-entry__meta-wrapper">
				
	<?php foreach( codeless_get_post_entry_meta() as $entry_meta ): ?>
		<div class="cl-entry__meta <?php echo esc_attr( $entry_meta['id'] ) ?>">
			<span class="cl-entry__meta-prepend"><?php echo esc_html( $entry_meta['prepend']) ?></span>
				<?php echo wp_kses_post( $entry_meta['value'] ); ?>
		</div><!-- .cl-entry__meta-single -->
	<?php endforeach; ?>
				
</div><!-- .cl-entry__meta -->