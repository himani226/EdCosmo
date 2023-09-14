<?php

if( function_exists( 'register_sidebar' ) ) {
    
    function codeless_register_sidebars_init() {
        global $cl_redata;
        
        register_sidebar( array(
             'name' => esc_attr__( 'Sidebar Blog', 'thype' ),
            'id' => 'sidebar-blog',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3></div>' 
        ) );
        
        register_sidebar( array(
             'name' => esc_attr__( 'Sidebar Pages', 'thype' ),
            'id' => 'sidebar-pages',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3></div>' 
        ) );
        
        
        $cols = codeless_layout_to_array( codeless_get_mod( 'footer_layout', '14_14_14_14' ) );
        
        for( $i = 1; $i <= count( $cols ); $i++ ) {
            register_sidebar( array(
                 'name' => esc_attr__( 'Footer Column ' . $i, 'thype' ),
                'id' => 'footer-column-' . $i,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title cl-custom-font">',
                'after_title' => '</h3>' 
            ) );
        }
        
        
        register_sidebar( array(
             'name' => esc_attr__( 'Copyright Left', 'thype' ),
            'id' => 'copyright-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3>' 
        ) );
        
        register_sidebar( array(
             'name' => esc_attr__( 'Copyright Right', 'thype' ),
            'id' => 'copyright-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3>' 
        ) );
        
        register_sidebar( array(
            'name' => esc_attr__( 'Footer Toparea', 'thype' ),
           'id' => 'footer-toparea',
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
           'after_widget' => '</div>',
           'before_title' => '<h3 class="widget-title cl-custom-font">',
           'after_title' => '</h3>' 
       ) );
        
        $custom_pages_sidebars = codeless_get_custom_sidebar_pages();


        if( ! empty( $custom_pages_sidebars ) ):
                foreach( $custom_pages_sidebars as $page_id => $page_name ) {
                    
                    if( $page_id != "" )
                        register_sidebar( array(
                             'name' => esc_attr__( 'Page', 'thype' ) . ': ' . get_the_title( $page_id ) . '',
                            'id' => 'sidebar-custom-page-' . $page_id,
                            'before_widget' => '<div id="%1$s" class="widget %2$s">',
                            'after_widget' => '</div>',
                            'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
                            'after_title' => '</h3></div>' 
                        ) );
                    
                    
                }
        endif;
        
        
        
        $custom_categories_sidebars = codeless_get_custom_sidebar_categories();


        if( ! empty( $custom_categories_sidebars ) ):
                foreach( $custom_categories_sidebars as $category_id => $category_name ) {
                    
                    if( $page_id != "" )
                        register_sidebar( array(
                             'name' => esc_attr__( 'Category', 'thype' ) . ': ' . $category_name . '',
                            'id' => 'sidebar-custom-category-' . $category_id,
                            'before_widget' => '<div id="%1$s" class="widget %2$s">',
                            'after_widget' => '</div>',
                            'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
                            'after_title' => '</h3></div>' 
                        ) );
                    
                    
                }
        endif;
        
        
        
        register_sidebar( array(
             'name' => esc_attr__( 'Search Page', 'thype' ),
            'id' => 'search-dynamic',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3></div>' 
        ) );

        register_sidebar( array(
            'name' => esc_attr__( 'Sidenav Widgets', 'thype' ),
           'id' => 'sidenav',
           'before_widget' => '<div id="%1$s" class="widget %2$s">',
           'after_widget' => '</div>',
           'before_title' => '<div class="cl-widget-title-wrapper"><h3 class="widget-title cl-custom-font">',
            'after_title' => '</h3></div>' 
       ) );

       register_sidebar( array(
        'name' => esc_attr__( 'Custom Widgetized Area', 'thype' ),
       'id' => 'custom',
       'before_widget' => '<div id="%1$s" class="widget %2$s">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title cl-custom-font">',
       'after_title' => '</h3>' 
   ) );

   register_sidebar( array(
    'name' => esc_attr__( 'Custom Widgetized 2', 'thype' ),
   'id' => 'custom2',
   'before_widget' => '<div id="%1$s" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h3 class="widget-title cl-custom-font">',
   'after_title' => '</h3>' 
) );

if( codeless_get_mod( 'header_menu_style', 'simple' ) == 'fullscreen-overlay' ){
    register_sidebar( array(
        'name' => esc_attr__( 'Fullscreen Overlay Menu', 'thype' ),
       'id' => 'fullscreen-overlay',
       'before_widget' => '<div id="%1$s" class="widget %2$s">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title cl-custom-font">',
       'after_title' => '</h3>' 
    ) );
}

        
        
    }
    add_action( 'widgets_init', 'codeless_register_sidebars_init' );
    
}

?>