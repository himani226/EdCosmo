<?php

Kirki::add_section('cl_blog_archives', array(
	'title' => esc_attr__('Archives', 'thype') ,
	'panel' => 'cl_blog',
	'type' => '',
	'priority' => 11,
	'capability' => 'edit_theme_options'
));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_style',
    'label'    => esc_attr__( 'Archives Style', 'thype' ),
    'tooltip' => esc_attr__( 'Categories, archives etc', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'default',
    'choices'     => array(
        'default'  => esc_attr__( 'Default', 'thype' ),
        'alternate' => esc_attr__('Alternate', 'thype'),
        'media'     => esc_attr__('Media', 'thype'),
        'simple-no_content'     => esc_attr__('Simple No Content', 'thype'),
        'headlines' => esc_attr__('Headlines', 'thype'),
        'headlines-2' => esc_attr__('Headlines 2', 'thype'),
        'big' => esc_attr__('Big', 'thype')
    ),
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_module',
    'label'    => esc_attr__( 'Archives Module', 'thype' ),
    'tooltip' => esc_attr__( 'Categories, archives etc', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'isotope',
    'choices'     => array(
        'isotope'  => esc_attr__( 'Isotope', 'thype' ),
        'carousel'  => esc_attr__( 'Carousel', 'thype' ),
        'grid-blocks'  => esc_attr__( 'Grid Blocks', 'thype' ),
    ),
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_grid_block',
    'description'    => esc_attr__( 'Archives Grid Blocks', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'grid-1',
    'choices'     => array(
        'grid-1'  => esc_attr__( 'Grid Block 1', 'thype' ),
        'grid-2'  => esc_attr__( 'Grid Block 2', 'thype' ),
        'grid-3'  => esc_attr__( 'Grid Block 3', 'thype' ),
        'grid-4'  => esc_attr__( 'Grid Block 4', 'thype' )
    ),
    'required' => array(
        array(
			'setting' => 'blog_module',
			'operator' => '==',
			'value' => 'grid-blocks'
        )
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_isotope_type',
    'description'    => esc_attr__( 'Archives Isotope Type', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'masonry',
    'choices'     => array(
        'masonry'  => esc_attr__( 'Masonry', 'thype' ),
        'fitRows'  => esc_attr__( 'Fit Rows', 'thype' ),
        'vertical'  => esc_attr__( 'Vertical', 'thype' ),
        'packery'  => esc_attr__( 'Packery', 'thype' ),
    ),
    'required' => array(
        array(
			'setting' => 'blog_module',
			'operator' => '==',
			'value' => 'isotope'
        )
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_columns',
    'description'    => esc_attr__( 'Archives Columns', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => '1',
    'choices'     => array(
        '1'  => esc_attr__( '1 Column', 'thype' ),
        '2'  => esc_attr__( '2 Columns', 'thype' ),
        '3'  => esc_attr__( '3 Columns', 'thype' ),
        '4'  => esc_attr__( '4 Columns', 'thype' ),
        '5'  => esc_attr__( '5 Columns', 'thype' ),
    ),
    'required' => array(
        array(
			'setting' => 'blog_module',
			'operator' => '!=',
			'value' => 'grid-blocks'
        )
    )
) );

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_anim_start',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_animation',
    'label'    => esc_attr__( 'Archives Items Animation', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'none',
    'choices' => array(
        'none'	=> 'None',
        'top-t-bottom' =>	'Top-Bottom',
        'bottom-t-top' =>	'Bottom-Top',
        'right-t-left' => 'Right-Left',
        'left-t-right' => 'Left-Right',
        'alpha-anim' => 'Fade-In',	
        'zoom-in' => 'Zoom-In',	
        'zoom-out' => 'Zoom-Out',
        'zoom-reverse' => 'Zoom-Reverse',
    ),
    'transport' => 'postMessage'
) );

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_excerpt_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_excerpt',
    'label'    => esc_attr__( 'Archives Auto Excerpt', 'thype' ),
    'tooltip' => esc_attr__( 'If enabled you will see only a small part of content. If disabled all post will show', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
    

) );

Kirki::add_field( 'cl_thype', array(
    'type'        => 'slider',
    'settings'    => 'blog_excerpt_length',
    'label'       => esc_attr__( 'Archives Excerpt Length', 'thype' ),
    'section'     => 'cl_blog_archives',
    'into_group' => true,
    'choices'    => array(
        'min' => 1,
        'max' => 200,
        'step' => 1
    ),
    'default'     => '62',
    'priority'    => 10,
    
));

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_pagination_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_pagination_style',
    'label'    => esc_attr__( 'Archives Pagination', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'numbers',
    'choices'     => array(
        'none'  => esc_attr__( 'No Pagination', 'thype' ),
        'numbers'  => esc_attr__( 'With Page Numbers', 'thype' ),
        'next_prev'  => esc_attr__( 'Next/Prev', 'thype' ),
        'next_prev_ajax'  => esc_attr__( 'Next/Prev Ajax', 'thype' ),
        'load_more'  => esc_attr__( 'Load More Button', 'thype' ),
        'infinite_scroll'  => esc_attr__( 'Infinite Scroll', 'thype' ),
        
    ),
    'transport' => 'postMessage',
    'partial_refresh' => array(
        'blog_pagination_style' => array(
            'selector'            => '.cl-blog-pagination',
            'container_inclusive' => true,
            'render_callback'     => function(){
                codeless_blog_pagination();
            }
        ),
    ),
) );


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_filters_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_filters',
    'label'    => esc_attr__( 'Categories Filter', 'thype' ),
    'tooltip' => esc_attr__( 'Use ajax filter if you are using pagination', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'disabled',
    'choices'     => array(
        'disabled' => esc_attr__( 'No Filters', 'thype' ),
        'isotope'  => esc_attr__( 'Isotope Filter', 'thype' ),
        'ajax'  => esc_attr__( 'Ajax Filter', 'thype' ),
    ),
) );


Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_meta_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_meta_author',
    'label'    => esc_attr__( 'Entry Meta Author', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_meta_categories',
    'label'    => esc_attr__( 'Entry Meta Categories', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_meta_date',
    'label'    => esc_attr__( 'Entry Meta Date', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_meta_author_category',
    'label'    => esc_attr__( 'Entry Category/Author Name & Image', 'thype' ),
    'description' => esc_attr__( 'Switch OFF to remove the default Category/Author Name & Image Feature from Blog Entries (not single posts)', 'thype' ),
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );



Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_tools_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_tools_share',
    'label'    => esc_attr__( 'Entry Share', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_tools_comments_count',
    'label'    => esc_attr__( 'Entry Comments Count', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 1,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
  
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_entry_tools_likes',
    'label'    => esc_attr__( 'Entry Likes', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    ),
) );

Kirki::add_field( 'cl_thype', array(
		    
    'settings' => 'blog_image_st',
    'label'    => '',
    'section'  => 'cl_blog_archives',
    'type'     => 'groupdivider',

));

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_image_size',
    'label'    => esc_attr__( 'Archives Image Size', 'thype' ),
    'section'  => 'cl_blog_archives', 
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'theme_default',
    'choices'  => codeless_get_additional_image_sizes()
) );


Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_image_lazyload',
    'label'    => esc_attr__( 'Archives Image Lazyload', 'thype' ),
    'section'  => 'cl_blog_archives', 
    'type'     => 'switch',
    'priority' => 10,
    'default'  => 0,
    'choices'     => array(
        1  => esc_attr__( 'On', 'thype' ),
        0 => esc_attr__( 'Off', 'thype' ),
    )
) );

Kirki::add_field( 'cl_thype', array(
    'settings' => 'blog_image_filter',
    'label'    => esc_attr__( 'Archives Image Filter', 'thype' ),
    
    'section'  => 'cl_blog_archives',
    'type'     => 'select',
    'priority' => 10,
    'default'  => 'normal',
    'choices'     => array(
        'normal' => 'normal',
        'darken' => 'darken',
        '_1977' => '1977',
        'aden' => 'aden',
        'brannan' => 'brannan',
        'brooklyn' => 'brooklyn',
        'clarendon' => 'clarendon',
        'earlybird' => 'earlybird',
        'gingham' => 'gingham',
        'hudson' => 'hudson',
        'inkwell' => 'inkwell',
        'kelvin' => 'kelvin',
        'lark' => 'lark',
        'lofi' => 'lo-Fi',
        'maven' => 'maven',
        'mayfair' => 'mayfair',
        'moon' => 'moon',
        'nashville' => 'nashville',
        'perpetua' => 'perpetua',
        'reyes' => 'reyes',
        'rise' => 'rise',
        'slumber' => 'slumber',
        'stinson' => 'stinson',
        'toaster' => 'toaster',
        'valencia' => 'valencia',
        'walden' => 'walden',
        'willow' => 'willow',
        'xpro2' => 'x-pro II'
    )
) );