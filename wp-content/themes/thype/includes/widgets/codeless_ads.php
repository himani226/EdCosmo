<?php

class CodelessAdsWidget extends WP_Widget{



    function __construct(){

        $options = array('classname' => 'widget_ads', 'description' => 'Add an ad', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_ads', THEMENAME.' Widget Ads', $options );

    }



    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo wp_kses_post( $before_widget );

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $ad_url = empty($instance['ad_url']) ? '' : $instance['ad_url'];

        $ad_img = empty($instance['ad_img']) ? '' : $instance['ad_img'];

        $width = empty($instance['width']) ? '' : $instance['width'];

        $height = empty($instance['height']) ? '' : $instance['height'];

        if ( !empty( $title ) ) { 

		      echo wp_kses_post( $before_title .  $title . $after_title ); 

        }

        $extra_style = '';

        if( !empty($width) )
            $extra_style .= ' width:'.esc_attr($width).'; ';

        if( !empty($height) )
            $extra_style .= ' height:'.esc_attr($height).'; ';

        echo '<a href="'.esc_url($ad_url).'"><img style="'.$extra_style.'" src="'.esc_url($ad_img).'" alt="'.esc_attr__('Banner Image', 'thype').'" /></a>';

        echo wp_kses_post( $after_widget );

    }

    



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['ad_url'] = $new_instance['ad_url'];

        $instance['ad_img'] = $new_instance['ad_img'];

        $instance['width'] = $new_instance['width'];

        $instance['height'] = $new_instance['height'];

        return $instance;

    }



    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ad_url' => '', 'ad_img' => '', 'width' => '', 'height' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $ad_url = isset($instance['ad_url']) ? $instance['ad_url']: "";

        $ad_img = isset($instance['ad_img']) ? $instance['ad_img']: "";

        $height = isset($instance['height']) ? $instance['height']: "";

        $width = isset($instance['width']) ? $instance['width']: "";

        ?>

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title: 

    		<input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        

        <p>

    		<label for="<?php echo esc_attr( $this->get_field_id('ad_url') ); ?>">Ad URL: 

    		<input id="<?php echo esc_attr( $this->get_field_id('ad_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ad_url') ); ?>" type="text" value="<?php echo esc_url($ad_url); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('ad_img') ); ?>">Ad Image (Source): 

            <input id="<?php echo esc_attr( $this->get_field_id('ad_img') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ad_img') ); ?>" type="text" value="<?php echo esc_attr($ad_img); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('width') ); ?>">Width (ex: 200px): 

            <input id="<?php echo esc_attr( $this->get_field_id('width') ); ?>" name="<?php echo esc_attr( $this->get_field_name('width') ); ?>" type="text" value="<?php echo esc_attr($width); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr( $this->get_field_id('height') ); ?>">Height (ex: 200px): 

            <input id="<?php echo esc_attr( $this->get_field_id('height') ); ?>" name="<?php echo esc_attr( $this->get_field_name('height') ); ?>" type="text" value="<?php echo esc_attr($height); ?>" /></label>

        </p>

        <?php

    }

}
?>