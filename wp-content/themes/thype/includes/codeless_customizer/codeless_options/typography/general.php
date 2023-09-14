<?php

Kirki::add_section('cl_typography_general', array(
	'title' => esc_attr__('General', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_typography',
	'type' => '',
	'priority' => 9,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'body_typo',
	'label'       => esc_attr__( 'Body Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Sans',
		'letter-spacing' => '0',
		'font-weight' => '400',
		'text-transform' => 'none',
		'font-size' => '16px',
		'line-height' => '1.75',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'html, body, blockquote cite a, .cl-blog__title'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h1_typo',
	'label'       => esc_attr__( 'H1 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
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
			'element' => 'h1:not(.cl-custom-font), .h1'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h2_typo',
	'label'       => esc_attr__( 'H2 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'none',
		'font-size' => '42px',
		'line-height' => '1.2',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'h2:not(.cl-custom-font), .h2'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h3_typo',
	'label'       => esc_attr__( 'H3 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
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
			'element' => 'h3:not(.cl-custom-font), .h3'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h4_typo',
	'label'       => esc_attr__( 'H4 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'none',
		'font-size' => '20px',
		'line-height' => '1.2',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'h4:not(.cl-custom-font), .h4'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h5_typo',
	'label'       => esc_attr__( 'H5 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'none',
		'font-size' => '16px',
		'line-height' => '1.75',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'h5:not(.cl-custom-font), .h5, .wp-polls form > p'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'h6_typo',
	'label'       => esc_attr__( 'H6 Typography', 'thype' ),
	'tooltip'       => esc_attr__( 'For all screens', 'thype' ),
	'section'     => 'cl_typography_general',
	'into_group' => true,
	'show_subsets' => false,
	'default'     => array(
		'font-family'    => 'Noto Serif',
		'letter-spacing' => '0',
		'font-weight' => '700',
		'text-transform' => 'none',
		'font-size' => '12px',
		'line-height' => '1.75',
	),
	'priority'    => 10,
	'transport' => 'auto',
	'output'      => array(
		array(
			'element' => 'h6:not(.cl-custom-font), .h6, .cl-video-entry__content a, .widget_headlines .cl-entry__title'
		),

	)
));

Kirki::add_field( 'cl_thype', array(
	'type'        => 'typography',
	'settings'    => 'sidebar_widget_typo',
	'label'       => esc_attr__( 'Sidebar Widgets Title', 'thype' ),
	'section'     => 'cl_typography_general',
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
			'element' => codeless_dynamic_css_register_tags( 'sidebar_widgets_title_typography' )
		),

	)
));