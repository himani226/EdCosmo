<?php

  // 404 page options

  CSF::createSection($noxiy_theme_option, array(
    'title'  => esc_html__('404 Error Page', 'noxiy'),
    'icon'   => 'fas fa-exclamation-circle',
    'id'     => '404_error',
    'parent' => 'general_setting',
    'fields' => array(

      array(
        'id'    => 'error_page_main',
        'type'  => 'text',
        'title' => esc_html__('404 Main', 'noxiy'),
      ),


      array(
        'id'    => 'error_page_title',
        'type'  => 'text',
        'title' => esc_html__('404 Title', 'noxiy'),
      ),

      array(
        'id'    => 'error_page_content',
        'type'  => 'textarea',
        'title' => esc_html__('404 Content', 'noxiy'),
      ),

      array(
        'id'      => 'error_page_btn',
        'type'    => 'button_set',
        'title'   => esc_html__('Home Button', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'yes',
        'desc'    => esc_html__('Enable or Disable', 'noxiy'),
      ),

      array(
        'id'    => 'error_page_btn_text',
        'type'  => 'text',
        'title' => esc_html__('Button Text', 'noxiy'),
        'dependency'  => array('error_page_btn', '==', 'yes'),
      ),

    )
  ));