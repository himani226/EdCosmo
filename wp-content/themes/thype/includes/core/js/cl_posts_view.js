(function($){

        window.ClPostsView = vc.shortcode_view.extend({
            changeShortcodeParams: function(model) {
                var tag, params, settings;
                window.ClPostsView.__super__.changeShortcodeParams.call(this, model);
                params = model.get("params");
                tag = model.get("shortcode");
                settings = vc.map[tag];

                if( params['module'] == 'grid-blocks' ){
                    //this.$el.find("> .wpb_element_wrapper .wpb_element_title i").remove();
                
                    _.each(settings.params, function(param_settings) {
                        if( param_settings.param_name == 'grid_block_type' ){
                            var inverted_value = _.invert(param_settings.value);
                            var option_value = params['grid_block_type'];
                            var url = inverted_value[option_value];
                            if( this.$el.find("> .wpb_element_wrapper img").length == 0  )
                                this.$el.find("> .wpb_element_wrapper .title").after('<img class="vc_admin_label" src="'+url+'" />');
                            else
                                this.$el.find("> .wpb_element_wrapper img").attr('src', url);
                        }
                        
                    }, this);
                }
                
            }
        });
})(jQuery);