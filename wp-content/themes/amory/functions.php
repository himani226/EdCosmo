<?php
add_action( 'after_setup_theme', 'amory_theme_setup' );
function amory_theme_setup() {
	/*woocommerce support*/
	add_theme_support( 'post-formats', array( 'link', 'gallery', 'video' , 'audio', 'quote') );
	/*woocommerce support*/
	add_theme_support('woocommerce'); // so they don't advertise their themes :)	
	/*feed support*/
	add_theme_support( 'automatic-feed-links' );
	/*post thumb support*/
	add_theme_support( 'post-thumbnails' ); // this enable thumbnails and stuffs
	/*title*/
	add_theme_support( 'title-tag' );
	/*lang*/
	load_theme_textdomain( 'amory', get_template_directory() . '/lang' );
	/*setting thumb size*/
	add_image_size( 'amory-gallery', 120,80, true ); 
	add_image_size( 'amory-widget', 255,170, true );
	add_image_size( 'amory-postBlock', 1160, 770, true );
	add_image_size( 'amory-related', 345,230, true );
	add_image_size( 'amory-postGridBlock', 590,390, true );
	add_image_size( 'amory-postGridBlock-2', 590,437, true );	


	register_nav_menus(array(
	
			'amory_mainmenu' => esc_html__('Main Menu','amory'),
			'amory_respmenu' => esc_html__('Responsive Menu','amory'),	
			'amory_scrollmenu' => esc_html__('Scroll Menu','amory'),	
			
	));	
	
	
	
	
	
	// Responsive walker menu
	class amory_Walker_Responsive_Menu extends Walker_Nav_Menu {
		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			global $wp_query;		
			$item_output = $attributes = $prepend ='';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( '', array_filter( $classes ), $item ) );			
			$class_names = ' class="'. esc_attr( $class_names ) . '"';			   
			// Create a visual indent in the list if we have a child item.
			$visual_indent = ( $depth ) ? str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>', $depth) : '';
			// Load the item URL
			$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
			// If we have hierarchy for the item, add the indent, if not, leave it out.
			// Loop through and output each menu item as this.
			if($depth != 0) {
				$item_output .= '<a '. $class_names . $attributes .'>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i>' . $item->title. '</a><br>';
			} else {
				$item_output .= '<a ' . $class_names . $attributes .'><strong>'.$prepend.$item->title.'</strong></a><br>';
			}
			// Make the output happen.
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	
	// Main walker menu	
	class amory_Walker_Main_Menu extends Walker_Nav_Menu
	{		
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		   $this->curItem = $item;
		   global $wp_query;
		   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		   $class_names = $value = '';
		   $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		   $class_names = ' class="'. esc_attr( $class_names ) . '"';
		   $image  = ! empty( $item->custom )     ? ' <img src="'.esc_attr($item->custom).'">' : '';
		   $output .= $indent . '<li id="menu-item-'.rand(0,9999).'-'. $item->ID . '"' . $value . $class_names .'>';
		   $attributes_title  = ! empty( $item->attr_title ) ? ' <i class="fa '  . esc_attr( $item->attr_title ) .'"></i>' : '';
		   $attributes  = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   $prepend = '';
		   $append = '';
		   if($depth != 0)
		   {
				$append = $prepend = '';
		   }
			$item_output = $args->before;
			$item_output .= '<a '. $attributes .'>';
			$item_output .= $attributes_title.$args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $args->link_after;
			$item_output .= '</a>';	
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	
	

}

function amory_theme_setup_sidebar() {
	
	
	$amory_sidebars = array(
	array(
		'id' => 'amory_sidebar',
		'name' => esc_attr__('Main sidebar','amory'),
    ),	
 	
    array(
        'id' => 'amory_sidebar_footer1',
        'name' => esc_attr__('Footer sidebar 1','amory'),
    ),  
    array(
        'id' => 'amory_footer2',
        'name' => esc_attr__('Footer sidebar 2','amory'),
    ), 
    array(
        'id' => 'amory_footer3',
        'name' => esc_attr__('Footer sidebar 3','amory'),
    ), 	
    array(
		'id' => 'amory_sidebar-top-left',
		'name' => esc_attr__('Top sidebar left','amory'),
    ),
    array(
        'id' => 'amory_sidebar-top-right',
        'name' => esc_attr__('Top sidebar right','amory'),
    ),	
	
    array(
        'id' => 'sidebar-under-header-fullwidth',
        'name' => esc_attr__('Under header fullwidth','amory'),
    ), 
    array(
        'id' => 'sidebar-under-header-right',
        'name' => esc_attr__('Sidebar under header right','amory'),
    ), 
    array(
        'id' => 'sidebar-under-header-left',
        'name' => esc_attr__('Sidebar under header left','amory'),
    ), 	
    array(
        'id' => 'sidebar-footer-fullwidth',
        'name' => esc_attr__('Sidebar above footer full width','amory'),
      'description'   => 'Widgets shown in the flyout of the header',
    ), 	
    array(
        'id' => 'sidebar-footer-left',
        'name' => esc_attr__('Sidebar above footer left','amory'),
      'description'   => 'Widgets shown in the flyout of the header',
    ), 	
    array(
        'id' => 'sidebar-footer-right',
        'name' => esc_attr__('Sidebar above footer right','amory'),
      'description'   => 'Widgets shown in the flyout of the header',
    ), 	
    array(
        'id' => 'amory_sidebar-logo',
        'name' => esc_attr__('Sidebar for advert in logo area','amory'),
      'description'   => 'Widgets shown in the flyout of the header',
    ), 	
  );

  $defaults = array(
    'name'          => 'Sidebar main',
    'id'            => 'amory_sidebar',
    'description'   => 'Amory sidebar',
    'class'         => '',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="widget-line"></div>'
  );

  foreach( $amory_sidebars as $sidebar ) {
    $args = wp_parse_args( $sidebar, $defaults );
    register_sidebar( $args );
  }





	
}

add_action( 'widgets_init', 'amory_theme_setup_sidebar' );
    

define('BOX_PATH', get_template_directory() . '/includes/boxes/');
define('OPTIONS', 'of_options_pmc'); // Name of the database row where your options are stored
/*theme options*/
require( trailingslashit( get_template_directory() ) . 'option-tree/assets/theme-mode/functions.php' );
require_once (get_template_directory() . '/option-tree/import/plugins/options-importer.php');   // Options panel settings and custom settings
add_option('IMPORT_AMORY_OPTION', 'false');
add_option('IMPORT_OLD_OPTIONS', 'false');


if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	if(get_option('IMPORT_AMORY_OPTION') == 'false'){
		import(get_template_directory() . '/option-tree/import/options.json');
		amory_options('empty-skin');
		update_option('IMPORT_AMORY_OPTION', 'true');
		update_option('IMPORT_OLD_OPTIONS', 'true' );
		wp_redirect(  esc_url_raw(admin_url( 'themes.php?page=ot-theme-options#section_import' )) );
	}
	else{
		wp_redirect(  esc_url_raw(admin_url( 'themes.php?page=ot-theme-options' )) );
	}
}

// Build Options

$includes =  get_template_directory() . '/includes/';
$widget_includes =  get_template_directory() . '/includes/widgets/';
/* include custom widgets */
require_once ($widget_includes . 'recent_post_widget.php'); 
require_once ($widget_includes . 'popular_post_widget.php');
require_once ($widget_includes . 'social_widget.php');
require_once ($widget_includes . 'post_widget.php');
require_once ($widget_includes . 'post_slider_widget.php');
require_once ($widget_includes . 'video_widget.php');
/* include scripts */
function amory_scripts() {
	/*scripts*/
	wp_enqueue_script('jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate.js', array('jquery'),true,true);		
	wp_enqueue_script('fitvideos', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'),true,false);	
	wp_enqueue_script('scrollto', get_template_directory_uri() . '/js/jquery.scrollTo.js', array('jquery'),true,true);	
	//wp_enqueue_script('retinaimages', get_template_directory_uri() . '/js/retina.min.js', array('jquery'),true,true);	
	wp_enqueue_script('amory_customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'),true,true);  	      
	wp_enqueue_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'),true,true);
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'),true,true);
	wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', array('jquery'),true,true);		
	wp_register_script('news', get_template_directory_uri() . '/js/jquery.li-scroller.1.0.js', array('jquery'),true,true);  
	wp_enqueue_script('gistfile', get_template_directory_uri() . '/js/gistfile_pmc.js', array('jquery') ,true,true);  
	wp_enqueue_script('bxSlider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery') ,true,false);  	
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery') ,true,true);  
	wp_enqueue_script('infinity', get_template_directory_uri() . '/js/pmc_infinity.js', array('jquery') ,true,false);  	
	wp_enqueue_script('jquery-ui-tabs');
	/*style*/
	
	wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

	$css_dir = get_template_directory() . '/css/'; // Shorten code, save 1 call
	ob_start(); // Capture all output (output buffering)
	require($css_dir . 'style_options.php'); // Generate CSS
	$css = ob_get_clean(); // Get generated CSS (output buffering)
    wp_add_inline_style( 'style', $css );

	wp_enqueue_script('font-awesome_pms', 'https://use.fontawesome.com/30ede005b9.js' , '',null);				
}
add_action( 'wp_enqueue_scripts', 'amory_scripts' );
require_once ($includes . 'class-tgm-plugin-activation.php');



/*shorcode to excerpt*/
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt'  ); //Remove the filter we don't want
add_filter( 'get_the_excerpt', 'pmc_wp_trim_excerpt' ); //Add the modified filter
add_filter( 'the_excerpt', 'do_shortcode' ); //Make sure shortcodes get processed

function pmc_wp_trim_excerpt($text = '') {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		//$text = strip_shortcodes( $text ); //Comment out the part we don't want
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}


/*add boxed to body class*/

add_filter('body_class','amory_body_class');

function amory_body_class($classes) {
	$amory_data = get_option(OPTIONS);
	$class = '';
	if(!empty($amory_data['use_boxed'])){
		$classes[] = 'amory_boxed';
	}
	return $classes;
}

/* custom breadcrumb */
function amory_breadcrumb($title = false) {
	$amory_data = get_option(OPTIONS);
	$breadcrumb = '';
	if (!is_home()) {
		if($title == false){
			$breadcrumb .= '<a href="';
			$breadcrumb .=  esc_url(home_url('/'));
			$breadcrumb .=  '">';
			$breadcrumb .= esc_html__('Home', 'amory');
			$breadcrumb .=  "</a> &#187; ";
		}
		if (is_single()) {
			if (is_single()) {
				$name = '';
				if($title == false){
					$breadcrumb .= $name .' &#187; <span>'. get_the_title().'</span>';
				}
				else{
					$breadcrumb .= get_the_title();
				}
			}	
		} elseif (is_page()) {
			$breadcrumb .=  '<span>'.get_the_title().'</span>';
		}
		else if(is_tag()){
			$tag = get_query_var('tag');
			$tag = str_replace('-',' ',$tag);
			$breadcrumb .=  '<span>'.$tag.'</span>';
		}
		else if(is_search()){
			$breadcrumb .= esc_html__('Search results for ', 'amory') .'"<span>'.get_search_query().'</span>"';			
		} 
		else if(is_category()){
			$cat = get_query_var('cat');
			$cat = get_category($cat);
			$breadcrumb .=  '<span>'.$cat->name.'</span>';
		}
		else if(is_archive()){
			$breadcrumb .=  '<span>'.esc_html__('Archive','amory').'</span>';
		}	
		else{
			$breadcrumb .=  esc_html__('Home','amory');
		}

	}
	return $breadcrumb ;
}
/* social share links */
function amory_socialLinkSingle($link,$title) {
	$social = '';
	$social  .= '<div class="addthis_toolbox">';
	$social .= '<div class="custom_images">';
	$share_options = ot_get_option( 'single_display_share_select' );
	if(!empty($share_options[0])){
	$social .= '<a class="addthis_button_facebook" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'" ><i class="fa fa-facebook"></i></a>';
	}
	if(!empty($share_options[1])){
	$social .= '<a class="addthis_button_twitter" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-twitter"></i></a>';  
	}
	if(!empty($share_options[2])){
	$social .= '<a class="addthis_button_pinterest_share" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-pinterest"></i></a>'; 
	}
	if(!empty($share_options[3])){
	$social .= '<a class="addthis_button_google_plusone_share" addthis:url="'.esc_url($link).'" g:plusone:count="false" addthis:title="'.esc_attr($title).'"><i class="fa fa-google-plus"></i></a>'; 	
	}
	if(!empty($share_options[4])){
	$social .= '<a class="addthis_button_stumbleupon" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-stumbleupon"></i></a>';
	}
	if(!empty($share_options[5])){
	$social .= '<a class="addthis_button_vk" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-vk"></i></a>';
	}	
	if(!empty($share_options[6])){
	$social .= '<a class="addthis_button_whatsapp" addthis:url="'.esc_url($link).'" addthis:title="'.esc_attr($title).'"><i class="fa fa-whatsapp"></i></a>';
	}		
	$social .='</div><script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js"></script>';	
	$social .= '</div>'; 
	echo $social;
	
	
}
/* links to social profile */
function amory_socialLink() {
	$social = '';
	$amory_data = get_option(OPTIONS); 
	$icons = $amory_data['socialicons'];
	if(is_array($icons)){
		foreach ($icons as $icon){
			$social .= '<a target="_blank"  href="'.esc_url($icon['link']).'" title="'.esc_attr($icon['title']).'"><i class="fa '.esc_attr($icon['url']).'"></i></a>';	
		}
	}
	echo $social;
}

add_filter('the_content', 'amory_addlightbox');
/* add lightbox to images*/
function amory_addlightbox($content)
{	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox[%LIGHTID%]"$6>';
    $content = preg_replace($pattern, $replacement, $content);
	if(isset($post->ID))
		$content = str_replace("%LIGHTID%", $post->ID, $content);
    return $content;
}
/* remove double // char */
function amory_stripText($string) 
{ 
    return str_replace("\\",'',$string);
} 
	
/* custom post types */	
add_action('save_post', 'amory_update_post_type');
add_action("admin_init", "amory_add_meta_box");



function amory_add_meta_box(){
	add_meta_box("amory_post_type", "Amory options", "amory_post_type", "post", "normal", "high");	
	
}	



function amory_post_type(){
	global $post;
	$amory_data = get_post_custom(get_the_id());

	if (isset($amory_data["video_post_url"][0])){
		$video_post_url = $amory_data["video_post_url"][0];
	}else{
		$video_post_url = "";
	}	
	
	if (isset($amory_data["link_post_url"][0])){
		$link_post_url = $amory_data["link_post_url"][0];
	}else{
		$link_post_url = "";
	}	
	
	if (isset($amory_data["audio_post_url"][0])){
		$audio_post_url = $amory_data["audio_post_url"][0];
	}else{
		$audio_post_url = "";
	}


?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">		
            <tr class="videoonly" style="border-bottom:1px solid #000;">
            	<td><label>Video URL(*required) - add if you select video post: <i style="color: #999999;"></i></label><br><input name="video_post_url" value="<?php echo esc_attr($video_post_url); ?>" /> </td>	
			</tr>		
            <tr class="linkonly" >
            	<td><label>Link URL - add if you select link post : <i style="color: #999999;"></i></label><br><input name="link_post_url"  value="<?php echo esc_attr($link_post_url); ?>" /></td>
            </tr>				
            <tr class="audioonly">
            	<td><label>Audio URL - add if you select audio post (audio from <a target="_blank"  href="https://soundcloud.com/">SoundCloud</a>)<br>You also need to install plugin <a target="_blank" href="https://wordpress.org/plugins/soundcloud-shortcode/">SoundCloud Shortcode</>: <i style="color: #999999;"></i></label><br><input name="audio_post_url"  value="<?php echo esc_attr($audio_post_url); ?>" /></td>
            </tr>	
            <tr class="nooptions">
            	<td>No options for this post type.</td>
            </tr>				
        </table>
    </div>
	<style>
	div#portfolio-category-options table {width:100%;}
	div#portfolio-category-options td textarea {width:100%; height:80px}
	#portfolio-category-options input {width:100%}
	</style>
	<script>
	jQuery(document).ready(function(){	
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly , .nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .select_video,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}						
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}	
			
			jQuery("input[name=post_format]").change(function(){
			if (jQuery("input[name=post_format]:checked").val() == 'video'){
				jQuery('.videoonly').show();
				jQuery('.audioonly, .linkonly,.nooptions').hide();}
				
			else if (jQuery("input[name=post_format]:checked").val() == 'link'){
				jQuery('.linkonly').show();
				jQuery('.videoonly, .audioonly,.nooptions').hide();	}	
				
			else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
				jQuery('.videoonly, .linkonly,.nooptions').hide();	
				jQuery('.audioonly').show();}	
				
			else{
				jQuery('.videoonly').hide();
				jQuery('.audioonly').hide();
				jQuery('.linkonly').hide();
				jQuery('.nooptions').show();}				
		});
	});
	</script>	
      
<?php
	
}
function amory_update_post_type(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){

		if( isset($_POST["video_post_url"]) ) {
			update_post_meta($post->ID, "video_post_url", $_POST["video_post_url"]);
		}		
		if( isset($_POST["link_post_url"]) ) {
			update_post_meta($post->ID, "link_post_url", $_POST["link_post_url"]);
		}	
		if( isset($_POST["audio_post_url"]) ) {
			update_post_meta($post->ID, "audio_post_url", $_POST["audio_post_url"]);
		}							
		
	}
	
	
	
}
if( !function_exists( 'amory_fallback_menu' ) )
{

	function Amory_fallback_menu()
	{
		$current = "";
		if (is_front_page()){$current = "class='current-menu-item'";} 
		echo "<div class='fallback_menu'>";
		echo "<ul class='Amory_fallback menu'>";
		echo "<li $current><a href='".esc_url(esc_url(home_url('/')))."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order');
		echo "</ul></div>";
	}
}

add_filter( 'the_category', 'amory_add_nofollow_cat' );  

function amory_add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', "", $text); 
	return $text; 
}

/* get image from post */
function amory_getImage($id, $image){
	$return = '';
	if ( has_post_thumbnail($id) ){
		$return = get_the_post_thumbnail($id,$image);
		}
	else
		$return = '';
	
	return 	$return;
}

if ( ! isset( $content_width ) ) $content_width = 800;


function amory_add_this_script_footer(){ 
	$amory_data = get_option(OPTIONS);
	$amory_script = '	
		"use strict"; 
		jQuery(document).ready(function($){	
			jQuery(".searchform #s").attr("value","'. esc_html__("Search and hit enter...","amory").'");	
			jQuery(".searchform #s").focus(function() {
				jQuery(".searchform #s").val("");
			});
			
			jQuery(".searchform #s").focusout(function() {
				if(jQuery(".searchform #s").attr("value") == "")
					jQuery(".searchform #s").attr("value","'. esc_html__("Search and hit enter...","amory") .'");
			});		
				
		});	
		';
	if(isset($amory_data['custom_javascript'])) {$amory_script = $amory_script . $amory_data['custom_javascript'];}
	wp_add_inline_script( 'amory_customjs', $amory_script );
}

add_action( 'wp_enqueue_scripts', 'amory_add_this_script_footer' );

function amory_security($string){
	echo stripslashes(wp_kses(stripslashes($string),array('img' => array('src' => array(),'alt'=>array()),'a' => array('href' => array()),'span' => array(),'h2' => array(),'div' => array('class' => array()),'b' => array(),'strong' => array(),'br' => array(),'p' => array()))); 

}

/* SEARCH FORM */
function amory_search_form( $form ) {
	$form = '<form method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<i class="fa fa-search search-desktop"></i>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'amory_search_form' );



	add_action('save_post', 'amory_update_post_rev');
	add_action("admin_init", "amory_add_rev");
	
	function amory_add_rev(){
	
	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			"amory_post_content", "Amory Options", "amory_post_content",
			$screen,'side','high'
		);
	}	
		
		
	}	
	


	
	function amory_post_content(){	
		global $post;	
		$amory_data = get_post_custom(get_the_id());
		if (isset($amory_data["custom_post_rev"][0])){		
			$custom_post_rev = $amory_data["custom_post_rev"][0];	
		}else{		
			$custom_post_rev = "";	
		}		
		global $wp_registered_sidebars;
		if (isset($amory_data["sidebar"][0])){
			$sidebar = $amory_data["sidebar"][0];
		}else{
			$sidebar = "";
		}	?>	
         <table cellpadding="15" cellspacing="0">	
			<tr class="sidebar">
			<td><label>Select custom sidebar for deals page: </label>	
			<br>
		     <select id="sidebar" name="sidebar">
				<?php foreach ( $wp_registered_sidebars as $sidebar_out ) : ?>
					  
					<option value="<?php echo esc_attr($sidebar_out['id']); ?>"<?php if($sidebar_out['id'] == $sidebar) echo 'selected'; ?>><?php echo esc_attr($sidebar_out['name']); ?></option>
				<?php endforeach; ?>
			</select>	
			</td>
			</tr>
			<tr>
			<td><label>Select custom revolution slider: </label>				
			<br>	
				<?php if(shortcode_exists( 'rev_slider')) {  ?>
				<select id="custom_post_rev"  name="custom_post_rev">	
				<option value="empty" <?php if($custom_post_rev == 'empty') echo 'selected'; ?>>Empty</option>	
				<?php 				
				$slider = new RevSlider();				
				$arrSliders = $slider->getArrSliders();				
				if(!empty($arrSliders)){ 	
					$revSliderArray = array();					
					foreach($arrSliders as $sliders){ ?>
						<option value="<?php echo esc_attr($sliders->getAlias()); ?>" <?php if($sliders->getAlias() == $custom_post_rev) echo 'selected'; ?>>
						<?php echo esc_attr($sliders->getTitle()) ?>
						</option>						
					<?php
					} 						
				}																
				?>

				<?php } ?>
			</td>            
			</tr>		
		</table>  
	<script>
	jQuery(document).ready(function(){	
			if (jQuery("#page_template").val() == 'page-sidebar-deals.php'){
				jQuery('.sidebar').show();

				}				
			else{
				jQuery('.sidebar').hide();}	
				
			jQuery("#page_template").change(function(){
			if (jQuery("#page_template").val() == 'page-sidebar-deals.php'){
				jQuery('.sidebar').show();

				}				
			else{
				jQuery('.sidebar').hide();}					
		});				
			
	});
	</script>		
		
	<?php	
	}
	
	function amory_update_post_rev()
	{
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){

		if( isset($_POST["custom_post_rev"]) ) {
			update_post_meta($post->ID, "custom_post_rev", $_POST["custom_post_rev"]);
		}		
		if( isset($_POST["sidebar"]) ) {
			update_post_meta($post->ID, "sidebar", $_POST["sidebar"]);
		}	
	}
	}
	
/*the_excerpt*/
add_filter( 'get_the_excerpt', 'strip_shortcodes', 20 );



function amory_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'amory_excerpt_more' );


add_filter( 'the_content_more_link', 'amory_modify_read_more_link' );
function amory_modify_read_more_link() {
	return '<div class="amory-read-more"><a class="more-link" href="' . get_permalink() . '">'.esc_html__('Continue reading','amory').'</a></div>';
}
/*set excerpt lenght for grid layout*/
if(!function_exists('amory_custom_excerpt_length')){
	function amory_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'amory_custom_excerpt_length', 999 );
}

add_filter('dynamic_sidebar_params','amory_blog_widgets');
 
/* Register our callback function */
function amory_blog_widgets($params) {	 
 
     global $blog_widget_num; //Our widget counter variable
 
     //Check if we are displaying "Footer Sidebar"
      if(isset($params[0]['id']) && $params[0]['id'] == 'sidebar-delas-blog'){
         $blog_widget_num++;
		$divider = 2; //This is number of widgets that should fit in one row		
 
         //If it's third widget, add last class to it
         if($blog_widget_num % $divider == 0){
	    $class = 'class="last '; 
	    $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);
	 }
 
	}
 
      return $params;
}

/*reading time*/
function amory_estimated_reading_time( $id) {
	$post = get_post($id);
    $words = str_word_count( strip_tags( $post-> post_content ) );
    $minutes = floor( $words / 200 );
	if($minutes < 1) $minutes = 1;
	wp_reset_postdata(); 
    return $minutes;
}

/*post options*/
function amory_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function amory_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    amory_set_post_views($post_id);
}
add_action( 'wp_head', 'amory_track_post_views');

function amory_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

/*globals*/

function amory_globals($var){
	$amory_data = get_option(OPTIONS);
	if(!empty($amory_data[$var])){
		return true;
	}
	else{
		return false;
	}

}

function amory_data($data){
	$amory_data = get_option(OPTIONS);
	if(isset($amory_data[$data])){
		return $amory_data[$data];	
	} else {
		return '';	
	}
}

function amory_block_one(){
$amory_data = get_option(OPTIONS);
?>
	<div class="block1">
		<a href="<?php echo esc_url($amory_data['block1_link1']) ?>" title="Image">
		
			<div class="block1_img">
				<img src="<?php echo esc_url($amory_data['block1_img1']) ?>" alt="<?php echo esc_html($amory_data['block1_text1']) ?>">
			</div>
			
			<div class="block1_all_text">
				<div class="block1_text">
					<p><?php echo esc_html($amory_data['block1_text1']) ?></p>
				</div>
				<div class="block1_lower_text">
					<p><?php echo esc_html($amory_data['block1_lower_text1']) ?></p>
				</div>
			</div>									
		</a>
		<a href="<?php echo esc_url($amory_data['block1_link2']) ?>" title="Image" >							
			
			<div class="block1_img">
				<img src="<?php echo esc_url($amory_data['block1_img2']) ?>" alt="<?php echo esc_html($amory_data['block1_text2']) ?>">
			</div>
			
			<div class="block1_all_text">
				<div class="block1_text">
					<p><?php echo esc_html($amory_data['block1_text2']) ?></p>
				</div>
				<div class="block1_lower_text">
					<p><?php echo esc_html($amory_data['block1_lower_text2']) ?></p>
				</div>
			</div>									
			
		</a>
		<a href="<?php echo esc_url($amory_data['block1_link3']) ?>" title="Image" >								
			<div class="block1_img">
				<img src="<?php echo esc_url($amory_data['block1_img3']) ?>" alt="<?php echo esc_html($amory_data['block1_text3']) ?>">
			</div>
			
			<div class="block1_all_text">
				<div class="block1_text">
					<p><?php echo esc_html($amory_data['block1_text3']) ?></p>
				</div>
				<div class="block1_lower_text">
					<p><?php echo esc_html($amory_data['block1_lower_text3']) ?></p>
				</div>
			</div>
			
		</a>							
	</div>
<?php
}


function amory_block_two(){
$amory_data = get_option(OPTIONS);
?>
	<div class="block2">
		<div class="block2_content">
					
			<div class="block2_img">
				<img class="block2_img_big" src="<?php echo esc_url($amory_data['block2_img']) ?>" alt="Image">
			</div>						
			
			<div class="block2_text">
				<p><?php amory_security($amory_data['block2_text']) ?></p>
			</div>
		</div>								
	</div>
<?php
}


/*woocomerce*/
if(class_exists( 'woocommerce' )){
	add_filter( 'woocommerce_output_related_products_args', 'amory_related_products_args' );
	  function amory_related_products_args( $args ) {

		$args['posts_per_page'] = 3; // 4 related products
		$args['columns'] = 3; // arranged in 2 columns
		return $args;
	}
	if(amory_data("woocommerc_shop_display") != 0 ) {
		add_filter( 'loop_shop_per_page', function($cols){ return amory_data("woocommerc_shop_display");}, 20 );
	}

	if(amory_data("woocommerc_shop_display_row") != 0) {
		add_filter( 'loop_shop_columns', function( $columns){return amory_data("woocommerc_shop_display_row");} );
	}
	function amory_before_shop_loop_item() {
	if((is_product() && amory_globals('display_woocommerce_single_sidebar') ) || ((is_product_category() || is_product_tag() || is_shop() )&& amory_globals('display_woocommerce_shop_sidebar'))) {
	echo '<div class="shop shop-sidebar">';
	} else {echo '<div class="shop">';}
	}
	function amory_after_shop_loop_item() {
	do_action( 'woocommerce_sidebar' );
	echo '</div>';
	}


	add_action( 'woocommerce_before_main_content', 'amory_before_shop_loop_item', 10 );
	add_action( 'woocommerce_after_main_content', 'amory_after_shop_loop_item', 10 );



	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		function amory_woocommerce_image_dimensions() {
			global $pagenow;
		 
			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			$catalog = array(
				'width' 	=> '680',	// px
				'height'	=> '560',	// px
				'crop'		=> 1 		// true
			);
			

			$single = array(
				'width' 	=> '600',	// px
				'height'	=> '500',	// px
				'crop'		=> 1 		// true
			);

			$thumbnail = array(
				'width' 	=> '280',	// px
				'height'	=> '200',	// px
				'crop'		=> 1 		// false
			);

			// Image sizes
			update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
			update_option( 'shop_single_image_size', $single ); 		// Single product image
			update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		}

		add_action( 'after_switch_theme', 'amory_woocommerce_image_dimensions', 1 );
		
	}
}

/*import plugins*/

add_action( 'tgmpa_register', 'amory_required_plugins' );

function amory_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
		
        array(
            'name'               => esc_html__('Revolution Slider','laura'), // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'revslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '6.2.22', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),		
		array(
				'name'      => esc_attr__('Clasic Editor','landscape-photo-pmc'),
				'slug'      => 'classic-editor',
				'required'  => false,
				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.				
			),		
		array(
				'name'      => esc_attr__('Shortcode Ultimate','amory'),
				'slug'      => 'shortcodes-ultimate',
				'required'  => false,
			),		
		array(
				'name'      => esc_attr__('Contact Form 7','amory'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),					
		array(
				'name'      => esc_attr__('MailPoet Newsletters','amory'),
				'slug'      => 'wysija-newsletters',
				'required'  => false,
			),			
		array(
				'name'      => esc_attr__('Instagram Feed','amory'),
				'slug'      => 'instagram-feed',
				'required'  => false,
			),			
		array(
				'name'      => esc_attr__('SoundCloud Shortcode','amory'),
				'slug'      => 'soundcloud-shortcode',
				'required'  => false,
			),	
		array(
				'name'      => esc_attr__('WooCommerce','amory'),
				'slug'      => 'woocommerce',
				'required'  => false,
			),				
			
			
			
				
    );

    $config = array(
        'id'           => 'amory',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/includes/plugins/',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'amory' ),
            'menu_title'                      => __( 'Install Plugins', 'amory' ),
            'installing'                      => __( 'Installing Plugin: %s', 'amory' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'amory' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'amory' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'amory' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'amory' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'amory' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'amory' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'amory' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'amory' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'amory' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'amory' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'amory' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'amory' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'amory' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'amory' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

?>