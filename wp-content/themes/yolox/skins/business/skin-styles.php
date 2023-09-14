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
			
            ul > li:before {
                color: {$colors['extra_link2']} !important;
            }
            
            button:not(.components-button):not(.search_submit),
            input[type="reset"],
            input[type="submit"],
            input[type="button"],
            .comments_wrap .form-submit input[type="submit"],
            /* BB & Buddy Press */
            #buddypress .comment-reply-link,
            #buddypress .generic-button a,
            #buddypress a.button,
            #buddypress button,
            #buddypress input[type="button"],
            #buddypress input[type="reset"],
            #buddypress input[type="submit"],
            #buddypress ul.button-nav li a,
            a.bp-title-button,
            /* Booked */
            .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
            #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a,
            #booked-profile-page input[type="submit"],
            #booked-profile-page button,
            .booked-list-view input[type="submit"],
            .booked-list-view button,
            table.booked-calendar input[type="submit"],
            table.booked-calendar button,
            .booked-modal input[type="submit"],
            .booked-modal button,
            /* ThemeREX Addons */
            .sc_button_default,
            .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):not(.sc_button_simple2),
            .socials_share:not(.socials_type_drop) .social_icon,
            /* Tour Master */
            .tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"],
            /* Tribe Events */
            #tribe-bar-form .tribe-bar-submit input[type="submit"],
            #tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],
            #tribe-bar-views li.tribe-bar-views-option a,
            #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a,
            #tribe-events .tribe-events-button,
            .tribe-events-button,
            .tribe-events-cal-links a,
            .tribe-events-sub-nav li a,
            /* EDD buttons */
            .edd_download_purchase_form .button,
            #edd-purchase-button,
            .edd-submit.button,
            .widget_edd_cart_widget .edd_checkout a,
            .sc_edd_details .downloads_page_tags .downloads_page_data > a,
            /* MailChimp */
            .mc4wp-form input[type="submit"]{
                background-color: {$colors['text_link']};
                
            }
            .sc_recent_news_style_announce2 .sc_button, 
            .more-link a, 
            body .posts_container .more-link,
            .post_item .more-link{
            color: {$colors['text_dark']} !important;
            }
            input[type="text"]:focus, 
            input[type="text"].filled,
            input[type="number"]:focus, 
            input[type="number"].filled, 
            input[type="email"]:focus, 
            input[type="email"].filled, 
            input[type="tel"]:focus, 
            input[type="search"]:focus, 
            input[type="search"].filled, 
            input[type="password"]:focus, 
            input[type="password"].filled, 
            .select_container:hover, 
            select option:hover, 
            select option:focus, 
            .select2-container.select2-container--default span.select2-choice:hover, 
            .select2-container.select2-container--focus span.select2-choice, 
            .select2-container.select2-container--open span.select2-choice, 
            .select2-container.select2-container--focus span.select2-selection--single .select2-selection__rendered, 
            .select2-container.select2-container--open span.select2-selection--single .select2-selection__rendered, 
            .select2-container.select2-container--default span.select2-selection--single:hover .select2-selection__rendered, 
            .select2-container.select2-container--default span.select2-selection--multiple:hover, 
            .select2-container.select2-container--focus span.select2-selection--multiple, 
            .select2-container.select2-container--open span.select2-selection--multiple, 
            textarea:focus, 
            textarea.filled, 
            textarea.wp-editor-area:focus, 
            textarea.wp-editor-area.filled, 
            .tourmaster-form-field input[type="text"]:focus,
            .tourmaster-form-field input[type="text"].filled,
            .tourmaster-form-field input[type="email"]:focus, 
            .tourmaster-form-field input[type="email"].filled, 
            .tourmaster-form-field input[type="password"]:focus, 
            .tourmaster-form-field input[type="password"].filled, 
            .tourmaster-form-field textarea:focus, 
            .tourmaster-form-field textarea.filled, 
            .tourmaster-form-field select:focus, 
            .tourmaster-form-field select.filled, 
            .tourmaster-form-field.tourmaster-with-border input[type="text"]:focus, 
            .tourmaster-form-field.tourmaster-with-border input[type="text"].filled, 
            .tourmaster-form-field.tourmaster-with-border input[type="email"]:focus, 
            .tourmaster-form-field.tourmaster-with-border input[type="email"].filled, 
            .tourmaster-form-field.tourmaster-with-border input[type="password"]:focus, 
            .tourmaster-form-field.tourmaster-with-border input[type="password"].filled, 
            .tourmaster-form-field.tourmaster-with-border textarea:focus, 
            .tourmaster-form-field.tourmaster-with-border textarea.filled, 
            .tourmaster-form-field.tourmaster-with-border select:focus, 
            .tourmaster-form-field.tourmaster-with-border select.filled, 
            #buddypress .dir-search input[type="search"]:focus, 
            #buddypress .dir-search input[type="search"].filled, 
            #buddypress .dir-search input[type="text"]:focus, 
            #buddypress .dir-search input[type="text"].filled, 
            #buddypress .groups-members-search input[type="search"]:focus, 
            #buddypress .groups-members-search input[type="search"].filled, 
            #buddypress .groups-members-search input[type="text"]:focus, 
            #buddypress .groups-members-search input[type="text"].filled, 
            #buddypress .standard-form input[type="color"]:focus, 
            #buddypress .standard-form input[type="color"].filled, 
            #buddypress .standard-form input[type="date"]:focus, 
            #buddypress .standard-form input[type="date"].filled, 
            #buddypress .standard-form input[type="datetime-local"]:focus, 
            #buddypress .standard-form input[type="datetime-local"].filled, 
            #buddypress .standard-form input[type="datetime"]:focus, 
            #buddypress .standard-form input[type="datetime"].filled, 
            #buddypress .standard-form input[type="email"]:focus, 
            #buddypress .standard-form input[type="email"].filled, 
            #buddypress .standard-form input[type="month"]:focus, 
            #buddypress .standard-form input[type="month"].filled, 
            #buddypress .standard-form input[type="number"]:focus, 
            #buddypress .standard-form input[type="number"].filled, 
            #buddypress .standard-form input[type="password"]:focus, 
            #buddypress .standard-form input[type="password"].filled, 
            #buddypress .standard-form input[type="range"]:focus, 
            #buddypress .standard-form input[type="range"].filled, 
            #buddypress .standard-form input[type="search"]:focus, 
            #buddypress .standard-form input[type="search"].filled, 
            #buddypress .standard-form input[type="tel"]:focus, 
            #buddypress .standard-form input[type="tel"].filled, 
            #buddypress .standard-form input[type="text"]:focus, 
            #buddypress .standard-form input[type="text"].filled, 
            #buddypress .standard-form input[type="time"]:focus, 
            #buddypress .standard-form input[type="time"].filled, 
            #buddypress .standard-form input[type="url"]:focus, 
            #buddypress .standard-form input[type="url"].filled, 
            #buddypress .standard-form input[type="week"]:focus, 
            #buddypress .standard-form input[type="week"].filled, 
            #buddypress .standard-form select:focus, 
            #buddypress .standard-form select.filled, 
            #buddypress .standard-form textarea:focus, 
            #buddypress .standard-form textarea.filled, 
            #buddypress form#whats-new-form textarea:focus, 
            #buddypress form#whats-new-form textarea.filled, 
            #booked-page-form input[type="email"]:focus, 
            #booked-page-form input[type="email"].filled, 
            #booked-page-form input[type="text"]:focus, 
            #booked-page-form input[type="text"].filled, 
            #booked-page-form input[type="password"]:focus, 
            #booked-page-form input[type="password"].filled, 
            #booked-page-form textarea:focus, 
            #booked-page-form textarea.filled, 
            .booked-upload-wrap:hover, 
            .booked-upload-wrap input:focus, 
            .booked-upload-wrap input.filled, 
            form.mc4wp-form input[type="email"]:focus,
            form.mc4wp-form input[type="email"].filled{
                 color: {$colors['extra_hover']};
            }
            
            button:not(.search_submit):hover,
            button:not(.search_submit):focus,
            input[type="submit"]:hover,
            input[type="submit"]:focus,
            input[type="reset"]:hover,
            input[type="reset"]:focus,
            input[type="button"]:hover,
            input[type="button"]:focus,
            .post_item .more-link:hover,
            .comments_wrap .form-submit input[type="submit"]:hover,
            .comments_wrap .form-submit input[type="submit"]:focus,
            /* BB & Buddy Press */
            #buddypress .comment-reply-link:hover,
            #buddypress .generic-button a:hover,
            #buddypress a.button:hover,
            #buddypress button:hover,
            #buddypress input[type="button"]:hover,
            #buddypress input[type="reset"]:hover,
            #buddypress input[type="submit"]:hover,
            #buddypress ul.button-nav li a:hover,
            a.bp-title-button:hover,
            /* Booked */
            .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
            body #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a:hover,
            body #booked-profile-page input[type="submit"]:hover,
            body #booked-profile-page button:hover,
            body .booked-list-view input[type="submit"]:hover,
            body .booked-list-view button:hover,
            body table.booked-calendar input[type="submit"]:hover,
            body table.booked-calendar button:hover,
            body .booked-modal input[type="submit"]:hover,
            body .booked-modal button:hover,
            /* ThemeREX Addons */
            .sc_button_default:hover,
            .sc_button:not(.sc_button_simple):not(.sc_button_simple2):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
            .socials_share:not(.socials_type_drop) .social_icon:hover,
            /* Tour Master */
            .tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"]:hover,
            /* Tribe Events */
            #tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,
            #tribe-bar-form .tribe-bar-submit input[type="submit"]:focus,
            #tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:hover,
            #tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
            #tribe-bar-views li.tribe-bar-views-option a:hover,
            #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
            #tribe-events .tribe-events-button:hover,
            .tribe-events-button:hover,
            .tribe-events-cal-links a:hover,
            .tribe-events-sub-nav li a:hover,
            /* EDD buttons */
            .edd_download_purchase_form .button:hover, .edd_download_purchase_form .button:active, .edd_download_purchase_form .button:focus,
            #edd-purchase-button:hover, #edd-purchase-button:active, #edd-purchase-button:focus,
            .edd-submit.button:hover, .edd-submit.button:active, .edd-submit.button:focus,
            .widget_edd_cart_widget .edd_checkout a:hover,
            .sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
            /* MailChimp */
            .mc4wp-form input[type="submit"]:hover,
            .mc4wp-form input[type="submit"]:focus{
                background-color: {$colors['text_hover']};
            }
            .sc_button_default.color_style_link2:hover, 
            .sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover{
                background-color: {$colors['text_hover2']};
            }
            .mejs-controls .mejs-time-rail .mejs-time-current, 
            .mejs-controls .mejs-volume-slider .mejs-volume-current, 
            .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{
                background-color: {$colors['alter_link2']};
            }
            .mejs-controls .mejs-button>button:hover,
            .mejs-controls .mejs-button>button:focus{
                color: {$colors['alter_link2']};
             }
             .post_categories>a, 
             .recent_news_item_content .post_categories>a, 
             .sc_blogger_item_content .post_meta .post_categories>a, 
             .post_header_single .post_categories a{
                background-color: {$colors['alter_link2']};
             }
             .comments_list_wrap .comment_reply a{
                 color: {$colors['alter_link2']};
             }
             .sc_blogger_filters .sc_blogger_filters_titles a:hover, 
             .sc_blogger_filters .sc_blogger_filters_titles a.active{
                background-color: {$colors['alter_link2']};
             }
            .widget_contacts .contacts_info span a,
            .widget_contacts .contacts_info>div>a,
            .widget_contacts .contacts_info>a{
              color: {$colors['text_link']};
            }
            .widget_contacts .contacts_info span a:hover,
            .widget_contacts .contacts_info>div>a:hover,
            .widget_contacts .contacts_info>a:hover{
              color: {$colors['text_hover']};
            }
            .elementor-widget-sidebar .widget,
            .sidebar .widget{
                 background-color: {$colors['alter_bg_color']};
            }
            
              .blog .posts_container  .post_format_quote .quote-wrapper {
                background-color: {$colors['extra_link']} !important;
            }
            .blog .posts_container  .post_format_quote blockquote,
            .blog .posts_container  .post_format_quote blockquote:before {
                color: {$colors['inverse_text']};
            }
           table>tbody>tr:nth-child(2n+1)>td{
            background-color: {$colors['extra_link3']};
            }
            table th{
                background-color: {$colors['alter_link3']};
            }
            .elementor-custom-embed-play i, 
           .trx_addons_video_player.with_cover .video_hover, 
           .format-video .post_featured.with_thumb .post_video_hover{
                color: {$colors['extra_hover3']};
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
            input + label a{
                color: {$colors['text_link2']}
            }
            input + label a:hover{
                color: {$colors['text_hover2']}
            }
            
            body .mfp-image-holder .mfp-close, 
            body .mfp-iframe-holder .mfp-close{
                color:  {$colors['text_link2']} !important;
            }
            input[type="radio"] + label, 
            input[type="checkbox"] + label, 
            input[type="radio"] + .wpcf7-list-item-label, 
            input[type="checkbox"] + .wpcf7-list-item-label, 
            .edd_price_options ul > li > label > input[type="radio"] + span, 
            .edd_price_options ul > li > label > input[type="checkbox"] + span{
                color: {$colors['text_dark']}
            }
            .elementor-widget-wp-widget-mc4wp_form_widget input[type="radio"] + label:before,
            .elementor-widget-wp-widget-mc4wp_form_widget input[type="checkbox"] + label:before{
            border-color:  {$colors['text_dark']} !important;
            }
            .scheme_default .sticky .label_sticky{
                 background-color: {$colors['alter_link2']};
            }
            .mejs-container, 
            .mejs-container .mejs-controls, 
            .mejs-embed, 
            .mejs-embed body{
               background: {$colors['extra_bg_color']};
            }
            input[placeholder]::placeholder, 
            textarea[placeholder]::placeholder{
                color: {$colors['extra_text']}
            }
             .nav-links-more:not(.nav-links-infinite) a{
                   background-color: {$colors['alter_bg_color']};
                   color: {$colors['text_dark']};
            }
             .nav-links-more:not(.nav-links-infinite) a:hover{
                    color: {$colors['text_link2']};
            }
            .post_format_audio .media-block, 
            .trx_addons_audio_player.without_cover,
            .format-audio .post_featured.without_thumb .post_audio{
                background-color: {$colors['extra_bg_color']};
            }

            .nav-links-more:not(.nav-links-infinite) a:hover {
                color: {$colors['alter_bg_color']};
            }
CSS;
		}

		return $css;
	}
}

