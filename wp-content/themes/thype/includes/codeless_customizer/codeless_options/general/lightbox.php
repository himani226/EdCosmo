<?php

Kirki::add_section( 'cl_general_lightbox', array(
    'title'          => esc_attr__( 'Lightbox', 'thype' ),
    'description'    => esc_attr__( 'Lightbox Options', 'thype' ),
    'panel'          => 'cl_general',
    'priority'       => 160,
    'type'			 => '',
    'capability'     => 'edit_theme_options'
) );
    

    Kirki::add_field( 'cl_thype', array(
        'type'        => 'select',
        'settings'    => 'lightbox_skin',
        'label'       => esc_attr__( 'Lightbox Skin', 'thype' ),
        'section'     => 'cl_general_lightbox',
        'default'     => 'dark',
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => array(
            'dark' => 'Dark',
            'light' => 'Light',
            'parade' => 'Parade',
            'smooth' => 'Smooth',
            'metro-black' => 'Metro-Black',
            'metro-white' => 'Metro-White',
            'mac' => 'Mac'
        ),
    
    ));

    Kirki::add_field( 'cl_thype', array(
        'type'        => 'select',
        'settings'    => 'lightbox_path',
        'label'       => esc_attr__( 'Lightbox Path', 'thype' ),
        'section'     => 'cl_general_lightbox',
        'default'     => 'vertical',
        'priority'    => 5,
        'multiple'    => 1,
        'choices'     => array(
            'vertical' => 'Vertical',
            'horizontal' => 'Horizontal',
        ),
    
    ));
    
    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_mousewheel',
        'label'    => esc_attr__( 'Lightbox Mousewheel', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_toolbar',
        'label'    => esc_attr__( 'Lightbox Toolbar', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_arrows',
        'label'    => esc_attr__( 'Lightbox Arrows', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_slideshow',
        'label'    => esc_attr__( 'Lightbox Slideshow', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 0,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_fullscreen',
        'label'    => esc_attr__( 'Lightbox Fullscreen', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_thumbnail',
        'label'    => esc_attr__( 'Lightbox Thumbnail', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_swipe',
        'label'    => esc_attr__( 'Lightbox Swipe', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    Kirki::add_field( 'cl_thype', array(
        'settings' => 'lightbox_contextmenu',
        'label'    => esc_attr__( 'Lightbox Context Menu (Right click on image)', 'thype' ),
        'section'  => 'cl_general_lightbox',
        'type'     => 'switch',
        'priority' => 10,
        'default'  => 1,
        'choices'     => array(
            1  => esc_attr__( 'Enable', 'thype' ),
            0 => esc_attr__( 'Disable', 'thype' ),
        ),
    ) );

    ?>