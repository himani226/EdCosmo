(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Blogger
	blocks.registerBlockType(
		'trx-addons/blogger', {
			title: i18n.__( 'Blogger' ),
			description: i18n.__( "Display posts from specified category in many styles" ),
			icon: 'welcome-widgets-menus',
			category: 'trx-addons-blocks',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				pagination: {
					type: 'string',
					default: 'none'
				},
				hide_excerpt: {
					type: 'boolean',
					default: false
				},
				no_links: {
					type: 'boolean',
					default: false
				},
				more_text: {
					type: 'string',
					default: i18n.__( 'Read more' )
				},
				post_type: {
					type: 'string',
					default: 'post'
				},
				taxonomy: {
					type: 'string',
					default: 'category'
				},
				cat: {
					type: 'string',
					default: ''
				},
				show_filters: {
					type: 'boolean',
					default: false
				},
				taxonomy_filters: {
					type: 'string',
					default: 'category'
				},
				ids_filters: {
					type: 'string',
					default: ''
				},
				show_all_filters: {
					type: 'boolean',
					default: true
				},
				all_btn_text_filters: {
					type: 'string',
					default: i18n.__( 'All' )
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
					default: i18n.__( 'Blogger' )
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
						'general_params': el(
							'div', {},
							// Layout
							trx_addons_gutenberg_add_param(
								{
									'name': 'type',
									'title': i18n.__( 'Layout' ),
									'descr': i18n.__( "Select shortcodes's layout" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['sc_blogger'] )
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
							// Hide excerpt
							trx_addons_gutenberg_add_param(
								{
									'name': 'hide_excerpt',
									'title': i18n.__( 'Hide excerpt' ),
									'descr': i18n.__( "Check if you want hide excerp" ),
									'type': 'boolean'
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
									'dependency': {
										'no_links': [true]
									}
								}, props
							),
							// Post type
							trx_addons_gutenberg_add_param(
								{
									'name': 'post_type',
									'title': i18n.__( 'Post type' ),
									'descr': i18n.__( "Select post type to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['posts_types'] )
								}, props
							),
							// Taxonomy
							trx_addons_gutenberg_add_param(
								{
									'name': 'taxonomy',
									'title': i18n.__( 'Taxonomy' ),
									'descr': i18n.__( "Select taxonomy to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type], true )
								}, props
							),
							// Category
							trx_addons_gutenberg_add_param(
								{
									'name': 'cat',
									'title': i18n.__( 'Category' ),
									'descr': i18n.__( "Select category to show posts" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['categories'][props.attributes.taxonomy], true )
								}, props
							),
							// Show filters
							trx_addons_gutenberg_add_param(
								{
									'name': 'show_filters',
									'title': i18n.__( 'Show filters' ),
									'descr': i18n.__( "Check if you want show filters" ),
									'type': 'boolean'
								}, props
							),
							// Filters taxonomy
							trx_addons_gutenberg_add_param(
								{
									'name': 'taxonomy_filters',
									'title': i18n.__( 'Filters taxonomy' ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['taxonomies'][props.attributes.post_type], true ),
									'dependency': {
										'show_filters': [true]
									}
								}, props
							),
							// Filters taxonomy to show
							trx_addons_gutenberg_add_param(
								{
									'name': 'ids_filters',
									'title': i18n.__( 'Filters taxonomy to show' ),
									'descr': i18n.__( "Comma separated IDs list to show. IDs have to belong to the selected taxonomy." ),
									'type': 'text',
									'dependency': {
										'show_filters': [true]
									}
								}, props
							),
							// Display the "All Filters" tab
							trx_addons_gutenberg_add_param(
								{
									'name': 'show_all_filters',
									'title': i18n.__( 'Display the "All Filters" tab' ),
									'descr': i18n.__( "todo add text" ),
									'type': 'boolean',
									'dependency': {
										'show_filters': [true]
									}
								}, props
							),
							// "All Filters" tab text
							trx_addons_gutenberg_add_param(
								{
									'name': 'all_btn_text_filters',
									'title': i18n.__( '"All Filters" tab text' ),
									'type': 'text',
									'dependency': {
										'show_filters': [true]
									}
								}, props
							)
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
			},
		}
	);
})( window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element, );