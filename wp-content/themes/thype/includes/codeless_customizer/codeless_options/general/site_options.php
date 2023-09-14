<?php

/* General */
Kirki::add_section( 'cl_general_options', array(
    'title'          => esc_attr__( 'Site Options', 'thype' ),
    'description'    => esc_attr__( 'Some options about responsive, favicon and other theme features.', 'thype' ),
    'panel'          => 'cl_general',
    'type'           => '',
    'priority'       => 5,
    'capability'     => 'edit_theme_options'
) );


    Kirki::add_field( 'cl_thype', array(
        'settings' => 'maintenance_mode',
        'label'    => esc_attr__( 'Maintenance Mode', 'thype' ),
        'tooltip' => esc_attr__( 'Turn On and select a page that you want to show always someone try to access the website', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ));

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'maintenance_page',
        'section'  => 'cl_general_options',
        'description' => 'Select a page to show as a manteinence page',
        'type'     => 'select',
        'priority' => 10,
        'choices' => codeless_get_pages(),
        'required'    => array(
            array(
                'setting'  => 'maintenance_mode',
                'operator' => '==',
                'value'    => true
            ),
        ),
    ));

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'favicon',
        'label'    => esc_attr__( 'Favicon', 'thype' ),
        'tooltip' => esc_attr__( 'Upload favion for website', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'image',
        'default' => '',
    ) );

    




    Kirki::add_field( 'cl_thype', array(
        'settings' => 'nicescroll',
        'label'    => esc_attr__( 'Smooth scroll', 'thype' ),
        'tooltip' => esc_attr__('Active smoothscroll over pages to make scrolling more fluid to create better user experience', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'transport' => 'refresh',
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'page_comments',
        'label'    => esc_attr__( 'Page Comments', 'thype' ),
        'tooltip'    => esc_attr__( 'Enable this option to active comments in normal pages.', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'back_to_top',
        'label'    => esc_attr__( 'Back To Top', 'thype' ),
        'tooltip'    => esc_attr__( 'Enable this option to show the "Back to Top" button on site', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'choices'     => array(
            1  => esc_attr__( 'Show', 'thype' ),
            0 => esc_attr__( 'Hide', 'thype' ),
        ),
        'transport' => 'refresh'
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'jpeg_quality',
        'label'    => esc_attr__( 'JPEG Quality', 'thype' ),
        'section'  => 'cl_general_options',
        'type'     => 'slider',
        'priority' => 10,
        'default'  => 82,
        'choices'     => array(
            'min' => '0',
            'max' => '100',
            'step' => '1'
        ),
        'refresh' => 'postMessage',
        'tooltip' => esc_attr__( 'Increase or decrease the compression level for JPEG Images', 'thype' )

    ) );

    
    Kirki::add_field( 'cl_thype', array(
        'type'        => 'textarea',
        'settings'    => '404_error_message',
        'label'       => esc_attr__( '404 Error Message', 'thype' ),
        'section'     => 'cl_general_options',
        'default'     => esc_attr__('It looks like nothing was found at this location. Maybe try a search?', 'thype' ),
        'priority'    => 10,
        'transport' => 'postMessage'
    ) );
?>