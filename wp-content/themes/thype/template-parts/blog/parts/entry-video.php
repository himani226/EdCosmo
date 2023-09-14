<div class="cl-entry__media">
	<?php
	
		$content = apply_filters( 'the_content', get_the_content() );
		$video = false;
	
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content );
		}
		
		if ( ! is_single() ) :
	
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="cl-entry__video">';
						echo codeless_complex_esc( 
								str_replace( 
									array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"' ), 
									'', 
									$video_html 
								) 
							);
					echo '</div>';
				}
			endif;
		endif;
		
	?>
</div>