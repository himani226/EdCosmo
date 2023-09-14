<?php

Kirki::add_panel( 'cl_blog', array(
	    'priority'    => 11,
	    'type' => 'default',
	    'title'       => esc_attr__( 'Blog', 'thype' ),
	    'tooltip' => esc_attr__( 'All Blog Styles and options', 'thype' ),
	) );


	require_once 'blog/archives.php';
	require_once 'blog/single.php';


?>