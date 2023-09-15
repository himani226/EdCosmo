<?php

$sh_FooterWidgets = get_theme_mod( 'baxel_show_footer_widgets', 1 );
$sh_FooterBTT = get_theme_mod( 'baxel_show_to_top', 1 );
$sh_FooterSocial = get_theme_mod( 'baxel_show_footer_social', 1 );
$copyrightText = get_theme_mod( 'baxel_copyright_text', '2019 Baxel. All rights reserved.' );
$instagramShortcode = get_theme_mod( 'baxel_instagram_shortcode', '' );

?>

	<?php if ( $sh_FooterWidgets || $sh_FooterBTT || $sh_FooterSocial || $instagramShortcode || $copyrightText ) { ?>
    <div id="footer-box-outer" class="footer-box-outer">
        <footer class="clearfix">

        	<?php /* Instagram Slider Widget */
			if ( $instagramShortcode && get_theme_mod( 'baxel_instagram_position_top', 0 ) ) {

				echo '<div class="instagram-label">' . esc_attr( get_theme_mod( 'baxel_instagram_label', 'INSTAGRAM FEED' ) ) . '</div>';
				echo do_shortcode( $instagramShortcode );

			}
			/* */ ?>

			<?php if ( is_active_sidebar( 'baxel_footer_widgets' ) && $sh_FooterWidgets ) {

                ob_start( 'baxel_compress' ); ?>

                <div class="footer-box-inner clearfix">
                    <div class="footer-widget-area">
                        <div class="footer-widget-area-inner<?php if ( get_theme_mod( 'baxel_footer_widgets_column', '3col' ) == '2col' ) { echo '-col2'; } else if ( get_theme_mod( 'baxel_footer_widgets_column', '3col' ) == '4col' ) { echo '-col4'; } ?> clearfix"><?php dynamic_sidebar( 'baxel_footer_widgets' ); ?></div>
                    </div>
                </div>

            <?php ob_end_flush(); } ?>

            <?php
            global $baxel_social_show;
			if ( $copyrightText && ( !get_theme_mod( 'baxel_show_footer_social', 1 ) || !$baxel_social_show ) ) { $sh_FooterBTT = 0; }
			?>

            <?php if ( $sh_FooterWidgets || $sh_FooterBTT || $sh_FooterSocial || $copyrightText ) { ?>
            <div class="footer-bottom-outer<?php if ( !is_active_sidebar( 'baxel_footer_widgets' ) || !$sh_FooterWidgets ) { echo ' fbo-wo-w'; } ?>">
                <div class="footer-bottom clearfix">
                	<div class="footer-text"><?php echo wp_kses_post( $copyrightText ); ?></div><div class="footer-btt-outer"><?php if ( $sh_FooterBTT ) { ?><a href="javascript:void(0);" class="btn-to-top"><?php echo esc_attr( baxel_translation( '_BackToTop' ) ); ?><i class="fa fa-caret-up"></i></a><?php } ?></div><?php echo baxel_insert_social_icons( 'footer-social' ); ?>
                </div>
            </div>
            <?php } ?>

            <?php /* Instagram Slider Widget */
			if ( $instagramShortcode && !get_theme_mod( 'baxel_instagram_position_top', 0 ) ) {

				echo '<div class="instagram-label">' . esc_attr( get_theme_mod( 'baxel_instagram_label', 'INSTAGRAM FEED' ) ) . '</div>';
				echo do_shortcode( $instagramShortcode );

			}
			/* */ ?>

        </footer>
    </div>
    <?php } ?>

		<div class="hiddenInfo">
			<span id="mapInfo_Zoom"><?php echo esc_attr( get_theme_mod( 'baxel_map_zoom', 15 ) ); ?></span>
			<span id="mapInfo_coorN"><?php echo esc_attr( get_theme_mod( 'baxel_map_coordinate_n', 49.0138 ) ); ?></span>
			<span id="mapInfo_coorE"><?php echo esc_attr( get_theme_mod( 'baxel_map_coordinate_e', 8.38624 ) ); ?></span>
			<span id="owl_nav"><?php echo esc_attr( get_theme_mod( 'baxel_slider_nav', 1 ) ); ?></span>
			<span id="owl_autoplay"><?php echo esc_attr( get_theme_mod( 'baxel_slider_autoplay', 0 ) ); ?></span>
			<span id="owl_duration"><?php echo esc_attr( get_theme_mod( 'baxel_slider_duration', 4000 ) ); ?></span>
			<span id="owl_infinite"><?php echo esc_attr( get_theme_mod( 'baxel_slider_infinite', 1 ) ); ?></span>
			<span id="siteUrl"><?php echo esc_attr( get_home_url() ); ?></span>
			<span id="trigger-sticky-value"><?php echo esc_attr( get_theme_mod( 'baxel_trigger_sticky_menu', 300 ) ); ?></span>
			<span id="menu-logo-l-r"><?php if ( $baxel_opt_LogoPos == 'lefted' && $baxel_opt_MenuPos == 'mright' ) { echo 'true'; } ?></span>
			<span id="slicknav_apl"><?php echo esc_attr( get_theme_mod( 'baxel_slicknav_apl', 0 ) ); ?></span>
		</div>
		
<?php wp_footer(); ?>
</body>
</html>
