<?php
if (!defined('ABSPATH')) exit;
if (class_exists('CSF')) {
  // Set a unique slug-like ID
  $noxiy_metabox = 'noxiy_meta_options';

  CSF::createMetabox($noxiy_metabox, array(
    'title'     => esc_html__('Settings', 'noxiy'),
    'post_type' => array('page', 'post', 'service', 'portfolio'),
  ));

  CSF::createSection($noxiy_metabox, array(
    'title'  => esc_html__('Global Options', 'noxiy'),
    'icon'   => 'fas fa-border-all',
    'fields' => array(

      array(
        'id'      => 'dark_mode',
        'type'    => 'button_set',
        'title'   => esc_html__('Dark Mode', 'noxiy'),
        'options' => array(
          'dark-mode'   => esc_html__('Yes', 'noxiy'),
          'light-mode'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'light-mode',
      ),

      array(
        'id'      => 'section_padding',
        'type'    => 'button_set',
        'title'   => esc_html__('Content Padding', 'noxiy'),
        'options' => array(
          'section-padding'     => esc_html__('Yes', 'noxiy'),
          'section-nopading'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'section-padding',
      ),

      array(
        'id'      => 'layout_enable',
        'type'    => 'button_set',
        'title'   => esc_html__('Custom Layout', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'no',
      ),

      array(
        'id'       => 'site_layout',
        'type'     => 'palette',
        'title'    => esc_html__('Select Layout', 'noxiy'),
        'options'  => array(
          'left-sidebar'   => array('#cccccc', '#eeeeee', '#eeeeee'),
          'full-width'     => array('#dddddd', '#dddddd', '#dddddd'),
          'right-sidebar'  => array('#eeeeee', '#eeeeee', '#cccccc'),
        ),
        'default'    => 'full-width',
        'dependency' => array('layout_enable', '==', 'yes'),
      ),

      array(
        'id'          => 'site_sidebars',
        'type'        => 'select',
        'title'       => esc_html__('Sidebars', 'noxiy'),
        'placeholder' => esc_html__('Select a Sidebar', 'noxiy'),
        'options'     => 'sidebars',
        'dependency' => array(
          array('site_layout', 'any', 'left-sidebar,right-sidebar'),
          array('layout_enable',   '==', 'yes'),
        ),
      ),

    )
  ));

  CSF::createSection($noxiy_metabox, array(
    'title'     => esc_html__('Header Options', 'noxiy'),
    'icon'      => 'fas fa-heading',
    'fields'    => array(

      array(
        'id'      => 'meta_header_layout',
        'type'    => 'button_set',
        'title'   => esc_html__('Custom Header', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'no',
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
      'dependency'  => array(
        array('meta_header_layout', '==', 'yes'),
      ),
    ),

    )
  ));

  CSF::createSection($noxiy_metabox, array(
    'title'     => esc_html__('Breadcrumb Settings', 'noxiy'),
    'icon'      => 'fas fa-pager',
    'fields'    => array(

      array(
        'id'      => 'breadcrumb_enable',
        'type'    => 'button_set',
        'title'   => esc_html__('Enable Banner', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'yes',
      ),

      array(
        'id'      => 'custom_title',
        'type'    => 'button_set',
        'title'   => esc_html__('Custom Title', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'no',
        'dependency'  => array('breadcrumb_enable', '==', 'yes'),
      ),
      array(
        'id'          => 'page_title',
        'type'        => 'text',
        'title'       => esc_html__('Banner Title', 'noxiy'),
        'default'     => esc_html__('Custom Title', 'noxiy'),
        'dependency'  => array(
          array('breadcrumb_enable', '==', 'yes'),
          array('custom_title', '==', 'yes'),
        ),
      ),

      array(
        'id'                    => 'breadcrumb_banner',
        'type'                  => 'background',
        'title'                 => esc_html__('Custom Background', 'noxiy'),
        'output'                => '.page__banner',
        'background_gradient'   => false,
        'background_origin'     => false,
        'background_clip'       => false,
        'background_blend_mode' => false,
        'background-color'      => false,
        'dependency'  => array('breadcrumb_enable', '==', 'yes'),
      ),

    )
  ));

  CSF::createSection($noxiy_metabox, array(
    'title'  => esc_html__('Footer Options', 'noxiy'),
    'icon'   => 'fas fa-stream',
    'fields' => array(

      array(
        'id'      => 'meta_footer_layout',
        'type'    => 'button_set',
        'title'   => esc_html__('Custom Footer', 'noxiy'),
        'options' => array(
          'yes'   => esc_html__('Yes', 'noxiy'),
          'no'    => esc_html__('No', 'noxiy'),
        ),
        'default' => 'no',
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
      'dependency'  => array(
        array('meta_footer_layout', '==', 'yes'),
      ),
    ),


    )
  ));
}
