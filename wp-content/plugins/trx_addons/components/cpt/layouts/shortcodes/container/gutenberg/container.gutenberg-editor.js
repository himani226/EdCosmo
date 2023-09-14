(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;
	// Register Block - Container
	blocks.registerBlockType(
		'trx-addons/layouts-container', {
			title: i18n.__( 'Container' ),
			description: i18n.__( 'Container for other shortcodes' ),
			icon: 'schedule',
			category: 'trx-addons-layouts',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				align: {
					type: 'string',
					default: ''
				},
				content: {
					type: 'string',
					default: ''
				},
				// Hide on devices attributes
				hide_on_wide: {
					type: 'boolean',
					default: false
				},
				hide_on_wide: {
					type: 'boolean',
					default: false
				},
				hide_on_notebook: {
					type: 'boolean',
					default: false
				},
				hide_on_tablet: {
					type: 'boolean',
					default: false
				},
				hide_on_mobile: {
					type: 'boolean',
					default: false
				},
				hide_on_frontpage: {
					type: 'boolean',
					default: false
				},
				hide_on_singular: {
					type: 'boolean',
					default: false
				},
				hide_on_other: {
					type: 'boolean',
					default: false
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
						'parent': true,
						'allowedblocks': TRX_ADDONS_STORAGE['gutenberg_allowed_blocks'],
						'general_params': el(
							'div', {},
							// Layout
							trx_addons_gutenberg_add_param(
								{
									'name': 'type',
									'title': i18n.__( 'Layout' ),
									'descr': i18n.__( "Select layout's type" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['sc_cart'] ),
								}, props
							),
							// Content alignment
							trx_addons_gutenberg_add_param(
								{
									'name': 'align',
									'title': i18n.__( 'Content alignment' ),
									'descr': i18n.__( "Select alignment of the inner content in this block" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists({
										'inherit': i18n.__( 'Inherit' ),
										'left': i18n.__( 'Left' ),
										'center': i18n.__( 'Center' ),
										'right': i18n.__( 'Right' ),
									})
								}, props
							),
						),
						'additional_params': el(
							'div', {},
							// Hide on devices params
							trx_addons_gutenberg_add_param_hide( props, true ),
							// ID, Class, CSS params
							trx_addons_gutenberg_add_param_id( props )
						)
					}, props
				);
			},
			save: function(props) {
				if(props.innerBlocks.length > 0) {
					var i     = 0;
					var items = {};
					while (i < props.innerBlocks.length) {
						var item         = props.innerBlocks[i];
						var item_name    = item.name;
						items[item_name] = item.attributes;
						i++;
					}
					props.attributes.content = JSON.stringify( items );
				}
				return el( wp.editor.InnerBlocks.Content, {} );
			}
		}
	);
})( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element, );
