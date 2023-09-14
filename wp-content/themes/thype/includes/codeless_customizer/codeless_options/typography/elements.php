<?php

Kirki::add_section('cl_typography_elements', array(
	'title' => esc_attr__('Elements', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_typography',
	'type' => '',
	'priority' => 9,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'element_title',
	'label'       => esc_attr__( 'Element Title', 'thype' ),
	'section'     => 'cl_typography_elements',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Montserrat',
		'letter-spacing' => '0px',
		'font-weight' => '700',
		'text-transform' => 'uppercase',
		'font-size' => '16px',
		'line-height' => '28px',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => '.cl-element__title'
		),

	)
));

?>