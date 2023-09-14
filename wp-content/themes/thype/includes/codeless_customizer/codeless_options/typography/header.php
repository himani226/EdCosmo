<?php


Kirki::add_section('cl_typography_header', array(
	'title' => esc_attr__('Header', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_typography',
	'type' => '',
	'priority' => 9,
	'capability' => 'edit_theme_options'
));


Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
		'settings'    => 'header_top_typography',
		'label'       => esc_attr__( 'Header Top Section', 'thype' ),
		'section'     => 'cl_typography_header',
		'into_group' => true,
		'show_subsets' => false,
		'default'     => array(
			'letter-spacing' => '0',
			'font-weight' => '400',
			'text-transform' => 'uppercase',
			'font-size' => '11px',
			'line-height' => '1.2',
		),
		'priority'    => 10,
		'transport' => 'auto',
		'output'      => array(
			array(
				'element' => '.cl-header__row--top'
			),
	
		)
));


?>