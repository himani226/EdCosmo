var api = wp.customize;
/*_.each(cl_post_meta.metadata, function(meta, index) {
    /*wp.customize.controlConstructor[meta.control_type + '-meta'] = wp.customize.Control.extend({

        initialize: function(id, options) {
            var control = this,
                args;

            args = options || {};
            args.params = args.params || {};
            if (!args.params.type) {
                args.params.type = 'dynamic';
            }

            if (!args.params.content) {
                args.params.content = jQuery('<li></li>');
                args.params.content.attr('id', 'customize-control-' + id.replace(/]/g, '').replace(/\[/g, '-'));
                args.params.content.attr('class', 'customize-control customize-control-' + args.params.type);
            }

            control.propertyElements = [];
       
            //wp.customize.controlConstructor[meta.control_type].prototype.initialize.call(control, id, args);
            api.Control.prototype.initialize.call(control, id, args);

        },



        embed: function() {
            var control = this,
                inject;

            // Watch for changes to the section state
            inject = function ( sectionId ) {
                var parentContainer;
                if ( ! sectionId ) { // @todo allow a control to be embedded without a section, for instance a control embedded in the front end.
                    return;
                }
                // Wait for the section to be registered
                api.section( sectionId, function ( section ) {
                    // Wait for the section to be ready/initialized
                    section.deferred.embedded.done( function () {
                        parentContainer = ( section.contentContainer.is( 'ul' ) ) ? section.contentContainer : section.contentContainer.find( 'ul:first' );
                        if ( ! control.container.parent().is( parentContainer ) ) {
                            parentContainer.append( control.container );
                            control.renderContent();
                        }
                        control.deferred.embedded.resolve();
                    });
                });
            };
            control.section.bind( inject );
            inject( control.section.get() );
        },

        ready: function() {
            var control = this;

            control._setUpSettingRootLinks();
            control._setUpSettingPropertyLinks();


            console.log(meta.control_type);

            //api.Control.prototype.ready.call(control);
            if( !_.isUndefined(wp.customize.controlConstructor[meta.control_type]) )
                wp.customize.controlConstructor[meta.control_type].prototype.initKirkiControl.call(control);
            // @todo build out the controls for the post when Control is expanded.
            // @todo Let the Control title include the post title.
            control.deferred.embedded.done(function() {});
        },

        /**
         * Deferred embedding of control when actually
         *
         * This function is called in Section.onChangeExpanded() so the control
         * will only get embedded when the Section is first expanded.
         *
         * @returns {void}
         
        actuallyEmbed: function() {
            var control = this;
      
            if ('resolved' === control.deferred.embedded.state()) {
                return;
            }

            control.renderContent();
            control.deferred.embedded.resolve(); // This triggers control.ready().
        },


        _setUpSettingRootLinks: function() {
            var control, nodes, radios;
            control = this;
            nodes = control.container.find('[data-customize-setting-link]');

            radios = {};

            nodes.each(function() {
                var node = jQuery(this),
                    name;

                if (node.is(':radio')) {
                    name = node.prop('name');
                    if (radios[name]) {
                        return;
                    }

                    radios[name] = true;
                    node = nodes.filter('[name="' + name + '"]');
                }

                api(node.data('customizeSettingLink'), function(setting) {

                    var element = new api.Element(node);
                    control.elements.push(element);
                    element.sync(setting);
                    element.set(setting());
                });
            });

        },

        /**
         * Add bidirectional data binding links between inputs and the setting properties.
         *
         * @private
         * @returns {void}
         
        _setUpSettingPropertyLinks: function() {
            var control = this,
                nodes, radios;
            if (!control.setting) {
                return;
            }

            nodes = control.container.find('[data-customize-setting-property-link]');
            radios = {};

            nodes.each(function() {
                var node = $(this),
                    name,
                    element,
                    propertyName = node.data('customizeSettingPropertyLink');

                if (node.is(':radio')) {
                    name = node.prop('name');
                    if (radios[name]) {
                        return;
                    }
                    radios[name] = true;
                    node = nodes.filter('[name="' + name + '"]');
                }

                element = new api.Element(node);
                control.propertyElements.push(element);
                element.set(control.setting()[propertyName]);

                element.bind(function(newPropertyValue) {
                    var newSetting = control.setting();
                    if (newPropertyValue === newSetting[propertyName]) {
                        return;
                    }
                    newSetting = _.clone(newSetting);
                    newSetting[propertyName] = newPropertyValue;
                    control.setting.set(newSetting);
                });
                control.setting.bind(function(newValue) {
                    if (newValue[propertyName] !== element.get()) {
                        element.set(newValue[propertyName]);
                    }
                });
            });
        },

    });


});*/


wp.customize.bind('ready', function() {
    var api = wp.customize;

    api.Posts.data.postTypes['post'].supports['comments'] = false;
    api.Posts.data.postTypes['post'].supports['custom-fields'] = false;
    api.Posts.data.postTypes['post'].supports['editor'] = false;
    api.Posts.data.postTypes['post'].supports['excerpt'] = true;
    api.Posts.data.postTypes['post'].supports['revisions'] = false;
    api.Posts.data.postTypes['post'].supports['trackbacks'] = false;
    api.Posts.data.postTypes['post'].supports['page-attributes'] = false;
    api.Posts.data.postTypes['post'].supports['ordering'] = false;
    api.Posts.data.postTypes['post'].supports['parent'] = false;
    api.Posts.data.postTypes['post'].supports['author'] = false;

    if( !_.isUndefined(api.Posts.data.postTypes['product']) ){
        api.Posts.data.postTypes['product'].supports['comments'] = false;
        api.Posts.data.postTypes['product'].supports['custom-fields'] = false;
        api.Posts.data.postTypes['product'].supports['editor'] = false;
        api.Posts.data.postTypes['product'].supports['excerpt'] = false;
        api.Posts.data.postTypes['product'].supports['revisions'] = false;
        api.Posts.data.postTypes['product'].supports['trackbacks'] = false;
        api.Posts.data.postTypes['product'].supports['page-attributes'] = false;
        api.Posts.data.postTypes['product'].supports['ordering'] = false;
        api.Posts.data.postTypes['product'].supports['parent'] = false;
        api.Posts.data.postTypes['product'].supports['author'] = false;
    }
    
    api.Posts.data.postTypes['page'].supports['comments'] = false;
    api.Posts.data.postTypes['page'].supports['custom-fields'] = false;
    api.Posts.data.postTypes['page'].supports['editor'] = false;
    api.Posts.data.postTypes['page'].supports['excerpt'] = false;
    api.Posts.data.postTypes['page'].supports['revisions'] = false;
    api.Posts.data.postTypes['page'].supports['trackbacks'] = false;
    api.Posts.data.postTypes['page'].supports['ordering'] = false;
    api.Posts.data.postTypes['page'].supports['parent'] = false;
    api.Posts.data.postTypes['page'].supports['author'] = false;


    api.section.each(addSectionControls);
    
    api.section.bind('add', addSectionControls);



    function addSectionControls(section) {
        _.each(cl_post_meta.metadata, function(meta, index) {
            if (section.extended(api.Posts.PostSection)) {
                section.contentsEmbedded.done(function addControl() {
                    addCustomControl(section, meta, index);
                });
            }
        });
    }


    function addCustomControl(section, meta, index) {
        var postTypeObj;

        postTypeObj = api.Posts.data.postTypes[section.params.post_type];



        if (!postTypeObj || !postTypeObj.supports[meta.feature]) {
            return;
        }

        var control, customizeId;

        customizeId = 'postmeta[' + section.params.post_type + '][' + String(section.params.post_id) + '][' + meta.meta_key + ']';


        if (api.control.has(customizeId)) {
            return api.control(customizeId);
        }
        
        if( !_.isUndefined( meta.dynamic ) && meta.dynamic ){
            
            control = new api.controlConstructor['dynamic']( customizeId, {
                params: {
                    section: section.id,
                    description: _.isUndefined(meta.description) ? '' : meta.description,
                    label: meta.label,
                    settings: {
                        'default': customizeId
                    },
                    alpha: true,
                    id: customizeId.replace(/]/g, '').replace(/\[/g, '-'),
                    priority: meta.priority,
                    field_type: meta.control_type,
                    input_attrs: {
                        'data-customize-setting-link': customizeId
                    }
                }
            } );

        }else if( meta.control_type == 'image' ){

            control = new api.MediaControl( controlId, {
                params: {
                    section: section.id,
                    priority: meta.priority,
                    label: meta.label,
                    button_labels: {
                        change: 'Change Image',
                    },
                    description: _.isUndefined(meta.description) ? '' : meta.description,
                    alpha: true,
                    active: true,
                    canUpload: true,
                    /*content: '<li class="customize-control customize-control-media"></li>',*/
                    description: '',
                    mime_type: 'image',
                    settings: {
                        'default': customizeId
                    },
                    link: 'data-customize-setting-link="'+customizeId+'"',
                    type: 'media',
                    'default': ''
                }
            } );

        }else{

            control = new api.controlConstructor[meta.control_type](customizeId, {
                params: {
                    section: section.id,
                    label: meta.label,
                    settings: {
                        'default': customizeId
                    },
                    
                    value: meta.value,
                    active: true,
                    alpha: true,
                    multiple: _.isUndefined(meta.multiple) ? 1 : meta.multiple,
                    description: _.isUndefined(meta.description) ? '' : meta.description,
                    priority: meta.priority,
                    default: meta.default,
                    field_type: meta.control_type,
                    transport: meta.transport,
                    link: 'data-customize-setting-link="'+customizeId+'"',
                    type: meta.control_type,
                    id: customizeId.replace(/]/g, '').replace(/\[/g, '-'),
                    choices: !_.isUndefined(meta.choices) ? meta.choices : {},
                    inline_control: true,
                    row_label: _.isUndefined(meta.row_label) ? false : meta.row_label,
                    fields: _.isUndefined(meta.fields) ? false : meta.fields,
                    //content: content
                }

            });

            setTimeout( function(){
                control.initKirkiControl(control);
            }, 500);
        }
        

        if( !_.isUndefined( meta.cl_required ) && !_.isUndefined( meta.cl_required.setting ) ){
            metaSetting = 'postmeta[' + section.params.post_type + '][' + String( section.params.post_id ) + ']['+ meta.cl_required.setting +']';
            if( ! api.has( metaSetting ) )
                metaSetting = meta.cl_required.setting;
        }

        


        var isActiveCallback = function() {

            if (_.isUndefined(meta.cl_required))
                return true;
            if (_.isUndefined(meta.cl_required.setting) || _.isUndefined(meta.cl_required.operator) || _.isUndefined(meta.cl_required.value))
                return true;
            if (meta.cl_required.operator == '==') {

            if (api.has(metaSetting) && api(metaSetting).get() === meta.cl_required.value)
                    return true;
            }

            return false;

        }

        control.active.set(isActiveCallback());
        control.active.validate = isActiveCallback;

        if (!_.isUndefined(meta.cl_required) && !_.isUndefined(meta.cl_required.setting) && !_.isEmpty(meta.cl_required.setting)) {

            api(metaSetting, function(setting) {
                setting.bind(function() {
                    control.active.set(isActiveCallback());
                });
            });
        }

        // Register.
        api.control.add(control.id, control);
    }


});