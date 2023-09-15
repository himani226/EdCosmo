<?php

// 404 page options

CSF::createSection($noxiy_theme_option, array(
  'title' => esc_html__('Default Blog', 'noxiy'),
  'icon' => 'fas fa-exclamation-circle',
  'id' => 'default_blog',
  'parent' => 'general_setting',
  'fields' => array(


    array(
      'type' => 'subheading',
      'content' => esc_html__('Blog/Archive', 'noxiy'),
    ),

    array(
      'id' => 'blog_list_date',
      'type' => 'button_set',
      'title' => esc_html__('Show Date', 'noxiy'),
      'options' => array(
        'yes' => esc_html__('Yes', 'noxiy'),
        'no' => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),

    array(
      'id' => 'blog_list_author',
      'type' => 'button_set',
      'title' => esc_html__('Show Author', 'noxiy'),
      'options' => array(
        'yes' => esc_html__('Yes', 'noxiy'),
        'no' => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),

    array(
      'id' => 'blog_list_comment',
      'type' => 'button_set',
      'title' => esc_html__('Show Comment', 'noxiy'),
      'options' => array(
        'yes' => esc_html__('Yes', 'noxiy'),
        'no' => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),

    array(
      'id' => 'blog-cta-btn',
      'type' => 'text',
      'title' => esc_html__('Button Text', 'noxiy'),
    ),

    array(
      'type'    => 'subheading',
      'content' => esc_html__('Single Blog', 'noxiy'),
    ),


    array(
      'id'      => 'blog_single_date',
      'type'    => 'button_set',
      'title'   => esc_html__('Show Date', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),

    array(
      'id'      => 'blog_single_author',
      'type'    => 'button_set',
      'title'   => esc_html__('Show Author', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),

    array(
      'id'      => 'blog_single_comment',
      'type'    => 'button_set',
      'title'   => esc_html__('Show Comment', 'noxiy'),
      'options' => array(
        'yes'   => esc_html__('Yes', 'noxiy'),
        'no'    => esc_html__('No', 'noxiy'),
      ),
      'default' => 'yes',
    ),



  )
)
);