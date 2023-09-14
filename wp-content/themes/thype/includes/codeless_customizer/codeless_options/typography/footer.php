<?php

Kirki::add_section('cl_typography_footer', array(
	'title' => esc_attr__('Footer', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_typography',
	'type' => '',
	'priority' => 9,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'footer_widget_typo',
	'label'       => esc_attr__( 'Footer Widgets Title', 'thype' ),
	'section'     => 'cl_typography_footer',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Montserrat',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'uppercase',
		'font-size' => '14px',
		'line-height' => '28px',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => codeless_dynamic_css_register_tags( 'footer_widgets_title_typography' )
		),

	)
));