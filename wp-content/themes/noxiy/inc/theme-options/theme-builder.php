<?php

CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('Theme Builder', 'noxiy'),
  'icon'   => 'fas fa-heading',
  'id'     => 'theme_builder',
  'fields' => array()
));


CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('Header', 'noxiy'),
  'icon'   => 'fas fa-eye',
  'id'     => 'general_header',
  'parent' => 'theme_builder',
  'fields' => array(

    array(
      'id'      => 'custom_header',
      'type'    => 'button_set',
      'title'   => esc_html__('Overwrite Theme Header', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'no',
      'desc'    => esc_html__('Enable or Disable', 'noxiy'),
    ),

     // Theme Builder Options
     array(
      'id'             => 'noxiy_builder_header',
      'type'           => 'select',
      'title'          => esc_html__('Select a Template', 'noxiy'),
      'options'        => 'posts',
      'query_args'     => array(
        'post_type'      => 'noxiy_builder',
        'posts_per_page' => -1,
      ),
      'dependency' => array('custom_header', '==', 'yes'),
    ),


  )
));

CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('Footer', 'noxiy'),
  'icon'   => 'fas fa-eye',
  'id'     => 'general_footer',
  'parent' => 'theme_builder',
  'fields' => array(

    array(
      'id'      => 'custom_footer',
      'type'    => 'button_set',
      'title'   => esc_html__('Overwrite Theme Footer', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'no',
      'desc'    => esc_html__('Enable or Disable', 'noxiy'),
    ),

     // Theme Builder Options
     array(
      'id'             => 'noxiy_builder_footer',
      'type'           => 'select',
      'title'          => esc_html__('Select a Template', 'noxiy'),
      'options'        => 'posts',
      'query_args'     => array(
        'post_type'      => 'noxiy_builder',
        'posts_per_page' => -1,
      ),
      'dependency' => array('custom_footer', '==', 'yes'),
    ),


  )
));



CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('Breadcrumb', 'noxiy'),
  'icon'   => 'fas fa-eye',
  'id'     => 'general_breadcrumb',
  'parent' => 'theme_builder',
  'fields' => array(

    array(
      'id'      => 'custom_breadcrumb',
      'type'    => 'button_set',
      'title'   => esc_html__('Overwrite Theme Breadcrumb', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'no',
      'desc'    => esc_html__('Enable or Disable', 'noxiy'),
    ),

     // Theme Builder Options
     array(
      'id'             => 'noxiy_builder_breadcrumb',
      'type'           => 'select',
      'title'          => esc_html__('Select a Template', 'noxiy'),
      'options'        => 'posts',
      'query_args'     => array(
        'post_type'      => 'noxiy_builder',
        'posts_per_page' => -1,
      ),
      'dependency' => array('custom_breadcrumb', '==', 'yes'),
    ),


  )
));




CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('404 Page', 'noxiy'),
  'icon'   => 'fas fa-eye',
  'id'     => 'general_404',
  'parent' => 'theme_builder',
  'fields' => array(

    array(
      'id'      => 'custom_404',
      'type'    => 'button_set',
      'title'   => esc_html__('Overwrite Theme 404 Page', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'no',
      'desc'    => esc_html__('Enable or Disable', 'noxiy'),
    ),

     // Theme Builder Options
     array(
      'id'             => 'noxiy_builder_404',
      'type'           => 'select',
      'title'          => esc_html__('Select a Template', 'noxiy'),
      'options'        => 'posts',
      'query_args'     => array(
        'post_type'      => 'noxiy_builder',
        'posts_per_page' => -1,
      ),
      'dependency' => array('custom_404', '==', 'yes'),
    ),


  )
));
