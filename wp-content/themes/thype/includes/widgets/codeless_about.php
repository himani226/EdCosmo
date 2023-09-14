<?php 

class CodelessAboutMe extends WP_Widget{



    function __construct(){

        $options = array('classname' => 'widget_aboutme', 'description' => 'About Me Widget', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_aboutme', THEMENAME.' Widget About Me', $options );

    }


 
    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo wp_kses_post( $before_widget );

        
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        
        if ( !empty( $title ) ) { 

            echo wp_kses_post( $before_title . $title . $after_title ); 

        }

        $image = empty($instance['image']) ? '' : $instance['image'];

        $text = empty($instance['text']) ? '' : $instance['text'];

        $signature = empty($instance['signature']) ? '' : $instance['signature'];
        

        ?>

        <div class="wrapper">
            <?php if( !empty( $image ) ): ?>
                <img class="image" src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr__( 'About Me', 'thype' ) ?>" />
            <?php endif; ?>

            <p class="text"><?php echo codeless_complex_esc( $text ) ?></p>

            <?php if( !empty( $signature ) ): ?>
                <img class="signature" src="<?php echo esc_url( $signature ) ?>" alt="<?php echo esc_attr__( 'Signature', 'thype' ) ?>" />
            <?php endif; ?>
        </div>

        <?php
        
        
        echo wp_kses_post( $after_widget );

    }

    



    function update($new_instance, $old_instance){

        $instance = array();
        $instance['title'] = $new_instance['title'];

        $instance['image'] = $new_instance['image'];
        $instance['text'] = $new_instance['text'];
        $instance['signature'] = $new_instance['signature'];
        
        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'text' => '', 'signature' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";
        $image = isset($instance['image']) ? $instance['image']: "";

        $text = isset($instance['text']) ? $instance['text']: "";
        $signature = isset($instance['signature']) ? $instance['signature']: "";
        

        ?>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo esc_attr__('Widget Title', 'thype') ?>: 

                <input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </label>

        </p>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('image') ); ?>"><?php echo esc_attr__('Image Link', 'thype') ?>: 

                <input id="<?php echo esc_attr( $this->get_field_id('image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image') ); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
            
            </label>

        </p>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('text') ); ?>"><?php echo esc_attr__('Text', 'thype') ?>: 

                <textarea id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo esc_attr($text); ?></textarea>
            
            </label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('signature') ); ?>"><?php echo esc_attr__('Signature Image Link', 'thype') ?>: 

                <input id="<?php echo esc_attr( $this->get_field_id('signature') ); ?>" name="<?php echo esc_attr( $this->get_field_name('signature') ); ?>" type="text" value="<?php echo esc_attr($signature); ?>" />

            </label>

        </p>


        <?php

    }

}