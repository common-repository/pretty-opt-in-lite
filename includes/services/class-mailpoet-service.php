<?php
/**
 * Pretty_MailPoet_Service Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_MailPoet_Service' ) ) :

    class Pretty_MailPoet_Service extends Pretty_Opt_In_Mail_Services{

        protected $mailpoet_version = 0;

        /**
         * Pretty_MailPoet_Service constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->type = 'mailpoet';
            $this->get_api_data($this->type);

            $this->mailpoet_version= 0;
            if ( defined('WYSIJA') ) $this->mailpoet_version = 2;
            if ( defined('MAILPOET_VERSION') ) $this->mailpoet_version = 3;
        }

        /**
         * Get lists
         *
         * @return array
         */
        public function get_lists(){

            $lists = array();

            if ( !$this->mailpoet_version ) {
                $lists[0]['id'] = 0;
                $lists[0]['name'] = 'The MailPoet plugin is not found on your website.';
                return $lists;
            }

            if ( $this->mailpoet_version == 3 ) {

                // $segments = \MailPoet\Models\Segment::getSegmentsWithSubscriberCount();
                // foreach( $segments as $key => $value ) {
                //     $lists[$key]['id'] = $value['id'];
                //     $lists[$key]['name'] = $value['name'];
                // }

                $mailpoetAPI = \MailPoet\API\API::MP( 'v1' );
                $mailpoetLists = $mailpoetAPI->getLists();

                foreach( $mailpoetLists as $key => $value ) {
                    $lists[$key]['id'] = $value['id'];
                    $lists[$key]['name'] = $value['name'];
                }

            } else {

                $model_list = WYSIJA::get('list','model');
                foreach( $model_list->getLists() as $key => $value ) {
                    $lists[$key]['id'] = $value['list_id'];
                    $lists[$key]['name'] = $value['name'];
                }
            }

            return $lists;

        }

        /**
         * subscribe user email into list
         *
         * @return array
         */
        public function subscribe($email, $list_id){

            $result = false;

            if ( $this->mailpoet_version == 3 ) {

                $userData = array(
                    'email' => $email,
                    'status' => \MailPoet\Models\Subscriber::STATUS_SUBSCRIBED,
                    'created_at' => time()
                );

                $subscriber = \MailPoet\Models\Subscriber::createOrUpdate( $userData );

                $lists = array();
                $lists[0] = $list_id;
                $result = \MailPoet\Models\SubscriberSegment::subscribeToSegments( $subscriber, $lists );
            }

            return $result;

        }


    }

endif;
