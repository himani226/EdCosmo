


  	 <?php $header_cssbox = (is_array(codeless_get_mod('header_design', array( 'border-bottom-width' => '1px' ))) ? codeless_get_mod('header_design', array( 'border-bottom-width' => '1px' )) : json_decode(codeless_get_mod('header_design'), true)); ?>
	 
	 .cl-header__row--main{
	 	<?php if(is_array($header_cssbox)) foreach($header_cssbox as $css => $value){
	 		if($value != '')
	 			echo esc_html( $css ).': '.$value.";\n";
	 	} ?>
	 }

	<?php 
		$wrap_layout_margin = 0;
		if( codeless_get_layout_option( 'wrapper_content', false ) )
	 		$wrap_layout_margin = 100;
	?>

	@media (min-width:992px){
		body.cl-header-transparent .cl-page-header__content,
		body.cl-header-transparent .cl-post-header__content {
			padding-top: <?php echo esc_attr( (int) codeless_get_mod( 'header_height' ) + (int) ( codeless_get_mod( 'header_extra', false ) ? codeless_get_mod( 'header_height_extra' ) : 0 ) + (int) ( codeless_get_mod( 'header_top_nav', false ) ? codeless_get_mod( 'header_height_top' ) : 0 ) ); ?>px;
		}

		<?php if( codeless_get_mod( 'header_main_bg_image', '' ) != '' ): ?>
			.cl-header__row--main{
				background-image: url( '<?php echo esc_url( codeless_get_mod( 'header_main_bg_image', '' ) ) ?>' );
				background-position:center;
				background-size:cover;
				position:relative;
			}
			.cl-header__row--main:before{
				content:"";
				position:absolute;
				left:0;
				top:0;
				width:100%;
				height:100%;
			}
		<?php endif; ?>
	}

	@media (min-width:992px){
		body.cl-layout-wrapper .cl-page-header__content,
		body.cl-layout-wrapper .cl-post-header__content{
			padding-bottom: <?php echo esc_attr( $wrap_layout_margin ) ?>px;
		}
	}


	 <?php $header_cssbox_top = (is_array(codeless_get_mod('header_design_top')) ? codeless_get_mod('header_design_top') : json_decode(codeless_get_mod('header_design_top'), true)); ?>
	 
	 .cl-header__row--top{
	 	<?php if(is_array($header_cssbox_top)) foreach($header_cssbox_top as $css => $value){
	 		if($value != '')
	 			echo esc_html( $css ).': '.$value.";\n";
	 	} ?>
	 }


	 <?php $header_cssbox_extra = (is_array(codeless_get_mod('header_design_extra')) ? codeless_get_mod('header_design_extra') : json_decode(codeless_get_mod('header_design_extra'), true)); ?>
	 
	 .cl-header__row--extra{
	 	<?php if(is_array($header_cssbox_extra)) foreach($header_cssbox_extra as $css => $value){
	 		if($value != '')
	 			echo esc_html( $css ).': '.$value.";\n";
	 	} ?>
	 }

	 <?php $footer_design = (is_array(codeless_get_mod('footer_design')) ? codeless_get_mod('footer_design') : json_decode(codeless_get_mod('footer_design'), true)); ?>
	 
	 footer#colophon .cl-footer__main{
	 	<?php if(is_array($footer_design)) foreach($footer_design as $css => $value){
	 		if($value != '')
	 			echo esc_html( $css ).': '.$value.";\n";
	 	} ?>
	 }

	 
	 
	<?php if(codeless_get_mod('header_layout', 'top') == 'left' || codeless_get_mod('header_layout', 'top') == 'right'): ?>
	@media (min-width:992px){
		.cl-header{
		 	width:<?php echo codeless_get_mod('header_width') ?>px;
		}
			<?php if( ! codeless_is_header_boxed() ): ?>

			
				#viewport{
			 	
			 		padding-<?php echo codeless_get_mod('header_layout', 'top') ?>: <?php echo (int)codeless_get_mod('header_width') . 'px'; ?>
		
				}
			
			<?php endif; ?>
	}
	<?php endif; ?>

	
	<?php if( codeless_get_mod( 'header_extra_inner_top_border', false ) ): ?>

	.cl-header__row--extra .cl-header__container{
		border-top:1px solid;
	}

	<?php endif; ?>

	<?php if( $bg = codeless_get_meta( 'page_background_color', codeless_get_mod( 'background_color' ), get_the_ID() ) ): ?>
	body:not(.cl-layout-boxed), body.cl-layout-boxed #wrapper.cl-boxed-layout{ background-color: <?php echo esc_attr( $bg ) ?> !important }
	<?php endif; ?>

	<?php if( codeless_get_mod( 'boxed_bg_image', false ) ): ?>
	body.cl-layout-boxed{ background-image: url('<?php echo esc_url( codeless_get_mod( 'boxed_bg_image', false ) ) ?> ') !important }
	<?php endif; ?>

	.cl-slider--modern .cl-entry__wrapper, .cl-slider--modern .cl-owl-nav{
		width:<?php echo esc_attr(codeless_get_mod( 'layout_container_width', 1100 ) ); ?>px;
	}
  

	input:not([type="submit"])::-webkit-input-placeholder, 
	select::-webkit-input-placeholder, 
	textarea::-webkit-input-placeholder{
		color:<?php echo esc_attr( codeless_get_mod( 'forms_placeholder_color', '#a7acb6' ) ) ?>
	} 
	
	input:not([type="submit"]):-moz-placeholder, 
	select:-moz-placeholder, 
	textarea:-moz-placeholder{
		color:<?php echo esc_attr( codeless_get_mod( 'forms_placeholder_color', '#a7acb6' ) ) ?>
	}

	input:not([type="submit"]):-ms-input-placeholder, 
	select:-ms-input-placeholder, 
	textarea:-ms-input-placeholder{
		color:<?php echo esc_attr( codeless_get_mod( 'forms_placeholder_color', '#a7acb6' ) ) ?>
	}

	<?php $logo_font = codeless_get_mod( 'logo_font' ); if( isset( $logo_font['font-size'] ) && (int) str_replace('px', '', $logo_font['font-size'] ) >= 64 ): ?>
	@media (max-width:767px){
		.cl-logo__font{
			font-size:36px !important;
		}
		
	}
	<?php endif; ?>

	<?php 
	
	$vc_row_padding_top = (int) str_replace('px', '', codeless_get_mod( 'vc_row_padding_top', '30px' ) );
	$vc_row_padding_bottom = (int) str_replace('px', '', codeless_get_mod( 'vc_row_padding_top', '30px' ) );

	?>
	.vc_row[data-vc-full-width="true"]{
		margin-top:<?php echo esc_attr( $vc_row_padding_top ) ?>px;
		margin-bottom:<?php echo esc_attr( $vc_row_padding_bottom ) ?>px;
	}

	.vc_row-full-width.vc_clearfix + .vc_row[data-vc-full-width="true"]{
		margin-top:-<?php echo esc_attr( $vc_row_padding_top ) ?>px;
	}

	.vc_row[data-vc-full-width="true"]{
		padding-top:<?php echo esc_attr( $vc_row_padding_top + $vc_row_padding_bottom ) ?>px;
	}

	.vc_row[data-vc-full-width="true"]{
		padding-bottom:<?php echo esc_attr( $vc_row_padding_top + $vc_row_padding_bottom ) ?>px;
	}

	@media (max-width:767px){
		.wpb_column > .vc_column-inner{
			padding-top:calc( <?php echo esc_attr( $vc_row_padding_top ) ?>px );
			padding-bottom:calc( <?php echo esc_attr( $vc_row_padding_top ) ?>px );
		}
	}


	.vc_col-has-fill>.vc_column-inner, 
	.vc_row-has-fill+.vc_row-full-width+.vc_row>.vc_column_container>.vc_column-inner, 
	.vc_row-has-fill+.vc_row>.vc_column_container>.vc_column-inner, 
	.vc_row-has-fill>.vc_column_container>.vc_column-inner{
		padding-top:0 ;
	}
	
<?php  echo codeless_get_mod('custom_css'); ?>

	