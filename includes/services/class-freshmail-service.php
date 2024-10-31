<?php
/**
 * Pretty_FreshMail_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_FreshMail_Service' ) ) :

    class Pretty_FreshMail_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_FreshMail_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'freshmail';
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
            $sign = sha1( $api_key . '/rest/subscribers_list/lists'  . $api_secret );

            $url = 'https://api.freshmail.com/rest/subscribers_list/lists';

            // freshmail api get request header
            $header = array(
                'X-Rest-ApiKey' => $api_key,
                'X-Rest-ApiSign' => $sign,
                'content-type'  => 'text/json'
            );

            // make put request
            $return_data  = $this->make_get_request( $url, $header );

            $final_data = array();

            if($return_data){
                $result = json_decode($return_data, true);

                $lists = $result['lists'];

                foreach($lists as $key => $value){
                    $final_data[$key]['id'] = $value['subscriberListHash'];
                    $final_data[$key]['name'] = $value['name'];
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

            $url = 'https://api.freshmail.com/rest/subscriber/add';

            $verified = true;

            $params = array( 
                "email" => $email,
                'list'  => $list_id, 
                'confirm' => $verified ? 0 : 1,
                'state' => $verified ? 1 : 2                
            );
             
            $body = json_encode($params);

            $sign = sha1( $api_key . '/rest/subscriber/add' . $body . $api_secret );

            // freshmail api post request header
            $header = array(
                'X-Rest-ApiKey' => $api_key,
                'X-Rest-ApiSign' => $sign,
                'content-type'  => 'application/json'
            );

            // make put request
            $return_data  = $this->make_post_request( $url, $header, $body );

            $result = json_decode($return_data, true);

            return $result;

        } 


    }

endif;
