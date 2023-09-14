(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Socials
	blocks.registerBlockType(
		'trx-addons/widget-socials', {
			title: i18n.__( 'Socials' ),
			description: i18n.__( "Socials - show links to the profiles in your favorites social networks" ),
			icon: 'facebook-alt',
			category: 'trx-addons-widgets',
			attributes: {
				title: {
					type: 'string',
					default: ''
				},
				description: {
					type: 'string',
					default: ''
				},
				align: {
					type: 'string',
					default: ''
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
							// Description
							trx_addons_gutenberg_add_param(
								{
									'name': 'description',
									'title': i18n.__( 'Description' ),
									'descr': i18n.__( "Short description about user" ),
									'type': 'textarea',
								}, props
							),
							// Align
							trx_addons_gutenberg_add_param(
								{
									'name': 'align',
									'title': i18n.__( 'Align' ),
									'descr': i18n.__( "Select alignment of this item" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_aligns'] )
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
