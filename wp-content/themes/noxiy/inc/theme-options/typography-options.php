<?php


CSF::createSection($noxiy_theme_option, array(
    'title'  => esc_html__('Typography', 'noxiy'),
    'icon'   => 'fas fa-font',
    'id'     => 'typography_settings',
    'fields' => array(


      array(
        'id'             => 'body_typography',
        'type'           => 'typography',
        'title'          => esc_html__('Body Typography', 'noxiy'),
        'output'         => 'body',
        'extra_styles'   => true,
        'text_align'     => false,
        'text_transform' => false,
        'default'        => array(
          'font-family'  => 'Kumbh Sans',
          'type'         => 'google',
          'font-weight'  => '400',
          'unit'         => 'px',
          'extra-styles' => array('500', '600','700','800'),
        ),
      ),

      array(
        'id'             => 'h1_typography',
        'type'           => 'typography',
        'title'          => esc_html__('H1 Typography', 'noxiy'),
        'output'         => 'h1',
        'extra_styles'   => true,
        'text_align'     => false,
        'text_transform' => false,
        'default'        => array(
          'font-family'  => 'Outfit',
          'type'         => 'google',
          'font-weight'  => '700',
          'unit'         => 'px',
        ),
      ),


        array(
          'id'             => 'h23456_typography',
          'type'           => 'typography',
          'title'          => esc_html__('h2-h6 Typography', 'noxiy'),
          'output'         => 'h2,h3,h4,h5,h6',
          'extra_styles'   => true,
          'text_align'     => false,
          'text_transform' => false,
          'default'        => array(
            'font-family'  => 'Outfit',
            'type'         => 'google',
            'font-weight'  => '600',
            'unit'         => 'px',
            'extra-styles' => array('400', '500', '600', '800'),
          ),
        ),


     
    )
  ));