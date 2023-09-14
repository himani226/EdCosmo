<?php

/* -------------------- Layout --------------------- */

Kirki::add_section('cl_header_general', array(
	'title' => esc_attr__('Layout', 'thype') ,
	'tooltip' => esc_attr__('General Header Layout, global header options', 'thype') ,
	'panel' => 'cl_header',
	'type' => '',
	'priority' => 6,
	'capability' => 'edit_theme_options'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_container',
	'label' => esc_attr__('Header Stretch', 'thype') ,
	'section' => 'cl_header_general',
	'type' => 'radio-image',
	'default' => 'container-fluid',
	'priority' => 10,
	'choices'     => array(
		'container'   => get_template_directory_uri() . '/includes/codeless_customizer/images/header_container.png',
		'container-fluid'   => get_template_directory_uri() . '/includes/codeless_customizer/images/header_container-fluid.png'
	),
	'transport' => 'postMessage',
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_layout',
	'label' => esc_attr__('Header Layout', 'thype') ,
	'tooltip' => esc_attr__('Select type of header to use', 'thype') ,
	'section' => 'cl_header_general',
	'type' => 'select',
	'default' => 'top',
	'priority' => 10,
	'choices' => array(
		'top' => esc_attr__('Top', 'thype') 
	) ,
	'transport' => 'postMessage',
));

?>