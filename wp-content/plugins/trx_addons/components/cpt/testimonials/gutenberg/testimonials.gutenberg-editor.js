(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Testimonials
	blocks.registerBlockType(
		'trx-addons/testimonials', {
			title: i18n.__( 'Testimonials' ),
			icon: 'format-status',
			category: 'trx-addons-cpt',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				use_initials: {
					type: 'boolean',
					default: false
				},
				cat: {
					type: 'string',
					default: '0'
				},
				slider_pagination_thumbs: {
					type: 'boolean',
					default: false
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
					default: i18n.__( 'Testimonials' )
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
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_testimonials'] )
								}, props
							),
							// Use initials
							trx_addons_gutenberg_add_param(
								{
									'name': 'use_initials',
									'title': i18n.__( "Use initials" ),
									'descr': i18n.__( "If no avatar is present, the initials derived from the available username will be used." ),
									'type': 'boolean',
								}, props
							),	
							// Group
							trx_addons_gutenberg_add_param(
								{
									'name': 'cat',
									'title': i18n.__( "Group" ),
									'descr': i18n.__( "Courses group" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_testimonials_cat'] )
								}, props
							),	
							// Slider pagination
							trx_addons_gutenberg_add_param(
								{
									'name': 'slider_pagination_thumbs',
									'title': i18n.__( "Slider pagination" ),
									'descr': i18n.__( "Show thumbs as pagination bullets" ),
									'type': 'boolean',
									'dependency': {
										'slider_pagination': ['left', 'right', 'bottom']
									}
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
