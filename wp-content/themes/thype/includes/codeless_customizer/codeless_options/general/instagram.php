<?php

Kirki::add_section( 'cl_general_insta', array(
    'title'          => esc_attr__( 'Instagram', 'thype' ),
    'description'    => esc_attr__( 'Instagram', 'thype' ),
    'panel'          => 'cl_general',
    'priority'       => 5,
    'type'			 => '',
    'capability'     => 'edit_theme_options'
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'show_instagram_feed_token',
    'label'    => esc_attr__( 'Instagram Feed Token', 'thype' ),
    'section'  => 'cl_general_insta',
    'type'     => 'text',
    'priority' => 10,
    'default'  => '',
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),

) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'show_instagram_feed_userid',
    'label'    => esc_attr__( 'Instagram Feed User Id', 'thype' ),
    'section'  => 'cl_general_insta',
    'type'     => 'text',
    'priority' => 10,
    'default'  => '',
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
) );

?>