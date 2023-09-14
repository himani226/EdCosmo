<div class="entry-media">

	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
		
		if ( ! is_single() ) :
	
			// If not a single post, highlight the video file.
			if ( ! empty( $audio ) ) :
				foreach ( $audio as $audio_html ) {
					echo '<div class="entry-audio">';
						echo codeless_complex_esc( $audio_html );
					echo '</div>';
				}
			endif;
		endif;
	?>

</div><!-- .entry-media --> 