<?php

CSF::createSection(
    $noxiy_theme_option,
    array(
        'title' => esc_html__('Customization', 'noxiy'),
        'icon' => 'fas fa-heading',
        'id' => 'general_setting',
        'fields' => array()
    )
);

// Deafult Header

CSF::createSection(
    $noxiy_theme_option,
    array(
        'title' => esc_html__('Default Header', 'noxiy'),
        'icon' => 'fas fa-eye',
        'id' => 'deafult_header',
        'parent' => 'general_setting',
        'fields' => array(

            array(
                'id' => 'default_logo',
                'type' => 'media',
                'title' => esc_html__('Logo - Light', 'noxiy'),
                'subtitle' => esc_html__('Light Mode Logo', 'noxiy'),
                'library' => 'image',
                'url' => false,
                'button_title' => esc_html__('Upload', 'noxiy'),
            ),

            array(
                'id' => 'default_logo_2',
                'type' => 'media',
                'title' => esc_html__('Logo - Dark', 'noxiy'),
                'subtitle' => esc_html__('Dark Mode Logo', 'noxiy'),
                'library' => 'image',
                'url' => false,
                'button_title' => esc_html__('Upload', 'noxiy'),
            ),

            array(
                'id' => 'mobile_logo_1',
                'type' => 'media',
                'title' => esc_html__('Mobile Logo', 'noxiy'),
                'subtitle' => esc_html__('Responsive Mobile Logo', 'noxiy'),
                'library' => 'image',
                'url' => false,
                'button_title' => esc_html__('Upload', 'noxiy'),
            ),


            array(
                'id' => 'default_search',
                'type' => 'button_set',
                'title' => esc_html__('Search Icon', 'noxiy'),
                'options' => array(
                    'yes' => esc_html__('Yes', 'noxiy'),
                    'no' => esc_html__('No', 'noxiy'),
                ),
                'default' => 'yes',
                'desc' => esc_html__('Enable or Disable', 'noxiy'),
            ),

            array(
                'id'      => 'sticky_header',
                'type'    => 'button_set',
                'title'   => esc_html__('Sticky Menu', 'noxiy'),
                'options' => array(
                    'yes'   => esc_html__('Yes', 'noxiy'),
                    'no'    => esc_html__('No', 'noxiy'),
                ),
                'default' => 'no',
                'desc'    => esc_html__('Enable or Disable', 'noxiy'),
            ),


        )
    )
);

// Deafult Footer

CSF::createSection($noxiy_theme_option, array(
    'title' => esc_html__('Default Footer', 'noxiy'),
    'icon' => 'fas fa-stream',
    'id' => 'default_footer',
    'parent' => 'general_setting',
    'fields' => array(
        array(
            'id' => 'footer_copyright',
            'type' => 'wp_editor',
            'title' => esc_html__('Copyright Text', 'noxiy'),
            'tinymce' => true,
            'quicktags' => true,
            'media_buttons' => false,
            'height' => '50px',
        ),

        array(
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'title' => esc_html__('Copyright Color', 'noxiy'),
            'output' => '.theme-default-copyright p,.theme-default-copyright',
            'output_mode' => 'color',
        ),

        array(
            'id' => 'footer_bottom_bg',
            'type' => 'color',
            'title' => esc_html__('Copyright Background', 'noxiy'),
            'output' => '.theme-default-copyright',
            'output_mode' => 'background',
        ),

    )
)
);



// Breadcrumb Options

CSF::createSection(
    $noxiy_theme_option,
    array(
        'title' => esc_html__('Breadcrumb', 'noxiy'),
        'icon' => 'fas fa-pager',
        'id' => 'breadcrumb_options',
        'parent' => 'general_setting',
        'fields' => array(

            array(
                'id' => 'banner_breadcrumb',
                'type' => 'button_set',
                'title' => esc_html__('Enable Banner', 'noxiy'),
                'options' => array(
                    'yes' => esc_html__('Yes', 'noxiy'),
                    'no' => esc_html__('No', 'noxiy'),
                ),
                'default' => 'yes',
            ),

            array(
                'id' => 'banner_header_bg',
                'type' => 'background',
                'title' => esc_html__('Background', 'noxiy'),
                'output' => '.page__banner',
                'background_gradient' => false,
                'background_origin' => false,
                'background_clip' => false,
                'background_blend_mode' => false,
                'background-color' => false,
                'dependency' => array('banner_breadcrumb', '==', 'yes'),
            ),

        )
    )
);