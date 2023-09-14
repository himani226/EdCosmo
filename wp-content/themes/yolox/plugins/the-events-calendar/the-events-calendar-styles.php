<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'yolox_tribe_events_get_css' ) ) {
	add_filter( 'yolox_filter_get_css', 'yolox_tribe_events_get_css', 10, 2 );
	function yolox_tribe_events_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
.tribe-events-calendar th,	
#tribe-events .tribe-events-button, .tribe-events-button,	
#tribe-bar-form .tribe-bar-submit input[type=submit],
#tribe-bar-views-toggle,				
.tribe-events-list .tribe-events-list-event-title {
	{$fonts['h3_font-family']}
}

#tribe-events .tribe-events-button, 
.tribe-events-button, 
.tribe-events-cal-links a, 
.tribe-events-sub-nav li a, 
#tribe-bar-views-toggle, 
#tribe-bar-form .tribe-bar-submit input[type="submit"], 
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],

#tribe-bar-views-toggle,
#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
#tribe-bar-form button, #tribe-bar-form a,
.tribe-common.tribe-events .tribe-events-c-nav__next, .tribe-common.tribe-events .tribe-events-c-nav__prev,
.tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button .tribe-events-c-subscribe-dropdown__button-text,
.tribe-events-read-more {
	{$fonts['button_font-family']}
	{$fonts['button_letter-spacing']}
}
.tribe-events-list .tribe-events-list-separator-month,
.tribe-events-calendar thead th,
.tribe-events-schedule, .tribe-events-schedule h2 {
	{$fonts['info_font-family']}
}
#tribe-bar-form input, #tribe-events-content.tribe-events-month,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title,
#tribe-mobile-container .type-tribe_events,
.tribe-common.tribe-events .tribe-events-c-nav__today,
.tribe-events-list-widget ol li .tribe-event-title {
	{$fonts['p_font-family']}
}
.tribe-events-tooltip .tribe-event-duration,
.tribe-events-loop .tribe-event-schedule-details,
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
#tribe-mobile-container .type-tribe_events .tribe-event-date-start {
	{$fonts['info_font-family']};
}

.tribe-events-page-title{
    	{$fonts['h2_font-size']}
	    {$fonts['h2_font-weight']}
}

.tribe-common button.tribe-common-c-btn,
.tribe-events .tribe-events-c-ical__link,
.tribe-common .tribe-events-c-top-bar__datepicker .datepicker-switch,
.tribe-common .tribe-events-c-top-bar .tribe-events-c-top-bar__today-button,
.tribe-common .tribe-events-c-view-selector__list-item-text {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_line-height']}
}
time.tribe-events-c-top-bar__datepicker-time span, .tribe-events-list .tribe-events-list-event-title,
.tribe-common.tribe-events .tribe-common-h4--min-medium,
.tribe-common.tribe-events .datepicker .day,
.tribe-common.tribe-events .datepicker .month,
.tribe-common.tribe-events .datepicker .year,
.tribe-common.tribe-events .tribe-events-calendar-month__header-column-title,
.tribe-common.tribe-events .tribe-events-calendar-month__header-column-title span {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['p_line-height']}
}
.tooltipster-box .tooltipster-content time,
.tooltipster-box .tooltipster-content .tribe-common-b3,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-common address,
.tribe-common time,
.tribe-common p {
	{$fonts['p_font-family']}
}
.tooltipster-box .tooltipster-content time,
.tooltipster-box .tooltipster-content .tribe-common-b3,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-common.tribe-events .tribe-common-h8,
.tribe-common.tribe-events .tribe-common-h7,
.tribe-common.tribe-events .tribe-common-b2 {
	{$fonts['p_font-size']}
}

.tooltipster-box .tribe-common-h7 a,
.tribe-common.tribe-events .tribe-common-h4--min-medium,
.tribe-common .tribe-common-h6 {
	{$fonts['h4_font-size']}
}
.tribe-common .tribe-events-calendar-month-mobile-events__mobile-event-title {
	{$fonts['h5_font-size']}
}
.tribe-common .tribe-common-h7, .tribe-common .tribe-common-h8,
.tribe-common time[class*="tribe-common-h"],
.tribe-common .tribe-events-c-top-bar__datepicker .datepicker tr th.dow,
.tribe-common time.tribe-events-calendar-month__day-date-daynum {
	{$fonts['h6_font-family']};
}
.tribe-common .tribe-events-c-top-bar__datepicker .datepicker tr th.dow {
	{$fonts['h6_font-weight']}
}

.tribe-events-event-meta,
.tribe-events-content,
#tribe-bar-form input, #tribe-events-content.tribe-events-month,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title,
#tribe-mobile-container .type-tribe_events,
.tribe-events-list-widget ol li .tribe-event-title {
	{$fonts['p_font-family']}
}
.tribe-events-loop .tribe-event-schedule-details,
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
#tribe-mobile-container .type-tribe_events .tribe-event-date-start {
	{$fonts['info_font-family']};
}

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form button,
#tribe-bar-form a,
#tribe-events .tribe-events-button,
#tribe-bar-views .tribe-bar-views-list,
.tribe-events-button,
.tribe-events-cal-links a,
#tribe-events-footer ~ a.tribe-events-ical.tribe-events-button,
.tribe-events-sub-nav li a {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

/* Filters bar */
#tribe-bar-form {
	color: {$colors['text_dark']};
}
#tribe-bar-form input[type="text"] {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}
.tribe-bar-views-list {
	background-color: {$colors['text_link']};
}

.datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover {
	color: {$colors['text_link']};
	background: {$colors['text_dark']};
}

/* Content */
.tribe-events-calendar thead th {
	color: {$colors['extra_dark']};
	background: {$colors['extra_bg_color']} !important;
	border-top-color: {$colors['extra_bg_color']} !important;
}
.tribe-events-calendar thead th + th:before {
	background: {$colors['extra_dark']};
}


.tribe-events-calendar td.tribe-events-othermonth {
	color: {$colors['alter_light']};
	background: {$colors['alter_bg_color']} !important;
}
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_hover3']};
}
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] {
    background-color: {$colors['extra_link3']};
}
.tribe-events-calendar td.tribe-events-othermonth.tribe-events-future div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_dark']};
}
.tribe-events-calendar td.tribe-events-othermonth.tribe-events-future div[id*=tribe-events-daynum-],
.tribe-events-calendar div[id*=tribe-events-daynum-]{
    background-color: {$colors['alter_bg_hover']};
}

.tribe-events-calendar div[id*=tribe-events-daynum-], .tribe-events-calendar div[id*=tribe-events-daynum-] a{
    color: {$colors['text']};
}

#tribe-events .tribe-events-button,
 #tribe-events .tribe-events-button:hover, 
 #tribe_events_filters_wrapper input[type=submit], 
 .tribe-events-button, .tribe-events-button.tribe-active:hover, 
 .tribe-events-button.tribe-inactive, .tribe-events-button:hover, 
 .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], 
 .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a{
    background-color: {$colors['extra_dark']};
    color: {$colors['text_link']};
}

.tribe-events-calendar td.tribe-events-present:before {
  border-color: {$colors['text_link']};
 }
 
 .tribe-events-calendar td.tribe-events-othermonth.tribe-events-future h3.tribe-events-month-event-title a,
 .tribe-events-calendar td.tribe-events-othermonth.tribe-events-past h3.tribe-events-month-event-title a {
    color: {$colors['extra_hover3']} !important;
 }

.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] a:hover:after {
    background-color: {$colors['alter_dark']};
}

.tribe-events-calendar .tribe-events-has-events:after {
	background-color: {$colors['text']};
}
.tribe-events-calendar .mobile-active.tribe-events-has-events:after {
	background-color: {$colors['bg_color']};
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a {
	color: {$colors['text']};
}
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover {
	color: {$colors['alter_dark']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active,
#tribe-events-content .tribe-events-calendar td.mobile-active:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,
.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a {
	background-color: transparent;
	color: {$colors['bg_color']};
}

/* Tooltip */
.recurring-info-tooltip,
.tribe-events-calendar .tribe-events-tooltip,
.tribe-events-week .tribe-events-tooltip,
.tribe-events-shortcode.view-week .tribe-events-tooltip {
	color: {$colors['alter_text']};
	background: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
#tribe-events-content .tribe-events-tooltip .summary { 
	color: {$colors['extra_dark']};
	background: {$colors['extra_bg_color']};
}
.tribe-events-event-schedule-details .tribe-event-date-start,
.tribe-events-tooltip .tribe-event-duration {
	color: {$colors['extra_light']};
}

/* Events list */
.tribe-events-list-separator-month {
	color: {$colors['text_dark']};
}
.tribe-events-list-separator-month:after {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .type-tribe_events + .type-tribe_events,
.tribe-events-day .tribe-events-day-time-slot + .tribe-events-day-time-slot + .tribe-events-day-time-slot {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .tribe-events-event-cost span {
	color: {$colors['extra_dark']};
	border-color: {$colors['extra_bg_color']};
	background: {$colors['extra_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a {
	color: {$colors['alter_link']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a:hover {
	color: {$colors['alter_hover']};
}
.tribe-mobile .tribe-events-list .tribe-events-venue-details {
	border-color: {$colors['alter_bd_color']};
}

.single-tribe_events #tribe-events-footer,
.tribe-events-day #tribe-events-footer,
.events-list #tribe-events-footer,
.tribe-events-map #tribe-events-footer,
.tribe-events-photo #tribe-events-footer {
	border-color: {$colors['bd_color']};	
}
/* Events day */
.tribe-events-day .tribe-events-day-time-slot h5 {
	color: {$colors['bg_color']};
	background: {$colors['text_dark']};
}

/* Single Event */
.single-tribe_events .tribe-events-venue-map {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_hover']};
	background: {$colors['alter_bg_hover']};
}
.single-tribe_events .tribe-events-schedule .tribe-events-cost {
	color: {$colors['text_dark']};
}
.single-tribe_events .type-tribe_events {
	border-color: {$colors['bd_color']};
}

#tribe-bar-form input[type="text"]{
    border-color: {$colors['input_bd_color']};
}
#tribe-bar-form input[type=text]:focus,
#tribe-bar-form input[type=text]:hover,
#tribe-bar-form input[type=text]:active{
     border-color: {$colors['input_bd_hover']};
}

#tribe-bar-views-toggle{
     background-color: {$colors['text_hover']};
}

#tribe-bar-form .tribe-bar-submit input[type=submit]:hover,
#tribe-bar-views-toggle:hover{
    background-color: {$colors['text_link3']};
}

#tribe-bar-views-toggle{
    color: {$colors['extra_dark']};
}

#tribe-events-content .tribe-events-calendar td > div{
    border-color: {$colors['input_bd_color']};
}

#tribe-events-footer .tribe-events-sub-nav li > a:hover{
    background-color: {$colors['text_link2']};
}

#tribe-events .tribe-events-button, .tribe-events-button{
    background-color: {$colors['text_link2']};
}

#tribe-events .tribe-events-button:hover, .tribe-events-button:hover,
.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]{
     background-color: {$colors['alter_bg_hover']};
}
.tribe-events-calendar td div[id*=tribe-events-daynum-] a{
    color: {$colors['extra_dark']} !important;
}
.tribe-events-calendar div[id*=tribe-events-daynum-] a:hover,
#tribe-events-content .tribe-events-calendar td.tribe-events-present, 
 #tribe-events-content .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a {
     color: {$colors['alter_dark']};
}

.recurring-info-tooltip, .tribe-events-calendar .tribe-events-tooltip, .tribe-events-shortcode.view-week .tribe-events-tooltip, .tribe-events-week .tribe-events-tooltip{
 background-color: {$colors['alter_bg_color']};
}
.tribe-events-tooltip .tribe-events-arrow{
border-top-color: {$colors['alter_bg_color'] };
}

#tribe-bar-form.tribe-bar-collapse .tribe-bar-filters{
     background-color: {$colors['extra_dark']};
}
 .tribe-events-calendar .mobile-active.tribe-events-past div[id*=tribe-events-daynum-], 
 .tribe-events-calendar .mobile-active.tribe-events-past div[id*=tribe-events-daynum-]>a{
    color: {$colors['text_hover2']} 
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

.sticky .label_sticky{
    background-color: {$colors['text_hover2']} ;
}

.tribe-events-calendar .mobile-active.tribe-events-has-events:after{
    background-color: {$colors['text_hover2']} ;
}  

.tribe-common .tribe-common-c-loader .tribe-common-c-loader__dot {
    background-color: {$colors['text_link']};
}


.tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.tribe-common .tribe-common-c-btn:hover, .tribe-common a.tribe-common-c-btn:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.tribe-events .tribe-events-c-ical__link {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.tribe-events .tribe-events-c-ical__link:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
button.tribe-events-c-top-bar__datepicker-button {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color_0']};
}
.tribe-events .tribe-events-c-view-selector__list-item--active .tribe-events-c-view-selector__list-item-text,
.tribe-events .tribe-events-c-view-selector__list-item-link:focus .tribe-events-c-view-selector__list-item-text, 
.tribe-events .tribe-events-c-view-selector__list-item-link:hover .tribe-events-c-view-selector__list-item-text {
	color: {$colors['text_link']};
}
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-view-selector--tabs .tribe-events-c-view-selector__list-item--active .tribe-events-c-view-selector__list-item-link:after {
	background-color: {$colors['text_link']};
}
.tribe-events .datepicker table th {
	background-color: {$colors['bg_color_0']};
}
.tribe-events .datepicker .day.active, .tribe-events .datepicker .day.active.focused, .tribe-events .datepicker .day.active:focus, .tribe-events .datepicker .day.active:hover, .tribe-events .datepicker .month.active, .tribe-events .datepicker .month.active.focused, .tribe-events .datepicker .month.active:focus, .tribe-events .datepicker .month.active:hover, .tribe-events .datepicker .year.active, .tribe-events .datepicker .year.active.focused, .tribe-events .datepicker .year.active:focus, .tribe-events .datepicker .year.active:hover {
	background-color: {$colors['text_link']};
}
.tribe-events .datepicker .day.focused, .tribe-events .datepicker .day:focus, .tribe-events .datepicker .day:hover, .tribe-events .datepicker .month.focused, .tribe-events .datepicker .month:focus, .tribe-events .datepicker .month:hover, .tribe-events .datepicker .year.focused, .tribe-events .datepicker .year:focus, .tribe-events .datepicker .year:hover {
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_link']};
}
.tribe-events .datepicker .datepicker-switch:focus, .tribe-events .datepicker .datepicker-switch:hover {
	color: {$colors['text_link']};
}

.tribe-common .tribe-common-anchor-alt {
	color: {$colors['text_dark']};
	border-bottom-color: {$colors['text_dark']};
}
.tribe-common .tribe-common-anchor-alt:hover {
	color: {$colors['text_link']};
	border-bottom-color: {$colors['text_link']};
}
.tribe-events .tribe-events-c-events-bar__search-button:before,
.tribe-events .tribe-events-c-view-selector__button:before {
	background-color: {$colors['text_link']};
}
.tribe-common .tribe-common-form-control-text__input {
	border-color: {$colors['bg_color_0']};
}
.tribe-events .tribe-events-c-view-selector__content {
	background-color: {$colors['bg_color']};
}
.tribe-events .tribe-events-c-events-bar__search-filters-container,
.tribe-events .tribe-events-c-events-bar {
	background-color: {$colors['bg_color']};
}

.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner,
.tribe-events .tribe-events-calendar-month__multiday-event-bar {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.tribe-events .tribe-events-calendar-month__multiday-event-bar .tribe-events-calendar-month__multiday-event-bar-title {
	color: {$colors['inverse_link']};
}
.tribe-events .tribe-events-c-messages__message {
	background-color: {$colors['inverse_link']};
}
.tribe-events .tribe-events-calendar-month__day-date-link,
.tribe-events-calendar-month__day-date-daynum,
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__next, 
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__prev,
.tribe-events .tribe-events-calendar-month__header-column-title,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-events .tribe-events-calendar-list__event-date-tag-daynum,
.tribe-events .tribe-events-calendar-list__event-description,
.tribe-events .tribe-events-calendar-list__event-venue,
.tribe-events .tribe-events-calendar-list__event-title,
.tribe-events .tribe-events-calendar-list__event-datetime,
.tribe-events .tribe-events-calendar-day__event-datetime,
.tribe-events .tribe-events-calendar-day__event-title,
.tribe-events .tribe-events-calendar-day__event-venue,
.tribe-events .tribe-events-calendar-day__event-description {
	color: {$colors['text_dark']};
}

.tribe-events .tribe-events-c-nav__next, 
.tribe-events .tribe-events-c-nav__prev {
	color: {$colors['text_dark']};
}
.tribe-events .tribe-events-c-nav__next:hover, 
.tribe-events .tribe-events-c-nav__prev:hover {
	color: {$colors['text_link']};
}
.tribe-events-c-top-bar__nav-link[disabled],
.tribe-events-c-top-bar__nav-link[disabled]:hover, 
.tribe-events-c-top-bar__nav-link[disabled]:focus,
.tribe-events .tribe-events-calendar-month__day-cell--mobile,
.tribe-events-c-view-selector__button,
.tribe-events-c-events-bar__search-button  {
	background-color: {$colors['bg_color_0']}!important;
}
.tribe-events .tribe-events-calendar-month__mobile-events-icon--event {
	background-color: {$colors['text_link']};
}

.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link:focus, 
.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link:hover {
	color: {$colors['text_link']};
}
.tribe-events .tribe-events-calendar-list__event-row--featured .tribe-events-calendar-list__event-date-tag-datetime:after {
	background-color: {$colors['text_hover']};
}
.tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-list__event-datetime-featured-text {
	color: {$colors['text_link']};
}
.tribe-common.tribe-events .tribe-events-c-top-bar__datepicker-button {
	background-color: {$colors['bg_color_0']};
	color: {$colors['text_dark']}!important;
}
.tribe-events .tribe-events-calendar-list-nav li button[disabled],
.tribe-common button[disabled], 
.tribe-common input[disabled] {
	background: {$colors['text']}!important;
	color: {$colors['inverse_link']}!important;
}
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-top-bar__nav-link[disabled],
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-top-bar__nav-link[disabled]:hover {
	background: {$colors['bg_color_0']}!important;
}

.tribe-events-c-subscribe-dropdown__button:hover .tribe-events-c-subscribe-dropdown__button-text{
	color: {$colors['inverse_text']};
}

CSS;
		}

		return $css;
	}
}

