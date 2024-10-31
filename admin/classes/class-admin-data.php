<?php
/**
 * Pretty_Opt_In_Admin_Data Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Admin_Data' ) ) :

    class Pretty_Opt_In_Admin_Data {

        public $core = null;

        /**
         * Current Nonce
         *
         * @since 1.0.0
         * @var string
         */
        private $_nonce = '';

        /**
         * Pretty_Opt_In_Admin_Data constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->generate_nonce();
        }

        /**
         * Generate nonce
         *
         * @since 1.0.0
         */
        public function generate_nonce() {
            $this->_nonce = wp_create_nonce( 'pretty-opt-in' );
        }

        /**
         * Get current generated nonce
         *
         * @since 1.0.0
         * @return string
         */
        public function get_nonce() {
            return $this->_nonce;
        }

        /**
         * Combine Data and pass to JS
         *
         * @since 1.0.0
         * @return array
         */
        public function get_options_data() {
            $data           = $this->admin_js_defaults();
            $data           = apply_filters( 'pretty_opt_in_data', $data );

            return $data;
        }

        /**
         * Default Admin properties
         *
         * @since 1.0.0
         * @return array
         */
        public function admin_js_defaults() {

            return array(
                'ajaxurl'                        => pretty_opt_in_ajax_url(),
                '_ajax_nonce'                    => $this->get_nonce(),
                'wizard_url'                     => admin_url( 'admin.php?page=pretty-opt-in-account-wizard' ),
                'backups_url'                    => admin_url( 'admin.php?page=pretty-opt-in-backups' ),
                'new_locker_url'                 => admin_url( 'admin.php?page=pretty-opt-in-locker-wizard' ),
                'integrations_url'               => admin_url( 'admin.php?page=pretty-opt-in-integrations' ),
            );
        }

    }

endif;
