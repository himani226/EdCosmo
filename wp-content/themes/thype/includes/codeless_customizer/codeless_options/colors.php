<?php

Kirki::add_panel( 'cl_colors', array(
    'title'          => esc_attr__( 'Colors', 'thype' ),
    'description'    => esc_attr__( 'All theme colors options', 'thype' ),
    'type'			 => 'default',
    'priority'       => 10,
    'capability'     => 'edit_theme_options'
) );


require_once 'colors/header.php';
require_once 'colors/page_header.php';
require_once 'colors/content.php';
require_once 'colors/footer.php';
require_once 'colors/copyright.php';
require_once 'colors/footer_extra.php';
?>