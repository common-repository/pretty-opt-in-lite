<?php
/**
 * Pretty_Opt_In_Stats_Page Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Stats_Page' ) ) :

    class Pretty_Opt_In_Stats_Page extends Pretty_Opt_In_Admin_Page {

        /**
        * Initialize
        *
        * @since 1.0.0
        */
        public function init() {
            $this->processRequest();
        }

        /**
        * Process request
        *
        * @since 1.0.0
        */
        public function processRequest() {
        }
        

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

            
        }

        /**
	    * Return modules
	    *
	    * @since 1.0.0
	    * @return array
	    */
	    public function getModules() {
		    $modules = array();
            $data      = $this->get_models();
            
		    // Fallback
		    if ( ! isset( $data['models'] ) || empty( $data['models'] ) ) {
			    return $modules;
		    }

		    foreach ( $data['models'] as $model ) {
                $settings = $model->get_settings();

                $modules[] = array(
				    "id"              => $model->id,
				    "date"            => date( get_option( 'date_format' ), strtotime( $model->raw->post_date ) ),
                    "status"          => $model->status,
                    "name"            => $model->settings['pretty_locker_name'],  
                );
		    }

		    return $modules;
	    }

        /**
        * Return models
        *
        * @since 1.0.0
        *
        * @param int $limit
        *
        * @return array
        */
        public function get_models( $limit = null ) {
            $data = Pretty_Opt_In_Locker_Model::model()->get_all_paged();

            return $data;
        }

    }

endif;
