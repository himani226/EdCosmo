"use strict";
	
jQuery(document).ready(function(){
	jQuery('.menu li a').click(function() {
		var href = jQuery(this).attr('href');
		jQuery("html, body").animate({ scrollTop: jQuery(href).offset().top - 90 }, 1000);
		return false;
	});
});


/* RESPONSIVE VIDEOS */

jQuery(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
    jQuery("body, .blogpostcategory").fitVids();
	
  });
  

 

/*blog hover image*/
jQuery(document).ready(function(){
	jQuery( ".blogpostcategory" ).each(function() {		
		var img = jQuery(this).find('img');
		var height = img.height();
		var width = img.width();
		var over = jQuery(this).find('a.overdefultlink');
		over.css({'width':width+'px', 'height':height+'px'});
		var margin_left = parseInt(width)/2 - 18
		var margin_top = parseInt(height)/2 - 18
		over.css('backgroundPosition', margin_left+'px '+margin_top+'px');
	});		
});	

jQuery.fn.isOnScreen = function(){
     
    var win = jQuery(window);
     
    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    
	if(this.offset()){
    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
     
    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
     }
};
/*resp menu*/
jQuery(document).ready(function(){	
jQuery('.resp_menu_button').click(function() {
if(jQuery('.event-type-selector-dropdown').attr('style') == 'display: block;')
jQuery('.event-type-selector-dropdown').slideUp({ duration: 500, easing: "easeInOutCubic" });
else
jQuery('.event-type-selector-dropdown').slideDown({ duration: 500, easing: "easeInOutCubic" });
});	
jQuery('.event-type-selector-dropdown').click(function() {
jQuery('.event-type-selector-dropdown').slideUp({ duration: 500, easing: "easeInOutCubic" });
});
});



/*add submenu class*/
jQuery(document).ready(function(){
jQuery('.menu > li').each(function() {
if(jQuery(this).find('ul').size() > 0 ){
jQuery(this).addClass('has-sub-menu');
}
});
});
/*animate menu*/
jQuery(document).ready(function(){
jQuery('ul.menu > li').hover(function(){
jQuery(this).find('ul').stop(true,true).fadeIn(300);
},
function () {
jQuery(this).find('ul').stop(true,true).fadeOut(300);
});
});
/*add lightbox*/
jQuery(document).ready(function(){
jQuery(".gallery a").attr("rel", "lightbox[gallery]");
});
jQuery(document).ready(function(){
var menu = jQuery('.mainmenu');
jQuery( window ).scroll(function() {
if(!menu.isOnScreen() && jQuery(this).scrollTop() > 350){ 
jQuery(".totop").fadeIn(200);
jQuery(".fixedmenu").slideDown(200);}
else{
jQuery(".fixedmenu").slideUp(200);
jQuery(".totop").fadeOut(200);}
});
});

/* lightbox*/
function loadprety(){
jQuery(".gallery a").attr("rel", "lightbox[gallery]").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false,deeplinking:false});
}
jQuery(document).ready(function(){
jQuery('.gototop').click(function() {
jQuery('html, body').animate({scrollTop:0}, 'medium');
});
});
/*search*/
jQuery(document).ready(function(){
if(jQuery('.widget_search').length>0){
jQuery('#sidebarsearch input').val('Search...');
jQuery('#sidebarsearch input').focus(function() {
jQuery('#sidebarsearch input').val('');
});
jQuery('#sidebarsearch input').focusout(function() {
jQuery('#sidebarsearch input').val('Search...');
});
}
jQuery('.top-search-form i').click(function() {
	jQuery('.top-search-form input').slideToggle( "fast", function() {});
});

});

/*tabs*/
jQuery(document).ready(function($){
  $(function() {
    $( "#pmc-tabs" ).tabs( { selected: 1 });
  });
});

jQuery(document).ready(function(){
jQuery('#pmc-tabs li a').click(function() {
jQuery('.content.blog .pmc-tabs').fadeOut(0).fadeIn(0);
});

jQuery('.tab1').click(function() {
jQuery('.infinity-more').show();
});

jQuery('.tab2').click(function() {
jQuery('.infinity-more').hide();
});

});


/*infinity scroll*/
jQuery(document).ready(function($){
$('#tabs-1').infinitescroll({
navSelector  : '.wp-pagenavi',    // selector for the paged navigation 
nextSelector : '.wp-pagenavi a:first',  // selector for the NEXT link (to page 2)
itemSelector : '#tabs-1',     // selector for all items you'll retrieve
delay: 300,
loading: {
	finishedMsg: '',
	msgText: '',
	speed: 0,
  },

  
 

}
);


$(window).unbind('.infscr');

$('.infinity-more').click(function(){	
  $(document).trigger('retrieve.infscr');
  $("body, .blogpostcategory").fitVids();
  setTimeout(function(){ addthis.toolbox('.addthis_toolbox');}, 1000);
  
  return false;
});
$(document).ajaxError(function(e,xhr,opt){
  if (xhr.status == 404) $('.infinity-more').remove();
});


});	

var addthis_config = addthis_config||{};
addthis_config.data_track_addressbar = false;
