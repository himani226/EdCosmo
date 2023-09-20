( function( $ ) {
  	var CL_POSTMESSAGE = window.CL_POSTMESSAGE || {};
	window.CL_POSTMESSAGE = CL_POSTMESSAGE;

	var api;

	if( parent == null )
		api = wp.customize;
	else
		api = parent.wp.customize;


	api.section.bind( 'add', addSectionControls );
    api.section.each( addSectionControls );


    function addSectionControls( section ) {
    	if( _.isUndefined(api.Posts) )
    		return;

        if ( section.extended( api.Posts.PostSection ) ) {
            section.contentsEmbedded.done( function addBind() {
                checkChanges( section );
            } );
        }
    }

	function checkChanges( section ){
	
		_.each(cl_post_meta.metadata, function(meta, index){

            customizeId = 'postmeta[' + section.params.post_type + '][' + section.params.post_id + '][' + meta.meta_key + ']';
		          
		    wp.customize( customizeId, function(value){
		        value.bind( function(to){
		              if(!_.isUndefined(CL_POSTMESSAGE['meta_'+meta.feature]))
		                CL_POSTMESSAGE['meta_'+meta.feature](to, value, section.params.post_type, section.params.post_id);
		        });
		    });

		});

		_.each(section.postFieldControls, function(value, meta){
			customizeId = value.id;

		    value.setting.bind( function(to){
		        if(!_.isUndefined(CL_POSTMESSAGE['meta_'+meta]))
		            CL_POSTMESSAGE['meta_'+meta](to, value, section.params.post_type, section.params.post_id);
		    });

		});


	}


} )( jQuery );