<?php
/**
 * Pretty_SendInBlue_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_SendInBlue_Service' ) ) :

    class Pretty_SendInBlue_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_SendInBlue_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'sendinblue';
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

            $url = 'https://api.sendinblue.com/v3/contacts/lists';

            // sendinblue api need http bearer authentication
            $header = array(
                'api-key' => $api_key,
                'content-type'  => 'application/json'
            );

            // make put request
            $return_data  = $this->make_get_request( $url, $header );

            if($return_data){
                $result = json_decode($return_data, true);
                return $result['lists'];
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

            $url = 'https://api.sendinblue.com/v3/contacts';

            // sendinblue api need http bearer authentication
            $header = array(
                'api-key' => $api_key,
                'content-type'  => 'application/json'
            );

            $params = array( 
                'listIds' => array(
                    intval($list_id)
                ),
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
