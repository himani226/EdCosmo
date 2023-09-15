<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for plugin noxiy
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
add_action('tgmpa_register', 'noxiy_register_required_plugins');
function noxiy_register_required_plugins()
{

	$plugins = array(

		array(
			'name' => esc_html__('Noxiy Toolkit', 'noxiy'),
			'slug' => 'noxiy-toolkit',
			'source' => get_template_directory() . '/inc/tgm/plugins/noxiy-toolkit.zip',
			'required' => true,
			'version' => '1.0.0',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
			'is_callable' => '',
		),

		array(
			'name' => esc_html__('One Click Demo Import', 'noxiy'),
			'slug' => 'one-click-demo-import',
			'required' => false,
		),

		array(
			'name' => 'Envato Market',
			'slug' => 'envato-market',
			'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' => false,
		),

		array(
			'name'      => 'Popup Plugin',
			'slug'      => 'convertplug',
			'source'    => 'https://envato.themeori.net/plugins/convertplug.zip',
			'required' => false,
		),

		array(
			'name'      => 'Appointment Booking',
			'slug'      => 'booked',
			'source'    => 'https://envato.themeori.net/plugins/booked.zip',
			'required' => false,
		),

		array(
			'name' => esc_html__('Elementor Website Builder', 'noxiy'),
			'slug' => 'elementor',
			'required' => true,
		),

		array(
			'name' => esc_html__('HTML Forms', 'noxiy'),
			'slug' => 'html-forms',
			'required' => false,
		),

	);


	$config = array(
		'id' => 'noxiy',
		'default_path' => '',
		'menu' => 'tgmpa-install-plugins',
		'parent_slug' => 'noxiy',
		'capability' => 'manage_options',
		'has_notices' => true,
		'dismissable' => true,
		'dismiss_msg' => '',
		'is_automatic' => false,
		'message' => '',

	);

	tgmpa($plugins, $config);
}