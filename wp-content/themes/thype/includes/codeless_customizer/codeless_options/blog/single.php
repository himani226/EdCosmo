<?php

Kirki::add_section('cl_blog_single', array(
	'title' => esc_attr__('Single Post', 'thype') ,
	'panel' => 'cl_blog',
	'type' => '',
	'priority' => 11,
	'capability' => 'edit_theme_options'
));


        Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_share',
			'label'    => esc_attr__( 'Single Blog Shares', 'thype' ),
			
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 0,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		) );

		Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_tags',
			'label'    => esc_attr__( 'Single Blog Tags', 'thype' ),
			
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 1,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		) );
		
		Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_author_box',
			'label'    => esc_attr__( 'Single Blog Author Info', 'thype' ),
			
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 0,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		) );

		Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_meta_author_category',
			'label'    => esc_attr__( 'Single Blog Category/Author Post Header', 'thype' ),
			'description' => esc_attr__( 'Switch OFF to remove the default Category/Author Name & Image Feature on Post Header from Single Posts', 'thype' ),
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 1,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		  
		) );

		Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_related',
			'label'    => esc_attr__( 'Single Blog Related Posts', 'thype' ),
			
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 0,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		) );

		Kirki::add_field( 'cl_thype', array(
			'settings' => 'single_blog_pagination',
			'label'    => esc_attr__( 'Single Blog Pagination', 'thype' ),
			
			'section'  => 'cl_blog_single',
			'type'     => 'switch',
			'priority' => 10,
			'default'  => 1,
			'choices'     => array(
				1  => esc_attr__( 'On', 'thype' ),
				0 => esc_attr__( 'Off', 'thype' ),
			),
		) );
		