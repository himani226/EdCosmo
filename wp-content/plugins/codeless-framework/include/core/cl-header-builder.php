<?php

if( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


class Cl_Header_Builder
{
    
    var $builder;
    var $outputCSS = '';
    var $output;
    var $element = array();
    var $css_classes = array();
    var $css_property = array();
    var $custom_css = '';
    
    function init()
    {
        
        $this->load_header_elements();
        
        $cl_header_builder = codeless_get_mod( 'cl_header_builder' );
        
        if( $cl_header_builder == '' || ( is_array( $cl_header_builder ) && empty( $cl_header_builder ) ) )
            set_theme_mod( 'cl_header_builder', codeless_get_default_header() );
        
        add_action( 'customize_register', array(
             $this,
            'register_header_builder' 
        ) );
        
        
        $this->builder = codeless_get_mod( 'cl_header_builder' );
        
        add_action( 'customize_preview_init', array(
             $this,
            'preview_init_enqueue' 
        ) );
        add_action( 'customize_controls_enqueue_scripts', array(
             $this,
            'pane_init_enqueue' 
        ) );

        if(is_customize_preview()){
        	add_action( 'the_post', array(&$this, 'parseEditableContent', ), 9999 ); // after all the_post actions ended
	    	add_action( 'wp_footer', array( &$this, 'printPostShortcodes', ) );
        }
        
        //add_action( 'wp_head', array( $this, 'output_css' ), 150 );
        add_action( 'wp_ajax_cl_load_header_element', array(
             $this,
            'cl_load_header_element' 
        ) );
        add_action( 'wp_ajax_cl_reload_template', array(
             $this,
            'cl_reload_template' 
        ) );
    }
    
    function parseEditableContent(){
        ob_start();
        if(is_customize_preview()){
            cl_include_template( 'post_shortcodes.tpl.php', array( 'cl_page_builder' => $this ) );
            cl_include_template( 'dialog.tpl.php', array( 'cl_page_builder' => $this ) );
            cl_include_template( 'cl_row-video.tpl.php', array( 'cl_page_builder' => $this ) );
        }
        $post_shortcodes = ob_get_clean();
        $GLOBALS['cl_post_content'] =  $post_shortcodes;
    }

    public function printPostShortcodes() {
        
		echo isset( $GLOBALS['cl_post_content'] ) ? $GLOBALS['cl_post_content'] : '';
	}

    public function load_header_elements()
    {
        
        if( is_file( cl_path_dir( 'THEME_CODELESS_CONFIG', 'cl-header-elements.php' ) ) )
            require_once cl_path_dir( 'THEME_CODELESS_CONFIG', 'cl-header-elements.php' );
        else
            require_once cl_path_dir( 'CONFIG_DIR', 'cl-header-elements.php' );
    }
    
    function register_header_builder( $wp_customize )
    {
        $wp_customize->add_setting( 'cl_header_builder', array(
             'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'postMessage' 
        ) );
    }
    
    function preview_init_enqueue()
    {
        
    }
    
    function pane_init_enqueue()
    {
        
    }
    
    public function generateClasses( $selector )
    {
        $classes = array();
        
        if( isset( $this->css_classes[ $selector ] ) ) {
            
            foreach( $this->css_classes[ $selector ] as $field_id => $field ) {
                if( isset( $this->element[ 'params' ][ $field_id ] ) )
                    $value = $this->element[ 'params' ][ $field_id ];
                else
                    $value = $field[ 'default' ];
                
                
                if( isset( $field[ 'cl_required' ] ) ) {
                    if( !$this->checkRequired( $field[ 'cl_required' ] ) )
                        continue;
                }
                
                if( $field_id == 'animation' ) {
                    if( $value != 'none' ) {
                        $classes[] = 'animate_on_visible';
                        $classes[] = $value;
                    }
                    continue;
                }
                
                if( $field[ 'type' ] == 'multicheck' ) {
                    if( !is_array( $value ) ) {
                        $value = str_replace( "'", '"', str_replace( '_-_json', '', $value ) );
                        $value = json_decode( $value, true );
                    }
                    
                    if( !empty( $value ) ) {
                        foreach( $value as $prop => $val ) {
                            $classes[] = $val;
                        }
                    }
                    continue;
                }
                
                if( $field[ 'type' ] == 'select' && strpos( $value, '_-_json' ) !== false ) {
                    $value = str_replace( "'", '"', str_replace( '_-_json', '', $value ) );
                    $value = json_decode( $value, true );
                    
                    if( !empty( $value ) ) {
                        foreach( $value as $prop => $val ) {
                            $classes[] = $val;
                        }
                    }
                    continue;
                }
                
                
                if( isset( $field[ 'selectClass' ] ) ) {
                    $classes[] = $field[ 'selectClass' ] . $value;
                    continue;
                }
                
                if( isset( $field[ 'addClass' ] ) ) {
                    
                    if( (int) $value || !empty( $value ) )
                        $classes[] = $field[ 'addClass' ];
                    continue;
                }
                
            }
        }
        
        return implode( " ", $classes );
    }
    
    public function generateStyle( $selector, $echo = false )
    {
        $style    = '';
        $dataHtml = '';
        
        if( isset( $this->css_property[ $selector ] ) ) {
            foreach( $this->css_property[ $selector ] as $field_id => $field ) {
                
                if( isset( $field[ 'media_query' ] ) )
                    continue;
                
                if( isset( $this->element[ 'params' ][ $field_id ] ) && !empty( $this->element[ 'params' ][ $field_id ] ) ) 
                    $value = $this->element[ 'params' ][ $field_id ];
                else
                    $value = $field['default'];
                    
                    
                    if( isset( $field[ 'cl_required' ] ) ) {
                        if( !$this->checkRequired( $field[ 'cl_required' ] ) )
                            continue;
                    }
                    
                    if( empty( $value ) && !empty( $field[ 'default' ] ) )
                        $value = $field[ 'default' ];
                    
                    
                    $suffix = ( isset( $field[ 'suffix' ] ) && !empty( $field[ 'suffix' ] ) ) ? $field[ 'suffix' ] : '';
                    $suffix = ( $suffix == '' && isset( $field[ 'choices' ] ) && isset( $field[ 'choices' ][ 'suffix' ] ) ) ? $field[ 'choices' ][ 'suffix' ] : $suffix;
                    
                    
                    if( isset( $field[ 'htmldata' ] ) && !empty( $field[ 'htmldata' ] ) ) {
                        $dataHtml .= 'data-' . $field[ 'htmldata' ] . '="' . $value . '" ';
                        continue;
                    }
                    
                    
                    if( $field[ 'css_property' ] == 'background-image' ) {
                        if( strpos( $value, '_-_json' ) !== false ) {
                            $value = str_replace( "'", '"', str_replace( '_-_json', '', $value ) );
                            if( !is_array( $value ) )
                                $value = json_decode( $value, true );
                            if( isset( $value[ 'url' ] ) )
                                $style .= $field[ 'css_property' ] . ': url(' . urldecode( $value[ 'url' ] ) . ');';
                        } else {
                            $style .= $field[ 'css_property' ] . ': url(' . $value . ');';
                        }
                        
                        continue;
                    }
                    
                    if( $field[ 'css_property' ] == 'font-family' ) {
                        if( $value == 'theme_default' )
                            continue;
                        else
                            $value = "'" . $value . "'";
                    }
                    
                    
                    
                    if( $field[ 'type' ] == 'css_tool' ) {
                        $value = str_replace( "'", '"', str_replace( '_-_json', '', $value ) );
                        if( !is_array( $value ) )
                            $value = json_decode( $value, true );
                        
                        if( !empty( $value ) ) {
                            foreach( $value as $prop => $val ) {
                                $style .= $prop . ': ' . $val . ';';
                            }
                        }
                        
                        continue;
                    }
                    
                    if( !is_array( $field[ 'css_property' ] ) )
                        $style .= $field[ 'css_property' ] . ': ' . $value . $suffix . ';';
                    else {
                        $css_property1 = $field[ 'css_property' ][ 0 ];
                        $style .= $css_property1 . ': ' . $value . $suffix . ';';
                        $exec = false;
                        if( is_array( $field[ 'css_property' ][ 1 ] ) ) {
                            $addition_property = $field[ 'css_property' ][ 1 ][ 0 ];
                            $addition_require  = $field[ 'css_property' ][ 1 ][ 1 ];
                            if( is_array( $addition_require ) ) {
                                foreach( $addition_require as $a_value => $new_value ) {
                                    if( !$exec ) {
                                        if( $a_value == $value )
                                            $style .= $addition_property . ': ' . $new_value . ';';
                                        else {
                                            if( isset( $addition_require[ 'other' ] ) ) {
                                                $style .= $addition_property . ': ' . $new_value . ';';
                                            }
                                        }
                                        $exec = true;
                                    }
                                }
                            }
                        } else {
                            $css_property2 = $field[ 'css_property' ][ 1 ];
                            $style .= $css_property2 . ': ' . $value . $suffix . ';';
                        }
                    }
                
            }
        }
        
        $style = 'style="' . $style . '" ' . $dataHtml;
        
        if( $echo )
            echo $style;
        else
            return $style;
    }
    
    
    function output()
    {
        $this->builder = codeless_get_mod( 'cl_header_builder', codeless_get_default_header() );
        
        if( codeless_get_mod( 'header_top_nav', false ) || ( isset( $this->builder[ 'top' ] ) && !codeless_get_mod( 'cl_header_builder', false )  ) ) {
            echo '<div class="cl-header__row cl-header__row--top" data-row="top">';
                echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                    
                        echo '<div class="cl-header__col cl-header__col--left '.codeless_header_col_classes( 'top', 'left' ).'" data-col="left">';
                            $this->output_col('top', 'left');
                        echo '</div>';
                        
                        echo '<div class="cl-header__col cl-header__col--middle '.codeless_header_col_classes( 'top', 'middle' ).'" data-col="middle">';
                            $this->output_col('top', 'middle');
                        echo '</div>';
                        
                        echo '<div class="cl-header__col cl-header__col--right '.codeless_header_col_classes( 'top', 'right' ).'" data-col="right">';
                            $this->output_col('top', 'right');
                        echo '</div>';
                    
                echo '</div>';
            echo '</div>';
        }

        do_action('codeless_header_sections');
        
        echo '<div class="cl-header__row cl-header__row--main" data-row="main">';
            echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                
                    echo '<div class="cl-header__col cl-header__col--left '.codeless_header_col_classes( 'main', 'left' ).'" data-col="left">';
                        $this->output_col('main', 'left');
                    echo '</div>';
                    
                    echo '<div class="cl-header__col cl-header__col--middle '.codeless_header_col_classes( 'main', 'middle' ).'" data-col="middle">';
                        $this->output_col('main', 'middle');
                    echo '</div>';
                    
                    echo '<div class="cl-header__col cl-header__col--right '.codeless_header_col_classes( 'main', 'right' ).'" data-col="right">';
                        $this->output_col('main', 'right');
                    echo '</div>';
                
            echo '</div>';
        echo '</div>';

        if( codeless_get_mod( 'header_extra', false ) || ( isset( $this->builder[ 'extra' ] ) && !codeless_get_mod( 'cl_header_builder', false )  ) ) {
            
            echo '<div class="cl-header__row cl-header__row--extra" data-row="extra">';
                echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                   
                        echo '<div class="cl-header__col cl-header__col--left '.codeless_header_col_classes( 'extra', 'left' ).'" data-col="left">';
                            $this->output_col('extra', 'left');
                        echo '</div>';
                        
                        echo '<div class="cl-header__col cl-header__col--middle '.codeless_header_col_classes( 'extra', 'middle' ).'" data-col="middle">';
                            $this->output_col('extra', 'middle');
                        echo '</div>';
                        
                        echo '<div class="cl-header__col cl-header__col--right '.codeless_header_col_classes( 'extra', 'right' ).'" data-col="right">';
                            $this->output_col('extra', 'right');
                        echo '</div>';
                    
                echo '</div>';
            echo '</div>';
        }
        
        if( !empty( $this->custom_css ) ) {
            wp_enqueue_style( 'cl-elements-inline' );
            wp_add_inline_style( 'cl-elements-inline', $this->custom_css );
        }
    }
    
    function output_col( $row, $column )
    {
        
        $data = array();
        $this->output_col_tools();
        if( isset( $this->builder[ $row ][ $column ] ) ) {
            $data = $this->builder[ $row ][ $column ];
            foreach( $data as $element ) {
                $this->output_element( $element );
            }
        }
        
        
    }
    
    
    function output_col_tools()
    {
        if( codeless_get_post_id() == 0 || !is_customize_preview() )
            return;
        echo '<div class="add-header-element-prepend"></div>';
        echo '<div class="add-header-element-append"></div>';
    }
    
    
    function output_element( $element )
    {
        $extra = '';
        
        $this->css_property = array();
        $this->css_classes  = array();
        
        $this->generateStyleArray( $element );
        
        $this->element = $element;
        
        $cl_hide = '';
        
        if( is_customize_preview() )
            $extra = 'data-model-id="' . $element[ 'id' ] . '" data-type="' . $element[ 'type' ] . '"';
        
        if( isset( $element[ 'params' ] ) && isset( $element[ 'params' ][ 'hide_responsive' ] ) && $element[ 'params' ][ 'hide_responsive' ] )
            $cl_hide = ' cl-hide-on-mobile ';
        
        echo '<div class="cl-header__element cl-header__element--' . $element[ 'type' ] . ' ' . $cl_hide . '" ' . $extra . '>';
        
        $this->output_template( $element );
        //$this->output_element_css($id, $element);
        
        if( is_customize_preview() )
            $this->output_element_tools( $element );
        
        echo '</div>';
        
        
    }
    
    function addCustomCss( $css )
    {
        if( strpos( $this->custom_css, $css ) === false )
            $this->custom_css .= $css;
    }
    
    function generateStyleArray( $element )
    {
        $field = Cl_Builder_Mapper::getHeaderElement( $element[ 'type' ] );
        
        
        $fields = isset( $field[ 'fields' ] ) ? $field[ 'fields' ] : array();
        
        if( !empty( $fields ) ) {
            foreach( $fields as $field_id => $field ) {
                if( ( isset( $field[ 'css_property' ] ) || isset( $field[ 'htmldata' ] ) ) && isset( $field[ 'selector' ] ) && !empty( $field[ 'selector' ] ) ) {
                    if( !isset( $this->css_property[ $field[ 'selector' ] ] ) )
                        $this->css_property[ $field[ 'selector' ] ] = array();
                    
                    $this->css_property[ $field[ 'selector' ] ][ $field_id ] = $field;
                    
                }
                
                if( ( isset( $field[ 'selectClass' ] ) || $field_id == 'animation' ) && isset( $field[ 'selector' ] ) && !empty( $field[ 'selector' ] ) ) {
                    if( !isset( $this->css_classes[ $field[ 'selector' ] ] ) )
                        $this->css_classes[ $field[ 'selector' ] ] = array();
                    
                    $this->css_classes[ $field[ 'selector' ] ][ $field_id ] = $field;
                }
                
                if( isset( $field[ 'addClass' ] ) && isset( $field[ 'selector' ] ) && !empty( $field[ 'selector' ] ) ) {
                    if( !isset( $this->css_classes[ $field[ 'selector' ] ] ) )
                        $this->css_classes[ $field[ 'selector' ] ] = array();
                    
                    $this->css_classes[ $field[ 'selector' ] ][ $field_id ] = $field;
                }
                
                
            }
        }
    }
    
    function checkRequired( $cl_required )
    {
        $bool = true;
        
        foreach( $cl_required as $req ) {
            $set = $req[ 'setting' ];
            if( $req[ 'operator' ] == '==' ) {
                
                if( isset( $this->element[ 'params' ][ $set ] ) && $this->element[ 'params' ][ $set ] != $req[ 'value' ] ) {
                    $bool = false;
                    break;
                }
                
            } else if( $req[ 'operator' ] == '!=' ) {
                if( isset( $this->element[ 'params' ][ $set ] ) && $this->element[ 'params' ][ $set ] == $req[ 'value' ] ) {
                    $bool = false;
                    break;
                }
                
            }
            
        }
        
        return $bool;
    }
    
    
    function output_element_tools( $element )
    {
        
        $field = Cl_Builder_Mapper::getHeaderElement( $element[ 'type' ] );
        
        echo '<div class="cl_controls">';
        echo '<div class="cl_controls-out">';
        echo '<a href="#" class="cl_control-btn cl_control-btn-handle cl_element-move">' . $field[ 'label' ] . '</a>';
        echo '<a href="#" class="cl_control-btn cl_control-btn-delete"><i class="cl-builder-icon-trash2"></i></a>';
        echo '</div>';
        echo '</div>';
    }
    
    function output_template( $element )
    {
        
        if( isset( $element[ 'params' ] ) && !is_array( $element[ 'params' ] ) )
            return false;
        $element_field = Cl_Builder_Mapper::getHeaderElement( $element[ 'type' ] );
        
        $defaults = array();
        
        if( isset( $element_field[ 'fields' ] ) && is_array( $element_field[ 'fields' ] ) )
            $defaults = cl_map_get_params_defaults( $element_field[ 'fields' ] );
        
        $element[ 'params' ] = array_replace( $defaults, $element[ 'params' ] );
        
        
        $template_url = get_template_directory() . '/includes/codeless_builder/header-elements/cl_header_' . $element[ 'type' ] . '.php';
        
        if( !is_file( $template_url ) ) {
                return;
        }
        
        
        
        $output = '';
        
        if( is_file( $template_url ) ) {
            
            ob_start();
            include( $template_url );
            $output = ob_get_contents();
            ob_end_clean();
        }
        
        echo $output;
        
    }
    
    /*function output_elements_css(){
    $element_css = array();
    
    foreach($this->builder as $row){
    foreach($row as $column){
    foreach($column as $id => $element){
    $field = Kirki::$fields[$element['type']];
    if(!empty($field)){
    foreach($field['fields'] as $f_id => $f){
    
    if(isset($f['selector']) && isset($f['css_property'])){
    
    $selector = '.cl-h-'.$id;
    if(!empty($f['selector']))
    $selector = $selector.' '.$f['selector'];
    
    if(isset($element_css[$selector]))  
    $element_css[$selector] .= $f['css_property'].': '.$element['options'][$f_id].'; ';
    else
    $element_css[$selector] = $selector.'{ '.$f['css_property'].': '.$element['options'][$f_id].'; ';
    }
    }
    }
    $element_css[$selector] .= ' }';
    }
    }
    }
    $this->outputCSS .= implode("\n",$element_css);
    }*/
    
    /*function output_element_css($element){
    $element_css = array();
    
    
    $field = Kirki::$fields[$element['type']];
    if(!empty($field)){
    
    foreach($field['fields'] as $f_id => $f){
    
    if(isset($f['selector']) && isset($f['css_property'])){
    
    $selector = '.cl-h-'.$element['id'];
    if(!empty($f['selector']))
    $selector = $selector.' '.$f['selector'];
    
    if(isset($element_css[$selector]))  
    $element_css[$selector] .= $f['css_property'].': '.$element['options'][$f_id].'; ';
    else
    $element_css[$selector] = $selector.'{ '.$f['css_property'].': '.$element['options'][$f_id].'; ';
    }
    }
    if(!empty($element_css[$selector]))
    $element_css[$selector] .= ' }';
    
    echo '<style type="text/css" title="dynamic-css" class="cl-options-output">' . implode("\n",$element_css) . '</style>';
    }
    
    echo  '';
    }*/
    
    
    function cl_load_header_element()
    {
        
        if( isset( $_POST[ 'elements' ] ) && !empty( $_POST[ 'elements' ] ) ) {
            foreach( $_POST[ 'elements' ] as $element ) {
                
                $this->output_element( $element );
                
                
            }
        }
        
        die();
        
    }
    
    function cl_reload_template()
    {
        $element[ 'type' ]   = $_POST[ 'type' ];
        $element[ 'params' ] = $_POST[ 'params' ];
        
        $this->css_property = array();
        $this->css_classes  = array();
        
        $this->generateStyleArray( $element );
        
        $this->element = $element;
        
        $this->output_template( $element );
        $this->output_element_tools( $element );
        
        die();
    }
    
    
    /*function unserializeForm($str) {
    if(empty($str))
    return '';
    $strArray = explode("&", $str);
    foreach($strArray as $item) {
    $array = explode("=", $item);
    $returndata[$array[0]] = $array[1];
    }
    return $returndata;
    }
    
    function get_customizer_class($class){
    if(is_customize_preview())
    return $class;
    }
    
    function inline_edit_field($classes, $id){
    
    echo 'class="'.$classes.' cl_inline_editable"';
    echo ' data-field="'.$id.'"';
    }*/
    
    
    /*function output_css(){
    $this->output_elements_css();
    if( !empty($this->outputCSS) )
    echo '<style type="text/css" title="dynamic-css" class="cl-options-output">' . $this->outputCSS . '</style>';
    }
    
    
    
    function add_element_dialog(){
    if(is_customize_preview()){
    ?>
    <div class="dialog-add-element" aria-hidden="true" id="add-new-dialog" data-header_position="empty">
    
    <div class="dialog-overlay" tabindex="-1" data-a11y-dialog-hide></div>
    <div class="dialog-content" aria-labelledby="dialogTitle" aria-describedby="dialogDescription" role="dialog">
    <div role="document">
    <div class="elements">
    
    
    <?php foreach(Kirki::$fields as $field_id => $field): ?>
    
    <?php if($field['section'] == 'cl_codeless_header_builder'): ?>
    <a class="add" href="#" data-element="<?php echo $field_id ?>"><?php echo $field['label'] ?></a>
    <?php endif; ?>
    
    <?php endforeach; ?>
    </div>
    
    
    
    <button data-a11y-dialog-hide class="dialog-close" title="Close registration form">&times;</button>
    
    </div>
    </div>
    </div>
    <?php
    }
    }*/
    
}

?>