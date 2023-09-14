( function( $ ) {
  var CL_POSTMESSAGE = window.CL_POSTMESSAGE || {};
	window.CL_POSTMESSAGE = CL_POSTMESSAGE;



CL_POSTMESSAGE.custom_button_font = function(to){
}

CL_POSTMESSAGE.logo_font_text = function(to){
  $('.cl-logo__font').html(to);
}


CL_POSTMESSAGE.header_menu_vertical_dividers = function(to){
  if(to){
    $('.header_container').addClass('vertical-dividers');
  }else{
    $('.header_container').removeClass('vertical-dividers');
  }
}

  
CL_POSTMESSAGE.custom_css = function(to){
    if ( ! $( '#codeless_customizer_custom_css').size() ) {
        $( 'head' ).append( '<style id="codeless_customizer_custom_css"></style>' );
    }
    $( '#codeless_customizer_custom_css').text( to );
};

CL_POSTMESSAGE.header_sticky = function(to){
  if( to ){
    var contentColor = parent.wp.customize.control('header_sticky_content').setting.get()
    $('.header_container').addClass('cl-header-sticky');
    $('.header_container.cl-header-sticky').attr( 'data-sticky-content-color', contentColor );

    CL_FRONT.initHeaderSticky();
  }else{
    $('.header_container').removeClass('cl-header-sticky');
    CL_FRONT.initHeaderSticky();
  }
};

CL_POSTMESSAGE.header_sticky_content = function(to){
  $('.header_container.cl-header-sticky').attr( 'data-sticky-content-color', to );
  CL_FRONT.initHeaderSticky();
};

CL_POSTMESSAGE.header_forced_center = function(to){
  if( to )
    $('body').addClass('cl-header-forced-center');
  else
    $('body').removeClass('cl-header-forced-center');
};

CL_POSTMESSAGE.header_sticky_shadow = function(to){
  if( to )
    $(".header_container.cl-header-sticky").addClass('cl-header-sticky-shadow');
  else
    $(".header_container.cl-header-sticky").removeClass('cl-header-sticky-shadow');
}

CL_POSTMESSAGE.header_layout = function(to, setting){
  $(".header_container").removeClass (function (index, css) {
      return (css.match (/\bheader-\S+/g) || []).join(' ');
  });
  
  $('.header_container').addClass('header-'+to);
  
  $("body").removeClass (function (index, css) {
      return (css.match (/\bheader-\S+/g) || []).join(' ');
  });
  
  $('body').addClass('header-layout-'+to);
  
  if(to == 'left' || to == 'right'){
    $('.header_container').css('width', '');
    $('.header_container > .main').css('height', '').css('line-height', '');
    $('body').addClass('cl-header-side');
    CL_POSTMESSAGE.viewportPosition()
  }
  
  if(to == 'top' || to == 'bottom'){
    $('.header_container').css('width', '100%');
    CL_POSTMESSAGE.viewportPosition()
  }
  
};

CL_POSTMESSAGE.logo_height = function(to){
  console.log(to);
  $('.header_container').find('#logo img').css('height', to + 'px');
}


CL_POSTMESSAGE.header_shadow = function(to){
  if( to )
    $(".header_container").addClass('menu-with_shadow');
  else
    $(".header_container").removeClass('menu-with_shadow');
}

CL_POSTMESSAGE.header_container = function(to){
  if( to == 'container-fluid'){
    $('.cl-header__container').addClass('container-fluid').removeClass('container');
  }else{
    $('.cl-header__container').addClass('container').removeClass('container-fluid');
  }
}


CL_POSTMESSAGE.header_menu_style_full = function(to, setting){
  
  if(to == 1)
    $(".header_container").addClass('menu-full-style').removeClass('menu-text-style');
  else
    $(".header_container").removeClass('menu-full-style').addClass('menu-text-style');
  
  CL_POSTMESSAGE.header_menu_border_width(parent.wp.customize.control('header_menu_border_width').setting.get());
  

}

CL_POSTMESSAGE.transparent_header = function(to){

  if(to){
    $('.header_container').addClass( 'cl-transparent' );
    $('body').addClass('cl-header-transparent');
    CL_FRONT.initHeaderSticky();
  }else{
    $('.header_container').removeClass( 'cl-transparent' );
    $('body').removeClass('cl-header-transparent');
    CL_FRONT.initHeaderSticky();
  }
}

CL_POSTMESSAGE.header_color = function(to){
  if(to == 'light'){
    $('.header_container').addClass( 'cl-header-light' );
  }else{
    $('.header_container').removeClass( 'cl-header-light' );
  }
}


CL_POSTMESSAGE.header_design = function(to, setting){
  
  if(!_.isObject(to))
    to = JSON.parse(to);
  
  _.each(to, function(v, index){
      if(to[index] == '')
        to[index] = 0;
  });
  
  $('.cl-header__row--main').css(to);
  
  
  CL_POSTMESSAGE.viewportPosition();
  
};


CL_POSTMESSAGE.header_design_top = function(to, setting){
  
  if(!_.isObject(to))
    to = JSON.parse(to);
  
  _.each(to, function(v, index){
      if(to[index] == '')
        to[index] = 0;
  });
  
  $('.cl-header__row--top').css(to);
  
  
  CL_POSTMESSAGE.viewportPosition();
  
};

CL_POSTMESSAGE.header_design_extra = function(to, setting){
  
  if(!_.isObject(to))
    to = JSON.parse(to);
  console.log(to);
  _.each(to, function(v, index){
      if(to[index] == '')
        to[index] = 0;
  });
  
  $('.cl-header__row--extra').css(to);
  
  
  CL_POSTMESSAGE.viewportPosition();
  
};

CL_POSTMESSAGE.footer_design = function(to, setting){
  
  if(!_.isObject(to))
    to = JSON.parse(to);
  
  _.each(to, function(v, index){
      if(to[index] == '')
        to[index] = 0;
  });
  
  $('footer#colophon .cl-footer__main').css(to);
  
  
  CL_POSTMESSAGE.viewportPosition();
  
};

CL_POSTMESSAGE.boxed_layout = function(to, setting){
  if( to )
    $("#wrapper").addClass('cl-boxed-layout');
  else
    $("#wrapper").removeClass('cl-boxed-layout');
}


CL_POSTMESSAGE.button_style = function(to, setting){
  $(".cl-btn").removeClass (function (index, css) {
      return (css.match (/\bbtn-style-\S+/g) || []).join(' ');
  });
  $(".cl-btn").addClass( 'btn-style-' + to);
}

CL_POSTMESSAGE.blog_pagination_align = function(to, setting){
  $(".cl-blog-pagination .cl-pagination").removeClass (function (index, css) {
      return (css.match (/\bcl-pagination-align-\S+/g) || []).join(' ');
  });
  $(".cl-blog-pagination .cl-pagination").addClass( 'cl-pagination-align-' + to);
}

CL_POSTMESSAGE.button_layout = function(to, setting){
  $(".cl-btn").removeClass (function (index, css) {
      return (css.match (/\bbtn-layout-\S+/g) || []).join(' ');
  });
  $(".cl-btn").addClass( 'btn-layout-' + to);
}

CL_POSTMESSAGE.button_font = function(to, setting){
  $(".cl-btn").removeClass (function (index, css) {
      return (css.match (/\bbtn-font-\S+/g) || []).join(' ');
  });
  $(".cl-btn").addClass( 'btn-font-' + to);
}



CL_POSTMESSAGE.blog_align = function(to, setting){

  $(".blog-entries").removeClass (function (index, css) {
      return (css.match (/\bblog_align_\S+/g) || []).join(' ');
  });
    
  $('.blog-entries').addClass('blog_align_' + to);

}


CL_POSTMESSAGE.header_width = function(to, setting){
  $('.header_container').css('width', to+'px');
  CL_POSTMESSAGE.viewportPosition();
}


CL_POSTMESSAGE.header_boxed = function(to, setting){
  if(to == 1)
    $('.header_container:not(.cl-added-from-meta)').addClass('boxed-style');
  else  
    $('.header_container:not(.cl-added-from-meta)').removeClass('boxed-style');
  
  CL_POSTMESSAGE.viewportPosition();
}


CL_POSTMESSAGE.header_menu_style = function(to, setting){
  $(".header_container").removeClass (function (index, css) {
      return (css.match (/\bmenu_style-\S+/g) || []).join(' ');
  });
  
  $('.header_container').addClass('menu_style-'+to);
}


CL_POSTMESSAGE.header_menu_border_width = function(to, setting){
  
  if($('.header_container').hasClass('menu-full-style'))
    selector = '.header_container nav > ul > li';
  else if($('.header_container').hasClass('menu-text-style'))
    selector = '.header_container nav > ul > li > a';
    
    
  if($('.header_container').hasClass('menu_style-border_top') )
    $(selector).css('border-top-width', to+'px').css('border-bottom-width', '').css('border-left-width', '').css('border-right-width', '');
    
  if($('.header_container').hasClass('menu_style-border_bottom'))
    $(selector).css('border-bottom-width', to+'px').css('border-top-width', '').css('border-left-width', '').css('border-right-width', '');

  if($('.header_container').hasClass('menu_style-border_left'))
    $(selector).css('border-left-width', to+'px').css('border-top-width', '').css('border-bottom-width', '').css('border-right-width', '');
  
  if($('.header_container').hasClass('menu_style-border_right') )
    $(selector).css('border-right-width', to+'px').css('border-top-width', '').css('border-bottom-width', '').css('border-left-width', '');
}



CL_POSTMESSAGE.footer_fullwidth = function(to, setting){
  if(to){
    $('footer#colophon .footer-content').removeClass('container').addClass('container-fluid');
    $('#copyright .copyright-content').removeClass('container').addClass('container-fluid');
  }else{
    $('footer#colophon .footer-content').removeClass('container-fluid').addClass('container');
    $('#copyright .copyright-content').removeClass('container-fluid').addClass('container');
  }
}

CL_POSTMESSAGE.footer_centered_content = function(to){
  if(to){
    $('.footer-content-row > .footer-widget').addClass('center-column');
  }else{
    $('.footer-content-row > .footer-widget').removeClass('center-column');
  }
}


CL_POSTMESSAGE.footer_reveal_effect = function(to){
  if(to){
    $('#footer-wrapper').addClass('reveal');
    CL_FRONT.footerReveal();
  }else{
    $('#footer-wrapper').removeClass('reveal');
    $('#main').css('margin-bottom', '0');
  }
}




CL_POSTMESSAGE.layout_modern = function(to, setting){
  
  if(to){
    $('#content').addClass( 'cl-layout-modern' );
    $('.cl-layout-modern-bg').css('display', 'block');
  }else{
    $('#content').removeClass( 'cl-layout-modern' );
    $('.cl-layout-modern-bg').css('display', 'none');
  }
  
}

CL_POSTMESSAGE.portfolio_distance = function(to, setting){
  $( '#portfolio-entries .portfolio_item' ).css({ padding: to+'px', opacity: '0.1' });
  
  CL_FRONT.isotopePortfolioGrid();

  $( '#portfolio-entries .portfolio_item' ).css({ opacity: '1' });
}



CL_POSTMESSAGE.viewportPosition = function(){
  
  var inner_width = $('.header_container').width();
  var pad = 0;
  
  var header_pos = $('.header_container').hasClass('header-left') ? 'left' : ($('.header_container').hasClass('header-right') ? 'right' : '');

  if(header_pos == 'left'){
    $('#viewport').css('padding-left', (inner_width+pad)+'px').css('padding-right', '0px');
  }else if(header_pos == 'right'){
    $('#viewport').css('padding-right', (inner_width+pad)+'px').css('padding-left', '0px');
  }else{
    $('#viewport').css('padding-right', '0px').css('padding-left', '0px');
    
  }
  
  if($('.header_container').hasClass('boxed-style')){
    $('#viewport').css('padding-right', '0px').css('padding-left', '0px');
  }
  
}



CL_POSTMESSAGE.generate_font_css = function( option, to ){
  console.log(cl_options);
  if( typeof cl_options[option]  === 'undefined' )
    return;
  var css = cl_options[option].join(', ') +' {';
        $.each(to,  function(property, value){
            if(property != 'variant' && property != 'subsets')
              css += ' '+property+' : '+value+' !important;';
            
            if(property == 'variant'){
              css += variantCss(value);
            }

        });
        
        css += '}';

        console.log(css);
  
        if ( '' !== css ) {
          // Make sure we have a stylesheet with the defined ID.
          // If we don't then add it.
          if ( ! $( '#codeless_customizer_'+option).size() ) {
            $( 'head' ).append( '<style id="codeless_customizer_'+option+'"></style>' );
          }
          $( '#codeless_customizer_'+option).text( css );
        }
        
        if( ! _.isUndefined( to['font-family'] ) && ! _.isEmpty( to['font-family'] ) )
          WebFont.load({
              google: { 
                  families: [to['font-family']] 
              } 
           }); 
         
         function variantCss(variant){
            var css = '';
            
            var weight = variant.replace('italic', '');
            if(weight == '' || weight == 'regular')
              weight = 400;
          
            var is_italic = false;
            if(variant.indexOf('italic') != -1 ){
              is_italic = true;
            }
        		css += ' font-weight :'+weight+' !important;';
        		if(is_italic)
        		  css += ' font-style : italic !important;';
        		
        		return css;
        }
}


/* Post Meta */
CL_POSTMESSAGE.meta_transparent_header = function(to){

  if(to == 'transparent' ){
    $('.header_container').addClass( 'cl-transparent' );
    $('body').addClass('cl-header-transparent');
    CL_FRONT.initHeaderSticky();
  }else if( to == 'no_transparent' || to == 'default' ){
    $('.header_container').removeClass( 'cl-transparent' );
    $('body').removeClass('cl-header-transparent');
    CL_FRONT.initHeaderSticky();
  }
}

CL_POSTMESSAGE.meta_header_color = function(to){
  if(to == 'light'){
    $('.header_container').addClass( 'cl-header-light' );
  }else{
    $('.header_container').removeClass( 'cl-header-light' );
  }
}

CL_POSTMESSAGE.meta_page_bg_color = function(to){
  $('#content').css('background-color', to);
}

CL_POSTMESSAGE.meta_fullwidth_content = function(to){
  
  if(to)
    $('#content .inner-content').removeClass('container').addClass('container-fluid');
  else
    $('#content .inner-content').removeClass('container-fluid').addClass('container');
}




// Portfolio

CL_POSTMESSAGE.meta_portfolio_columns = function(to){
  $( '#portfolio-entries' ).attr( 'data-grid-cols', to );
  CL_FRONT.isotopePortfolioGrid();
}

CL_POSTMESSAGE.meta_portfolio_layout = function(to){
  $("#portfolio-entries").removeClass (function (index, css) {
      return (css.match (/\bportfolio-layout-\S+/g) || []).join(' ');
  });
  $("#portfolio-entries").addClass( 'portfolio-layout-' + to);
  setTimeout( function(){
    CL_FRONT.isotopePortfolioGrid();
  }, 100);
}

CL_POSTMESSAGE.meta_portfolio_style = function(to){
  
  $("#portfolio-entries").removeClass (function (index, css) { 
      return (css.match (/\bportfolio-style-\S+/g) || []).join(' ');
  });
  $("#portfolio-entries").addClass( 'portfolio-style-' + to);
  
  setTimeout( function(){
    CL_FRONT.isotopePortfolioGrid();
  }, 100);
   
}

CL_POSTMESSAGE.meta_portfolio_boxed = function(to){
  if(to)
    $( '#portfolio-entries .portfolio_item' ).addClass('portfolio_boxed');
  else
    $( '#portfolio-entries .portfolio_item' ).removeClass('portfolio_boxed');
}

CL_POSTMESSAGE.meta_staff_position = function(to, value, postType, postID){
  if( $('#cl_team_item-'+postID).length > 0 ){
    var $position = $( '.team-position', '#cl_team_item-'+postID);
    if( $position.length > 0 ){
      $position.html(to);
    }
  }
}

CL_POSTMESSAGE.meta_post_title = function(to, value, postType, postID){

  if( postType == 'portfolio' && $('#cl-portfolio-item-'+postID).length > 0 ){
    var $title = $( '.cl-portfolio-title', '#cl-portfolio-item-'+postID);
    if( $title.length > 0 ){
      $title.html(to.post_title);
    }
  }

  if( postType == 'staff' && $('#cl_team_item-'+postID).length > 0 ){
    var $title = $( '.team-name', '#cl_team_item-'+postID);
    if( $title.length > 0 ){
      $title.html(to.post_title);
    }
  }
  console.log($('#cl_testimonial_item_'+postID));
  if( postType == 'testimonial' && $('#cl_testimonial_item_'+postID).length > 0 ){
    var $title = $( '.title', '#cl_testimonial_item_'+postID);
    if( $title.length > 0 ){
      $title.html(to.post_title);
    }
  }
  
}

CL_POSTMESSAGE.meta_post_content = function(to, value, postType, postID){

  if( postType == 'staff' && $('#cl_team_item-'+postID).length > 0 ){
    var $desc = $( '.team-desc', '#cl_team_item-'+postID);
    if( $desc.length > 0 ){
      $desc.html('- '+to.post_content);
    }
  }

  if( postType == 'testimonial' && $('#cl_testimonial_item_'+postID).length > 0 ){
    var $title = $( '.content', '#cl_testimonial_item_'+postID);
    if( $title.length > 0 ){
      $title.html('"'+to.post_content+'"');
    }
  }
  
}


CL_POSTMESSAGE.meta_page_inner_content_padding_top = function( to ){
  $( '#content' ).css('paddingTop', to+'px');
}


  
if(!_.isUndefined(parent.wp.customize.settings.settings)){
  
    _.each(parent.wp.customize.settings.settings, function(key, setting){

        if(!_.isUndefined(CL_POSTMESSAGE[setting]) ){
          wp.customize( setting, function(value){
            value.bind( function(to){
              
              if(!_.isUndefined(CL_POSTMESSAGE[setting]))
                CL_POSTMESSAGE[setting](to, value);
            });
          });
        }
        
    });
}


} )( jQuery );