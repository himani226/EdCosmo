(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Cars
	blocks.registerBlockType(
		'trx-addons/cars', {
			title: i18n.__( 'Cars' ),
			icon: 'format-aside',
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
				more_text: {
					type: 'string',
					default: i18n.__( 'Read more' ),
				},
				cars_type: {
					type: 'string',
					default: '0'
				},
				cars_maker: {
					type: 'string',
					default: '0'
				},
				cars_model: {
					type: 'string',
					default: '0'
				},
				cars_status: {
					type: 'string',
					default: '0'
				},
				cars_labels: {
					type: 'string',
					default: '0'
				},
				cars_city: {
					type: 'string',
					default: '0'
				},
				cars_transmission: {
					type: 'string',
					default: ''
				},
				cars_type_drive: {
					type: 'string',
					default: ''
				},
				cars_fuel: {
					type: 'string',
					default: ''
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
					default: i18n.__( 'Cars' )
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
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_cars'] )
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
							// 'More' text
							trx_addons_gutenberg_add_param(
								{
									'name': 'more_text',
									'title': i18n.__( "'More' text" ),
									'descr': i18n.__( "Specify caption of the 'Read more' button. If empty - hide button" ),
									'type': 'text',
								}, props
							),
							// Type
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_type',
									'title': i18n.__( 'Type' ),
									'descr': i18n.__( "Select the type to show cars that have it!" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_type'] )
								}, props
							),
							// Manufacturer
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_maker',
									'title': i18n.__( 'Manufacturer' ),
									'descr': i18n.__( "Select the car's manufacturer" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_maker'] )
								}, props
							),
							// Model
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_model',
									'title': i18n.__( 'Model' ),
									'descr': i18n.__( "Select the car's model" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_model'] )
								}, props
							),
							// Status
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_status',
									'title': i18n.__( 'Status' ),
									'descr': i18n.__( "Select the status to show cars that have it" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_status'] )
								}, props
							),
							// Label
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_labels',
									'title': i18n.__( 'Label' ),
									'descr': i18n.__( "Select the label to show cars that have it" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_labels'] )
								}, props
							),
							// City
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_city',
									'title': i18n.__( 'City' ),
									'descr': i18n.__( "Select the city to show cars from it" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_city'] )
								}, props
							),
							// Transmission
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_transmission',
									'title': i18n.__( 'Transmission' ),
									'descr': i18n.__( "Select type of the transmission" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_transmission'] )
								}, props
							),
							// Type of drive
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_type_drive',
									'title': i18n.__( 'Type of drive' ),
									'descr': i18n.__( "Select type of drive" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_type_drive'] )
								}, props
							),
							// Fuel
							trx_addons_gutenberg_add_param(
								{
									'name': 'cars_fuel',
									'title': i18n.__( 'Fuel' ),
									'descr': i18n.__( "Select type of the fuel" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_cars_fuel'] )
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
