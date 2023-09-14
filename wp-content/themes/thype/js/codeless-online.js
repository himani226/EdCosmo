(function($) {
	"use strict"; 

	$(document).ready(function(){

		$('.cl-panel .cl-panel-button.settings').on( 'click', function(){

			var $panel = $( this ).parents( '.cl-panel' ).first();
			if( $panel.hasClass( 'open_settings' ) ){
				$panel.removeClass( 'open_settings' );
				setTimeout(function(){
					$panel.find('.cl-panel-container').css('display', 'none');
				}, 600);
				
			}else{
				$panel.addClass( 'open_settings' );
				$panel.find('.cl-panel-container').css('display', 'block');
			}

		});

	});

})(jQuery);