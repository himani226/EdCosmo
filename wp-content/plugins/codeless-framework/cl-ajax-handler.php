<?php
/*
 WORDPRESS SPECIFIC AJAX HANDLER (because admin-ajax.php does not render plugin shortcodes).
*/

//mimic the actual admin-ajax
define('DOING_AJAX', true);
if (!isset( $_REQUEST['action']))
	die('-1');

//make sure you update this line to the relative location of the wp-load.php
require_once('../../../wp-load.php');

//Typical headers
header('Content-Type: text/html');
send_nosniff_header();

//Disable caching
header('Cache-Control: no-cache');
header('Pragma: no-cache');
$action = esc_attr(trim($_REQUEST['action']));

// Declare all actions that you will use this ajax handler for, as an added security measure.
$allowed_actions = array(
	'cl_load_shortcode'
);


if(in_array($action, $allowed_actions)) {
	if(is_user_logged_in())
		do_action('cl_ajax_handler_'.$action);
} else {
	die('-1');
}