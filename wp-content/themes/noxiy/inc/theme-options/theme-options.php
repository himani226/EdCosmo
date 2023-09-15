<?php
if (!defined('ABSPATH')) {
  exit;
}

if (class_exists('CSF')) {
  /*
 *  Set a unique slug-like ID
 */
  $noxiy_theme_option = 'noxiy_theme_options';

  CSF::createOptions($noxiy_theme_option, array(
    'menu_title'      => esc_html__('Theme Options', 'noxiy'),
    'framework_title' => wp_kses(
      sprintf(__("Theme Options <small>By ThemeOri</small>", 'noxiy')),
      array('small'   => array())
    ),
    'menu_slug'       => 'noxiy-options',
    'show_search'     => false,
    'menu_type'       => 'submenu',
    'menu_parent'     => 'noxiy',
    'menu_position'   => 2,    
    'footer_credit'   => wp_kses(
      __('Developed by: <a target="_blank" href="https://themeforest.net/user/themeori/portfolio">ThemeOri</a>', 'noxiy'),
      array(
        'a'           => array(
          'href'      => array(),
          'target'    => array()
        ),
      )
    ),
    'footer_text'     => esc_html__('ThemeOri Core Framework', 'noxiy'),
    'defaults'        => noxiy_default_options(),
  ));

  /*
 * Global Options
 */
  require_once 'global-options.php';

  /*
 * Typography Options
 */
  require_once 'typography-options.php';


  /*
 * Theme Color Options
 */
  require_once 'color-options.php';

  /*
 * General Setting
 */
  require_once 'customization.php';
    /*
 * Default Blog
 */
  require_once 'default-blog.php';

  /*
 * Site Layout
 */
require_once 'site-layout.php';

  /*
 * 404 Page Options
 */
require_once 'error-page-options.php';


  /*
 * Theme Builder
 */
require_once 'theme-builder.php';


  /*
 * Backup Options
 */

  CSF::createSection($noxiy_theme_option, array(
    'title'  => esc_html__('Backup', 'noxiy'),
    'icon'   => 'fas fa-file-alt',
    'fields' => array(
      array(
        'type' => 'backup',
      ),
    )
  ));
}
