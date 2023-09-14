<?php 
    
    extract( $element['params'] ); 

    global $cl_from_element;
    $cl_from_element['search_type'] = $search_type;
    
    if( !isset( $cl_from_element['sidenav_button'] ) )
        $cl_from_element['sidenav_button'] = $side_nav_button;
?>


<div class="cl-header__tools">
    

    <?php if( ( int ) $search_button ): ?>
       
        <div class="cl-header__tool--search cl-header__tool cl-header__tool--search-style-<?php echo esc_attr($search_type) ?>">

            

            <?php if( $search_type == 'box' ): ?>
                <a href="#" id="cl-header__search-btn" class="cl-header__tool__link"><i class="cl-icon-magnify"></i></a>
                <div class="cl-header__box cl-header__box--search cl-submenu cl-hide-on-mobile ">
                    <?php the_widget( 'WP_Widget_Search', 'title=', array('before_widget' => '<div class="cl-header__search-form">', 'after_widget' => '</div>' ) ); ?>
                </div><!-- .cl-header__box--search -->
            <?php endif; ?>

            <?php if( $search_type == 'inline' ): ?>
                <?php the_widget( 'WP_Widget_Search', 'title=', array('before_widget' => '<div class="cl-header__search-form">', 'after_widget' => '</div>' ) ); ?>
            <?php endif; ?>

        </div>

    <?php endif; ?>
    
    
    <?php if( ( int ) $side_nav_button ): ?>

        <div class="cl-header__tool--side-menu cl-header__tool">
            <a href="#" class="cl-header__tool__link">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>

    <?php endif; ?>
    

</div>