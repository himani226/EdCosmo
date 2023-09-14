<?php

Kirki::add_section('cl_layout_defaults_posts', array(
	'title' => esc_attr__('Defaults for Posts', 'thype') ,
	'description' => 'Default Site Layout for all pages on this site.',
	'panel' => 'cl_layout',
	'type' => '',
	'priority' => 7,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'overwrite_post_layout',
    'label'    => esc_attr__( 'Defaults for Posts', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'fullwidth',
    'choices'     => array(
        'default'  => esc_attr__( '--- Use Site Defaults ---', 'thype' ),
        'custom'  => esc_attr__( 'Custom for Posts', 'thype' )
    ),
    
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'layout_post',
    'description'    => esc_attr__( 'Layout', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'fullwidth',
    'choices'     => array(
        'fullwidth'  => esc_attr__( 'Fullwidth', 'thype' ),
        'left_sidebar'  => esc_attr__( 'Left Sidebar', 'thype' ),
        'right_sidebar'  => esc_attr__( 'Right Sidebar', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'overwrite_post_layout',
			'operator' => '==',
			'value' => 'custom',
		) ,
    )
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'fullwidth_content_post',
    'description'    => esc_attr__( 'Fullwidth Content', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0  => esc_attr__( 'Off', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'overwrite_post_layout',
			'operator' => '==',
			'value' => 'custom',
		) ,
    )
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'wrapper_content_post',
    'description'    => esc_attr__( 'Wrapper Content', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0  => esc_attr__( 'Off', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'overwrite_post_layout',
			'operator' => '==',
			'value' => 'custom',
		) ,
    )
));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'header_color_post',
    'description'    => esc_attr__( 'Header Color', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'dark',
    'choices'     => array(
        'dark'  => esc_attr__( 'Dark', 'thype' ),
        'light'  => esc_attr__( 'Light', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'overwrite_post_layout',
			'operator' => '==',
			'value' => 'custom',
		) ,
    )
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'header_transparent_post',
    'description'    => esc_attr__( 'Header Transparent', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0  => esc_attr__( 'Off', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'overwrite_post_layout',
			'operator' => '==',
			'value' => 'custom',
		) ,
    )
));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'post_header_color',
    'label'    => esc_attr__( 'Post Header Color', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'light',
    'choices'     => array(
        'dark'  => esc_attr__( 'Dark', 'thype' ),
        'light'  => esc_attr__( 'Light', 'thype' )
    ),
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'post_header_layout',
    'label'    => esc_attr__( 'Post Header Layout', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_defaults_posts',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'fullwidth',
    'choices'     => array(
        'container'  => esc_attr__( 'Container', 'thype' ),
        'fullwidth'  => esc_attr__( 'Fullwidth', 'thype' )
    ),
));