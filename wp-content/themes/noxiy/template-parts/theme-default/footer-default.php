<?php
$copyright = noxiy_option('footer_copyright');
$noxiy_htmls = array(
    'a' => array(
        'href'   => array(),
        'target' => array(),
    ),
    'strong' => array(),
    'small'  => array(),
    'span'   => array(),
    'p'      => array(),
);
?>
<!-- Footer Copyright -->
<div class="theme-default-copyright">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<?php echo wp_kses($copyright, $noxiy_htmls); ?>
			</div>
		</div>
	</div>
</div>
<!-- Footer Copyright -->