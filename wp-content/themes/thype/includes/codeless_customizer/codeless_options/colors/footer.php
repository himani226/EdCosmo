<?php

Kirki::add_section('cl_colors_footer', array(
	'title' => esc_attr__('Footer Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'footer_bg_color',
    'label' => 'Background Color',
    'default' => '#ffffff',
    'inline_control' => true,
    'priority' => 2,
    'section'  => 'cl_colors_footer',
    'output' => array(
        array(
            'element' => '.cl-footer__main',
            'property' => 'background-color'
        ),
        
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_title_widget',
    'label'       => esc_attr__( 'Widget Title Color', 'thype' ),
    'section'     => 'cl_colors_footer',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#191e23',
    'priority' => 2,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer__main .widget-title, .cl-footer__mainn .rsswidget',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_font_color',
    'label'       => esc_attr__( 'Text Color', 'thype' ),
    'section'     => 'cl_colors_footer',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#363b43',
    'priority' => 2,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer__main',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_link_color',
    'label'       => esc_attr__( 'Links Color', 'thype' ),
    'section'     => 'cl_colors_footer',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#363b43',
    'priority' => 2,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer__main a, .cl-footer__main .widget_rss cite, .cl-footer__main .widget_calendar thead th',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_link_hover_color',
    'label'       => esc_attr__( 'Links Hover Color', 'thype' ),
    'section'     => 'cl_colors_footer',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#e94828',
    'priority' => 2,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer__main a:hover',
            'property' => 'color'
        ),

    )
));

Kirki::add_field( 'cl_thype', array(
    'type'        => 'color',
    'settings'    => 'footer_border_color',
    'label'       => esc_attr__( 'Inner Borders Color', 'thype' ),
    'section'     => 'cl_colors_footer',
    'into_group' => true,
    'inline_control' => true,
    'default'     => '#edeeef',
    'priority' => 2,
    'transport' => 'auto',
    'output'      => array(
        array(
            'element' => '.cl-footer__main .widget_headlines article, .cl-footer__main, .cl-footer__main select, .cl-footer__main input:not([type="submit"]), .cl-footer__main textarea',
            'property' => 'border-color'
        ),

    )
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'footer_forms_start',
    'label'    => '',
    'section'  => 'cl_colors_footer',
    'type'     => 'groupdivider',

));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'footer_forms_bg_color',
    'label' => 'Input/Select/Textarea BG Color',
    'default' => '#fbfbfb',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_footer',
    'output' => array(
        array(
            'element' => '.cl-footer__main input:not([type="submit"]), .cl-footer__main select, .cl-footer__main textarea',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'footer_forms_placeholder_color', 
    'label' => 'Input/Select/Textarea Placeholder',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_footer',
    'output' => array(
        array(
            'element' => '.cl-footer__main input:not([type="submit"])::-webkit-input-placeholder, .cl-footer__main select::-webkit-input-placeholder, .cl-footer__main textarea::-webkit-input-placeholder, .cl-footer__main input:not([type="submit"]):-moz-placeholder, .cl-footer__main select:-moz-placeholder, .cl-footer__main textarea:-moz-placeholder, .cl-footer__main input:not([type="submit"])::-moz-placeholder, .cl-footer__main select::-moz-placeholder, .cl-footer__main textarea::-moz-placeholder, .cl-footer__main input:not([type="submit"]):-ms-input-placeholder, .cl-footer__main select:-ms-input-placeholder, .cl-footer__main textarea:-ms-input-placeholder, .cl-footer__main select',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));