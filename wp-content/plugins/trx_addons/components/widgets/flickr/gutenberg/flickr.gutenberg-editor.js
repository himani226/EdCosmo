(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Flickr photos
	blocks.registerBlockType(
		'trx-addons/flickr', {
			title: i18n.__( 'Flickr photos' ),
			description: i18n.__( "Display the latest photos from Flickr account" ),
			icon: 'format-gallery',
			category: 'trx-addons-widgets',
			attributes: {				
				title: {
					type: 'string',
					default: i18n.__( 'Flickr photos' )
				},
				flickr_api_key: {
					type: 'string',
					default: ''
				},
				flickr_username: {
					type: 'string',
					default: ''
				},
				flickr_count: {
					type: 'number',
					default: 8
				},
				flickr_columns: {
					type: 'number',
					default: 4
				},
				// ID, Class, CSS attributes
				id: {
					type: 'string',
					default: ''
				},
				class: {
					type: 'string',
					default: ''
				},
				css: {
					type: 'string',
					default: ''
				},
			},
			edit: function(props) {
				return trx_addons_gutenberg_block_params(
					{
						'render': true,
						'general_params': el(
							'div', {},
							// Widget title
							trx_addons_gutenberg_add_param(
								{
									'name': 'title',
									'title': i18n.__( 'Widget title' ),
									'descr': i18n.__( "Title of the widget" ),
									'type': 'text',
								}, props
							),
							// Flickr API key
							trx_addons_gutenberg_add_param(
								{
									'name': 'flickr_api_key',
									'title': i18n.__( 'Flickr API key' ),
									'descr': i18n.__( "Specify API key from your Flickr application" ),
									'type': 'text',
								}, props
							),
							// Flickr username
							trx_addons_gutenberg_add_param(
								{
									'name': 'flickr_username',
									'title': i18n.__( 'Flickr username' ),
									'descr': i18n.__( "Your Flickr username" ),
									'type': 'text',
								}, props
							),
							// Number of photos
							trx_addons_gutenberg_add_param(
								{
									'name': 'flickr_count',
									'title': i18n.__( 'Number of photos' ),
									'descr': i18n.__( "How many photos to be displayed?" ),
									'type': 'number',
									'min': 1
								}, props
							),
							// Columns
							trx_addons_gutenberg_add_param(
								{
									'name': 'flickr_columns',
									'title': i18n.__( 'Columns' ),
									'descr': i18n.__( "Columns number" ),
									'type': 'number',
									'min': 1
								}, props
							),
						),
						'additional_params': el(
							'div', {},
							// ID, Class, CSS params
							trx_addons_gutenberg_add_param_id( props )
						)
					}, props
				);
			},
			save: function(props) {
				return el( '', null );
			}
		}
	);
})( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element, );
