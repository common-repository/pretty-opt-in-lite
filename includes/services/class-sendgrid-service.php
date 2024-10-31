<?php
/**
 * Pretty_SendGrid_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_SendGrid_Service' ) ) :

    class Pretty_SendGrid_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_SendGrid_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'sendgrid';
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

            $url = 'https://api.sendgrid.com/v3/marketing/lists';

            // sendgrid api need http bearer authentication
            $header = array(
                'Authorization' => 'Bearer ' . $api_key
            );

            // make put request
            $return_data  = $this->make_get_request( $url, $header );

            if($return_data){
                $result = json_decode($return_data, true);
                return $result['result'];
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

            $url = 'https://api.sendgrid.com/v3/marketing/contacts';

            // sendgrid api need http bearer authentication
            $header = array(
                'Authorization' => 'Bearer ' . $api_key,
                'content-type'  => 'application/json'
            );

            $params = array( 
                'list_ids' => array(
                    $list_id
                ),
                'contacts'=> array(
                    0 => array(
                        "email" => $email
                    ),
                )
            );
             
            $body = json_encode($params);

            // make put request
            $return_data  = $this->make_put_request( $url, $header, $body );

            $result = json_decode($return_data, true);

            return $result;

        } 


    }

endif;
