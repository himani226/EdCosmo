<?php

Kirki::add_section('cl_typography_blog', array(
	'title' => esc_attr__('Blog', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_typography',
	'type' => '',
	'priority' => 9,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
		'type'        => 'typography',
		'settings'    => 'blog_entry_title',
		'label'       => esc_attr__( 'Blog Entry Title', 'thype' ),
		'section'     => 'cl_typography_blog',
		'into_group' => true,
		'show_subsets' => false,
		'default'     => array(
			'font-family'    => 'Noto Serif',
			'letter-spacing' => '0',
			'font-weight' => '700',
			'text-transform' => 'none',
			'font-size' => '26px',
			'line-height' => '1.2',
		),
		'priority'    => 10,
		'transport' => 'auto',
		'output'      => array(
			array(
				'element' => codeless_dynamic_css_register_tags( 'blog_entry_title' ),
				
			),
	
		)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'blog_single_title',
	'label'       => esc_attr__( 'Blog Single Title', 'thype' ),
	'section'     => 'cl_typography_blog',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'none',
		'font-size' => '60px',
		'line-height' => '1.2',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => '.cl-post-header__title',
			'media_query' => '@media (min-width: 992px)'
			
		),

	)
));


Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'blog_text_size',
	'label'       => esc_attr__( 'Blog Text Size', 'thype' ),
	'section'     => 'cl_typography_blog',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-size' => '18px',
		'line-height' => '1.75',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => '.cl-single-blog .cl-content'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'single_blog_section_title',
	'label'       => esc_attr__( 'Single Blog Sections Title', 'thype' ),
	'section'     => 'cl_typography_blog',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Montserrat',
		'letter-spacing' => '0px',
		'font-weight' => '700',
		'text-transform' => 'uppercase',
		'font-size' => '18px',
		'line-height' => '27px',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => '.cl-entry-single-section__title'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'blockquote_typo',
	'label'       => esc_attr__( 'Blockquote Typography', 'thype' ),
	'section'     => 'cl_typography_blog',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '400',
		'text-transform' => 'none',
		'font-size' => '26px',
		'line-height' => '36px',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'blockquote p'
		),

	)
));