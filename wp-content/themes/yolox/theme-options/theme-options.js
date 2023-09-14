/* global jQuery:false */
/* global YOLOX_STORAGE:false */

//-------------------------------------------
// Theme Options fields manipulations
//-------------------------------------------
jQuery( document ).ready(
	function() {
		"use strict";

		// Submit form
		jQuery( '.yolox_options_button_submit' ).on(
			'click', function() {
				jQuery( this ).parents( 'form' ).submit();
			}
		);

		// Toggle checkbox value
		jQuery( '.yolox_options input[type="checkbox"]' ).on( 'change', function() {
			var fld = jQuery(this).prev();
			fld.val( jQuery(this).get(0).checked ? 1 : 0 );
		} );

		// Toggle inherit button and cover
		jQuery( '#yolox_options_tabs' ).on(
			'click', '.yolox_options_inherit_lock,.yolox_options_inherit_cover', function (e) {
				var parent  = jQuery( this ).parents( '.yolox_options_item' );
				var inherit = parent.hasClass( 'yolox_options_inherit_on' );
				if (inherit) {
					parent.removeClass( 'yolox_options_inherit_on' ).addClass( 'yolox_options_inherit_off' );
					parent.find( '.yolox_options_inherit_cover' ).fadeOut().find( 'input[type="hidden"]' ).val( '' );
				} else {
					parent.removeClass( 'yolox_options_inherit_off' ).addClass( 'yolox_options_inherit_on' );
					parent.find( '.yolox_options_inherit_cover' ).fadeIn().find( 'input[type="hidden"]' ).val( 'inherit' );

				}
				e.preventDefault();
				return false;
			}
		);

		// Refresh linked field
		jQuery( '#yolox_options_tabs' ).on(
			'change', '[data-linked] select,[data-linked] input', function (e) {
				var chg_name          = jQuery( this ).parent().data( 'param' );
				var chg_value         = jQuery( this ).val();
				var linked_name       = jQuery( this ).parent().data( 'linked' );
				var linked_data       = jQuery( '#yolox_options_tabs [data-param="' + linked_name + '"]' );
				var linked_field      = linked_data.find( 'select' );
				var linked_field_type = 'select';
				if (linked_field.length == 0) {
					linked_field      = linked_data.find( 'input' );
					linked_field_type = 'input';
				}
				var linked_lock = linked_data.parent().parent().find( '.yolox_options_inherit_lock' ).addClass( 'yolox_options_wait' );
				// Prepare data
				var data = {
					action: 'yolox_get_linked_data',
					nonce: YOLOX_STORAGE['ajax_nonce'],
					chg_name: chg_name,
					chg_value: chg_value
				};
				jQuery.post(
					YOLOX_STORAGE['ajax_url'], data, function(response) {
						var rez = {};
						try {
							rez = JSON.parse( response );
						} catch (e) {
							rez = { error: YOLOX_STORAGE['msg_ajax_error'] };
							console.log( response );
						}
						if (rez.error === '') {
							if (linked_field_type == 'select') {
								var opt_list = '';
								for (var i in rez.list) {
									opt_list += '<option value="' + i + '">' + rez.list[i] + '</option>';
								}
								linked_field.html( opt_list );
							} else {
								linked_field.val( rez.value );
							}
							linked_lock.removeClass( 'yolox_options_wait' );
						}
					}
				);
				e.preventDefault();
				return false;
			}
		);

		// Blur the "load fonts" fields - regenerate options lists in the font-family controls
		jQuery( '.yolox_options [name^="yolox_options_field_load_fonts"]' ).on( 'focusout', yolox_options_update_load_fonts );

		// Change theme fonts options if load fonts is changed
		function yolox_options_update_load_fonts() {
			var opt_list = [], i, tag, sel, opt, name = '', family = '', val = '', new_val = '', sel_idx = 0;
			for (i = 1; i <= yolox_options_vars['max_load_fonts']; i++) {
				name = jQuery( '[name="yolox_options_field_load_fonts-' + i + '-name"]' ).val();
				if (name == '') {
					continue;
				}
				family = jQuery( '[name="yolox_options_field_load_fonts-' + i + '-family"]' ).val();
				opt_list.push( [name, family] );
			}
			for (tag in yolox_theme_fonts) {
				sel = jQuery( '[name="yolox_options_field_' + tag + '_font-family"]' );
				if (sel.length == 1) {
					opt     = sel.find( 'option' );
					sel_idx = sel.find( ':selected' ).index();
					// Remove empty options
					if (opt_list.length < opt.length - 1) {
						for (i = opt.length - 1; i > opt_list.length; i--) {
							opt.eq( i ).remove();
						}
					}
					// Add new options
					if (opt_list.length >= opt.length) {
						for (i = opt.length - 1; i <= opt_list.length - 1; i++) {
							val = '&quot;' + opt_list[i][0] + '&quot;' + (opt_list[i][1] != 'inherit' ? ',' + opt_list[i][1] : '');
							sel.append( '<option value="' + val + '">' + opt_list[i][0] + '</option>' );
						}
					}
					// Set new value
					new_val = '';
					for (i = 0; i < opt_list.length; i++) {
						val = '"' + opt_list[i][0] + '"' + (opt_list[i][1] != 'inherit' ? ',' + opt_list[i][1] : '');
						if (sel_idx - 1 == i) {
							new_val = val;
						}
						opt.eq( i + 1 ).val( val ).text( opt_list[i][0] );
					}
					sel.val( sel_idx > 0 && sel_idx <= opt_list.length && new_val ? new_val : 'inherit' );
				}
			}
		}

		// Check for dependencies
		//--------------------------------------------------------

		// Check for external dependencies (for example, "Page template" in the page edit mode)
		jQuery( window ).on( 'load', function() {
			"use strict";

			jQuery( '.yolox_options .yolox_options_section' ).each( function () {
				yolox_options_check_dependencies( jQuery( this ) );
			} );

		} );

		// Check for internal dependencies
		jQuery( document ).ready( function() {
			"use strict";

			// Check all inner dependencies
			jQuery( '.yolox_options .yolox_options_section' ).each( function () {
				yolox_options_check_dependencies( jQuery( this ) );
			} );

			// Check dependencies on any field change
			jQuery( '.yolox_options .yolox_options_item_field [name^="yolox_options_field_"]' ).on( 'change', function () {
				yolox_options_check_dependencies( jQuery( this ).parents( '.yolox_options_section' ) );
			} );

		} );

		// Return value of the field
		function yolox_options_get_field_value(fld, num) {
			var ctrl = fld.parents( '.yolox_options_item_field' );
			var val  = fld.attr( 'type' ) == 'checkbox' || fld.attr( 'type' ) == 'radio'
					? (ctrl.find( '[name^="yolox_options_field_"]:checked' ).length > 0
						? (num === true
							? ctrl.find( '[name^="yolox_options_field_"]:checked' ).parent().index() + 1
							: (ctrl.find( '[name^="yolox_options_field_"]:checked' ).val() !== ''
								&& '' + ctrl.find( '[name^="yolox_options_field_"]:checked' ).val() != '0'
									? ctrl.find( '[name^="yolox_options_field_"]:checked' ).val()
									: 1
								)
							)
						: 0
						)
					: (num === true ? fld.find( ':selected' ).index() + 1 : fld.val());
			if (val === undefined || val === null) {
				val = '';
			}
			return val;
		}

		// Check for dependencies
		function yolox_options_check_dependencies(cont) {
			if ( typeof yolox_dependencies == 'undefined' || YOLOX_STORAGE['check_dependencies_now'] ) {
				return;
			}
			YOLOX_STORAGE['check_dependencies_now'] = true;
			cont.find( '.yolox_options_item_field,.yolox_options_group[data-param]' ).each( function() {
				var ctrl = jQuery( this ),
					id = ctrl.data( 'param' );
				if (id === undefined) {
					return;
				}
				var depend = false, fld;
				for (fld in yolox_dependencies) {
					if (fld == id) {
						depend = yolox_dependencies[id];
						break;
					}
				}
				if (depend) {
					var dep_cnt    = 0, dep_all = 0;
					var dep_cmp    = typeof depend.compare != 'undefined' ? depend.compare.toLowerCase() : 'and';
					var dep_strict = typeof depend.strict != 'undefined';
					var val        = undefined;
					var name       = '', subname = '';
					var parts      = '', parts2 = '';
					var i;
					fld = null;
					for (i in depend) {
						if (i == 'compare' || i == 'strict') {
							continue;
						}
						dep_all++;
						name    = i;
						subname = '';
						if (name.indexOf( '[' ) > 0) {
							parts   = name.split( '[' );
							name    = parts[0];
							subname = parts[1].replace( ']', '' );
						}
						// If a name is a selector to the DOM-object 
						if ( name.charAt( 0 ) == '#' || name.charAt( 0 ) == '.' || name.slice( 0, 8 ) == '@editor/' ) {
							if ( name.charAt( 0 ) == '#' || name.charAt( 0 ) == '.' ) {
								fld = jQuery( name );
							}
							if ( fld && fld.length > 0 ) {
								var panel = fld.closest('.edit-post-sidebar');
								if ( panel.length === 0 ) {
									if ( ! fld.hasClass('yolox_inited') ) {
										fld.addClass('yolox_inited').on('change', function () {
											jQuery('.yolox_options .yolox_options_section').each( function () {
												yolox_options_check_dependencies(jQuery(this));
											} );
										} );
									}
								} else {
									if ( ! panel.hasClass('yolox_inited') ) {
										panel.addClass('yolox_inited').on('change', fld, function () {
											jQuery('.yolox_options .yolox_options_section').each( function () {
												yolox_options_check_dependencies(jQuery(this));
											} );
										} );
									}
								}
							} else if ( name == '#page_template' || name == '.editor-page-attributes__template select' || name.slice( 0, 8 ) == '@editor/' ) {
								var prop_check = 'template';
								if ( name.slice( 0, 8 ) == '@editor/' ) {
									prop_check = name.slice( 8 );
								}
								if ( typeof wp == 'object' && typeof wp.data == 'object' ) {
									if ( typeof YOLOX_STORAGE['editor_props'] == 'undefined' ) {
										YOLOX_STORAGE['editor_props'] = {};
									}
									if ( typeof YOLOX_STORAGE['editor_props'][ prop_check ] == 'undefined' ) {
										var prop_val = wp.data.select( 'core/editor' ).getEditedPostAttribute( prop_check );
										if ( prop_val !== undefined ) {
											YOLOX_STORAGE['editor_props'][ prop_check ] = prop_val;
										}
									}
									val = typeof YOLOX_STORAGE['editor_props'][ prop_check ] != 'undefined' ? YOLOX_STORAGE['editor_props'][ prop_check ] : '';
									var $body = jQuery( 'body' );
									if ( ! $body.hasClass( 'yolox_editor_props_listener_inited' ) ) {
										$body.addClass( 'yolox_editor_props_listener_inited' );
										// Call a check_dependencies() on a page template is changed
										wp.data.subscribe( function() {
											var prop_val = wp.data.select( 'core/editor' ).getEditedPostAttribute( prop_check );
											if ( prop_val !== undefined && ( typeof YOLOX_STORAGE['editor_props'][ prop_check ] == 'undefined' || prop_val != YOLOX_STORAGE['editor_props'][ prop_check ] ) ) {
												YOLOX_STORAGE['editor_props'][ prop_check ] = prop_val;
												jQuery('.yolox_options .yolox_options_section').each( function () {
													yolox_options_check_dependencies( jQuery( this ) );
												} );
											}

										} );
									}
								}
							}
						// A name is a field from options
						} else {
							fld = cont.find( '[name="yolox_options_field_' + name + '"]' );
						}
						if ( val !== undefined || ( fld && fld.length > 0 ) ) {
							if ( val === undefined ) {
								val = yolox_options_get_field_value( fld );
							}
							if ( val == 'inherit' ) {
								dep_cnt = 0;
								dep_all = 1;
								var parent = ctrl,
									tag;
								if ( ! parent.hasClass('yolox_options_group') ) {
									parent = parent.parents('.yolox_options_item');
								}
								var lock = parent.find( '.yolox_options_inherit_lock' );
								if ( lock.length ) {
									if ( ! parent.hasClass( 'yolox_options_inherit_on' ) ) {
										lock.trigger( 'click' );
									}
								} else if ( ctrl.data('type') == 'select' ) {
									tag = ctrl.find('select');
									if ( tag.find('option[value="inherit"]').length ) {
										tag.val('inherit').trigger('change');
									}
								} else if ( ctrl.data('type') == 'radio' ) {
									tag = ctrl.find('input[type="radio"][value="inherit"]');
									if ( tag.length && ! tag.get(0).checked ) {
										ctrl.find('input[type="radio"]:checked').get(0).checked = false;
										tag.get(0).checked = true;
										tag.trigger('change');
									}
								}
								break;
							} else {
								if (subname !== '') {
									parts = val.split( '|' );
									for (var p = 0; p < parts.length; p++) {
										parts2 = parts[p].split( '=' );
										if (parts2[0] == subname) {
											val = parts2[1];
										}
									}
								}
								if ( typeof depend[i] != 'object' && typeof depend[i] != 'array' ) {
									depend[i] = { '0': depend[i] };
								}
								for (var j in depend[i]) {
									if (
										(depend[i][j] == 'not_empty' && val !== '')   // Main field value is not empty - show current field
										|| (depend[i][j] == 'is_empty' && val === '') // Main field value is empty - show current field
										|| (val !== '' && ( ! isNaN( depend[i][j] )   // Main field value equal to specified value - show current field
														? val == depend[i][j]
														: (dep_strict
																? val == depend[i][j]
																: ('' + val).indexOf( depend[i][j] ) === 0
															)
													)
										)
										|| (val !== '' && ("" + depend[i][j]).charAt( 0 ) == '^' && ('' + val).indexOf( depend[i][j].substr( 1 ) ) == -1)
																					// Main field value not equal to specified value - show current field
									) {
										dep_cnt++;
										break;
									}
								}
							}
						} else {
							dep_all--;
						}
						if (dep_cnt > 0 && dep_cmp == 'or') {
							break;
						}
					}
					if ( ! ctrl.hasClass('yolox_options_group') ) {
						ctrl = ctrl.parents('.yolox_options_item');
					}
					var section = ctrl.parents('.yolox_tabs_section'),
						tab = jQuery( '[aria-labelledby="' + section.attr('aria-labelledby') + '"]' );
					if (((dep_cnt > 0 || dep_all === 0) && dep_cmp == 'or') || (dep_cnt == dep_all && dep_cmp == 'and')) {
						ctrl.slideDown().removeClass( 'yolox_options_no_use' );
						if ( section.find('>.yolox_options_item:not(.yolox_options_item_info),>.yolox_options_group[data-param]').length != section.find('.yolox_options_no_use').length ) {
							if ( tab.hasClass( 'yolox_options_item_hidden' ) ) {
								tab.removeClass('yolox_options_item_hidden');
							}
						}
					} else {
						ctrl.slideUp().addClass( 'yolox_options_no_use' );
						if ( section.find('>.yolox_options_item:not(.yolox_options_item_info),>.yolox_options_group[data-param]').length == section.find('.yolox_options_no_use').length ) {
							if ( ! tab.hasClass( 'yolox_options_item_hidden' ) ) {
								tab.addClass('yolox_options_item_hidden');
								if ( tab.hasClass('ui-state-active') ) {
									tab.parents('.yolox_tabs').find(' > ul > li:not(.yolox_options_item_hidden)').eq(0).find('> a').trigger('click');
								}
							}
						}
					}
				}

				// Individual dependencies
				//------------------------------------

				// Remove 'false' to disable color schemes less then main scheme!
				// This behavious is not need for the version with sorted schemes (leave false)
				if (false && id == 'color_scheme') {
					fld = ctrl.find( '[name="yolox_options_field_' + id + '"]' );
					if (fld.length > 0) {
						val     = yolox_options_get_field_value( fld );
						var num = yolox_options_get_field_value( fld, true );
						cont.find( '.yolox_options_item_field' ).each(
							function() {
								var ctrl2 = jQuery( this ), id2 = ctrl2.data( 'param' );
								if (id2 == undefined) {
									return;
								}
								if (id2 == id || id2.substr( -7 ) != '_scheme') {
									return;
								}
								var fld2 = ctrl2.find( '[name="yolox_options_field_' + id2 + '"]' ),
								val2     = yolox_options_get_field_value( fld2 );
								if (fld2.attr( 'type' ) != 'radio') {
									fld2 = fld2.find( 'option' );
								}
								fld2.each(
									function(idx2) {
										var dom_obj      = jQuery( this ).get( 0 );
										dom_obj.disabled = idx2 !== 0 && idx2 < num;
										if (dom_obj.disabled) {
											if (jQuery( this ).val() == val2) {
												if (fld2.attr( 'type' ) == 'radio') {
													fld2.each(
														function(idx3) {
															jQuery( this ).get( 0 ).checked = idx3 === 0;
														}
													);
												} else {
													fld2.each(
														function(idx3) {
															jQuery( this ).get( 0 ).selected = idx3 === 0;
														}
													);
												}
											}
										}
									}
								);
							}
						);
					}
				}
			} );
			YOLOX_STORAGE['check_dependencies_now'] = false;
		}

	}
);
