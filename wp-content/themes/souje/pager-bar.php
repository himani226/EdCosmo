<?php
$defaults_wplp = array(
	'before' => '<div class="category-bar pager-only">' . esc_attr( souje_translation( '_Page' ) ) . ' &nbsp;&nbsp; ',
	'after' => '</div>',
	'separator' => ' &nbsp;/&nbsp; '
);        
wp_link_pages( $defaults_wplp );
?>