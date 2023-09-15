<?php

CSF::createSection($noxiy_theme_option, array(
        'title'   => esc_html__('Global Settings', 'noxiy'),
        'icon'    => 'far fa-circle',
        'id'      => 'global_settings',
        'fields'  => array(
            array(
                'id'      => 'dark_mode',
                'type'    => 'button_set',
                'title'   => esc_html__('Dark Mode', 'noxiy'),
                'options' => array(
                    'dark-mode'  => esc_html__('Yes', 'noxiy'),
                    'light-mode' => esc_html__('No', 'noxiy'),
                ),
                'default' => 'light-mode',
                'desc'    => esc_html__('Enable or Disable', 'noxiy'),
            ),
  
            array(
                'id'      => 'preloader',
                'type'    => 'button_set',
                'title'   => esc_html__('Preloader', 'noxiy'),
                'options' => array(
                    'yes' => esc_html__('Yes', 'noxiy'),
                    'no'  => esc_html__('No', 'noxiy'),
                ),
                'default' => 'no',
                'desc'    => esc_html__('Enable or Disable', 'noxiy'),
            ),
            array(
                'id'           => 'preloader_bg',
                'type'         => 'color',
                'title'        => esc_html__('Preloader Background', 'noxiy'),
                'desc'         => esc_html__('Select a Background', 'noxiy'),
                'output'       => '.theme-loader',
                'output_mode'  => 'background-color',
                'dependency'   => array('preloader', '==', 'yes'),
            ),
            array(
                'id'      => 'theme_scroll_up',
                'type'    => 'button_set',
                'title'   => esc_html__('Scroll Up', 'noxiy'),
                'options' => array(
                    'yes' => esc_html__('Yes', 'noxiy'),
                    'no'  => esc_html__('No', 'noxiy'),
                ),
                'default' => 'no',
                'desc'    => esc_html__('Enable or Disable', 'noxiy'),
            ),
        ),
    )
);  
