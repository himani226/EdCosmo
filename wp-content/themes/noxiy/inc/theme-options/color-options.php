<?php

CSF::createSection($noxiy_theme_option, array(
    'title'  => esc_html__('Theme Colors', 'noxiy'),
    'icon'   => 'fas fa-palette',
    'id'     => 'theme_color_settings',
    'fields' => array(
        array(
            'id'    => 'primary_color_1',
            'type'  => 'color',
            'title' => esc_html__('Primary Color 1', 'noxiy'),
            'output' => ':root',
            'output_mode' => '--primary-color-1',
            'default' => '#01BDB2'
        ),

        array(
            'id'    => 'primary_color_2',
            'type'  => 'color',
            'title' => esc_html__('Primary Color 2', 'noxiy'),
            'output' => ':root',
            'output_mode' => '--primary-color-2',
            'default' => '#2974FF'
        ),

        array(
            'id'    => 'primary_color_3',
            'type'  => 'color',
            'title' => esc_html__('Primary Color 3', 'noxiy'),
            'output' => ':root',
            'output_mode' => '--primary-color-3',
            'default' => '#0D9B4D'
        ),

        array(
            'id'    => 'primary_color_4',
            'type'  => 'color',
            'title' => esc_html__('Primary Color 4', 'noxiy'),
            'output' => ':root',
            'output_mode' => '--primary-color-4',
            'default' => '#ff0000'
        ),
    )
));
