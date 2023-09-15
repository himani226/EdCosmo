<?php

CSF::createSection($noxiy_theme_option, array(
  'title'  => esc_html__('Site Layout', 'noxiy'),
  'icon'   => 'fas fa-th-large',
  'id'     => 'layout_options',
  'parent' => 'general_setting',
  'fields' => array(

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Page Layout', 'noxiy'),
    ),

    array(
      'id'       => 'page_layout',
      'type'     => 'palette',
      'title'    => esc_html__('Layout', 'noxiy'),
      'options'  => array(
        'left-sidebar'   => array('#cccccc', '#eeeeee', '#eeeeee'),
        'full-width'     => array('#dddddd', '#dddddd', '#dddddd'),
        'right-sidebar'  => array('#eeeeee', '#eeeeee', '#cccccc'),
      ),
      'default'    => 'full-width',
    ),

    array(
      'id'          => 'page_sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Select Sidebar', 'noxiy'),
      'placeholder' => esc_html__('Select a Sidebar', 'noxiy'),
      'options'     => 'sidebars',
      'dependency' => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
    ),

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Blog/Archive Layout', 'noxiy'),
    ),

    array(
      'id'       => 'blog_layout',
      'type'     => 'palette',
      'title'    => esc_html__('Layout', 'noxiy'),
      'options'  => array(
        'left-sidebar'   => array('#cccccc', '#eeeeee', '#eeeeee'),
        'full-width'     => array('#dddddd', '#dddddd', '#dddddd'),
        'right-sidebar'  => array('#eeeeee', '#eeeeee', '#cccccc'),
      ),
      'default'    => 'right-sidebar',
    ),

    array(
      'id'          => 'blog_sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Select Sidebar', 'noxiy'),
      'placeholder' => esc_html__('Select a Sidebar', 'noxiy'),
      'options'     => 'sidebars',
      'dependency' => array('blog_layout', 'any', 'left-sidebar,right-sidebar'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Single Post Layout', 'noxiy'),
    ),
    array(
      'id'       => 'single_layout',
      'type'     => 'palette',
      'title'    => esc_html__('Layout', 'noxiy'),
      'options'  => array(
        'left-sidebar'   => array('#cccccc', '#eeeeee', '#eeeeee'),
        'full-width'     => array('#dddddd', '#dddddd', '#dddddd'),
        'right-sidebar'  => array('#eeeeee', '#eeeeee', '#cccccc'),
      ),
      'default'    => 'right-sidebar',
    ),
    array(
      'id'          => 'single_sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Select Sidebar', 'noxiy'),
      'placeholder' => esc_html__('Select a Sidebar', 'noxiy'),
      'options'     => 'sidebars',
      'dependency' => array('single_layout', 'any', 'left-sidebar,right-sidebar'),
    ),
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Service Layout', 'noxiy'),
    ),
    array(
      'id'       => 'service_layout',
      'type'     => 'palette',
      'title'    => esc_html__('Layout', 'noxiy'),
      'options'  => array(
        'left-sidebar'   => array('#cccccc', '#eeeeee', '#eeeeee'),
        'full-width'     => array('#dddddd', '#dddddd', '#dddddd'),
        'right-sidebar'  => array('#eeeeee', '#eeeeee', '#cccccc'),
      ),
      'default'    => 'left-sidebar',
    ),

    array(
      'id'          => 'service_sidebar',
      'type'        => 'select',
      'title'       => esc_html__('Select Sidebar', 'noxiy'),
      'placeholder' => esc_html__('Select a Sidebar', 'noxiy'),
      'options'     => 'sidebars',
      'dependency' => array('service_layout', 'any', 'left-sidebar,right-sidebar'),
    ),

  )
));
