<?php if(!defined('CODELESS_BASE')) exit("Direct script access not allowed");


if( !class_exists( 'codeless_custom_menu' ) )

{	


	class codeless_custom_menu

	{


		function __construct()

		{

			add_action( 'wp_update_nav_menu_item', array(&$this,'update_menu'), 100, 3);

			add_filter('wp_nav_menu_args', array(&$this,'change_menu_arguments'), 100);

			add_action('admin_enqueue_scripts', array(&$this,'add_media'));

			add_filter( 'wp_edit_nav_menu_walker', array(&$this,'change_backend_walker') , 100);


		}


		function update_menu($menu_id, $menu_item_db)

		{	

			$check = array('megamenu', 'widgetized', 'megamenu_bg', 'bg_type', 'column_hide' );

			

			foreach ( $check as $key )

			{

				if(!isset($_POST['menu-item-custom_codeless-'.$key][$menu_item_db]))

				{

					$_POST['menu-item-custom_codeless-'.$key][$menu_item_db] = "";

				}

				

				$value = $_POST['menu-item-custom_codeless-'.$key][$menu_item_db];

				update_post_meta( $menu_item_db, '_menu-item-custom_codeless-'.$key, $value );

			}

		}

		

		function change_backend_walker($name)

		{

			return 'codeless_custom_menu_backend';

		}



		function add_media($hook_suffix)

		{

			if($hook_suffix == "nav-menus.php" )

			{	

				wp_enqueue_style(  'codeless_custom_menu', CODELESS_BASE_URL . 'includes/core/css/codeless_custom_menu.css'); 

				wp_enqueue_script( 'codeless_custom_menu' , CODELESS_BASE_URL . 'includes/core/js/codeless_custom_menu.js',array('jquery', 'jquery-ui-sortable'), false, true ); 
			}

		}

		

		function change_menu_arguments($arguments){

			if($arguments['menu_id'] != 'mobile-menu')
				$arguments['walker'] = new custom_walker();				

			$arguments['container_class'] .= ' cl-header__menu-container';

			$arguments['menu_class'] .= ' cl-header__menu';



			return $arguments;

		}

		

		

		

	}

}


if( !class_exists( 'custom_walker' ) )

{



	class custom_walker extends Walker {

	

		var $tree_type = array( 'post_type', 'taxonomy', 'custom' );


		var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );


		var $columns = 0;

		var $max_columns = 0;

		var $index = 0;
		var $rows = 1;
                var $main_index = 0;

		var $rowsCounter = array();


		var $mega_active = 0;
		var $bg_type = 'background';
		var $column_hide = "";

		function start_lvl(&$output, $depth = 0, $args = array() ) {

			$indent = str_repeat("\t", $depth);

			if($depth === 0) $output .= "\n{replace_one}\n";

			$class = '';

			if($depth == 0 && !$this->mega_active)

				$class = 'non_mega_menu';

			

				

			$output .= "\n$indent<ul class=\"sub-menu $class\">\n";

		}


		function end_lvl(&$output, $depth = 0, $args= array()) {

			$indent = str_repeat("\t", $depth);

			$output .= "$indent</ul>\n";

			

			if($depth === 0) 

			{

				if($this->mega_active)

				{



					$output .= "\n</div>\n";


					$output = str_replace("{replace_one}", "<div class='cl-header__menu__megamenu cl-header__menu__megamenu--".$this->bg_type." cl-header__menu__megamenu--".$this->max_columns."'>", $output);

					

					foreach($this->rowsCounter as $row => $columns)

					{

						$output = str_replace("{current_row_".$row."}", "cl-header__menu__megamenu__col", $output);

					}

					

					$this->columns = 0;

					$this->max_columns = 0;

					$this->rowsCounter = array();

					

				}

				else

				{

					$output = str_replace("{replace_one}", "", $output);

				}

			}

		}


		function start_el(&$output, $item, $depth = 0, $args = array(),  $current_object_id = 0) {

			global $wp_query;

			$this->index++;

			//set maxcolumns

			$extra_html = '';

			if(!isset($args->max_columns)) $args->max_columns = 6;



			

			$item_output = $li_text_block_class = $column_class = "";

			
			$bg_img = '';

			if($depth === 0)

			{	

				$this->mega_active = get_post_meta( $item->ID, '_menu-item-custom_codeless-megamenu', true);



	
				$bg = get_post_meta( $item->ID, '_menu-item-custom_codeless-megamenu_bg', true);
				$this->bg_type = get_post_meta( $item->ID, '_menu-item-custom_codeless-bg_type', true);
				$this->background_image = get_post_meta( $item->ID, '_menu-item-custom_codeless-megamenu_bg', true);

				if( empty($this->bg_type) )
					$this->bg_type = 'background';


				if(!empty($bg) )
					$bg_img = $bg;	
			}

			

			

			if($depth === 1 && $this->mega_active)

			{

				$this->columns ++;

				$column_hide = get_post_meta( $item->ID, '_menu-item-custom_codeless-column_hide', true);



				//check if we have more than $args['max_columns'] columns or if the user wants to start a new row

				if($this->columns > $args->max_columns)

				{

					$this->columns = 1;

					

				}

				 

				$this->rowsCounter[$this->rows] = $this->columns;

				

				if($this->max_columns < $this->columns) $this->max_columns = $this->columns;

				

				

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				

				if($title != "-" && $title != '"-"') //fallback for people who copy the description o_O

				{

					$item_output .= "<h6 class=\"cl-custom-font\">".$title."</h6>";

				}

				

				$column_class  = ' {current_row_'.$this->rows.'}';

				if( $column_hide != '' ){
					$column_class .= ' hide-column';

					if(  $this->bg_type == 'column' )
					$extra_html = '<img src="'.$this->background_image.'" alt="'.esc_attr__('Column BG', 'thype').'" />';

				}

				if($this->columns == 1)

				{

					$column_class  .= " codeless_custom_menu_first_col";

				}



			}

			

			else

			{

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';

				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';

				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';			
				$attributes .= ! empty( $cl_item_classes )        ? ' class="'   . esc_attr( $cl_item_classes        ) .'"' : '';
			

				$item_output .= $args->before;

				$item_output .= '<a'. $attributes .'>';

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				$item_output .= '</a>';

				$item_output .= $args->after;

			}
			 
			

			

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = $value = '';

	
			$animation_delay = $animation_speed = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
                        
			if( $depth === 0 ){
                                $this->main_index++;
                                if( codeless_get_from_element( 'cl_menu_start', false ) ){
                                        $classes[] = codeless_get_mod( 'menu_items_animation', 'none' );
				        $classes[] = codeless_get_mod( 'menu_items_animation', 'none' ) == 'none' ? '' : 'cl-animate-on-visible';
                                }
				
				
				

				if( codeless_get_mod( 'menu_items_animation', 'none' ) != 'none' && codeless_get_from_element( 'cl_menu_start', false ) ){
					$animation_delay = 'data-delay="'.( (int) 100 *$this->main_index).'"';
					$animation_speed = 'data-speed="300"';
				}
			}
			


			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

			$class_names = ' class="'.$li_text_block_class. esc_attr( $class_names ) . $column_class.'"';


			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .' data-bg="'.$bg_img.'" '.$animation_delay.' '.$animation_speed.'>';

			$output .= $extra_html;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}


		function end_el(&$output, $item, $depth = 0, $args= array()) {

			$output .= "</li>\n";

		}

	}

}











if( !class_exists( 'codeless_custom_menu_backend' ) )

{

/**
 * Navigation Menu API: Walker_Nav_Menu_Edit class
 *
 * @package WordPress
 * @subpackage Administration
 * @since 4.4.0
 */

/**
 * Create HTML list of nav menu input items.
 *
 * @since 3.0.0
 *
 * @see Walker_Nav_Menu
 */
class codeless_custom_menu_backend extends Walker_Nav_Menu {
        /**
         * Starts the list before the elements are added.
         *
         * @see Walker_Nav_Menu::start_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker_Nav_Menu::end_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {}

        /**
         * Start the element output.
         *
         * @see Walker_Nav_Menu::start_el()
         * @since 3.0.0
         *
         * @global int $_wp_nav_menu_max_depth
         *
         * @param string $output Used to append additional content (passed by reference).
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   Not used.
         * @param int    $id     Not used.
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
                global $_wp_nav_menu_max_depth;
                $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;



                // Added By Codeless
                $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';




                ob_start();
                $item_id = esc_attr( $item->ID );
                $removed_args = array(
                        'action',
                        'customlink-tab',
                        'edit-menu-item',
                        'menu-item',
                        'page-tab',
                        '_wpnonce',
                );

                $original_title = false;
                if ( 'taxonomy' == $item->type ) {
                        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
                        if ( is_wp_error( $original_title ) )
                                $original_title = false;
                } elseif ( 'post_type' == $item->type ) {
                        $original_object = get_post( $item->object_id );
                        $original_title = get_the_title( $original_object->ID );
                } elseif ( 'post_type_archive' == $item->type ) {
                        $original_object = get_post_type_object( $item->object );
                        if ( $original_object ) {
                                $original_title = $original_object->labels->archives;
                        }
                }

                $classes = array(
                        'menu-item menu-item-depth-' . $depth,
                        'menu-item-' . esc_attr( $item->object ),
                        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
                );

                $title = $item->title;

                if ( ! empty( $item->_invalid ) ) {
                        $classes[] = 'menu-item-invalid';
                        /* translators: %s: title of menu item which is invalid */
                        $title = sprintf( esc_html__( '%s (Invalid)', 'thype' ), $item->title );
                } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                        $classes[] = 'pending';
                        /* translators: %s: title of menu item in draft status */
                        $title = sprintf( esc_html__('%s (Pending)', 'thype'), $item->title );
                }

                $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;






                // Added By Codeless
                $itemValue = "";

                if($depth == 0)

                {

                        $itemValue = get_post_meta( $item->ID, '_menu-item-custom_codeless-megamenu', true);

                        if($itemValue != "") $itemValue = 'codeless_custom_active ';


                }








                $submenu_text = '';
                if ( 0 == $depth )
                        $submenu_text = 'style="display: none;"';

                ?>
                <li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( $itemValue ); echo implode(' ', $classes ); ?>">
                        <div class="menu-item-bar">
                                <div class="menu-item-handle">
                                        <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo codeless_complex_esc( $submenu_text ); ?>><?php esc_html_e( 'sub item', 'thype' ); ?></span></span>
                                        <span class="item-controls">
                                                <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>




                                                <?php // Added By Codeless ?>
                                                <span class="item-type item-type-column"><?php esc_html_e('Mega Menu Column', 'thype' ); ?></span>
                                                <span class="item-type item-type-megalabel"><?php esc_html_e('Mega Menu', 'thype' ); ?></span>






                                                <span class="item-order hide-if-js">
                                                        <a href="<?php
                                                                echo wp_nonce_url(
                                                                        add_query_arg(
                                                                                array(
                                                                                        'action' => 'move-up-menu-item',
                                                                                        'menu-item' => $item_id,
                                                                                ),
                                                                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                                                        ),
                                                                        'move-menu_item'
                                                                );
                                                        ?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'thype' ) ?>">&#8593;</a>
                                                        |
                                                        <a href="<?php
                                                                echo wp_nonce_url(
                                                                        add_query_arg(
                                                                                array(
                                                                                        'action' => 'move-down-menu-item',
                                                                                        'menu-item' => $item_id,
                                                                                ),
                                                                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                                                        ),
                                                                        'move-menu_item'
                                                                );
                                                        ?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'thype' ) ?>">&#8595;</a>
                                                </span>
                                                <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" href="<?php
                                                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                                                ?>" aria-label="<?php esc_attr_e( 'Edit menu item', 'thype' ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Edit', 'thype' ); ?></span></a>
                                        </span>
                                </div>
                        </div>

                        <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
                                <?php if ( 'custom' == $item->type ) : ?>
                                        <p class="field-url description description-wide">
                                                <label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
                                                        <?php esc_html_e( 'URL', 'thype' ); ?><br />
                                                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                                                </label>
                                        </p>
                                <?php endif; ?>




                                <p class="description description-wide">
                                        <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
                                                <?php esc_html_e( 'Navigation Label', 'thype' ); ?><br />
                                                <input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                                        </label>
                                </p>






                                <?php // Added By Codeless ?>


                                        <?php

                                                if( $depth === 1 ):


                                                        $title = 'Check to hide column, use only for layout. If you have set a Megamenu image as Column, by hiding this, the image will be shown instead.';

                                                        $key = "menu-item-custom_codeless-column_hide";

                                                        $value = get_post_meta( $item->ID, '_'.$key, true);

                                                        

                                                        if($value != "") $value = "checked='checked'";

                                                ?>

                                                

                                                <p class="description description-wide description-label label_desc_on_active">

                                                        <label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">

                                                        <span class='default_label'><?php esc_html_e( 'Navigation Label', 'thype' ); ?></span>

                                                        <span class='mega_label'><?php echo esc_attr($title) ?></span>

                                                                

                                                                <br />

                                                                <input type="checkbox" value="active" id="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[". $item_id ."]" );?>" <?php echo esc_attr( $value ); ?> /><?php echo esc_attr( $title ); ?>

                                                        </label>

                                                </p>

                                <?php endif; ?>









                                <p class="field-title-attribute field-attr-title description description-wide">
                                        <label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
                                                <?php esc_html_e( 'Title Attribute', 'thype' ); ?><br />
                                                <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                                        </label>
                                </p>
                                <p class="field-link-target description">
                                        <label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
                                                <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                                                <?php esc_html_e( 'Open link in a new tab', 'thype' ); ?>
                                        </label>
                                </p>
                                <p class="field-css-classes description description-thin">
                                        <label for="edit-menu-item-classes-<?php echo  esc_attr( $item_id ); ?>">
                                                <?php esc_html_e( 'CSS Classes (optional)', 'thype' ); ?><br />
                                                <input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                                        </label>
                                </p>
                                <p class="field-xfn description description-thin">
                                        <label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
                                                <?php esc_html_e( 'Link Relationship (XFN)', 'thype' ); ?><br />
                                                <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                                        </label>
                                </p>
                                <p class="field-description description description-wide">
                                        <label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
                                                <?php esc_html_e( 'Description', 'thype' ); ?><br />
                                                <textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                                                <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'thype'); ?></span>
                                        </label>
                                </p>



                                <?php //added by codeless ?>

                                <div class='codeless_custom_menu_options'>

                                        

                                                <?php

                                                $title = 'Check if you want to use this item as megamenu';

                                                $key = "menu-item-custom_codeless-megamenu";

                                                $value = get_post_meta( $item->ID, '_'.$key, true);

                                                

                                                if($value != "") $value = "checked='checked'";

                                                ?>

                                                

                                                <p class="description description-wide codeless_checkbox codeless_custom_mega_menu codeless_custom_mega_menu_d0">

                                                        <label for="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>">

                                                                <input type="checkbox" value="active" id="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[". $item_id ."]" );?>" <?php echo esc_attr( $value ); ?> /><?php echo esc_attr( $title ); ?>

                                                        </label>

                                                </p>


                                                
                                                <?php

                                                $title = 'Add here a background image for this column or leave empty';

                                                $key = "menu-item-custom_codeless-megamenu_bg";

                                                $value = get_post_meta( $item->ID, '_'.$key, true);

                                                ?>

                                                <p class="description description-wide codeless_background_image codeless_custom_mega_menu codeless_custom_mega_menu_d1">

                                                        <label for="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>">

                                                                <input type="text" id="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[". $item_id ."]" );?>" value="<?php echo esc_attr( $value ); ?>" /><?php echo esc_attr( $title ); ?>

                                                        </label>

                                                </p>

                                                

                                                <?php

                                                $title = 'Background Type (note: if "column" is selected, you need to make a column hide. In that column will be shown the new image.)';

                                                $key = "menu-item-custom_codeless-bg_type";

                                                $value = get_post_meta( $item->ID, '_'.$key, true);

                                                ?>

                                                <p class="description description-wide codeless_background_image codeless_custom_mega_menu codeless_custom_mega_menu_d1">

                                                        <label for="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>">
                                                                
                                                                
                                                                <select id="edit-<?php echo esc_attr( $key.'-'.$item_id ); ?>" class=" <?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key . "[". $item_id ."]" );?>">

                                                                        
                                                                        <option value="background" <?php if( $value == 'background' ): echo 'selected="selected"'; endif; ?>><?php esc_attr_e('Megamenu Background', 'thype') ?></option>
                                                                        <option value="column" <?php if( $value == 'column' ): echo 'selected="selected"'; endif; ?>><?php esc_attr_e('Image in Column', 'thype') ?></option>
                                                                </select>
                                                                <?php echo esc_attr( $title ); ?>
                                                        </label>

                                                </p>

                                        </div>






                                <fieldset class="field-move hide-if-no-js description description-wide">
                                        <span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move', 'thype' ); ?></span>
                                        <button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'thype' ); ?></button>
                                        <button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'thype' ); ?></button>
                                        <button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
                                        <button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
                                        <button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'thype' ); ?></button>
                                </fieldset>

                                <div class="menu-item-actions description-wide submitbox">
                                        <?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
                                                <p class="link-to-original">
                                                        <?php printf( esc_attr__('Original: %s', 'thype'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                                                </p>
                                        <?php endif; ?>
                                        <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
                                        echo wp_nonce_url(
                                                add_query_arg(
                                                        array(
                                                                'action' => 'delete-menu-item',
                                                                'menu-item' => $item_id,
                                                        ),
                                                        admin_url( 'nav-menus.php' )
                                                ),
                                                'delete-menu_item_' . $item_id
                                        ); ?>"><?php esc_html_e( 'Remove', 'thype' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                                                ?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e('Cancel', 'thype'); ?></a>
                                </div>

                                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
                                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                        </div><!-- .menu-item-settings-->
                        <ul class="menu-item-transport"></ul>
                <?php
                $output .= ob_get_clean();
        }

	} // Walker_Nav_Menu_Edit
}

if(!function_exists('codeless_custom_change_walker'))

{

	function codeless_custom_change_walker()

	{	

		if ( ! current_user_can( 'edit_theme_options' ) )

		die('-1');



		check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );

	

		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

	

		$item_ids = wp_save_nav_menu_items( 0, $_POST['menu-item'] );

		if ( is_wp_error( $item_ids ) )

			die('-1');

	

		foreach ( (array) $item_ids as $menu_item_id ) {

			$menu_obj = get_post( $menu_item_id );

			if ( ! empty( $menu_obj->ID ) ) {

				$menu_obj = wp_setup_nav_menu_item( $menu_obj );

				$menu_obj->label = $menu_obj->title; 

				$menu_items[] = $menu_obj;

			}

		}

	

		if ( ! empty( $menu_items ) ) {

			$args = array(

				'after' => '',

				'before' => '',

				'link_after' => '',

				'link_before' => '',

				'walker' => new codeless_custom_menu_backend,

			);

			echo walk_nav_menu_tree( $menu_items, 0, (object) $args );

		}

		

		die('end');

	}

	

	//hook into wordpress admin.php

	add_action('wp_ajax_codeless_custom_change_walker', 'codeless_custom_change_walker');

}