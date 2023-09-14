<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.14
 */
$yolox_header_video = yolox_get_header_video();
$yolox_embed_video  = '';
if ( ! empty( $yolox_header_video ) && ! yolox_is_from_uploads( $yolox_header_video ) ) {
	if ( yolox_is_youtube_url( $yolox_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $yolox_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		global $wp_embed;
		if ( false && is_object( $wp_embed ) ) {
			$yolox_embed_video = do_shortcode( $wp_embed->run_shortcode( '[embed]' . trim( $yolox_header_video ) . '[/embed]' ) );
			$yolox_embed_video = yolox_make_video_autoplay( $yolox_embed_video );
		} else {
			$yolox_header_video = str_replace( '/watch?v=', '/embed/', $yolox_header_video );
			$yolox_header_video = yolox_add_to_url(
				$yolox_header_video, array(
					'feature'        => 'oembed',
					'controls'       => 0,
					'autoplay'       => 1,
					'showinfo'       => 0,
					'modestbranding' => 1,
					'wmode'          => 'transparent',
					'enablejsapi'    => 1,
					'origin'         => home_url(),
					'widgetid'       => 1,
				)
			);
			$yolox_embed_video  = '<iframe src="' . esc_url( $yolox_header_video ) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?>
		<div id="background_video"><?php yolox_show_layout( $yolox_embed_video ); ?></div>
		<?php
	}
}
