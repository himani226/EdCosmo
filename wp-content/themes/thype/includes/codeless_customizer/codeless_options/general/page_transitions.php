<?php

/* Page Transitions */
Kirki::add_section( 'cl_general_transitions', array(
    'title'          => esc_attr__( 'Page Transitions', 'thype' ),
    'description'    => esc_attr__( 'Options to enable page transitions with various effects', 'thype' ),
    'panel'          => 'cl_general',
    'priority'       => 5,
    'type'			 => '',
    'capability'     => 'edit_theme_options'
) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'codeless_page_transition',
        'label'    => esc_attr__( 'On/Off Page Transitions', 'thype' ),
        'section'  => 'cl_general_transitions',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'type'        => 'select',
        'settings'    => 'page_transition_in',
        'description'       => esc_attr__( 'Page Transition In Effect', 'thype' ),
        'section'     => 'cl_general_transitions',
        'default'     => 'fade-in',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'fade-in' => 'fade-in',
            'fade-in-up-sm' => 'fade-in-up-sm',
            'fade-in-up' => 'fade-in-up',
            'fade-in-up-lg' => 'fade-in-up-lg',
            'fade-in-down-sm' => 'fade-in-down-sm',
            'fade-in-down-lg' => 'fade-in-down-lg',
            'fade-in-down' => 'fade-in-down',
            'fade-in-left-sm' => 'fade-in-left-sm',
            'fade-in-left' => 'fade-in-left',
            'fade-in-left-lg' => 'fade-in-left-lg',
            'fade-in-right-sm' => 'fade-in-right-sm',
            'fade-in-right' => 'fade-in-right',
            'fade-in-right-lg' => 'fade-in-right-lg',
        ),
        
        'required'    => array(
            array(
                'setting'  => 'codeless_page_transition',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );


    Kirki::add_field( 'cl_thype', array(
        'settings' => 'page_transition_in_duration',
        'description'    => esc_attr__( 'Page Transition In Duration', 'thype' ),
        'section'  => 'cl_general_transitions',
        'type'     => 'slider',
        'priority' => 10,
        'default'  => 1000,
        'choices'     => array(
            'min' => '0',
            'max' => '10000',
            'step' => '50'
        ),
        
        'required'    => array(
            array(
                'setting'  => 'codeless_page_transition',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );


    Kirki::add_field( 'cl_thype', array(
        'type'        => 'select',
        'settings'    => 'page_transition_out',
        'description'       => esc_attr__( 'Page Transition Out Effect', 'thype' ),
        'section'     => 'cl_general_transitions',
        'default'     => 'fade-out',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'fade-out' => 'fade-out',
            'fade-out-up-sm' => 'fade-out-up-sm',
            'fade-out-up' => 'fade-out-up',
            'fade-outout-up-lg' => 'fade-out-up-lg',
            'fade-out-down-sm' => 'fade-out-down-sm',
            'fade-out-down-lg' => 'fade-out-down-lg',
            'fade-out-down' => 'fade-out-down',
            'fade-out-left-sm' => 'fade-out-left-sm',
            'fade-out-left' => 'fade-out-left',
            'fade-out-left-lg' => 'fade-out-left-lg',
            'fade-out-right-sm' => 'fade-out-right-sm',
            'fade-out-right' => 'fade-out-right',
            'fade-out-right-lg' => 'fade-out-right-lg',
        ),
        
        'required'    => array(
            array(
                'setting'  => 'codeless_page_transition',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ));

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'page_transition_out_duration',
        'description'    => esc_attr__( 'Page Transition Out Duration', 'thype' ),
        'section'  => 'cl_general_transitions',
        'type'     => 'slider',
        'priority' => 10,
        'default'  => 1000,
        'choices'     => array(
            'min' => '0',
            'max' => '10000',
            'step' => '50'
        ),
        
        'required'    => array(
            array(
                'setting'  => 'codeless_page_transition',
                'operator' => '==',
                'value'    => 1,
            ),
        ),
    ) );

    ?>