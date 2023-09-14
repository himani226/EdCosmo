<?php 

class CodelessContactInfo extends WP_Widget{



    function __construct(){

        $options = array('classname' => 'widget_contactinfo', 'description' => '', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_contactinfo', THEMENAME.' Widget Contact Info', $options );

    }


 
    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo wp_kses_post( $before_widget );

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $address = empty($instance['address']) ? '' : $instance['address'];
        $phone = empty($instance['phone']) ? '' : $instance['phone'];
        $email = empty($instance['email']) ? '' : $instance['email'];

      

        if ( !empty( $title ) ) { 

              echo wp_kses_post( $before_title . $title . $after_title ); 

        }

        ?>

        <div class="cl-contact-info">

            <?php if( !empty( $address ) ): ?>
            <div class="info"><i class="cl-icon-map-marker-radius"></i><span><?php echo codeless_complex_esc( $address ) ?></span></div>
            <?php endif; ?>

            <?php if( !empty( $email ) ): ?>
            <div class="info mail"><i class="cl-icon-email"></i><span><?php echo esc_attr( $email ) ?></span></div>
            <?php endif; ?>

            <?php if( !empty( $phone ) ): ?>
            <div class="info"><i class="cl-icon-phone"></i><span><?php echo esc_attr( $phone ) ?></span></div>
            <?php endif; ?>
        
        </div>

      
        <?php

        echo wp_kses_post( $after_widget );

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['address'] = $new_instance['address'];
        $instance['phone'] = $new_instance['phone'];
        $instance['email'] = $new_instance['email'];
        

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'address' => '', 'phone' => '', 'email' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $address = isset($instance['address']) ? $instance['address']: "";
        $phone = isset($instance['phone']) ? $instance['phone']: "";
        $email = isset($instance['email']) ? $instance['email']: "";
     
        ?>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo esc_attr__('Widget Title', 'thype') ?>: 

    		<input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('address') ); ?>"><?php echo esc_attr__('Address', 'thype') ?>: 

            <input id="<?php echo esc_attr( $this->get_field_id('address') ); ?>" name="<?php echo esc_attr( $this->get_field_name('address') ); ?>" type="text" value="<?php echo esc_attr($address); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('email') ); ?>"><?php echo esc_attr__('Email', 'thype') ?>: 

            <input id="<?php echo esc_attr( $this->get_field_id('email') ); ?>" name="<?php echo esc_attr( $this->get_field_name('email') ); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('phone') ); ?>"><?php echo esc_attr__('Phone', 'thype') ?>: 

            <input id="<?php echo esc_attr( $this->get_field_id('phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name('phone') ); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></label>

        </p>

        <?php

    }

}