<?php

class CodelessFlickrWidget extends WP_Widget{



    function __construct(){

        $options = array('classname' => 'widget_flickr', 'description' => 'Add a flickr list', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_flickr', THEMENAME.' Widget Flickr', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo wp_kses_post( $before_widget );

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $user_id = empty($instance['user_id']) ? '' : $instance['user_id'];

        

        if ( !empty( $title ) ) { 

		      echo wp_kses_post( $before_title . $title . $after_title ); 

        }

        echo '<div class="flickr_container">';

        echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=6&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.esc_attr($user_id).'"></script>';

        echo '</div>';

        

        echo wp_kses_post( $after_widget );

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['user_id'] = $new_instance['user_id'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user_id' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $user_id = isset($instance['user_id']) ? $instance['user_id']: "";

        ?>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title: 

    		<input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('user_id') ); ?>">User Id: 

    		<input id="<?php echo esc_attr( $this->get_field_id('user_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user_id') ); ?>" type="text" value="<?php echo esc_attr($user_id); ?>" /></label>

        </p>

        <?php

    }

}
?>