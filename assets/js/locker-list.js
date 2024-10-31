(function($){

    "use strict";

    var PrettyOptInLockerList = {

        init: function()
        {
            // Document ready.
            $( document ).ready( PrettyOptInLockerList._loadPopup() );

            this._bind();
        },

        /**
         * Binds events for the PrettyOptInLockerList.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '#pretty-check-all-lockers', PrettyOptInLockerList._checkAll );
            $( document ).on('click', '.pretty-bulk-action-button', PrettyOptInLockerList._prepareBulk );
            $( document ).on('click', '.pretty-dropdown-anchor', PrettyOptInLockerList._displayActions );
            $( document ).on('click', '.pretty-delete-action', PrettyOptInLockerList._deleteAction );
            $( document ).on('mouseover', '.hui-template-card', PrettyOptInLockerList._hoverTemplate );
            $( document ).on('mouseout', '.hui-template-card', PrettyOptInLockerList._outTemplate );
            $( document ).on('click', '.pretty-template-select-button', PrettyOptInLockerList._selectTemplate );
        
        },

        /**
         * Select template
         *
         */
        _selectTemplate: function( event ) {
            event.preventDefault();
            var target_url = Pretty_Opt_In_Data.new_locker_url + '&template='+ $(this).data('template');

            window.location.replace(target_url);
        },    

        /**
         * Hover template
         *
         */
        _hoverTemplate: function( event ) {
            event.preventDefault(); 
            $(this).addClass('active');          
            $(this).find('.pretty-button').addClass('active');
            $(this).find('.hui-template-card--image').addClass('active');          
        },    

        /**
         * Out template
         *
         */
        _outTemplate: function( event ) {
            event.preventDefault();          
            $(this).removeClass('active');          
            $(this).find('.pretty-button').removeClass('active');
            $(this).find('.hui-template-card--image').removeClass('active');          

        },  

        /**
         * Load Popup
         *
         */
        _loadPopup: function( ) {

            $('.open-popup-link').magnificPopup({
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
         * Delete Action
         *
         */
        _deleteAction: function( ) {

            var data = $(this).data('locker-id');

            $('.pretty-delete-id').val(data);


        },

        /**
         * Display Actions
         *
         */
        _displayActions: function( event ) {

            event.preventDefault();

            if($(this).closest('.pretty-dropdown').find('.pretty-dropdown-list').hasClass('active')){
                $(this).closest('.pretty-dropdown').find('.pretty-dropdown-list').removeClass('active');
            }else{
                $(this).closest('.pretty-dropdown').find('.pretty-dropdown-list').addClass('active');
            }

        },


         /**
         * Check All
         *
         */
        _checkAll: function( ) {

            if($(this).prop('checked')){
                $('.pretty-check-single-campaign').prop('checked', true);
            }else{
                $('.pretty-check-single-campaign').prop('checked', false);

            }

        },

        /**
         * Prepare data before bulk action
         *
         */
        _prepareBulk: function( ) {

            var ids = [];
            $('.pretty-check-single-campaign').each(function( index ) {
                if($(this).prop('checked')){
                    var value = $(this).val();
                    ids.push(value);
                }
            });

            $('#pretty-select-lockers-ids').val(ids);

        },

       
        
    };

    /**
     * Initialize PrettyOptInLockerList
     */
    $(function(){
        PrettyOptInLockerList.init();
    });

})(jQuery);