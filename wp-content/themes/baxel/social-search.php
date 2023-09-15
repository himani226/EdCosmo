<div class="top-extra-outer">
    <div class="top-extra">    
        <div class="top-extra-inner clearfix">
            <?php if ( get_theme_mod( 'baxel_show_header_social', 1 ) ) { echo baxel_insert_social_icons( 'header-social' ); } ?>
            <?php if ( get_theme_mod( 'baxel_show_header_search', 1 ) ) { ?>
                <div class="top-search-button fading"><i class="fa fa-search"></i></div>
                <div class="top-search"><input class="top-search-input" type="text" value="<?php echo esc_attr( baxel_translation( '_Keyword' ) ); ?>" name="s" id="s_top" /></div>
			<?php } ?>
        </div>    
    </div>
</div>