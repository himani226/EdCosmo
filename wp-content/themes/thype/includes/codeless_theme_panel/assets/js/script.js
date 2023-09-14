(function( $ ) {
    'use strict';

    $.codeless_welcome = $.codeless_welcome || {};

    $.codeless_header_setup = $.codeless_header_setup || {};

    $.codeless_footer_setup = $.codeless_footer_setup || {};

    $( document ).ready(

        function() {
            $.codeless_welcome.initQtip();
            $.codeless_welcome.register();
            $.codeless_welcome.removepurchasecode();
            if ( jQuery( document.getElementById( "support_div" ) ).is( ":visible" ) ) {
                $.codeless_welcome.initSupportPage();
            }
            $.codeless_welcome.supportHash();

            $.codeless_welcome.demo_importer_dialog();
            $.codeless_welcome.headers_importer_dialog();
            $.codeless_welcome.footers_importer_dialog();
        });

    
    $.codeless_welcome.demo_importer_dialog = function(){
        $( '.demos:not(.headers):not(.footers) .demo_link' ).on('click', function(e){
            var $link = $(this);
            e.preventDefault();
            var demo_id = $link.data('demoId');
            var parts = $link.data('parts');
            var home_slug = $link.data('homeSlug');
            var header = $link.data('header');
            var footer = $link.data('footer');

            var confirm_install = confirm("By confirming this, all customize options, widgets and menu will be overwrite. Only pages and posts will stay unmodified.");
            if( confirm_install ){
                tb_remove();
                $.codeless_welcome.start_import(demo_id, parts, home_slug, header, footer);
            }

        });
    };

    $.codeless_welcome.headers_importer_dialog = function(){
        $( '.demos.headers:not(.footers) .demo_link' ).on('click', function(e){
            var $link = $(this);
            e.preventDefault();
            var demo_id = $link.data('demoId');

            var confirm_install = confirm("By confirming this, all customize options, widgets and menu will be overwrite. Only pages and posts will stay unmodified.");
            if( confirm_install ){
                tb_remove();
                $.codeless_header_setup.start_import(demo_id);
            }

        });
    };

    $.codeless_welcome.footers_importer_dialog = function(){
        $( '.demos.footers .demo_link' ).on('click', function(e){
            var $link = $(this);
            e.preventDefault();
            var demo_id = $link.data('demoId');

            var confirm_install = confirm("By confirming this, all customize options, widgets and menu will be overwrite. Only pages and posts will stay unmodified.");
            if( confirm_install ){
                tb_remove();
                $.codeless_footer_setup.start_import(demo_id);
            }

        });
    };

    $.codeless_welcome.start_import = function(demo, parts, home_slug, header, footer){


      var Progress = function() {
        this.$el = $( this.markup );
        this.$bar = this.$el.find('.progress-bar-inner');
        this.parts = ['install_plugins', 'import_content', 'import_options', 'import_menus', 'import_widgets', 'import_extra'];
        this.part_in_progress = 0;
      }

      $.extend( Progress.prototype, {

        markup: '<div class="cl-modal">'
          + '<div class="wrapper">'
            +'<div class="inner">'
                + '<div class="progress">'
                  + '<div class="progress-bar-outer">'
                    + '<div class="progress-bar-inner"></div>'
                  + '</div>'
                  + '<div class="in-progress">'
                    + '<span id="install_plugins" data-start-point="0" data-end-point="15">Install Required Plugins</span>'
                    + '<span id="import_content" data-start-point="16" data-end-point="65">Import Template Dummy Content</span>'
                    + '<span id="import_options" data-start-point="66" data-end-point="80">Import Options</span>'
                    + '<span id="import_menus" data-start-point="81" data-end-point="90">Import Menus</span>'
                    + '<span id="import_widgets" data-start-point="91" data-end-point="96">Import Widgets</span>'
                    + '<span id="import_extra" data-start-point="97" data-end-point="100">Import Extra</span>'
                  + '</div>'
                + '</div>'
                + '<div class="progress-complete">'
                +  '<div class="progress-complete-icon dashicons dashicons-yes"></div>'
                +  '<div class="progress-complete-title">Installation Complete with Success!</div>'
                + '</div>'
                + '<div class="progress-fail">'
                +  '<div class="progress-fail-title">Installation Failed!</div>'
                +  '<div class="desc">Please try again to install the demos, or if you have repeated problems contact our support forum. Thank You!</div>'
                + '</div>'
            + '</div>'
          + '</div>'
        + '</div>',

        start: function() {
         
          $( 'body' ).append( this.$el );

          setTimeout( function() {
            this.$el.addClass( 'active' );
          }.bind( this ), 0 )

        },

        startPart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.addClass('in_progress');
            var startPoint = $select.data('startPoint');
            var endPoint = $select.data('endPoint');
            var alltime = 360000;

            var speed = ( alltime * (endPoint - startPoint) ) / 100;
            console.log(speed);
            this.setProgress( endPoint, speed );
        },

        completePart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.removeClass('in_progress').addClass('complete');
            var endPoint = $select.data('endPoint');

            this.setProgress( endPoint, 250 );
        },

        setProgress: function( progress, speed ) {

          this.$bar.stop().animate( { width: progress + '%' }, speed );
        },

        complete: function() {

          this.$bar.animate( { width: '100%' }, 250 );
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-complete').addClass('show');

          setTimeout(function(){
            this.close();
          }.bind(this), 400 )

        },

        fail: function( message ) {
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-fail').addClass('show');
          this.$el.find('.progress-fail').find('.desc').prepend('<p style="color:red;">' + message + '<p>');
          setTimeout(function(){
            this.close();
          }.bind(this), 2000);
          
        },

        close: function() {

          setTimeout( function(){
            this.$el.removeClass( 'active' );
          }.bind( this ), 1500 );

          setTimeout(function(){
            //this.$el.detach();
            //this.setProgress(0);
          }.bind( this ), 2000 );

        }

      });

      var Importer = function() { 
        
      }

      $.extend( Importer.prototype, {

        init: function( demo, parts, home_slug, header, footer ) {
            this.data = {};
            this.data.demo = demo;
            this.data.action = 'cl_import_demo_data';
            this.data.home_slug = home_slug;
            this.data.header = header;
            this.data.footer = footer;
            this.data._wpnonce = codeless_js.codeless_import_demo_nonce;
            this.data.process = 0;
            this.parts = parseInt(parts);
            this.current_part = 0;
            this.process_list = {0: 'install_plugins', 1: 'import_content', 2: 'import_options', 3: 'import_menus', 4: 'import_widgets', 5: 'import_extra'};
            Progress.start();
            this.processPart(0);

        },

        processPart: function( index ){
            this.data.process = index;

            if( this.process_list[index] == 'import_content' ){
              this.current_part = this.current_part + 1;
              this.data.current_part = this.current_part;
            }

            Progress.startPart(this.process_list[index]);
            var that = this;
            jQuery.post( ajaxurl, this.data, function(response){
                console.log(response);
                if( typeof response !== 'object' )  
                    response = jQuery.parseJSON(response);
                    
                if( index == 0 ){
                    
                    if( response.success !== false ){
                        this.installPlugins(response);
                        return;
                    }else
                        response.success = true;
                }
        
                if ( response.success === false || typeof response.success == 'undefined' )
                    return that.failure( response.data.message, response );

                if( that.process_list[index] == 'import_content' && that.current_part == that.parts )
                  Progress.completePart(that.process_list[index]);
                else if( that.process_list[index] != 'import_content' )
                  Progress.completePart(that.process_list[index]);

                setTimeout(function(){
                    if( index <= 4 ){
                        index = index + 1;

                        if( index == 2 && that.parts > that.current_part )
                          index = 1;

                        that.processPart(index);
                    }
                    else
                        that.complete();
                }, 260);

            }.bind(this)).fail( function(response) {
                this.failure(response.data.message, response.data);
            }.bind(this), 'json' );
        },




        complete: function() {
          Progress.complete();
        },

        installPlugins: function( response ){
            var counter = 0;
            
            if(typeof response.data.plugins == 'object'){
                
                jQuery.post(response.data.plugins['install'].url, response.data.plugins['install'] ).done( function(){
                            
                    jQuery.post(response.data.plugins['active'].url, response.data.plugins['active'] ).done( function(){
                            

                        Progress.completePart(this.process_list[0]);

                        setTimeout(function(){
                                    
                            this.processPart(1);
                                   
                        }.bind(this), 260);

                    }.bind(this) );
                              

                }.bind(this) );

            }else{
                Progress.completePart(this.process_list[0]);

                setTimeout(function(){
                                    
                    this.processPart(1);
                                   
                }.bind(this), 260);
            }
        },

        failure: function( message, debug ) {
          Progress.fail( message );
          console.error( 'Demo Importer failure', debug || {});
        },

      } );

      var Progress = new Progress();
      var Importer = new Importer();
      Importer.init( demo, parts, home_slug, header, footer );
      
    };



    $.codeless_header_setup.start_import = function(demo){


      var ProgressHeader = function() {
        this.$el = $( this.markup );
        this.$bar = this.$el.find('.progress-bar-inner');
        this.parts = ['install_header'];
        this.part_in_progress = 0;
      }

      $.extend( ProgressHeader.prototype, {

        markup: '<div class="cl-modal">'
          + '<div class="wrapper">'
            +'<div class="inner">'
                + '<div class="progress">'
                  + '<div class="progress-bar-outer">'
                    + '<div class="progress-bar-inner"></div>'
                  + '</div>'
                  + '<div class="in-progress">'
                    + '<span id="install_header" data-start-point="0" data-end-point="100">Install Header</span>'
                  + '</div>'
                + '</div>'
                + '<div class="progress-complete">'
                +  '<div class="progress-complete-icon dashicons dashicons-yes"></div>'
                +  '<div class="progress-complete-title">Installation Complete with Success!</div>'
                + '</div>'
                + '<div class="progress-fail">'
                +  '<div class="progress-fail-title">Installation Failed!</div>'
                +  '<div class="desc">Please try again to install the demos, or if you have repeated problems contact our support forum. Thank You!</div>'
                + '</div>'
            + '</div>'
          + '</div>'
        + '</div>',

        start: function() {
         
          $( 'body' ).append( this.$el );

          setTimeout( function() {
            this.$el.addClass( 'active' );
          }.bind( this ), 0 )

        },

        startPart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.addClass('in_progress');
            var startPoint = $select.data('startPoint');
            var endPoint = $select.data('endPoint');
            var alltime = 360000;

            var speed = ( alltime * (endPoint - startPoint) ) / 100;
            console.log(speed);
            this.setProgress( endPoint, speed );
        },

        completePart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.removeClass('in_progress').addClass('complete');
            var endPoint = $select.data('endPoint');

            this.setProgress( endPoint, 250 );
        },

        setProgress: function( progress, speed ) {

          this.$bar.stop().animate( { width: progress + '%' }, speed );
        },

        complete: function() {

          this.$bar.animate( { width: '100%' }, 250 );
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-complete').addClass('show');

          setTimeout(function(){
            this.close();
          }.bind(this), 400 )

        },

        fail: function( message ) {
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-fail').addClass('show');
          this.$el.find('.progress-fail').find('.desc').prepend('<p style="color:red;">' + message + '<p>');
          setTimeout(function(){
            this.close();
          }.bind(this), 2000);
          
        },

        close: function() {

          setTimeout( function(){
            this.$el.removeClass( 'active' );
          }.bind( this ), 1500 );

          setTimeout(function(){
            //this.$el.detach();
            //this.setProgress(0);
          }.bind( this ), 2000 );

        }

      });



    var ImporterHeader = function() { 
        
      }

      $.extend( ImporterHeader.prototype, {

        init: function( demo ) {
            this.data = {};
            this.data.demo = demo;
            this.data.action = 'cl_import_header_data';
            this.data.process = 0;
            this.data._wpnonce = codeless_js.codeless_import_header_nonce;
            this.process_list = {0: 'install_header'};
            ProgressHeader.start();
            this.processPart(0);

        },

        processPart: function( index ){
            this.data.process = index;
            ProgressHeader.startPart(this.process_list[index]);
            var that = this;
            jQuery.post( ajaxurl, this.data, function(response){
                console.log(response);
                if( typeof response !== 'object' )  
                    response = jQuery.parseJSON(response);
                    
                if( index == 0 ){

                        response.success = true;
                }
        
                if ( response.success === false || typeof response.success == 'undefined' )
                    return that.failure( response.data.message, response );

                ProgressHeader.completePart(that.process_list[index]);

                setTimeout(function(){
                        that.complete();
                }, 260);

            }.bind(this)).fail( function(response) {
                this.failure(response.data.message, response.data);
            }.bind(this), 'json' );
        },




        complete: function() {
          ProgressHeader.complete();
        },


        failure: function( message, debug ) {
          ProgressHeader.fail( message );
          console.error( 'Demo Importer failure', debug || {});
        },

      } );

      var ProgressHeader = new ProgressHeader();
      var ImporterHeader = new ImporterHeader();
      ImporterHeader.init( demo );
      
    };






    $.codeless_footer_setup.start_import = function(demo){


      var ProgressFooter = function() {
        this.$el = $( this.markup );
        this.$bar = this.$el.find('.progress-bar-inner');
        this.parts = ['install_footer'];
        this.part_in_progress = 0;
      }

      $.extend( ProgressFooter.prototype, {

        markup: '<div class="cl-modal">'
          + '<div class="wrapper">'
            +'<div class="inner">'
                + '<div class="progress">'
                  + '<div class="progress-bar-outer">'
                    + '<div class="progress-bar-inner"></div>'
                  + '</div>'
                  + '<div class="in-progress">'
                    + '<span id="install_footer" data-start-point="0" data-end-point="100">Install Footer</span>'
                  + '</div>'
                + '</div>'
                + '<div class="progress-complete">'
                +  '<div class="progress-complete-icon dashicons dashicons-yes"></div>'
                +  '<div class="progress-complete-title">Installation Complete with Success!</div>'
                + '</div>'
                + '<div class="progress-fail">'
                +  '<div class="progress-fail-title">Installation Failed!</div>'
                +  '<div class="desc">Please try again to install the demos, or if you have repeated problems contact our support forum. Thank You!</div>'
                + '</div>'
            + '</div>'
          + '</div>'
        + '</div>',

        start: function() {
         
          $( 'body' ).append( this.$el );

          setTimeout( function() {
            this.$el.addClass( 'active' );
          }.bind( this ), 0 )

        },

        startPart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.addClass('in_progress');
            var startPoint = $select.data('startPoint');
            var endPoint = $select.data('endPoint');
            var alltime = 360000;

            var speed = ( alltime * (endPoint - startPoint) ) / 100;
            console.log(speed);
            this.setProgress( endPoint, speed );
        },

        completePart: function( id ) {
            var $select = this.$el.find('#' + id);
            $select.removeClass('in_progress').addClass('complete');
            var endPoint = $select.data('endPoint');

            this.setProgress( endPoint, 250 );
        },

        setProgress: function( progress, speed ) {

          this.$bar.stop().animate( { width: progress + '%' }, speed );
        },

        complete: function() {

          this.$bar.animate( { width: '100%' }, 250 );
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-complete').addClass('show');

          setTimeout(function(){
            this.close();
          }.bind(this), 400 )

        },

        fail: function( message ) {
          this.$el.find('.progress').addClass('hide');
          this.$el.find('.progress-fail').addClass('show');
          this.$el.find('.progress-fail').find('.desc').prepend('<p style="color:red;">' + message + '<p>');
          setTimeout(function(){
            this.close();
          }.bind(this), 2000);
          
        },

        close: function() {

          setTimeout( function(){
            this.$el.removeClass( 'active' );
          }.bind( this ), 1500 );

          setTimeout(function(){
            //this.$el.detach();
            //this.setProgress(0);
          }.bind( this ), 2000 );

        }

      });



    var ImporterFooter = function() { 
        
      }

      $.extend( ImporterFooter.prototype, {

        init: function( demo ) {
            this.data = {};
            this.data.demo = demo;
            this.data.action = 'cl_import_footer_data';
            this.data._wpnonce = codeless_js.codeless_import_header_nonce;
            this.data.process = 0;
            this.process_list = {0: 'install_footer'};
            ProgressFooter.start();
            this.processPart(0);

        },

        processPart: function( index ){
            this.data.process = index;
            ProgressFooter.startPart(this.process_list[index]);
            var that = this;
            jQuery.post( ajaxurl, this.data, function(response){
                console.log(response);
                if( typeof response !== 'object' )  
                    response = jQuery.parseJSON(response);
                    
                if( index == 0 ){

                        response.success = true;
                }
        
                if ( response.success === false || typeof response.success == 'undefined' )
                    return that.failure( response.data.message, response );

                ProgressFooter.completePart(that.process_list[index]);

                setTimeout(function(){
                        that.complete();
                }, 260);

            }.bind(this)).fail( function(response) {
                this.failure(response.data.message, response.data);
            }.bind(this), 'json' );
        },




        complete: function() {
          ProgressFooter.complete();
        },


        failure: function( message, debug ) {
          ProgressFooter.fail( message );
          console.error( 'Demo Importer failure', debug || {});
        },

      } );

      var ProgressFooter = new ProgressFooter();
      var ImporterFooter = new ImporterFooter();
      ImporterFooter.init( demo );
      
    };





    $.codeless_welcome.register = function(){
        jQuery('#registerBtn').on( 'click', function(){
                  
                     var values = {

                        'code'  : $('input[name=purchase-code').val(),
                        'email' : $('input[name=email]').val(),
                        
                    };
                       
                        jQuery.ajax(

                    {
                            url: "http://codeless.co/june/register/login.php",
                            type: "get",
                            data: values,
                            dataType : 'json',
                            success: function (response) {
                                  
                                
                                    if(response != 'No valid purchase code' && response != 'Sorry! This purchase code was registered before'){
                                         alert(response);
                                         $.codeless_welcome.registerpurchasecode();

                                    }else{
                                        alert(response);
                                    }


                            },
                             error: function( response ) {

                                alert(response);
                             }   

                    });
                  
        });
    }; 

    $.codeless_welcome.registerpurchasecode = function() { 

       

            var purchasecode = {

                'register': '1',
                'code' : $('input[name=purchase-code').val()

            };

            jQuery.ajax(

               {

                  url: "admin.php?page=codeless-panel",
                  type: "post",
                  data: purchasecode,
                  success: function(response){

                       location.reload();
                      


                  }
              
               }
            );


    }


    $.codeless_welcome.removepurchasecode = function(){
        
        jQuery('#remove').on( 'click', function(){

            var postdata = {'remove' : '1'};

            jQuery.ajax(

            
                {

                    url:"admin.php?page=codeless-panel",
                    type: "post",
                    data: postdata,
                    success: function(response){

                        location.reload();


                    }
                }

            )

        });    

    }

    $.codeless_welcome.supportHash = function() {

        jQuery( "#support_hash" ).focus(
            function() {
                var $this = jQuery( this );
                $this.select();

                // Work around Chrome's little problem
                $this.mouseup(
                    function() {
                        // Prevent further mouseup intervention
                        $this.unbind( "mouseup" );
                        return false;
                    }
                );
            }
        );



        jQuery( '.codeless_support_hash' ).on( 'click', 
            function( e ) {

                var $button = jQuery( this );
                if ( $button.hasClass( 'disabled' ) ) {
                    return;
                }
                var $nonce = jQuery( '#codeless_support_nonce' ).val();
                $button.addClass( 'disabled' );
                $button.parent().append( '<span class="spinner" style="display:block;float: none;margin: 10px auto;"></span>' );
                $button.closest( '.spinner' ).fadeIn();
                if ( !window.console ) console = {};
                console.log = console.log || function( name, data ) {};
                jQuery.ajax(
                    {
                        type: "post",
                        dataType: "json",
                        url: ajaxurl,
                        data: {
                            action: "codeless_support_hash",
                            nonce: $nonce
                        },
                        error: function( response ) {
                            console.log( response );
                            $button.removeClass( 'disabled' );
                            $button.parent().find( '.spinner' ).remove();
                            alert( 'There was an error. Please try again later.' );
                        },
                        success: function( response ) {
                            if ( response.status == "success" ) {
                                jQuery( '#support_hash' ).val( 'http://support.codeless.io/?id=' + response.identifier );
                                $button.parents( 'fieldset:first' ).find( '.next' ).removeAttr( 'disabled' ).click();
                            } else {
                                console.log( response );
                                alert( 'There was an error. Please try again later.' );
                            }
                        }
                    }
                );
                e.preventDefault();
            }
        );
    };

    $.codeless_welcome.initSupportPage = function() {
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $.fn.actualHeight = function() {
            // find the closest visible parent and get it's hidden children
            var visibleParent = this.closest( ':visible' ).children(),
                thisHeight;

            // set a temporary class on the hidden parent of the element
            visibleParent.addClass( 'temp-show' );

            // get the height
            thisHeight = this.height();

            // remove the temporary class
            visibleParent.removeClass( 'temp-show' );

            return thisHeight;
        };

        function setHeight() {
            var $height = 0;
            jQuery( document ).find( '#support_div fieldset' ).each(
                function() {
                    var $actual = $( this ).actualHeight();
                    if ( $height < $actual ) {
                        $height = $actual;
                    }
                }
            );
            jQuery( '#support_div' ).height( $height + 20 );
        }

        setHeight();
        $( window ).on(
            'resize', function() {
                setHeight();
            }
        );
        jQuery( '#is_user' ).on( 'click', 
            function() {
                jQuery( '#final_support .is_user' ).show();
                jQuery( '#final_support .is_developer' ).hide();
                jQuery( this ).parents( 'fieldset:first' ).find( '.next' ).click();
            }
        );
        jQuery( '#is_developer' ).on( 'click', 
            function() {
                jQuery( '#final_support .is_user' ).hide();
                jQuery( '#final_support .is_developer' ).show();
                jQuery( this ).parents( 'fieldset:first' ).find( '.next' ).click();
            }
        );

        jQuery( "#support_div .next" ).on( 'click', 
            function() {
                if ( animating ) return false;
                animating = true;

                current_fs = jQuery( this ).parent();
                next_fs = jQuery( this ).parent().next();

                //activate next step on progressbar using the index of next_fs
                jQuery( "#progressbar li" ).eq( jQuery( "fieldset" ).index( next_fs ) ).addClass( "active" );

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate(
                    {opacity: 0}, {
                        step: function( now, mx ) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale current_fs down to 80%
                            scale = 1 - (1 - now) * 0.2;
                            //2. bring next_fs from the right(50%)
                            left = (now * 50) + "%";
                            //3. increase opacity of next_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css( {'transform': 'scale(' + scale + ')'} );
                            next_fs.css( {'left': left, 'opacity': opacity} );
                        },
                        duration: 800,
                        complete: function() {
                            current_fs.hide();
                            animating = false;
                        },
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    }
                );
            }
        );

        jQuery( "#support_div .previous" ).on( 'click', 
            function() {
                if ( animating ) return false;
                animating = true;

                current_fs = jQuery( this ).parent();
                previous_fs = jQuery( this ).parent().prev();

                //de-activate current step on progressbar
                jQuery( "#progressbar li" ).eq( jQuery( "fieldset" ).index( current_fs ) ).removeClass( "active" );

                //show the previous fieldset
                previous_fs.show();
                //hide the current fieldset with style
                current_fs.animate(
                    {opacity: 0}, {
                        step: function( now, mx ) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale previous_fs from 80% to 100%
                            scale = 0.8 + (1 - now) * 0.2;
                            //2. take current_fs to the right(50%) - from 0%
                            left = ((1 - now) * 50) + "%";
                            //3. increase opacity of previous_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css( {'left': left} );
                            previous_fs.css( {'transform': 'scale(' + scale + ')', 'opacity': opacity} );
                        },
                        duration: 800,
                        complete: function() {
                            current_fs.hide();
                            animating = false;
                        },
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    }
                );
            }
        );
    }




    $.codeless_welcome.initQtip = function() {
        if ( $().qtip ) {
            var shadow = 'qtip-shadow';
            var color = 'qtip-dark';
            var rounded = '';
            var style = ''; //qtip-bootstrap';

            var classes = shadow + ',' + color + ',' + rounded + ',' + style;
            classes = classes.replace( /,/g, ' ' );

            // Get position data
            var myPos = 'top center';
            var atPos = 'bottom center';

            // Tooltip trigger action
            var showEvent = 'click';
            var hideEvent = 'click mouseleave';

            // Tip show effect
            var tipShowEffect = 'slide';
            var tipShowDuration = '500';

            // Tip hide effect
            var tipHideEffect = 'slide';
            var tipHideDuration = '500';

            $( '.codeless-hint-qtip' ).each(
                function() {
                    $( this ).qtip(
                        {
                            content: {
                                text: $( this ).attr( 'qtip-content' ),
                                title: $( this ).attr( 'qtip-title' )
                            },
                            show: {
                                effect: function() {
                                    switch ( tipShowEffect ) {
                                        case 'slide':
                                            $( this ).slideDown( tipShowDuration );
                                            break;
                                        case 'fade':
                                            $( this ).fadeIn( tipShowDuration );
                                            break;
                                        default:
                                            $( this ).show();
                                            break;
                                    }
                                },
                                event: showEvent,
                            },
                            hide: {
                                effect: function() {
                                    switch ( tipHideEffect ) {
                                        case 'slide':
                                            $( this ).slideUp( tipHideDuration );
                                            break;
                                        case 'fade':
                                            $( this ).fadeOut( tipHideDuration );
                                            break;
                                        default:
                                            $( this ).show( tipHideDuration );
                                            break;
                                    }
                                },
                                event: hideEvent,
                            },
                            style: {
                                classes: classes,
                            },
                            position: {
                                my: myPos,
                                at: atPos,
                            },
                        }
                    );
                }
            );
        }
    };
})( jQuery );