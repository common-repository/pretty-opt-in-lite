<?php
/**
 * Pretty_Opt_In_Integrations_Page Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Integrations_Page' ) ) :

    class Pretty_Opt_In_Integrations_Page extends Pretty_Opt_In_Admin_Page {

        /**
         * Add page screen hooks
         *
         * @since 1.0.0
         *
         * @param $hook
         */
        public function enqueue_scripts( $hook ) {
            // Load admin styles
            pretty_opt_in_admin_enqueue_styles( PRETTY_OPT_IN_VERSION );

            $pretty_opt_in_data = new Pretty_Opt_In_Admin_Data();

            // Load admin leads scripts
            pretty_opt_in_admin_enqueue_scripts_integrations(
                PRETTY_OPT_IN_VERSION,
                $pretty_opt_in_data->get_options_data()
            );

            
        }

    }

endif;
