<?php
/**
 * Theme Setup 
 */
require get_template_directory() . '/inc/core/theme-install.php';

/**
 * Register Widget 
 */
require get_template_directory() . '/inc/core/register-sidebar.php';

/**
 * Enqueue Assets
 */
require get_template_directory() . '/inc/core/enqueue.php';

/**
 * Install Plugins
 */
require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

require get_template_directory() . '/inc/tgm/install.php';

/**
 * Default Theme Options
 */

require get_template_directory() . '/inc/theme-options/options-default.php';

/**
 * Theme Options 
 */

require get_template_directory() . '/inc/theme-options/theme-options.php';

/**
 * Theme Options 
 */

require get_template_directory() . '/inc/metabox/theme-metabox.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Comment Form
 */
require get_template_directory() . '/inc/core/comment-form.php';

/**
 * Demo Import
 */
require get_template_directory() . '/inc/demo-content/demo-import.php';

/**
 * Demo Import
 */
require get_template_directory() . '/inc/admin/theme-page.php';