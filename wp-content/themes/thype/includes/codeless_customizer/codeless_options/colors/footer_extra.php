<?php

Kirki::add_section('cl_colors_footer_extra', array(
	'title' => esc_attr__('Footer Extra Section Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'footer_extra_bg_color',
    'label' => 'Background Color',
    'default' => codeless_get_mod( 'footer_bg_color', '#ffffff' ),
    'inline_control' => true,
    'section'  => 'cl_colors_footer_extra',
    'output' => array(
        array(
            'element' => '.cl-footer-toparea',
            'property' => 'background-color'
        ),
        
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_extra_font_color',
    'label'       => esc_attr__( 'Text Color', 'thype' ),
    'section'     => 'cl_colors_footer_extra',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#ffffff',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer-toparea, .cl-footer-toparea h2, .cl-footer-toparea h3, .cl-footer-toparea h4',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_extra_link_color',
    'label'       => esc_attr__( 'Link Color', 'thype' ),
    'section'     => 'cl_colors_footer_extra',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#ffffff',
    'priority'    => 10,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer-toparea a',
            'property' => 'color',
            'suffix' => ' !important'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'footer_extra_forms_color',
    'label' => 'Input/Select/Textarea BG Color',
    'default' => '#fbfbfb',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_footer_extra',
    'output' => array(
        array(
            'element' => '.cl-footer-toparea input:not([type="submit"]), .cl-footer-toparea select, .cl-footer-toparea textarea',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));