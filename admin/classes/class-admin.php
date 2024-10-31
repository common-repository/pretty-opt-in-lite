<?php
/**
 * Pretty_Opt_In_Admin Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Admin' ) ) :

    class Pretty_Opt_In_Admin {

        /**
         * @var array
         */
        public $pages = array();

        /**
         * Pretty_Opt_In_Admin constructor.
         */
        public function __construct() {
            $this->includes();

            // Init admin pages
            add_action( 'admin_menu', array( $this, 'add_dashboard_page' ) );

            // Init Admin AJAX class
            new Pretty_Opt_In_Admin_AJAX();

            /**
             * Triggered when Admin is loaded
             */
            do_action( 'pretty_opt_in_admin_loaded' );
        }

        /**
         * Include required files
         *
         * @since 1.0.0
         */
        private function includes() {
            // Admin pages
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/dashboard-page.php';
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/help-page.php';
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/leads-page.php';
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/stats-page.php';
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/integrations-page.php';
            require_once PRETTY_OPT_IN_DIR . '/admin/pages/settings-page.php';

            // Admin AJAX
            require_once PRETTY_OPT_IN_DIR . '/admin/classes/class-admin-ajax.php';

            // Admin Data
            require_once PRETTY_OPT_IN_DIR . '/admin/classes/class-admin-data.php';
        }

        /**
         * Initialize Dashboard page
         *
         * @since 1.0.0
         */
        public function add_dashboard_page() {
            $title = esc_html__( 'Pretty Opt In', 'pretty-opt-in' );
            $this->pages['pretty_opt_in']           = new Pretty_Opt_In_Dashboard_Page( 'pretty-opt-in', 'dashboard', $title, $title, false, false );
            $this->pages['pretty_opt_in-dashboard'] = new Pretty_Opt_In_Dashboard_Page( 'pretty-opt-in', 'dashboard', esc_html__( 'Pretty Opt In Dashboard', 'pretty-opt-in' ), esc_html__( 'Dashboard', 'pretty-opt-in' ), 'pretty-opt-in' );
        }

        /**
         * Add help page
         *
         * @since 1.0.0
         */
        public function add_help_page() {
            add_action( 'admin_menu', array( $this, 'init_help_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_help_page() {
            $this->pages['pretty-opt-in_help'] = new Pretty_Opt_In_Help_Page(
                'pretty-opt-in-help',
                'help',
                esc_html__( 'Help', 'pretty-opt-in' ),
                esc_html__( 'Help', 'pretty-opt-in' ),
                'pretty-opt-in'
            );
        }

        /**
         * Add leads page
         *
         * @since 1.0.0
         */
        public function add_leads_page() {
            add_action( 'admin_menu', array( $this, 'init_leads_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_leads_page() {
            $this->pages['pretty-opt-in_leads'] = new Pretty_Opt_In_Leads_Page(
                'pretty-opt-in-leads',
                'leads',
                esc_html__( 'Leads', 'pretty-opt-in' ),
                esc_html__( 'Leads', 'pretty-opt-in' ),
                'pretty-opt-in'
            );
        }

        /**
         * Add stats page
         *
         * @since 1.0.0
         */
        public function add_stats_page() {
            add_action( 'admin_menu', array( $this, 'init_stats_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_stats_page() {
            $this->pages['pretty-opt-in_stats'] = new Pretty_Opt_In_Stats_Page(
                'pretty-opt-in-stats',
                'stats',
                esc_html__( 'Stats', 'pretty-opt-in' ),
                esc_html__( 'Stats', 'pretty-opt-in' ),
                'pretty-opt-in'
            );
        }


        /**
         * Add Integrations page
         *
         * @since 1.0.0
         */
        public function add_integrations_page() {
            add_action( 'admin_menu', array( $this, 'init_integrations_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_integrations_page() {
            $this->pages['pretty-opt-in_integrations'] = new Pretty_Opt_In_Integrations_Page(
                'pretty-opt-in-integrations',
                'integrations',
                esc_html__( 'Integrations', 'pretty-opt-in' ),
                esc_html__( 'Integrations', 'pretty-opt-in' ),
                'pretty-opt-in'
            );
        }

        /**
         * Add settings page
         *
         * @since 1.0.0
         */
        public function add_settings_page() {
            add_action( 'admin_menu', array( $this, 'init_settings_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_settings_page() {
            $this->pages['pretty-opt-in_settings'] = new Pretty_Opt_In_Settings_Page(
                'pretty-opt-in-settings',
                'settings',
                esc_html__( 'Settings', 'pretty-opt-in' ),
                esc_html__( 'Settings', 'pretty-opt-in' ),
                'pretty-opt-in'
            );
        }


    }

endif;
