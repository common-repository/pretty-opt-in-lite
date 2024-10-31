<?php
/**
 * Pretty_Opt_In_Addon_Loader Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Addon_Loader' ) ) :
    
    class Pretty_Opt_In_Addon_Loader {

        /**
         * Array Access-able of Registered Addons
         *
         * @since 1.0.0
         * @var array
         */
        private $addons = array();

        /**
         * @since 1.0.0
         * @var self
         */
        private static $instance = null;

        /**
         * Get instance of loader
         *
         * @since 1.0.0
         * @return Pretty_Opt_In_Addon_Loader
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }


        /**
         * Pretty_Opt_In_Addon_Loader constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {

            // Initial addons data.
            $addons = array(
                array(
                    'name'  => 'sendgrid',
                    'slug' => 'sendgrid',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/sendgrid.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'activecampaign',
                    'slug' => 'activecampaign',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/activecampaign.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'mailchimp',
                    'slug' => 'mailchimp',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/mailchimp.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'sendinblue',
                    'slug' => 'sendinblue',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/sendinblue.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'mailjet',
                    'slug' => 'mailjet',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/mailjet.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'mailerlite',
                    'slug' => 'mailerlite',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/mailerlite.png',
                    'is_connected' => false
                ),
                array(
                    'name'  => 'freshmail',
                    'slug' => 'freshmail',
                    'icon_url' => PRETTY_OPT_IN_URL.'/assets/images/integrations/freshmail.png',
                    'is_connected' => false
                ),
            );

            $pretty_opt_in_addons = get_option( 'pretty_opt_in_addons', false );

            if ( !$pretty_opt_in_addons || count($pretty_opt_in_addons) !== count($addons) ) {
                update_option( 'pretty_opt_in_addons', $addons );
            }

            $this->addons = get_option( 'pretty_opt_in_addons', false );
        }

        /**
         * Get Addons
         *
         * @since 1.0.0
         **
         * @return array
         */
        public function get_addons( ) {
            return $this->addons;
        }

        /**
         * Save addon data
         *
         * @since 1.0.0
         **
         * @return bool
         */
        public function save_addon_data($data) {

            $addons = $this->addons;

            foreach ( $addons as $key => $addon ) {

                if ( $addon['slug'] == $data['slug'] ) {
                    // Set is_connected true
                    if($data['is_connected']){
                        $data['is_connected'] = false;
                    }else{
                        $data['is_connected'] = true;
                    }
                    $addons[$key] = array_merge($addons[$key], $data);
                }
            }

            update_option( 'pretty_opt_in_addons', $addons );

        }

        /**
         * Get addon data
         *
         * @since 1.0.0
         **
         * @return bool
         */
        public function get_addon_data($slug) {

            $addons = get_option( 'pretty_opt_in_addons', false );
            $selected_addon_data = array();

            foreach ( $addons as $key => $addon ) {
                if ( $addon['slug'] == $slug ) {
                    $selected_addon_data = $addon;
                }
            }

            return $selected_addon_data;
        }

    }

endif;