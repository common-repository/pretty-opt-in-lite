(function($){

    "use strict";

    var PrettyLockerFront = {

        init: function()
        {
            this._bind();
        },

        /**
         * Binds events for the PrettyLockerFront.
         *
         * @since 1.0.0
         * @access private
         * @method _bind
         */
        _bind: function()
        {
            $( document ).on('click', '.pretty-trigger-unlock', PrettyLockerFront._triggerUnlock );
        },      

        /**
         * trigger Unlock
         *
         */
        _triggerUnlock: function( event ) {

            event.preventDefault();

            var formdata = $('.pretty-subscribe-form').serializeArray();
            var fields = {};
            $(formdata ).each(function(index, obj){
                fields[obj.name] = obj.value;
            });

            console.log(fields);

            var validate_email = PrettyLockerFront._validateEmail(fields['email']);

            console.log(validate_email);

            if(validate_email){
                $.ajax({
                    url  : Pretty_Front_Data.ajaxurl,
                    type : 'POST',
                    dataType: 'json',
                    data : {
                        action       : 'pretty_trigger_unlock',
                        fields_data  : fields,
                        _ajax_nonce  : Pretty_Front_Data._ajax_nonce,
                    },
                    beforeSend: function() {
    
    
                    },
                })
                .fail(function( jqXHR ){
                    console.log( jqXHR.status + ' ' + jqXHR.responseText);
                })
                .done(function ( result ) {
                    if( false === result.success ) {
                        console.log(result);
                    } else {
                        console.log(result);
                        $('.pretty-real-content').html(result.data).animate({backgroundColor: '#bc6c25'}, 2500).animate({backgroundColor: 'transparent'}, 2500);
                        $('.pretty-locker-container').remove();
                    }
                });
            }else{
                PrettyLockerFront._displayNoticeMessage('Please entered an incorrect email address.');
            }

        },

        /**
         * trigger Unlock
         *
         */
        _validateEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        },

        /**
         * Display Notice Message
         *
         */
        _displayNoticeMessage: function(message) {

            var html = '<div class="pretty-notice-message">' + message + '</div>';
            $(html).appendTo(".pretty-locker-body").fadeIn('slow').animate({opacity: 1.0}, 2500).fadeOut('slow');

        },
        
    };

    /**
     * Initialize PrettyLockerFront
     */
    $(function(){
        PrettyLockerFront.init();
    });

})(jQuery);