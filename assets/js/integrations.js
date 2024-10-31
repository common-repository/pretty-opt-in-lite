(function($){

    "use strict";

    var PrettyOptInAddon = {

        init: function()
        {
            // Document ready.
            $( document ).ready( PrettyOptInAddon._loadPopup() );

            this._bind();
        },

        /**
         * Binds events for the Pretty Opt In Addon.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.pretty-connect-integration', PrettyOptInAddon._selectIntegration );
            $( document ).on('click', '.pretty-addon-connect', PrettyOptInAddon._saveAPIData );
            $( document ).on('pretty-reload-integration-page', PrettyOptInAddon._reloadIntegrationPage );
            $( document ).on('click', '.pretty-vertical-tab a', PrettyOptInAddon._switchTabs );


        },

        /**
         * Switch Tabs
         *
         */
        _switchTabs: function( event ) {

            event.preventDefault();

            var tab = '#' + $(this).data('nav');

            $('.pretty-vertical-tab').removeClass('current');
            $(this).parent().addClass('current');

            $('.pretty-box-tab').removeClass('active');
            $('.pretty-box-tabs').find(tab).addClass('active');

        },

        /**
         * Load Popup
         *
         */
        _loadPopup: function( ) {

            $('.pretty-connect-integration').magnificPopup({
                type:'inline',
                midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
                // Delay in milliseconds before popup is removed
                removalDelay: 300,

                // Class that is added to popup wrapper and background
                // make it unique to apply your CSS animations just to this exact popup
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
            });

        },

        /**
         * Display Actions
         *
         */
        _selectIntegration: function( event ) {

            event.preventDefault();

            var slug = $(this).data('slug');

            $.ajax({
                    url  : Pretty_Opt_In_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_select_integration',
                        template     : slug,
                        _ajax_nonce  : Pretty_Opt_In_Data._ajax_nonce,
                    },
                    beforeSend: function() {
                        $('#integration-popup').empty();
                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( result ) {
                    if( false === result.success ) {
                        console.log(result);
                    } else {
                        $('#integration-popup').html(result.data);
                    }
                });


        },

        /**
         * Save API Data
         *
         */
        _saveAPIData: function( event ) {

            event.preventDefault();


            var formdata = $('.pretty-integration-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });

            console.log(fields);

            $.ajax({
                    url  : Pretty_Opt_In_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_save_api_data',
                        fields_data  : fields,
                        _ajax_nonce  : Pretty_Opt_In_Data._ajax_nonce,
                    },
                    beforeSend: function() {
                        $('.pretty-loading-text').text('Loading...');
                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( result ) {
                    if( false === result.success ) {
                        console.log(result);
                    } else {
                        $('.pretty-loading-text').text('Save');

                        PrettyOptInAddon._displayNoticeMessage(result.data);

                        setTimeout(function(){
                         $(document).trigger( 'pretty-reload-integration-page' );
                        }, 3000);
                    }


                });


        },

        /**
         * Reload Integration Page
         *
         */
        _reloadIntegrationPage: function( event ) {

            event.preventDefault();

            var target_url = Pretty_Opt_In_Data.integrations_url;
            window.location.replace(target_url);

        },

        /**
         * Display Notice Message
         *
         */
        _displayNoticeMessage: function(message) {

            var html = '<div class="message-box pretty-message-box success">' + message + '</div>';
            $(html).appendTo(".pretty-wrap").fadeIn('slow').animate({opacity: 1.0}, 2500).fadeOut('slow');;

        },
        
    };

    /**
     * Initialize PrettyOptInAddon
     */
    $(function(){
        PrettyOptInAddon.init();
    });

})(jQuery);
