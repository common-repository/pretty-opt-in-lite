(function($){

    "use strict";

    var PrettyOptInLeads = {

        init: function()
        {
            this._bind();
        },

        /**
         * Binds events for the PrettyOptInLeads.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '#pretty-check-all-leads', PrettyOptInLeads._checkAll );
            $( document ).on('click', '.pretty-leads-bulk-action', PrettyOptInLeads._prepareBulk );

        
        },

         /**
         * Check All
         *
         */
        _checkAll: function( ) {

            if($(this).prop('checked')){
                $('.pretty-leads-listing-checkbox').prop('checked', true);
            }else{
                $('.pretty-leads-listing-checkbox').prop('checked', false);

            }

        },

        /**
         * Prepare data before bulk action
         *
         */
        _prepareBulk: function( ) {

            var ids = [];
            $('.pretty-leads-listing-checkbox').each(function( index ) {
                if($(this).prop('checked')){
                    var value = $(this).val();
                    ids.push(value);
                }
            });

            console.log(ids);

            $('#pretty-select-leads-ids').val(ids);

        },

       
        
    };

    /**
     * Initialize PrettyOptInLeads
     */
    $(function(){
        PrettyOptInLeads.init();
    });

})(jQuery);