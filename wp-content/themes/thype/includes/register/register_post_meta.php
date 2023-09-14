<?php

Cl_Post_Meta::map(array(
    'post_type' => array('page', 'post'),
    'priority' => 2,
    'id' => 'layout',
    'type' => 'select',
    'name' => esc_attr__( 'Page Layout', 'thype' ),
    'desc' => esc_attr__( '', 'thype' ),
    'group_in' => 'layout_sect',
    'std' => 'default',
    'default' => 'default',
    'options'     => array(
        'default' => esc_attr__( '--Site Default--', 'thype' ),
        'fullwidth' => esc_attr__( 'Fullwidth', 'thype' ),
        'left_sidebar'  => esc_attr__( 'Left Sidebar', 'thype' ),
        'right_sidebar'  => esc_attr__( 'Right Sidebar', 'thype' ),
     ),
 ));

 Cl_Post_Meta::map(array(
   
    'post_type' => array('page', 'post'),
    'priority' => 2,
    'id' => 'fullwidth_content',
    'type' => 'select',
    'name' => 'Fullwidth Content',
    'desc' => 'Remove container from page and show page content from left of the screen to the right',
    'options'     => array(
       'default' => esc_attr__( '--Site Default--', 'thype' ),
       0 => esc_attr__( 'Off', 'thype' ),
       1  => esc_attr__( 'On', 'thype' ),
    ),
    'group_in' => 'layout_sect',
    'std' => 'default'
    
 ));

 Cl_Post_Meta::map(array(
   
    'post_type' => array('page', 'post'),
    'priority' => 2,
    'id' => 'wrapper_content',
    'type' => 'select',
    'name' => 'Wrapper Content',
    'desc' => 'Add a wrapper on page content, create a modern styling of page.',
    'options'     => array(
       'default' => esc_attr__( '--Site Default--', 'thype' ),
       0 => esc_attr__( 'Off', 'thype' ),
       1  => esc_attr__( 'On', 'thype' ),
    ),
    'group_in' => 'layout_sect',
    'std' => 'default'
    
 ));

 Cl_Post_Meta::map(array(
   
    'post_type' => array('page', 'post'),
    'priority' => 2,
    'id' => 'header_color',
    'type' => 'select',
    'name' => 'Header Color',
    'options'     => array(
       'default' => esc_attr__( '--Site Default--', 'thype' ),
       'dark' => esc_attr__( 'Dark', 'thype' ),
       'light'  => esc_attr__( 'Light', 'thype' ),
    ),
    'group_in' => 'layout_sect',
    'std' => 'default'
    
 ));
 Cl_Post_Meta::map(array(
   
    'post_type' => array('page', 'post'),
    'priority' => 2,
    'id' => 'header_transparent',
    'type' => 'select',
    'name' => 'Header Transparent',
    'options'     => array(
       'default' => esc_attr__( '--Site Default--', 'thype' ),
       0 => esc_attr__( 'Off', 'thype' ),
       1  => esc_attr__( 'On', 'thype' ),
    ),
    'group_in' => 'layout_sect',
    'std' => 'default'
    
 ));



// ---------- One Page -------------

Cl_Post_Meta::map(array(
   'post_type' => 'page',
   'priority' => 2,
   'id' => 'select_slider',
   'type' => 'post',
   'name' => esc_attr__( 'Select Codeless Slider', 'thype' ),
   'group_in' => 'general',
   'post_type' => array( 'codeless_slider' ),
   'field_type' => 'select_advanced',
   'std' => '',
));

Cl_Post_Meta::map(array(
   
   'post_type' => 'page',
   'feature' => 'one_page',
   'priority' => 3,
   'id' => 'one_page',
   'type' => 'select',
   'name' => 'Page as One Page',
   'desc' => 'Make this page acts as a one page. Please add a custom id for each section and connect it with a menu item.',
   'options'     => array(
      'off' => esc_attr__( 'Off', 'thype' ),
      'on'  => esc_attr__( 'On', 'thype' ),
      
   ),
   'group_in' => 'general',
   'inline_control' => true,
   'id' => 'one_page',
   'transport' => 'auto', 
   'std' => 0
   
));


// ---------- Page Layout ------------- //

Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_bool',
    'type' => 'select',
    'name' => esc_attr__( 'Page Header Active', 'thype' ),
    'desc' => esc_attr__( 'Switch On to add page header to this page.', 'thype' ),
    'group_in' => 'general',
    'options'     => array(
        'default' => esc_attr__( '--Site Default--', 'thype' ),
        0  => esc_attr__( 'Off', 'thype' ),
        1  => esc_attr__( 'On', 'thype' ),
     ),
    'std' => 'default',
    'style' => 'rounded',
    'yes_label' => '<i class="dashicons dashicons-yes"></i>'
 ));

Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_title',
    'type' => 'text',
    'name' => esc_attr__( 'Title', 'thype' ),
    'desc' => esc_attr__( 'Add if you need a page header title different from the actual page title', 'thype' ),
    'group_in' => 'general',
    'std' => '',
    'placeholder' => esc_attr__( 'Leave empty to use same as Page Title', 'thype' ),
    'size' => 60,
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_desc',
    'type' => 'textarea',
    'name' => esc_attr__( 'Description', 'thype' ),
    'desc' => esc_attr__( 'Add some description to the page header', 'thype' ),
    'group_in' => 'general',
    'std' => '',
    'placeholder' => esc_attr__( 'Leave empty if you dont need description', 'thype' ),
    'size' => 60,
 ));

 Cl_Post_Meta::map(array(
   
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_default',
    'type' => 'select',
    'name' => 'Page Header Values',
    'desc' => 'The default page header is set on Customizer -> Layout -> Site Defaults',
    'options'     => array(
       'default' => esc_attr__( '--Site Default--', 'thype' ),
       'custom'  => esc_attr__( 'Custom', 'thype' ),
    ),
    'group_in' => 'general',
    'inline_control' => true,
    'transport' => 'postMessage', 
    'std' => 0,

    
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_bg_color',
    'type' => 'color',
    'name' => esc_attr__( 'Background Color', 'thype' ),
    'desc' => esc_attr__( 'Page Header Background Color, in case that you use image too, this color will be used as overlay color', 'thype' ),
    'group_in' => 'general',
    'std' => '#fafafa',
    'alpha_channel' => true,
    'visible' => array(
        'page_header_default',
        'contains',
        'custom'
    )
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_bg_image',
    'type' => 'single_image',
    'name' => esc_attr__( 'Background Image', 'thype' ),
    'desc' => esc_attr__( 'In case you select an image as background, background color will be used as overlay', 'thype' ),
    'group_in' => 'general',
    'std' => '',
    'visible' => array(
        'page_header_default',
        'contains',
        'custom'
    )
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_style',
    'type' => 'select',
    'name' => esc_attr__( 'Style', 'thype' ),
    'desc' => esc_attr__( 'Select one of the predefined styles of page header', 'thype' ),
    'group_in' => 'general',
    'options' => array(
        'all_center' => esc_attr__( 'All Center', 'thype' ),
        'with_breadcrumbs' => esc_attr__( 'With Breadcrumbs', 'thype' )
    ),
    'std' => 'with_breadcrumbs',
    'visible' => array(
        'page_header_default',
        'contains',
        'custom'
    )
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_color',
    'type' => 'select',
    'name' => esc_attr__( 'Text Color', 'thype' ),
    'desc' => esc_attr__( 'Select light when using a dark color/background page header', 'thype' ),
    'group_in' => 'general',
    'options' => array(
        'dark' => esc_attr__( 'Dark', 'thype' ),
        'light' => esc_attr__( 'Light', 'thype' )
    ),
    'std' => 'dark',
    'visible' => array(
        'page_header_default',
        'contains',
        'custom'
    )
 ));

 Cl_Post_Meta::map(array(
    'post_type' => 'page',
    'priority' => 2,
    'id' => 'page_header_height',
    'type' => 'number',
    'name' => esc_attr__( 'Height', 'thype' ),
    'desc' => esc_attr__( 'Suggested heights: 500px for Centered Style & 280px for Classic Breadcrumbs', 'thype' ),
    'group_in' => 'general',
    'min' => 90,
    'max' => 1000,
    'step' => 1,
    'std' => 280,
    'visible' => array(
        'page_header_default',
        'contains',
        'custom'
    )
 ));

 Cl_Post_Meta::map(array(
   'post_type' => 'page',
   'priority' => 2,
   'id' => 'page_background_color',
   'type' => 'color',
   'name' => esc_attr__( 'Page Custom BG Color', 'thype' ),
   'group_in' => 'general',
   'std' => '',
));


// --------------------- Other Page dividers --------------------------------





// Post


Cl_Post_Meta::map(array(
    'type' => 'select',
    'name' => 'Post Header Text Color',
    'options'     => array(
       'default'  => esc_attr__( '-- Site Default --', 'thype' ),
       'dark'  => esc_attr__( 'Dark', 'thype' ),
       'light'  => esc_attr__( 'Light', 'thype' ),
    ),
    'inline_control' => true,
    'group_in' => 'post_data',
    'id' => 'post_header_color',
    'transport' => 'auto', 
    'std' => 'default',
 ));

 Cl_Post_Meta::map(array(
   'type' => 'select',
   'name' => 'Post Header Layout',
   'options'     => array(
      'default'  => esc_attr__( '-- Site Default --', 'thype' ),
      'container'  => esc_attr__( 'In Container', 'thype' ),
      'fullwidth'  => esc_attr__( 'Fullwidth', 'thype' ),
   ),
   'inline_control' => true,
   'group_in' => 'post_data',
   'id' => 'post_header_layout',
   'transport' => 'auto', 
   'std' => 'default',
));

Cl_Post_Meta::map(array(
   
   'post_type' => 'post',
   'feature' => 'post_masonry_layout',
   'id' => 'post_masonry_layout',
   'type' => 'select',
   'name' => 'Masonry Layout',
   'options'     => array(
      'small'  => esc_attr__( 'Small (1 width / 1 height)', 'thype' ),
      'wide' => esc_attr__( 'Wide (2/1)', 'thype' ),
      'large' => esc_attr__( 'Large (2/2)', 'thype' ),
      'long' => esc_attr__( 'Long (1/2)', 'thype' ),
   ),
   'inline_control' => true,
   'group_in' => 'post_data',
   'id' => 'post_masonry_layout',
   'transport' => 'auto', 
   'std' => 'default',
));

Cl_Post_Meta::map(array(
   'type' => 'select',
   'name' => 'Hide Post Entry Content',
   'options'     => array(
      'no'  => esc_attr__( 'No', 'thype' ),
      'yes'  => esc_attr__( 'Yes', 'thype' ),
   ),
   'inline_control' => true,
   'group_in' => 'post_data',
   'id' => 'hide_post_entry_content',
   'transport' => 'auto', 
   'std' => 'no',
));



Cl_Post_Meta::map(array(
   'type' => 'select',
   'name' => 'Top News (Use on Top News Header Bar)',
   'options'     => array(
      'no'  => esc_attr__( 'No', 'thype' ),
      'yes'  => esc_attr__( 'Yes', 'thype' ),
   ),
   'inline_control' => true,
   'group_in' => 'post_data',
   'id' => 'top_news',
   'transport' => 'auto', 
   'std' => 'no',
));


// Single Portfolio



Cl_Post_Meta::map(array(
   
   'post_type' => 'portfolio',
   'feature' => 'portfolio_custom_link',
   'id' => 'portfolio_custom_link',
   'type' => 'text',
   'dynamic' => true,
   'name' => 'Custom Link',
   'priority' => 1,
   'group_in' => 'portfolio_data',
   'id' => 'portfolio_custom_link',
   'transport' => 'postMessage', 
   'std' => '',
   
));




// Single Staff


Cl_Post_Meta::map(array(
   
   'post_type' => 'staff',
   'feature' => 'staff_position',
   'id' => 'staff_position',
   'type' => 'text',
   'dynamic' => true,
   'name' => 'Staff Position',
   'priority' => 1,
   'id' => 'staff_position',
   'group_in' => 'staff_data',
   'transport' => 'postMessage', 
   'std' => 'Developer',
   
));

Cl_Post_Meta::map(array(
   
   'post_type' => 'staff',
   'feature' => 'staff_link',
   'id' => 'staff_link',
   'type' => 'text',
   'dynamic' => true,
   'name' => 'Custom Link',
   'priority' => 1,
   'id' => 'staff_link',
   'group_in' => 'staff_data',
   'transport' => 'postMessage', 
   'std' => '',
   
));


$socials = codeless_get_team_social_list();
if( ! empty($socials) ):

   foreach($socials as $social):

      Cl_Post_Meta::map(array(
         
         'post_type' => 'staff',
         'feature' => $social['id'].'_link',
         'id' => $social['id'].'_link',
         'type' => 'text',
         'name' => ucfirst($social['id']),
         'priority' => 1,
         'dynamic' => true,
         'group_in' => 'staff_social',
         'id' => $social['id'].'_link',
         'transport' => 'auto', 
         'std' => '',
         
      ));

   endforeach;

endif;




/* Slider */

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_style',
   'type' => 'select',
   'name' => esc_attr__( 'Slider Style', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'simple' => esc_attr__( 'Simple', 'thype' ),
       'semicarousel' => esc_attr__( 'Semi Carousel Centered', 'thype' ),
       'carousel' => esc_attr__( 'Carousel', 'thype' ),
       'modern' => esc_attr__( 'Modern', 'thype' )
   ),
   'std' => 'simple',

));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'simple_slider_align',
   'type' => 'select',
   'name' => esc_attr__( 'Simple Slider Post Align', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'left' => esc_attr__( 'Left', 'thype' ),
       'center' => esc_attr__( 'Center', 'thype' )
   ),
   'std' => 'left',
   'required' => array(
      'slider_style',
      '=',
      'simple'
   )
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'simple_slider_image',
   'type' => 'select',
   'name' => esc_attr__( 'Simple Slider Image', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'no' => esc_attr__( 'Without Image', 'thype' ),
       'yes' => esc_attr__( 'With Image', 'thype' )
   ),
   'std' => 'no',
   'required' => array(
      'slider_style',
      '=',
      'simple'
   )
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'semi_carousel_box_color',
   'type' => 'select',
   'name' => esc_attr__( 'Semi Carousel Slider Box color', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'dark' => esc_attr__( 'Dark Box', 'thype' ),
       'white' => esc_attr__( 'White Box', 'thype' )
   ),
   'std' => 'white',
   'required' => array(
      'slider_style',
      '=',
      'semicarousel'
   )
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'carousel_slider_columns',
   'type' => 'select',
   'name' => esc_attr__( 'Carousel Slider Columns', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       '2' => esc_attr__( 'Two Columns', 'thype' ),
       '3' => esc_attr__( 'Three Columns', 'thype' ),
       '4' => esc_attr__( 'Four Columns', 'thype' )
   ),
   'std' => '3',
   'required' => array(
      'slider_style',
      '=',
      'carousel'
   )
));



Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'modern_slider_color',
   'type' => 'select',
   'name' => esc_attr__( 'Modern Slider Color', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'dark' => esc_attr__( 'Dark Text', 'thype' ),
       'light' => esc_attr__( 'Light Text', 'thype' )
   ),
   'std' => 'dark',
   'required' => array(
      'slider_style',
      '=',
      'modern'
   )
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_bg_color',
   'type' => 'color',
   'name' => esc_attr__( 'Slider BG Color', 'thype' ),
   'group_in' => 'slider_layout',
   'std' => '',
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_padding_top',
   'type' => 'text',
   'name' => esc_attr__( 'Slider Padding Top', 'thype' ),
   'group_in' => 'slider_layout',
   'std' => '0px',
   'step' => '1',
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_padding_bottom',
   'type' => 'text',
   'name' => esc_attr__( 'Slider Padding Bottom', 'thype' ),
   'group_in' => 'slider_layout',
   'std' => '0px',
   'step' => '1',
   
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_container',
   'type' => 'select',
   'name' => esc_attr__( 'Slider Container', 'thype' ),
   'group_in' => 'slider_layout',
   'options' => array(
       'fullwidth' => esc_attr__( 'Fullwidth', 'thype' ),
       'boxed' => esc_attr__( 'Boxed', 'thype' )
   ),
   'std' => 'fullwidth', 

));

// Slider Query
Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_categories',
   'type' => 'taxonomy_advanced',
   'name' => esc_attr__( 'Post Categories', 'thype' ),
   'group_in' => 'slider_query',
   'field_type' => 'select_advanced',
   'multiple' => true
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_count',
   'type' => 'number',
   'name' => esc_attr__( 'Post Count', 'thype' ),
   'group_in' => 'slider_query',
   'step'        => '1',
				// Minimum value
   'min'         => 0,
   'placeholder' => 'Enter number of posts to show'
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_orderby',
   'type' => 'select',
   'name' => esc_attr__( 'Order By', 'thype' ),
   'group_in' => 'slider_query',
   'options'     => array(
      'none' =>  esc_attr__( 'None', 'thype' ),
      'date' =>  esc_attr__( 'Date', 'thype' ),
      'ID'   =>  esc_attr__( 'Post ID', 'thype' ),
      'title' =>  esc_attr__( 'Title', 'thype' ),
      'rand'  =>  esc_attr__( 'Random', 'thype' ),
      'post__in' => esc_attr__( 'Preserve Include Order', 'thype' )
   ),
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_order',
   'type' => 'select',
   'name' => esc_attr__( 'Order', 'thype' ),
   'group_in' => 'slider_query',
   'options'     => array(
      'desc' =>  esc_attr__( 'DESC', 'thype' ),
      'asc' =>  esc_attr__( 'ASC', 'thype' ),
   ),
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_include_only',
   'type' => 'post',
   'name' => esc_attr__( 'Include Only', 'thype' ),
   'group_in' => 'slider_query',
   'field_type' => 'select_advanced',
   'multiple' => true,
   'post_type'   => array( 'post' ),
));

Cl_Post_Meta::map(array(
   'post_type' => 'codeless_slider',
   'priority' => 2,
   'id' => 'slider_exclude',
   'type' => 'post',
   'name' => esc_attr__( 'Exclude', 'thype' ),
   'group_in' => 'slider_query',
   'field_type' => 'select_advanced',
   'multiple' => true,
   'post_type'   => array( 'post' ),
));

?>
