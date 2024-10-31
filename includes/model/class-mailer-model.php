<?php
/**
 * Pretty_Opt_In_Mailer_Model Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Mailer_Model' ) ) :

    class Pretty_Opt_In_Mailer_Model {

        /**
         * Pretty_Opt_In_Mailer_Model constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
			add_filter( 'wp_mail_from', array( $this, 'change_mail_from' ) );
            add_filter( 'wp_mail_from_name', array( $this, 'change_mail_from_name' ));
		}
		
		/**
         * Change mail from
         *
         * @since 1.0.0
         */
		public function change_mail_from( $original_email_address ) {
			$global_settings = get_option('pretty_global_settings');
    		return $global_settings['pretty_sender_email'];
		}

		/**
         * Change mail from name
         *
         * @since 1.0.0
         */
		public function change_mail_from_name( $original_name ) {
			$global_settings = get_option('pretty_global_settings');
    		return $global_settings['pretty_sender_name'];
		}

        /**
		 * Send double optin email
		 */
		public function send_double_optin_email( $email, $subject, $body, $header ) {
            $link_data = array(
				'email'       => $email,
            );
            $body = $this->parse_template( $body, $link_data );
            $result = wp_mail( $email, $subject, $body, $header );
            return $result;
        }

        /**
		 * Parse template
		 */
		public function parse_template( $content = '', $link_data ) {            
			$subscribe_link   = $this->get_subscribe_link( $link_data );
			$content = str_replace( '{{SUBSCRIBE-LINK}}', $subscribe_link, $content );
			return $content;
        }

        /**
		 * Get Subscribe link
		 *
		 * @param $link_data
		 *
		 * @return string
		 */
		public function get_subscribe_link( $link_data ) {
			$link_data['action'] = 'subscribe';
			return $this->prepare_link( $link_data );
		}
        
        /**
		 * Get link
		 *
		 * @param array $data
		 *
		 * @return string
		 *
		 */
		public function prepare_link( $data = array() ) {

			/**
			 * We are getting different data in $data
			 */
			$action = ! empty( $data['action'] ) ? $data['action'] : '';

			if ( 'subscribe' === $action ) {
				$action = 'optin';
			}

			$link = add_query_arg( 'pretty_confirm', $action, site_url( '/' ) );

			$data = pretty_encode_request_data( $data );

			$link = add_query_arg( 'hash', $data, $link );

			return $link;
		}
        

     
    }

endif;    