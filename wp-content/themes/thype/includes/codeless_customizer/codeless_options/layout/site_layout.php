<?php

Kirki::add_section('cl_layout_site', array(
	'title' => esc_attr__('Site Layout', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_layout',
	'type' => '',
	'priority' => 7,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'responsive_layout',
    'label'    => esc_attr__( 'Responsive Layout', 'thype' ),
    'tooltip' => esc_attr__( 'Turn On / Off Responsive functionalities', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'transport' => 'refresh',
    'choices'     => array(
        1  => esc_attr__( 'Enable', 'thype' ),
        0 => esc_attr__( 'Disable', 'thype' ),
    ),
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'layout_container_width',
    'label'    => esc_attr__( 'Site Container Width', 'thype' ),
    'tooltip' => esc_attr__( 'Define site container width in pixel. A max-width:100% is set to not destroy the layout on smaller screens. It\'s applied on min-width media screens: 1200px', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '1140',
    'choices'     => array(
        'min'  => '970',
        'max'  => '1600',
        'step' => '10',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.container',
            'units' => 'px',
            'property' => 'width',
            'media_query' => '@media (min-width: 1200px)'
        ),
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'div_spaces',
    'label'    => '',
    'section'  => 'cl_layout_site',
    'type'     => 'groupdivider',
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'vc_row_padding_top',
    'label'    => esc_attr__( 'VC Row Top Space', 'thype' ),
    'tooltip' => esc_attr__( 'Define the space (padding-top) on visual composer Row element. You can overwrite this option anytime in each page.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '30',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.vc_row:not(.vc_inner):not([data-vc-full-width="true"])',
            'units' => 'px',
            'property' => 'padding-top'
        ),
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'vc_row_padding_bottom',
    'label'    => esc_attr__( 'VC Row Bottom Space', 'thype' ),
    'tooltip' => esc_attr__( 'Define the space (padding-top) on visual composer Row element. You can overwrite this option anytime in each page.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '30',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.vc_row:not(.vc_inner):not([data-vc-full-width="true"])',
            'units' => 'px',
            'property' => 'padding-bottom'
        ),
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'inner_content_padding_top',
    'label'    => esc_attr__( 'Inner Content Distance from Top', 'thype' ),
    'tooltip' => esc_attr__( 'Define the default distance of Inner Content ( Content / Sidebar ) from Header ( Header / Page Header / Other inserted elements ). Usable with: Pages without page builder, blog, defined page templates, posts.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '75',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.inner-content-row, .vc_row:first-child:not(.vc_inner)',
            'units' => 'px',
            'property' => 'padding-top'
        ),
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'inner_content_padding_bottom',
    'label'    => esc_attr__( 'Inner Content Distance from Bottom', 'thype' ),
    'tooltip' => esc_attr__( 'Define the default distance of Inner Content ( Content / Sidebar ) from Footer. Usable with: Pages without page builder, blog, defined page templates, posts.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '75',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.inner-content-row, .vc_row:last-child:not(.vc_inner)',
            'units' => 'px',
            'property' => 'padding-bottom'
        ),
    )
) );



Kirki::add_field( 'cl_thype', array(
    'settings' => 'elements_distance',
    'label'    => esc_attr__( 'Distance between elements', 'thype' ),
    'tooltip' => esc_attr__( 'Define default distance between elements that are into one column', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '30',
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.cl-element, .wpb_content_element, .vc_row.vc_inner',
            'units' => 'px',
            'property' => 'margin-bottom'
        ),
    )
) );



Kirki::add_field( 'cl_thype', array(
    'settings' => 'boxed_layout',
    'label'    => esc_attr__( 'Boxed Layout', 'thype' ),
    'tooltip' => esc_attr__( 'Switch on if you want to make all page boxed', 'thype' ),
    'section'  => 'cl_layout_site',
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
    'settings' => 'boxed_layout_width',
    'description'    => esc_attr__( 'Boxed Wrapper Width', 'thype' ),
    'tooltip' => esc_attr__( 'Define boxed wrapper width in pixel.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => '1200',
    'choices'     => array(
        'min'  => '970',
        'max'  => '1600',
        'step' => '10',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.cl-boxed-layout',
            'units' => 'px',
            'property' => 'width',
            'media_query' => '@media (min-width: 992px)'
        ),
    ),
    'required' => array(
        array(
			'setting' => 'boxed_layout',
			'operator' => '==',
			'value' => 1,
		) ,
    )
) );

Kirki::add_field( 'cl_thype', array(
    'type' => 'image',
    'settings' => 'boxed_bg_image',
    'description' => 'Boxed Outter Wrapper Image',
    'default' => '',
    'section'  => 'cl_layout_site',
    'transport' => 'refresh',
    'required' => array(
        array(
			'setting' => 'boxed_layout',
			'operator' => '==',
			'value' => 1,
		) ,
    )
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'boxed_bg_color',
    'description' => 'Boxed Outter Wrapper Color',
    'default' => '#ffffff',
    'section'  => 'cl_layout_site',
    'transport' => 'refresh',
    'required' => array(
        array(
			'setting' => 'boxed_layout',
			'operator' => '==',
			'value' => 1,
		) ,
    ),
    'output' => array(
        array(
            'element' => 'body.cl-layout-boxed',
            'property' => 'background-color'
        )
    ),
));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'div2_space',
    'label'    => '',
    'section'  => 'cl_layout_site',
    'type'     => 'groupdivider',
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'aside_widget_distance',
    'label'    => esc_attr__( 'Aside Widget Distance', 'thype' ),
    'tooltip' => esc_attr__( '', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => 22,
    'choices'     => array(
        'min'  => '0',
        'max'  => '200',
        'step' => '1',
    ),
    'inline_control' => true,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => 'aside .widget, .cl-sidenav .widget',
            'units' => 'px',
            'property' => 'padding-bottom'
        ),

        array(
            'element' => 'aside .widget, .cl-sidenav .widget',
            'units' => 'px',
            'property' => 'padding-top'
        ),
    )
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'aside_sticky',
    'label'    => esc_attr__( 'Aside Sticky Widgets from Bottom', 'thype' ),
    'tooltip' => esc_attr__( 'Number of widgets to make fixed (sticky). Count from bottom of the sidebar.', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'slider',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        'min'  => '0',
        'max'  => '5',
        'step' => '1',
    ),
    'transport' => 'refresh',
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'aside_title_style',
    'label'    => esc_attr__( 'Aside Title Style', 'thype' ),
    'tooltip' => esc_attr__( 'Select Title style for sidebar widget title', 'thype' ),
    'section'  => 'cl_layout_site',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'title',
    'choices'     => array(
        'text'  => 'Only Text',
        'with_bg'  => 'With Background & Title'
    ),
    'transport' => 'refresh',
) );

?>