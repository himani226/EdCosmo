<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'theme_install',
          'title'     => 'Installing the Theme',
          'content'   => 'After you have installed Wordpress, you have to install our Theme (Amory.zip). There are two ways of installing the Theme on your Wordpress:
<ul>
 	<li><strong>FTP Upload:</strong> Unzip the “Amory.zip” file and upload the contents into the /wp-content/themes folder on your server. If you get an error while activating the Theme uploaded via FTP, please ensure that <a href="http://premiumcoding.com/wp-content/uploads/2014/08/ftp-upload-opus.jpg">transfer type is set to binary</a>.</li>
 	<li><strong>Wordpress Dashboard: </strong>Navigate to Appearance > Add New Themes >Upload. Go to browser, and select the zipped theme folder. Hit “Install Now” and the theme will be uploaded and installed.</li>
</ul>
Download the zipped theme pack to your local computer from themeforest and extract the ZIP file contents to a folder on your local computer. If you do not do that and install the first package directly you will get the following error:

<strong> </strong>

<strong>The theme is missing the style.css stylesheet</strong>

<br><br>

So be sure that you are always installin the file called <strong>"AMORY.ZIP"</strong>

<br><br>

Once the theme is uploaded, you need to activate it. Go to Appearance > Themes and activate Amory Wordpress Theme. After the theme is activated, you need to install the required plugins for some extra functionality (Instagram, Contact Form and Shortcodes

Click on begin installing plugins and you will be able to install all neccessary plugins. If you need them later on, you can find them in the Recommended plugins directory in the package you installed from Themeforest.
<ul>
 	<li>Instagram feed - this plugin adds the instagram gallery just above the footer. Instructions on how to connect to instagram are available in the plugin itself. Plugin can be downloaded from Wordpress repository at: <a href="https://wordpress.org/plugins/instagram-feed/">https://wordpress.org/plugins/instagram-feed</a></li>
 	<li>Contact Form 7 - CONTACT FORM - this is a plugin that you will need of you want to add the contact form. Plugin can be downloaded from Wordpress repository at: <a href="http://wordpress.org/plugins/contact-form-7/">http://wordpress.org/plugins/contact-form-7/</a></li>
 	<li>Shortcodes Ultimate - this plugin adds the shortcodes. Plugin is not neccessary but if you wish to use some nice typography effects like dropcap, quotes and columns, you will have to install it. Plugin can be downloaded from Wordpress repository at: <a href="https://wordpress.org/plugins/shortcodes-ultimate/">https://wordpress.org/plugins/shortcodes-ultimate/</a></li>
 	<li>Twitter Feed - this is a plugin that you will need of you want to add the twitter feed. Plugin can be downloaded from Wordpress repository at: <a href="https://wordpress.org/plugins/recent-tweets-widget/">https://wordpress.org/plugins/recent-tweets-widget/</a></li>
 	<li>Facebook Feed - this is a plugin that you will need of you want to add the facebook feed. Plugin can be downloaded from Wordpress repository at: <a href="https://wordpress.org/plugins/facebook-pagelike-widget/">https://wordpress.org/plugins/facebook-pagelike-widget/</a></li>
 	<li>Revolution Slider - can be found in the Recommended plugins directory in the files downloaded from Themeforest.</li>
</ul>
<h2></h2>'
        ),
        array(
          'id'        => 'how_to_set_amory',
          'title'     => 'Demo Content - Theme looking like live preview',
          'content'   => 'AUTO IMPORT - After theme installation go to theme options and click on the Import tab. Read the instructions carefully (we recommend to run it only on fresh Wordpress installation). If the auto import fails for some reason below are instructions for manual import.

We prepared a XML file for demo import. In this Theme we are not using pmc importer since the Theme is minimal and very simple. Please follow these steps:
<ul>
 	<li>Install the Amory WordPress Theme</li>
 	<li>Import Demo content which is included with the Theme (in DEMO CONTENT directory)</li>
 	<li>To use it, go to Tools > Import > WordPress and upload the xml file, choose to import everything, hit the button and wait.</li>
 	<li>Set up the Home Page in Reading -> Settings</li>
 	<li>You might also have to set Menus locations under Appearance -> Menu -> Menu Settings</li>
</ul>'
        ),
        array(
          'id'        => 'how_to_set_the_theme_like_live_previews',
          'title'     => 'How to set the theme like live previews',
          'content'   => 'For exact settings for all 6 live demos please check the other document included in the documentation, named: Amory-HOW-TO-SET-DEMOS
<br><br>
TIMEOUT ERROR
<br><br>
If you get a timeout error while installing the demo content, you can contact your hosting provider and ask for a time increase (5 minutes should be enough on 99.9% of servers). Or you can follow the steps above and try to install the demo content manually. If you still have problems with installation, then please contact us via our support system at:  <a href="https://premiumcoding.com/wp-login.php?action=register">https://premiumcoding.com/wp-login.php?action=register</a>'
        ),
        array(
          'id'        => 'theme_s_options',
          'title'     => 'Theme\'s Options',
          'content'   => 'After activating the theme, you will notice that a new submenu item appeared under Appearance Tab called Theme\'s Options. To start customizing the Theme\'s settings click on Theme Options.'
        ),
        array(
          'id'        => 'general_settings',
          'title'     => 'General Settings',
          'content'   => '<strong>Logo, favicon and custom menus</strong> are set and added. Upload your logo, retina logo and custom logo for scroll if you need one (useful if you have transparent menu and need logos in different colors). You need to also upload a double sized logo for retina displays (be sure it is named like this Amory-logo1@2x.png with the @2x at the end).
<br><br>
Every part / block of the home page can be enabled or disabled. This goes for the 3 posts under the logo, about us section and the instagram block.
<br><br>
<strong>Responsive Mode</strong> can be disabled if you uncheck it.
<br><br>
<strong>Smooth Scroll </strong>can be disabled if you uncheck it.
<br><br>
<strong>Full width Page</strong> can be enabled or disabled (sidebar will be added).'
        ),
        array(
          'id'        => 'home_page_settings',
          'title'     => 'Home Page Settings',
          'content'   => 'The content of the home page is set here. If you have checked all the blocks in the general settings, here is the place to add content to it.
<br><br>
<strong>Uppper Block (three posts) - </strong>this is the part just below the logo. For each post you can upload the image and set title and url.
<br><br>
<strong>About us Block - </strong>the about us section is very straightforward and simple. Add the image and content text (just like seen in our full width demo).
<br><br>
<strong>Quote Block - </strong>this is the text just above the footer. Simply add the text.
<br><br>
<strong>Instagram block - </strong>simply add the title, your instagram username and link to your instagram profile. Detailed instructions on how to connect the plugin with your instagram account are available in the plugin itself at Settings - > Alpine:Instagram    -> General.'
        ),
        array(
          'id'        => 'styling_options',
          'title'     => 'Styling Options',
          'content'   => '<strong>Main Theme Color</strong> - color that is set throghout the Theme (red is default color for Amory Theme). Once you change the color please not that not all aspects of the site will change (some color will still be red). This is because on some parts of the Theme <strong>shortcodes</strong> are used. You need to change this manually as it gives you much more
<br><br>
<strong>freedom in color selection</strong> (it can be anything independant from theme\'s main color).
<br><br>

<strong>Boxed version</strong> - if you need a boxed version, check it here and then set the background color or image.
<br><br>
<strong>Custom Style</strong> - if you need to change CSS for certain parts of the Theme you can add it here (so you don’t have to edit the style.css).'
        ),
        array(
          'id'        => 'typograhy',
          'title'     => 'Typograhy',
          'content'   => ''
        ),
        array(
          'id'        => 'social_options__error_page_and_footer_options',
          'title'     => 'Social Options, Error Page and Footer Options',
          'content'   => 'Last three tabs are very straightforward. In <strong>Social tab</strong> you can set your own social icons.
<br><br>
<strong>Error Page</strong> defines the text on the <strong>404 page not found. </strong>This page appears everytime a user misclicks or comes to a page that does not exist.
<br><br>
<strong>Footer Options</strong> set the text that is found at the very bottom of the Theme (below the footer part with widgets). Usually copyright information is entered here.'
        ),
        array(
          'id'        => 'setting__up_the_home_page',
          'title'     => 'Setting  up the Home Page',
          'content'   => 'After you decide what page do you want to use, go to <strong>Settings > Reading</strong> and in the Front page displays choose a static page, then select your just created page. After this, you should change the <strong>Blog pages</strong> show at most value from 10 to 3 posts (for the same appearance as in our live demo). This theme works best with this setup. Hit “Save Changes” and you’re done.
<br><br>
Next, you should setup your <strong>permalinks </strong>to look pretty. Please go to Settings > Permalinks, choose the Custom Structure, and use this: /%category%/%postname%/
<br><br>
<a href="http://codex.wordpress.org/Using_Permalinks#Permalinks_without_mod_rewrite">READ THIS</a> about permalinks on Windows Servers!'
        ),
        array(
          'id'        => 'navigation_and_menu_settings',
          'title'     => 'Navigation and Menu Settings',
          'content'   => 'The last step before you can start working with the new theme is to create your menu. Go to Appearance > Menus and you will see a panel where you can create new menus. Create one, add your created pages to it (from the left side panels) and save it. Now set the locations for the menu that you just created. The main menu will probably be set at Main Menu, Responsive Menu and Scroll Menu.'
        ),
        array(
          'id'        => 'customizing_menu_item',
          'title'     => 'Customizing Menu Item',
          'content'   => '<strong>The Navigation Label</strong> – this field specifies the title of the item on your custom menu. This is what your visitors will see when they visit your site/blog.
<br><br>
<strong>The Title Attribute</strong> – this field specifies the Alternative (‘Alt’) text for the menu item. This text will be displayed when a user’s mouse hovers over a menu item.
<ul>
 	<li>Click on the arrow in the top right-hand corner of the menu item to expand it.</li>
 	<li>Enter the values for the Navigation Label and Title Attribute that you want to assign to the item.</li>
 	<li>Click the Save Menu button to save your changes.</li>
</ul>'
        ),
        array(
          'id'        => 'creating_multi_level_menus',
          'title'     => 'Creating Multi Level Menus',
          'content'   => 'When planning the structure of your menu, it helps to think of each menu item as a heading in a formal report document. In a formal report, main section headings (Level 1 headings) are the nearest to the left of the page; sub-section headings (Level 2 headings) are indented slightly further to the right; any other subordinate headings (Level 3, 4, etc) within the same section are indented even further to the right.
<br><br>
The WordPress menu editor allows you to create multi-level menus using a simple ‘drag and drop’ interface. Drag menu items up or down to change their order of appearance in the menu. Drag menu items left or right in order to create sub-levels within your menu.
<br><br>
To make one menu item a subordinate of another, you need to position the ‘child’ underneath its ‘parent’ and then drag it slightly to the right.
<br><br>
<strong>How to position the sub-menu item</strong>
<ul>
 	<li>Position the mouse over the ‘child’ menu item.</li>
 	<li>Whilst holding the left mouse button, drag it to the right.</li>
 	<li>Release the mouse button.</li>
 	<li>Repeat these steps for each sub-menu item.</li>
 	<li>Click the Save Menu button in the Menu Editor to save your changes.</li>
 	<li>Select the Pages that you want to add by clicking the checkbox next to each Page’s title.</li>
 	<li>Click the Add <strong>to Menu button</strong> located at the bottom of this pane to add your selection(s) to the menu that you created in the previous step.</li>
 	<li>Click the <strong>Save Menu</strong></li>
</ul>'
        ),
        array(
          'id'        => 'deleting_menu_item',
          'title'     => 'Deleting Menu Item',
          'content'   => '<ul>
 	<li>Locate the menu item that you want to remove in the menu editor window</li>
 	<li>Click on the arrow icon in the top right-hand corner of the menu item/box to expand it.</li>
 	<li>Click on the Remove link. The menu item/box will be immediately removed.</li>
 	<li>Click the Save Menu button to save your changes.</li>
</ul>'
        ),
        array(
          'id'        => 'adding_posts',
          'title'     => 'Adding Posts',
          'content'   => 'These are the default steps that you need to do in order to add a blog post:
<ul>
 	<li>Go to Posts > Add New</li>
 	<li>Enter a title and some content.</li>
 	<li>Select a post category.</li>
 	<li>Add some relevant tags.</li>
 	<li>Choose a post format from the right. There are a few types of custom formats that can be used (Standard, Link, Gallery, Video, Audio).</li>
 	<li>Setup the content of the post format(either a gallery, a link, an image, aquote, an mp3 or a video).</li>
 	<li>Insert all of your remaining content in the content area. You can have images, paragraphs, etc.</li>
 	<li>Write a few words excerpt(it is good for search results and SEO to have an excerpt, no matter what kind of content do you have in your post).</li>
 	<li>Hit “Publish” and you’re all done.</li>
</ul><br><br>
<strong>Recommended size</strong> of Post\'s featured image is 1160 x 770 for the full width version and 760 x 500 for the version with sidebar.'
        ),
        array(
          'id'        => 'adding_pages',
          'title'     => 'Adding Pages',
          'content'   => '<ul>
 	<li>Go to Pages > Add New</li>
 	<li>Enter a title and some content.</li>
 	<li>Select a page template or leave the default(more on this just after).</li>
 	<li>Select a layout for the page. Each page can have a custom sidebar or not.</li>
 	<li>Write a few words excerpt(it is good for search results and SEO to have an excerpt, no matter what kind of content do you have in your page).</li>
 	<li>Hit “Publish” and you’re all done.</li>
</ul>'
        ),
        array(
          'id'        => 'recommended_image_sizes',
          'title'     => 'Recommended image sizes',
          'content'   => '<ul>
 	<li>Blog 1160 x 770 (fullwidth), 760 x 500 (with sidebar)</li>
 	<li>Upper three posts - 640 x 400</li>
 	<li>About us avatar - 300 x 300</li>
</ul>'
        ),
        array(
          'id'        => 'child_theme',
          'title'     => 'Child Theme',
          'content'   => 'A WordPress child theme is a theme that inherits the functionality of another
<br><br>
theme, called the parent theme. Child theme allows you to modify, or add to the
<br><br>
functionality of that parent theme. Instead of modifying the theme files directly, you can create a child theme and override within.

<br><br>
You will find child Theme version in the package you downloaded from Themeforest in the directory called CHILD-THEME.

<br><br>

More information about Wordpress child themes can be found on <a href="http://codex.wordpress.org/Child_Themes">Wordpress Codex.</a>'
        ),
        array(
          'id'        => 'seo_advices',
          'title'     => 'SEO Advices',
          'content'   => 'The theme is built in a way to be SEO friendly, by emphasizing titles with heading tags, having the content before anything else, stripping out useless content, fast loading, setting titles in the header for better crawling, etc.. But you have to remember that Content is King! So you shouldn’t blame the theme because your website doesn’t appear in search engines. You should always focus on providing good content and in this way, your website will definitely look great in search engines. Also, you should always install a popular SEO plugin which will make the most of keywords and descriptions.
<br><br>
We recommend using the <a href="https://yoast.com/wordpress/plugins/seo/">Yoast Plugin for SEO</a>.'
        ),
        array(
          'id'        => 'what_to_do_if_i_get_error_upon_theme_activation',
          'title'     => 'What to do if I get error upon Theme Activation',
          'content'   => 'If you receive the following error:
<br><br>
<strong>Parse error: syntax error, unexpected $end in …/wp-content/themes/Amory/admin/theme-options.php on line 1</strong>
<br><br>
This happens if you install the Theme via FTP and the transfer type is not set to <strong>binary</strong>. So set the transfer type to binary as can be <a href="http://premiumcoding.com/wp-content/uploads/2014/08/ftp-upload-opus.jpg">seen on this link</a>.'
        ),
        array(
          'id'        => 'how_to_change_croping_size_of_images',
          'title'     => 'How to change croping size of images',
          'content'   => 'Amory uses several different image sizes which are listed below:
<ul>
 	<li>Blog 1160 x 770 (fullwidth), 760 x 500 (with sidebar)</li>
 	<li>Upper three posts - 640 x 400</li>
 	<li>About us avatar - 300 x 300</li>
</ul><br><br>
These are the general sizes used. Different sections of the Theme uses different croping. To change it, open functions.php and at the top you will notice code like:
<br><br>
<strong>add_image_size( \'blog\', 1160, 770, true );</strong>

<br><br>

After you change the size of the image, you need to <a href="https://wordpress.org/plugins/regenerate-thumbnails/">regenerate Thumbs</a> for the changes to be visible.'
        ),
        array(
          'id'        => 'how_to_properly_set_up_video_post',
          'title'     => 'How to update your Theme',
          'content'   => 'Below is a short guide of how to update your Theme.
<ul>
 	<li>First and best practice is to <strong>make a backup</strong>, download your current theme to your desktop via ftp. After that delete theme from WordPress.</li>
 	<li>Go to themeforest, to your downloads page, this link precisely: <strong>http://themeforest.net/downloads</strong> and download Amory theme</li>
 	<li>Upload the new version of theme <strong>via your WordPress dashboard</strong> or via ftp and that\'s it.</li>
 	<li>Add widgets block to where you would like to have the search bar.</li>
</ul>'
        )
      ),
      'sidebar'       => 'Typograhy is an important aspect of any blog Theme. You can add any font from <a href="https://fonts.google.com/" target="_blank"><b>Google Web font</b></a>library. First you need to add fonts that you wish to use in different parts of the theme (headings, body and menu). Default fonts will be loaded according to the layout you choose at the start.

Click on Add Google Font button and select the desired font from the drop-down menu. Set all variations of the font that you need (regular, italic, latin,...). Numbers from 100 to 900 means how bold the font is, so 100 is extra thin and 900 is extra bold. Please note that not all the fonts have all variations.'
    ),
    'sections'        => array( 
      array(
		'font'        => 'fa-cogs',
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
		'font'        => 'fa-cubes',
        'id'          => 'logo',
        'title'       => 'Logo'
      ),
      array(
		'font'        => 'fa-sliders',
        'id'          => 'home_page_revolution_slider',
        'title'       => 'Revolution slider'
      ),
      array(
		'font'        => 'fa-shopping-basket',
        'id'          => 'woocommerce',
        'title'       => 'WooCommerce'
      ),	  
      array(
		'font'        => 'fa-inbox',
        'id'          => 'post_box',
        'title'       => 'Featured Posts'
      ),
      array(
		'font'        => 'fa-clone',
        'id'          => 'about_us_block',
        'title'       => 'About us block'
      ),
      array(
		'font'        => 'fa-instagram',
        'id'          => 'instagram_block',
        'title'       => 'Instagram block'
      ),
      array(
		'font'        => 'fa-pencil',
        'id'          => 'blog_pages',
        'title'       => 'Blog pages'
      ),
      array(
		'font'        => 'fa-eraser',
        'id'          => 'styling_otions',
        'title'       => 'Style Your Theme'
      ),
      array(
		'font'        => 'fa-css3',
        'id'          => 'custom_style',
        'title'       => 'Custom CSS'
      ),
      array(
		'font'        => 'fa-flickr',
        'id'          => 'custom_javascript_h',
        'title'       => 'Custom JavaScript'
      ),
      array(
		'font'        => 'fa-font',
        'id'          => 'typography',
        'title'       => 'Typography'
      ),
      array(
		'font'        => 'fa-connectdevelop',
        'id'          => 'social_options',
        'title'       => 'Social icons'
      ),
      array(
		'font'        => 'fa-folder',
        'id'          => '404_error_page',
        'title'       => '404 Error page'
      ),
      array(
		'font'        => 'fa-download',
        'id'          => 'footer_options',
        'title'       => 'Footer'
      ),
      array(
		'font'        => 'fa-server',
        'id'          => 'simple_layout_builder',
        'title'       => 'Mini Builder'
      ),
      array(
		'font'        => 'fa-support',
        'id'          => 'support',
        'title'       => 'Support'
      ),
      array(
		'font'        => 'fa-upload',
        'id'          => 'import',
        'title'       => 'Import'
      )
    ),
    'settings'        => array( 	
	   array(
        'id'          => 'display_woocommerce_cart',
        'label'       => 'Do you wish to display cart in top header bar?',
        'desc'        => 'Check this if you wish  to display cart in top header bar.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	
	 
	      array(
        'id'          => 'show_product',
        'label'       => 'Show products on home page?',
        'desc'        => 'Check this if you wish to display your products on home page.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'show_product_position',
        'label'       => 'Position of the product in Home page.',
        'desc'        => 'Set your products position on the home page.',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Top',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Bottom',
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => 'Both',
            'src'         => ''
          )		  
        )
      ),	  
	   array(
        'id'          => 'display_woocommerce_breadcrumb',
        'label'       => 'Do you wish to display breadcrumb on shop page?',
        'desc'        => 'Check this if you wish to display breadcrumb on shop page.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	
	   array(
        'id'          => 'display_woocommerce_shop_sidebar',
        'label'       => 'Do you wish to display sidebar on shop pages?',
        'desc'        => 'Check this if you wish to display sidebar on shop pages.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	
	   array(
        'id'          => 'display_woocommerce_single_sidebar',
        'label'       => 'Do you wish to display sidebar on single product pages?',
        'desc'        => 'Check this if you wish to display sidebar on single products pages.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	  
      array(
        'id'          => 'woocommerc_shop_display',
        'label'       => 'How many product you wish to display on shop page.',
        'desc'        => 'Set how many products you wish to show on shop page.',
        'std'         => '',
        'type'        => 'numeric-slider',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '4,100,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	  
      array(
        'id'          => 'woocommerc_shop_display_row',
        'label'       => 'How many columns of product you wish to display on shop page.',
        'desc'        => 'Set how many columns of product you wish to display on shop page.',
        'std'         => '',
        'type'        => 'numeric-slider',
        'section'     => 'woocommerce',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '2,4,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),	 	  
	  
      array(
        'id'          => 'grid_blog',
        'label'       => 'Which layout would you like to have for your blog?',
        'desc'        => 'Which layout would you like to have for your blog?',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Default Layout',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Grid Layout',
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'excpert_lenght',
        'label'       => 'Length of the excerpt for grid layout posts',
        'desc'        => 'Set how many words should be used in the excerpt for the grid layout.',
        'std'         => '',
        'type'        => 'numeric-slider',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '10,100,1',
        'class'       => '',
        'condition'   => 'grid_blog:is(2)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_scroll',
        'label'       => 'Display Navigation Scroll bar?',
        'desc'        => 'Scroll bar appears after you scroll down your website. If you wish to display this extra navigation menu with your logo set this setting to ON.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_bar',
        'label'       => 'Display upper bar with social icons and search?',
        'desc'        => 'This is the first block of the website above the logo. It contains social icons on the left and search widget on the right. Set this to ON if you wish to display it. Please note that even if you set this to ON you still have to add widgets under Appearance -&gt; Widgets. 

In our demos settings are:
- TOP SIDEBAR LEFT contains Premium Social widget.
- TOP SIDEBAR RIGHT contains Search widget.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_block1',
        'label'       => 'Display the 3 posts block under the logo?',
        'desc'        => 'Three posts below the slider allows you to add extra content that is not connected to your blog posts. The content can be anything from custom images to adverts.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_block2',
        'label'       => 'Display about us block under the three posts?',
        'desc'        => 'About us block below the slider is especially useful if you are using the full width version of the Theme. It can replace the about us section in the sidebar. Or you can even add something different here like a promotion with image and short description.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_block3',
        'label'       => 'Display Instagram block?',
        'desc'        => 'Instagram block above the footer can display your latest images from your Instagram. It\'s not connected to the Instagram in the sidebar, you can set that under Appearance -&gt; Widgets.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_fullwidth',
        'label'       => 'Use full width version of the blog?',
        'desc'        => 'Do you prefer full width layout of the blog? If yes, set this setting to on.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'grid_blog:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_builder',
        'label'       => 'Use theme simple layout builder?',
        'desc'        => '<span style="color:#B73B27">Note:</span> Simple layout builder is in beta 3 stage. So please if you have any issues with the builder send us bug report via support tab in Theme\'s description. You can use the builder but it could still have some minor issues!
You can also send us feature requests. Thank you.<br><br>
<br>
Disabled sidebar for front page if option is set to ON:

<ul>
<li>Sidebar under header left</li>
<li>Sidebar under header right</li>
<li>Sidebar under header fullwidth</li>
</ul>',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => 'Upload a logo for your theme, or specify the image url of your logo. (http://yoursite.com/logo.png)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'logo_retina',
        'label'       => 'Retina Logo',
        'desc'        => 'Upload a logo for your theme (retina dispplay), or specify the image url of your logo. (http://yoursite.com/logo@2x.png). Be sure to add @2x at the end, so if normal logo is logo.png, retina version is logo@2x.png',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'scroll_logo',
        'label'       => 'Custom Scroll Logo',
        'desc'        => 'Upload the logo that is displayed on the scroll bar. This is not required.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'rev_slider',
        'label'       => 'Revolution slider',
        'desc'        => 'Add Revolution slider alias for home page. Leave blank if you don\'t wish to have Revolution slider on the home page.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home_page_revolution_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'rev_slider_margin',
        'label'       => 'Revolution slider top margin.',
        'desc'        => 'Set top margin for Revolution slider. If you wish for the Revolution slider to have a margin from menu set it here in px. In grid layout demo we use 30px margin.',
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'home_page_revolution_slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '-20,50,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_page_custom_post_blocks',
        'label'       => 'Home page custom post blocks',
        'desc'        => 'This section is under Revolution slider in the live demo. If you wish to enable this option go to "General tab -&gt; Display the 3 posts block under the logo?" and set it to "ON"

Three posts below the slider allows you to add extra content that is not connected to your blog posts. The content can be anything from custom images to adverts.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_img1',
        'label'       => 'Image for the first post (Recommended size 640px x 400px)',
        'desc'        => 'Upload your image.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_text1',
        'label'       => 'Title for the first post',
        'desc'        => 'Set the title for the first post.',
        'std'         => 'Title for the first post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_lower_text1',
        'label'       => 'Lower Title for the first post',
        'desc'        => 'Set the lower title (description) for the first post.',
        'std'         => 'Lower Title for the first post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_link1',
        'label'       => 'Link for the first post',
        'desc'        => 'Set link for the first post.',
        'std'         => 'http://premiumcoding.com',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_img2',
        'label'       => 'Image for the second post (Recommended size 640px x 400px)',
        'desc'        => 'Upload your image.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_text2',
        'label'       => 'Title for the second post',
        'desc'        => 'Set the title for the second post.',
        'std'         => 'Title for the second post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_lower_text2',
        'label'       => 'Lower Title for the second post',
        'desc'        => 'Set the lower title (description) for the second post.',
        'std'         => 'Lower Title for the second post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_link2',
        'label'       => 'Link for the second post',
        'desc'        => 'Set the link for the second post.',
        'std'         => 'http://premiumcoding.com',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_img3',
        'label'       => 'Image for the third post (Recommended size 640px x 400px)',
        'desc'        => 'Upload your image.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_text3',
        'label'       => 'Title for the third post',
        'desc'        => 'Set the title for the third post.',
        'std'         => 'Title for the third post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_lower_text3',
        'label'       => 'Lower Title for the third post',
        'desc'        => 'Set the lower title (description) for the third post.',
        'std'         => 'Lower Title for the third post',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block1_link3',
        'label'       => 'Link for the third post',
        'desc'        => 'Set the link for the third post.',
        'std'         => 'http://premiumcoding.com',
        'type'        => 'text',
        'section'     => 'post_box',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block1:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'about_us_block',
        'label'       => 'About us block',
        'desc'        => 'This section is under Revolution slider. If you wish to have enable this options go to "General tab -&gt; Display about us block under the three posts?" and set it to "ON".

About us block below the slider is especially useful if you are using the full width version of the Theme. It can replace the about us section in the sidebar. Or you can even add something different here like a promotion with image and short description.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'about_us_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block2_text',
        'label'       => 'Content text for the about us block',
        'desc'        => 'Set the content text for about us block. It can be anything.',
        'std'         => 'Set the text for about us block.',
        'type'        => 'textarea',
        'section'     => 'about_us_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block2:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block2_img',
        'label'       => 'Upload Image for About us block',
        'desc'        => 'Please upload your Image for About us block (usually your Avatar).',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'about_us_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block2:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block2_text',
        'label'       => 'Content text for the quote block',
        'desc'        => 'Set the text for about us block.',
        'std'         => 'Set the text for about us block.',
        'type'        => 'textarea',
        'section'     => 'about_us_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block2:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'instagram_block',
        'label'       => 'Instagram Block',
        'desc'        => 'This section is above the footer. If you wish to have enable this option go to "General tab -&gt;Display Instagram block?" and set it to "ON"

Instagram block above the footer can display your latest images from your Instagram. It\'s not connected to the Instagram in the sidebar, you can set that under Appearance -&gt; Widgets.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'instagram_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block3_username',
        'label'       => 'Instagram block ID number',
        'desc'        => 'Enter the ID number of your instagram username. You can see this number under Instagram Feed plugin (User ID). Please be careful to enter a number and NOT your username. You can get this number from the "Instagram Feed" plugin settings.',
        'std'         => '3035270156',
        'type'        => 'text',
        'section'     => 'instagram_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block3:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'block3_url',
        'label'       => 'Instagram block Username Link',
        'desc'        => 'Link to your profile on Instagram.',
        'std'         => 'http://instagram.com/amorypmc',
        'type'        => 'text',
        'section'     => 'instagram_block',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_block3:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'options_for_archive_category_view',
        'label'       => 'Options for archive/category view',
        'desc'        => 'Settings below will impact the functionality and design of your blog and archive pages (category for posts). You can decide which meta information you wish to display and which social icons you allow for sharing your content.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_post_meta',
        'label'       => 'Display post meta information (date and author)',
        'desc'        => 'Check this if you wish to display post meta information such as date and author.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_socials',
        'label'       => 'Display social share icons?',
        'desc'        => 'Check this if you wish to display social share icons.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_reading',
        'label'       => 'Display reading time of the post?',
        'desc'        => 'Check this if you wish to display reading time of the post. This is displayed on category page under the post content.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'oiptions_for_single_post_page',
        'label'       => 'Options for single post',
        'desc'        => 'Settings below will impact the functionality and design of your single posts. You can decide which meta information you wish to display and which social icons you allow for sharing your content.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_related',
        'label'       => 'Display related posts?',
        'desc'        => 'Check this if you wish to display related posts under the content of each post. Related posts are three posts that are connected to the current posts via categories.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_display_tags',
        'label'       => 'Display tags?',
        'desc'        => 'Check this if you wish to display tags under the main post content so your user can interact via tag connections.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_author_info',
        'label'       => 'Display author info?',
        'desc'        => 'Check this if you wish to display author information that is displayed below the content of each post. You can set the information for the author under Users -&gt; All Users. 

Plugin for better avatars can be downloaded from WordPress.org:
https://wordpress.org/plugins/wp-user-avatar/',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_display_post_meta',
        'label'       => 'Display post meta (date and author) on single blog post?',
        'desc'        => 'Check this if you wish to display meta information such as date and author.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_display_socials',
        'label'       => 'Display social share icons?',
        'desc'        => 'Check this if you wish to display social share icons on single blog posts.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_display_post_navigation',
        'label'       => 'Display post navigation?',
        'desc'        => 'Check this if you wish to enable prev/next navigation between posts. Post navigation can be found at the very end of each post, after the comments section. It allows you to move between posts (next and previous posts).',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'options_for_social_share_icons_on_single_post_and_category_archive_view',
        'label'       => 'Options for social share icons on single post and category/archive view',
        'desc'        => 'With this option you can select which social share icons you wish to show to your users.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'single_display_share_select',
        'label'       => 'Social share icons to show',
        'desc'        => 'Select which social share icons you wish to show.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'blog_pages',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'display_socials:is(1),single_display_socials:is(1)',
        'operator'    => 'or',
        'choices'     => array( 
          array(
            'value'       => 'facebook_share',
            'label'       => 'Facebook',
            'src'         => ''
          ),
          array(
            'value'       => 'twitter_share',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'google_share',
            'label'       => 'Google plus',
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest_share',
            'label'       => 'Pinterest',
            'src'         => ''
          ),
          array(
            'value'       => 'stumbleupon',
            'label'       => 'Stumbleupon',
            'src'         => ''
          ),
          array(
            'value'       => 'vk',
            'label'       => 'VK.COM',
            'src'         => ''
          ),		  
          array(
            'value'       => 'whatsapp',
            'label'       => 'Whatsapp',
            'src'         => ''
          )		  
        )
      ),
      array(
        'id'          => 'general_color_options',
        'label'       => 'General styling options',
        'desc'        => 'Main design aspects of your Theme can be set in the settings below.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'mainColor',
        'label'       => 'Main theme Color',
        'desc'        => 'Set the main theme color. This is the leading color of the Theme and impacts the design in several places. If your blog or company has a leading color in the logo than this is the color you should set.',
        'std'         => '#f3a28b',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_styling_options',
        'label'       => 'Header Styling',
        'desc'        => 'Below are the settings for designing your header.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'display_header',
        'label'       => 'Hide header on home page?',
        'desc'        => 'If you wish to hide the header set this option to ON. This option is used if you use Revolution slider with menu. In our live demo this is used in the NEW PHOTOGRAPHY DEMO.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_menu_background_color',
        'label'       => 'Upper Bar background color',
        'desc'        => 'Pick a background color for the Upper Bar background color. This is the bar where social icons and search widget are placed in our live demos.',
        'std'         => '#222222',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'upper_bar_color',
        'label'       => 'Upper bar and scroll bar color',
        'desc'        => 'Set the color for elements for upper bar.',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_background_color',
        'label'       => 'Menu background color',
        'desc'        => 'Pick a background color for the menu. This is the background color for the main menu. In connection to this color you should also set the font color for the menu (dark background - light fonts and vice versa).',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'header_background_color',
        'label'       => 'Header background color',
        'desc'        => 'Pick a background color for the Header in general.',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'image_background_header',
        'label'       => 'Background Image for the header',
        'desc'        => 'If you wish to have a background image for the header instead of solid color you can set it here (leave blank if you don\'t need to  use image for your background).',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_menu_back',
        'label'       => 'Show solid background color when using background image?',
        'desc'        => 'Check this if you wish to use a solid color for the menu background when using background image.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'image_background_header:not()',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_styling_options',
        'label'       => 'Menu styling options',
        'desc'        => 'Set styling for your menu.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_top_border',
        'label'       => 'Menu top border width',
        'desc'        => 'This is the border around menu and is the width of the higher border.',
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_bottom_border',
        'label'       => 'Width of your border for your menu (lower border)',
        'desc'        => 'This is the border around menu and is the width of the lower border.',
        'std'         => '0',
        'type'        => 'numeric-slider',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,10,1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_styling_options',
        'label'       => 'Body styling options',
        'desc'        => 'Set styling for the body section.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_background_color',
        'label'       => 'Background color',
        'desc'        => 'Set the main color for your body background. This is the color that will be main background color of your website.',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'use_boxed',
        'label'       => 'Use boxed version?',
        'desc'        => 'Check this if you wish to use boxed version/design. You can see the example in our live demos.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'background_image_full',
        'label'       => 'Enable Background image (for boxed style)',
        'desc'        => 'Displays image as background for your boxed version.',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_boxed:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'image_background',
        'label'       => 'Background Image (for boxed style)',
        'desc'        => 'Upload background image for your boxed version.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_boxed:is(1)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_options',
        'label'       => 'Footer options',
        'desc'        => 'Options for footer section',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => 'Footer background color',
        'desc'        => 'Here you can set footer background color.',
        'std'         => '#ffffff',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text_color',
        'label'       => 'Footer text color',
        'desc'        => 'Here you can set footer text color.',
        'std'         => '#222',
        'type'        => 'colorpicker',
        'section'     => 'styling_otions',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_style',
        'label'       => 'Custom CSS style',
        'desc'        => 'This is the place to enter your custom CSS if needed. If you are unsure what this field is for do not hesitate to contact us.',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'custom_style',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'custom_javascript',
        'label'       => 'Custom JavaScript',
        'desc'        => 'This is the place to enter your custom Java Script if needed. If you are unsure what this field is for do not hesitate to contact us.',
        'std'         => '',
        'type'        => 'javascript',
        'section'     => 'custom_javascript_h',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'google_fonts_heading',
        'label'       => 'Google Fonts',
        'desc'        => 'Typograhy is an important aspect of any blog Theme. You can add any font from <a href="https://fonts.google.com/"><b>Google Web font library</b></a>. First you need to add fonts that you wish to use in different parts of the theme (headings, body and menu). Default fonts will be loaded according to the layout you choose at the start.

Click on Add Google Font button and select the desired font from the drop-down menu. Set all variations of the font that you need (regular, italic, latin,...). Numbers from 100 to 900 means how bold the font is, so 100 is extra thin and 900 is extra bold. Please note that not all the fonts have all variations.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'load_google_fonts',
        'label'       => 'Load Google fonts',
        'desc'        => 'Add google fonts which are used in Typography Settings.',
        'std'         => 'Oswald',
        'type'        => 'google-fonts',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'general_typography_settings',
        'label'       => 'General Typography settings',
        'desc'        => 'Set general typography options.',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_font',
        'label'       => 'Body Typography Settings',
        'desc'        => 'Change body typography. Set the font family, size, color and style.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font',
        'label'       => 'Heading Typography Settings',
        'desc'        => 'Change heading typography. Set the font family and style.',
        'std'         => '',
        'type'        => 'typography_f_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => 'heading-font',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_font',
        'label'       => 'Menu Typography Settings',
        'desc'        => 'Change munu typography. Set the font family.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'qoute_typography_settings',
        'label'       => 'Qoute Typography Settings',
        'desc'        => 'Qoute Typography Settings',
        'std'         => '',
        'type'        => 'typography_f_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_link_coler',
        'label'       => 'Link Typography (color of text links)',
        'desc'        => 'Change Link Typography (color of text links).',
        'std'         => '#343434',
        'type'        => 'colorpicker',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h1',
        'label'       => 'H1 typography',
        'desc'        => 'Set H1 font size and color',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h2',
        'label'       => 'H2 typography',
        'desc'        => 'Set H2 font size and color.',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h3',
        'label'       => 'H3 typography',
        'desc'        => 'Set H3 font size and color.',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h4',
        'label'       => 'H4 typography',
        'desc'        => 'Set H4 font size and color.',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h5',
        'label'       => 'H5 typography',
        'desc'        => 'Set H5 font size and color.',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_font_h6',
        'label'       => 'H6 typography',
        'desc'        => 'Set H6 font size and color.',
        'std'         => '',
        'type'        => 'typography_c_s',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'socialicons',
        'label'       => 'Add social profile icons',
        'desc'        => 'You can add unlimited number of social Icons and sort them with drag and drop.',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'url',
            'label'       => 'Icon',
            'desc'        => 'Add social icon from <a href="http://fontawesome.io/icons/" target="_blank"><b>Font Awesome library</b></a>.',
            'std'         => 'fa-facebook',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'link',
            'label'       => 'Link',
            'desc'        => 'Add link to your social profile.',
            'std'         => 'https://premiumcoding.com',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'errorpagetitle',
        'label'       => '404 Error page Title',
        'desc'        => 'Set the title of the Error page (404 not found error).',
        'std'         => 'OOOPS! 404',
        'type'        => 'text',
        'section'     => '404_error_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'errorpage',
        'label'       => '404 Error page Title Content Text',
        'desc'        => 'Add a description for your 404 page.',
        'std'         => 'Sorry, but the page you are looking for has not been found.<br/>Try checking the URL for errors, then hit refresh.</br>Or you can simply click the icon below and go home:)',
        'type'        => 'textarea',
        'section'     => '404_error_page',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'copyright',
        'label'       => 'Copyright info',
        'desc'        => 'Add your Copyright or some other notice.',
        'std'         => '© 2011 All rights reserved.',
        'type'        => 'textarea',
        'section'     => 'footer_options',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'simple_layout_builder',
        'label'       => 'Simple layout builder',
        'desc'        => '<br>If you wish to enable this options you need to set "General -&gt; Use theme simple layout builder?" to <b>"ON"</b>.
<br><br>
<span style="color:#B73B27">Note:</span> Simple layout builder is in beta 3 stage. So please if you have any issues with the builder send us bug report via support tab in Theme\'s description. You can use the builder but it could still have some minor issues!
You can also send us feature requests. Thank you.<br><br>',
        'std'         => '',
        'type'        => 'heading',
        'section'     => 'simple_layout_builder',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'sidebar_builder',
        'label'       => 'Sidebar builder',
        'desc'        => 'Here you can create custom sidebars.',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'simple_layout_builder',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_builder:is(1)',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'sidebar_description',
            'label'       => 'Description',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'test2',
        'label'       => 'Layout builder',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'simple_layout_builder',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'use_builder:is(1)',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'use_sidebar',
            'label'       => 'Use sidebar?',
            'desc'        => 'If you wish to use sidebar dor this options set to ON.',
            'std'         => '',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'sidebar_select',
            'label'       => 'sidebar',
            'desc'        => '',
            'std'         => '',
            'type'        => 'sidebar-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => 'use_post:not(1),use_sidebar:is(1),use_category:not(1)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'use_post',
            'label'       => 'Use single post?',
            'desc'        => 'If you wish to display single post for this option set to ON.',
            'std'         => '',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'single_post',
            'label'       => 'Single post',
            'desc'        => '',
            'std'         => '',
            'type'        => 'post-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => 'use_post:is(1),use_sidebar:not(1),use_category:not(1)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'use_category',
            'label'       => 'Use category list?',
            'desc'        => 'Select from which category you wish to display posts.',
            'std'         => '',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'category_select',
            'label'       => 'Category',
            'desc'        => 'Select from which category you wish to display posts.',
            'std'         => '',
            'type'        => 'category-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => 'use_post:not(1),use_sidebar:not(1),use_category:is(1)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'category_select_number',
            'label'       => 'How many post to display?',
            'desc'        => 'Select how mony post you wish to display.',
            'std'         => '',
            'type'        => 'numeric-slider',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '1,10,1',
            'class'       => '',
            'condition'   => 'use_post:not(1),use_sidebar:not(1),use_category:is(1)',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'dimension_select',
            'label'       => 'Dimensions',
            'desc'        => '',
            'std'         => '',
            'type'        => 'dimension',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'margin_select',
            'label'       => 'Margins',
            'desc'        => '',
            'std'         => '',
            'type'        => 'spacing',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'support_info',
        'label'       => 'Support Info',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'support',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'theme_documentation',
        'label'       => 'Theme documentation',
        'desc'        => 'Thank you for purchasing our theme. We hope that you’ll find it easy to use and customize. Please read the manual, because it covers almost all of the aspects needed about how to install and run the theme.<br><br> You can check the manual by clicking the help button on upper right corner. You can also download the documentation at: 
<ul><li>
<a href="http://amory.premiumcoding.com/wp-content/uploads/2016/12/Amory-Wordpress-Theme-Documentation-1.pdf" target="_blank"><b>Documentation</b></a></li>
</ul>



<br><br>
If you have questions that are not answered in this guide, please go to the support system, where your questions will be answered:


<h3><a href="https://premiumcoding.com/envato-login/" target="_blank">Support portal</a></h3>

<br>

Please verify the documentation and FAQ before posting.

If you like the theme, please show your appreciation by taking the time to rate it.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'support',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'import',
        'label'       => 'Auto Import options',
        'desc'        => 'With auto import you will import:
<ul>
 	<li>import demo content (pages and posts)</li>
 	<li>import theme options for selected import</li>
 	<li>import widgets</li>
 	<li>set menu locations</li>
 	<li>set home page</li>
	<li>import Revolution sliders</li>
</ul><br><br>
If auto imports fails you can still import it manually. Demo content is insice main zip file in demo folder.
<br><br>
For importing options use plugin : <a href="https://wordpress.org/plugins/options-importer/">Wp Options exporter</a>. Import only of_options_pmc option.
<br><br>
For import widgets use plugin : <a href="https://wordpress.org/plugins/widget-settings-importexport/">Widget settings export/import</a>
<br><br>
For WP xml import use default WP importer.<br><br> For Revolution sliders use default plugin import.',
        'std'         => '',
        'type'        => 'import',
        'section'     => 'import',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}