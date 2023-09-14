<?php 
	add_thickbox(); 

	$demos = cl_backpanel::get_headers();
?>


<div id="importer_header_dialog" style="display:none;">
     <div class="description">

     </div>

     <div class="demos headers">
     	<?php foreach( $demos as $demo ): ?>
     		<div class="demo">
     			<div class="inner">
	     			<a href="#" class="demo_link" data-demo-id="<?php echo esc_attr( $demo['id'] ) ?>"></a>
	     			<img src="<?php echo get_template_directory_uri() .'/includes/codeless_header_predefined/'.$demo['id'].'/image.png'; ?>" alt="<?php echo esc_attr($demo['label']) ?>" />
	     			<div class="overlay"><?php echo esc_attr($demo['label']) ?></div>
	     		</div>
     			<a href="<?php echo esc_url( $demo['preview'] ) ?>" target="_blank" class="preview">Preview</a>
     		</div>
     	<?php endforeach; ?>
     </div>
</div>