<?php
/**
 * Pretty_ActiveCampaign_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_ActiveCampaign_Service' ) ) :

    class Pretty_ActiveCampaign_Service extends Pretty_Opt_In_Mail_Services{
        

        /**
         * Pretty_ActiveCampaign_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'activecampaign';
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
            $api_url = isset($api_data['api_url']) ? $api_data['api_url'] : '';

            $url = rtrim($api_url, '/ ') . '/api/3/lists';

            // sendgrid api need http bearer authentication
            $header = array(
                'Api-Token' => $api_key
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
            $api_url = $api_data['api_url'];
            $action = 'contact_add';

            $data = array();
            $data['email'] = $email;
            $data['ip4'] = $_SERVER['REMOTE_ADDR'];
            $data['status[' . $list_id . ']'] = 1;
            $data['instantresponders[' . $list_id . ']'] = 1;
            $data['p[' . $list_id . ']'] = $list_id;
        
            $postData = array();
        
            $getData = array(
                'api_key' => $api_key,
                'api_action' => $action,
                'api_output' => 'json'
            );
        
            $query = '';
            $strPostData = '';
            
            $postData = array_merge($postData, $data);

            foreach( $getData as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
            $query = rtrim($query, '& ');
              
        
            foreach( $postData as $key => $value ) $strPostData .= $key . '=' . urlencode($value) . '&';
            $strPostData = rtrim($strPostData, '& ');
        
            $api_url = rtrim($api_url, '/ ');
            $url = $api_url . '/admin/api.php?' . $query;
            
            $args = array();
            if ( !empty( $strPostData ) ) $args['body'] = $strPostData;

            $result = wp_remote_post($url, $args);

            return $result;

        } 


    }

endif;
