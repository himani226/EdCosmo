<?php 

class CodelessSocialWidget extends WP_Widget{


    function __construct(){

        $options = array('classname' => 'widget_socials', 'description' => 'Add a social widget', 'customize_selective_refresh' => true );

        parent::__construct( 'widget_socials', THEMENAME.' Social Widget', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

        echo wp_kses_post( $before_widget );

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $style = empty($instance['style']) ? '' : $instance['style'];
        
       
        if(!empty($title))
            echo wp_kses_post( $before_title . $title . $after_title );
     


        echo '<ul class="social-icons-widget '.esc_attr($style).'">';

            $facebook = codeless_get_mod( 'facebook_link', '' );
            $dribbble = codeless_get_mod( 'dribbble_link', '' );
            $google = codeless_get_mod( 'google_link', '' );
            $twitter = codeless_get_mod( 'twitter_link', '' );
            $foursquare = codeless_get_mod( 'foursquare_link', '' );
            $pinterest = codeless_get_mod( 'pinterest_link', '' );
            $linkedin = codeless_get_mod( 'linkedin_link', '' );
            $youtube = codeless_get_mod( 'youtube_link', '' );
            $email = codeless_get_mod( 'email_link', '' );
            $instagram = codeless_get_mod( 'instagram_link', '' );
            $github = codeless_get_mod( 'github_link', '' );
            $skype = codeless_get_mod( 'skype_link', '' );
            $soundcloud = codeless_get_mod( 'soundcloud_link', '' );
            $slack = codeless_get_mod( 'slack_link', '' );
            $behance = codeless_get_mod( 'behance_link', '' );
            
            if( !empty($facebook) )
               echo '<li class="facebook"><a href="'.esc_url($facebook).'"><i class="cl-icon-facebook"></i></a></li>';
            if( !empty($twitter) )
                echo '<li class="twitter"><a href="'.esc_url($twitter).'"><i class="cl-icon-twitter"></i></a></li>';
            if( !empty($google) )
                echo '<li class="google"><a href="'.esc_url($google).'"><i class="cl-icon-google-plus"></i></a></li>';
            if( !empty($dribbble) )
                echo '<li class="dribbble"><a href="'.esc_url($dribbble).'"><i class="cl-icon-dribbble"></i></a></li>';
            if( !empty($linkedin) )
                echo '<li class="linkedin"><a href="'.esc_url($linkedin).'"><i class="cl-icon-linkedin"></i></a></li>';
            if( !empty($pinterest) )
                echo '<li class="pinterest"><a href="'.esc_url($pinterest).'"><i class="cl-icon-pinterest"></i></a></li>';
            if( !empty($youtube) )
                echo '<li class="youtube"><a href="'.esc_url($youtube).'"><i class="cl-icon-youtube-play"></i></a></li>';
            if( !empty($email) )
                echo '<li class="email"><a href="'.esc_url($email).'"><i class="cl-icon-email"></i></a></li>';
            if( !empty($instagram) )
                echo '<li class="instagram"><a href="'.esc_url($instagram).'"><i class="cl-icon-instagram"></i></a></li>';
            if( !empty($github) )
                echo '<li class="github"><a href="'.esc_url($github).'"><i class="cl-icon-github-box"></i></a></li>';
            if( !empty($skype) )
                echo '<li class="skype"><a href="'.esc_url($skype).'"><i class="cl-icon-skype"></i></a></li>';
            if( !empty($soundcloud) )
                echo '<li class="soundcloud"><a href="'.esc_url($soundcloud).'"><i class="cl-icon-soundcloud"></i></a></li>';
            if( !empty($slack) )
                echo '<li class="slack"><a href="'.esc_url($slack).'"><i class="cl-icon-slack"></i></a></li>';
            if( !empty($behance) )
                echo '<li class="behance"><a href="'.esc_url($behance).'"><i class="cl-icon-behance"></i></a></li>';

            if( !empty($foursquare) )
                echo '<li class="foursquare"><a href="'.esc_url($foursquare).'"><i class="cl-icon-foursquare"></i></a></li>';

        echo '</ul>';


        echo wp_kses_post( $after_widget );

    }



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        return $instance;

    }


    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

      

        ?>

        <p>

            <label for="<?php echo esc_html( $this->get_field_id('title') ); ?>">Title: 

            <input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_html( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>
            <?php esc_attr_e( 'Set Social links on Customizer -> General -> Social Links', 'thype' ) ?>
        </p>

        <?php

    }

}
?>