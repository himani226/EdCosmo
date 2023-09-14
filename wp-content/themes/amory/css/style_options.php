<?php
$amory_data = get_option(OPTIONS); 
$use_bg = ''; $background = ''; $custom_bg = ''; $body_face = ''; $use_bg_full = ''; $bg_img = ''; $bg_prop = '';

function amory_google($string){
	$ot_google_fonts      = get_theme_mod( 'ot_google_fonts', array() );
	return  $ot_google_fonts[$string]['family'];
		  
}

if(!empty($amory_data['image_background'])) {
	$use_bg_full = $amory_data['image_background'];
	
}

if(!empty($amory_data['use_boxed'])){
	$use_boxed = $amory_data['use_boxed'];
}
else{
	$use_boxed = 0;
}



	$font_menu = amory_google($amory_data['menu_font']['face']);
	$font_quote = amory_google($amory_data['qoute_typography_settings']['face']);
	$font_heading = amory_google($amory_data['heading_font']['face']);
    $font_body = amory_google($amory_data['body_font']['face']);


?>


.block_footer_text, .quote-category .blogpostcategory, .quote-widget p, .quote-widget {font-family: <?php echo $font_quote; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
body {	 
	background:<?php echo $amory_data['body_background_color'].' '.$background ?>  !important;
	color:<?php echo $amory_data['body_font']['color']; ?>;
	font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;
	font-size: <?php echo $amory_data['body_font']['size']; ?>;
	font-weight: normal;
}

::selection { background: #000; color:#fff; text-shadow: none; }

h1, h2, h3, h4, h5, h6, .block1 p, .hebe .tp-tab-desc, .post-meta a, .blog-category a, .pmc-home-products-title, .gyges .tp-tab-title {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
h1 { 	
	color:<?php echo $amory_data['heading_font_h1']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h1']['size'] ?> !important;
	}
	
h2, .term-description p { 	
	color:<?php echo $amory_data['heading_font_h2']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h2']['size'] ?> !important;
	}

h3 { 	
	color:<?php echo $amory_data['heading_font_h3']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h3']['size'] ?> !important;
	}

h4 { 	
	color:<?php echo $amory_data['heading_font_h4']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h4']['size'] ?> !important;
	}	
	
h5 { 	
	color:<?php echo $amory_data['heading_font_h5']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h5']['size'] ?> !important;
	}	

h6 { 	
	color:<?php echo $amory_data['heading_font_h6']['color']; ?>;
	font-size: <?php echo $amory_data['heading_font_h6']['size'] ?> !important;
	}	

.pagenav a {font-family: <?php echo $font_menu; ?> !important;
			  font-size: <?php echo $amory_data['menu_font']['size'] ?>;
			  font-weight:<?php echo $amory_data['menu_font']['style'] ?>;
			  color:<?php echo $amory_data['menu_font']['color'] ?>;
}
.block1_lower_text p,.widget_wysija_cont .updated, .widget_wysija_cont .login .message, p.edd-logged-in, #edd_login_form, #edd_login_form p  {font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important;color:#444;font-size:14px;}

a, select, input, textarea, button{ color:<?php echo $amory_data['body_link_coler']; ?>;}
h3#reply-title, select, input, textarea, button, .link-category .title a{font-family: <?php echo $font_body; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}

.prev-post-title, .next-post-title, .blogmore, .more-link, .widget_products a span, .widget_top_rated_products a span, .widget_recently_viewed_products a span {font-family: <?php echo $font_heading; ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}

/* ***********************
--------------------------------------
------------MAIN COLOR----------
--------------------------------------
*********************** */

a:hover, span, .current-menu-item a, .blogmore, .more-link, .pagenav.fixedmenu li a:hover, .widget ul li a:hover,.pagenav.fixedmenu li.current-menu-item > a,.block2_text a,
.blogcontent a, .sentry a, .post-meta a:hover, .sidebar .social_icons i:hover,.blog_social .addthis_toolbox a:hover, .addthis_toolbox a:hover, .content.blog .single-date, a.post-meta-author, .block1_text p,
.grid .blog-category a, .pmc-main-menu li.colored a, #footer .widget ul li a:hover, .sidebar .widget ul li a:hover, #footer a:hover, .woocommerce ul.products li.product h3:hover,
.woocommerce .woocommerce-breadcrumb a:hover, .widget_products a span:hover, .widget_top_rated_products a span:hover, .widget_recently_viewed_products a span:hover

{
	color:<?php echo $amory_data['mainColor']; ?>;
}

.su-quote-style-default  {border-left:5px solid <?php echo $amory_data['mainColor']; ?>;}
.addthis_toolbox a i:hover, .cartTopDetails .product_list_widget  li a:hover {color:<?php echo $amory_data['mainColor']; ?> !important;}
 
/* ***********************
--------------------------------------
------------BACKGROUND MAIN COLOR----------
--------------------------------------
*********************** */

.top-cart, .widget_tag_cloud a:hover, .sidebar .widget_search #searchsubmit,
.specificComment .comment-reply-link:hover, #submit:hover,  .wpcf7-submit:hover, #submit:hover,
.link-title-previous:hover, .link-title-next:hover, .specificComment .comment-edit-link:hover, .specificComment .comment-reply-link:hover, h3#reply-title small a:hover, .pagenav li a:after,
.widget_wysija_cont .wysija-submit,.widget ul li:before, #footer .widget_search #searchsubmit, .amory-read-more a:hover, .blogpost .tags a:hover,
.mainwrap.single-default.sidebar .link-title-next:hover, .mainwrap.single-default.sidebar .link-title-previous:hover, .amory-home-deals-more a:hover, .top-search-form i:hover, .edd-submit.button.blue:hover,
ul#menu-top-menu, a.catlink:hover, .woocommerce ul.products li.product a.button.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.button.add_to_cart_button:hover, .cartTopDetails .product_list_widget  .buttons a:hover,
.woocommerce .cart .button:hover, .woocommerce .cart input.button:hover,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
.woocommerce-page input.button:hover, .woocommerce input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover,
nav.woocommerce-MyAccount-navigation li a:hover, .woocommerce-Message.woocommerce-Message--info.woocommerce-info a:hover,.woocommerce a.button:hover, .woocommerce-page a.button:hover,
.woocommerce a.added_to_cart:hover, .woocommerce-page a.added_to_cart:hover, .widget_product_search input[type=submit]:hover
  {
	background:<?php echo $amory_data['mainColor']; ?> ;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {background-color:<?php echo $amory_data['mainColor']; ?> ;}
.pagenav  li li a:hover {background:none;}
.edd-submit.button.blue:hover, .cart_item.edd_checkout a:hover,  .woocommerce-tabs ul.tabs li:hover, .description_tab.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active
 {background:<?php echo $amory_data['mainColor']; ?> !important;}
.link-title-previous:hover, .link-title-next:hover {color:#fff;}
#headerwrap {background:<?php echo $amory_data['header_background_color']; ?>;}
.pagenav {background:<?php echo $amory_data['menu_background_color']; ?>;}


#amory-slider-wrapper, .amory-rev-slider {padding-top:<?php echo $amory_data['rev_slider_margin']; ?>px;}

 /* ***********************
--------------------------------------
------------BOXED---------------------
-----------------------------------*/
<?php if($use_boxed == 0 &&  isset($amory_data['use_background']) && $amory_data['use_background'] == 1){ ?>
	body, .cf, .mainwrap, .post-full-width, .titleborderh2, .sidebar, div#amory-slider-wrapper, .block1 a, .block2   {
	background:<?php echo $amory_data['body_background_color'].' '.$background ?>  !important; 
	}
	
<?php	} ?>
 <?php if(isset($amory_data['use_boxed']) &&  $use_boxed == 1){ ?>
header,.outerpagewrap{background:none !important;}
header,.outerpagewrap,.mainwrap, div#amory-slider-wrapper, .block1 a, .block2, .custom-layout,.sidebars-wrap,#footer{background-color:<?php echo $amory_data['body_background_color'] ?> ;}
@media screen and (min-width:1220px){
body {width:1220px !important;margin:0 auto !important;}
.top-nav ul{margin-right: -21px !important;}
.mainwrap.shop {float:none;}
.pagenav.fixedmenu { width: 1220px !important;}
.bottom-support-tab,.totop{right:5px;}
<?php if($use_bg_full){ ?>
	body {
	background:<?php echo $amory_data['body_background_color'].' url("'.$use_bg_full ?>")  !important; 
	background-attachment:fixed !important;
	background-size:cover !important; 
	-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	}	
<?php	} ?>
 <?php if(!$use_bg_full){ ?>
	body {
	background:<?php echo $amory_data['body_background_color'] ?>  !important; 
	
	}
	
<?php	} ?>	
}
<?php } ?>
 
  <?php if(!empty($amory_data['image_background_header'])){ ?>
	header {
	background:<?php echo $amory_data['body_background_color'].' url('. $amory_data['image_background_header'] .')'; ?>  !important; 
	background-attachment:fixed !important;
	width:100%;
	-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.2);
	box-shadow:	0px 0px 5px 1px rgba(0,0,0,0.2);
	float:left;
	}	
	.top-wrapper ,.logo-wrapper , div#logo{background:none;}
<?php	} ?>
 <?php if(empty($amory_data['use_menu_back']) && !empty($amory_data['image_background_header'])){ ?>
	#headerwrap {background:none;}
<?php	} ?>
<?php if(is_active_sidebar( 'sidebar-under-header-left') || is_active_sidebar( 'sidebar-under-header-fullwidth' )) {?>
	.sidebars-wrap.top {margin-top:40px}
<?php } ?>
 <?php if(is_active_sidebar( 'sidebar-footer-fullwidth' ) || is_active_sidebar( 'sidebar-footer-left' )){ ?>
	.sidebars-wrap.bottom {margin-top:40px}
<?php } ?>

.top-wrapper {background:<?php echo $amory_data['top_menu_background_color']; ?>; color:<?php echo $amory_data['upper_bar_color'] ?>}
.top-wrapper i, .top-wrapper a, .top-wrapper div, .top-wrapper form input, .top-wrapper form i{color:<?php echo $amory_data['upper_bar_color'] ?> !important;}
.top-left .menu > li > a:hover {color:<?php echo $amory_data['mainColor']; ?> !important;}

.pagenav {background:<?php echo $amory_data['menu_background_color']; ?>;border-top:<?php echo $amory_data['menu_top_border']; ?>px solid #000;border-bottom:<?php echo $amory_data['menu_bottom_border']; ?>px solid #000;}

/*hide header*/
<?php if(!empty($amory_data['display_header'])) { ?>
	.home #headerwrap {display:none;}
<?php } ?>

/*footer style option*/
#footer {background: <?php echo amory_data('footer_background_color'); ?>}
#footer p, #footer div, #footer a, #footer input, #footer, #footer h1, #footer h2, #footer h3 , #footer h4 , #footer i{color:<?php echo amory_data('footer_text_color'); ?>} 


/*woocommerce columns*/
<?php
if(class_exists( 'woocommerce' )){
	switch (amory_data('woocommerc_shop_display_row')) {
		case 2:
			echo ".woocommerce ul.products li.product, .woocommerce-page ul.products li.product {width: 48.7%;}";
			break;
		case 3:
			echo ".woocommerce ul.products li.product, .woocommerce-page ul.products li.product {width: 31.65%;}";
			break;
		case 4:
			echo ".woocommerce ul.products li.product, .woocommerce-page ul.products li.product {width:23.1%;}";
			break;		
	}

	/*woocommerce breadcrumb */

	if(amory_globals('display_woocommerce_breadcrumb') == '') { echo 'nav.woocommerce-breadcrumb {display:none}';};

	if((amory_globals('display_woocommerce_shop_sidebar') == '') && is_shop()){ echo '.woocommerce.woocommerce-page .sidebar {display:none;}';}
	if(amory_globals('display_woocommerce_single_sidebar') == ''){ echo '.single.single-product .sidebar{display:none;}';}
}
?>
/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo amory_stripText($amory_data['custom_style']) ?>
