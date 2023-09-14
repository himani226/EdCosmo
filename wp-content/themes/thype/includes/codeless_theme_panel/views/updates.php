<?php
	$cl_update = cl_backpanel::cl_version();
	$new_update = false;
	$my_theme = wp_get_theme();

	if(version_compare($cl_update,  $my_theme->get('Version')) > 0) 
		$new_update = true;
?>

<div class="wrapper postbox with-pad">

	<h2 class="box-title">Updates</h2>

	<div class="inner-wrapper">


        <img src="<?php echo get_template_directory_uri() ?>/includes/codeless_theme_panel/assets/img/updates.png" width="200" />

        <h2>Stay Updated!</h2>

        <div class="description">Now you are ready to start install templates and build your next website!
        <p>Your current theme version: <strong><?php echo esc_html( $my_theme->get('Version') ) ?></strong></p>
        <?php if( !$new_update ){ ?>

        	<h5>You have the latest version installed</h5>

        <?php } else{ ?> 

        	<p>A new version is released: <strong><?php echo esc_html( $cl_update ) ?></strong></p>
        	
        	<?php if( ! class_exists('Envato_Market')): ?>
        		
        		<p>You need to install or active the Envato Market Plugin for an automatically update. <a href="<?php echo admin_url('themes.php?page=install-required-plugins') ?>">Click here</a></p>

        	<?php endif; ?>

        	<?php if( function_exists('envato_market') ):

        		
        		$options = envato_market()->get_options();
        		
        		if( ! empty($options) && ( ! empty( $options['token'] ) || (isset( $options['items'] ) && ! empty($options['items'] ) )  ) ){
        			?>

        				<a id="updatesBtn" href="<?php echo admin_url('update-core.php') ?>" class="button-primary codeless-hint-qtip"><?php esc_html_e( 'Update Now', 'thype' ); ?></a>

        			<?php
        		}else{
        			?>
        				<p>Please configure the Envato Market API to begin the automatic update. <a href="<?php echo admin_url('admin.php?page=envato-market') ?>">Click here</a></p>

        			<?php
        		}

        	endif; ?>

	        <p>
	            
	        </p>

	    <?php } ?>

        </div>
	</div>

</div>