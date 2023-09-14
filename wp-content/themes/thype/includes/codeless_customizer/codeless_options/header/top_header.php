<?php

/* ----------------------------- Top Nav --------------------------------------- */
Kirki::add_section('cl_header_top_row', array(
	'title' => esc_attr__('Top Header Area', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_header',
	'type' => '',
	'priority' => 6,
	'capability' => 'edit_theme_options'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_nav',
	'label' => esc_attr__('Activate Top Header', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Top Header Navigation Row, than you can add elements.', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));


Kirki::add_field('cl_thype', array(
	'type' => 'slider',
	'settings' => 'header_height_top',
	'label' => 'Height',
	'tooltip' => 'Works on Top, Bottom Layouts or when outter boxed header is actived',
	'default' => 30,
	'choices' => array(
		'min' => '30',
		'max' => '600',
		'step' => '1',
	) ,
	'inline_control' => true,
	'section' => 'cl_header_top_row',
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.cl-header__row--top',
			'units' => 'px',
			'property' => 'height'
		)
	) ,
));

Kirki::add_field('cl_thype', array(
	'type' => 'slider',
	'settings' => 'header_space_el_top',
	'label' => 'Space between elements',
	'default' => 15,
	'choices' => array(
		'min' => '0',
		'max' => '80',
		'step' => '1',
	) ,
	'inline_control' => true,
	'section' => 'cl_header_top_row',
	'output' => array(
		array(
			'element' => '.cl-header__row--top .cl-header__element',
			'units' => 'px',
			'property' => 'padding-right',
			'media_query' => '@media (min-width: 768px)'
		),
		array(
			'element' => '.cl-header__row--top .cl-header__element',
			'units' => 'px',
			'property' => 'padding-left',
			'media_query' => '@media (min-width: 768px)'
		)
	) ,
    'transport' => 'auto',
    
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_force_center',
	'label' => esc_attr__('Middle Column - Force Center', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_nav_mobile',
	'label' => esc_attr__('Show on Small Screens', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Top Header Navigation Row on small screens max 991px', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));

Kirki::add_field('cl_thype', array(
	'type'        => 'sortable',
	'settings'    => 'header_top_responsive_columns',
	'description' => esc_attr__( 'Responsive Columns', 'thype' ),
	'tooltip'       => esc_attr__( 'Click "eye" to show or hide the column on mobile, drag and drop to change the position. Works for screen small then 992px', 'thype' ),
	'section'     => 'cl_header_top_row',
	'default'     => array(
		'left',
		'middle',
		'right'
	),
	'choices'     => array(
		'left' => esc_attr__( 'Left Column', 'thype' ),
		'middle' => esc_attr__( 'Middle Column', 'thype' ),
		'right' => esc_attr__( 'Right Column', 'thype' )
	),
	'priority'    => 10,
	'required' => array(
		array(
			'setting' => 'header_top_nav_mobile',
			'operator' => '==',
			'value' => true,
			'transport' => 'postMessage'
		) ,
	)
));


Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_nav_sticky',
	'label' => esc_attr__('Show on Sticky', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Top Header Navigation Row on sticky', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));


Kirki::add_field('cl_thype', array(
	'settings' => 'header_overwrite_typography',
	'label' => esc_attr__('Advanced Typography', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active custom typography for top navigation', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'postMessage'
));

Kirki::add_field('cl_thype', array(
	'type' => 'typography',
	'settings' => 'header_top_typography',
	'inline_control' => true,
	'section' => 'cl_header_top_row',
	'default'     => array(
		'font-family'    => 'Source Sans Pro',
		'letter-spacing' => '0',
		'font-weight' => '400',
		'text-transform' => 'none',
		'font-size' => '14px',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => codeless_dynamic_css_register_tags('header_top_typography'),
		),

	),
	'required' => array(
		array(
			'setting' => 'header_overwrite_typography',
			'operator' => '==',
			'value' => true,
			'transport' => 'postMessage'
		) ,
	)
));


Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_box',
	'label' => esc_attr__('Advanced Box Design', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'postMessage'
));



Kirki::add_field('cl_thype', array(
	'settings' => 'header_design_top',
	'description' => esc_attr__('Box Design', 'thype') ,
	'section' => 'cl_header_top_row',
	'type' => 'css_tool',
	'default' => array(
		'border-bottom-width' => '0px'
	) ,
	'into_group' => true,
    'transport' => 'postMessage',
    'required' => array(
		array(
			'setting' => 'header_top_box',
			'operator' => '==',
			'value' => 1,
			'transport' => 'postMessage'
		) ,
	)
));


?>