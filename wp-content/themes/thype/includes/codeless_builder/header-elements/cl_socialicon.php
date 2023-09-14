<?php

extract($element['params']); 

$id = 'cl_socialicon_header_' . uniqid();
?>

<style type="text/css">
	#<?php echo esc_attr( $id ) ?> .cl_socialicon:hover{
		<?php if( ! empty( $bgcolor_hover ) ): ?>
		background-color:<?php echo wp_kses_post($bgcolor_hover) ?> !important;
		<?php endif; ?>

		<?php if( ! empty( $bcolor_hover ) ): ?>
		border-color: <?php echo wp_kses_post($bcolor_hover) ?> !important;
		<?php endif; ?>
	}
	#<?php echo esc_attr( $id ) ?> .cl_socialicon:hover a{
		<?php if( ! empty( $color_hover ) ): ?>
		color: <?php echo wp_kses_post($color_hover) ?> !important;
		<?php endif; ?>
	}
</style>

<div id="<?php echo esc_attr($id) ?>" class="cl_socialicondiv <?php echo esc_attr( $this->generateClasses('.cl_socialicondiv') ) ?>" <?php $this->generateStyle( '.cl_socialicondiv', true ); ?>">

	<?php $social_list = array(
		'facebook',
		'instagram',
		'twitter',
		'email',
		'linkedin',
		'pinterest',
		'youtube',
		'vimeo',
		'soundcloud',
		'slack',
		'skype',
		'google_plus',
		'github',
		'dribbble',
		'behance'
	); ?>

	<?php foreach( $social_list as $social ): ?>

		<?php if( ${"add_$social"} ){ ?>
			<div class="cl_socialicon cl-element <?php echo esc_attr( $this->generateClasses('.cl_socialicon') ) ?>" <?php $this->generateStyle( '.cl_socialicon', true );?>>
				<?php $social_link_ = $social . "_link"; ?>
				<a href="<?php echo esc_url(${$social_link_}) ?>" target="<?php echo esc_attr($target) ?>" <?php $this->generateStyle('.cl_socialicon > a', true);?>>
					<i class="cl-icon-<?php echo esc_attr( $social ) ?>" <?php $this->generateStyle('.cl_socialicon i', true); ?> ></i>
				</a>
			</div> 
		<?php } ?>

	<?php endforeach; ?>

</div>