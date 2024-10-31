(function($){

    "use strict";

    var PrettyOptInSettings = {

        init: function()
        {
            // Document ready.
            $( document ).ready( PrettyOptInSettings._servicesSelect() );
            $( document ).ready( PrettyOptInSettings._termsPageSelect() );
            $( document ).ready( PrettyOptInSettings._privacyPageSelect() );
            $( document ).ready( PrettyOptInSettings._loadSuiTabs() );
            $( document ).ready( PrettyOptInSettings._permissionsSelect() );


            this._bind();
        },

        /**
         * Binds events for the PrettyOptInSettings.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.pretty-global-settings-button', PrettyOptInSettings._saveSettings );
            $( document ).on('click', '.pretty-vertical-tab a', PrettyOptInSettings._switchTabs );
            $( document ).on('click', '.sui-tab-item', PrettyOptInSettings._switchSuiTabs );



        },

        /**
         * Permissions Select
         *
         */
        _permissionsSelect: function( ) {

            // Permissions Select2
            $(".create-lockers-multi-select").select2({
                placeholder: "Select create locker user roles here", //placeholder
                allowClear: false
            });

            $(".edit-lockers-multi-select").select2({
                placeholder: "Select edit locker user roles here", //placeholder
                allowClear: false
            });

            $(".access-leads-multi-select").select2({
                placeholder: "Select access leads user roles here", //placeholder
                allowClear: false
            });

            $(".edit-settings-multi-select").select2({
                placeholder: "Select edit settings user roles here", //placeholder
                allowClear: false
            });

        },

        /**
         * Load Sui Tabs
         *
         */
        _loadSuiTabs: function( ) {

            $('.sui-tab-item.active').each(function(index, value) {
                var tab = '#' + $(this).data('nav');

                console.log(tab);

                $(this).closest('.sui-tabs-container').find('.sui-tab-content').removeClass('active');
                $(this).closest('.sui-tabs-container').find(tab).addClass('active');
            });

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
         * Save Settings
         *
         */
        _saveSettings: function( event ) {

            event.preventDefault();

            $(this).html('<div class="text-center"><div class="loader1"><span></span><span></span><span></span><span></span><span></span></div></div>');


            // set post form data
            var formdata = $('.pretty-settings-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });
            fields['mail_service'] = $('#pretty-mail-service').val();
            fields['pretty_terms_page_id'] = $('#pretty-terms-page-id').val();
            fields['pretty_privacy_page_id'] = $('#pretty-privacy-page-id').val();
            fields['new_lead'] = $('.new-lead.active').data('nav');
            fields['new_unlock'] = $('.new-unlock.active').data('nav');
            fields['terms_use'] = $('.terms-use.active').data('nav');
            fields['privacy_use'] = $('.privacy-use.active').data('nav');
            fields['pretty_predefine_terms'] = tinyMCE.get('pretty_predefine_terms').getContent();
            fields['pretty_predefine_privacy'] = tinyMCE.get('pretty_predefine_privacy').getContent();

            // set selected create lockers roles
            var select_create_lockers_data = $('.create-lockers-multi-select').select2('data');
            var selected_create_lockers = select_create_lockers_data.map(function (el) {
                return el.id;
            });
            fields['create_lockers_roles'] = selected_create_lockers;

            // set selected edit lockers roles
            var select_edit_lockers_data = $('.edit-lockers-multi-select').select2('data');
            var selected_edit_lockers = select_edit_lockers_data.map(function (el) {
                return el.id;
            });
            fields['edit_lockers_roles'] = selected_edit_lockers;

            // set selected edit lockers roles
            var select_access_leads_data = $('.access-leads-multi-select').select2('data');
            var selected_access_leads = select_access_leads_data.map(function (el) {
                return el.id;
            });
            fields['access_leads_roles'] = selected_access_leads;

            // set selected edit lockers roles
            var select_edit_settings_data = $('.edit-settings-multi-select').select2('data');
            var selected_edit_settings = select_edit_settings_data.map(function (el) {
                return el.id;
            });
            fields['edit_settings_roles'] = selected_edit_settings;

            console.log(fields);

            $.ajax({
                    url  : Pretty_Opt_In_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_save_glabal_settings',
                        fields_data  : fields,
                        _ajax_nonce  : Pretty_Opt_In_Data._ajax_nonce,
                    },
                    beforeSend: function() {
                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( options ) {
                    if( false === options.success ) {
                        console.log(options);
                    } else {
                        console.log(options);
                        $('.pretty-global-settings-button').html('<span class="pretty-loading-text">Save Settings</span>');
                    }
                });

        },

        /**
         * Services Select
         *
         */
        _servicesSelect: function( ) {

            // onClick new options list of new select
            var newOptions = $('.post-list-results > li');
            newOptions.on('click', function(){
                $('.post-list-value').html($(this).html());
                $('.post-list-value').val($(this).find('.dd-option-value').val());
                $('.post-list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.post-select-list-container');
            aeDropdown.on('click', function(){
                $('.post-list-results').toggleClass('pretty-sidenav-hide-md');
            });

            var prettyDropdown = $('.post-dropdown-handle');
            prettyDropdown.on('click', function(){
                $('.post-list-results').toggleClass('pretty-sidenav-hide-md');
            });
        },

        /**
         * Terms Page Select
         *
         */
        _termsPageSelect: function( ) {

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
         * Privacy Page Select
         *
         */
        _privacyPageSelect: function( ) {

            // onClick new options list of new select
            var newOptions = $('.privacy-list-results > li');
            newOptions.on('click', function(){
                $('.privacy-list-value').html($(this).html());
                $('.privacy-list-value').val($(this).data('page'));
                $('.privacy-list-results > li').removeClass('selected');
                $(this).addClass('selected');
            });

            var aeDropdown = $('.privacy-select-list-container');
            aeDropdown.on('click', function(){
                $('.privacy-list-results').toggleClass('pretty-sidenav-hide-md');
            });

            var prettyDropdown = $('.privacy-dropdown-handle');
            prettyDropdown.on('click', function(){
                $('.privacy-list-results').toggleClass('pretty-sidenav-hide-md');
            });
        },
        
    };

    /**
     * Initialize PrettyOptInSettings
     */
    $(function(){
        PrettyOptInSettings.init();
    });

})(jQuery);