<?php

    if( !codeless_get_layout_option( 'page_header_bool', 1, get_the_ID() ) || ( is_single() && get_post_type() == 'post' ) || ( !is_page() && is_home() )  )
        return;

    $root_style = $overlay_style = $image_style = '';

    $main_class = 'cl-page-header';
    $classes = array();

    $title = codeless_get_meta( 'page_header_title', '' );
    if( $title == '' )
        $title = get_the_title();

    if( is_archive() )
        $title = get_the_archive_title();

    if( is_home() && !is_page() )
        $title = esc_attr__('Home', 'thype');

    if( is_search() )
    $title = esc_attr__('Search Results', 'thype');
    
    $desc = codeless_get_meta( 'page_header_desc', '' );

    $style = codeless_get_mod( 'page_header_style', 'with_breadcrumbs' );
    if( is_page() ){ 

        if( codeless_get_mod( 'overwrite_page_layout', 'default' )  == 'custom' )
            $style = codeless_get_meta( 'page_header_style', $style, get_the_ID() );

        if( codeless_get_meta( 'page_header_default', 'default', get_the_ID() )  == 'custom' )
            $style = codeless_get_meta( 'page_header_style', $style, get_the_ID() );
    }

    if( is_archive() && codeless_get_mod( 'overwrite_archive_layout', 'default' ) == 'custom' ){
        $style = codeless_get_mod( 'page_header_style_archive', $style );
    }
    if( !empty( $style ) )
        $classes[] = $main_class . '--' . $style;



    // BG Color
    $bg_color = codeless_get_mod( 'page_header_bg_color', '#fbfbfb' );
    if( is_page() ){
        $bg_color_page = codeless_get_mod( 'page_header_bg_color_page', $bg_color );
        if( !empty( $bg_color_page ) )
            $bg_color = $bg_color_page;

        if( codeless_get_meta( 'page_header_default', 'default', get_the_ID() )  == 'custom' ){
            $bg_color = codeless_get_meta( 'page_header_bg_color', $bg_color );
        }
    }
    if( is_archive() ){
        $bg_color_archive = codeless_get_mod( 'page_header_bg_color_archive', $bg_color );
        if( !empty( $bg_color_archive ) )
            $bg_color = $bg_color_archive;
    }

    if( !empty( $bg_color ) )
        $overlay_style .= 'background-color: ' . $bg_color . '; ';


    // Bg Image
    $bg_image = codeless_get_layout_option( 'page_header_bg_image', false );

    if( $url = codeless_get_layout_option( 'page_header_bg_image', false ) ){
        $image_style = 'background-image: url(\''.$url.'\'); ';
    }

    if( is_page() && codeless_get_meta( 'page_header_default', 'default', get_the_ID() )  == 'custom' ){
        if( function_exists('rwmb_meta') ){
            $bg_image = rwmb_meta( 'page_header_bg_image', array( 'size' => 'full' ) );
            $url = $bg_image['url'];

            $image_style = 'background-image: url(\''.$url.'\'); ';
        }
    }
   
     
    $text_color = codeless_get_mod( 'page_header_color', 'dark' );
    if( is_page() ){ 

        if( codeless_get_mod( 'overwrite_page_layout', 'default' )  == 'custom' )
            $text_color = codeless_get_meta( 'page_header_color', 'dark', get_the_ID() );

        if( codeless_get_meta( 'page_header_default', 'default', get_the_ID() )  == 'custom' )
            $text_color = codeless_get_meta( 'page_header_color', 'dark', get_the_ID() );
    }

    if( is_archive() && codeless_get_mod( 'overwrite_archive_layout', 'default' ) == 'custom' ){
        $text_color = codeless_get_mod( 'page_header_color_archive', $text_color );
    }

    if( $text_color != '' )
        $classes[] = $main_class . '--' . $text_color;



    // Height
    $height = codeless_get_mod( 'page_header_height', '270' );
    if( is_page() ){

        if( codeless_get_mod( 'overwrite_page_layout', 'default' ) == 'custom' )
            $height = codeless_get_mod( 'page_header_height_page', $height );
        
        if( codeless_get_meta( 'page_header_default', 'default', get_the_ID() )  == 'custom' ){
            $height = codeless_get_meta( 'page_header_height', $height );
        }
    }
    if( is_archive() && codeless_get_mod( 'overwrite_archive_layout', 'default' ) == 'custom' ){
        $height = codeless_get_mod( 'page_header_height_archive', $height );
    }



    $classes_string = implode( ' ', $classes );

    $root_style .= 'height: ' . esc_attr( $height ) . 'px; ';

    $page_header_container = 'container';
    if( codeless_is_fullwidth_content() )
        $page_header_container = 'container-fluid';

    if( $style == 'with_breadcrumbs' ): ?>

<div class="cl-page-header <?php echo esc_attr( $classes_string ) ?>" style="<?php echo esc_attr( $root_style ) ?>">

    <div class="cl-page-header__overlay" style="<?php echo esc_attr( $overlay_style ) ?>"></div>
    <div class="cl-page-header__image" style="<?php echo esc_attr( $image_style ) ?>"></div>

    <div class="cl-page-header__content d-flex align-items-center h-100">
        <div class="cl-page-header__container <?php echo esc_attr( $page_header_container ) ?>">
            <div class="cl-page-header__row align-items-center row justify-content-between text-center">
                <div class="cl-page-header__text col-md-8 text-md-left">
                    <h1 class="cl-page-header__title"><?php echo codeless_complex_esc( $title ) ?></h1>

                    <?php if( !empty( $desc ) ): ?>
                    <p class="cl-page-header__desc"><?php echo esc_html( $desc ) ?></p>
                    <?php endif; ?>

                </div>

                <?php if( !( is_home() && !is_page() ) && !is_archive() && !is_search() ): ?>
                <div class="cl-page-header__breadcrumbs col-md-4 text-md-right">
                    <a href="<?php echo esc_url(home_url()) ?>" class="cl-page-header__breadcrumbs-link"><?php esc_html_e('Home', 'thype') ?></a>
                    <?php $page_parents = codeless_page_parents();
                        
                        $count = 0;

                        if(is_array( $page_parents ))
                            $count = count($page_parents);
                            
                        for($i = $count - 1; $i >= 0; $i-- ){ ?>
        
                        <a href="<?php echo esc_url(get_permalink($page_parents[$i])); ?>" class="cl-page-header__breadcrumbs-link"><?php echo esc_html(get_the_title($page_parents[$i])) ?></a>
        
                        <?php } ?>
                        
                        <a href="<?php echo esc_url(get_permalink()) ?>" class="cl-page-header__breadcrumbs-link"><?php echo esc_html( get_the_title() ) ?></a>
    
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if( $style == 'all_center' ): ?>

<div class="cl-page-header <?php echo esc_attr( $classes_string ) ?>" style="<?php echo esc_attr( $root_style ) ?>">

<div class="cl-page-header__overlay" style="<?php echo esc_attr( $overlay_style ) ?>"></div>
<div class="cl-page-header__image" style="<?php echo esc_attr( $image_style ) ?>"></div>

<div class="cl-page-header__content d-flex align-items-center h-100">
    <div class="cl-page-header__container <?php echo esc_attr( $page_header_container ) ?>">
        <div class="cl-page-header__row align-items-center row justify-content-center text-center">
            <div class="cl-page-header__text col-md-8">
                <h1 class="cl-page-header__title"><?php echo esc_html( $title ) ?></h1>

                <?php if( !empty( $desc ) ): ?>
                <p class="cl-page-header__desc"><?php echo esc_html( $desc ) ?></p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
</div>

<?php endif; ?>