<?php

/* ----------------------------- Extra Row --------------------------------------- */

Kirki::add_section('cl_header_extra_row', array(
	'title' => esc_attr__('Extra (Bottom) Area', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_header',
	'type' => '',
	'priority' => 6,
	'capability' => 'edit_theme_options'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_extra',
	'label' => esc_attr__('Activate Extra Header', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Extra Header Navigation Row, than you can add elements.', 'thype') ,
	'section' => 'cl_header_extra_row',
	'type' => 'switch',
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));

Kirki::add_field('cl_thype', array(
	'type' => 'slider',
	'settings' => 'header_height_extra',
	'label' => 'Height',
	'tooltip' => '',
	'default' => 40,
	'choices' => array(
		'min' => '30',
		'max' => '600',
		'step' => '1',
	) ,
	'inline_control' => true,
	'section' => 'cl_header_extra_row',
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.cl-header__row--extra',
			'units' => 'px',
			'property' => 'height'
		) ,
	) ,
));

Kirki::add_field('cl_thype', array(
	'type' => 'slider',
	'settings' => 'header_space_el_extra',
	'label' => 'Space between elements',
	'default' => 15,
	'choices' => array(
		'min' => '0',
		'max' => '80',
		'step' => '1',
	) ,
	'inline_control' => true,
	'section' => 'cl_header_extra_row',
	'output' => array(
		array(
			'element' => '.cl-header__row--extra .cl-header__element',
			'units' => 'px',
			'property' => 'padding-right',
			'media_query' => '@media (min-width: 768px)'
		),
		array(
			'element' => '.cl-header__row--extra .cl-header__element',
			'units' => 'px',
			'property' => 'padding-left',
			'media_query' => '@media (min-width: 768px)'
		)
	) ,
    'transport' => 'auto',
    
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_extra_force_center',
	'label' => esc_attr__('Middle Column - Force Center', 'thype') ,
	'section' => 'cl_header_extra_row',
	'type' => 'switch',
	'priority' => 10,
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_extra_mobile',
	'label' => esc_attr__('Show on Small Screens', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Extra Header Navigation Row on small screens max 991px', 'thype') ,
	'section' => 'cl_header_extra_row',
	'type' => 'switch',
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'postMessage'
));

Kirki::add_field('cl_thype', array(
	'type'        => 'sortable',
	'settings'    => 'header_extra_responsive_columns',
	'description' => esc_attr__( 'Responsive Columns', 'thype' ),
	'tooltip'       => esc_attr__( 'Click "eye" to show or hide the column on mobile, drag and drop to change the position. Works for screen small then 992px', 'thype' ),
	'section'     => 'cl_header_extra_row',
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
			'setting' => 'header_extra_mobile',
			'operator' => '==',
			'value' => true
		) ,
	)
));



Kirki::add_field('cl_thype', array(
	'settings' => 'header_extra_sticky',
	'label' => esc_attr__('Show on Sticky', 'thype') ,
	'section' => 'cl_header_extra_row',
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
	'settings' => 'header_extra_inner_top_border',
	'label' => esc_attr__('Add Inner Top Border', 'thype') ,
	'section' => 'cl_header_extra_row',
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
	'settings' => 'header_extra_box',
	'label' => esc_attr__('Advanced Box Design', 'thype') ,
	'section' => 'cl_header_extra_row',
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
	'settings' => 'header_design_extra',
	'description' => esc_attr__('Box Design', 'thype') ,
	'section' => 'cl_header_extra_row',
	'type' => 'css_tool',
	'default' => array(
		'border-bottom-width' => '0px'
	) ,
	'into_group' => true,
    'transport' => 'postMessage',
    'required' => array(
		array(
			'setting' => 'header_extra_box',
			'operator' => '==',
			'value' => 1,
			'transport' => 'postMessage'
		) ,
	)
));


?>