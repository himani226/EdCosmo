(function ($) {
	"use strict";
	///============= * Background Image n  =============\\\
	$("[data-background]").each(function() {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
	});

	///============= * Responsive Menu Icon n  =============\\\
	$(document).on("click", ".menu__bar i", function () {
		$(this).toggleClass('clicked');
		$('.menu__bar-popup').toggleClass('show');
	});
	$(document).on("click", ".menu__bar-popup-close", function () {
		$('.menu__bar i').removeClass('clicked');
		$('.menu__bar-popup').removeClass('show');
	});

	///============= * Responsive Menu n  =============\\\
	$('.menu-responsive').meanmenu({
		meanMenuContainer: '.responsive-menu',
		meanScreenWidth: '1050',
		meanMenuOpen: '<span></span><span></span><span></span>',
		meanMenuClose: '<i class="fal fa-times"></i>'
	});	

    ///============= * Header Sticky n  =============\\\
    $(window).on("scroll", function () {
        var scrollDown = $(window).scrollTop();
        if (scrollDown < 135) {
            $(".header__sticky").removeClass("header__sticky-sticky-menu");
        } else {
            $(".header__sticky").addClass("header__sticky-sticky-menu");
        }
    });

    ///============= * Search Icon Popup n =============\\\
	$(document).on("click", ".header__area-menubar-center-search-icon.open, .header__area-menubar-right-search-icon.open", function () {
		$(".header__area-menubar-center-search-box, .header__area-menubar-right-search-box")
		.fadeIn()
		.addClass("active");
	});
	$(document).on("click", ".header__area-menubar-center-search-box-icon, .header__area-menubar-right-search-box-icon", function () {
		$(this).fadeIn().removeClass("active");
	});
	$(document).on("click", ".header__area-menubar-center-search-box-icon i, .header__area-menubar-right-search-box-icon i", function () {
		$(".header__area-menubar-center-search-box, .header__area-menubar-right-search-box")
		.fadeOut()
		.removeClass("active");
	});

	///============= * Sidebar Popup n  =============\\\
	$(document).on("click", ".header__area-menubar-right-sidebar-popup-icon", function () {
		$('.header__area-menubar-right-sidebar-popup').addClass('active');
		$('.sidebar-overlay').addClass('show');
	});
	$(document).on("click", ".header__area-menubar-right-sidebar-popup .sidebar-close-btn", function () {
		$('.header__area-menubar-right-sidebar-popup').removeClass('active');
		$('.sidebar-overlay').removeClass('show');
	});

	

	///============= * Features Active Hover  =============\\\
	$(document).on("mouseenter", ".features-area-item", function () {
		$(".features-area-item").removeClass("features-area-item-hover");
		$(this).addClass("features-area-item-hover");
	});

	///============= * CounterUp n =============\\\
	var counter = $('.counter');
	counter.counterUp({
		time: 2500,
		delay: 100
	});


    ///============= * Theme Loader  =============\\\
    $(window).on("load", function () {
        $(".theme-loader").fadeOut(0.0009);
    });

	///============= * Isotope Filter  =============\\\
	$(window).on('load', function(){
		var $grid = $('.noxiy__filter-active').isotope();
		$('.noxiy__filter-button').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
				filter: filterValue
			});
		});
		$('.noxiy__filter-button').on('click', 'button', function () {
			$(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
		});
   });


	
    ///============= * Scroll To Top n =============\\\
	var scrollPath = document.querySelector(".scroll-up path");
	var pathLength = scrollPath.getTotalLength();
	scrollPath.style.transition = scrollPath.style.WebkitTransition = "none";
	scrollPath.style.strokeDasharray = pathLength + " " + pathLength;
	scrollPath.style.strokeDashoffset = pathLength;
	scrollPath.getBoundingClientRect();
	scrollPath.style.transition = scrollPath.style.WebkitTransition = "stroke-dashoffset 10ms linear";
	var updatescroll = function () {
		var scroll = $(window).scrollTop();
		var height = $(document).height() - $(window).height();
		var scroll = pathLength - (scroll * pathLength) / height;
		scrollPath.style.strokeDashoffset = scroll;
	};
	updatescroll();
	$(window).scroll(updatescroll);
	var offset = 50;
	var duration = 950;
	jQuery(window).on("scroll", function () {
		if (jQuery(this).scrollTop() > offset) {
			jQuery(".scroll-up").addClass("active-scroll");
		}
		else {
			jQuery(".scroll-up").removeClass("active-scroll");
		}
	});	
	jQuery(".scroll-up").on("click", function (event) {
	  	event.preventDefault();
	  	jQuery("html, body").animate(
			{ scrollTop: 0, } , duration
		);
	  	return false;
	});	
})(jQuery);