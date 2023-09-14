<?php
function import($file) {

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$file_contents = $wp_filesystem->get_contents( $file );	
		$import_data = json_decode( $file_contents, true );

		$options_to_import = $import_data['options']['of_options_pmc'];
		$options_to_import_widget_text = $import_data['options']['widget_text'];
		$options_to_import_sidebars_widgets = $import_data['options']['sidebars_widgets'];		
		$options_to_import_sidebars_layout = $import_data['options']['option_tree_layouts'];	
		$options_to_import_sb_instagram_settings = $import_data['options']['sb_instagram_settings'];	

		

		$option_value = maybe_unserialize( $options_to_import );
		$option_value_widget_text = maybe_unserialize( $options_to_import_widget_text );	
		$option_value_widget_sidebars_widgets = maybe_unserialize( $options_to_import_sidebars_widgets );	
		$option_tree_layouts =  maybe_unserialize( $options_to_import_sidebars_layout );	
		$sb_instagram_settings =  maybe_unserialize( $options_to_import_sb_instagram_settings );	

		
		delete_option( 'of_options_pmc' );
		add_option( 'of_options_pmc', $option_value, '', 'no' );
			
		delete_option( 'widget_text' );
		add_option( 'widget_text', $option_value_widget_text, '', 'no' );			

		delete_option( 'sb_instagram_settings' );
		add_option( 'sb_instagram_settings', $sb_instagram_settings, '', 'no' );			

		delete_option( 'option_tree_layouts' );
		add_option( 'option_tree_layouts', $option_tree_layouts, '', 'no' );			
		
		//update_option( 'wysija', $wysija, '', 'no' );	
}




