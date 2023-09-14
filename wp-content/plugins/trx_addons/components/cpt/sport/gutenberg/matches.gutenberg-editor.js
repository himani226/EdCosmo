(function(blocks, editor, i18n, element) {
	// Set up variables
	var el = element.createElement;

	// Register Block - Matches
	blocks.registerBlockType(
		'trx-addons/matches', {
			title: i18n.__( 'Matches' ),
			icon: 'universal-access',
			category: 'trx-addons-cpt',
			attributes: {
				type: {
					type: 'string',
					default: 'default'
				},
				sport: {
					type: 'string',
					default:  TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_sport_default']
				},
				competition: {
					type: 'string',
					default: '0'
				},
				round: {
					type: 'string',
					default: '0'
				},
				main_matches: {
					type: 'boolean',
					default: false
				},
				position: {
					type: 'string',
					default: 'top'
				},
				slider: {
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
					default: i18n.__( 'Matches' )
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
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_layouts']['trx_sc_matches'] )
								}, props
							),
							// Sport
							trx_addons_gutenberg_add_param(
								{
									'name': 'sport',
									'title': i18n.__( 'Sport' ),
									'descr': i18n.__( "Select Sport to display matches" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_sports_list'] ),
								}, props
							),
							// Competition
							trx_addons_gutenberg_add_param(
								{
									'name': 'competition',
									'title': i18n.__( 'Competition' ),
									'descr': i18n.__( "Select competition to display matches" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_sport_competitions_list'][props.attributes.sport], true ),
								}, props
							),
							// Round
							trx_addons_gutenberg_add_param(
								{
									'name': 'round',
									'title': i18n.__( 'Round' ),
									'descr': i18n.__( "Select round to display matches" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_sport_rounds_list'][props.attributes.competition], true )
								}, props
							),
							// Main matches
							trx_addons_gutenberg_add_param(
								{
									'name': 'main_matches',
									'title': i18n.__( 'Main matches' ),
									'descr': i18n.__( "Show large items marked as main match of the round" ),
									'type': 'boolean'
								}, props
							),
							// Position of the matches list
							trx_addons_gutenberg_add_param(
								{
									'name': 'position',
									'title': i18n.__( 'Position of the matches list' ),
									'descr': i18n.__( "Select the position of the matches list" ),
									'type': 'select',
									'options': trx_addons_gutenberg_get_lists( TRX_ADDONS_STORAGE['gutenberg_sc_params']['sc_sport_positions'] ),
									'dependency': {
										'main_matches': [true]
									}
								}, props
							),
							// Slider
							trx_addons_gutenberg_add_param(
								{
									'name': 'slider',
									'title': i18n.__( "Slider" ),
									'descr': i18n.__( "Show main matches as slider (if two and more)" ),
									'type': 'boolean',
									'dependency': {
										'main_matches': [true]
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
