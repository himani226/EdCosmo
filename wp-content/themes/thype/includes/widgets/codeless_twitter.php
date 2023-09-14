<?php

class CodelessTwitter extends WP_Widget{


    function __construct(){

        $options = array('classname' => 'widget_twitter', 'description' => 'A widget to display latest entries from twitter', 'customize_selective_refresh' => true );

		parent::__construct( 'widget_twitter', THEMENAME.' Twitter Widget', $options );

		require_once( 'class-wp-twitter-api.php' ); 
    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

		echo wp_kses_post( $before_widget );

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

		$count = empty($instance['count']) ? '' : $instance['count'];
		
              
		$username = empty($instance['username']) ? '' : $instance['username'];
              
              $twitter_consumer_key = empty($instance['twitter_consumer_key']) ? '' : $instance['twitter_consumer_key'];

              $twitter_consumer_secret = empty($instance['twitter_consumer_secret']) ? '' : $instance['twitter_consumer_secret'];
 
        $time = empty($instance['time']) ? 'no' : $instance['time'];

		$display_image = empty($instance['display_image']) ? 'no' : $instance['display_image'];

        $used_for = 'sidebar';

		if ( !empty( $title ) && $used_for == 'sidebar' ) { 

		      echo wp_kses_post( $before_title . $title . $after_title ); 

        }

		echo get_twitter_entries($count, $username, $widget_id, $time, $display_image, $used_for, $twitter_consumer_key, $twitter_consumer_secret );

        echo wp_kses_post( $after_widget );

    }


    function update($new_instance, $old_instance) {

		$instance = $old_instance;	

		foreach($new_instance as $key=>$value)

		{

			$instance[$key]	= strip_tags($new_instance[$key]);

		}

		delete_transient(THEMENAME.'_tweetcache_id_'.$instance['username'].'_'.$this->id_base."-".$this->number);

		return $instance;

	}


    function form($instance){

    	global $cl_redata;

        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Latest Tweets', 'count' => '3' ) );

		$title = 			isset($instance['title']) ? strip_tags($instance['title']): "";

		$count = 			isset($instance['count']) ? strip_tags($instance['count']): "";

		$username = 		isset($instance['username']) ? strip_tags($instance['username']): "";

		$time = 			isset($instance['time']) ? strip_tags($instance['time']): "";

		$display_image = 	isset($instance['display_image']) ? strip_tags($instance['display_image']): "";
              
              $twitter_consumer_key = isset($instance['twitter_consumer_key']) ? strip_tags($instance['twitter_consumer_key']): "";
          
              $twitter_consumer_secret = isset($instance['twitter_consumer_secret']) ? strip_tags($instance['twitter_consumer_secret']): "";

        

        ?>

        <p>

		<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title: 

		<input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title) ; ?>" /></label></p>

		

		<p><label for="<?php echo esc_attr( $this->get_field_id('username') ); ?>">Enter your twitter username:

		<input id="<?php echo esc_attr( $this->get_field_id('username') ); ?>" name="<?php echo esc_attr( $this->get_field_name('username') ); ?>" type="text" value="<?php echo esc_attr($username) ; ?>" /></label></p>
              
             
                 <p><label for="<?php echo esc_attr( $this->get_field_id('twitter_consumer_key') ); ?>">Enter your twitter consumer key:

		<input id="<?php echo esc_attr( $this->get_field_id('twitter_consumer_key') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_consumer_key') ); ?>" type="text" value="<?php echo esc_attr($twitter_consumer_key) ; ?>" /></label></p>

              <p><label for="<?php echo esc_attr( $this->get_field_id('twitter_consumer_secret') ); ?>">Enter your twitter consumer secret:

		<input id="<?php echo esc_attr( $this->get_field_id('twitter_consumer_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_consumer_secret') ); ?>" type="text" value="<?php echo esc_attr($twitter_consumer_secret) ; ?>" /></label></p>



		

		<p>


                   

			<label for="<?php echo esc_attr( $this->get_field_id('count') ); ?>">How many entries do you want to display: </label>

			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('count' )); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>">

				<?php 

				$elements = "";

				for ($i = 1; $i <= 20; $i++ )

				{

					$selected = "";

					if($count == $i) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$i'>$i</option>";

				}

				$elements .= "</select>";

				echo codeless_complex_esc( $elements );

				?>

				

			

		</p>

		

		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('time') ); ?>">Display time of tweet</label>

			<select id="<?php echo esc_attr( $this->get_field_id('time') ); ?>" name="<?php echo esc_attr( $this->get_field_name('time') ); ?>">

				<?php 

				$elements = "";

				$answers = array('yes','no');

				foreach ($answers as $answer)

				{

					$selected = "";

					if($answer == $time) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$answer'>$answer</option>";

				}

				$elements .= "</select>";

				echo codeless_complex_esc( $elements );

				?>

				

			

		</p>



		<p>

			<label for="<?php echo esc_attr( $this->get_field_id('display_image') ); ?>">Display Twitter User Avatar</label>

			<select  id="<?php echo esc_attr( $this->get_field_id('display_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('display_image') ); ?>">

				<?php 

				$elements = "";

				$answers = array('no','yes');

				foreach ($answers as $answer)

				{

					$selected = "";

					if($answer == $display_image) $selected = 'selected="selected"';

				

					$elements .= "<option $selected value='$answer'>$answer</option>";

				}

				$elements .= "</select>";

				echo codeless_complex_esc( $elements );

				?>

		</p>

       

        <?php

    }

    

}


function get_twitter_entries($count, $username, $widget_id, $time='yes', $avatar = 'yes', $used_for = 'sidebar', $twitter_consumer_key, $twitter_consumer_secret)

{		

$filtered_message = "";
        $output = "";
        $iterations = 0;
        
        $cache = get_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id);
        
        if($cache)
        {
          // $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
       else
       {

     // Include Twitter API Client
           require_once( 'class-wp-twitter-api.php' );

        // Set your personal data retrieved at https://dev.twitter.com/apps
            $credentials = array(
              'consumer_key' => $twitter_consumer_key,
              'consumer_secret' => $twitter_consumer_secret            ); 

// Let's instantiate Wp_Twitter_Api with your credentials
$twitter_api = new Wp_Twitter_Api( $credentials );


// Example a - Retrieve last 5 tweets from my timeline (default type statuses/user_timeline)
$query = 'count=5&include_entities=true&include_rts=true&screen_name='.$username;
        
        $response = $twitter_api->query( $query );

      
           if (!is_wp_error($response)) 
            {
                
                                       
                        $tweets = array();
                        if(!empty($response)){
                        foreach ($response as $tweet) 
                        {
                            if($iterations == $count) break;
                            
                            $text = (string) $tweet->text;
                            if($text[0] != "@")
                            {
                                $iterations++;
                                $tweets[] = array(
                                    'text' => filter( $text ),
                                    'created' =>  strtotime( $tweet->created_at ),
                                    'user' => array(
                                        'name' => (string)$tweet->user->name,

                                        'screen_name' => (string)$tweet->user->screen_name,
                                        'image' => (string)$tweet->user->profile_image_url,
                                        'utc_offset' => (int) $tweet->user->utc_offset[0],
                                        'follower' => (int) $tweet->user->followers_count));
                            }
                        }
                        
                        set_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id, 'true', 60*30);
                        update_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id, $tweets);
                  
               
            }
        }
    }

        
      if(!isset($tweets[0]))

		{

			$tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);

		}

		

	    if(isset($tweets[0]))

	    {	

	    	$time_format = get_option('date_format')." - ".get_option('time_format');

	        if($used_for == 'sidebar'){

    	    	foreach ($tweets as $message)

    	    	{	
    	    		$ex_cl = '';
    	    		if($avatar == 'yes')
    	    			$ex_cl = 'with_avatar';
    	    		$output .='<li><span class="media">';

    	    		if($avatar == 'yes')
    	    			$output .= '<img src="'.esc_url( $message['user']['image'] ).'" alt="avatar" />';
    	    		else
    	    			$output .= '<i class="cl-icon-twitter"></i>';

    	    		$output .= '</span><div class="content">';

                

	    	    		$output .= '<span class="message">'.wp_kses_post( $message['text'] ).'</span>';

	    	    		$output .= '<span class="date">'.date_i18n( $time_format, $message['created'] + $message['user']['utc_offset']).'</span>';

    	    		$output .= '</div></li>';

    			}

            }

	    }

	

		

		if($output != "")

		{

			if($used_for == 'sidebar')

                $filtered_message = "<ul class='tweet_list'>$output</ul>";

            else

                $filtered_message = "<ul class='tweet_list row'>$output</ul>";

		}

		else

		{

			if($used_for == 'sidebar')

                $filtered_message = "<ul class='tweet_list'><li>No public Tweets found</li></ul>";

            else

                $filtered_message = '<p>No public Tweets found</p>';

		}

		

		return $filtered_message;

}


function filter($text) {

    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);

    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    

    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);

    $text = preg_replace("/#(\w+)/", "<a class=\"twitter-link\" href=\"http://twitter.com/hashtag/\\1\">#\\1</a>", $text);

    $text = preg_replace("/@(\w+)/", "<a class=\"twitter-link\" href=\"http://twitter.com/\\1\">@\\1</a>", $text);



    return $text;

}
