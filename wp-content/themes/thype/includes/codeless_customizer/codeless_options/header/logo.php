<?php

/* -------------------------- Logo ----------------------------- */

Kirki::add_section('cl_header_logo', array(
	'title' => esc_attr__('Logo', 'thype') ,
	'tooltip' => esc_attr__('Logo Options', 'thype') ,
	'panel' => 'cl_header',
	'type' => '',
	'priority' => 6,
	'capability' => 'edit_theme_options'
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_type',
	'label' => esc_attr__('Logo Type', 'thype') ,
	'tooltip' => esc_attr__('Select font or image logo type', 'thype') ,
	'section' => 'cl_header_logo',
	'type' => 'radio-buttonset',
	'default' => 'font',
	'priority' => 10,
	'choices' => array(
		'font' => esc_attr__('Font', 'thype') ,
		'image' => esc_attr__('Image', 'thype') 
	) ,
	'transport' => 'postMessage',
	'partial_refresh' => array(
		'logo_refresh_type' => array(
			'selector' => '#logo',
			'container_inclusive' => true,
			'render_callback' =>
			function ()
				{
				echo codeless_load_header_element('cl_header_logo');
				}

			,
		)
	)
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_default',
	'description' => esc_attr__('Default Logo', 'thype') ,
	'tooltip' => esc_attr__('Upload here the logo that is placed in top of the page', 'thype') ,
	'section' => 'cl_header_logo',
	'type' => 'image',
	'priority' => 10,
	'default' => get_template_directory_uri() . '/img/logo.png',
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image'
		) ,
	) ,
	'transport' => 'postMessage',
	'partial_refresh' => array(
		'logo_refresh_default' => array(
			'selector' => '#logo',
			'container_inclusive' => true,
			'render_callback' =>
			function ()
				{
				echo codeless_load_header_element('cl_header_logo');
				}

			,
		)
	)
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_light',
	'description' => esc_attr__('Logo Light', 'thype') ,
	'tooltip' => esc_attr__('Upload logo that will be shown on dark baackground or header', 'thype') ,
	'section' => 'cl_header_logo',
	'type' => 'image',
	'priority' => 10,
	'default' => get_template_directory_uri() . '/img/logo_light.png',
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image'
		) ,
	) ,
	'transport' => 'postMessage',
	'partial_refresh' => array(
		'logo_refresh_light' => array(
			'selector' => '#logo',
			'container_inclusive' => true,
			'render_callback' =>
			function ()
				{
				echo codeless_load_header_element('cl_header_logo');
				}

			,
		)
	)
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_height',
	'description' => esc_attr__('Logo Height', 'thype') ,
	'tooltip' => esc_attr__('Define the Height of your logo', 'thype') ,
	'section' => 'cl_header_logo',
	'type' => 'slider',
	'priority' => 10,
	'default' => 20,
	'choices' => array(
		'min' => 10,
		'max' => 300,
		'step' => 1,
	) ,
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image',
			'transport' => 'postMessage'
		) ,
	) ,
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => '.cl-logo__img',
			'units' => 'px',
			'property' => 'height'
		)
	) ,
	'js_vars' => array(
		array(
			'suffix' => '!important'
		)
	)
));


Kirki::add_field('cl_thype', array(
	'settings' => 'logo_iphone',
	'description' => esc_attr__('Logo Additional in iPhone', 'thype') ,
	'tooltip' => esc_attr__('Upload logo that will be shown only on iPhone', 'thype') ,
	'section' => 'cl_header_logo',
	'into_group' => true,
	'type' => 'image',
	'priority' => 10,
	'default' => '',
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image',
			'transport' => 'postMessage'
		) ,
	) ,
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_height_iphone',
	'description' => esc_attr__('Logo Height (iPhone)', 'thype') ,
	'tooltip' => esc_attr__('Define the Height of your logo in iPhone', 'thype') ,
	'section' => 'cl_header_logo',
	'into_group' => true,
	'type' => 'slider',
	'priority' => 10,
	'default' => 37,
	'choices' => array(
		'min' => 1,
		'max' => 100,
		'step' => 1,
	) ,
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image',
			'transport' => 'postMessage'
		) ,
	) ,
	'output' => array(
		array(
			'element' => '.cl-logo__img',
			'units' => 'px',
			'property' => 'height',
			'suffix'	=> '!important',
			'media_query' => '@media (max-width: 480px)'
		)
	)
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_ipad',
	'description' => esc_attr__('Logo Additional in iPad', 'thype') ,
	'tooltip' => esc_attr__('Upload logo that will be shown only on iPad', 'thype') ,
	'section' => 'cl_header_logo',
	'into_group' => true,
	'type' => 'image',
	'priority' => 10,
	'default' => '',
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image',
			'transport' => 'postMessage'
		) ,
	) ,
));

Kirki::add_field('cl_thype', array(
	'settings' => 'logo_height_ipad',
	'description' => esc_attr__('Logo Height (iPad)', 'thype') ,
	'tooltip' => esc_attr__('Define the Height of your logo in iPad', 'thype') ,
	'section' => 'cl_header_logo',
	'into_group' => true,
	'type' => 'slider',
	'priority' => 10,
	'default' => 37,
	'choices' => array(
		'min' => 1,
		'max' => 100,
		'step' => 1,
	) ,
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'image',
			'transport' => 'postMessage'
		) ,
	) ,
	'output' => array(
		array(
			'element' => '.cl-logo__img',
			'units' => 'px',
			'property' => 'height',
			'media_query' => '@media (max-width: 767px)'
		)
	)
));

Kirki::add_field('cl_thype', array(
	'type' => 'text',
	'settings' => 'logo_font_text',
	'description' => esc_attr__('Text to display as logo font', 'thype') ,
	'section' => 'cl_header_logo',
	'default' => 'thype.',
	'priority' => 10,
	'into_group' => true,
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'font',
			'transport' => 'postMessage'
		) ,
	) ,
	'transport' => 'postMessage',
));

Kirki::add_field('cl_thype', array(
	'type' => 'typography',
	'settings' => 'logo_font',
	'description' => esc_attr__('Typography', 'thype') ,
	'section' => 'cl_header_logo',
	'into_group' => true,
	'default' => array(
		'font-family' => 'Noto Serif',
		'variant' => '700',
		'font-weight' => '700',
		'font-size' => '36px',
		'line-height' => '',
		'font-style' => 'italic',
		'letter-spacing' => '',
		'subsets' => array(
			'latin-ext'
		) ,
		
		'text-transform' => 'lowercase',
		'text-align' => 'left'
	) ,
	'priority' => 10,
	'transport' => 'auto',
	'output' => array(
		array(
			'element' => codeless_dynamic_css_register_tags('logo_font')
		) ,
	) ,
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'font',
			'transport' => 'postMessage'
		) ,
	) ,
));


Kirki::add_field('cl_thype', array(
	'settings' => 'logo_font_responsive_color',
	'description' => esc_attr__('Responsive Color', 'thype') ,
	'section' => 'cl_header_logo',
	'type' => 'select',
	'default' => 'dark',
	'priority' => 10,
	'choices' => array(
		'light' => esc_attr__('Light', 'thype') ,
		'dark' => esc_attr__('Dark', 'thype') ,
	) ,
	'transport' => 'postMessage',
	'required' => array(
		array(
			'setting' => 'logo_type',
			'operator' => '==',
			'value' => 'font',
			'transport' => 'postMessage'
		) ,
	) ,
));

?>