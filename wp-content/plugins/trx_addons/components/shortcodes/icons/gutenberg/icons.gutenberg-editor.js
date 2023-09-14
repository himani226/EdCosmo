(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Icons
	blocks.registerBlockType(
		'trx-addons/icons', {
			title: i18n.__( 'Icons' ),
			description: i18n.__( "Insert icons or images with title and description" ),
			icon: 'carrot',
			category: 'trx-addons-blocks',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				align: {
					type: 'string',
					default: 'center'
				},
				size: {
					type: 'string',
					default: 'medium'
				},
				color: {
					type: 'string',
					default: ''
				},
				columns: {
					type: 'number',
					default: 1
				},
				icons_animation: {
					type: 'boolean',
					default: false
				},
				icons: {
					type: 'string',
					default: ''
				},
				// Title attributes
				title_style: {
					type: 'string',
					default: ''
				},
				title_tag: {
					type: 'string',
					default: ''
				},
				title_align: {
					type: 'string',
					default: ''
				},
				title_color: {
					type: 'string',
					default: ''
				},
				title_color2: {
					type: 'string',
					default: ''
				},
				gradient_direction: {
					type: 'number',
					default: 0
				},
				title: {
					type: 'string',
					default: i18n.__( 'Icons' )
				},
				subtitle: {
					type: 'string',
					default: ''
				},
				description: {
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
				// Reload block - hidden option
				reload: {
					type: 'string'
				},
			},
			edit: function(props) {
				return trx_addons_gutenberg_block_params(
					{
						'render': true,
						'render_button': true,
						'parent': true,
						'general_params': el(
							'div', {},
							// Layout
							trx_addons_gutenberg_add_param(
								{
									'name': 'type',
									'title': i18n.__( 'Layout' ),
									'descr': i18n.__( "Select shortcodes's layout" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['sc_icons'] )
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
							// Icon size
							trx_addons_gutenberg_add_param(
								{
									'name': 'size',
									'title': i18n.__( 'Icon size' ),
									'descr': i18n.__( "Select icon's size" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_icon_sizes'] )
								}, props
							),
							// Color
							trx_addons_gutenberg_add_param(
								{
									'name': 'color',
									'title': i18n.__( 'Color' ),
									'descr': i18n.__( "Select custom color for each icon" ),
									'type': 'color',
								}, props
							),
							// Columns
							trx_addons_gutenberg_add_param(
								{
									'name': 'columns',
									'title': i18n.__( 'Columns' ),
									'descr': i18n.__( "Specify number of columns for icons. If empty - auto detect by items number" ),
									'type': 'number',
									'min': 1,
									'max': 4
								}, props
							),
							// Animation
							trx_addons_gutenberg_add_param(
								{
									'name': 'icons_animation',
									'title': i18n.__( 'Animation' ),
									'descr': i18n.__( "Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon" ),
									'type': 'boolean'
								}, props
							)
						),
						'additional_params': el(
							'div', {},
							// Title params
							trx_addons_gutenberg_add_param_title( props, false ),
							// ID, Class, CSS params
							trx_addons_gutenberg_add_param_id( props )
						)
					}, props
				);
			},
			save: function(props) {
				// Get child block values of attributes
				props.attributes.icons = trx_addons_gutenberg_get_child_attr( props );
				return el( wp.editor.InnerBlocks.Content, {} );
			},
		}
	);

	// Register block Icons Item
	blocks.registerBlockType(
		'trx-addons/icons-item', {
			title: i18n.__( 'Icons Item' ),
			description: i18n.__( "elect icons, specify title and/or description for each item" ),
			icon: 'carrot',
			category: 'trx-addons-blocks',
			parent: ['trx-addons/icons'],
			attributes: {
				title: {
					type: 'string',
					default: i18n.__( 'One' )
				},
				link: {
					type: 'string',
					default: ''
				},
				description: {
					type: 'string',
					default: ''
				},
				color: {
					type: 'string',
					default: ''
				},
				char: {
					type: 'string',
					default: ''
				},
				image: {
					type: 'number',
					default: 0
				},
				image_url: {
					type: 'string',
					default: ''
				},
				icon: {
					type: 'string',
					default: ''
				},
			},
			edit: function(props) {
				return trx_addons_gutenberg_block_params(
					{
						'title': i18n.__( 'Icons item' ) + (props.attributes.title ? ': ' + props.attributes.title : ''),
						'general_params': el(
							'div', {},
							// Title
							trx_addons_gutenberg_add_param(
								{
									'name': 'title',
									'title': i18n.__( 'Title' ),
									'descr': i18n.__( "Enter title of the item" ),
									'type': 'text'
								}, props
							),
							// Link
							trx_addons_gutenberg_add_param(
								{
									'name': 'link',
									'title': i18n.__( 'Link' ),
									'descr': i18n.__( "URL to link this block" ),
									'type': 'text'
								}, props
							),
							// Description
							trx_addons_gutenberg_add_param(
								{
									'name': 'description',
									'title': i18n.__( 'Description' ),
									'descr': i18n.__( "Enter short description for this item" ),
									'type': 'textarea'
								}, props
							),
							// Color
							trx_addons_gutenberg_add_param(
								{
									'name': 'color',
									'title': i18n.__( 'Color' ),
									'descr': i18n.__( "Select custom color of this item" ),
									'type': 'color'
								}, props
							),
							// Char
							trx_addons_gutenberg_add_param(
								{
									'name': 'char',
									'title': i18n.__( 'Character' ),
									'descr': i18n.__( "Single character instaed image or icon" ),
									'type': 'text'
								}, props
							),
							// Image
							trx_addons_gutenberg_add_param(
								{
									'name': 'image',
									'name_url': 'image_url',
									'title': i18n.__( 'Image' ),
									'descr': i18n.__( "Select or upload image or specify URL from other site to use it as icon" ),
									'type': 'image'
								}, props
							),
							trx_addons_gutenberg_add_param(
								{
									'name': 'icon',
									'title': i18n.__( 'Icon' ),
									'descr': i18n.__( "Select icon from library" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_option_icons_classes()
								}, props
							)
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
