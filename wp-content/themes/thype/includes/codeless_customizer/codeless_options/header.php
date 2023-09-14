<?php

/* Header Options ---------------------------------------- */


Kirki::add_panel('cl_header', array(
	'priority' => 6,
	'type' => 'default',
	'title' => esc_attr__('Header', 'thype') ,
	'tooltip' => esc_attr__('All Header Options', 'thype') ,
));


require_once 'header/layout.php';
require_once 'header/logo.php';
require_once 'header/menu.php';
require_once 'header/main_header.php';
require_once 'header/top_header.php';
require_once 'header/extra_header.php';
require_once 'header/top_news.php';
require_once 'header/sticky.php';

?>