<?php

Kirki::add_section('cl_footer_main', array(
	'title' => esc_attr__('Main', 'thype') ,
	'tooltip' => esc_attr__('Main Footer Options', 'thype') ,
	'panel' => 'cl_footer',
	'type' => '',
	'priority' => 12,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'show_footer',
    'label'    => esc_attr__( 'Footer Active', 'thype' ),
    'tooltip' => esc_attr__( 'Switch On/Off Footer on website', 'thype' ),
    'section'  => 'cl_footer_main',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
    'transport' => 'postMessage',
    'partial_refresh' => array(
        'footer_show' => array(
            'selector'            => '#footer-wrapper',
            'container_inclusive' => true,
            'render_callback'     => 'codeless_show_footer'
        ),
    ),

) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'footer_layout',
    'label'    => esc_attr__( 'Footer Layout', 'thype' ),
    'tooltip' => esc_attr__( 'Use this option to change layout of footer. You can use the UI on the page too.', 'thype' ),
    'section'  => 'cl_footer_main',
    'type'     => 'select',
    'priority' => 10,
    'default'  => '14_14_14_14',
    'choices'     => array(
        '16_16_16_16_16_16'  => esc_attr__( '6 Columns', 'thype' ),
        '14_14_14_14'  => esc_attr__( '4 Columns', 'thype' ),
        '13_13_13'  => esc_attr__( '3 Columns', 'thype' ),
        '12_12'  => esc_attr__( '2 Columns', 'thype' ),
        '11'  => esc_attr__( '1 Column', 'thype' ),
        '14_34'  => esc_attr__( '1/4 3/4', 'thype' ),
        '712_512'  => esc_attr__( '7/12 5/12', 'thype' ),
        '13_14_16_14'  => esc_attr__( '1/3 1/4 1/6 1/4', 'thype' ),
        '34_14'  => esc_attr__( '3/4 1/4', 'thype' ),
        '13_23'  => esc_attr__( '1/3 2/3', 'thype' ),
        '23_13'  => esc_attr__( '2/3 1/3', 'thype' ),
    ),
    'transport' => 'postMessage',
    
    'partial_refresh' => array(
        'footer_layout' => array(
            'selector'            => 'footer#colophon .footer-content-row',
            'render_callback'     => 'codeless_build_footer_layout'
        ),
    ),
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'footer_fullwidth',
    'label'    => esc_attr__( 'Footer Fullwidth', 'thype' ),
    'tooltip' => esc_attr__( 'Switch On if you want footer content without container', 'thype' ),
    'section'  => 'cl_footer_main',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
    'transport' => 'postMessage',
));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'footer_inline_widgets',
    'label'    => esc_attr__( 'Footer Inline Widgets', 'thype' ),
    'tooltip' => esc_attr__( 'Switch to show widgets inline into one column', 'thype' ),
    'section'  => 'cl_footer_main',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
    'transport' => 'postMessage',

) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'footer_centered_content',
    'label'    => esc_attr__( 'Footer Centered Content', 'thype' ),
    'tooltip' => esc_attr__( 'Switch to center content of column', 'thype' ),
    'section'  => 'cl_footer_main',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
    'transport' => 'postMessage',
    'required'    => array(
        array(
            'setting'  => 'footer_layout',
            'operator' => '==',
            'value'    => '11',
            'transport' => 'postMessage'
        ),
                    
    ),

) );



Kirki::add_field( 'cl_thype', array(
    'type'        => 'slider',
    'settings'    => 'footer_widget_distance',
    'label'       => esc_attr__( 'Distance between widgets', 'thype' ),
    'section'     => 'cl_footer_main',
    'into_group' => true,
    'default'     => '30',
    'priority'    => 10,
    'choices'     => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    ),
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => 'footer#colophon .widget',
            'units'  => 'px',
            'property' => 'padding-top'
        ),
        array(
            'element' => 'footer#colophon .widget',
            'units'  => 'px',
            'property' => 'padding-bottom'
        ),

    )
));

Kirki::add_field('cl_thype', array(
    'settings' => 'footer_design',
    'label' => esc_attr__('Footer Box Design', 'thype') ,
    'section' => 'cl_footer_main',
    'type' => 'css_tool',
    'priority' => 100,
    'default' => array(
        'padding-top' => '60px',
        'padding-bottom' => '60px'
    ) ,
    'into_group' => true,
    'transport' => 'postMessage',
));