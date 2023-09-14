<?php

Kirki::add_section('cl_colors_content', array(
	'title' => esc_attr__('Content Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'btn_primary_color_border',
    'label'    => '',
    'section'  => 'cl_colors_content',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'background_color',
    'label' => 'Background Color',
    'default' => '#ffffff',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => 'body:not(.cl-layout-boxed), body.cl-layout-boxed #wrapper.cl-boxed-layout',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'alt_background_color',
    'label' => 'Alternate Background Color',
    'default' => '#fbfbfb',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'alt_background_color' ),
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'alt_background_dark_color',
    'label' => 'Alternate Dark Background Color',
    'default' => '#191e23',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'alt_background_dark_color', 'background_color' ),
            'property' => 'background-color'
        ),
        array(
            'element' => codeless_dynamic_css_register_tags( 'alt_background_dark_color', 'border_color' ),
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'border_color',
    'label' => 'Border Color',
    'default' => '#eaeaea',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'border_color' ),
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'primary_color',
    'label' => 'Primary Color',
    'default' => '#e94828',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'primary_color', 'color' ),
            'property' => 'color'
        ),
        array(
            'element' => codeless_dynamic_css_register_tags( 'primary_color', 'background_color' ),
            'property' => 'background-color' 
        ),
        array(
            'element' => codeless_dynamic_css_register_tags( 'primary_color', 'border-color' ),
            'property' => 'border-color' 
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'text_color',
    'label' => 'Text Color',
    'default' => '#363b43',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'text_color' ),
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'headings_color',
    'label' => 'Heading Color',
    'default' => '#191e23',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'heading_color' ),
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'labels_color',
    'label' => 'Labels Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'labels_color', 'color' ),
            'property' => 'color'
        ),

        array(
            'element' => codeless_dynamic_css_register_tags( 'labels_color', 'background_color' ),
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'dark_labels_color',
    'label' => 'Dark Labels Color',
    'default' => '#323639',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'dark_labels_color', 'color' ),
            'property' => 'color'
        ),

        array(
            'element' => codeless_dynamic_css_register_tags( 'dark_labels_color', 'background_color' ),
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'link_color',
    'label' => 'Link Color',
    'default' => '#191e23',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'link_color' ),
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'link_color_hover',
    'label' => 'Link Color Hover',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => codeless_dynamic_css_register_tags( 'link_color_hover' ),
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'btn_color_start',
    'label'    => '',
    'section'  => 'cl_colors_content',
    'type'     => 'groupdivider',

));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_font_color',
    'label' => 'Button Font Color',
    'default' => '#fff',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_font_color_hover',
    'label' => 'Button Font Color Hover',
    'default' => '#fff',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal:hover',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_bg_color',
    'label' => 'Button BG Color',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_bg_color_hover',
    'label' => 'Button BG Color Hover',
    'default' => '#c23013',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal:hover',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_border_color',
    'label' => 'Button Border Color',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_border_color_hover',
    'label' => 'Button Border Color Hover',
    'default' => '#c23013',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-normal:hover',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'btn_alt_start',
    'label'    => '',
    'section'  => 'cl_colors_content',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_font_color',
    'label' => 'Button Alt Font Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_font_color_hover',
    'label' => 'Button Alt Font Color Hover',
    'default' => '#fff',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt:hover',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_bg_color',
    'label' => 'Button Alt BG Color',
    'default' => '#fff',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_bg_color_hover',
    'label' => 'Button Alt BG Color Hover',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt:hover',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_border_color',
    'label' => 'Button Alt Border Color',
    'default' => '#e7e9eb',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'button_alt_border_color_hover',
    'label' => 'Button Alt Border Color Hover',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-btn--color-alt:hover',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'elements_start',
    'label'    => '',
    'section'  => 'cl_colors_content',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'video_post_gallery_color_1',
    'label' => 'Video Post Gallery Color1',
    'default' => '#191e23',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-video-gallery .cl-scrollable__slider, .cl-video-gallery, .cl-video-gallery__featured article.cl-prepare-video .cl-entry__overlay',
            'property' => 'background-color',
            'suffix'  => '!important'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'video_post_gallery_color_2',
    'label' => 'Video Post Gallery Color2',
    'default' => '#3e4751',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-video-gallery .cl-scrollable__pane, .cl-video-gallery .cl-video-entry__wrapper:hover',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'video_post_gallery_color_3',
    'label' => 'Video Post Gallery Color3',
    'default' => '#586777',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => '.cl-video-gallery .cl-video-entry.cl-video-playing .cl-video-entry__wrapper',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'forms_start',
    'label'    => '',
    'section'  => 'cl_colors_content',
    'type'     => 'groupdivider',

));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'forms_bg_color',
    'label' => 'Input/Select/Textarea BG Color',
    'default' => '#fbfbfb',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    'output' => array(
        array(
            'element' => 'input:not([type="submit"]), select, textarea',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'forms_placeholder_color', 
    'label' => 'Input/Select/Textarea Placeholder',
    'default' => '#a7acb6',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_content',
    
    'transport' => 'refresh'
));