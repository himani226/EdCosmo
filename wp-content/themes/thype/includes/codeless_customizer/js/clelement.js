wp.customize.controlConstructor['clelement'] = wp.customize.Control.extend({
	ready: function() {

		'use strict';

		var control = this,
		    limit;
		    
		this.element_values = {};
		
		this.element_id = this.container.data('id');
		
		this.selects = [];

		this.active.set(false);

		// The DIV that holds all the rows
		this.elementsFieldsContainer = this.container.find( '.fields' ).first();

		// Set number of rows to 0
		this.currentIndex = 0;
		
		
		
		// Default limit choice
		limit = false;
		if ( undefined !== this.params.choices.limit ) {
			limit = ( 0 >= this.params.choices.limit ) ? false : parseInt( this.params.choices.limit );
		}

		this.buildDependeciens();
	

		this.container.on( 'click keypress', '.element-field-image .upload-button,.element-field-cropped_image .upload-button,.element-field-upload .upload-button', function( e ) {
			e.preventDefault();
			
			control.$thisButton = jQuery( this );
			control.openFrame( e );
		});

		this.container.on( 'click keypress', '.element-field-image .remove-button,.element-field-cropped_image .remove-button', function( e ) {
			e.preventDefault();
			control.$thisButton = jQuery( this );
			control.removeImage( e );
		});

		this.container.on( 'click keypress', '.element-field-upload .remove-button', function( e ) {
			e.preventDefault();
			control.$thisButton = jQuery( this );
			control.removeFile( e );
		});
		

		
		
		
		/**/
		
		
		
		/*this.container.on('mousemove', 'input[type=range]', function(e) {
			
		});*/
		
		
		
		/*this.container.on('focusout', 'input[type="text"]', function(e){
			
			control.setting.previewer.send('cl_focusout', 'cl_header_menu-1');
		});*/
		

		/**
		 * Function that loads the Mustache template
		 */
		this.elementTemplate = _.memoize( function( element_id ) {
			var compiled,
			/*
			 * Underscore's default ERB-style templates are incompatible with PHP
			 * when asp_tags is enabled, so WordPress uses Mustache-inspired templating syntax.
			 *
			 * @see trac ticket #22344.
			 */
			options = {
				evaluate: /<#([\s\S]+?)#>/g,
				interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
				escape: /\{\{([^\}]+?)\}\}(?!\})/g,
				variable: 'data'
			};

			return function( data ) {
				compiled = _.template( jQuery( '#tmpl-customize-control-'+element_id+'-content' ).first().html(), null, options );
				return compiled( data );
			};
		});

		// When we load the control, the fields have not been filled up
		// This is the first time that we create all the rows
		//this.createEl();
	

		

	},


	galleryReady: function(id){
		

		var control = this;
		// Shortcut so that we don't have to use _.bind every time we add a callback.
            _.bindAll( control, 'galleryOpenFrame', 'gallerySelect' );

            /**
             * Set gallery data and render content.
             */
            

            // Ensure attachment data is initially set.
            control.setGalleryDataAndRenderContent(id);

            // Bind events.
            control.container.on( 'click keydown', '.upload-button', control.galleryOpenFrame );
	},


	setGalleryDataAndRenderContent: function(id) {
        var control = this;
        var value = control.getValue();
     
        if( value[id].length )      
        	value = JSON.parse( value[id].replace('__array__', '[').replace('__array__end__', ']') );
        else
        	value = [];
               
        control.openedGallery = id;

        control.gallerySetAttachmentsData( value ).done( function() {
            control.galleryRenderAttachments();
            control.gallerySetupSortable();
        } );
    },


	    galleryRenderAttachments: function(){
	    	var inner_container, control;
	    	control = this;

	    	inner_container = control.container.find('[data-field="'+control.openedGallery+'"]').closest('.image-gallery-attachments');
	    	inner_container.html('');
	    	_.each(control.codelessElementMap[control.openedGallery].attachments, function(attachment){
	    		inner_container.append('<div class="image-gallery-thumbnail-wrapper" data-post-id="'+attachment.id+'"><img class="attachment-thumb" src="'+attachment.url+'" draggable="false" alt="control" /></div>');
	    	} );

	    	control.gallerySetupSortable();
	    },

		/**
         * Open the media modal.
         */
        galleryOpenFrame: function( event ) {
            event.preventDefault();

            if ( ! this.frame ) {
                this.galleryInitFrame();
            }

            this.frame.open();
        },

        /**
         * Initiate the media modal select frame.
         * Save it for using later in case needed.
         */
        galleryInitFrame: function() {

            var control = this, galleryPreSelectImages;
            this.frame = wp.media({

                button: {
                    text: 'Choose Images'
                },
                states: [
                    new wp.media.controller.Library({
                        title: 'Select Gallery Images',
                        library: wp.media.query({ type: 'image' }),
                        multiple: 'add'
                    })
                ]
            });

            /**
             * Pre-select images according to saved settings.
             */
            galleryPreSelectImages = function() {
                var selection, ids, attachment, library;

                library = control.frame.state().get( 'library' );
                selection = control.frame.state().get( 'selection' );

                ids = control.getValue();
                if( ids[control.openedGallery].length )
                	ids = JSON.parse( ids[control.openedGallery].replace('{', '[').replace('}', ']') );
                else
                	ids = [];

                // Sort the selected images to top when opening media modal.
                library.comparator = function( a, b ) {
                    var hasA = true === this.mirroring.get( a.cid ),
                        hasB = true === this.mirroring.get( b.cid );

                    if ( ! hasA && hasB ) {
                        return -1;
                    } else if ( hasA && ! hasB ) {
                        return 1;
                    } else {
                        return 0;
                    }
                };

                _.each( ids, function( id ) {
                    attachment = wp.media.attachment( id );
                    selection.add( attachment ? [ attachment ] : [] );
                    library.add( attachment ? [ attachment ] : [] );
                });
            };
            control.frame.on( 'open', galleryPreSelectImages );
            control.frame.on( 'select', control.gallerySelect );
        },

        /**
         * Callback for selecting attachments.
         */
        gallerySelect: function() {

            var control = this, attachments, attachmentIds, fieldId, currentSettings;

            attachments = control.frame.state().get( 'selection' ).toJSON();
            control.codelessElementMap[control.openedGallery].attachments = attachments;

            attachmentIds = control.galleryGetAttachmentIds( attachments );
            
            fieldId = control.container.find('.image-gallery-attachments').data('field');
            currentSettings = this.getValue();

            currentSettings[ fieldId ] = JSON.stringify(attachmentIds).replace('[', '__array__').replace(']', '__array__end__');
			control.setValue( currentSettings, true, false, fieldId, 'image_gallery', '', '');
			control.container.focus();
			control.setGalleryDataAndRenderContent(fieldId);

        },

        /**
         * Get array of attachment id-s from attachment objects.
         *
         * @param {Array} attachments Attachments.
         * @returns {Array}
         */
        galleryGetAttachmentIds: function( attachments ) {
            var ids = [], i;
            for ( i in attachments ) {
                ids.push( attachments[ i ].id );
            }
            return ids;
        },


	gallerySetAttachmentsData: function( value ) {
            var control = this,
                promises = [];

            control.codelessElementMap[control.openedGallery].attachments = [];

            _.each( value, function( id, index ) {
                var hasAttachmentData = new jQuery.Deferred();
                wp.media.attachment( id ).fetch().done( function() {
                    control.codelessElementMap[control.openedGallery].attachments[ index ] = this.attributes;
                    hasAttachmentData.resolve();
                } );
                promises.push( hasAttachmentData );
            } );

            return jQuery.when.apply( undefined, promises ).promise();
    },

    gallerySetupSortable: function() {
            var control = this,
                list = jQuery( '.image-gallery-attachments' );
            list.sortable({
                items: '.image-gallery-thumbnail-wrapper',
                tolerance: 'pointer',
                stop: function() {
                    var selectedValues = [];
                    list.find( '.image-gallery-thumbnail-wrapper' ).each( function() {
                        var id;
                        id = parseInt( jQuery( this ).data( 'postId' ), 10 );
                        selectedValues.push( id );
                    } );
                    var fieldId = control.container.find('.image-gallery-attachments').data('field');
		            var currentSettings = control.getValue();

		            currentSettings[ fieldId ] = JSON.stringify(selectedValues).replace('[', '__array__').replace(']', '__array__end__');

					control.setValue( currentSettings, true, false, fieldId, 'image_gallery', '', '');
                }
            });
    },


	
	buildDependeciens: function(){
		this.active_callback = {};
		var control = this;
		
		if(_.isUndefined(control.cl_required))
			control.cl_required = {};
		
		
		_.each(control.codelessElementMap, function(field, key){
			
			if(!_.isUndefined(field['cl_required']) && field['cl_required'].length){
				
				_.each(field['cl_required'], function(req, index){
					
					if(_.isUndefined(control.cl_required[req['setting']]))
						control.cl_required[req['setting']] = [];
					
					var opt = req['setting'];
					req['setting'] = key;
					control.cl_required[opt].push(req);
						
				});
				
			}
		});
	},
	
	createEl: function(data, first){
		var control = this;
		if(first){
			this.final_value = '';
			this.element_id = data.id; 
			
			this.codelessElementMap = codelessElementsMap[data.id];
		}

		this.addElements(data.options);
		
		var control = this;


		
		
		control.initColorPicker();

		control.initSelect();
				
		_.each( control.codelessElementMap, function( subValue, index ){
				console.log(index);
				console.log(control.element_values);
				control.checkDependecies(index, control.element_values[index]);
		} );

		this.activeTabs();

		this.container.on( 'click', '.change_icon', function(e){
			e.preventDefault();
			if(jQuery(this).parent().find('.icons_div').hasClass('hidden'))
				jQuery(this).parent().find('.icons_div').removeClass('hidden');
			else
				jQuery(this).parent().find('.icons_div').addClass('hidden');
		});

		this.container.on( 'click keypress', '.element-field-image .upload-button,.element-field-cropped_image .upload-button,.element-field-upload .upload-button', function( e ) {
			e.preventDefault();
			
			control.$thisButton = jQuery( this );
			control.openFrame( e );
		});

		this.container.on( 'click keypress', '.element-field-image .remove-button,.element-field-cropped_image .remove-button', function( e ) {
			e.preventDefault();
			control.$thisButton = jQuery( this );
			control.removeImage( e );
		});

		this.container.on( 'click keypress', '.element-field-upload .remove-button', function( e ) {
			e.preventDefault();
			control.$thisButton = jQuery( this );
			control.removeFile( e );
		});
		
		var typingTimer;
		var doneTypingInterval = 1000; 

		this.container.on( 'change input keyup ', 'input, select, textarea', function( e ) {
			var element = jQuery( this );

			if( jQuery(e.target).closest('span.value').length > 0 )
				return true;


			if( jQuery(e.target).closest('.element-field-css_tool').length == 0 && ( jQuery(e.target).is('[multiple="multiple"]') || jQuery(e.target).is('[type="text"]') ) ){
				clearTimeout(typingTimer);

	  			typingTimer = setTimeout(function(){ executeChange(e, element) }, doneTypingInterval);
	  		}else{
	  			executeChange(e, element);
	  		}
		});

		var executeChange = function(e, element){
			e.stopImmediatePropagation();

			if(jQuery(e.target).is('[type="search"]') && jQuery(e.target).hasClass('search_icons')){
				control.searchIcons( jQuery(e.target) );
			}
			
			var el = e.target;
			/*if( jQuery(el).is('input') && jQuery(el).parent('.selectize-input').length > 0 ){
				var el_correct = jQuery(el).closest('.element-wrapper').find('select');
				el = el_correct;
			}*/

			control.updateField.call(control, e, jQuery( el ).closest('.element-field').data( 'field' ), el );
			if(jQuery(e.target).is('[type="range"]')){
 
				element.closest( 'label' ).find( '.value input' ).prop( "value", jQuery(e.target).attr('value') );
			}
		}

		this.container.on( 'keydown', 'input, select', function( e ) {
			clearTimeout(typingTimer);	
		});
		
		
		
	
	},
	

	searchIcons: function( target ){
		var icons_wrapper = target.parent().find('.icons-wrapper');
		var val = target.val();
		var selected = icons_wrapper.children("[id*='"+val+"']");

		icons_wrapper.children( '.icon' ).not(selected).css('display', 'none');
		selected.css('display', 'inline-block');

		if( val == '' )
			icons_wrapper.children( '.icon' ).css('display', 'inline-block');
	},


	/**
	 * Open the media modal.
	 */
	 
	activeTabs: function(){
		var $actived = this.container.find('.tab_sections .active');
		var actived_id = $actived.data('tab');
		var control = this;
		control.container.find('#tab-'+actived_id).css({display:'block'}).addClass('active');
		
		control.container.find('.tab_sections a').on('click', function(){
			var $actived = jQuery(this);
			var actived_id = $actived.data('tab');
			
			control.container.find('.tab_sections a').removeClass('active');
			$actived.addClass('active');
			
			control.container.find('.tab_section.active').removeClass('active').css({display:'none'});
			control.container.find('#tab-'+actived_id).css({display:'block'}).addClass('active');
			
		});
	},
	 
	openFrame: function( event ) {

		'use strict';

		if ( wp.customize.utils.isKeydownButNotEnterEvent( event ) ) {
			return;
		}

		if ( this.$thisButton.closest( '.element-field' ).hasClass( 'element-field-cropped_image' ) ) {
			this.initCropperFrame();
		} else {
			this.initFrame();
		}

		this.frame.open();
	},

	initFrame: function() {

		'use strict';

		var libMediaType = this.getMimeType();
		
		if ( typeof this.frame != 'undefined' ) {
			this.frame.close(); 
		}
		
		if( ! _.isUndefined(wp.media.view.MediaFrame.CodelessPost) )
			this.frame = new wp.media.view.MediaFrame.CodelessPost({ 
				multiple:false,

			});
		else{
			this.frame = wp.media({
				multiple:false
			});
			this.frame.on( 'select', this.onSelect, this ); 
		}

		// When a file is selected, run a callback.
		this.frame.on( 'insert', this.onSelect, this ); 
	},
	/**
	 * Create a media modal select frame, and store it so the instance can be reused when needed.
	 * This is mostly a copy/paste of Core api.CroppedImageControl in /wp-admin/js/customize-control.js
	 */
	initCropperFrame: function() {

		'use strict';

		// We get the field id from which this was called
		var currentFieldId = this.$thisButton.siblings( 'input.hidden-field' ).attr( 'data-field' ),
		    attrs          = [ 'width', 'height', 'flex_width', 'flex_height' ], // A list of attributes to look for
		    libMediaType   = this.getMimeType();

		// Make sure we got it
		if ( 'string' === typeof currentFieldId && '' !== currentFieldId ) {

			// Make fields is defined and only do the hack for cropped_image
			if ( 'object' === typeof this.codelessElementMap[ currentFieldId ] && 'cropped_image' === this.codelessElementMap[ currentFieldId ].type ) {

				//Iterate over the list of attributes
				attrs.forEach( function( el, index ) {

					// If the attribute exists in the field
					if ( 'undefined' !== typeof this.codelessElementMap[ currentFieldId ][ el ] ) {

						// Set the attribute in the main object
						this.params[ el ] = this.codelessElementMap[ currentFieldId ][ el ];
					}
				}.bind( this ) );
			}
		}

		this.frame = wp.media({
			button: {
				text: 'Select and Crop',
				close: false
			},
			states: [
				new wp.media.controller.Library({
					library:         wp.media.query({ type: libMediaType }),
					multiple:        false,
					date:            false,
					suggestedWidth:  this.params.width,
					suggestedHeight: this.params.height
				}),
				new wp.media.controller.CustomizeImageCropper({
					imgSelectOptions: this.calculateImageSelectOptions,
					control: this
				})
			]
		});

		this.frame.on( 'select', this.onSelectForCrop, this );
		this.frame.on( 'cropped', this.onCropped, this );
		this.frame.on( 'skippedcrop', this.onSkippedCrop, this );

	},

	onSelect: function() {

		'use strict';
		var sel = this.frame.state().get( 'selection' ).first();

		var attachment = !_.isUndefined(sel) ? sel.toJSON() : '';
		

		var mime = attachment.mime,
			regex = /^image\/(?:jpe?g|png|url|gif|x-icon)$/i;
		
		if (mime.match(regex)) {
			this.setImageInRepeaterField( attachment );
		} else {
			this.setOembed( attachment );
		}

	},

	/**
	 * After an image is selected in the media modal, switch to the cropper
	 * state if the image isn't the right size.
	 */

	onSelectForCrop: function() {

		'use strict';

		var attachment = this.frame.state().get( 'selection' ).first().toJSON();

		if ( this.params.width === attachment.width && this.params.height === attachment.height && ! this.params.flex_width && ! this.params.flex_height ) {
			this.setImageInRepeaterField( attachment );
		} else {
			this.frame.setState( 'cropper' );
		}
	},

	/**
	 * After the image has been cropped, apply the cropped image data to the setting.
	 *
	 * @param {object} croppedImage Cropped attachment data.
	 */
	onCropped: function( croppedImage ) {

		'use strict';

		this.setImageInRepeaterField( croppedImage );

	},

	/**
	 * Returns a set of options, computed from the attached image data and
	 * control-specific data, to be fed to the imgAreaSelect plugin in
	 * wp.media.view.Cropper.
	 *
	 * @param {wp.media.model.Attachment} attachment
	 * @param {wp.media.controller.Cropper} controller
	 * @returns {Object} Options
	 */
	calculateImageSelectOptions: function( attachment, controller ) {

		'use strict';

		var control    = controller.get( 'control' ),
		    flexWidth  = !! parseInt( control.params.flex_width, 10 ),
		    flexHeight = !! parseInt( control.params.flex_height, 10 ),
		    realWidth  = attachment.get( 'width' ),
		    realHeight = attachment.get( 'height' ),
		    xInit      = parseInt( control.params.width, 10 ),
		    yInit      = parseInt( control.params.height, 10 ),
		    ratio      = xInit / yInit,
		    xImg       = realWidth,
		    yImg       = realHeight,
		    x1,
		    y1,
		    imgSelectOptions;

		controller.set( 'canSkipCrop', ! control.mustBeCropped( flexWidth, flexHeight, xInit, yInit, realWidth, realHeight ) );

		if ( xImg / yImg > ratio ) {
			yInit = yImg;
			xInit = yInit * ratio;
		} else {
			xInit = xImg;
			yInit = xInit / ratio;
		}

		x1 = ( xImg - xInit ) / 2;
		y1 = ( yImg - yInit ) / 2;

		imgSelectOptions = {
			handles:     true,
			keys:        true,
			instance:    true,
			persistent:  true,
			imageWidth:  realWidth,
			imageHeight: realHeight,
			x1:          x1,
			y1:          y1,
			x2:          xInit + x1,
			y2:          yInit + y1
		};

		if ( false === flexHeight && false === flexWidth ) {
			imgSelectOptions.aspectRatio = xInit + ':' + yInit;
		}
		if ( false === flexHeight ) {
			imgSelectOptions.maxHeight = yInit;
		}
		if ( false === flexWidth ) {
			imgSelectOptions.maxWidth = xInit;
		}

		return imgSelectOptions;
	},

	/**
	 * Return whether the image must be cropped, based on required dimensions.
	 *
	 * @param {bool} flexW
	 * @param {bool} flexH
	 * @param {int}  dstW
	 * @param {int}  dstH
	 * @param {int}  imgW
	 * @param {int}  imgH
	 * @return {bool}
	 */
	mustBeCropped: function( flexW, flexH, dstW, dstH, imgW, imgH ) {

		'use strict';

		if ( true === flexW && true === flexH ) {
			return false;
		}

		if ( true === flexW && dstH === imgH ) {
			return false;
		}

		if ( true === flexH && dstW === imgW ) {
			return false;
		}

		if ( dstW === imgW && dstH === imgH ) {
			return false;
		}

		if ( imgW <= dstW ) {
			return false;
		}

		return true;
	},

	/**
	 * If cropping was skipped, apply the image data directly to the setting.
	 */
	onSkippedCrop: function() {

		'use strict';

		var attachment = this.frame.state().get( 'selection' ).first().toJSON();
		this.setImageInRepeaterField( attachment );

	},

	/**
	 * Updates the setting and re-renders the control UI.
	 *
	 * @param {object} attachment
	 */
	setImageInRepeaterField: function( attachment ) {

		'use strict';
		var that = this;
		var $targetDiv = this.$thisButton.closest( '.element-field-image,.element-field-cropped_image' );
	
		$targetDiv.find( '.kirki-image-attachment' ).html( '<img src="' + attachment.url + '">' );
		$targetDiv.find( '.kirki-image-attachment' ).addClass("added_image");
		$targetDiv.find( '.hidden-field' ).val( attachment.id );
		this.$thisButton.text( this.$thisButton.data( 'alt-label' ) );
		$targetDiv.find( '.remove-button' ).show();

		//This will activate the save button
		$targetDiv.find( 'input, textarea, select' ).trigger( 'change' );
		this.frame.close();

	},


	setOembed: function( attachment ) {

		'use strict';
		var that = this;
		var $targetDiv = this.$thisButton.closest( '.element-field-image,.element-field-cropped_image' );
		
		$targetDiv.find( '.kirki-image-attachment' ).html( '<div class="oembed">'+attachment.title+'</div>' );

		$targetDiv.find( '.kirki-image-attachment' ).addClass("added_image");
		$targetDiv.find( '.hidden-field' ).val( attachment.id );
		this.$thisButton.text( this.$thisButton.data( 'alt-label' ) );
		$targetDiv.find( '.remove-button' ).show();

		//This will activate the save button
		$targetDiv.find( 'input, textarea, select' ).trigger( 'change' );
		this.frame.close();

	},


	/**
	 * Updates the setting and re-renders the control UI.
	 *
	 * @param {object} attachment
	 */
	setFileInRepeaterField: function( attachment ) {

		'use strict';

		var $targetDiv = this.$thisButton.closest( '.element-field-upload' );

		$targetDiv.find( '.kirki-file-attachment' ).html( '<span class="file"><span class="dashicons dashicons-media-default"></span> ' + attachment.filename + '</span>' ).hide().slideDown( 'slow' );

		$targetDiv.find( '.hidden-field' ).val( attachment.id );
		this.$thisButton.text( this.$thisButton.data( 'alt-label' ) );
		$targetDiv.find( '.upload-button' ).show();
		$targetDiv.find( '.remove-button' ).show();

		//This will activate the save button
		$targetDiv.find( 'input, textarea, select' ).trigger( 'change' );
		this.frame.close();

	},

	getMimeType: function() {

		'use strict';

		// We get the field id from which this was called
		var currentFieldId = this.$thisButton.siblings( 'input.hidden-field' ).attr( 'data-field' ),
		    attrs          = [ 'mime_type' ]; // A list of attributes to look for

		// Make sure we got it
		if ( 'string' === typeof currentFieldId && '' !== currentFieldId ) {

			// Make fields is defined and only do the hack for cropped_image
			if ( 'object' === typeof this.codelessElementMap[ currentFieldId ] && 'upload' === this.codelessElementMap[ currentFieldId ].type ) {

				// If the attribute exists in the field
				if ( 'undefined' !== typeof this.codelessElementMap[ currentFieldId ].mime_type ) {

					// Set the attribute in the main object
					return this.codelessElementMap[ currentFieldId ].mime_type;
				}
			}
		}

		return 'image';

	},

	removeImage: function( event ) {

		'use strict';

		var $targetDiv,
		    $uploadButton;

		if ( wp.customize.utils.isKeydownButNotEnterEvent( event ) ) {
			return;
		}

		$targetDiv = this.$thisButton.closest( '.element-field-image,.element-field-cropped_image,.element-field-upload' );
		$uploadButton = $targetDiv.find( '.upload-button' );
		
		var $a = $targetDiv.find( '.kirki-image-attachment' );
		
		$a.show().html( $a.data( 'placeholder' ) );
		
		
		$a.removeClass('added_image');
		$targetDiv.find( '.hidden-field' ).val( '' );
		$uploadButton.text( $uploadButton.data( 'label' ) );
		this.$thisButton.hide();

		$targetDiv.find( 'input, textarea, select' ).trigger( 'change' );
 
	},

	removeFile: function( event ) {

		'use strict';

		var $targetDiv,
		    $uploadButton;

		if ( wp.customize.utils.isKeydownButNotEnterEvent( event ) ) {
			return;
		}

		$targetDiv = this.$thisButton.closest( '.element-field-upload' );
		$uploadButton = $targetDiv.find( '.upload-button' );

		$targetDiv.find( '.kirki-file-attachment' ).slideUp( 'fast', function() {
			jQuery( this ).show().html( jQuery( this ).data( 'placeholder' ) );
		});
		$targetDiv.find( '.hidden-field' ).val( '' );
		$uploadButton.text( $uploadButton.data( 'label' ) );
		this.$thisButton.hide();

		$targetDiv.find( 'input, textarea, select' ).trigger( 'change' );

	},

	/**
	 * Get the current value of the setting
	 *
	 * @return Object
	 */
	getValue: function() {

		'use strict';
		return this.element_values;

	},

	/**
	 * Set a new value for the setting
	 *
	 * @param newValue Object
	 * @param refresh If we want to refresh the previewer or not
	 */
	setValue: function( newValue, refresh, filtering, fieldId, field_type, selector, css_property, subKey ) {

		'use strict';
		
		this.element_values[fieldId] = newValue;

		this.setting.previewer.send('cl_element_updated', [this.element_id, fieldId, field_type, newValue, selector, css_property, this.cl_required[fieldId], subKey] );

	},

	/**
	 * Add a new row to repeater settings based on the structure.
	 *
	 * @param data (Optional) Object of field => value pairs (undefined if you want to get the default values)
	 */
	addElements: function( data, first ) {

		'use strict';

		var control       = this,
		    //template      = control.elementTemplate(), // The template for the new row (defined on Kirki_Customize_Repeater_Control::render_content() ).
		    settingValue  = this.getValue(), // Get the current setting value.
		    newRowSetting = [], // Saves the new setting data.
		    templateData, // Data to pass to the template
		    newRow,
		    temporaryHtml = '',
		    u,
		    i;
			
			var reMap = {
				'color': 'kirki-color',
				'switch': 'kirki-switch',
				'select': 'kirki-select',
				'slider': 'kirki-slider',
				'inline_select': 'kirki-select',
				'text' : 'cltext',
				'image' : 'kirki-image',
				'multicheck': 'kirki-multicheck'
			}
	

			// The control structure is going to define the new fields
			// We need to clone control.params.fields. Assigning it
			// ould result in a reference assignment.
			templateData = jQuery.extend( true, {}, control.codelessElementMap );

			_.each( templateData, function( value, key ){
				var type = value['type'],
					newType = _.isUndefined( reMap[type] ) ? type : reMap[type];
					value['value'] = !_.isUndefined( data[key] ) ? data[key] : value['default'];
					control.element_values[key] = value['value'];

					value['id'] = key;

					if( type == 'inline_text' || type == 'select_icon' || ( !_.isUndefined( value['show'] ) && !value['show'] ) )
						return true;

					if( !_.isUndefined( value['alpha'] ) ){
						value['choices'] = {};
						value['choices'] = {alpha: true};
					}

					if( type == 'slider' ){
						value['inputAttrs'] = 'value="'+value['value']+'" min="'+value['choices']['min']+'" max="'+value['choices']['max']+'" step="'+value['choices']['step']+'"';
					}

					var template = control.elementTemplate( newType );
					console.log(newType);
					template = template( value );

					if( type != 'show_tabs' && type != 'tab_start' && type != 'tab_end' && type != 'group_start' && type != 'group_end' ){
						var tooltip_trigger = '', 
							tooltip_content = '',
							tooltip_wrapper = '';

						if( !_.isUndefined( value.tooltip ) ){
							tooltip_trigger   = '<span class="tooltip-trigger" data-setting="' + value.id + '"><span class="dashicons dashicons-editor-help"></span></span>';
							tooltip_content   = '<div class="tooltip-content hidden" data-setting="' + value.id + '">' + value.tooltip + '</div>';
							tooltip_wrapper = '<div class="tooltip-wrapper">'  + trigger + content +  '</div>';
						}
						

						template = '<div class="element-field element-field-'+type+' id-'+key+' customize-control customize-control-'+newType+'" data-field="'+key+'">' + tooltip_wrapper + template + '</div>';
					}

					temporaryHtml += template;

			} );
		
			control.elementsFieldsContainer.html( temporaryHtml );
			// But if we have passed data, we'll use the data values instead
			/*if ( data ) {
				for ( i in data ) {
					if ( data.hasOwnProperty( i ) && templateData.hasOwnProperty( i ) ) {
						templateData[ i ]['default'] = data[ i ];
					}
				}
			}


			// Append the template content
			template = template( templateData );

			control.elementsFieldsContainer.html(template);


			for ( u in templateData ) {
				if ( templateData.hasOwnProperty( u ) ) {
					
					settingValue[u] = templateData[ u ]['default'];
				}
			}
			
			
			this.setValue( settingValue, false );
			

			return newRow;*/

	},



	/**
	 * Update a single field inside a row.
	 * Triggered when a field has changed
	 *
	 * @param e Event Object
	 */
	updateField: function( e, fieldId, element ) {

		'use strict';
		var type,
			subKey,
			currentSettings,
			control = this,
		    currentValue;

		if ( ! this.codelessElementMap[ fieldId ] ) {
			return;
		}
	
		type            = this.codelessElementMap[ fieldId].type;

		currentSettings = this.getValue();

		element = jQuery( element );

		if ( undefined === typeof currentSettings[ fieldId ] ) {
			return;
		}

		if ( 'checkbox' === type || 'switch' === type ) {
			currentValue = element.is( ':checked' ) ? 1 : 0;

		}else if('image' === type) {
			var final_img = {};
			var sel = (!_.isUndefined(this.frame) ? this.frame.state().get( 'selection' ).first() : '');
			if( !_.isUndefined(sel) && !_.isEmpty(sel) ){
				sel = sel.toJSON();
				_.each(sel, function(value, key){
					final_img[key] = encodeURIComponent(value);
				});
			}
			currentValue = final_img ;
		}else if('css_tool' === type){
			
			var name = element.data('name');
			
			if(!_.isObject(currentValue) )
				currentValue = {};
			
			if ( false === control.kirkiValidateCSSValue( element.val() ) && element.val() != '' ) {
				
				element.addClass('invalid');
				return;
				
			}else{
				
				element.removeClass('invalid');
				currentValue = element.val();
			
				if(element.val() == '' && !_.isUndefined(currentValue[name]))
					delete currentValue[ name ];
				
				subKey = name;
			}

		} else if('multicheck' == type) {
			
			var value = {}, i = 0, control = this;
			
			jQuery.each( control.codelessElementMap[ fieldId].choices, function( key, subValue ) {
				
				if ( control.container.find( 'input[value="' + key + '"]' ).is( ':checked' ) ) {
					
					value[ i ] = key;
					i++;
				}
			});
			
			currentValue = value;
			
		} else if('select' == type || type == 'inline_select'){
			var value = element.val();
			var multiple = parseInt( element.data( 'multiple' ) );
			if ( multiple > 1 ) {
				value = _.extend( {}, element.val() );
			}

			currentValue = value;

		} else {

			// Update the settings
			currentValue = element.val();
		}
		console.log(currentValue);
		this.setValue( currentValue, true, false, fieldId, type, '', '', subKey );
		this.checkDependecies(fieldId, currentValue);
	},
	
	checkDependecies: function(fieldId, value){
		
		var operators = {
		   '==': function(a, b){ return a==b},
		   '!=': function(a, b){ return a!=b}
		}
		
		var control = this;
		
		if(!_.isUndefined(this.cl_required[fieldId]) && this.cl_required[fieldId].length ){
			_.each(this.cl_required[fieldId], function(opt, index){
				
				if(operators[opt['operator']](opt['value'], value ) ){
					control.container.find('.id-'+opt['setting']).removeClass('show_on_required');
				}else{
					control.container.find('.id-'+opt['setting']).addClass('show_on_required');
				}
					
			});
		}	
	},
	

	/**
	 * Init the color picker on color fields
	 * Called after AddRow
	 *
	 */
	initColorPicker: function() {

		'use strict';

		var control     = this,
		    colorPicker = control.container.find( '.kirki-color-control' );
		    
		    

		jQuery.each(colorPicker, function(){
			var colorPicker = jQuery(this);
			var options     = {};
			var fieldId     = colorPicker.closest('.element-field').data( 'field' );
			// We check if the color palette parameter is defined.
			
			
			if ( 'undefined' !== typeof fieldId && 'undefined' !== typeof control.codelessElementMap[ fieldId ] && 'undefined' !== typeof control.codelessElementMap[ fieldId ].palettes && 'object' === typeof control.codelessElementMap[ fieldId ].palettes ) {
				options.palettes = control.codelessElementMap[ fieldId ].palettes;
			}

			options.width = 259;
			options.palettes = codelessPalettes;
			// When the color picker value is changed we update the value of the field
			options.change = function( event, ui ) {
	
				var currentPicker   = jQuery( event.target ),
				    
					
					
					selector = '',
					
					css_property = '';
					
				
				if('undefined' !== typeof control.codelessElementMap[ fieldId ].selector)
					selector = control.codelessElementMap[ fieldId ].selector;
					
				if('undefined' !== typeof control.codelessElementMap[ fieldId ].css_property)
					css_property = control.codelessElementMap[ fieldId ].css_property;
					
				control.setValue( ui.color.toString(), true, false, fieldId, 'color', selector, css_property );
	
			};
			
			// Init the color picker
			if ( 0 !== colorPicker.length ) {
				colorPicker.wpColorPicker( options );
			}
		});
		
			

	},

	/**
	 * Init the dropdown-pages field with selectize
	 * Called after AddRow
	 *
	 * @param {object} theNewRow the row that was added to the repeater
	 * @param {object} data the data for the row if we're initializing a pre-existing row
	 *
	 */
	initSelect: function( data ) {

		'use strict';

		var control  = this,
		    dropdown = control.container.find( 'select' ),
		    $select,
		    dataField,
		    multiple,
		    selectWooOptions = {};

		if ( 0 === dropdown.length ) {
			return;
		}

		dataField = dropdown.data( 'field' );
		multiple  = jQuery( dropdown ).data( 'multiple' );
		if ( 'undefined' !== multiple && jQuery.isNumeric( multiple ) ) {
			multiple = parseInt( multiple, 10 );
			if ( 1 < multiple ) {
				selectWooOptions.maximumSelectionLength = multiple;
			}
		}
		$select = jQuery( dropdown ).selectWoo( selectWooOptions ).val( dropdown.val() );
		this.selects.push( $select );
	},
	
	
	updateSilent: function(element){

		jQuery.each(this.selects[0], function(key, value){
			if(jQuery(value).closest('.element-field').data('field') == element.id){

				jQuery( value ).selectWoo().val( element.value ).trigger( 'change' );
			}
		});
	},

	kirkiValidateCSSValue: function( value ) {

			var validUnits = ['rem', 'em', 'ex', '%', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ch', 'vh', 'vw', 'vmin', 'vmax'],
				numericValue,
				unit;

			// 0 is always a valid value, and we can't check calc() values effectively.
			if ( '0' === value || ( 0 <= value.indexOf( 'calc(' ) && 0 <= value.indexOf( ')' ) ) ) {
				return true;
			}

			// Get the numeric value.
			numericValue = parseFloat( value );

			// Get the unit
			unit = value.replace( numericValue, '' );

			// Check the validity of the numeric value and units.
			if ( isNaN( numericValue ) || -1 === jQuery.inArray( unit, validUnits ) ) {
				return false;
			}
			return true;
		}

});
