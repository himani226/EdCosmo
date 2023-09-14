<?php

Kirki::add_section('cl_colors_page_header', array(
	'title' => esc_attr__('Page Header Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'page_header_bg_color',
    'label' => 'Page Header Site Default',
    'default' => '#fbfbfb',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_page_header',
    'transport' => 'refresh'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'page_header_bg_color_page',
    'label' => 'Page Header Pages Default',
    'default' => '',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_page_header',
    'transport' => 'refresh'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'page_header_bg_color_archive',
    'label' => 'Page Header Archives Default',
    'default' => '',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_page_header',
    'transport' => 'refresh'
));