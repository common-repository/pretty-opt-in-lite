(function($){

    "use strict";

    var PrettyOptInDashboard = {

        init: function()
        {
            this._bind();
        },

        /**
         * Binds events for the PrettyOptInDashboard.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.nav-tab', PrettyOptInDashboard._switchWelcomeTabs );
        },

         /**
         * Switch Welcome Tabs
         *
         */
        _switchWelcomeTabs: function( event ) {

            event.preventDefault();
            var tab = '#' + $(this).data('nav');

            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');

            $('.nav-container').removeClass('active');
            $('.pretty-welcome-tabs').find(tab).addClass('active');

        },
        
    };

    /**
     * Initialize PrettyOptInDashboard
     */
    $(function(){
        PrettyOptInDashboard.init();
    });

})(jQuery);