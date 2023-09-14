jQuery( document ).ready( function( $ ) {

	"use strict";

	/* START */

	/* Scroll to top */
	$('.btn-to-top').on( 'click', function() {
		$('html, body').animate( { scrollTop: 0 }, 500 );
		return false;
	} );

	/* Fitvids */
	$('.to_fit_vids').fitVids();
	/* */

	/* Added to avoid iframe confusion on Chrome, Safari and Opera */
	$('iframe').each( function() {
        this.src = this.src;
    } );
	/* */

	// Default WP Search Widget without Title
	if ( !$('.widget-item.widget_search').find( 'h2' ).contents().length ) { $('.widget-item.widget_search').css( { 'padding': 0, 'background' : 'none' } ); }
	if ( document.getElementById('s') !== null && document.getElementById('s_top') !== null ) {
		var searchPlaceholder = document.getElementById('s_top').value;
		document.getElementById('s').placeholder = searchPlaceholder;
	}

	// Custom Search box focus
	var souje_searchDefaultVal_custom = $('#swi-id').val();

	$('.search-widget-input').on( 'focus', function() {
		if ( $(this).val() == souje_searchDefaultVal_custom ) {
			$(this).val('');
		}
	} );

	$('.search-widget-input').on( 'focusout', function() {
		if ( $(this).val() == '' ) {
			$(this).val(souje_searchDefaultVal_custom);
		}
	} );

	$('.search-widget-icon').on( 'click', function() {
		window.location = $('#siteUrl').html() + '/?s=' + $(this).parent().find('.search-widget-input').val();
	} );

	/* Woo Commerce */
	$('.search-widget-s-pro-icon').click( function() {
		window.location = $('#siteUrl').html() + '/?s=' + $(this).parent().find('.search-widget-input').val() + '&post_type=product';
	} );
	/* */

	/* Top Search */
	var searchOpenBO = true;
	var souje_top_search_container = $( '.top-search' );

	// Top Search Button
	$( '.top-search-button' ).on( 'click', function() {
		$( '#site-menu' ).slicknav( 'close' );
		if ( searchOpenBO ) {
			searchOpenBO = false;
			souje_top_search_container.css( 'display', 'none' );
		} else {
			searchOpenBO = true;
			souje_top_search_container.css( 'display', 'block' );
		}
	} );

	/* Menu Button */
	$( '.mobile-menu-button' ).on( 'click', function() {
		$( '#site-menu' ).slicknav( 'toggle' );
		searchOpenBO = false;
		souje_top_search_container.css( 'display', 'none' );
	} );
	/* */

	/* Body Mouse Move */
	$( 'body' ).on( 'mousemove', function( event ) {
		if ( searchOpenBO && souje_top_search_container.width() ) {
			if ( event.pageX >= $( '.top-search-button' ).offset().left + 40 || event.pageY >= $( '.top-search-button' ).offset().top + 40 || event.pageY < $( '.top-search-button' ).offset().top - 40 ) {
				souje_top_search_container.css( 'display', 'none' );
				searchOpenBO = false;
			}
		} else {
			souje_top_search_container.css( 'display', 'none' );
			searchOpenBO = false;
		}
	} );
	/* */

	/* Apply Slicknav */
	var slicknav_apl = false;
	var slicknav_apl_check = Number( $( '#slicknav_apl' ).html() );
	if ( slicknav_apl_check ) { slicknav_apl = true; }

	$( '#site-menu' ).slicknav( {
		label: '',
		prependTo: '#touch-menu',
		allowParentLinks: slicknav_apl,
		closedSymbol: '<i class="fa fa-angle-right" style="font-size: 16px;"></i>',
		openedSymbol: '<i class="fa fa-angle-down" style="font-size: 16px;"></i>',
		init: souje_appendSocialIcons,
		open: souje_showSocialIcons,
	} );
	/* */

	/* Append social icons to Slicknav */
	function souje_appendSocialIcons() {
		if ( $('.header-social').html() != 'undefined' && $('.header-social').html() != undefined && $('.header-social').html() != '' ) {
			$('#touch-menu .slicknav_menu').append( '<div class="social-accounts-touch">' + $('.header-social').html() + '</div>' );
			$('.social-accounts-touch').hide();
		}
		if ( $('.top-search').html() != 'undefined' && $('.top-search').html() != undefined && $('.top-search').html() != '' ) {
			$('#touch-menu .slicknav_menu').append( '<div class="top-search-touch"><i class="fa fa-search"></i>' + $('.top-search').html() + '</div>' );
			$('.top-search-touch').hide();
		}
	}

	$('.mobile-menu-button').on( 'click', function() {
		$('.social-accounts-touch, .top-search-touch').hide();
	} );

	function souje_showSocialIcons() {
		$('.social-accounts-touch, .top-search-touch').show();
	}
	/* */

	// Top Search Box Focus
	if ( document.getElementById('s_top') !== null ) {
		var souje_topSearchDefaultVal_custom = $( '#s_top' ).val();

		$( '.top-search-input' ).on( 'focus', function() {
			if ( $( this ).val() == souje_topSearchDefaultVal_custom ) {
				$( this ).val( '' );
			}
		} );

		$( '.top-search-input' ).on( 'focusout', function() {
			if ( $( this ).val() == '' ) {
				$( this ).val( souje_topSearchDefaultVal_custom );
			}
		} );

		$( '.top-search-input' ).on( 'keyup', function( event ) {
			if ( event.which == 13 ) {
				//ENTER
				window.location = $( '#siteUrl' ).html() + '/?s=' + $( this ).val();
			}
		} );
	}
	/* */

	/* Sticky Menu Trigger */
	$( window ).on( 'scroll', function() {
		if ( $(this).scrollTop() > $( '#trigger-sticky-value' ).html() ) {
			$( '#sticky-menu' ).addClass( 'menu-sticky' );
		} else {
			$( '#sticky-menu' ).removeClass( 'menu-sticky' );
		}
	} );
	/* */

	/* Passive a style */
	$( '.menu-item-passive' ).find( 'a' ).removeAttr( 'href' );
	/* */

	/* Owl Slider */
	var owl_autoplay = Number( $( '#owl_autoplay' ).html() );
	var owl_duration = Number( $( '#owl_duration' ).html() );
	var owl_infinite = Number( $( '#owl_infinite' ).html() );
	var owl_nav = Number( $( '#owl_nav' ).html() );
	var owl_dots = Number( $( '#owl_dots' ).html() );

	$( '.owl-carousel' ).owlCarousel( {
		items: 1,
		navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
		navClass: ['owl-prev fading', 'owl-next fading'],
		dotClass: 'owl-dot fading',
		smartSpeed: 500,
		responsiveRefreshRate: 10,
		loop: owl_infinite,
		nav: owl_nav,
		autoplay: owl_autoplay,
		autoplayTimeout: owl_duration,
	} );
	/* */

	/* on Resize */
	function souje_resizing() {
		if( $( window ).width() <= 960 ) {
			souje_top_search_container.css( 'display', 'none' );
			searchOpenBO = false;
		}
	}
	$( window ).on( 'resize', souje_resizing );
	/* */

	/* END */

} );
