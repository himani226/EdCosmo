<?php
// Add skin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'yolox_skin_get_css' ) ) {
	add_filter( 'yolox_filter_get_css', 'yolox_skin_get_css', 10, 2 );
	function yolox_skin_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
			/*Image caption*/
			figure figcaption, 
			.wp-caption .wp-caption-text, 
			.wp-caption .wp-caption-dd, 
			.wp-caption-overlay .wp-caption .wp-caption-text, 
			.wp-caption-overlay .wp-caption .wp-caption-dd{
			    {$fonts['h5_font-family']}
                {$fonts['h5_font-size']}
                {$fonts['h5_font-weight']}
			}
			.sc_button, 
			.sc_button_simple, 
			.sc_button_simple2, 
			.sc_form button{
			    {$fonts['button_font-family']}
			}
			
			.sc_table table tr th{
			    {$fonts['h5_font-size']}
			}
			.menu_main_nav>li, 
			.menu_main_nav>li>a, 
			.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav>li>a{
			    {$fonts['menu_font-family']}
			}
			.esg-filters div.esg-navigationbutton,
            .page_links > span:not(.page_links_title),
            .page_links > a,
            .comments_pagination .page-numbers,
            .nav-links .page-numbers{
                {$fonts['h5_font-family']}
            }
			
			
			

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS
			
            
            .trx_addons_accent_bg{
                  background-color: {$colors['alter_link2']};
            }
            .mejs-controls .mejs-button>button:hover, 
             .mejs-controls .mejs-button>button:focus {
                color: {$colors['alter_link3']} !important;
            }
            .mejs-controls .mejs-time-rail .mejs-time-current,
            .mejs-controls .mejs-volume-slider .mejs-volume-current, 
            .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{
                background: {$colors['alter_link3']};
            }
            
             table th {
               background-color: {$colors['extra_bg_color']};
             }
            
            .footer_wrap a{
                 color: {$colors['extra_text']};
            }
            .footer_wrap a:hover{
                 color: {$colors['text_hover']};
            }
            .socials_wrap .social_item .social_icon, 
            .socials_wrap .social_item .social_icon i{
                color: {$colors['extra_bg_color']};
            }
            .footer_wrap .socials_wrap .social_item .social_name{
                color: {$colors['text']};
            }
            .footer_wrap .socials_wrap .social_item:hover *{
                color: {$colors['text_hover']};
            }
            .top_panel,
            .footer_wrap{
                color: {$colors['extra_text']};
            }
            .blog .posts_container  .post_format_quote .quote-wrapper {
                background-color: {$colors['extra_link']} !important;
            }
            .blog .posts_container  .post_format_quote blockquote,
            .blog .posts_container  .post_format_quote blockquote:before {
                color: {$colors['inverse_text']};
            }
            
            .blog .posts_container  .post_format_quote .post_title:hover  a{
                color: {$colors['text_dark']};
            }
            
            .esg-filters div.esg-navigationbutton:hover, 
            .esg-filters div.esg-navigationbutton.selected,
            .page_links>a:hover, 
            .page_links>span:not(.page_links_title), 
            .comments_pagination a.page-numbers:hover,
            .comments_pagination .page-numbers.current, 
            .nav-links a.page-numbers:hover, 
            .nav-links .page-numbers.current{
                 border-color: {$colors['text_link2']};
                 background-color: {$colors['text_link2']};
            }
            .trx_addons_tabs .trx_addons_tabs_titles .trx_addons_tabs_title.ui-state-active:before, 
            .trx_addons_tabs .trx_addons_tabs_titles .trx_addons_tabs_title:hover:before{
                 background-color: {$colors['text_link3']};
            }
            
            .sc_blogger_filters .sc_blogger_filters_titles a:hover,
            .sc_blogger_filters .sc_blogger_filters_titles a.active{
                background-color: {$colors['alter_link']};
             }
             
             .sc_team_short .sc_team_item_info{
                background-color: {$colors['bg_color']};
             }
             .sc_blogger_extra .sc_blogger_item_content{
                background-color: {$colors['bg_color']};
             }
            .post_item .more-link{
                color: {$colors['text_dark']} !important;
             }
             
             .menu_mobile_inner .social_item .social_icon,
             .author_title,
             .nav-links-single .nav-links a .post-title,
            .post_item .more-link{
                color: {$colors['text_dark']} ;
             }
             .menu_mobile_inner .social_item:hover .social_icon,
             .sc_layouts_menu_nav>li li.current-menu-item>a, 
             .sc_layouts_menu_nav>li li.current-menu-parent>a, 
             .sc_layouts_menu_nav>li li.current-menu-ancestor>a,
             .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover, 
             .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a, 
             .sc_layouts_menu_nav>li li>a:hover, 
             .sc_layouts_menu_nav>li li.sfHover>a{
                color: {$colors['text_link2']} !important;
             }
             
             table th {
             background-color: {$colors['extra_link2']};
             }
             table>tbody>tr:nth-child(2n+1)>td{
                background-color: {$colors['extra_bd_hover']};
             }
            
            .elementor-custom-embed-play i, 
            .trx_addons_video_player.with_cover .video_hover, 
            .format-video .post_featured.with_thumb .post_video_hover{
                color: {$colors['inverse_dark']};
            }
            .mejs-controls .mejs-button>button, 
            .mejs-controls .mejs-button>button{
                color: {$colors['inverse_link']} !important;
            }
            .scheme_dark .mejs-controls .mejs-button>button, 
            .scheme_dark .mejs-controls .mejs-button>button{
                color: {$colors['inverse_dark']} !important;
            }
            .mejs-controls .mejs-button>button:hover, 
            .mejs-controls .mejs-button>button:focus{
                 color: {$colors['text_link2']} !important;
            }
            .scheme_dark .post_format_audio .post_title a{
                color: {$colors['alter_bg_color']};
            }
            .scheme_dark .post_format_audio .post_title a:hover{
                color: {$colors['text_link2']}
            }
            
            #tribe-bar-views-toggle{
                color: {$colors['text_dark']} !important;
            }
            #tribe-bar-views-toggle:hover{
                 background-color: {$colors['text_link2']} !important;
                  color: {$colors['inverse_text']} !important;
            }
            
             #tribe-events .tribe-events-button:hover, 
             .tribe-events-button:hover, 
             .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]{
                 background-color: {$colors['text_hover2']} ;
             }
            body .mfp-image-holder .mfp-close, body .mfp-iframe-holder .mfp-close{
                color:  {$colors['text_dark']} !important;
            }
            .nav-links-more:not(.nav-links-infinite) a,
            .sticky .label_sticky{
                background-color: {$colors['text_hover2']} ;
            }
            .nav-links-more:not(.nav-links-infinite) a{
                background-color: {$colors['text_link2']} ;
                color: {$colors['inverse_text']} ;
            }
            .nav-links-more:not(.nav-links-infinite) a:hover{
                background-color: {$colors['text_hover2']} ;
            }
             .tribe-events-calendar .mobile-active.tribe-events-has-events:after{
                background-color: {$colors['text_hover2']} ;
             }
             
             .author_title, 
             .nav-links-single .nav-links a .post-title, 
             .nav-links-single .nav-links a .nav-arrow:after, 
             .nav-links-single .nav-links .nav-previous .nav-arrow, 
             .nav-links-single .nav-links .nav-next .nav-arrow{
                color:  {$colors['text_dark']};
             }
             
            

CSS;
		}

		return $css;
	}
}

