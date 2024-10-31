(function($){

    "use strict";

    var PrettyOptInLockerEdit = {

        init: function()
        {
            // Document ready.
            $( document ).ready( PrettyOptInLockerEdit._lockerSelect() );
            $( document ).ready( PrettyOptInLockerEdit._rangeSlider() );
            $( document ).ready( PrettyOptInLockerEdit._loadBackupOptions() );
            $( document ).ready( PrettyOptInLockerEdit._loadPopup() );
            $( document ).ready( PrettyOptInLockerEdit._loadSuiTabs() );
            $( document ).ready( PrettyOptInLockerEdit._subscriptionListSelect() );

            this._bind();
        },

        /**
         * Binds events for the PrettyOptInLockerEdit.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            
            $( document ).on('click', '.pretty-vertical-tab a', PrettyOptInLockerEdit._switchTabs );
            $( document ).on('click', '#pretty-locker-publish', PrettyOptInLockerEdit._publishLocker );
            $( document ).on('click', '#pretty-locker-draft', PrettyOptInLockerEdit._draftLocker );
            $( document ).on('click', '.sui-tab-item', PrettyOptInLockerEdit._switchSuiTabs );
            $( document ).on('click', '.header-expand-collapse', PrettyOptInLockerEdit._collapseTablesOptions );
            $( document ).on('click', '#backup-selected', PrettyOptInLockerEdit._selectTables );
            $( document ).on('click', '#backup-only-with-prefix', PrettyOptInLockerEdit._undoSelectTables );
            $( document ).on('click', '.multiselect-select-all', PrettyOptInLockerEdit._selectAllOptions );
            $( document ).on('click', '.multiselect-deselect-all', PrettyOptInLockerEdit._deSelectAllOptions );
            $( document ).on('click', '.multiselect-invert-selection', PrettyOptInLockerEdit._invertSelectOptions );
            $( document ).on('click', '.pretty-button-copy-icon', PrettyOptInLockerEdit._copyShortcode );


        },

        /**
         * Subscription List Select
         *
         */
        _subscriptionListSelect: function( ) {

            // onClick new options list of new select
            var newOptions = $('.terms-list-results > li');
            newOptions.on('click', function(){
                $('.terms-list-value').html($(this).html());
                $('.terms-list-value').val($(this).data('page'));
                $('.terms-list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.terms-select-list-container');
            aeDropdown.on('click', function(){
                $('.terms-list-results').toggleClass('pretty-sidenav-hide-md');
            });

            var prettyDropdown = $('.terms-dropdown-handle');
            prettyDropdown.on('click', function(){
                $('.terms-list-results').toggleClass('pretty-sidenav-hide-md');
            });
        },

        /**
         * Copy Shortcode
         *
         */
        _copyShortcode: function( event ) {

            event.preventDefault();

            /* Get the shortcode text field */
            var shortcode = document.getElementById("pretty-form-shortcode");

            /* Select the text field */
            shortcode.select();
            shortcode.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            PrettyOptInLockerEdit._displayNoticeMessage('Shortcode has been copied successfully!');

        },

        /**
         * Display Notice Message
         *
         */
        _displayNoticeMessage: function(message) {

            var html = '<div class="message-box pretty-message-box success">' + message + '</div>';
            $(html).appendTo(".pretty-wrap").fadeIn('slow').animate({opacity: 1.0}, 2500).fadeOut('slow');

        },

        /**
         * Load Popup
         *
         */
        _loadPopup: function( ) {

            $('.open-popup-preview').magnificPopup({
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
         * invert Options
         *
         */
        _invertSelectOptions: function( event ) {

            event.preventDefault();
            var t = $(this).parents(".select-tables-wrap").children(".multiselect").find("option");

            t.each(function(index, elem) {
                var $elem = $(elem);
                if ($elem.prop('selected')) {
                    $elem.prop('selected', false);
                }else{
                    $elem.prop('selected', true);
                }
            });

        },

        /**
         * deselect All Options
         *
         */
        _deSelectAllOptions: function( event ) {

            event.preventDefault();
            var t = $(this).parents(".select-tables-wrap").children(".multiselect").find("option");

            t.each(function(index, elem) {
                var $elem = $(elem);
                $elem.prop('selected', false);
            });

        },

        /**
         * select All Options
         *
         */
        _selectAllOptions: function( event ) {

            event.preventDefault();
            var t = $(this).parents(".select-tables-wrap").children(".multiselect").find("option");

            t.each(function(index, elem) {
                var $elem = $(elem);
                $elem.prop('selected', true);
            });

        },


        /**
         * Collapse Tables Options
         *
         */
        _collapseTablesOptions: function( event ) {

            event.preventDefault();

            $(this).find('.expand-collapse-arrow').toggleClass('collapsed');
            $(this).closest('.option-section').find('.indent-wrap').toggleClass('collapsed-content');

        },

        /**
         * load Backup Options
         *
         */
        _loadBackupOptions: function() {

            if($('#backup-selected').prop("checked") == true){
                $('#backup-selected').closest('.indent-wrap').find('.select-tables-wrap').show();
            }
        },

        /**
         * Select Tables
         *
         */
        _selectTables: function() {

            if($(this).prop("checked") == true){
                $(this).closest('.indent-wrap').find('.select-tables-wrap').show();
            }
        },

        /**
         * Undo Select Tables
         *
         */
        _undoSelectTables: function() {

            if($(this).prop("checked") == true){
                $(this).closest('.indent-wrap').find('.select-tables-wrap').hide();
            }
        },

        /**
         * Load Sui Tabs
         *
         */
        _loadSuiTabs: function( ) {

            // onClick new options list of new select
            var activeTab = $('.sui-tab-item.active');

            console.log(activeTab);

            var tab = '#' + activeTab.data('nav');

            console.log(activeTab.closest('.sui-tabs-container').find(tab));
            activeTab.closest('.sui-tabs-container').find('.sui-tab-content').removeClass('active');
            activeTab.closest('.sui-tabs-container').find(tab).addClass('active');

        },

        /**
         * Switch Sui Tabs
         *
         */
        _switchSuiTabs: function( event ) {

            event.preventDefault();

            var tab = '#' + $(this).data('nav');

            console.log($(this).closest('.sui-tabs-menu').find('.sui-tab-item'));
            $(this).closest('.sui-tabs-menu').find('.sui-tab-item').removeClass('active');
            $(this).addClass('active');

            console.log($(this).closest('.sui-tabs-container').find(tab));
            $(this).closest('.sui-tabs-container').find('.sui-tab-content').removeClass('active');
            $(this).closest('.sui-tabs-container').find(tab).addClass('active');

            console.log($(this).data('nav'));

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
         * Locker Select
         *
         */
        _lockerSelect: function( ) {

            // onClick new options list of new select
            var newOptions = $('.list-results > li');
            newOptions.on('click', function(){
                $(this).closest('.select-list-container').find('.list-value').text($(this).text());
                $(this).closest('.select-list-container').find('.list-value').val($(this).text());
                $(this).closest('.select-list-container').find('.list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.select-list-container');
            aeDropdown.on('click', function(){
                $(this).closest('.select-list-container').find('.list-results').toggleClass('pretty-sidenav-hide-md');
            });

            var prettyDropdown = $('.dropdown-handle');
            prettyDropdown.on('click', function(){
                $(this).closest('.select-list-container').find('.list-results').toggleClass('pretty-sidenav-hide-md');
            });

        },

        /**
         * Range Slider
         *
         */
        _rangeSlider: function( ) {

            var slider = $('.range-slider'),
                range = $('.range-slider__range'),
                value = $('.range-slider__value');

            slider.each(function(){

                value.each(function(){
                    var value = $(this).prev().attr('value');
                    $(this).html(value);
                });

                range.on('input', function(){
                    $(this).next(value).html(this.value);
                });
            });

        },

        /**
         * Publish Locker
         *
         */
        _publishLocker: function( ) {

            var formdata = $('.pretty-locker-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });
            fields['locker_status'] = 'publish';
            fields['pretty_post_status'] = $('#pretty-post-status').val();
            fields['template'] = $( "input[name='template']" ).val();
            fields['opt_in_mode'] = $('.opt-in-mode.active').data('nav');
            fields['terms_and_privacy'] = $('.terms-and-privacy.active').data('nav');
            fields['footer_reference'] = $('.footer-reference.active').data('nav');
            fields['show_on_mobile'] = $('.show-on-mobile.active').data('nav');
            fields['show_on_members'] = $('.show-on-members.active').data('nav');
            fields['subscription_list_id'] = $('#pretty-subscription-list-id').val();
            fields['pretty_message'] = tinyMCE.get('pretty_message').getContent();

            $.ajax({
                    url  : Pretty_Opt_In_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_opt_in_save_locker',
                        fields_data  : fields,
                        _ajax_nonce  : Pretty_Opt_In_Data._ajax_nonce,
                    },
                    beforeSend: function() {

                        $('.pretty-status-changes').html('<ion-icon name="reload-circle"></ion-icon></ion-icon>Saving');

                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        $( "input[name='locker_id']" ).val(options.data);

                        // update campaign tag status
                        $('.pretty-tag').html('published');
                        $('.pretty-tag').removeClass('pretty-tag-draft');
                        $('.pretty-tag').addClass('pretty-tag-published');

                        // update locker save icon status
                        $('.pretty-status-changes').html('<ion-icon class="pretty-icon-saved" name="checkmark-circle"></ion-icon>Saved');

                        // update locker button text
                        $('.locker-save-text').text('unpublish');
                        $('.locker-publish-text').text('update');

                        //update page url with locker id
                        var locker_url = Pretty_Opt_In_Data.wizard_url+ '&id=' + options.data;
                        window.history.replaceState('','',locker_url);
                    }
                });

        },

        /**
         * Draft Locker
         *
         */
        _draftLocker: function( ) {

            var formdata = $('.pretty-locker-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });
            fields['locker_status'] = 'draft';
            fields['pretty_post_status'] = $('#pretty-post-status').val();
            fields['template'] = $( "input[name='template']" ).val();
            fields['opt_in_mode'] = $('.opt-in-mode.active').data('nav');
            fields['terms_and_privacy'] = $('.terms-and-privacy.active').data('nav');
            fields['footer_reference'] = $('.footer-reference.active').data('nav');
            fields['show_on_mobile'] = $('.show-on-mobile.active').data('nav');
            fields['show_on_members'] = $('.show-on-members.active').data('nav');
            fields['pretty_message'] = tinyMCE.get('pretty_message').getContent();

            $.ajax({
                    url  : Pretty_Opt_In_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_opt_in_save_locker',
                        fields_data  : fields,
                        _ajax_nonce  : Pretty_Opt_In_Data._ajax_nonce,
                    },
                    beforeSend: function() {

                        $('.pretty-status-changes').html('<ion-icon name="reload-circle"></ion-icon></ion-icon>Saving');

                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        $( "input[name='locker_id']" ).val(options.data);

                         // update campaign status
                         $('.pretty-tag').html('draft');
                         $('.pretty-tag').removeClass('pretty-tag-published');
                         $('.pretty-tag').addClass('pretty-tag-draft');

                        // update locker save icon status
                        $('.pretty-status-changes').html('<ion-icon class="pretty-icon-saved" name="checkmark-circle"></ion-icon>Saved');

                        // update locker button text
                        $('.locker-save-text').text('save draft');
                        $('.locker-publish-text').text('publish');

                        //update page url with locker id
                        var locker_url = Pretty_Opt_In_Data.wizard_url+ '&id=' + options.data;
                        window.history.replaceState('','',locker_url);
                    }
                });

        },


       
        
    };

    /**
     * Initialize PrettyOptInLockerEdit
     */
    $(function(){
        PrettyOptInLockerEdit.init();
    });

})(jQuery);