( function( $ ) {
    "use strict";

    var CL_FRONT = window.CL_FRONT || {};
    window.CL_FRONT = CL_FRONT;


    CL_FRONT.components = CL_FRONT.components || {};
    CL_FRONT.helpers = CL_FRONT.helpers || {};

    /**
     * Main Site Init
     * 
     * @since 1.0.0
     */
    CL_FRONT.siteInit = function() {
        "use strict";

        this.defaultConfig();
        this.bindEvents();
    };

    /**
     * Init Default Variables
     * 
     * @since 1.0.0
     */
    CL_FRONT.defaultConfig = function() {
        "use strict";

        this.config = {

            // Load dynamic scripts
            _loadedDependencies: [],
            _inQueue: {},

            // Default Config
            $window: $( window ),
            $document: $( document ),
            $windowWidth: $( window ).width(),
            $windowHeight: $( window ).height(),
            $windowTop:  typeof window.pageYOffset != 'undefined' ? window.pageYOffset: document.documentElement.scrollTop? document.documentElement.scrollTop: document.body.scrollTop? document.body.scrollTop:0,
            $containerWidth: 0,
            $containerOffsetLeft: 0,

            $html: $( 'html' ),
            $body: $( 'body' ),
            $viewport: $( '#viewport' ),
            $header: $( '.cl-header' ),
            $headerTools: $('.cl-header__tools'),
            $initSliders : {},
            $navigation: $( '#navigation' ),
            $responsiveMenu: null,
            $content: $( '#content' ),
            $aside: $( '#secondary' ),
            $main: $( '#main' ),

            $pageLayout: 'fullwidth',
            $headerHeight: 0,
            $layoutModern: false,
            $asideTop: 0,
            $asideHeight: 0,
            $asideArray: {},
            $asideStickyOffset: 0,

            $isMobileScreen: false,
            $isTabletScreen: false,
            $isDesktopScreen: false,

            $isMobileDevice: false,
            $isMobileOrTabletDevice: false,

            $isSmoothScroll: false,
            $isCustomizer: false,

            $headerToolsInit: false,
            $headerToolsList: [],
            $ilightboxes: {},

            $cssInQueue: {},
        }


    };

    /**
     * Bind Events of site
     * 
     * @since 1.0.0
     * @version 1.0.2
     */
    CL_FRONT.bindEvents = function() {
        "use strict";

        var self = this;

        // Document Ready
        self.config.$document.ready( function() {
            self.updateConfig();
            self.loadAsyncIcons();
            // Menu
            self.initMenuDropdown();
            self.initToolsDropdown(); 
            self.initMenuResponsive();
            self.initToolsResponsive();
            self.initHeaderStyles();
            self.initHeaderSticky();

            // Initialize Post Functionalities
            self.postInit();

            self.animations();
            

            self.isotopeBlogGrid();
            self.isotopePortfolioGrid();
            self.itemILightBox();

            self.nextPrevAjax();
            self.filtersAjax();
 
            // Various sizes and positions fixes
            self.fixModernLayoutWidth();
            self.fixCompatibilities();
            self.fixMegaMenuPosition();
            self.init_cl_page_header();

            if( ! self.config.$isCustomizer )
                self.codelessSlider();


            self.rowParallax();

            self.progressBar();
            self.mediaElement();
            self.codelessGMap();
            self.contactForm();
            self.codelessToggles();
            self.shopBtnClasses();
            self.instaFeed();

            self.codelessTabs();
            self.creativeSearch();
            //self.partialRefreshRendered();

            self.footerReveal();
            self.pageTransition();
            self.countdownElement();

            self.sideNav();
            
            self.loadOtherLazyload();

            self.onePageScroll();

            self.scrollToTopButton();
            self.scrollableSections();
            self.videoPostGallery();

            self.paginationInfiniteInitBlocks();

        } );

        // Window load
        self.config.$window.on( 'load', function() {
            self.postInstagram();
            self.livePhoto();
            self.convertSVGAnimated();
            self.rowParallax();
            self.shopBtnClasses();
        } );

        // Window Resize
        self.config.$window.resize( function() {
            self.updateDimensions();
            self.initMenuResponsive();
            self.initToolsResponsive();
            self.fixModernLayoutWidth();
            self.stickySidebar();
            //self.stickyColumn();
            self.fixPageHeaderCenter();
            self.initHeaderSticky();

        } );

        // Window Scroll
        self.config.$window.scroll( function() {
            self.config.$windowTop =  typeof window.pageYOffset != 'undefined' ? window.pageYOffset: document.documentElement.scrollTop? document.documentElement.scrollTop: document.body.scrollTop? document.body.scrollTop:0;;
            self.stickySidebar();
            //self.stickyColumn();
        } );

        // Window on Orientation Change Tablets
        self.config.$window.on( 'orientationchange', function() {
            self.updateDimensions();
            self.initMenuResponsive();
            self.initToolsResponsive();
            self.fixPageHeaderCenter();
            self.footerReveal();
        } );

        self.config.$window.on( 'click',  function() {
            // Close Shares on outside click
            self.postCloseShares()
        } );


    };

    /**
     * Update Config Dom
     * 
     * @since 1.0.0
     */
    CL_FRONT.updateConfig = function() {
        this.config.$html = $( 'html' );
        this.config.$body = $( 'body' );
        this.config.$viewport = $( '#viewport' );
        this.config.$header = $( '.cl-header' );
        this.config.$navigation = $( '.cl-header__navigation' );
        this.config.$headerTools = $('.cl-header__tools');
        this.config.$content = $( '#content' );
        this.config.$aside = $( '#secondary' );
        this.config.$asideArray = {};
        this.config.$main = $( '#main' );

        this.config.$pageLayout = this.config.$content.hasClass( 'cl-layout-left_sidebar' ) ? 'left_sidebar' :
            this.config.$content.hasClass( 'cl-layout-right_sidebar' ) ? 'right_sidebar' :
            this.config.$content.hasClass( 'cl-layout-dual' ) ? 'dual_sidebar' : 'fullwidth';

        if ( this.config.$content.hasClass( 'cl-layout-modern' ) )
            this.config.$layoutModern = true;

        this.config.$isMobileDevice = this.mobileDeviceCheck();
        this.config.$isMobileOrTabletDevice = this.mobileOrTabletDeviceCheck();

        this.config.$isSmoothScroll = this.config.$body.hasClass( 'cl-smoothscroll' ) ? true : false;

        if( $('.cl_counter').length > 0 )
            this.preloadOdometer();

        this.updateDimensions();
    };

    /**
     * Check if page is loaded from mobile
     * 
     * @since 1.0.0
     */
    CL_FRONT.mobileDeviceCheck = function() {
        var check = false;
        ( function( a ) {
            if ( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test( a ) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test( a.substr( 0, 4 ) ) ) check = true;
        } )( navigator.userAgent || navigator.vendor || window.opera );
        return check;
    }


    /**
     * Check if page is loaded from mobile or tablet
     * 
     * @since 1.0.0
     */
    CL_FRONT.mobileOrTabletDeviceCheck = function() {
        var check = false;
        ( function( a ) {
            if ( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test( a ) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test( a.substr( 0, 4 ) ) ) check = true;
        } )( navigator.userAgent || navigator.vendor || window.opera );
        return check;
    }


    /**
     * Update Dimension of page, used on screen resize
     * 
     * @since 1.0.0
     */
    CL_FRONT.updateDimensions = function() {
        this.config.$windowWidth = $( window ).width();
        this.config.$windowHeight = $( window ).height();

        if ( window.matchMedia ) {
            this.config.$isMobileScreen = window.matchMedia( '( max-width: 767px )' ).matches;
            this.config.$isTabletScreen = window.matchMedia( '( min-width: 768px ) and (max-width: 991px)' ).matches;
            this.config.$isDesktopScreen = window.matchMedia( '( min-width: 992px )' ).matches;
        } else {
            this.config.$isMobileScreen = this.config.$windowWidth <= 768;
            this.config.$isTabletScreen = this.config.$windowWidth > 768 && this.config.$windowWidth <= 991;
            this.config.$isDesktopScreen = this.config.$windowWidth > 992;
        }

        this.config.$containerWidth =  this.config.$header.hasClass('header-top') ? this.config.$header.find( '.header-row-inner' ).width() : this.config.$content.find( '.container' ).width();
        if( this.config.$header.hasClass('header-top') ){
            this.config.$containerOffsetLeft = this.config.$header.find( '.c-left.header-col' ).length > 0 ? this.config.$header.find( '.c-left.header-col' ).offset().left : this.config.$content.find( '.container' ).offset().left - 15;
        }else
            this.config.$containerOffsetLeft = 0;

        
        var container_offset = this.config.$content.find( '.container' ).length > 0 ?  this.config.$content.find( '.container' ).offset().left : 0
        this.config.$containerOffsetLeft = this.config.$header.hasClass('header-top') ? this.config.$header.find( '.c-left.header-col' ).offset().left : container_offset - 15;
        this.config.$headerHeight = this.config.$header.height();
      
        
        
    }


    CL_FRONT.fixCompatibilities = function(){
        if( bowser.msie && bowser.version <= 9 ){
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.requestAnimationFrame.js'], function(){

            });

            CL_FRONT.config.$html.addClass('no-cssanimations');
        }
    }

    /**
     * Initialize Menu in Responsive
     * 
     * @since 1.0.0
     */

    CL_FRONT.initMenuResponsive = function() {
        "use strict";
        var self = this;

        if( this.config.$windowWidth <= 991 && this.config.$responsiveMenu === null ){

            

            if( this.config.$navigation.closest('.cl-fullscreen-overlay-menu').length == 0 )
                this.config.$navigation.addClass('cl-hide-on-mobile');
            else{
                this.config.$navigation.addClass('cl-header__navigation--vertical').addClass('cl-mobile-menu');
                return;
            }

            this.config.$responsiveMenu = this.config.$navigation.clone().appendTo(this.config.$header);
            this.config.$responsiveMenu.removeClass( 'cl-hide-on-mobile' ).addClass( 'cl-mobile-menu' );

            if( this.config.$body.hasClass('cl-header-incontainer') )
                this.config.$responsiveMenu.addClass('container'); 

            $( '.cl-header__mobile-button' ).on( 'click', function( ){
                var button = $(this);
                button.toggleClass( 'open' );
                self.config.$responsiveMenu.slideToggle('200');         
                CL_FRONT.animations( self.config.$responsiveMenu , true );

            } );

            $( '.cl-header__menu li.has-submenu > a', this.config.$responsiveMenu ).on( 'click', function( e ){
                var li = $(this).parent();
                e.preventDefault();
                
                li.toggleClass('open');
                li.parent().find('li').not(li).removeClass('open');             
                li.children( '.sub-menu, .cl-header__menu__megamenu' ).slideToggle('300');

            } );

            $( '.cl-header__menu .cl-header__menu__megamenu > ul > li.has-submenu', this.config.$responsiveMenu ).on( 'click', function( e ){
                var li = $(this),
                    element = e.target || e.srcElement;

                if( element.nodeName != 'A' ){
                    li.toggleClass('open');
                    li.parent().find('li').not(li).removeClass('open');

                    li.children( '.sub-menu' ).slideToggle('300');
                }
                
                
            } );

        }else{

            if( this.config.$responsiveMenu != null )
                this.config.$responsiveMenu.addClass('cl-hide-not-mobile');

        }

        if( this.config.$windowWidth > 991 )
            this.config.$header.removeClass('cl-responsive-header');
        else
            this.config.$header.addClass('cl-responsive-header');
    }


    CL_FRONT.scrollToTopButton = function(){
        "use strict";

        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        
        //Click event to scroll to top
        $('.scrollToTop').on( 'click', function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    }


    /**
     * This function init all related functions of a specific header or menu style 
     *
     * @since 1.0.0
     */
    CL_FRONT.initHeaderStyles = CL_FRONT.init_cl_header_menu =  function(){
        "use strict";

        // Hamburger - overlay
        if( $('.cl-fullscreen-overlay').length > 0 ){
            CL_FRONT.fullscreenOverlayMenu();
        }else if( this.config.$header.hasClass('header-left') || this.config.$header.hasClass('header-right') ) {
            CL_FRONT.initHeaderSide();
        }

        
    },


    CL_FRONT.scrollableSections = function(){
        "use strict";
        if( $( '.cl-scrollable' ).length == 0 )
            return;

        $( '.cl-scrollable' ).nanoScroller({ 
            paneClass: 'cl-scrollable__pane',
            sliderClass: 'cl-scrollable__slider',
            contentClass: 'cl-scrollable__content'
        });
    },




    /**
     * Init Header Sticky
     *
     * @since 1.0.0
     * @version 1.0.8
     */
    CL_FRONT.initHeaderSticky = function(){
        "use strict";

        if( ! this.config.$header.hasClass( 'cl-header--sticky' ) )
            return;

        var is_active = false;
        

        if( !CL_FRONT.config.$header.hasClass('cl-header--transparent') && CL_FRONT.config.$isDesktopScreen ){

            var header_height = CL_FRONT.config.$header.height();
            

        }else{

            CL_FRONT.config.$main.css({

                 marginTop: '0px',

            });
        }

        var breakpoint = $( '.cl-header__row--main' ).outerHeight();
        if( $( '.cl-header__row--top' ).length > 0 )
            breakpoint += $( '.cl-header__row--top' ).outerHeight();

        if( $( '.cl-header__row--extra' ).length > 0 )
            breakpoint += $( '.cl-header__row--extra' ).outerHeight();

        $('.cl-header__padding').css( {paddingTop: breakpoint} );

        var onScroll = function(){

            if( ! CL_FRONT.config.$header.hasClass( 'cl-header--sticky' ) )
                return;

            var stickyContentColor = CL_FRONT.helpers.parseData( CL_FRONT.config.$header.attr('data-sticky-content-color'), 'dark' );
            var site_header = CL_FRONT.config.$body.hasClass('cl-header-light') ? 'light' : 'dark';
    
            if( CL_FRONT.config.$windowTop > breakpoint+200 && !is_active ){

                CL_FRONT.config.$header.addClass('cl-header--sticky-prepare');

                if( stickyContentColor == 'dark' )
                    CL_FRONT.config.$header.removeClass('cl-header--light');
                if( stickyContentColor == 'light' && site_header == 'dark' )
                    CL_FRONT.config.$header.addClass('cl-header--light');

                
                setTimeout( function(){
                    CL_FRONT.config.$header.addClass('cl-header--sticky-active');                
                    is_active = true;
                }, 100);
                

            }else if( CL_FRONT.config.$windowTop <= breakpoint+200 && is_active ) {

                CL_FRONT.config.$header.removeClass('cl-header--sticky-prepare');


                if( site_header == 'dark' ){
                    CL_FRONT.config.$header.removeClass('cl-header--light');

                }
                else if( site_header == 'light' && ! CL_FRONT.config.$header.hasClass('cl-header--light') )
                    CL_FRONT.config.$header.addClass('cl-header--light');


                setTimeout( function(){
                    CL_FRONT.config.$header.removeClass('cl-header--sticky-active');
                    CL_FRONT.config.$header.removeClass('cl-header--sticky-prepare');    
                    is_active = false;
               }, 100);
            }
        }

        window.addEventListener('scroll', onScroll, false);
    },


    /**
     * Bind hamburger click and open overlay
     *
     * @since 1.0.0
     * @version 1.0.6
     */
    CL_FRONT.fullscreenOverlayMenu = function(){
        "use strict";

        CL_FRONT.subMenuOnClick( $('.cl-fullscreen-overlay__menu') );

        $('.cl-fullscreen-overlay__close').on('click', function(e){
            e.preventDefault();
            var $overlay = $(this).closest( '.cl-fullscreen-overlay' );
            $overlay.removeClass('cl-fullscreen-overlay--open');

            setTimeout(function(){
                $overlay.css('display', 'none');
            }, 350);
        });

        $('.cl-header__hamburger-button').on('click', function(){
            $('.cl-fullscreen-overlay').css('display', 'block');
            setTimeout(function(){
                $('.cl-fullscreen-overlay').addClass('cl-fullscreen-overlay--open');
            }, 50);

            setTimeout(function(){
                CL_FRONT.animations( $('.cl-header__menu', $( '.cl-fullscreen-overlay' )), true );
            }, 300);
            
        });

        
        
    },  


    CL_FRONT.subMenuOnClick = function( $menu ){
        $('.menu-item-has-children > a', $menu).on( 'click', function(e){
            e.preventDefault();

            var $li = $(this).parent();
            var $submenu = $li.find( '> .sub-menu' );
            var $all_li = $menu.find('.menu-item-has-children');

            if( $li.hasClass('open') ){
                $submenu.slideUp(300);
                $li.removeClass('open');
            }else{
                $all_li.removeClass('open');
                $all_li.find( '> .sub-menu' ).slideUp(300);

                $submenu.slideDown(300);
                $li.addClass('open');
            }
                
        } );
    },


    


    CL_FRONT.sideNav = function(){
        $('.cl-header__tool--side-menu .cl-header__tool__link').on( 'click', function(e){
            e.preventDefault();
            var $open_button = $(this);

            if( !$( '.cl-sidenav' ).hasClass('cl-sidenav--open') ){
                $( '.cl-sidenav' ).addClass('cl-sidenav--open');
            }
        })

        $('.cl-sidenav__close').on( 'click', function(e){
            e.preventDefault();
            var $close_button = $(this);

            if( $( '.cl-sidenav' ).hasClass('cl-sidenav--open') ){
                $( '.cl-sidenav' ).removeClass('cl-sidenav--open');
            }
        })
    }

    /** 
      * Page transition Effects
      *
      * @since 1.0.0
      */

     CL_FRONT.pageTransition  = function(){
        "use scrict";

        if( ! this.config.$viewport.hasClass( 'animsition' ) )
            return;

        $(".animsition").animsition({

            inClass               :   $(this).data('animsition-in'),
            outClass              :   $(this).data('animsition-out'),
            inDuration            :   $(this).data('animsition-in-duration'),
            outDuration           :   $(this).data('animsition-out-duration'),
            linkElement           :   'a:not([target="_blank"]):not([href^="#"]):not(.lightbox-gallery):not(.entry-link.lightbox):not([class^="ilightbox-"]):not(.zoom):not(.prettyphoto):not(.anchorSubmenu)'

        });

     }


    /**
     * Initialize Post
     * 
     * @since 1.0.0
     */
    CL_FRONT.postInit = function( $el ) {
        "use strict";

        this.postSwiper();
        this.postShareButtons( $el );
        this.postHideShowShare();
        this.postLike();
    };

    CL_FRONT.postHideShowShare = function( ){
        if( $('.cl-single-share-buttons').length == 0 || $( '#content.cl-layout-fullwidth' ).length == 0 )
            return;

        var $element = $('.cl-single-share-buttons'),
            height = $element.find('.cl-single-share-buttons__wrapper').height(),
            total_size = height - 200,
            breakpoints = {};

        $('.alignwide, .alignfull').each(function(index, t){
            breakpoints[index] = { top: $(this).offset().top, height: $(this).height() };
        });
        
        $(window).on( 'scroll', function(){
            var actualTop = $(this).scrollTop();
            var show = true;

            $.each( breakpoints, function(index, value){
                if( actualTop >= (value.top - height) && actualTop <= ( value.top + value.height ) )
                    show = false;
            });

            if( show ){
                if( $element.hasClass('cl-hide') )
                    $element.removeClass('cl-hide');
            }else{
                if( ! $element.hasClass('cl-hide') )
                    $element.addClass('cl-hide');
            }
            
        });

        
    };

    CL_FRONT.livePhoto = function(){
        "use strict";
        if($('#live_photo').length > 0){

            var myNewPlayer = LivePhotosKit.Player();
            // A Player built from a pre-existing element:
            LivePhotosKit.Player(document.getElementById('live_photo'));

        }
    }

    CL_FRONT.postInstagram = function() {
        $( '.entry-video .instagram-media' ).contents().find( '.EmbedCaption' ).remove();
        $( '.entry-video .instagram-media' ).contents().find( '.EmbedFooter' ).remove();
    }

    /**
     * Fix sidebar background Width
     * 
     * @since 1.0.0
     */
    CL_FRONT.fixModernLayoutWidth = function() {
        "use strict";

        if ( this.config.$layoutModern ) {

            if ( this.config.$pageLayout == 'right_sidebar' ) {
                var distance = this.config.$windowWidth - ( this.config.$aside.offset().left );
                $( '.cl-layout-modern-bg' ).width( ( distance + 10 ) + 'px' );
            }

            if ( this.config.$pageLayout == 'left_sidebar' ) {
                var distance = this.config.$aside.offset().left + this.config.$aside.width();
                $( '.cl-layout-modern-bg' ).width( ( distance + 35 ) + 'px' );
            }
        }
    }


    /**
     * Fix Height of custom Masonry Size
     * 
     * @since 1.0.0
     */
    CL_FRONT.fixPostMasonryHeight = function( $element ){
        "use strict";

        if( $( $element ).length > 0 ){
            var $wide = $( '.cl-msn-size-wide', $element ),
                $height = $( '.cl-msn-size-small', $element ).height() - 20; 

            $wide.css( { height: $height + 'px' } );
            $( 'img', $wide ).css( { height: $height + 'px' } );

        }
    }

    /**
     * Fix Height of custom Masonry Size
     * 
     * @since 1.0.0
     */
    CL_FRONT.fixPortfolioMasonryHeight = function( $element ){
        "use strict";

        if( $( $element ).length > 0 ){

            var $wide = $( '.cl-msn-size-wide', $element),
                $height = $( '.grid-holder', $wide ).height(),
                padd = typeof $wide.css('padding') !== 'undefined' ? $wide.css('padding') : '0px',

                padding = parseInt(padd.replace("px", "")) * 2;

            $wide.css( { height: $height + padding + 'px' } );

        }
    }

    /**
     * Close Share Buttons Div
     * 
     * @since 1.0.0
     */
    CL_FRONT.postCloseShares = function() {
        "use strict";

        if ( $( '.share-buttons' ).length ) {
            $( '.share-buttons' ).removeClass( 'show' );
            $( '.share-buttons' ).addClass( 'hidden' );
        }
    };


    /**
     * Post Like Button
     * 
     * @since 1.0.0
     */
    CL_FRONT.postLike = function() {
        "use strict";

        $( '.cl-entry__tool--likes .like' ).on( 'click', function( e ) {
            e.preventDefault();

            var $this = $( this ),
                $id = $this.attr( 'id' );

            if ( $this.hasClass( 'item-liked' ) ) return false;

            if ( $this.hasClass( 'item-inactive' ) ) return false;


            $.post( codeless_global.ajax_url, {
                action: 'codeless_post_like',
                post_id: $id
            }, function( data ) {
                $this.find( '.cl-entry__tool-count' ).html( data );
                $this.addClass( 'item-liked' );
            } );

            $this.addClass( 'item-inactive' );
            return false;
        } );
    };

    /**
     * Post Share Buttons SHOW/HIDE
     * 
     * @since 1.0.0
     */
    CL_FRONT.postShareButtons = function( $el ) {
        "use strict";

        var $elements = $( '.cl-entry__tool--share' );

        if ( typeof $el !== "undefined" )
            $elements = $( '.cl-entry__tool--share', $el );

        if ( $elements.length ) {

            // Open share-buttons on button click
            $elements.each( function( i ) {
                var $element = $( this );
                $( '.cl-entry__share-open', $element ).on( 'click', function( e ) {

                    e.stopPropagation();
                    e.preventDefault();

                    if ( $( '.cl-entry__share-container', $element ).hasClass( 'hidden' ) ) {
                        $( '.cl-entry__share-container', $element ).removeClass( 'hidden' );
                        setTimeout( function() {
                            $( '.cl-entry__share-container', $element ).addClass( 'show' );
                        }, 150 );
                    } else {
                        $( '.cl-entry__share-container', $element ).removeClass( 'show' );
                        setTimeout( function() {
                            $( '.cl-entry__share-container', $element ).addClass( 'hidden' );
                        }, 150 );
                    }

                } );
            } );
        }
    };



    CL_FRONT.videoPostGallery = function(){
        "use strict";

        $( '.cl-video-gallery__featured .cl-video-play' ).on('click', function(e){
            e.preventDefault();
            var $button = $(this),
                src = $button.attr('href'),
                $article = $button.closest('article')

            $article.addClass('cl-prepare-video');
            $article.find('.cl-entry__media').prepend('<div class="cl-md-loading"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div></div>');

            setTimeout( function(){
                $article.find('.cl-iframe-wrap').html($('<iframe>', {
                    src: src,
                    id:  'video-wrap',
                    frameborder: 0,
                    scrolling: 'no'
                    }));

                $article.find( '.cl-entry__media .cl-md-loading' ).remove();
            }, 100 );

        });

        $( '.cl-video-gallery__more .cl-video-play' ).on('click', function(e){
            e.preventDefault();
            var $button = $(this),
                src = $button.attr('href'),
                $article = $button.closest('.cl-video-gallery').find('.cl-video-gallery__featured article');
            
            $button.closest( '.cl-video-gallery__more' ).find('article').removeClass('cl-video-playing');
            $button.closest( 'article' ).addClass('cl-video-playing');
            $article.addClass('cl-prepare-video');
            $article.find('.cl-entry__media').prepend('<div class="cl-md-loading"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div></div>');

            setTimeout( function(){
                $article.find('.cl-iframe-wrap').html($('<iframe>', {
                    src: src,
                    id:  'video-wrap',
                    frameborder: 0,
                    scrolling: 'no'
                    }));
                $article.find( '.cl-entry__media .cl-md-loading' ).remove();

                
            }, 100 );

        });

    }



    /**
     * Post Slider Configuration and load
     * Used only for post slider
     * 
     * @since 1.0.0
     */
    CL_FRONT.postSwiper = function( $el ) {
        "use strict";

        var $elements = $el || $( '.cl-entry__gallery .cl-carousel' );
        if ( $elements.length ) {
            $elements.each( function( i ) {

                CL_FRONT.components.Carousel( $( this ), {
                    items:1,
                    margin:0,
                    autoHeight:true
                });

            } );
        }

    };


    CL_FRONT.loadAsyncIcons = function(){
        CL_FRONT.helpers.loadCSS(codeless_global.FRONT_LIB_CSS + 'codeless-icons.css');
    };

    /**
     * Slider Configuration and load
     *
     * 
     * @since 1.0.0
     */
    CL_FRONT.codelessSlider = function( $el ) {
        "use strict";

        var $elements = $el || $( '.cl_slider' );
        if ( $elements.length ) {
            $elements.each( function( i ) {

                var $element = $( this );
                var name = 'swiper.min.js';
                if( bowser.msie && bowser.version <= 9 )
                    name = 'swiper.old.min.js';

                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + name ], function() {
                    
                    var animateSlide = function( $slide ){

                        if( $slide.hasClass('cl-slide-animation') && ! $slide.hasClass('animation--none') )
                            $slide.addClass('start_animation');
                    };

                    var opts = {

                        onSlideChangeStart: function(swiper){
                            
                           
                                $(swiper.slides[swiper.activeIndex]).removeClass('start_animation');
                                $(swiper.slides[swiper.activeIndex]).find('.start_animation:not(.bg-layer)').removeClass('start_animation');
                            
                        },

                        onTransitionStart: function(swiper){
                                setTimeout(function(){
                                    if( CL_FRONT.config.$header.hasClass('cl-transparent') ){
                                    
                                        CL_FRONT.helpers.changeHeaderColor( $(swiper.slides[swiper.activeIndex]) );

                                        setTimeout(function(){
                                            if( ! CL_FRONT.config.$header.hasClass('cl-header-light') ){
                                                $('.cl-slider-nav', $element).removeClass('swiper-button-white');
                                                $('.swiper-pagination', $element).addClass('cl-dark-pagination');
                                            }
                                            else{
                                                $('.swiper-pagination', $element).removeClass('cl-dark-pagination');
                                                $('.cl-slider-nav', $element).addClass('swiper-button-white');
                                            }
                                        }, 50 );
                                    
                                    }
                                    animateSlide($(swiper.slides[swiper.activeIndex]));
                                    CL_FRONT.animations($(swiper.slides[swiper.activeIndex]), true);

                                }, 300);
                                
                           
                        },
                        onInit: function(swiper){
                            if( CL_FRONT.config.$header.hasClass('cl-transparent') ){
                                if( ! CL_FRONT.config.$header.hasClass('cl-header-light') ){
                                    $('.cl-slider-nav', $element).removeClass('swiper-button-white');
                                    $('.swiper-pagination', $element).addClass('cl-dark-pagination');
                                }
                                else{
                                    $('.swiper-pagination', $element).removeClass('cl-dark-pagination');
                                    $('.cl-slider-nav', $element).addClass('swiper-button-white');
                                }
                            }

                            animateSlide($(swiper.slides[swiper.activeIndex]));
                            CL_FRONT.animations($(swiper.slides[swiper.activeIndex]), true);
                            
                        },
                        
                        
                        parallax: true,
                        
                        speed: parseInt(CL_FRONT.helpers.parseData( $element.data('speed'), 300 )),
                        direction: CL_FRONT.helpers.parseData( $element.data('direction'), 'horizontal' ),
                        autoplay: parseInt(CL_FRONT.helpers.parseData( $element.data('clautoplay'), 0 )),
                        loop: parseInt( CL_FRONT.helpers.parseData( $element.data('loop'), false ) ),
                        mousewheelControl: parseInt( CL_FRONT.helpers.parseData( $element.data('mousewheel'), false ) ),
                        
                    };

                    

                    var cl_effect = {

                        effect: CL_FRONT.helpers.parseData( $element.data('effect'), 'fade' )

                    };

                    if( CL_FRONT.helpers.parseData( $element.data('effect'), 'fade' ) == 'interleave' && CL_FRONT.config.$windowWidth > 992 ){
                        var interleaveOffset = -.5;

                        if( CL_FRONT.helpers.parseData( $element.data('direction'), 'horizontal' ) == 'horizontal' ){

                            cl_effect = {

                                onProgress: function(swiper, progress){
            
                                    for (var i = 0; i < swiper.slides.length; i++){
                                      
                                      var slide = swiper.slides[i];
                                      var translate, innerTranslate;
                                      progress = slide.progress;
                                            
                                      if (progress > 0) {
                                        translate = progress * swiper.width;
                                        innerTranslate = translate * interleaveOffset;        
                                      }
                                      else {        
                                        innerTranslate = Math.abs( progress * swiper.width ) * interleaveOffset;
                                        translate = 0;
                                      }
                                            

                                      $(slide).css({
                                        transform: 'translate3d(' + translate + 'px,0,0)'
                                      });

                                      $(slide).find('.cl-row > .bg-layer').css({
                                        transform: 'translate3d(' + innerTranslate + 'px,0,0)'
                                      });
                                    }
                                },

                                onTouchStart: function(swiper){
                                    for (var i = 0; i < swiper.slides.length; i++){
                                      $(swiper.slides[i]).css({ transition: '' });
                                    }
                                },

                                onSetTransition: function(swiper, speed) {
                                    for (var i = 0; i < swiper.slides.length; i++){
                                      $(swiper.slides[i])
                                        .find('.cl-row > .bg-layer')
                                        .andSelf()
                                        .css({ transition: speed + 'ms' });
                                    }
                                }

                            };

                        }else{

                            cl_effect = {

                                onProgress: function(swiper, progress){
                                    
                                    for (var i = 0; i < swiper.slides.length; i++){
                                       
                                      var slide = swiper.slides[i];
                                      var translate, innerTranslate;
                                      progress = slide.progress;
                                            
                                      if (progress > 0) {
                                        translate = progress * swiper.height;
                                        innerTranslate = translate * interleaveOffset;        
                                      }
                                      else {        
                                        innerTranslate = Math.abs( progress * swiper.height ) * interleaveOffset;
                                        translate = 0;
                                      }
                                                

                                      $(slide).css({
                                        transform: 'translate3d(0,' + translate + 'px, 0)'
                                      });

                                      
                                    

                                      $(slide).find('.cl-row').css({
                                        transform: 'translate3d(0,' + innerTranslate + 'px, 0)'
                                      });
                                      
                                    }
                                },

                                onTouchStart: function(swiper){
                                    for (var i = 0; i < swiper.slides.length; i++){
                                      $(swiper.slides[i]).css({ transition: '' });
                                    }
                                },

                                onSetTransition: function(swiper, speed) {
                                    for (var i = 0; i < swiper.slides.length; i++){

                                      $(swiper.slides[i])
                                        .find('.cl-row')
                                        .andSelf()
                                        .css({ transition: speed + 'ms' });
                                    }
                                }

                            };

                        }
                       
                    }


                    if( CL_FRONT.helpers.parseData( $element.data('effect'), 'fade' ) == 'softscale'){
                        cl_effect = {

                
                            onSetTransition: function (s, duration) {
                                s.slides.transition(duration);
                                if (s.params.virtualTranslate && duration !== 0) {
                                    var eventTriggered = false;
                                    s.slides.transitionEnd(function () {
                                        if (eventTriggered) return;
                                        if (!s) return;
                                        eventTriggered = true;
                                        s.animating = false;
                                        var triggerEvents = ['webkitTransitionEnd', 'transitionend', 'oTransitionEnd', 'MSTransitionEnd', 'msTransitionEnd'];
                                        for (var i = 0; i < triggerEvents.length; i++) {
                                            s.wrapper.trigger(triggerEvents[i]);
                                        }
                                    });
                                }
                            },

                            onSlideChangeStart: function(swiper){
                                var active = swiper.activeIndex,
                                    prev = swiper.previousIndex;

                                if( ! $( swiper.slides[prev] ).find('.cl-row').hasClass('navOutNext') )
                                    $( swiper.slides[prev] ).find('.cl-row').addClass('navOutNext');

                                if( $( swiper.slides[active] ).find('.cl-row').hasClass('navInNext') )
                                    $( swiper.slides[active] ).find('.cl-row').removeClass('navInNext');
                                
                                $( swiper.slides[active] ).find('.cl-row').addClass('navInNext');

                                setTimeout(function(){
                                    $( swiper.slides[prev] ).find('.cl-row').removeClass('navOutNext');
                                    $( swiper.slides[active] ).find('.cl-row').removeClass('navInNext');
                                }, 1500);
                            }, 


                            effect: 'softscale',
                            virtualTranslate: true,
                            slidesPerView : 1,
                            watchSlidesProgress : true,
                            loop:false,
                            parallax: false,
                            spaceBetween : 0,

                        };
                    }

                    opts = $.extend(opts, cl_effect);



                    if( parseInt(CL_FRONT.helpers.parseData( $element.data('pagination'), 1 ) ) ){
                        opts['pagination'] = '.swiper-pagination';
                        opts['paginationClickable'] = true;
                    }
                    
                    if( parseInt(CL_FRONT.helpers.parseData( $element.data('navigation'), 1 ) ) ){
                        opts['nextButton'] = '.swiper-button-next';
                        opts['prevButton'] = '.swiper-button-prev';
                    } 

                    if( parseInt(CL_FRONT.helpers.parseData( $element.data('anchors'), 0 ) ) ){
                        opts['paginationBulletRender'] = function (swiper, index, className) {
                            var anchor = $(swiper.slides[index]).find('[data-anchor]').data('anchor');
                            return '<span class="' + className + '" data-label="'+ anchor +'"></span>';
                        }
                    } 


                    
                    var actualInstance = new Swiper( '.cl_slider', opts );
                    CL_FRONT.config.$initSliders[$element.attr('id')] = actualInstance;
                    

                    var animateOnScroll = function(){
                        var startPoint = $element.offset().top + ( $element.height() * 0.44 );
                       
                        if( CL_FRONT.config.$windowTop >= startPoint && ! $element.hasClass('cl-animateScroll') )
                            $element.addClass('cl-animateScroll');
                        else if( $element.hasClass('cl-animateScroll') && CL_FRONT.config.$windowTop < startPoint)
                            $element.removeClass('cl-animateScroll')

                    };
                    setTimeout(function(){
                        $(window).on('scroll', function(){  

                            if( CL_FRONT.helpers.parseData( $element.data('direction'), 'horizontal' ) == 'vertical' && CL_FRONT.config.$windowWidth < 992 )
                                return;
                            animateOnScroll();
                         });

                    }, 100);

                    var destroyed = false;

                    var verticalSliderResponsive = function(){
                        if( CL_FRONT.helpers.parseData( $element.data('direction'), 'horizontal' ) != 'vertical' || ! $element.hasClass('cl_slider-responsive-plain') )
                            return;
                        if( CL_FRONT.config.$windowWidth > 992 ){
                            
                            if( destroyed ){
                                actualInstance = new Swiper( '.cl_slider', opts );
                                CL_FRONT.config.$initSliders[$element.attr('id')] = actualInstance;
                            }

                            return;
                        }
                        
                        if( ! destroyed ){
                            actualInstance.destroy(false);
                            destroyed = true;
                            CL_FRONT.animations($element, true);
                        }
                        
                    }

                    

                    verticalSliderResponsive();

                    $(window).resize(function(){
                        verticalSliderResponsive();
                    })

                } );

            } );
        }

    };



    /**
     * Load More Button and Infinite Scroll
     * 
     * @since 1.0.0
     */
    CL_FRONT.paginationInfinite = function( $el ) {
        "use strict";

        var $elements = $el || $( '.cl-pagination-infinite' );
        if ( $elements.length ) {
            $elements.each( function( i ) {

                var $element = $( this );
                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'infinitescroll.js' ], function() {
                    
                    var $container = $('#' + $element.parent().data( 'containerId' )).find('.cl-items-container');
                    var iso = $container.data('isotope');
                    console.log(iso);

                    if( $element.hasClass('loadmore') ){

                        // Init Load more button
                        var infiniteData = {
                            
                            path: '#' + $element.parent().data( 'containerId' ) + ' .cl-pagination-infinite .older-posts a',
                            append: '#' + $element.parent().data( 'containerId' ) + ' .cl-entry',
                            loadOnScroll: false,
                            button: '#' + $element.parent().data( 'containerId' ) + ' #cl_load_more_btn',
                            status: '#' + $element.parent().data( 'containerId' ) + ' .page-load-status',
                            debug: true
                        };
                        $container.infiniteScroll( infiniteData );

                    }else{

                        // Init Infinite Scroll
                        $container.infiniteScroll({
                            path: '#' + $element.parent().data( 'containerId' ) + ' .cl-pagination-infinite .older-posts a',
                            append: '#' + $element.parent().data( 'containerId' ) + ' .cl-entry',
                            loadOnScroll: true,
                            outlayer: iso,
                            status: '#' + $element.parent().data( 'containerId' ) + ' .page-load-status'
                        });


                    }

                    $container.on( 'append.infiniteScroll', function( event, response, path, items ) {
                        CL_FRONT.postSwiper( $(items).find('.cl-entry__gallery .cl-carousel') ); 

                        
                        setTimeout(function(){
                            $container.isotope('arrange');
                            CL_FRONT.animations( $('#' + $element.parent().data( 'containerId' ) ) );
                        }, 50);
                        
                    });

                   

                } );

            } );
        }

    };

    CL_FRONT.paginationInfiniteInitBlocks = function(){
        "use strict";

        if( $('.cl-blog--module-grid-blocks').length > 0 ){
            $('.cl-blog--module-grid-blocks').each(function(){
                if( $(this).find( '.cl-pagination-infinite' ).length > 0 )
                    CL_FRONT.paginationInfinite( $(this).find( '.cl-pagination-infinite' ) );
            });
        }
    };


    CL_FRONT.nextPrevAjax = function(){
        "use strict";

        if( $('.cl-pagination-jump.ajax').length == 0 )
            return;

        var $next = $('.cl-pagination-jump.ajax').find('.older-posts a');
        var $prev = $('.cl-pagination-jump.ajax').find('.newer-posts a');

        var container_id = $('.cl-pagination-jump.ajax').parent().data('containerId');
        var $container = $('#'+container_id); 
        var $items_container = $('#'+container_id).find('.cl-items-container');

        $next.on('click', nextFunc);
        $prev.on('click', prevFunc);

        function nextFunc(e){
            e.preventDefault();

            var height = $items_container.height();
            $items_container.find( 'article' ).remove();
            $items_container.height(height + 'px');
            $items_container.prepend('<div class="cl-md-loading"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div></div>');

            $.get( $next.attr('href'), handleAjax, 'html' );
        }

        function prevFunc(e){
            e.preventDefault();

            var height = $items_container.height();
            $items_container.find( 'article' ).remove();
            $items_container.height(height + 'px');
            $items_container.prepend('<div class="cl-md-loading"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div></div>');
            
            $.get( $prev.attr('href'), handleAjax, 'html' );
        }

        function handleAjax(data){

            $items_container.find('md-preloader').remove();
            $items_container.html( $(data).find('#'+container_id).find('.cl-items-container').html() );
            $items_container.css('height', '');

            if( $container.hasClass('cl-blog--module-isotope') ){
                $('#'+container_id).find('.cl-items-container').isotope('destroy');
                setTimeout(function(){
                    CL_FRONT.isotopeBlogGrid( $('#'+container_id) );
                }, 10);
            }else{
                CL_FRONT.animations();
            }
            

            $('#'+container_id + ' .cl-blog-pagination').html( $(data).find( '#'+container_id + ' .cl-blog-pagination' ).html() );

            $next = $('.cl-pagination-jump.ajax').find('.older-posts a');
            $prev = $('.cl-pagination-jump.ajax').find('.newer-posts a');
            $next.on('click', nextFunc);
            $prev.on('click', prevFunc);
            CL_FRONT.postInit();
        }
    };


    CL_FRONT.filtersAjax = function(){
        "use strict";

        if( $('.cl-filter--ajax').length == 0 )
            return;
        
        var $buttons = $('.cl-filter--ajax a');
    

        $buttons.on( 'click', handleClick );

        function handleClick( e ){
            e.preventDefault();
            var $items_container = $(this).closest('.cl-blog').find('.cl-items-container');

            var container_id = $items_container.parent().attr('id');

            $buttons.removeClass('active');
            var height = $items_container.height();
            $items_container.find( 'article' ).remove();
            $items_container.height(height + 'px');
            $items_container.prepend('<div class="cl-md-loading"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="48" width="48" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="6"/></svg></div></div>');
           
         

            $.get( $(this).attr('href'), function(data){

                
                $items_container.find('md-preloader').remove();
                $items_container.html( $(data).find('#'+container_id + ' .cl-items-container').html() );
                $items_container.css('height', '');
                if( $items_container.parent().hasClass('cl-blog--module-isotope') ){
                    

                    $('#'+container_id + ' .cl-items-container').isotope('destroy');

                    setTimeout(function(){
                        CL_FRONT.isotopeBlogGrid( $('#'+container_id) );
                    }, 10);
                }else{
                    CL_FRONT.animations();
                }

            

                $('[data-container-id="'+container_id + '"].cl-blog-pagination').html( $(data).find( '[data-container-id="'+container_id + '"].cl-blog-pagination' ).html() );

                setTimeout( function(){

                    CL_FRONT.isotopeBlogGrid( $('#'+container_id) );
                    CL_FRONT.nextPrevAjax();
                }, 100);

            }, 'html' );

            $(this).addClass('active');
        }
    }


    /**
     * Blog Grid and Masonry Isotope
     * Use the Isotope component
     * 
     * @since 1.0.0
     */
    CL_FRONT.isotopeBlogGrid = function( $el ) {
        "use strict";
        var $blog = $el;
        if( typeof $el === 'undefined' )
            $blog = $('.cl-blog');
            
        

        $blog.each(function(){
            var $blog_items_list = $(this).find( '.cl-items-container' );
            if( $(this).hasClass('cl-blog--module-carousel') ){
               
                    CL_FRONT.components.Carousel( $blog_items_list , false, function(owl, el){
                        CL_FRONT.postSwiper(el);
                        owl.on('resized.owl.carousel', function(event){
                            CL_FRONT.animations( el.find( '.owl-item.active' ), true ); 
                        });          
                    });
              
                

            }else if( $(this).hasClass('cl-blog--module-isotope') ){
                CL_FRONT.components.Isotope( $blog_items_list , function(){
                    
                } );
            }
                

        });
        
    };

    /**
     * Isotope Portfolio Init
     * used on Customizer too
     * 
     * @since 1.0.0
     */
    CL_FRONT.isotopePortfolioGrid = CL_FRONT.init_cl_portfolio = function( $el ) {
        "use strict";
        $( '.cl-portfolio .cl-portfolio__items' ).each(function(){
            if( $(this).hasClass('cl-carousel') )
                CL_FRONT.components.Carousel( $( this ) );
            else if( $(this).hasClass('cl-justify-gallery') )
                CL_FRONT.components.JustifyGallery( $( this ) );
            else
                CL_FRONT.components.Isotope( $( this ) );

        });

        if( CL_FRONT.config.$isMobileScreen ){
           $('.portfolio_item .entry-link').attr('onClick', 'return false');
           $('.portfolio_item').each(function(){
              $(this).on('mousemove', function(){
                 if( parseInt( $(this).find( '.entry-overlay' ).css('opacity') ) == 1 ){
                      
                        $(this).find('.entry-link').attr('onClick', '');
                 }
                    else
                      $(this).find('.entry-link').attr('onClick', 'return false');
                })
            })
        }

        
    };

   

    CL_FRONT.codelessToggles = CL_FRONT.init_cl_toggles = function(){
        "use strict";
        $('.cl_toggles').each(function(){
            var $toggles = $(this);
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.collapse.js' ], function() {

                $toggles.collapse({
                   open: function() {
                    // The context of 'this' is applied to
                    // the collapsed details in a jQuery wrapper
                    this.slideDown(200);
                  },
                  close: function() {
                    this.slideUp(200);
                  },
                  accordion: CL_FRONT.helpers.parseData( $toggles.attr('data-accordion'), false ),
                  query: '.cl_toggle .title'
                });           
            });
        });
    };


    /**
     * Sticky Sidebar Function
     * 
     * @since 1.0.0
     */
    CL_FRONT.stickySidebar = function() {
        "use strict";

        $('.cl-sticky').each(function(index, e){
            if( !CL_FRONT.config.$isMobileScreen ){

                if(  typeof CL_FRONT.config.$asideArray[index] == 'undefined' )
                    CL_FRONT.config.$asideArray[index] = { height: 0, top: 0, stickyOffset: 0, current_window: 0 };
                
                if( CL_FRONT.config.$asideArray[index].height == 0 )
                    CL_FRONT.config.$asideArray[index].height = $(this).data( 'stickyOffset' ) != 0 ? $(this).height() + $(this).offset().top - $(this).find( '.widget:nth-last-child(' + parseInt( $(this).data( 'stickyOffset' ) ) + ')' ).offset().top : $(this).height();
                
                if( CL_FRONT.config.$asideArray[index].top == 0 )
                    CL_FRONT.config.$asideArray[index].top = $(this).offset().top;

                if( CL_FRONT.config.$asideArray[index].stickyOffset == 0 )
                    CL_FRONT.config.$asideArray[index].stickyOffset = $(this).data( 'stickyOffset' ) != 0 ? $(this).find( '.widget:nth-last-child(' + parseInt( $(this).data( 'stickyOffset' ) ) + ')' ).offset().top : 0;
                                    
                var cl_distace = 80,
                    cl_point = 0;

                if ( CL_FRONT.config.$asideArray[index].stickyOffset != 0 )
                    cl_point = CL_FRONT.config.$asideArray[index].stickyOffset;
                else
                    cl_point = CL_FRONT.config.$asideArray[index].top - cl_distace;

            
                $(this).find( '.cl-sticky-wrapper' ).width( $(this).width() + 'px' );
                
                var $content_container = $('.content-col');
                if( $(this).closest( '.wpb_row' ).length > 0 )
                    $content_container = $(this).closest( '.wpb_row' );
                var content_offset = $content_container.offset().top + $content_container.height();

                    
                if( content_offset > ( CL_FRONT.config.$windowTop + CL_FRONT.config.$asideArray[index].height ) ){
                    if ( CL_FRONT.config.$windowTop >= cl_point ) {
                        $(this).addClass( 'cl-sticky-active' );
                        $(this).find( '.cl-sticky-wrapper' ).css( 'top', '-' + ( cl_point - CL_FRONT.config.$asideArray[index].top ) + 'px' );
                        CL_FRONT.config.$asideArray[index].current_top = ( cl_point - CL_FRONT.config.$asideArray[index].top );

                    } else {
                        $(this).find( '.cl-sticky-wrapper' ).css( 'top', cl_distace + 'px' );
                        $(this).removeClass( 'cl-sticky-active' );
                    }
                }else{
                    if(  CL_FRONT.config.$asideArray[index].current_window == 0 )
                        CL_FRONT.config.$asideArray[index].current_window = CL_FRONT.config.$windowTop;
                    
                    var plus_offset = CL_FRONT.config.$windowTop - CL_FRONT.config.$asideArray[index].current_window;
                    if( plus_offset < 0 )
                        plus_offset = 0;

                    $(this).find( '.cl-sticky-wrapper' ).css('top',-(CL_FRONT.config.$asideArray[index].current_top + plus_offset) );
                }
            }
        });
    }


    /**
     * Sticky Column Function
     *
     * @since 1.0.0
     *
     */


    CL_FRONT.stickyColumn = function() {
        "use strict";

        if(!this.config.$isMobileScreen && $('.cl-sticky.cl_column').length > 0){
       
            $('.cl-sticky.cl_column').each( function(){
                var $sticky = $(this),
                    stickyTop = 0,
                    stickyHeight = 0;

                
                stickyHeight = $sticky.height();

                stickyTop = $sticky.offset().top;

               
                var cl_distace = 0,
                    cl_point = 0;

                cl_point = stickyTop - cl_distace;

                $sticky.find( '.cl_col_wrapper ' ).width( $sticky.width() + 'px' );

                if ( CL_FRONT.config.$windowTop >= cl_point ) {
                    $sticky.addClass( 'cl-sticky-active' );
                    $sticky.find( '.cl_col_wrapper' ).css( 'top', '-' + ( cl_point - stickyTop ) + 'px' );

                } else {
                    $sticky.find( '.cl_col_wrapper' ).css( 'top', cl_distace + 'px' );
                    $sticky.removeClass( 'cl-sticky-active' );
                }

            
            });   
        }    
    }

    
    /**
     * Progress Bar Function
     *
     * @since 1.0.0
     *
     */

    CL_FRONT.progressBar = function($el){
        "use strict";

        var from_start = $el == null ? true : false;
        var $elements = CL_FRONT.helpers.parseData( $el, $( '.cl_progress_bar' ) );
       
        if( $elements.length > 0 ){
            $elements.each(function(){

                var $element = $(this),
                    percentage = $element.attr('data-percentage');

                if( from_start && $element.hasClass('cl-animate-on-visible') )
                    return;

                $element.find('.percentage').html(percentage+'%');
                $element.find('.bar').css('width', percentage+'%');
            });
        }
    };


    CL_FRONT.mediaElement = CL_FRONT.init_cl_media = function(){
        "use strict";

        if( $('.cl_media.type-video').length > 0 ){
            $('.cl_media.type-video').each(function(){
                
                var $element = $(this),
                    $play = $element.find( '.play-button' ),
                    $isPlay = ($play.length > 0) ? true : false;

                if( $isPlay ){

                    $element.addClass('hide-video');

                    setTimeout(function(){
                        var height = $element.find( 'iframe, video' ).height();
                        $element.height(height);
                    }, 50);

                    $play.on('click', function(e){
                        e.preventDefault();

                        $element.find( 'source, iframe' ).each(function(){
                            var src = $(this).attr('data-src');
                            $(this).attr('src', src);
                        });

                        setTimeout(function(){
                            $element.addClass('show-video');
                        }, 100);
                        

                    });
                }else{
                    $element.find( 'source, iframe' ).each(function(){
                        var src = $(this).attr('data-src');
                        $(this).attr('src', src);
                    });
                }



            });
        }


       

    };


    /**
     * Init Page Header Element
     * Used on Codeless Builder Too
     * @since 1.0.0
     */
    CL_FRONT.init_cl_page_header = function(){
        
        this.fixPageHeaderCenter();
        CL_FRONT.components.loadAnimation( $( '.cl_page_header' ), function(){
            CL_FRONT.pageHeaderParallax();
        } );     

    };

    /**
     * Page Header Parallax
     * Loads the Parallax component
     * @since 1.0.0
     */

    CL_FRONT.pageHeaderParallax = function() {
        "use strict";

        if ( $( '.cl_page_header.cl-parallax .bg-layer' ).length > 0 )
            CL_FRONT.components.Parallax( $( '.cl_page_header.cl-parallax .bg-layer' ) ).init();
    };
    

    CL_FRONT.fixPageHeaderCenter = function(){
        if( this.config.$header.hasClass('cl-transparent') && $( '.cl_page_header'  ).length > 0 ){
            var $pageHeader = $( '.cl_page_header'  );   
            
            if( $pageHeader.hasClass('modern') )
                $pageHeader.css( { paddingTop: (this.config.$headerHeight / 2) + 'px' } ); 
        }
    }


    /**
     * Fix Megamenu Position when is out from container
     * @since 1.0.0
     */
    CL_FRONT.fixMegaMenuPosition = function( menu ){
        "use strict";

        var fixMegaMenu = function(megamenu){
            var width = $( megamenu ).find('> .sub-menu').width(),
                liParent = $( megamenu ).parent( 'li' ),

                mega_columns = $( megamenu ).children('ul').children('li'),
                columns = mega_columns.length,
                column_width = width / columns,
                mega_menu_layout = 'boxed',
                bg_image = liParent.data('bg'),
                bg_type = $( megamenu ).hasClass('cl-header__menu__megamenu--background') ? 'background' : 'column',
                offsetFromLi = liParent.offset().left - CL_FRONT.config.$containerOffsetLeft;
            

            
            if( mega_menu_layout == 'boxed' ){
                width = $( megamenu ).width() - 40;
                column_width = width / columns;
                if( width == CL_FRONT.config.$containerWidth )
                    $( megamenu ).css( { left: '-' + offsetFromLi + 'px' } );
                else {  
                    setTimeout(function(){

                        var offsetOutFromContainer =  Math.abs( (CL_FRONT.config.$containerOffsetLeft + CL_FRONT.config.$containerWidth) - ( liParent.offset().left + width ) );
                        
                        if( offsetOutFromContainer >  offsetFromLi )
                            offsetOutFromContainer = 0;
                        
                        $( megamenu ).css( { left: '-' + (offsetOutFromContainer + 20) + 'px' } );
                    }, 1); 
                }
            }else{
                $( megamenu ).css( { left: '-' + liParent.offset().left + 'px', width: CL_FRONT.config.$windowWidth + 'px'} );
                $( megamenu ).find('> .sub-menu').css({width:'1170px', margin: '0 auto'});
                
            }

            if( bg_image != '' && bg_type == 'background' ){
                $( megamenu ).css({"background-image": 'url("'+bg_image+'")'});
            }
           
            mega_columns.css( { width: column_width + 'px'} );
        };

        if( ! menu ){
            this.config.$navigation.find( '.cl-header__menu__megamenu' ).each( function( index, megamenu ){
            
                fixMegaMenu( megamenu );

            } );
        }else{
            fixMegaMenu( menu );
        }
    };


    /**
     * Initialize Tools Dropdown in Responsive
     * 
     * @since 1.0.0
     */

    CL_FRONT.initToolsResponsive = function() {
        "use strict";
        var self = this;
       

        if( this.config.$windowWidth <= 991 ){

            if( this.config.$headerToolsInit )
                return;

            this.config.$headerTools.find( '.cl-header__tool .cl-submenu' ).each(function(){
                var submenu = $(this);
                submenu.addClass('cl-hide-on-mobile');

                var responsiveMenu = submenu.clone().appendTo(CL_FRONT.config.$header);
                responsiveMenu.removeClass( 'cl-hide-on-mobile' ).addClass( 'cl-mobile-menu' );
                

                CL_FRONT.config.$headerToolsList.push(submenu);
                submenu.closest('.cl-header__tool').find(' > i, > .cl-header__tool__link').on( 'click', function( e ){
                    e.preventDefault();

                    var button = $(this);
                    responsiveMenu.slideToggle('200');

                } );
            });

            this.config.$headerToolsInit  = true;

        }else{
            this.config.$header.find('.cl-mobile-menu').addClass('cl-hide-not-mobile');
            
            if( CL_FRONT.config.$headerToolsList.length > 0 ){
                CL_FRONT.config.$headerToolsList.forEach( function(menu){
                    menu.closest('.cl-header__tool').find(' > i, > .cl-header__tool__link').off('click');
                    menu.closest('.cl-header__tool').find(' > i, > .cl-header__tool__link').on('click', function(e){
                        return true;
                    });
                } );
            }
        }

    }

    /**
     * Tools Dropdown init
     * @since 1.0.0
     */

    CL_FRONT.initToolsDropdown = function() {
        "use strict";

        var toOpen = null,
            isOpen = false,
            mainNode = null;


        this.config.$headerTools.find( '.cl-header__tool' ).each( function( index, submenu ) {

            if ( $( submenu ).find( '.cl-submenu' ).length > 0 ) {
                $( submenu ).addClass( 'has-submenu' );
            }

        } );

        mainNode = this.config.$headerTools[0];

        this.config.$headerTools.mouseover( function( e ) {

            var item = e.target || e.srcElement;

            while ( ! $(item).hasClass('cl-header__tool') && item != mainNode ) {
                item = item.parentNode;
            }

            if ( $(item).hasClass('cl-header__tool') ) {
                toOpen = item;
                open();
            }

        } ).mouseleave( function() {
            close(toOpen);
        } );

        var open = function() {
            isOpen = true;

            // Get other items with same parent
            var items = $( toOpen ).parent().children( '.cl-header__tool' );
            
            $( items ).each( function( index, item ) {
                $( item ).find( ".cl-submenu" ).each( function( index, submenu ) {
                    if ( item != toOpen ) {
                        $( item ).removeClass( "show-dropdown" );
                        close( item );

                    } else 
                    if ( !$( item ).hasClass( 'show-dropdown' ) ) {



                        $( item ).addClass( "show-dropdown" );

                        
                        var left = 0;
                        var node = submenu;
                        while ( node ) {
                            
                            left += Math.abs( node.offsetLeft );
                            node = node.offsetParent;
                        }
                        var right = left + submenu.offsetWidth;


                        //We should refactor this code to execute only when menu is vertical
                        var menuHeight = $( submenu ).outerHeight();
                        var parentTop = $( submenu ).offset().top - $( window ).scrollTop();
                        var totalHeight = menuHeight + parentTop;
                        var windowHeight = window.innerHeight;



                        $( item ).removeClass( 'show-dropdown--right-to-left' );

                        if ( left < 0 ) $( item ).addClass( 'show-dropdown--left-to-left' );

                        if ( right > CL_FRONT.config.$containerOffsetLeft + CL_FRONT.config.$containerWidth ) {
                            $( item ).addClass( 'show-dropdown--right-to-left' );
                        }

                        if( $( item ).parents( '.show-dropdown' ).length > 0 ){
                            var width = $( item ).parents( '.show-dropdown' ).first().children('.cl-submenu').width();
                            
                            if( $( item ).hasClass( 'show-dropdown--left-to-right' ) || ( ! $( item ).hasClass( 'show-dropdown--left-to-right' ) && ! $( item ).hasClass( 'show-dropdown--right-to-left' ) ) )
                                $( item ).find( ".cl-submenu" ).css( { left: (width+16)+'px' } );
                            if( $( item ).hasClass( 'show-dropdown--right-to-left' ) )
                                $( item ).find( "cl-submenu" ).css( { right: (width+16)+'px' } );
                        }

                    }
                } );
            } );
        };

        var close = function( node ) {
            if (!node) {
              isOpen = false;
              node = mainNode;
            }
            
            // loop over the items, closing their submenus
            $(node).find('.cl-header__tool').each(function(index, item) {
              $(item).removeClass('show-dropdown');
            });

            if( $(node).hasClass('cl-header__tool') )
                $(node).removeClass('show-dropdown');
        }

    };


    /**
     * Menu Dropdown init
     * @since 1.0.0
     */

    CL_FRONT.initMenuDropdown = function() {
        "use strict";

        var toOpen = null,
            isOpen = false,
            mainNode = null,
            subHeights = [];


        this.config.$navigation.find( 'ul > li' ).each( function( index, submenu ) {

            if ( $( submenu ).find( 'ul' ).length > 0 ) {
                $( submenu ).addClass( 'has-submenu' );
                $( submenu ).find( '> a' ).addClass('anchor-submenu');
                if( $( submenu ).parents('.cl-dropdown-inline').length > 0 ){
                    //$( submenu ).find('ul').slideUp();
                }
            }

        } );
        
        mainNode = this.config.$navigation[0];

        this.config.$navigation.mouseover( function( e ) {

            var item = e.target || e.srcElement;

            while ( item.nodeName != 'LI' && item != mainNode ) {
                item = item.parentNode;
            }

            if ( item.nodeName == 'LI' ) {
                toOpen = item;
                open();
            }

        } ).mouseleave( function() {
            close();
        } );

        var open = function() {
            isOpen = true;

            // Get other items with same parent
            var items = $( toOpen ).parent().children( 'li' );
            
            $( items ).each( function( index, item ) {
                $( item ).find( "ul" ).each( function( index, submenu ) {

                    if ( item != toOpen ) {
                        if( $( item ).parents('.cl-dropdown-inline').length > 0 ){

                             $( submenu ).animate( {height: '0px' }, 20);
                        }
                        $( item ).removeClass( "show-dropdown" );

                        close( item );

                    } else if ( !$( item ).hasClass( 'show-dropdown' ) ) {

                        if( $( item ).children( '.cl-header__menu__megamenu' ).length > 0 ){
                            CL_FRONT.fixMegaMenuPosition( $( item ).children( '.cl-header__menu__megamenu' )[0] );
                        }

                        $( item ).addClass( "show-dropdown" );

                        
                        var left = 0;
                        var node = submenu;
                        while ( node ) {
                            
                            left += Math.abs( node.offsetLeft );
                            node = node.offsetParent;
                        }
                        var right = left + submenu.offsetWidth;

                        var menuHeight = $( submenu ).outerHeight();
                        var innerHeight = $( submenu ).innerHeight();
                        var parentTop = $( submenu ).offset().top - $( window ).scrollTop();
                        var totalHeight = menuHeight + parentTop;
                        var windowHeight = window.innerHeight;

                        /* Vetical Inline submenu */
                        if( $( item ).parents('.cl-dropdown-inline').length > 0 ){
                             $( submenu ).css('display', 'none').css('height', 'auto');
                             var h = $( submenu ).outerHeight();

                             $( submenu ).css('height', 0).css('display', 'block');
                             $( submenu ).animate( {height: h + 'px' }, 100);
                        }

                        $( item ).removeClass( 'show-dropdown--right-to-left' );

                        if ( left < 0 ) $( item ).addClass( 'show-dropdown--left-to-right' );

                        if ( right > document.body.clientWidth ) {
                            $( item ).addClass( 'show-dropdown--right-to-left' );
                        }

                        if( $( item ).parents( '.show-dropdown' ).length > 0 && $( item ).parents( '.cl-header__menu__megamenu' ).length == 0 ){
                            var width = $( item ).parents( '.show-dropdown' ).first().children('ul').width();
                            
                            if( $( item ).hasClass( 'show-dropdown--left-to-right' ) || ( ! $( item ).hasClass( 'show-dropdown--left-to-right' ) && ! $( item ).hasClass( 'show-dropdown--right-to-left' ) ) )
                                $( item ).find( "ul" ).css( { left: (width+16)+'px' } );
                            if( $( item ).hasClass( 'show-dropdown--right-to-left' ) )
                                $( item ).find( "ul" ).css( { right: (width+16)+'px' } );
                        }

                    }
                } );
            } );
        };

        var close = function( node ) {
            if (!node) {
              isOpen = false;
              node = mainNode;
            }

            // loop over the items, closing their submenus
            $(node).find('li').each(function(index, item) {
                if( $( item ).parents('.cl-dropdown-inline').length > 0 )
                    $(item).find('.sub-menu').css('height', 0);

                $(item).removeClass('show-dropdown');
            });
        }

    }

     /**
     * Initialize Lightbox Elements
     * @since 1.0.0
     */
    CL_FRONT.itemILightBox = function(){
        "use strict";
        var el = $( '.cl-lightbox' );

        if( el.length > 0 ){
            CL_FRONT.components.LightBox( el );
        }    
    }

     /**
     * Convert SVG to Animated Items
     * @since 1.0.0
     */
    CL_FRONT.convertSVGAnimated = function(){
        "use strict";
        
        if( $('svg.animated').length > 0 && ! CL_FRONT.config.$isCustomizer ){

            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'svg4everybody.js' ], function() {

                svg4everybody({polyfill: true});
                var id = 0;
                
                $('svg').each(function(index, item){
                        if( $(item).hasClass('animated') ){
                            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'vivus.min.js' ], function() {
                                id = 'svg_animated_' + index;
                                $(item).attr('id', id);
                                new Vivus( id, {duration: 200} );
                            });
                        }
                });
                
            });
        }
            
    }

     /**
     * Initialize Google Map
     * @since 1.0.0
     */
    CL_FRONT.codelessGMap = CL_FRONT.init_cl_map = function(){
        "use strict";

        if( $('.cl_map').length > 0 ){
            $('.cl_map').each(function(){
                var $el = $(this);

                var map = $el.find('.cl-map-element').first()[0];

                var data = {};
                    
                    data.style = CL_FRONT.helpers.parseData( $el.attr('data-style'), '' ),
                    data.latitude = $el.attr('data-lat'),
                    data.longitude = $el.attr('data-lon'),
                    data.map_zoom = CL_FRONT.helpers.parseData( $el.attr('data-zoom'), '4' );
                

                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'codeless-gmaps.js' ], function() {
                        
                        CL_FRONT.codelessInitMap( map, data );
                    
                });

            });
        }
    }



     /**
     * Contact Form Submit Button add neccessary classes
     * @since 1.0.0
     */
    CL_FRONT.contactForm = function(){
        if( $('.wpcf7-form').length > 0 ){
            $('.wpcf7-form').each(function(){
                var $form = $(this);

                $form.find('.wpcf7-submit').addClass(codeless_global.cl_btn_classes);
            });
        }
        
    }


     /**
     * Add appropiate btn classes to shop widgets
     * @since 1.0.0
     */
    CL_FRONT.shopBtnClasses = function(){

        var $btn = $('.widget_shopping_cart_content .button'),
            $btn2 = $('.price_slider_amount .button');
        
        if( $btn.length > 0 )
            $btn.addClass(codeless_global.cl_btn_classes).removeClass("btn-layout-large").addClass('btn-layout-small').removeClass('btn-font-medium').addClass('btn-font-small');
        if( $btn2.length > 0 )
            $btn2.addClass(codeless_global.cl_btn_classes).removeClass("btn-layout-large").addClass('btn-layout-small').removeClass('btn-font-medium').addClass('btn-font-small');
        
        CL_FRONT.config.$body.on('added_to_cart', function(){
            CL_FRONT.shopBtnClasses();
        });
    }


     /**
     * Row Parallax Initialize
     * @since 1.0.0
     */
    CL_FRONT.rowParallax = function() {
        "use strict";
        if ( $( '.cl-row.cl-parallax > .bg-layer' ).length > 0 ){
            $( '.cl-row.cl-parallax > .bg-layer' ).each(function(){
                CL_FRONT.components.Parallax( $( this ) ).init();
            })
            
        }
    };


    /**
     * Creative Search
     * @since 1.0.0
     */
    CL_FRONT.creativeSearch = function(){
        'use strict';

        if( $('.search-style-creative').length == 0 )
            return;

       
        var mainContainer = document.querySelector('#wrapper'),
            openCtrl = document.getElementById('header_search_btn'),
            closeCtrl = document.getElementById('btn-search-close'),
            searchContainer = document.querySelector('.creative-search');

        if( searchContainer === null )
            return;

        var inputSearch = searchContainer.querySelector('.search__input');

        var init = function() {
         
            initEvents();   
        }

        var initEvents = function() {
           
            openCtrl.addEventListener('click', openSearch);
            closeCtrl.addEventListener('click', closeSearch);
            document.addEventListener('keyup', function(ev) {
                // escape key.
                if( ev.keyCode == 27 ) {
                    closeSearch();
                }
            });
        }

        var openSearch = function(e) {
            e.preventDefault();
       
            mainContainer.classList.add('main-wrap--hide');
            searchContainer.classList.add('search--open');
            setTimeout(function() {
                inputSearch.focus();
            }, 500);
        }

        var closeSearch = function() {
            mainContainer.classList.remove('main-wrap--hide');
            searchContainer.classList.remove('search--open');
            inputSearch.blur();
            inputSearch.value = '';
        }

        init();

    };


    CL_FRONT.preloadOdometer = CL_FRONT.init_cl_counter = function(){
        "use strict";
        if( $('.cl_counter') ){
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'odometer.min.js' ], function() {
                
            });
        } 
    };


    /**
     * initialize Countdown
     * @since 1.0.2
     */
    CL_FRONT.countdownElement = CL_FRONT.init_cl_countdown = function(){
        "use strict";
        if( $('.cl_countdown').length > 0 ){
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.countdown.min.js' ], function() {
                $('.cl_countdown').each(function(){
                    var dt = $(this).data('dt');
                    $(this).countdown(dt, function(event) {
                      var $this = $(this).html(event.strftime(''
                        + '<span class="group"><span class="value">%w</span> <span class="type">weeks</span></span>'
                        + '<span class="group"><span class="value">%d</span> <span class="type">days</span></span>'
                        + '<span class="group"><span class="value">%H</span> <span class="type">hours</span></span>'
                        + '<span class="group"><span class="value">%M</span> <span class="type">min</span></span>'
                        + '<span class="group"><span class="value">%S</span> <span class="type">sec</span></span>'));
                    });
                });
            });
        } 
    };

     /**
     * Initialize Odometer counter
     * @since 1.0.0
     */
    CL_FRONT.codelessCounter = function(el){
        "use strict";
        var element = el;
        CL_FRONT.preloadOdometer();
        setTimeout(function(el){
            
            var odometer = element.find('.odometer').first(); 
            var number = odometer.data('number');
            var duration = odometer.data('duration');

            var el = odometer[0];
            
            var od = new Odometer({
              el: el,
              value: 0,
              duration: duration,
             
              // Any option (other than auto and selector) can be passed in here
              format: '',
              theme: 'minimal'
            });

            od.update(parseInt(number));
        }, 50);
        
    };


    /**
     * Initialize Single Product Slider with Carousel
     * @since 1.0.0
     */
    /*CL_FRONT.shopProductSlider = function(){
        if( $( '.cl-images .cl-carousel' ).length > 0 )
            CL_FRONT.components.Carousel( $( '.cl-images .cl-carousel' ), {
                items:1,
                loop:false,
                center:true,
                URLhashListener:true,
                autoplayHoverPause:true,
                startPosition: 'URLHash',
                animateIn: 'alpha-in',
                animateOut: 'fadeOut'
            }, function( owl, el ){
                
                
                var onChangefunc = function(event){
                    var index = event.item.index;
                    var actived_id = $( event.currentTarget ).find('.active .cl-image-item').attr('data-hash');
                   
                    var thumbnails = $(event.currentTarget).closest('.images').find('.thumbnails');
                      
                    thumbnails.find('a').removeClass('active');
                    thumbnails.find('[href="#'+actived_id+'"]').addClass('active');
                };

                owl.on('translated.owl.carousel', onChangefunc );
                owl.on('initialize.owl.carousel', onChangefunc );
            } );
    };*/


    /*CL_FRONT.shopEasyZoom = function(){
        "use strict";
        var $elements = $( '.easyzoom' );
        if ( $elements.length ) {
            $elements.each( function( i ) {

                var $element = $( this );
                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'easyzoom.js' ], function() {
                    var $easyzoom = $element.easyZoom();
                });
            });
        }
    };*/



    CL_FRONT.loadOtherLazyload = function(){
        "use strict";

        $('.lazyload').closest( '.cl-blog' ).each(function(){
            if( $(this).hasClass('cl-blog--module-grid-blocks') )
                CL_FRONT.components.LazyLoad( $(this)[0] );
        });
    };


    /**
     * Manage Customize Partial Refresh
     * 
     * @since 1.0.0
     */
    CL_FRONT.partialRefreshRendered = function(){
        "use strict";
        if( typeof wp.customize === 'undefined' || typeof wp.customize.selectiveRefresh === 'undefined' )
            return false;

        wp.customize.selectiveRefresh.on( 'partial-content-rendered', function( placement ) {
            var postType = '';

            if( typeof placement.partial.params.post_type !== 'undefined' )
                postType = placement.partial.params.post_type;

            if( postType == 'portfolio' )
                CL_FRONT.init_cl_portfolio();

        } );
    };
 
 
    /**
     * Active Tabs
     * 
     * @since 1.1.0
     */
    CL_FRONT.codelessTabs = CL_FRONT.init_cl_tabs = function(){
        $('.cl_tabs').each(function(){
            var $tabs = $(this);
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'bootstrap-tabs.min.js' ], function() {
                
                $tabs.find('.tab-content > .tab-pane').first().addClass('active in');
                $tabs.find('.tab-content .cl_cl_tab').first().addClass('activeBuilder'); 
              

                $('.cl-nav-tabs li:first-child', $tabs).addClass('active');
                // Builder
                $tabs.find('.tab-content .cl_element').first().find('.tab-pane').addClass('active in');

                $('.cl-nav-tabs a', $tabs).on( 'click', function(e){
                    
                    if( !CL_FRONT.config.$isCustomizer )
                        e.preventDefault()
                    $(this).tab('show');
                });
            });
        });
    };


    CL_FRONT.footerReveal = function(){
        if( $('#footer-wrapper.reveal').length == 0 )
            return false;

        var footerHeight = $('#footer-wrapper').height();

        if( this.config.$viewport.hasClass('cl-layout-bordered') ){
            $('#footer-wrapper').width( this.config.$main.width() );
        }

        this.config.$main.css( 'margin-bottom', footerHeight ).css( 'background-color', '#ffffff' ).css('position', 'relative').css('z-index', 1);
    };


    CL_FRONT.restartAnimations = function( $el, force ){
        if( $el.length == 0 )
            return;

        $el.find( ' > .start_animation' ).removeClass('start_animation').addClass('cl-animate-on-visible');
        setTimeout(function(){
            CL_FRONT.animations( $el, force );
        }, 20);
    }

    /**
     * Manage Customize Partial Refresh
     * 
     * @since 1.0.0
     * @version 1.0.7
     */
    CL_FRONT.onePageScroll = function(){
        "use strict";
        if( CL_FRONT.config.$body.hasClass('cl-one-page') ){

            

            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.onepage.js' ], function() {
                $('#navigation nav .menu').onePageNav({
                    currentClass: 'current-menu-item-onepage',
                    changeHash: false,
                    scrollSpeed: 750,
                    scrollThreshold: 0.5,
                    offset: CL_FRONT.config.$headerHeight
                });
            });


        }
        
    }


    /* -------------------------------------------------------- */
    /* ----------------- COMPONENTS TO REUSE ------------------ */


    CL_FRONT.components.JustifyGallery = function( container ){
        var $elements = container;

        if ( $elements.length ) {
            $elements.each( function( i ) {

                var $element = $( this );
                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.justifiedGallery.min.js' ], function() {

                    var $data = $element.data(),
                        $rowHeight = parseInt( CL_FRONT.helpers.parseData( $element.attr('data-rowheight'), 200 ) ),
                        $maxRowHeight = parseInt( CL_FRONT.helpers.parseData( $element.attr('data-maxheight'), 0 ) ),
                        $lastRow = CL_FRONT.helpers.parseData( $element.attr('data-lastrow'), 'nojustify' ),
                        $margins = parseInt( CL_FRONT.helpers.parseData( $element.attr('data-margins'), 15 ) );
               
                    $element.css( {opacity: 0} );
                    // Load justifyGallery after images loaded

                    
                        $element.imagesLoaded( function() {
                            
                            $element.css( {opacity: 1} );

                            $element.justifiedGallery({
                                lastRow: $lastRow,
                                rowHeight: $rowHeight,
                                maxRowHeight: $maxRowHeight,

                                margins: $margins
                            });

                            if( typeof CL_FRONT['animations'] !== 'undefined' )
                                CL_FRONT.animations();
                            
                            CL_FRONT.rowParallax();
                        } );

                        if( $element.hasClass( 'filterable-entries' ) ){
                            $( '.cl-filter--isotope' ).on( 'click', 'a', function(e) {
                                e.preventDefault();
                                var filterValue = $(this).attr('data-filter');
                                if( filterValue != '*' )
                                    $element.justifiedGallery({
                                        filter: filterValue
                                    }); 
                                else
                                    $element.justifiedGallery({
                                            filter: false
                                    }); 

                                CL_FRONT.restartAnimations( $element );
                        
                                $(this).parent().find('a.active').removeClass('active');
                                $(this).addClass('active');

                            });
                        }
                        
                } );
            } );
        }
    }


    CL_FRONT.components.Isotope = function( container, onArrange ){
        var $elements = container;

        if ( $elements.length ) {
            $elements.each( function( i ) {

                var $element = $( this );
                CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'isotope.js' ], function() {

                    var $data = $element.data(),
                        $transitionDuration = CL_FRONT.helpers.parseData( $data.transitionDuration, '0.4' ),
                        $layoutMode = CL_FRONT.helpers.parseData( $data.isotopeType, 'masonry' );
                      

                    $element.css( {opacity: 0} );
                    // Load isotope after images loaded

                    
                        $element.imagesLoaded( function() {
                            
                            $element.css( {opacity: 1} );

                            var isotope_options = {
                                itemSelector: '.cl-isotope-item',
                                transformsEnabled: true,
                                filter: '*',
                                percentPosition: true,
                                transitionDuration: '0.0s',
                                layoutMode: $layoutMode
                            };

                            if( $layoutMode == 'masonry' ){
                                isotope_options['masonry'] = {
                                    columnWidth: '.cl-msn-size-small'
                                };
                            }

                            if( $layoutMode == 'vertical' ){
                                isotope_options['vertical'] = {
                                    horizontalAlignment: 0.5
                                }
                            }



                            var $iso = $element.isotope( isotope_options );

                            if( typeof CL_FRONT['animations'] !== 'undefined' )
                                CL_FRONT.restartAnimations( $element );
                            
                            $element.on('arrangeComplete', function(){
                                setTimeout(function(){
                                    CL_FRONT.components.LazyLoad($element[0]);
                                }, 100);   
                            });

                            $element.isotope('arrange');

                            

                            CL_FRONT.rowParallax();
                            CL_FRONT.paginationInfinite();

                            
                               
                            
                        } );
                        
                    var $parent_element = $element.closest( '.cl-blog' );


                    if( $('.cl-filter--isotope', $parent_element).length > 0 ){
                            $( '.cl-filter--isotope a', $parent_element).on( 'click', function(e) {
                                e.preventDefault();
                                var filterValue = $(this).attr('data-filter');
                                if( filterValue != '*' )
                                    $element.isotope({
                                        filter: filterValue,
                                        sortBy: 'random'
                                    }); 
                                else
                                    $element.isotope({
                                            filter: filterValue,
                                            sortBy: 'original-order'
                                    }); 
                                
                                CL_FRONT.restartAnimations( $element );
                                $element.isotope('arrange');

                                $(this).parent().find('a.active').removeClass('active');
                                $(this).addClass('active');

                            });
                    }

                } );
            } );
        }
    }


    /**
     * Carousel Component to be used over pages
     * @since 1.0.0
     */

    CL_FRONT.components.Carousel = function( el, data_obj, callback ){
        if( el != null ){
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'owl.carousel.min.js'], function() {
                
                var $data = el.data();
                console.log($data);
                if( data_obj != null && data_obj != false )
                    $data = data_obj;

                if( typeof $data.autoHeight === "undefined" )
                    $data['autoHeight'] = true;
                if( typeof $data.navContainerClass === "undefined" )
                    $data['navContainerClass'] = 'cl-owl-nav';
                if( typeof $data.navText === "undefined" )
                    $data['navText'] = ["&larr;","&rarr;"]
                
                if( typeof $data.dots === 'undefined'  )
                    $data['dots'] = false;

                console.log( $data );
                el.imagesLoaded( function() {
                    var owl = el.owlCarousel($data);
                    CL_FRONT.animations( el.find( '.owl-item.active'), true ); 
                    CL_FRONT.components.LazyLoad( el[0] );

                    owl.on('translated.owl.carousel', function(event) { 
                        CL_FRONT.animations( el.find( '.owl-item.active' ), true );                   
                    });

                    if( callback != null )
                        callback(owl, el);

                });

                

            });
        }
    };


    CL_FRONT.instaFeed = function(){
        "use strict";
       $('.cl-instafeed.cl-carousel').each(function(){
            var $instafeed = $(this);
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'instafeed.min.js' ], function() {

                var $token = $instafeed.data('token'),
                    $userid = $instafeed.data('userid');

                var userFeed = new Instafeed({
                    get: 'user',
                    userId: $userid,
                    accessToken: $token,
                    limit: 8,
                    target: $instafeed[0],
                    template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /></a>',
                    after: function() {
                        var $data = {

                            responsive: {
                                0: {
                                    items: 3
                                },
                                480: {
                                    items: 3
                                },
                                768: {
                                    items: 3 
                                },
                                992: {
                                    items: $instafeed.data('items')
                                }
                            },

                            loop:true,
                            smartSpeed: 600,
                            center: $instafeed.data('center'),
                            margin:$instafeed.data('margin'),
                            nav: false,
                            dots: false

                        };

                        CL_FRONT.components.Carousel( $instafeed, $data, function(owl, el){
                            owl.on('resized.owl.carousel', function(event){
                                CL_FRONT.animations( el.find( '.owl-item.active' ), true ); 
                            });          
                        }); 
                    }
                });
                userFeed.run();

                

            });
        });


        $('.widget .cl-instafeed').each(function(){
            var $instafeed = $(this);

            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'instafeed.min.js' ], function() {

                var $token = $instafeed.data('token'),
                $userid = $instafeed.data('userid');

                var userFeed = new Instafeed({
                        get: 'user',
                        userId: $userid,
                        accessToken: $token,
                        limit: 6,
                        target: $instafeed[0],
                        template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /></a>',
                        resolution: 'low_resolution',
                        
                    });

                userFeed.run();

            });
        });
    };



    /**
     * iLightbox Component
     * @since 1.0.0
     * @version 2.1
     */
    CL_FRONT.components.LightBox = function( el ){
        "use strict";
        var initialized = false;
        if( el != null ){
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'jquery.requestAnimationFrame.js',
                                                    codeless_global.FRONT_LIB_JS + 'jquery.mousewheel.js',
                                                    codeless_global.FRONT_LIB_JS + 'ilightbox.packed.js' ], function() {




                setTimeout(function(){
                    if( !initialized ){
                        var connection = el.first().data('lboxid');

                        CL_FRONT.config.$ilightboxes['item_5'] = el.iLightBox({
                                skin: codeless_global.lightbox.skin,
                                linkId: connection || false,
                                path: codeless_global.lightbox.path,
                                mousewheel: codeless_global.lightbox.mousewheel,
                                controls: {
                                    toolbar: codeless_global.lightbox.toolbar,
                                    arrows: codeless_global.lightbox.arrows,
                                    slideshow: codeless_global.lightbox.slideshow,
                                    fullscreen:codeless_global.lightbox.fullscreen,
                                    thumbnail:codeless_global.lightbox.thumbnail,
                                    mousewheel:codeless_global.lightbox.mousewheel,
                                    swipe: codeless_global.lightbox.swipe,

                                }
                                
                        });
                        initialized = true;
                    }
                }, 100);


                if( ! codeless_global.lightbox.contextmenu )
                    $(document).on('contextmenu', el, function(e) {
                      return false;
                    });
                
            });
        }
    };


    /**
     * lazyload Component
     * @since 1.0.0
     */
    CL_FRONT.components.LazyLoad = function( container ){
        "use strict";

        if( container == null ){
            container = window;
        }
            CL_FRONT.components.loadDependencies( [ codeless_global.FRONT_LIB_JS + 'lazyload.min.js' ], function() {   
                
                var myLazyLoad = new LazyLoad({
                    container: container,
                    elements_selector: '.lazyload',
                    failure_limit: Math.max($('.lazyload').length - 1, 0)
                });

            });
    };


    /**
     * Parallax Effect Used on various parts of site
     * @since 1.0.0
     */

    CL_FRONT.components.Parallax = function( el ) {
        "use strict";



        var self = this,
            $this = el ,
            obj = $this[ 0 ],

            config = $this.data( 'parallax-config' ),
            headerHeight = null,
            offset = null,
            elHeight = null,
            ticking = false,
            isMobile = null;

        var clientRect = null;

        if( config == null )
            config = { speed: 0.3 };

        var update = function() {
            // Update Positions
            obj.style.transform = null;
            obj.style.top = null;
            obj.style.bottom = null;
            if ( CL_FRONT.config.$isMobileScreen ) {
                $this.css( 'height', '' );
                return;
            }

            clientRect = $this[ 0 ].getBoundingClientRect();

            offset = clientRect.top;

            elHeight = clientRect.height;
            headerHeight = 0;
          
            offset = offset - headerHeight + CL_FRONT.config.$windowTop;

            setPosition();
            setSize();
        };


        var h = 0,
            winH = 0,
            proportion = 0,
            height = 0;

        
        var setSize = function() {

            $this.css( 'height', '' );
            winH = CL_FRONT.config.$window.height() - headerHeight;
            h = obj.getBoundingClientRect().height;

            if ( config.speed <= 1 && config.speed > 0 ) {
                if ( offset === 0 ) {
                    $this.css( {
                        backgroundAttachment: 'scroll',
                        'will-change': 'transform'
                    } );
                } else {
                    $this.css( {
                        height: h + ( ( winH - h ) * config.speed ),
                        backgroundAttachment: 'scroll',
                        'will-change': 'transform'
                    } );
                }

            } else if ( config.speed > 1 && h <= winH ) {
                $this.css( {
                    // good for full heights - 2 because it's viewable by 2 screen heights
                    height: ( winH + ( ( winH * config.speed ) - winH ) * 2 ),
                    top: -( ( winH * config.speed ) - winH ),
                    backgroundAttachment: 'scroll',
                    'will-change': 'transform'
                } );

            } else if ( config.speed > 1 && h > winH ) {
                proportion = h / winH;
                height = ( winH + ( ( winH * config.speed ) - winH ) * ( 1 + proportion ) );

                $this.css( {
                    height: height,
                    top: -( height - ( winH * config.speed ) ),
                    backgroundAttachment: 'scroll',
                    'will-change': 'transform'
                } );

            } else if ( config.speed < 0 && h >= winH ) {
                height = h * ( 1 - config.speed );
                $this.css( {
                    height: height + ( height - h ),
                    top: h - height,
                    backgroundAttachment: 'scroll',
                    'will-change': 'transform'
                } );

            } else if ( config.speed < 0 && h < winH ) {
                // candidate to change
                var display = ( winH + h ) / winH;
                height = h * -config.speed * display;
                $this.css( {
                    height: h + ( height * 2 ),
                    top: -height,
                    backgroundAttachment: 'scroll',
                    'will-change': 'transform'
                } );
            }
        };


        var currentPoint = null,
            progressVal = null,
            startPoint = null,
            endPoint = null,

            scrollY = null;

        var setPosition = function() {
            ticking = false;

            if( scrollY == null )
                scrollY = window.scrollY;

            var currentScrollY = scrollY;
            if (!CL_FRONT.config.$isMobileScreen){
                
                startPoint = offset - winH;
               
                endPoint = offset + elHeight + winH - headerHeight;
                
                if ( currentScrollY < startPoint || currentScrollY > endPoint ) {
                    ticking = false;
                    return;
                }

                currentPoint = ( ( -offset + currentScrollY ) * config.speed );

                $this.css( {
                    '-webkit-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                    '-moz-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                    '-ms-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                    '-o-transform': 'translateY(' + currentPoint + 'px) translateZ(0)',
                    'transform': 'translateY(' + currentPoint + 'px) translateZ(0)'
                } );

                
            }
        };


        var requestTick = function() {
           
            if ( !ticking ) {
                window.requestAnimationFrame( setPosition );
            }
            ticking = true;
            
        };

        var onScroll = function(){
            scrollY = window.scrollY;
            requestTick();
        }


        var init = function() {
            
            // Disable scroll effects when smooth scroll is disabled
            if ( !CL_FRONT.config.$isSmoothScroll || CL_FRONT.config.$isCustomizer ) {
                return;
            }

            update();
            setTimeout( update, 300 );

            CL_FRONT.config.$window.on( 'load', update );
            CL_FRONT.config.$window.on( 'resize', update );
            window.addEventListener('scroll', onScroll, false);

        };


        return {
            init: init
        };

    };


    CL_FRONT.components.loadAnimation = function( content, callback ){

        content.imagesLoaded( { background: true }, function(list){
          
            callback();
            content.addClass( 'cl-loaded-component' );
        });

    };


    /**
     * Core function for loading dinamically JS
     * 
     * @since 1.0.0
     */
    CL_FRONT.components.loadDependencies = function( dependencies, callback ) {
        "use strict";

        var _callback = callback || function() {};
        if ( !dependencies )
            return void _callback();

        var newDeps = dependencies.map( function( dep ) {
            return -1 === CL_FRONT.config._loadedDependencies.indexOf( dep ) ? "undefined" == typeof CL_FRONT.config._inQueue[ dep ] ? dep : ( CL_FRONT.config._inQueue[ dep ].push( _callback ), !0 ) : !1
        } );

        if ( newDeps[ 0 ] !== !0 ) {
            if ( newDeps[ 0 ] === !1 )
                return void _callback();
            var queue = newDeps.map( function( script ) {
                CL_FRONT.config._inQueue[ script ] = [ _callback ];
                return $.getCachedScript( script );
            } );

            var onLoad = function() {
                newDeps.map( function( loaded ) {
                    CL_FRONT.config._inQueue[ loaded ].forEach( function( callback ) {
                        callback()
                    } );
                    delete CL_FRONT.config._inQueue[ loaded ];
                    CL_FRONT.config._loadedDependencies.push( loaded )
                } );
            };

            $.when.apply( null, queue ).done( onLoad )
        }


    };


    


    /* ---------------------------------------------------*/
    /* ------------------ HELPERS FUNCTIONS --------------*/


    CL_FRONT.helpers.changeHeaderColor = function(element){
        
        var color = 'dark';
        if( CL_FRONT.config.$header.hasClass('cl-header-sticky-active') )
            return;


        if( element.find('.cl-row').hasClass('light-text') )
            color = 'light';
        
    
        if( color == 'light' && ! CL_FRONT.config.$header.hasClass('cl-header-light') ){
            CL_FRONT.config.$header.addClass('cl-header-light');
            CL_FRONT.config.$body.addClass('cl-header-light');
        }

        if( color == 'dark' && CL_FRONT.config.$header.hasClass('cl-header-light') ){
            CL_FRONT.config.$header.removeClass('cl-header-light');
            CL_FRONT.config.$body.removeClass('cl-header-light');
        }
            


    };

    CL_FRONT.helpers.recognizeColor = function(color){
        var rgb = '';
        if( CL_FRONT.helpers.includes(color, 'rgb') ){
            var match = color.match(/rgba?\((\d{1,3}), ?(\d{1,3}), ?(\d{1,3})\)?(?:, ?(\d(?:\.\d?))\))?/);
            rgb = match ? {
                0: match[1],
                1: match[2],
                2: match[3]
              } : {};


        }else{
            var isOk  = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(color);
            if( ! isOk )
                return 'none';
            rgb = CL_FRONT.helpers.hexToRgb(color);
            
        }
        

        var o = Math.round(((parseInt(rgb[0]) * 299) + (parseInt(rgb[1]) * 587) + (parseInt(rgb[2]) * 114)) /1000);
        if(o > 125) {
            return 'light';
        }else{ 
            return 'black';
        }

    };

    CL_FRONT.helpers.hexToRgb = function(hex){
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    };

    CL_FRONT.helpers.includes = function(container, value){
        var returnValue = false;
        var pos = container.indexOf(value);
        if (pos >= 0) {
            returnValue = true;
        }
        return returnValue;
    };

    CL_FRONT.helpers.loadCSS = function(href){
        var ss = document.styleSheets;
        for (var i = 0, max = ss.length; i < max; i++) {
            if (ss[i].href == href)
                return;
        }
        var link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = href;

        document.getElementsByTagName("head")[0].appendChild(link);
    }

    /**
     * Core function for loading dinamically JS
     * 
     * @since 1.0.0
     */
    $.getCachedScript = function( url, callback ) {
        "use strict";

        url = url.replace( /.*?:\/\//g, "" );

        if ( location.protocol === 'https:' )
            url = 'https://' + url;
        else
            url = 'http://' + url;

        var options = {
            dataType: "script",
            cache: false,
            url: url
        };

        return $.ajax( options ).done( callback );
    };


    /**
     * parse and sanitize value
     *
     * @since 1.0.0
     */
    CL_FRONT.helpers.parseData = function( val, fallback ) {
        "use strict";
        return ( typeof val !== 'undefined' ) ? val : fallback;
    };

    CL_FRONT.helpers.scroll = function() {
        "use strict";
        var offset = 0,
            $window = $(window),
            hasPageYOffset = (window.pageYOffset !== undefined),
            body = (document.documentElement || document.body.parentNode || document.body);

        var update = function() {
            offset = hasPageYOffset ? window.pageYOffset : body.scrollTop;
        };

        var rAF = function() {
            window.requestAnimationFrame(update);
        };

        update();
        $window.on('load', update);
        $window.on('resize', update);
        $window.on('scroll', rAF);

        
        return offset;
      
    };


    function initGMAP(){
        CL_FRONT.codelessGMap();
    }

    CL_FRONT.siteInit();
    

    if( typeof CL_FRONT.animations == 'undefined' ){

        CL_FRONT.animations = function( el, force ) { 
            if (!window.waypoint_animation) {
                window.waypoint_animation = function(el, force) {
                    
                    var notEl = (el == null) ? true : false;
                    if( el == null )
                        el = $('.cl-animate-on-visible:not(.start_animation)');
                    else{
                        if( el.hasClass('.cl-animate-on-visible') )
                            el = el.find('.cl-animate-on-visible:not(.start_animation)').andSelf();
                        else
                            el = el.find('.cl-animate-on-visible:not(.start_animation)')
                    }
                        

                   
                    $.each(el, function(index, val) {
                        var run = true;
                        if ($(val).closest('.cl-slide').length > 0) run = false;
                       
                        if ($(val).closest('.cl-carousel').length > 0) run = false;

                        if ($(val).closest('.cl-header__menu').length > 0 ) run = false; 

                        if( force )
                            run = true;
                        if (run) {
                            
                            CL_FRONT.components.loadDependencies([codeless_global.FRONT_LIB_JS + "waypoints.min.js"], function(){
                                
                                new Waypoint({
                                    element: val,
                                    handler: function() {
                                        var element = $(this.element),
                                            index = element.index(),
                                            delayAttr = element.attr('data-delay');
                                        
                                        if (delayAttr == undefined) delayAttr = 0;
                                        setTimeout(function() {
                                            element.addClass('start_animation');
                                            
                                            if( element.hasClass('cl_counter') )
                                                CL_FRONT.codelessCounter(element);

                                            if( element.hasClass('cl_progress_bar') )
                                                CL_FRONT.progressBar( element );

                                        }, delayAttr);
                                        this.destroy();
                                    },
                                    offset: '90%'
                                });
                            });
                            
                        }
                    });
                }
            }
            setTimeout(function() {
                window.waypoint_animation(el, force);
            }, 1);
        };
    }

    
    

} )( jQuery );