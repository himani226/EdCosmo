<?php

Kirki::add_section( 'cl_buttons', array(
    'title'          => esc_attr__( 'Buttons', 'thype' ),
    'description'    => esc_attr__( 'Buttons Default Options', 'thype' ),
    'type'			 => '',
    'priority'		 => 10,
    'capability'     => 'edit_theme_options'
) );


Kirki::add_field('cl_thype', array(
	'settings' => 'button_color',
	'label' => esc_attr__('Button Colors', 'thype') ,
	'section' => 'cl_buttons',
	'type' => 'radio-buttonset',
	'default' => 'alt',
	'priority' => 10,
	'choices' => array(
		'normal' => esc_attr__('Normal', 'thype') ,
        'alt' => esc_attr__('Alternative', 'thype')
	) ,
	'transport' => 'postMessage',
));


Kirki::add_field('cl_thype', array(
	'settings' => 'button_size',
	'label' => esc_attr__('Button Size', 'thype') ,
	'tooltip' => esc_attr__('Select predefined button sizes', 'thype') ,
	'section' => 'cl_buttons',
	'type' => 'radio-buttonset',
	'default' => 'medium',
	'priority' => 10,
	'choices' => array(
		'small' => esc_attr__('Small', 'thype') ,
        'medium' => esc_attr__('Medium', 'thype'),
        'large' => esc_attr__('Large', 'thype'),
        'custom' => esc_attr__('Custom', 'thype'),
	) ,
	'transport' => 'postMessage',
));

Kirki::add_field('cl_thype', array(
	'settings' => 'button_custom_typography',
	'description' => esc_attr__('Typography', 'thype') ,
	'tooltip' => esc_attr__('Set custom typography for buttons', 'thype') ,
	'section' => 'cl_buttons',
	'type' => 'typography',
	'priority' => 10,
	'default' => array(
		'font-family' => 'Poppins',
		'variant' => '600',
		'font-size' => '12px',
		'line-height' => '20px',
		'letter-spacing' => '0.5px',
		'text-align' => 'center',
		'text-transform' => 'uppercase',
	) ,
    'transport' => 'auto',
    'output' => array(
        array(
            'element' => '.cl-btn--size-custom'
        )
    ),
    'required'    => array(
        array(
            'setting'  => 'button_size',
            'operator' => '==',
            'value'    => 'custom',
            'transport' => 'postMessage'
        ),
                    
    ),
));

Kirki::add_field( 'my_config', array(
    'settings'  => 'button_custom_padding',
    'section'   => 'cl_buttons',
    'description'     => esc_html__( 'Button Padding', 'thype' ),
    'type'      => 'spacing',
    'default'   => array(
      'top'    => '5px',
      'right'  => '10px',
      'bottom' => '5px',
      'left'   => '10px',
    ),
    'transport' => 'auto',
    'output'    => array(
      array(
        'element'  => '.cl-btn--size-custom',
        'property' => 'padding',
      ),
    ),
    'required'    => array(
        array(
            'setting'  => 'button_size',
            'operator' => '==',
            'value'    => 'custom',
            'transport' => 'postMessage'
        ),
                    
    ),
  ) );

  Kirki::add_field('cl_thype', array(
	'settings' => 'button_style',
	'label' => esc_attr__('Button Style', 'thype') ,
	'tooltip' => esc_attr__('Select form of button', 'thype') ,
	'section' => 'cl_buttons',
	'type' => 'radio-buttonset',
	'default' => 'square',
	'priority' => 10,
	'choices' => array(
        'square' => esc_attr__('Square', 'thype') ,
		'small-radius' => esc_attr__('Small Radius', 'thype') ,
        'rounded' => esc_attr__('Rounded', 'thype')
	) ,
	'transport' => 'postMessage',
));

  Kirki::add_field('cl_thype', array(
	'settings' => 'button_border',
	'label' => esc_attr__('Button Border', 'thype') ,
	'tooltip' => esc_attr__('Button Border Width', 'thype') ,
	'section' => 'cl_buttons',
	'type' => 'slider',
	'default' => '1',
    'priority' => 10,
	'choices' => array(
		'min' => '0',
		'max' => '10',
		'step' => '1',
	) ,
    'transport' => 'auto',
    'output' => array(

        array(
            'element' => 'cl-btn',
            'property' => 'border-width',
            'suffix' => 'px'
        )

    )
));



?>