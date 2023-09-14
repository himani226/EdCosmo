<?php
/**
 * Used for generate the default header of site
 * 
 * @package Thype WordPress Theme
 * @subpackage Framework
 * @version 1.0.0
 */

class CodelessHeaderOutput{

	private $builder;

	public function __construct(){

		$this->builder = codeless_get_mod( 'cl_header_builder', codeless_get_default_header() );

	}


	function output(){

        if(isset($this->builder['top'])){
            echo '<div class="cl-header__row cl-header__row--top " data-row="top">';
                echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                    echo '<div class="cl-header__col cl-header__col--left  '.codeless_header_col_classes( 'top', 'left' ).'" data-col="left">';
                        $this->output_col('top', 'left');
                    echo '</div>';
                    
                    echo '<div class="cl-header__col cl-header__col--middle " data-col="middle">';
                        $this->output_col('top', 'middle');
                    echo '</div>';
                    
                    echo '<div class="cl-header__col cl-header__col--right " data-col="right">';
                        $this->output_col('top', 'right');
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        
            echo '<div class="cl-header__row cl-header__row--main " data-row="main">';
            echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                echo '<div class="cl-header__col cl-header__col--left   '.codeless_header_col_classes( 'main', 'left' ).'" data-col="left">';
                    $this->output_col('main', 'left');
                echo '</div>';
                
                echo '<div class="cl-header__col cl-header__col--middle " data-col="middle">';
                    $this->output_col('main', 'middle');
                echo '</div>';
                
                echo '<div class="cl-header__col cl-header__col--right " data-col="right">';
                    $this->output_col('main', 'right');
                echo '</div>';
            echo '</div>';
            echo '</div>';
        
        if(isset($this->builder['extra'])){
            echo '<div class="cl-header__row cl-header__row--extra " data-row="extra">';
            echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container-fluid' ).'">';
                echo '<div class="cl-header__col cl-header__col--left " data-col="left">';
                    $this->output_col('extra', 'left');
                echo '</div>';
                
                echo '<div class="cl-header__col cl-header__col--middle " data-col="middle">';
                    $this->output_col('extra', 'middle');
                echo '</div>';
                
                echo '<div class="cl-header__col cl-header__col--right " data-col="right">';
                    $this->output_col('extra', 'right');
                echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    
    function output_col($row, $column){
        
        $data = array();
        if(isset($this->builder[$row][$column])){
            $data = $this->builder[$row][$column];
            foreach($data as $element){
                $this->output_element($element);
            }
        }
        
        
    }
    
    
    function output_element($element){
        $extra = '';
                  
        echo '<div class="cl-header__element cl-header__element--'.$element['type'].'" '.$extra.'>';
                                              
            echo codeless_complex_esc( $this->output_template($element) );
                 
        echo '</div>';
    }
    

    function output_template($element){
        
        if(isset($element['params']) && !is_array($element['params']))
            return false;
        
        
        
        $template_url = get_template_directory().'/includes/codeless_builder/header-elements/cl_header_'.$element['type'].'.php';
        
        $output = '';
        
        if(is_file($template_url)){
            
		    ob_start();
		    include( $template_url );
		    $output = ob_get_contents();
		    ob_end_clean();
        }
        
        return $output;
        
    }

}