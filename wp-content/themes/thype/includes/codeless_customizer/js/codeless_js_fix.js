( function( $ ) {
    wp.customize.control.bind('add', function(control){

        if( typeof control.params.required !== 'undefined' && control.params.required.length > 0 )
            control.container.addClass('is_required');
         
    });
	
}) (jQuery);