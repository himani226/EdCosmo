<?php

Kirki::add_section( 'cl_general_socials', array(
    'title'          => esc_attr__( 'Social Networks Links', 'thype' ),
    'description'    => esc_attr__( 'Set links of wesite social networks', 'thype' ),
    'panel'          => 'cl_general',
    'priority'       => 5,
    'type'			 => '',
    'capability'     => 'edit_theme_options'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'facebook_link',
    'label'       => esc_attr__( 'Facebook', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'twitter_link',
    'label'       => esc_attr__( 'Twitter', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'google_link',
    'label'       => esc_attr__( 'Google', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'dribbble_link',
    'label'       => esc_attr__( 'Dribbble', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'foursquare_link',
    'label'       => esc_attr__( 'Foursquare', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'pinterest_link',
    'label'       => esc_attr__( 'Pinterest', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'youtube_link',
    'label'       => esc_attr__( 'Youtube', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'linkedin_link',
    'label'       => esc_attr__( 'Linkedin', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'email_link',
    'label'       => esc_attr__( 'Email', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'instagram_link',
    'label'       => esc_attr__( 'Instagram', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );
Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'github_link',
    'label'       => esc_attr__( 'Github', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'skype_link',
    'label'       => esc_attr__( 'Skype', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );
Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'soundcloud_link',
    'label'       => esc_attr__( 'Soundcloud', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'slack_link',
    'label'       => esc_attr__( 'Slack', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'text',
    'settings'    => 'behance_link',
    'label'       => esc_attr__( 'Behance', 'thype' ),
    'section'     => 'cl_general_socials',
    'priority'    => 10,
    'transport' => 'postMessage'
) );