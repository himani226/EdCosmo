<?php 
     add_thickbox(); 

     $demos = cl_backpanel::get_demos();
?>


<div id="importer_dialog" style="display:none;">
     <div class="description">

     </div>

     <div class="demos">
          <?php foreach( $demos as $demo ): ?>
               <div class="demo">
                    <div class="inner">
                         <?php 
                         if( !isset( $demo['home_slug'] ) )
                              $demo['home_slug'] = 'home';
                         if( !isset( $demo['header'] ) )
                              $demo['header'] = '';
                         if( !isset( $demo['footer'] ) )
                              $demo['footer'] = '';
                              
                         ?>
                         <a href="#" class="demo_link" data-demo-id="<?php echo esc_attr( $demo['id'] ) ?>" data-parts="<?php echo esc_attr( $demo['parts'] ) ?>"  data-home-slug="<?php echo esc_attr( $demo['home_slug'] ) ?>" data-header="<?php echo esc_attr( $demo['header'] ) ?>" data-footer="<?php echo esc_attr( $demo['footer'] ) ?>"></a>
                         <img src="<?php echo get_template_directory_uri() .'/includes/codeless_demos_content/'.$demo['id'].'/image.png'; ?>" alt="<?php echo esc_attr($demo['label']) ?>" />
                         <div class="overlay"><?php echo esc_attr($demo['label']) ?></div>
                    </div>
                    <a href="<?php echo esc_url( $demo['preview'] ) ?>" target="_blank" class="preview">Preview</a>
               </div>
          <?php endforeach; ?>
     </div>
</div>