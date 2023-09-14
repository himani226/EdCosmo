
    
    <?php
    
    if( ! function_exists('codeless_header_logo_helper') ){
        function codeless_header_logo_helper(){

            $logo_url = codeless_get_mod('logo_default', get_template_directory_uri() . '/img/logo.png');

            $logo_iphone = codeless_get_mod('logo_iphone');
            $logo_ipad = codeless_get_mod('logo_ipad');

            $is_responsive = '';
            if( ! empty( $logo_iphone ) || !empty( $logo_ipad ) )
                $is_responsive = 'cl-logo--responsive';


            $logo_light_url = codeless_get_mod( 'logo_light', get_template_directory_uri() . '/img/logo_light.png' );
                    
            
            if( codeless_get_mod('logo_type', 'font') == 'image' )
            {
                $logo = ''; 
                $logo_light = '';
                
                if(!empty($logo_url))
                    $logo = "<img class='cl-logo__img--dark cl-logo__img' src=\"".esc_url($logo_url)."\" alt='".esc_attr__('Main Logo', 'thype')."' />";
                if( !empty( $logo_iphone ) )
                    $logo .= "<img class='cl-logo__img cl-logo__img--iphone' src=\"".esc_url($logo_iphone)."\" alt='".esc_attr__('IPhone Logo', 'thype')."' />";
                if( !empty( $logo_ipad ) )
                    $logo .= "<img class='cl-logo__img cl-logo__img--ipad' src=\"".esc_url($logo_ipad)."\" alt='".esc_attr__('IPad Logo', 'thype')."' />";

                if(!empty($logo_light_url))
                    $logo_light = "<img class='cl-logo__img cl-logo__img--light' src=\"".esc_url($logo_light_url)."\" alt='".esc_attr__('Light Logo', 'thype')."' />";
                $logo = '<div id="logo" class="cl-logo cl-logo--'.codeless_get_mod("logo_type", 'font').' '.$is_responsive.'">' . "<a href='".esc_url(home_url('/'))."'>".$logo.$logo_light."</a>" . "</div>";
            }
            elseif(codeless_get_mod('logo_type', 'font') == 'font')
            {   
                $logo = codeless_get_mod('logo_font_text', 'thype');
                $logo = "<a href='".esc_url(home_url('/'))."' class=\"cl-logo__font cl-logo__font--responsive-".esc_attr( codeless_get_mod( 'logo_font_responsive_color', 'dark' ) )."\">".$logo."</a>";
            }

            return $logo;
        }
    }
            
    echo codeless_header_logo_helper();
            
    ?>
