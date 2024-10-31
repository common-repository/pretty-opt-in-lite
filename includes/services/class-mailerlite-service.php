<?php
/**
 * Pretty_MailerLite_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_MailerLite_Service' ) ) :

    class Pretty_MailerLite_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_MailerLite_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'mailerlite';
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

            $url = 'https://api.mailerlite.com/api/v1/lists/';

            // mailerlite api need http bearer authentication
            $header = array(
                'X-MailerLite-ApiKey' => $api_key,
                'content-type'  => 'application/json'
            );

            // make put request
            $return_data  = $this->make_get_request( $url, $header );

            if($return_data){
                $result = json_decode($return_data, true);
                return $result['Results'];
            }else{
                return array();
            }

        }

        /**
         * subscribe user email into list
         *
         * @return array
         */
        public function subscribe($email, $list_id){
            $api_data = $this->api_data;
            $api_key = $api_data['api_key'];

            $url = 'https://api.mailerlite.com/api/v1/subscribers/'.$list_id.'/';

            // mailerlite api need http bearer authentication
            $header = array(
                'X-MailerLite-ApiKey' => $api_key,
                'content-type'  => 'application/json'
            );

            $params = array( 
                "email" => $email                 
            );
             
            $body = json_encode($params);

            // make put request
            $return_data  = $this->make_post_request( $url, $header, $body );

            $result = json_decode($return_data, true);

            return $result;


        } 


    }

endif;
