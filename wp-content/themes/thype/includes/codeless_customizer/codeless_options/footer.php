<?php

Kirki::add_panel( 'cl_footer', array(
		'priority' => 12,
	    'type' => 'default',
	    'title'       => esc_attr__( 'Footer', 'thype' ),
	    'tooltip' => esc_attr__( 'Footer Options and Layout', 'thype' ),
	) );


	require_once 'footer/main.php';
	require_once 'footer/copyright.php';
	require_once 'footer/extra.php';

?>