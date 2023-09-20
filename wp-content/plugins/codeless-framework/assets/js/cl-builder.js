function cl_guid() {
    return CLS4() + CLS4() + "-" + CLS4()
}

function CLS4() {
    return (65536 * (1 + Math.random()) | 0).toString(16).substring(1)
}

function rgbToHex(color) {
    if (color.charAt(0) === "#") {
        return color;
    }

    color = color.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
    return (color && color.length === 4) ? "#" +
      ("0" + parseInt(color[1],10).toString(16)).slice(-2) +
      ("0" + parseInt(color[2],10).toString(16)).slice(-2) +
      ("0" + parseInt(color[3],10).toString(16)).slice(-2) : '';
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function loadCSS(href){
    var ss = document.styleSheets;
    for (var i = 0, max = ss.length; i < max; i++) {
        if (ss[i].href == href)
            return;
    }
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = href;

    document.getElementsByTagName("head")[0].appendChild(link);
}


/* cl-shortcodes.js */
var cl = cl || {};


(function($, api) {
        
        cl.memoize = function(func, resolver) {
            var cache = {};
            return function() {
                var key = resolver ? resolver.apply(this, arguments) : arguments[0];
                return _.hasOwnProperty.call(cache, key) || (cache[key] = func.apply(this, arguments)), _.isObject(cache[key]) ? jQuery.fn.extend(!0, {}, cache[key]) : cache[key]
            };
        };
        
        cl.elementCoordinates = {};
        
        cl.getMapped = cl.memoize(function(tag) {
            return cl.map[tag] || {}
        });

        cl.buildNotOverwrite = cl.memoize(function(tag) {
            var return_val = [];
            var fields = _.isObject(cl.getMapped(tag).fields) ? cl.getMapped(tag).fields : [];
            _.each(fields, function(param, index){
                if( param['type'] == 'inline_text' || param['type'] == 'select_icon' )
                    return_val.push( index );
            });

            return return_val;
        });
        
        cl.getParamSettings = cl.memoize(function(tag, paramName) {
            var params, paramSettings;
            params = _.isObject(cl.getMapped(tag).fields) ? cl.getMapped(tag).fields : [];
            
            return paramSettings = _.find(params, function(settings, name) {
                
                return _.isObject(settings) && name === paramName
            }, this)
        });

        cl.getPredefinedList = function(tag, pre_id) {
            var predefined = _.isObject(cl.getMapped(tag).predefined) ? cl.getMapped(tag).predefined : [];
            
            if( _.isObject( predefined[pre_id] ) )
                return predefined[pre_id];

            return false;
        };

        cl.getCSSDependency = cl.memoize(function(tag) {
            var dependency = _.isObject(cl.getMapped(tag).css_dependency) ? cl.getMapped(tag).css_dependency : [];
            
            return dependency;
        });

        cl.getContentBlock = cl.memoize(function(id) {
            var block = _.isObject(cl.content_blocks[id]) ? cl.content_blocks[id] : false;
            
            if( _.isObject( block ) )
                return block;

            return false;
        });
        
        cl.getDefaultParams = cl.memoize(function(tag) {
            var params, default_params = {};
            params = _.isObject(cl.getMapped(tag).fields) ? cl.getMapped(tag).fields : [];
            
            _.each(params, function(param, index){
                default_params[index] = param['default'];
            });
            
            return default_params;
        });



}(window.jQuery, wp.customize));



/* cl-header-builder.js */

(function($, api) {
        
        cl.getHeaderMapped = cl.memoize(function(tag) {
            
            return cl.headerMap[tag] || {}
        });
        
        cl.getHeaderParamSettings = cl.memoize(function(tag, paramName) {
            var params, paramSettings;
            params = _.isObject(cl.getHeaderMapped(tag).fields) ? cl.getHeaderMapped(tag).fields : [];
            
            return paramSettings = _.find(params, function(settings, name) {
                
                return _.isObject(settings) && name === paramName
            }, this)
        });
        
        cl.getHeaderDefaultParams = cl.memoize(function(tag) {
            var params, default_params = {};
            params = _.isObject(cl.getHeaderMapped(tag).fields) ? cl.getHeaderMapped(tag).fields : [];
            
            _.each(params, function(param, index){
                default_params[index] = param['default'];
            });
            
            return default_params;
        });
        
        
        
        var HeaderElement = Backbone.Model.extend({
                defaults: function() {
                    var id = cl_guid();
                    return {
                        id: id,
                        type: "logo",
                        order: cl.header_elements.nextOrder('main', 'left'),
                        params: {},
                        row: 'main',
                        col: 'left'
                    }
                },
                settings: !1,
                getParam: function(key) {
                    return _.isObject(this.get("params")) && !_.isUndefined(this.get("params")[key]) ? this.get("params")[key] : ""
                },
                sync: function() {
                    return !1
                },
                setting: function(name) {
                    return !1 === this.settings && (this.settings = cl.getHeaderMapped(this.get("type")) || {}), this.settings[name]
                },
                view: !1
            }),
            HeaderElements = Backbone.Collection.extend({
                model: HeaderElement,
                sync: function() {
                    return !1
                },
                nextOrder: function(row, col) {
                    var models = cl.header_elements.where({
                        row: row,
                        col: col
                    });
                    return models.length ? _.last(models).get("order") + 1 : 1
                },
                initialize: function() {

                },
                comparator: function(model) {
                    return model.get("order")
                },
                removeEvents: function(model) {
                },
                removeChildren: function(parent) {
                    var models = cl.shortcodes.where({
                        parent_id: parent.id
                    });
                    _.each(models, function(model) {
                        model.destroy()
                    }, this)
                },
                stringify: function(state) {
                    var models = _.sortBy(cl.shortcodes.where({
                        parent_id: !1
                    }), function(model) {
                        return model.get("order")
                    });
                    return this.modelsToString(models, state)
                },
                createShortcodeString: function(model, state) {
                    var mapped, data, tag, params, content, paramsForString = {}, mergedParams, isContainer;
                    tag = model.get("shortcode"); 
                    params = _.extend({}, model.get("params"));
                    
                    _.each(params, function(value, key) {
                        if(key != 'content'){
                            if(_.isObject(value)){
                                
                                value = JSON.stringify(value).replace(/"/g, "'");
                                value = value+'_-_json';
                                
                            }    
                            
                            paramsForString[key] = value;
                            
                        }
                    });
                        
                    mapped = cl.getMapped(tag);
                    isContainer = _.isObject(mapped) && (_.isBoolean(mapped.is_container) && !0 === mapped.is_container || !_.isEmpty(mapped.as_parent));
                        
                    content = this._getShortcodeContent(model);
                    data = {
                        tag: tag,
                        attrs: paramsForString,
                        content: content,
                        type: _.isUndefined(cl.getParamSettings(tag, "content")) && !isContainer ? "single" : ""
                    };
                    
                        
                        //_.isUndefined(state) ? model.trigger("stringify", model, data) : model.trigger("stringify:" + state, model, data);
                    return wp.shortcode.string(data)
                    
                },
            
                
                modelsToString: function(models) {
                    var string = _.reduce(models, function(memo, model) {
                        return memo + this.createShortcodeString(model)
                    }, "", this);
                    return string
                },
                _getShortcodeContent: function(parent) {
                    var models, params;
                    return models = _.sortBy(cl.shortcodes.where({
                        parent_id: parent.get("id")
                    }), function(model) {
                        return model.get("order")
                    }), models.length ? _.reduce(models, function(memo, model) {
                        return memo + this.createShortcodeString(model)
                    }, "", this) : (params = _.extend({}, parent.get("params")), _.isUndefined(params.content) ? "" : params.content)
                },
                create: function(model, options) {
                    
                    model = HeaderElements.__super__.create.call(this, model, options);
                    cl.events.trigger('headerElements:add', model);        
                    return model
                    
                }
            });
            
            
            cl.header_elements = new HeaderElements;
            
            
            
            cl.headerEl_view = Backbone.View.extend({
                
                events: {
                    "click > .cl_controls .cl_control-btn-handle": 'edit',
                    "click > .cl_controls .cl_control-btn-delete": 'destroy',
                    "click > .cl-header__icontext-icon": 'changeIcon',

                },
                
                initialize: function() {
                    _.bindAll(this, 'updateFieldEvent');
                    this.listenTo(this.model, "destroy", this.removeView);
                    this.listenTo(this.model, "change:params", this.update);
                    this.listenTo(this.model, "update:icon", this.updateIcon);
                    this.listenTo(this.collection, "add", this.update);
                  
                    
                    
                    this.listenTo(this.model, "updateField", this.updateFieldEvent);
                },

                updateIcon: function(value){
                    var fields = this.model.setting('fields');
                    
                    var field = fields['icon'];

                    var that = this;    
                    window.requestAnimationFrame(function(){that.updateField('icon', value, field) } );
                    cl.updateCustomizer();
                },

                changeIcon: function(e){
                    console.log('hereeeee');
                    _.isObject(e) && e.preventDefault() && e.stopPropagation();
                    isSVG = false;
                    if( $(e.target).is('svg') || $(e.target).parents('svg').length > 0 )
                        isSVG = true;

                    cl.changeIconDialog.render(this.model, true, {pageX: e.pageX, pageY:e.pageY}, isSVG); 
                },
                
                check_frontJS: function(){
                    var type = this.model.get('type');
                    
                    if( !_.isUndefined(CL_FRONT) && ! _.isUndefined(CL_FRONT['init_'+type]) )
                        CL_FRONT['init_'+type]();
                },
                
                inline_edit: function(){
                    var editor_params, fields = cl.getHeaderMapped(this.model.get('type'))['fields'];
             
                    _.each(fields, function(value, key){
                        if(value.type == 'inline_text'){
                            var selector = value.selector || '';
                            if(selector == '')
                                selector = this.$el;
                            else{

                                if( !_.isUndefined(value.select_from_document) && value.select_from_document){
                                    selector = $(selector);
                                }else
                                    selector = this.$el.find(selector);
                            }


                                
                       
                            if(!_.isUndefined(value.only_text) && value.only_text){
                                editor_params = {
                                    
                                    disableReturn:true,
                                    disableDoubleReturn:true,
                                    disableExtraSpaces:true,
                                    toolbar:false,
                                    anchorPreview: false
                                    
                                };
                            }else{

                                rangy.init();

                                var HighlighterButton = MediumEditor.extensions.button.extend({
                                  name: 'highlighter',

                                  tagNames: ['mark'], // nodeName which indicates the button should be 'active' when isAlreadyApplied() is called
                                  contentDefault: '<i class="cl-builder-icon-paint-brush"></i>', // default innerHTML of the button
                                  contentFA: '<i class="fa fa-paint-brush"></i>', // innerHTML of button when 'fontawesome' is being used
                                  aria: 'Highlight', // used as both aria-label and title attributes
                                  action: 'highlight', // used as the data-action attribute of the button

                                  init: function () {
                                    MediumEditor.extensions.button.prototype.init.call(this);

                                    this.classApplier = rangy.createClassApplier('highlight', {
                                      elementTagName: 'mark',
                                      normalize: true
                                    });
                                  },

                                  handleClick: function (event) {
                                    this.classApplier.toggleSelection();
                                    this.base.checkContentChanged();
                                  }
                                });


                                var DropCaps = MediumEditor.extensions.button.extend({
                                  name: 'dropcaps',

                                  tagNames: ['span'], // nodeName which indicates the button should be 'active' when isAlreadyApplied() is called
                                  contentDefault: '<i class="cl-builder-icon-font"></i>', // Default Dropcaps
                                  //contentFA: '<i class="fa fa-paint-brush"></i>', // innerHTML of button when 'fontawesome' is being used
                                  aria: 'Dropcaps', // used as both aria-label and title attributes
                                  action: 'dropcaps', // used as the data-action attribute of the button

                                  init: function () {
                                    MediumEditor.extensions.button.prototype.init.call(this);

                                    this.classApplier = rangy.createClassApplier('dropcaps', {
                                      elementTagName: 'span',
                                      normalize: true
                                    });
                                  },

                                  handleClick: function (event) {
                                    this.classApplier.toggleSelection();
                                    this.base.checkContentChanged();
                                  }
                                });

                                var BlockQuote = MediumEditor.extensions.button.extend({
                                  name: 'blockquote',

                                  tagNames: ['blockquote'], // nodeName which indicates the button should be 'active' when isAlreadyApplied() is called
                                  contentDefault: '<i class="cl-builder-icon-quote-left"></i>', // Default BlockQuote
                                  aria: 'Blockquote', // used as both aria-label and title attributes
                                  action: 'blockquote', // used as the data-action attribute of the button

                                  init: function () {
                                    MediumEditor.extensions.button.prototype.init.call(this);

                                    this.classApplier = rangy.createClassApplier('blockquote', {
                                      elementTagName: 'blockquote',
                                      normalize: true
                                    });
                                  },

                                  handleClick: function (event) {
                                    this.classApplier.toggleSelection();
                                    this.base.checkContentChanged();
                                  }
                                });

                                editor_params = {
                                    toolbar: {
                                        buttons: [
                                            'bold', 
                                            'italic', 
                                            'underline', 
                                            'subscript', 
                                            'superscript',
                                            'justifyLeft', 
                                            'justifyCenter', 
                                            'justifyRight', 
                                            'justifyFull', 
                                            'highlighter',
                                            'dropcaps',
                                            'blockquote',
                                            'removeFormat',
                                            
                                            ]
                                    },
                                    extensions: {
                                        'highlighter': new HighlighterButton(),
                                        'dropcaps' : new DropCaps(),
                                        'blockquote' : new BlockQuote()
                                      },
                                    anchorPreview: false
                                };
                            }




                            
                            if(_.isUndefined( selector[0]) )
                                return false;
                            
                            var editor = new MediumEditor(selector[0] , editor_params);
                            var that = this;
                            editor.subscribe('editableInput', function (event, editable) {
                               

                                var params = _.clone(that.model.get('params'));
                               
                                var cloned = $(editable).clone(true);
                                cloned.find('.cl_controls').remove();
                                
                                params[key] = cloned.html();
                          
                                that.model.set('params', params);
                                cl.app.updateHeader();
                            });
                            
                            editor.subscribe('focus', function(event, editable){
                               
                                $(editable).parents('.cl_element').addClass('cl-focused-text');
                            });
                            editor.subscribe('editableBlur', function(event, editable){
                                $(editable).parents('.cl_element').removeClass('cl-focused-text');
                            });
                            
                            
                            
                            
                        }  
                    }, this);
                },


                updateFieldEvent: function( data ){
                    this.updateField( data[0], data[1], data[2], data[3] );
                    cl.app.updateHeader()
                },
                
                updateField: function(field_id, field_value, field, isRequired){
                    
                    var field_type = field['type'];
                    if(!_.isUndefined(field['reloadTemplate']) && field['reloadTemplate']){
                        var $element = this.$el;
                        this.$el.addClass('loading');
                        var that = this;
                       
                        cl.header_builder.ajax({
                            action: 'cl_reload_template',
                            wp_customize: 'on',
                            nonce: scriptData.ajax_nonce,
                            type: that.model.get('type'),
                            params: that.model.get('params')
                        }, scriptData.ajax_url).done(function(html){
                            $element.html(html);
                            $element.removeClass('loading');
                            that.check_frontJS();
                        });
                        
                        return;
                    }
                    
                    /* CSS Property */
                    if(!_.isUndefined(field['selector']) && !_.isEmpty(field['selector']) && !_.isUndefined(field['css_property']) && !_.isEmpty(field['css_property']) ){
                        var $field_el = this.$el.find(field['selector']);
                        


                        if( !_.isUndefined(field['media_query']) && !_.isEmpty(field['media_query']) ){
                            var custom_css = '@media '+field['media_query'] + '{';

                                var suffix = !_.isUndefined( field['suffix'] ) ? field['suffix'] : '';
                                custom_css += '#clr_'+this.model.get('id')+' '+field['selector']+'{';
                                    custom_css += field['css_property']+': '+field_value+suffix + ' !important';
                                custom_css += '}';

                            custom_css += '}';

                            

                            if ( ! jQuery( '#codeless-custom-css-model-' + this.model.get('id') + '-' + field_id ).size() ) {
                                jQuery( 'head' ).append( '<style id="codeless-custom-css-model-' + this.model.get('id') + '-' + field_id + '"></style>' );
                            }
                            jQuery( '#codeless-custom-css-model-' + this.model.get('id') + '-' + field_id ).text( custom_css );

                        }else{
                            if(field_type == 'image'){
                               
                                if( _.isObject(field_value) && !_.isUndefined( field_value.url ) )
                                    field_value = 'url('+decodeURIComponent(field_value.url)+')';
                                else if( _.isString(field_value) )
                                    field_value = 'url('+decodeURIComponent(field_value)+')';
                            }
                             
                            if(field_type == 'slider' && !_.isUndefined(field['suffix']))
                                field_value = field_value + field['suffix']
                            
                            if( field['css_property'] == 'font-family' ){
                                if( field_value == 'theme_default' )
                                    field_value = '';
                                else{
                             
                                    WebFont.load({
                                        google: { 
                                            families: [field_value] 
                                        } 
                                    }); 
                                    field_value = field_value;
                                }

                            }
                            
                            if(_.isString(field['css_property'])){
                                if( field['css_property'] == 'font-family' ){
                                    $field_el.css({ 'font-family': field_value });
                                }
                                else
                                    $field_el.css(field['css_property'], field_value);
                            }
                            else if(_.isObject(field['css_property']) || _.isArray(field['css_property'])){
                                _.each(field['css_property'], function(prop, index){
                                    
                                    if(_.isString(prop))
                                        $field_el.css(prop, field_value);
                                    else if(_.isObject(prop) || _.isArray(prop)){
                                        var extra_css_property = prop[0];
                                        var executed = false;
                                        _.each(prop[1], function(extra_prop, key){
                                            
                                            if(key == field_value){
                                                
                                                $field_el.css(extra_css_property, extra_prop);
                                                if(extra_prop == 'cover'){
                                                    $field_el.addClass('bg_cover');
                                                }
                                                executed = true;
                                                return;
                                                
                                            }else if(key == 'other' && !executed){
                                                
                                                if(extra_css_property == 'background-size')
                                                    $field_el.removeClass('bg_cover');
                                                    
                                                $field_el.css(extra_css_property, extra_prop);
                                                
                                            }
                                            
                                        });
                                    }    
                                    
                                });
                            }
                        }

                        
                        
                    }
                    
                    /* addClass */
                    if(!_.isUndefined(field['selector']) && !_.isEmpty(field['selector']) && !_.isUndefined(field['addClass']) && !_.isEmpty(field['addClass']) ){
                        var $field_el = this.$el.find(field['selector']);
                        
                        if(field_value)
                            $field_el.addClass(field['addClass']);
                        else
                            $field_el.removeClass(field['addClass']);
                    }
                    
                    
                    /* htmldata */
                    if(!_.isUndefined(field['selector']) && !_.isEmpty(field['selector']) && !_.isUndefined(field['htmldata']) && !_.isEmpty(field['htmldata']) ){
                        var $field_el = this.$el.find(field['selector']);
                        
                        if(field_value != 'none')
                            $field_el.attr('data-'+field['htmldata'], field_value);
                        else
                            $field_el.attr('data-'+field['htmldata'], '0');
                    }
                    
                    
                    
                    /* Select Class */
                    if(!_.isUndefined(field['selector']) && !_.isEmpty(field['selector']) && !_.isUndefined(field['selectClass']) ){
                        var $field_el = this.$el.find(field['selector']);
                        
                        if( field_type == 'select_icon' ){
                            this.$el.find(field['selector']).each(function(){
                                $(this)[0].className = '';
                            });
                        }else{
                            _.each(field['choices'], function(choice, index){
                                $field_el.removeClass(field['selectClass']+index); 
                            });
                        }
                        
                        
                        if(_.isString(field_value))
                            $field_el.addClass(field['selectClass']+field_value);
                        else if(_.isObject(field_value) || _.isArray(field_value)){
                            _.each(field_value, function(value, key){
                                 $field_el.addClass(field['selectClass']+value);
                            });
                        }
                            
                    }
                    
                    /* Custom Function */
                    if(_.isFunction(this['inlineEdit_'+this.model.get('shortcode')+'_'+field_id])){
                        this['inlineEdit_'+this.model.get('shortcode')+'_'+field_id](field_id, field_value);
                    }else if(_.isFunction(this['inlineEdit_'+field_id])){
                        this['inlineEdit_'+field_id](field_id, field_value, field);
                    }
                    
                    
                    if(!_.isUndefined(field['customJS']) && !_.isEmpty(field['customJS']) && _.isString( field['customJS'] ) ){
                        this[field['customJS']](field_id, field_value);
                    }

                    if(!_.isUndefined(field['customJS']) && !_.isEmpty(field['customJS']) && !_.isUndefined(field['customJS']['front']) ){
                        if( !_.isUndefined(field['customJS']['params']) )
                            window[field['customJS']['front']](field['customJS']['params'], true);
                        else
                            window[field['customJS']['front']](null, true);
                    }
                    
                    
                    if(field_type == 'css_tool'){
                        var $field_el = this.$el.find(field['selector']);

                        if( _.isUndefined( field['media_query'] ) ){
                            
                            
                            if(field_value != null && _.isObject(field_value) )
                                $field_el.css(field_value);
                           
                        }else{

                            var custom_css = '@media '+field['media_query'] + '{';

                                custom_css += '#clr_'+this.model.get('id')+' '+field['selector']+'{';

                                    if( _.isObject( field_value ) ){
                                        _.each(field_value, function(subvalue, subkey){
                                            custom_css += subkey+': '+subvalue + ' !important; ';
                                        });
                                    }
                                    
                                custom_css += '}';

                            custom_css += '}';

                            

                            if ( ! jQuery( '#codeless-custom-css-model-' + this.model.get('id') + '-' + field_id ).size() ) {
                                jQuery( 'head' ).append( '<style id="codeless-custom-css-model-' + this.model.get('id') + '-' + field_id + '"></style>' );
                            }
                            jQuery( '#codeless-custom-css-model-' + this.model.get('id') + '-' + field_id ).text( custom_css );
                        }
                        
                    }

                    if( field_type == 'inline_text' ){
                        var $field_el = this.$el.find( field['selector'] );
                        $field_el.html( field_value );
                    }
                    
                   
                    /*if(!_.isUndefined(cl_required) ){
                        
                        var fields = this.model.setting('fields');
                        var params = this.model.get('params');
                        var operators = {
                           '==': function(a, b){ return a==b},
                           '!=': function(a, b){ return a!=b}
                        };

                        _.each(cl_required, function(opt, index){
                            var field_id = opt['setting'],
                                field_val = !_.isUndefined(params[opt['setting']]) ? params[opt['setting']] : fields[field_id]['default'],
                                field = fields[field_id],
                                new_cl_required = null;
                            
                            if(!_.isUndefined(cl_required[field_id]))
                                new_cl_required = cl_required[field_id];
                         
                            if( operators[opt['operator']](field_value, opt['value'] ) )   
                              this.updateField(field_id, field_val, field, new_cl_required);
                            else
                              // Reverse Update
                              this.updateReverseField(field_id, field_val, field);
                            
                        }, this);
                        
                    }*/
                },
                
                
                destroy: function(e) {
                    
                    _.isObject(e) && e.preventDefault() && e.stopPropagation();
                    var answer = confirm("Are you sure to delete this "+this.model.setting('label')+" ?");
                    return !0 !== answer ? !1 : (cl.showMessage(this.model.setting("label") + ' deleted successfully' ), void this.model.destroy(), cl.app.updateHeader() )
                    
                },
                
                edit: function(){
                    cl.app.showEditPanel(this.model);
                },
                
                
                render: function() {
                    this.$el.attr("data-model-id", this.model.get("id"));
                    this.$el.attr('id', 'h_el_'+this.model.get("id"));
                    var type = this.model.get("type");
                    this.$el.attr("data-type", type);
                    this.$el.addClass("cl_" + type);

                    //this.addControls();

                    this.inline_edit();
                    
                    return this;
                },
                
                update: function(e){
                    
                },
                
                removeView: function(model) {
                    this.remove();
                    //cl.builder.notifyParent(this.model.get("parent_id"));
                    
                },
                
            });
            

            cl.active_dialog = false;
            
            cl.closeActiveDialog = function(model) {
                return _.isUndefined(cl.active_dialog) ? false : cl.active_dialog.hide();
            },
            
            cl.dialogView = Backbone.View.extend({
               
               events:{
                    "click > .close_dialog" : "hide"
               },
               
               initialize: function(){
                   
               },
               
               render: function(){
                    var self= this;
                    $('body').on('click', function(e){

                        if( $( e.target ).parents('.cl_dialog').length == 0 )
                            self.hide(e);
                    });
               },
               
               show: function(){
                   if(!this.$el.hasClass('cl_active_dialog')){
                       cl.closeActiveDialog();
                       cl.active_dialog = this;
                       this.$el.css({ visibility: 'visible'});
                      
                       var that = this;
                       _.defer(function(){that.$el.addClass('cl_active_dialog');});
                       
                       this.$el.focus();
                   }
                   
               },
               
               hide: function(e){
                    _.isObject(e) && e.preventDefault();
                    $('.cl_active_dialog').removeClass('cl_active_dialog').css({ visibility:''});
               },
               
                setPosition: function(coord){
                    var win_width = $(window).width();
                    if( coord.pageX + 500 <= win_width )
                        this.$el.css({left:coord.pageX, top:coord.pageY})
                    else
                        this.$el.css({left: ( coord.pageX - 500 ), top:coord.pageY})
                },
 
            });
            
            cl.change_icon_dialog = cl.dialogView.extend({
                events:{
                    'click .icon': 'changedIcon',
                    "click > .close_dialog" : "hide",
                    "input #search" : "searchElements",
                },

                searchElements: function(e){

                    var value = $(e.target).val();
                    var selected = this.$el.find( ".icons-wrapper .icon[data-value*='"+value+"']" );

                    this.$el.find( ".icons-wrapper .icon" ).not(selected).css('display', 'none');
                    selected.css('display', 'block');

                    if( value == '' )
                        this.$el.find( ".icons-wrapper .icon" ).css('display', 'block');
                },
                
                changedIcon: function(e){
                    var new_value = '';

                    if( $( e.target ).is('i') )
                       new_value = $(e.target).parent().data('value');
                    else
                       new_value = $(e.target).data('value');

                    var params = this.model.get('params');
                  
                    params['icon'] = new_value;

                    this.model.save({params:params});
                    if(this.isSVG)
                        this.model.trigger( 'update:svg', new_value.replace('cl-icon-', 'cl-svg-') );
                    else{
                     
                        this.model.trigger( 'update:icon', new_value );
                    }
                },
                
                initialize: function(){
                    cl.change_icon_dialog.__super__.initialize.call(this);
                },
                
                render: function(model, prepend, coordinate, isSVG){
                    this.model = _.isObject(model) ? model : !1;
                    this.isSVG = isSVG;
                    cl.active_dialog = this;
                    this.setPosition(coordinate); 
                    this.show();
                    return cl.change_icon_dialog.__super__.render.call(this);
                },
            });
            
            
            cl.add_header_element_dialog = cl.dialogView.extend({
                events:{
                    "click .elements_ .element" : "createElement",
                    "click > .close_dialog" : "hide"
                },
                
                initialize: function(){
                    cl.add_header_element_dialog.__super__.initialize.call(this);
                },
                
                render: function(row, col, prepend, coordinate){
                    
                    _.isUndefined(cl.HeaderBuilder) || (this.builder = new cl.HeaderBuilder);
                    this.prepend = _.isBoolean(prepend) ? prepend : false;
                    this.row = !_.isEmpty(row) ? row : 'main';
                    this.col = !_.isEmpty(col) ? col : 'left';
                    
                    cl.active_dialog = this;
                    this.setPosition(coordinate); 
                    this.show();
                    return cl.add_header_element_dialog.__super__.render.call(this);
                },
                
                createElement: function(e){
                    e.preventDefault();
                    
                    var $control = $(e.currentTarget),
                        type = $control.data("type");
                    
                    var _params = cl.getHeaderDefaultParams(type);
                    var order_new = !this.prepend ? cl.header_elements.nextOrder(this.row, this.col) : 0;
                    var element = {
                        type: type,
                        order: order_new,
                        params: _params,
                        row: this.row,
                        col: this.col
                    }
                    this.prepend ? cl.activity = 'prepend' : cl.activity = false;
                    
                    this.builder.create(element);
                    
                    this.model = this.builder.last();
                    this.hide();
                    cl.app.showEditPanel(this.model);
                    this.builder.render();
                    cl.updateCustomizer();
                    
                    
                    
                }
                
            });
            
    
}(window.jQuery, wp.customize));


/* cl-header-builder.js */

(function($){
    
    
    cl.HeaderBuilder = function(models){
        this.models = models || [];
        this.is_build_complete = !0;
        
        return this;
    };
    
    cl.HeaderBuilder.prototype = {
        
        create: function(attributes) {
            this.is_build_complete = !1;
            this.models.push(cl.header_elements.create(attributes));
            return this;
        },
        render: function(callback) {
            
            var elements;
            
            elements = _.map(this.models, function(model) {
                
                
                return {
                    id: model.get("id"),
                    type: model.get('type'),
                    row: model.get('row'),
                    col: model.get('col'),
                    params: model.get('params')
                }
            }, this);
            
            this.build(elements, callback);
        },
        
        last: function() {
            return this.models.length ? _.last(this.models) : !1
        }, 
        
        build: function(elements, callback) {
            
            
            this.ajax({
                action: "cl_load_header_element",
                elements: elements,
                wp_customize: 'on',
            }, scriptData.ajax_url).done(function(html) {
                
                
                
                _.each($(html), function(block) {
                    this.renderBlock(block)
                }, this);
                
                _.isFunction(callback) && callback(html);
                cl.app.setHeaderSortable();
                cl.activity = false;
                //cl.app.setResizable();
                
                this.models = [];
                //this.showResultMessage();
                this.is_build_complete = !0
            })
        },
        
        ajax: function(data, url) {
            
            return this._ajax = $.ajax({
                url: url || scriptData.ajax_url,
                type: "POST",
                dataType: "html",
                data: _.extend({

                }, data),
                
                context: this
            })
        },
        
        
        renderBlock: function(block){
            var $html, model, $this = $(block);
            model = cl.header_elements.get($this.data("modelId"));
            $html = $this;
            
            if(model){
                var view_name;
                view_name = this.getView(model);
                
                if(!model.get("from_content") && !model.get("from_template")){
                    var container = $('[data-row="'+model.get('row')+'"] [data-col="'+model.get('col')+'"]');
                    if(cl.activity == 'prepend'){
                        container.prepend($html);
                    }else
                        container.append($html);
                        
                    cl.app.updateHeader();
                }
                
                model.view = new view_name({
                        model: model,
                        el: $html
                }).render();
            }
        },
        
        getView: function(model) {
            var view = cl.headerEl_view;
            _.isObject(cl["headerElView" + model.get("type")]) && (view = cl["headerElView" + model.get("type")]);

            return view;
            
        },
        
        
        buildFromArray: function(){
            var $this = this;
            
            _.each(cl.header_elements_var, function(element) {
                
                var $block = $('body .cl-header').find("[data-model-id=" + element.id + "]");
                
                var params =  _.isObject(element.params) ? element.params : {};
                var model = cl.header_elements.create({
                        
                        id: element.id,
                        type: element.type,
                        params: params,
                        row: element.row,
                        col: element.col,
                        from_content: true
                    }, {  silent: !0 }
                    
                );
                
                $block.attr("data-model-id", model.get("id"));
                $this.renderBlock($block);
            });
            
            cl.app.setHeaderSortable();
            //cl.app.setResizable();
        },
        
    };
    
    cl.header_builder = new cl.HeaderBuilder();
    
    
    
}(window.jQuery));

/* cl-codeless-app.js */

(function($) {
    
    cl.CodelessApp = Backbone.View.extend({
        
        el: "body",
        mode: "view",
        events: {
            'click > #viewport .cl-header .add-header-element-prepend' : 'addHeaderElementPrepend',
            'click > #viewport .cl-header .add-header-element-append' : 'addHeaderElementAppend',

        },
        initialize: function() {
            _.bindAll(this, "saveHeaderElementOrder");
            wp.customize.preview.bind('cl_element_updated', this.fieldUpdated);
            
        },

        fieldUpdated: function(item){
           
            var model_id = item[0], 
                element_type = item[1], 
                model = item[5] ? cl.header_elements.get(model_id) : cl.shortcodes.get(model_id),
                field_id = item[2],
                field_value = item[3],
                isRequired = item[4];

            
            if( _.isUndefined( model ) )
                return;
                       
            var params = _.clone( model.get('params'));

            if( _.isEmpty(params) )
                        params = {};

            var fields = model.setting('fields');
            var field = fields[field_id];
            
            if( field['type'] == 'switch' )
                field_value = field_value ? 1 : 0;

            if( field['type'] == 'image' && _.isObject( field_value ) )
                field_value = { id: field_value.id, url: encodeURIComponent(field_value.url) };

            params[field_id] = field_value;
                    
            
                
            model.set({params: params});

            window.requestAnimationFrame(function(){
                
                _.defer( function(){
                    
                    model.trigger('updateField', [field_id, field_value, field, isRequired] );
                });
                    
                
            } );
                  //this.updateField(field_id, field_value, field, cl_required, subKey);        
            
        },

        changeObjectParams: function(model){
            var params = _.clone(model.get('params'));
            _.each(params, function(value, key){
                if( !_.isUndefined(value) && !_.isNull(value) && value.length && value.indexOf("_-_json") !== -1){
                    value = value.replace(/'/g, '"');
                    value = value.replace("_-_json", '');
                    value = jQuery.parseJSON(value);
                    
                    params[key] = value;
                } 
            });
            
            model.set('params', params);

        },
        
        showEditPanel: function(model){
            var data = {},
                elementType = _.isUndefined(model.get('shortcode')) ? 'header_el' : 'shortcode';
                type = (elementType == 'header_el') ? model.get('type') : model.get('shortcode');
            
            if(elementType == 'header_el'){
                var el = cl.getHeaderMapped(type);
                if(!_.isUndefined(el['open_section']) && !_.isEmpty(el['open_section'])){
                    wp.customize.preview.send('cl_show_section', el['open_section'] );
                    return;
                }
            }
            
            
            data['id'] = model.get('id');
            data['type'] = type;
            data['options'] = _.clone( model.get('params') );
        
            wp.customize.preview.send('cl_show_options', data );  
        },
        
        render: function(){
            
            cl.$page = this.$el.find("#content");
            
            
            /*window.parent.wp.customize.previewer.unbind('refresh').bind('refresh', function(){
                
            })*/
            
            cl.n = '';
            
            
            
           
            //$(window).resize(this.resizeWindow);
            _.defer(function() {
                cl.events.trigger("app.render")
            });


            $("body").on('click', function(e){
                if( $( e.target ).parents('.cl-selected-element').length == 0 && ! e.shiftKey )
                    cl.$page.find('.cl-selected-element').removeClass('cl-selected-element');
            });
            
            return this
        },
        
    
        addHeaderElementPrepend: function(e){
            e.preventDefault();
            var row = $(e.currentTarget).closest('.cl-header__row').data('row');
            var col = $(e.currentTarget).closest('.cl-header__col').data('col');
            
            cl.addHeaderElementDialog.render(row, col, true, {pageX: e.pageX, pageY:e.pageY});
        },
        
        addHeaderElementAppend: function(e){
            e.preventDefault();
            var row = $(e.currentTarget).closest('.cl-header__row').data('row');
            var col = $(e.currentTarget).closest('.cl-header__col').data('col');
            
            cl.addHeaderElementDialog.render(row, col, false, {pageX: e.pageX, pageY:e.pageY});
        },
        
        
        
        saveRowOrder: function() {
            _.defer(function(app) {
                
                var row_params, column_params, $rows = cl.$page.find(".cl_root-element");
            
                $rows.each(function(key, value) {
                    var $this = $(this);
                    cl.shortcodes.get($this.data("modelId")).save({
                        order: key
                    }, {
                        silent: !0
                    })
                });
                
                cl.updateCustomizer();
            }, this)
        },

        fixElementOrder: function(model) {
            setTimeout(function() {

                var parent_id = model.get('parent_id'),
                    parent_model = cl.shortcodes.get(parent_id);

                var $elements = !_.isUndefined(parent_model) ? parent_model.view.content().find(' > [data-model-id]') : cl.$page.find(".cl_root-element");

                $elements.each(function(key, value) {
                    var $this = $(this);
                    cl.shortcodes.get($this.data("modelId")).save({
                        order: key
                    }, {
                        silent: !0
                    })
                });
                
                cl.updateCustomizer();
            }, 100)
        },
            
      
        saveHeaderElementOrder: function(event, ui) {
            _.defer(function(app, e, ui) {
                if (_.isNull(ui.sender)) {
                    var $column = ui.item.parent(),
                        $elements = $column.find("> [data-model-id]");
                        
                    $column.find("> [data-model-id]").each(function(key, value) {
                            
                        var model, prev_row, prev_col, current_row, current_col, $element = $(this),
                            prepend = !1;
                            
                        model = cl.header_elements.get($element.data("modelId"));
                        prev_row = model.get("row");
                        prev_col = model.get("col");
                        current_row = $column.parents(".cl-header__row:first").data("row");
                        current_col = $column.data("col");
                        
                        model.save({
                            order: key,
                            row: current_row,
                            col: current_col
                        });
                        
                        
                            
                    })
                }
                
                app.updateHeader();
                
            }, this, event, ui)
        },
        
        updateHeader: function(){
            var data = [];
            data  = _.groupBy(cl.header_elements.models, function(model){
                        return model.get('row');
                    });
                    
                    _.each(data, function(key, index){
                        data[index] = _.groupBy(key, function(model){
                            return model.get('col');
                        });
                        _.each(data[index], function(col, index_col){
                            data[index][index_col] = _.sortBy(data[index][index_col], function(model){
                                return model.get('order');
                            });
                        });
                    });
                
                window.wp.customize.preview.send('cl_header_builder_update', data);
                cl.updateCustomizer();
        },
            
        saveColumnOrder: function(event, ui) {
            _.defer(function(app, e, ui) {
                var row = ui.item.parent();
                row.find("> [data-model-id]").each(function() {
                    var $element = $(this),
                        index = $element.index();
                    cl.shortcodes.get($element.data("modelId")).save({
                        order: index
                    })
                })
                cl.updateCustomizer();
            }, this, event, ui);
        },
        
        renderHeaderPlaceholder: function(event, element) {
            var tag = $(element).data("type");
            var $helper = $('<div class="cl_helper cl_helper-' + tag + '"> "' + cl.headerMap[tag].label + "</div>").prependTo("body");

            return $helper
        },
        
        placeElement: function($view, activity) {
            var model = cl.shortcodes.get($view.data("modelId"));

            if(activity == 'replace' && cl.$page.find('[data-model-id='+model.get("id")+']').length > 0 ){
                var toReplace = cl.$page.find('[data-model-id='+model.get("id")+']');
                toReplace.replaceWith($view);
                
                setTimeout(function(){
                    $view.removeClass('loading');
                },150);
                return;
            }
            
            if( model.get('shortcode') != 'cl_page_header' )
                cl.$page = this.$el.find('.cl-content-builder');
            else
                cl.$page = this.$el.find("#content");

            if( activity != 'replace' ){
                model && model.get("place_after_id") ? ($view.insertAfter(cl.$page.find("[data-model-id=" + model.get("place_after_id") + "]")), model.unset("place_after_id")) : _.isString(activity) && "prepend" === activity ? $view.prependTo(cl.$page) : $view.appendTo(cl.$page);
                setTimeout(function(){
                    cl.$page.removeClass('loading');
                },150);
            }
            
            
            cl.activity = false;
        },
 
        
        setHeaderSortable: function(){
            $(".cl-header__col").sortable({
                forcePlaceholderSize: !0,
                helper: this.renderHeaderPlaceholder,
                distance: 3,
                scroll: !0,
                scrollSensitivity: 70,
                cursor: "move",
                cursorAt: {
                    top: 20,
                    left: 16
                },
                connectWith: ".cl-header__col",
                items: "> [data-model-id]",
                cancel: ".cl-non-draggable",
                handle: ".cl_element-move",
                start: function(e, ui){
                    $('body').addClass('cl-move-start'); 
                    
                },
                update: this.saveHeaderElementOrder,
                change: function(event, ui) {
                    
                    ui.placeholder.height(60), ui.placeholder.width(100)
                },
                placeholder: "cl_placeholder",
                tolerance: "pointer",
                over: function(event, ui) {
                    
                    
                },
                out: function(event, ui) {
                    ui.placeholder.removeClass("cl_hidden-placeholder");
                    
                    //ui.placeholder.closest(".cl_element.cl_cl_row").removeClass('cl_sorting-over');
                },
                stop: function(event, ui) {
                    
                    $('body').removeClass('cl-move-start');
                    ui.placeholder.removeClass("cl_hidden-placeholder");
                }
            });
        },

        openPageSettings: function(e){
            e.preventDefault();
            wp.customize.preview.send( 'cl_open_page_settings', { pageID: cl.pageID, section: 'post['+cl.postType+']['+cl.pageID+']' } );
        },

        openGlobalStyling: function(e){
            e.preventDefault();
            wp.customize.preview.send( 'cl_open_global_styling' );
        },

        addNewPage: function(e){
            e.preventDefault();
            wp.customize.preview.send( 'cl_add_new_page', { postType: 'page' } );
        },

        previewPage: function(e){
            e.preventDefault();
            window.open(wp.customize.settings.url.self, '_blank');
        }
        
        /*setResizable: function(){
            var sibTotalWidth;
            var container;
            var handle = 'e';
            var dir;
            $('.cl_cl_column.cl_element').each(function(){
                var $el = $(this);
                if($el.next().next().length == 0)
                    handle = '';
                if($el.next().length == 0)
                    handle = 'w';
                if($el.next().length == 0 && $el.prev().length == 0)
                    handle = '';
                    
                if(handle != ''){
                    var current_model, current_width;
                    
                    $el.resizable({
                        handles: handle,
                        start: function(event, ui){
                            current_model = cl.shortcodes.get(ui.originalElement.data('model-id'));
                            current_width = current_model.getParam('width');
                            ui.originalElement.removeClass(current_model.view.convertSize(current_width).replace(/[^\d]/g, ""));
                            /*container = ui.element.closest('.cl_row-sortable');
                            sibTotalWidth = ui.originalSize.width + ui.originalElement.next().outerWidth();
                        },
                        stop: function(event, ui){     
                            var cellPercentWidth=100 * ui.originalElement.outerWidth()/ container.innerWidth();
                            ui.originalElement.css('width', cellPercentWidth + '%');  
                            var nextCell = ui.originalElement.next();
                            var nextPercentWidth=100 * nextCell.outerWidth()/container.innerWidth();
                            nextCell.css('width', nextPercentWidth + '%');
                        },
                        resize: function(event, ui){ 
                            
                            var delta_x = ui.size.width - ui.originalSize.width;
                            var delta_y = ui.size.height - ui.originalSize.height;
                            if (delta_x > 0) { 
                                //dir = 'left';
                                if(handle == 'w')
                                    dir = 'larger';
                                else
                                    dir = 'lower';
                            } else if (delta_x < 0) { 
                                //dir = 'right';
                                if(handle == 'w'){
                                    dir = 'lower'
                                }else
                                    dir = 'larger'
                            }
                            var _a = _.omit(current_model.get('params'));
                            _a.width = '1/1';
                            current_model.set('params', _a);
                            current_model.view.setColumnClasses();
                            
                            
                            
                           
                        }
                    });
                 }
            });
        }*/
    });
   

}(window.jQuery));



/* cl-main.js */

(function($, api) {
    
    "use strict";
    
    cl.events = _.extend({}, Backbone.Events);

    cl.clone_index = 1;
    
    cl.createPreLoader = function() {
        cl.$preloader = $("#cl_preloader");
    };
    
    cl.updateCustomizer = function(){
        
        wp.customize.preview.send( 'cl_update_customizer' ); 
        
    };
    
    
    cl.updateContent = function( content ){
        
    };

    cl.getPageContent = function( ){
        return api( 'cl_page_content' ).get();
    };
    
    cl.removePreLoader = function() {
        cl.$preloader && cl.$preloader.remove();
        
        $('.cl-loading-overlay', window.parent.document).css('opacity', 0);
            setTimeout(function(){
                $('.cl-loading-overlay', window.parent.document).remove();
        }, 400);

        if( $('.cl-simple-mode', window.parent.document).length > 0 ){
            $('.cl-sticky-panel').remove();
            $('.cl-custom-post-button').remove();
            $('.cl-add-custom-post-button').remove();
        }
    };
    
    cl.buildRestrictions = function() {
        cl.shortcode_restrictions = {};
        _.each(cl.map, function(object) {
            _.isObject(object.as_parent) && _.isString(object.as_parent.only) && (cl.shortcode_restrictions["parent_only_" + object.settings] = object.as_parent.only.replace(/\s/, "").split(","));
            _.isObject(object.as_parent) && _.isString(object.as_parent.except) && (cl.shortcode_restrictions["parent_except_" + object.settings] = object.as_parent.except.replace(/\s/, "").split(","));
            _.isObject(object.as_child) && _.isString(object.as_child.only) && (cl.shortcode_restrictions["child_only_" + object.settings] = object.as_child.only.replace(/\s/, "").split(","));
            _.isObject(object.as_child) && _.isString(object.as_child.except) && (cl.shortcode_restrictions["child_except_" + object.settings] = object.as_child.except.replace(/\s/, "").split(","));
        });
    };
    
    cl.checkRestrictions = function(tag, related_tag) {
        return _.isArray(cl.shortcode_restrictions["parent_only_" + tag]) && !_.contains(cl.shortcode_restrictions["parent_only_" + tag], related_tag) ? !1 : _.isArray(cl.shortcode_restrictions["parent_except_" + tag]) && _.contains(cl.shortcode_restrictions["parent_except_" + tag], related_tag) ? !1 : _.isArray(cl.shortcode_restrictions["child_only_" + related_tag]) && !_.contains(cl.shortcode_restrictions["child_only_" + related_tag], tag) ? !1 : _.isArray(cl.shortcode_restrictions["child_except_" + related_tag]) && _.contains(cl.shortcode_restrictions["child_except" + related_tag], tag) ? !1 : !0
    };
    
    cl.CloneModel = function(builder, model, parent_id, child_of_clone, append) {
        cl.clone_index /= 10;
        var newOrder, params, tag, data, newModel;
        
        newOrder = _.isBoolean(child_of_clone) && !0 === child_of_clone ? model.get("order") : parseFloat(model.get("order")) + cl.clone_index;
        params = _.clone( model.get('params') );

        if( !_.isUndefined( params['css_style'] ) )
                params['css_style'] = _.clone( params['css_style']);

        tag = model.get("shortcode");
        data = {
            shortcode: tag,
            parent_id: parent_id,
            order: _.isBoolean(append) && append === true ? false : newOrder,
            cloned: !0,
            cloned_from: model.toJSON(),
            params: params
        };

        cl["cloneMethod_" + tag] && (data = cl["cloneMethod_" + tag](data, model));
        if ( ! (_.isBoolean(child_of_clone) && true === child_of_clone ) && ! ( _.isBoolean(append) && append === true ) ) {
          data.place_after_id = model.get("id");
        }
        
        builder.create(data);
        newModel = builder.last();

        _.each(cl.shortcodes.where({
                parent_id: model.get("id")
        }), function(shortcode) {
                cl.CloneModel(builder, shortcode, newModel.get("id"), !0)
        }, this);

        return newModel;
    };
    
    cl.showMessage = function(message) {
        cl.message_timeout && ($(".cl_message").remove(), window.clearTimeout(cl.message_timeout));
        var $message = $('<div class="cl_message success" style="z-index: 999;">' + message + "</div>").prependTo($("body"));
        _.defer(function(){$message.addClass('show');});
        cl.message_timeout = window.setTimeout(function() {
            $message.removeClass('show');
            _.defer(function(){ $(this).remove() });
            cl.message_timeout = !1;
        }, 3000);
    };
    
    cl.createPreLoader();
    
    cl.build = function() {

        cl.addHeaderElementDialog = new cl.add_header_element_dialog({ el: '#cl_dialog_add_header_element' });
        cl.changeIconDialog = new cl.change_icon_dialog({ el: '#cl_dialog_change_icon' });
        cl.app = new cl.CodelessApp;
        
        cl.buildRestrictions();
        cl.app.render();

        cl.header_builder.buildFromArray();
        
        //cl.removePreLoader(); 

        $(window).trigger("cl_build");
    };
    
    api.bind( 'preview-ready', function(){
        window['CL_FRONT'].config.$isCustomizer = true;

        
        setTimeout(function(){
            cl.build();
        }, 100);
        

    });
    
    /*parent.wp.customize.previewer.bind( 'changeset-save', function(event, data){
        
    });*/
    
    
}(window.jQuery, wp.customize));