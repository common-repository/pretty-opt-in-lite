<?php
/**
 * Pretty_MailChimp_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_MailChimp_Service' ) ) :

    class Pretty_MailChimp_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_MailChimp_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'mailchimp';
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
            $auth = base64_encode( 'user:'.$api_key );
            $server_prefix = substr($api_key, strpos($api_key,'-')+1);

            $url = 'https://'.$server_prefix.'.api.mailchimp.com/3.0/lists';

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

                $lists = $result['lists'];

                foreach($lists as $key => $value){
                    $final_data[$key]['id'] = $value['id'];
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
            $auth = base64_encode( 'user:'.$api_key );
            $server_prefix = substr($api_key, strpos($api_key,'-')+1);

            $url = 'https://'.$server_prefix.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members';

            // mailchimp api need http basic authentication
            $header = array(
                'Authorization' => 'Basic ' . $auth,
                'content-type'  => 'application/json'
            );

            $params = array( 
                'email_address' => $email,
                'status' => 'subscribed'
            );
             
            $body = json_encode($params);

            // make put request
            $return_data  = $this->make_post_request( $url, $header, $body );

            $result = json_decode($return_data, true);

            return $result;
        } 


    }

endif;
