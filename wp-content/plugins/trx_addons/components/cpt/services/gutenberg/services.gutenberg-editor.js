(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Services
	blocks.registerBlockType(
		'trx-addons/services', {
			title: i18n.__( 'Services' ),
			icon: 'hammer',
			category: 'trx-addons-cpt',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				tabs_effect: {
					type: 'string',
					default: 'fade'
				},
				featured: {
					type: 'string',
					default: 'image'
				},
				featured_position: {
					type: 'string',
					default: 'top'
				},
				no_links: {
					type: 'boolean',
					default: false
				},
				more_text: {
					type: 'string',
					default: i18n.__( 'Read more' ),
				},
				pagination: {
					type: 'string',
					default: 'none'
				},
				hide_excerpt: {
					type: 'boolean',
					default: false
				},
				no_margin: {
					type: 'boolean',
					default: false
				},
				icons_animation: {
					type: 'boolean',
					default: false
				},
				hide_bg_image: {
					type: 'boolean',
					default: false
				},
				popup: {
					type: 'boolean',
					default: false
				},
				post_type: {
					type: 'string',
					default: TRX_ADDONS_STORAGE['gutenberg_sc_params']['CPT_SERVICES_PT']
				},
				taxonomy: {
					type: 'string',
					default: TRX_ADDONS_STORAGE['gutenberg_sc_params']['CPT_SERVICES_TAXONOMY']
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
					default: i18n.__( 'Services' )
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
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_services'] )
								}, props
							),
							// Tabs change effect
							trx_addons_gutenberg_add_param(
								{
									'name': 'tabs_effect',
									'title': i18n.__( 'Tabs change effect' ),
									'descr': i18n.__( "Select the tabs change effect" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_tabs_effects'] ),
									'dependency': {
										'type': ['tabs']
									}
								}, props
							),
							// Featured
							trx_addons_gutenberg_add_param(
								{
									'name': 'featured',
									'title': i18n.__( 'Featured' ),
									'descr': i18n.__( "What to use as featured element?" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_featured'] ),
									'dependency': {
										'type': ['default', 'callouts', 'hover', 'light', 'list', 'iconed', 'tabs', 'tabs_simple', 'timeline']
									}
								}, props
							),
							// Featured position
							trx_addons_gutenberg_add_param(
								{
									'name': 'featured_position',
									'title': i18n.__( 'Featured position' ),
									'descr': i18n.__( "Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_services_featured_positions'] ),
									'dependency': {
										'featured': ['image', 'icon', 'number', 'pictogram']
									}
								}, props
							),
							// Disable links
							trx_addons_gutenberg_add_param(
								{
									'name': 'no_links',
									'title': i18n.__( 'Disable links' ),
									'descr': i18n.__( "Check if you want disable links to the single posts" ),
									'type': 'boolean'
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
							// Excerpt
							trx_addons_gutenberg_add_param(
								{
									'name': 'hide_excerpt',
									'title': i18n.__( "Hide excerpt" ),
									'descr': i18n.__( "Check if you want hide excerpt" ),
									'type': 'boolean',
								}, props
							),
							// Remove margin
							trx_addons_gutenberg_add_param(
								{
									'name': 'no_margin',
									'title': i18n.__( "Remove margin" ),
									'descr': i18n.__( "Check if you want remove spaces between columns" ),
									'type': 'boolean',
								}, props
							),
							// Animation
							trx_addons_gutenberg_add_param(
								{
									'name': 'icons_animation',
									'title': i18n.__( "Animation icons" ),
									'descr': i18n.__( "Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon" ),
									'type': 'boolean',
								}, props
							),
							// Hide bg image
							trx_addons_gutenberg_add_param(
								{
									'name': 'hide_bg_image',
									'title': i18n.__( "Hide bg image" ),
									'descr': i18n.__( "Check if you want hide background image on the front item" ),
									'type': 'boolean',
									'dependency': {
										'type': ['hover']
									}
								}, props
							),
							// Open in the popup
							trx_addons_gutenberg_add_param(
								{
									'name': 'popup',
									'title': i18n.__( "Open in the popup" ),
									'descr': i18n.__( "Open details in the popup or navigate to the single post (default)" ),
									'type': 'boolean',
								}, props
							),
							// Post type
							trx_addons_gutenberg_add_param(
								{
									'name': 'post_type',
									'title': i18n.__( "Post type" ),
									'descr': i18n.__( "elect post type to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['posts_types'] )
								}, props
							),
							// Taxonomy
							trx_addons_gutenberg_add_param(
								{
									'name': 'taxonomy',
									'title': i18n.__( "Taxonomy" ),
									'descr': i18n.__( "Select taxonomy to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type], true  )
								}, props
							),
							// Category
							trx_addons_gutenberg_add_param(
								{
									'name': 'cat',
									'title': i18n.__( 'Category' ),
									'descr': i18n.__( "Services group" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['categories'][props.attributes.taxonomy], true )
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
