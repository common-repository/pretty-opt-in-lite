<?php
/**
 * Pretty_Opt_In_Mail_Services Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Mail_Services' ) ) :
    
    abstract class Pretty_Opt_In_Mail_Services {

        /**
         * Mail service type
         *
         * @var string
         */
        public $type = '';

        /**
         * API data
         *
         * @var array
         */
        public $api_data = array();

        /**
         * Get API Data.
         *
         * @since 1.0.0
         */
        public function get_api_data($type) {
            $this->api_data = Pretty_Opt_In_Addon_Loader::get_instance()->get_addon_data($type);
        }

        public abstract function get_lists();
        public abstract function subscribe($email, $list_id);

        /**
        * Make HTTP GET Resuest
        *
        * @param  string $url
        * @param  array $header
        * @return string
        */
        public function make_get_request( $url, $headers = array()) {
            // build http request args
            $args = array(
                'headers' => $headers,
                'timeout'     => '20'
            );
  
            $request = wp_remote_get( $url, $args );
  
            // retrieve the body from the raw response
            $result = wp_remote_retrieve_body( $request );

            // log error messages
            if ( is_wp_error( $request ) ) {
                return false;
            }

            if ( $request['response']['code'] != 200 ) {          
                return false;
            }

            return $result;
          }
  

        /**
         * Make HTTP POST Resuest
         *
         * @param  string $url
         * @return string
         */
        public function make_post_request( $url, $headers = array(), $body) {
            // build http post request args
            $args = array(
                'headers' => $headers,
                'body'    => $body,
                'method'  => 'POST',
                'timeout' => 45,
            );

            $request = wp_remote_post( $url, $args );

            // retrieve the body from the raw response
            $result = wp_remote_retrieve_body( $request );

            // log error messages
            if ( is_wp_error( $request ) ) {
                return false;
            }

            if ( $request['response']['code'] != 200 ) {          
                return false;
            }

            return $result;

        }

        /**
         * Make HTTP PUT Resuest
         *
         * @param  string $url
         * @return string
         */
        public function make_put_request( $url, $headers = array(), $body ) {

            // build http post request args
            $args = array(
                'headers' => $headers,
                'body'    => $body,
                'method'  => 'PUT',
                'timeout' => 45,
            );

            $request = wp_remote_post( $url, $args );

            // retrieve the body from the raw response
            $result = wp_remote_retrieve_body( $request );

            // log error messages
            if ( is_wp_error( $request ) ) {
                return $request;
            }

            if ( $request['response']['code'] != 200 ) {          
                return false;
            }

            return $result;

        }
        
    }

endif;
