(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Team
	blocks.registerBlockType(
		'trx-addons/team', {
			title: i18n.__( 'Team' ),
			icon: 'groups',
			category: 'trx-addons-cpt',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				pagination: {
					type: 'string',
					default: 'none'
				},
				no_links: {
					type: 'boolean',
					default: false
				},
				more_text: {
					type: 'string',
					default: i18n.__( 'Read more' ),
				},
				cat: {
					type: 'string',
					default: '0'
				},
				// Query attributes
				ids: {
					type: 'string',
					default: ''
				},
				count: {
					type: 'number',
					default: 2
				},
				columns: {
					type: 'number',
					default: 2
				},
				offset: {
					type: 'number',
					default: 0
				},
				orderby: {
					type: 'string',
					default: 'none'
				},
				order: {
					type: 'string',
					default: 'asc'
				},
				// Slider attributes
				slider: {
					type: 'boolean',
					default: false
				},
				slides_space: {
					type: 'number',
					default: 0
				},
				slides_centered: {
					type: 'boolean',
					default: false
				},
				slides_overflow: {
					type: 'boolean',
					default: false
				},
				slider_mouse_wheel: {
					type: 'boolean',
					default: false
				},
				slider_autoplay: {
					type: 'boolean',
					default: true
				},
				slider_controls: {
					type: 'string',
					default: 'none'
				},
				slider_pagination: {
					type: 'string',
					default: 'none'
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
					default: i18n.__( 'Team' )
				},
				subtitle: {
					type: 'string',
					default: ''
				},
				description: {
					type: 'string',
					default: ''
				},
				// Button attributes
				link: {
					type: 'string',
					default: ''
				},
				link_text: {
					type: 'string',
					default: ''
				},
				link_style: {
					type: 'string',
					default: ''
				},
				link_image: {
					type: 'number',
					default: 0
				},
				link_image_url: {
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
							// Layout
							trx_addons_gutenberg_add_param(
								{
									'name': 'type',
									'title': i18n.__( 'Layout' ),
									'descr': i18n.__( "Select shortcodes's layout" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_team'] )
								}, props
							),
							// Pagination
							trx_addons_gutenberg_add_param(
								{
									'name': 'pagination',
									'title': i18n.__( 'Pagination' ),
									'descr': i18n.__( "Add pagination links after posts. Attention! If using slider - pagination not allowed!" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_paginations'] )
								}, props
							),
							// Disable links
							trx_addons_gutenberg_add_param(
								{
									'name': 'no_links',
									'title': i18n.__( "Disable links" ),
									'descr': i18n.__( "Check if you want disable links to the single posts" ),
									'type': 'boolean',
								}, props
							),	
							// 'More' text
							trx_addons_gutenberg_add_param(
								{
									'name': 'more_text',
									'title': i18n.__( "'More' text" ),
									'descr': i18n.__( "Specify caption of the 'Read more' button. If empty - hide button" ),
									'type': 'text',
								}, props
							),
							// Group
							trx_addons_gutenberg_add_param(
								{
									'name': 'cat',
									'title': i18n.__( "Group" ),
									'descr': i18n.__( "Courses group" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_team_cat'] )
								}, props
							),				
						),
						'additional_params': el(
							'div', {},
							// Query params
							trx_addons_gutenberg_add_param_query( props ),
							// Title params
							trx_addons_gutenberg_add_param_title( props, true ),
							// Slider params
							trx_addons_gutenberg_add_param_slider( props ),
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
