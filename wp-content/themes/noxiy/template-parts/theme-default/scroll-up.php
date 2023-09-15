<?php
$noxiy_theme_scroll = noxiy_option('theme_scroll_up', false);
if ($noxiy_theme_scroll ==  'yes') {
	$scroll_up = 'd-black';
} else {
	$scroll_up = 'd-none';
} ?>


<!-- Scroll Btn Start -->
<div class="scroll-up <?php echo esc_attr($scroll_up); ?>">
	<svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
	</svg>
</div>
<!-- Scroll Btn End -->