<?php
/**
 * Pretty_MailJet_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_MailJet_Service' ) ) :

    class Pretty_MailJet_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_MailJet_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'mailjet';
            $this->get_api_data($this->type);
        }

        /**
         * Get lists
         *
         * @return array
         */
        public function get_lists(){
            $api_data = $this->api_data;
            $api_key = isset($api_data['api_key']) ? $api_data['api_key'] : '';
            $api_secret = isset($api_data['api_secret']) ? $api_data['api_secret'] : '';

            $url = 'https://api.mailjet.com/v3/REST/contactslist';

            $auth = base64_encode( $api_key.':'.$api_secret );

            // mailchimp api need http basic authentication
            $header = array(
                'Authorization' => 'Basic ' . $auth,
                'content-type'  => 'application/json'
            );

            // make put request
            $return_data  = $this->make_get_request( $url, $header );

            $final_data = array();

            if($return_data){
                $result = json_decode($return_data, true);

                $lists = $result['Data'];

                foreach($lists as $key => $value){
                    $final_data[$key]['id'] = $value['ID'];
                    $final_data[$key]['name'] = $value['Name'];
                }
            }

            return $final_data;

        }

        /**
         * subscribe user email into list
         *
         * @return array
         */
        public function subscribe($email, $list_id){
            $api_data = $this->api_data;
            $api_key = $api_data['api_key'];
            $api_secret = $api_data['api_secret'];

            $url = 'https://api.mailjet.com/v3/REST/contactslist/'.$list_id.'/managecontact';

            $auth = base64_encode( $api_key.':'.$api_secret );
            
            // mailchimp api need http basic authentication
            $header = array(
                'Authorization' => 'Basic ' . $auth,
                'content-type'  => 'application/json'
            );

            $params = array( 
                'Action' => 'addforce',
                'Email' => $email
            );
             
            $body = json_encode($params);

            // make put request
            $return_data  = $this->make_post_request( $url, $header, $body );

            $result = json_decode($return_data, true);

            return $result;

        } 


    }

endif;
