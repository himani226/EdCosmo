!function($) {
    $('.vc_image_select__button').on( 'click', function(e){
        e.preventDefault();
        var $wrapper = $(this).parent();
        $wrapper.find( 'a' ).removeClass('selected');
        $(this).addClass('selected');

        $wrapper.parent().find( 'input' ).val( $(this).data('value') );
    });
  }(window.jQuery);