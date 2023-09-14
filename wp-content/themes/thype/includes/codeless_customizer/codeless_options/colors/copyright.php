<?php

Kirki::add_section('cl_colors_copyright', array(
	'title' => esc_attr__('Copyright Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'copyright_bg_color',
    'label' => 'Background Color',
    'default' => '#ffffff',
    'inline_control' => true,
    'section'  => 'cl_colors_copyright',
    'output' => array(
        array(
            'element' => '#copyright',
            'property' => 'background-color'
        ),
        
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'copyright_font_color',
    'label'       => esc_attr__( 'Text Color', 'thype' ),
    'section'     => 'cl_colors_copyright',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#363b43',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '#copyright',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color',
    'label'       => esc_attr__( 'Link Color', 'thype' ),
    'section'     => 'cl_colors_copyright',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#363b43',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '#copyright a',
            'property' => 'color',
            'suffix' => ' !important'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'copyright_link_color_hover',
    'label'       => esc_attr__( 'Link Hover Color', 'thype' ),
    'section'     => 'cl_colors_copyright',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#e94828',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '#copyright a:hover',
            'property' => 'color',
            'suffix' => ' !important'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'copyright_border_color',
    'label'       => esc_attr__( 'Borders Color', 'thype' ),
    'section'     => 'cl_colors_copyright',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#edeeef',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '#copyright .cl-footer__content',
            'property' => 'border-color'
        ),

    )
));