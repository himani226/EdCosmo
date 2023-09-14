<?php

Kirki::add_section('cl_colors_header', array(
	'title' => esc_attr__('Header Colors', 'thype') ,
	'tooltip' => '',
	'panel' => 'cl_colors',
	'type' => '',
	'priority' => 8,
	'capability' => 'edit_theme_options'
));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'logo_font_color',
    'label' => 'Logo Font',
    'default' => codeless_get_mod( 'primary_color', '#e94828' ),
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-logo__font',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'menu_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'menu_items_font_color',
    'label' => 'Menu Items Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li > a',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'menu_items_font_color_hover',
	'label' => 'Hover/Current Item Color',
	'tooltip' => 'Font color on menu item hover.',
	'default' => '#191e23',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
	),
	'output' => array(
		array(
			'element' => '.cl-header--dark .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li:hover > a, .cl-header--dark .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-item > a, .cl-header--dark .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-parent > a',
			'property' => 'color',
			'suffix' => '!important'
		)
	) ,
	'transport' => 'auto'
));

Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'menu_items_bg_color_hover',
	'label' => 'Hover/Current Item BG Color',
	'tooltip' => 'Background color on menu item hover or active.',
	'default' => '',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
	),
	'output' => array(
		array(
			'element' => '.cl-header--menu-style-background_color .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-item:before, .cl-header--menu-style-background_color .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-parent:before, .cl-header--menu-style-background_color .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li:hover:before',
			'property' => 'background-color', 
			'suffix' => '!important'
		)
	) , 
	'transport' => 'auto'
));


Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'menu_items_border_color_hover',
	'label' => 'Hover/Current Border Color',
	'tooltip' => 'Border color on menu item hover or active.',
	'default' => '',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
	),
	'output' => array(
		array(
			'element' => '.cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li:hover:before, .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-item:before, .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li.current-menu-parent:before',
			'property' => 'border-color',
			'suffix' => '!important'
		)
	) ,
	'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'main_header_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'main_header_color',
    'label' => 'Main Row Font Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--main',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'main_header_bg_color',
    'label' => 'Main Row BG Color',
    'default' => '#fff',
    'choices' => array(
        'alpha' => true,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--main, .cl-header__row--main:before',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'main_header_border_color',
    'label' => 'Main Row Border Color',
    'default' => '#eaebec',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--main, .cl-header__row--main .cl-header__element, .cl-header__tool',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'top_header_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'top_header_color',
    'label' => 'Top Row Font Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--top',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'top_header_bg_color',
    'label' => 'Top Row BG Color',
    'default' => '#f1f1f1',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--top',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'top_header_border_color',
    'label' => 'Top Row Border Color',
    'default' => '#eaebec',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--top',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'extra_header_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'extra_header_color',
    'label' => 'Extra Row Font Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--extra',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'extra_header_bg_color',
    'label' => 'Extra Row BG Color',
    'default' => '#f1f1f1',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--extra',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'extra_header_border_color',
    'label' => 'Extra Row Border Color',
    'default' => '#eaebec',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--extra, .cl-header__row--extra .cl-header__container',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'submenu_header_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'megamenu_title_font_color',
    'label' => 'Submenu/Mobile Title Color',
    'tooltip' => 'Used on Megamenu Title, Submenu Items that have third level dropdown, Mobile',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__menu__megamenu h6, .cl-header__menu li ul li.has-submenu > a, .cl-mobile-menu nav > ul > li > a',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'dropdown_items_font_color',
    'label' => 'Submenu/Mobile Item Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'priority' => 10,
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__navigation.cl-mobile-menu li a, .cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu li ul li:not(.has-submenu) a, .cl-submenu a, .cl-submenu .empty, .cl-header__tool--shop .total',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));

Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'dropdown_item_hover_color',
	'label' => 'Submenu/Mobile Hover Color',
	'default' => '#191e23',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
    ),
    'priority' => 10,
	'output' => array(
		array(
			'element' => '.cl-header__menu li ul a:hover, .cl-header__navigation.cl-mobile-menu li a:hover, .cl-header__navigation.cl-mobile-menu h6:hover, #site-header-search input[type="search"]',
			'property' => 'color',
			'suffix' => '!important'
		)
	) ,
	'transport' => 'auto'
));

Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'dropdown_bg_color',
	'label' => 'Submenu/Mobile BG Color',
	'default' => '#fff',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
    ),
    'priority' => 10,
	'output' => array(
		array(
			'element' => '.cl-header__menu__megamenu,  .cl-header__menu > li ul, .cl-mobile-menu, .cl-submenu',
			'property' => 'background-color'
		)
	) ,
	'transport' => 'auto'
));

Kirki::add_field('cl_thype', array(
	'type' => 'color',
	'settings' => 'dropdown_border_color',
	'label' => 'Submenu/Mobile Border Color',
	'default' => '#ebebeb',
	'inline_control' => true,
	'section' => 'cl_colors_header',
	'choices' => array(
		'alpha' => true,
    ),
    'priority' => 10,
	'output' => array(
		array(
			'element' => '.cl-header__navigation .cl-header__menu__megamenu>ul>li',
			'property' => 'border-color'
		)
	) ,
	'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'sticky_bg_color_div',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'sticky_bg_color',
    'label' => 'Sticky Bg Color',
    'default' => '#fff',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header--sticky-prepare .cl-header__row--main',
            'property' => 'background-color',
            'suffix'    => '!important'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'tools_color_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'elements_tools_sidenav',
    'label' => 'Tools Side-Nav Color',
    'default' => codeless_get_mod( 'primary_color' ),
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__tool--side-menu .cl-header__tool__link span',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));
Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'elements_socials_icon',
    'label' => 'Socials Icon Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__socials a i',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'elements_socials_bg',
    'label' => 'Socials Icon BG Color',
    'default' => '#f1f1f1',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__socials--style-circle-bg a',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));



Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'elements_socials_border',
    'label' => 'Socials Icon Border Color',
    'default' => '#e1e1e1',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__socials--style-circle-bg a, .cl-header__socials--style-circle-border a',
            'property' => 'border-color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'elements_icon_text_color',
    'label' => 'Icon Text Element Icon Color',
    'default' => '#6c7781',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__icontext-icon',
            'property' => 'color'
        )
    ),
    'transport' => 'auto'
));


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'top_news_header_sec_start',
    'label'    => '',
    'section'  => 'cl_colors_header',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'type' => 'color',
    'settings' => 'top_news_row_bg_color',
    'label' => 'Top News Section BG Color',
    'default' => '#f4f7f8',
    'choices' => array(
        'alpha' => false,
        'palettes' => codeless_generate_palettes()
    ),
    'section'  => 'cl_colors_header',
    'output' => array(
        array(
            'element' => '.cl-header__row--top-news',
            'property' => 'background-color'
        )
    ),
    'transport' => 'auto'
));

?>