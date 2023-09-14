<?php

/* ----------------------------- Extra Row --------------------------------------- */

Kirki::add_section('cl_header_top_news', array(
	'title' => esc_attr__('Top News', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_header',
	'type' => '',
	'priority' => 6,
	'capability' => 'edit_theme_options'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_news',
	'label' => esc_attr__('Activate Top News Bar', 'thype') ,
	'tooltip' => esc_attr__('Switch on to active Top News Bar', 'thype') ,
	'section' => 'cl_header_top_news',
	'type' => 'switch',
	'default' => 0,
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'header_top_news_title',
    'label' => esc_attr__('Bar Title', 'thype') ,
	'section' => 'cl_header_top_news',
	'type' => 'text',
	'default' => esc_attr__('Top News', 'thype'),
	'choices' => array(
		1 => esc_attr__('On', 'thype') ,
		0 => esc_attr__('Off', 'thype') ,
	) ,
	'transport' => 'refresh'
));