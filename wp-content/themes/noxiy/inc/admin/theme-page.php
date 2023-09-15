<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

/**
 * Theme Admin Pages
 */

if (!class_exists('Noxiy_Admin')) {

  class Noxiy_Admin
  {
    private static $instance = null;

    public static function init()
    {
      if (is_null(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function __construct()
    {
      add_action('admin_menu', array($this, 'noxiy_admin_page'), 1);
      add_action('admin_enqueue_scripts', array($this, 'noxiy_theme_page_assets'));

    }

    public function noxiy_admin_page()
    {

      add_menu_page(
        esc_html__('Noxiy', 'noxiy'),
        esc_html__('Noxiy', 'noxiy'),
        'manage_options',
        'noxiy',
        array(
          $this,
          'noxiy_theme_welcome'
        ),
        get_theme_file_uri('inc/admin/assets/img/icon.svg'),
        2
      );

      add_submenu_page(
        'noxiy',
        esc_html__('Welcome', 'noxiy'),
        esc_html__('Welcome', 'noxiy'),
        'manage_options',
        'noxiy',
        array($this, 'noxiy_theme_welcome'),
      );
      if (class_exists('CSF')) {
        add_submenu_page(
          'noxiy',
          'Template Builder',
          'Template Builder',
          'manage_options',
          'edit.php?post_type=noxiy_builder',
        );
      }

    }

    public function noxiy_theme_welcome()
    {
      get_template_part('inc/admin/' . 'welcome');
    }
    public function noxiy_theme_page_assets()
    {
      wp_enqueue_style('noxiy-admin', get_theme_file_uri('inc/admin/assets/css/admin.css'), array(), NOXIY_VERSION, 'all');
    }

  }

  Noxiy_Admin::init();
}