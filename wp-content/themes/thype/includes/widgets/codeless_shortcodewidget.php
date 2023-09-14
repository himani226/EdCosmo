<?php

class CodelessShortcodeWidget extends Wp_Widget{
 
 function __construct(){

        $options = array('classname' => 'widget_shortcode', 'description' => 'Add a text widget to show shortcodes', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_shortcode', THEMENAME.' Widget Shortcode', $options );

    }

 function widget($atts, $instance){

      extract($atts, EXTR_SKIP);

	    echo wp_kses_post( $before_widget );
    

        $title = empty($instance['title']) ? '' : $instance['title'];

        $content = empty($instance['content']) ? '' : $instance['content'];
               
            if ( !empty( $title ) ) { 

		      echo wp_kses_post( $before_title . $title . $after_title ); 

        }
        	  

        echo do_shortcode($content);

        		

        		
       
       echo wp_kses_post( $after_widget ); 

    }     


function update($new_instance, $old_instance){

        $instance = array();
 
        $instance['title'] = $new_instance['title'];

        $instance['content'] = $new_instance['content'];

        return $instance;

    }

 function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $content = isset($instance['content']) ? $instance['content']: "";


        ?>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title: 

    		<input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

         <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('content') ); ?>">Text & Shortcodes: 

  <textarea id="<?php echo esc_attr( $this->get_field_id('content') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content') ); ?>" type="text"><?php echo esc_attr($content); ?></textarea>

  			</label>

        </p>



        <?php

    }




}
?>