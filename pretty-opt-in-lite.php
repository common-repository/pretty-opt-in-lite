<?php
/**
 * Plugin Name: Pretty Opt-In Lite
 * Plugin URI: http://wphobby.com
 * Description: Pretty Opt In makes you can create the premium content locker (e.g. downloads, discounts, videos and so on) for lead generation.
 * Version: 1.3.15
 * Author: wphobby
 * Author URI: https://wphobby.com/
 *
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Set constants
 */
if ( ! defined( 'PRETTY_OPT_IN_DIR' ) ) {
    define( 'PRETTY_OPT_IN_DIR', plugin_dir_path(__FILE__) );
}

if ( ! defined( 'PRETTY_OPT_IN_URL' ) ) {
    define( 'PRETTY_OPT_IN_URL', plugin_dir_url(__FILE__) );
}

if ( ! defined( 'PRETTY_OPT_IN_VERSION' ) ) {
    define( 'PRETTY_OPT_IN_VERSION', '1.3.15' );
}

// Register activation hook
register_activation_hook( __FILE__, array( 'Pretty_Opt_In', 'activation_hook' ) );

/**
 * Class Pretty_Opt_In
 *
 * Main class. Initialize plugin
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Pretty_Opt_In' ) ) {
    /**
     * Pretty_Opt_In
     */
    class Pretty_Opt_In {

        const DOMAIN = 'pretty-opt-in';

        /**
         * Instance of Pretty_Opt_In
         *
         * @since  1.0.0
         * @var (Object) Pretty_Opt_In
         */
        private static $_instance = null;

        /**
         * Get instance of Pretty_Opt_In
         *
         * @since  1.0.0
         *
         * @return object Class object
         */
        public static function get_instance() {
            if ( ! isset( self::$_instance ) ) {
                self::$_instance = new self;
            }
            return self::$_instance;
        }

        /**
         * Constructor
         *
         * @since  1.0.0
         */
        private function __construct() {
            $this->includes();
            $this->init();
        }

        /**
		 * Called on plugin activation
		 *
		 * @since 1.0.8
		 */
		public static function activation_hook() {
            set_transient( '_pretty_opt_in_activation_redirect', 1 );
		}

        /**
         * Load plugin files
         *
         * @since 1.0
         */
        private function includes() {
            // Core files.
            require_once PRETTY_OPT_IN_DIR . '/includes/class-core.php';
            require_once PRETTY_OPT_IN_DIR  . '/includes/class-addon-loader.php';
        }


        /**
         * Init the plugin
         *
         * @since 1.0.0
         */
        private function init() {
            global $wp_filesystem;
            // Initialize the WP filesystem, no more using 'file-put-contents' function
            if (empty($wp_filesystem)) {
                require_once (ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }
            // Initialize plugin core
            $this->pretty_opt_in = Pretty_Opt_In_Core::get_instance();

            // Create tables
            $this->create_tables();

            add_action( 'admin_init', array( $this, 'welcome' ) );

            /**
             * Triggered when plugin is loaded
             */
            do_action( 'pretty_opt_in_loaded' );

            // Predefine options
            if(!get_option('pretty_predefine_terms', false)){
                add_option('pretty_predefine_terms', $wp_filesystem->get_contents( PRETTY_OPT_IN_DIR . '/admin/views/predefine/terms-of-use.html' ));
            }

            if(!get_option('pretty_predefine_privacy', false)){
                add_option('pretty_predefine_privacy', $wp_filesystem->get_contents( PRETTY_OPT_IN_DIR . '/admin/views/predefine/pravicy-policy.html' ));
            }

        }

        /** Redirect to welcome page when activation */
		public function welcome() {
            $page_url = 'admin.php?page=pretty-opt-in';
            if ( ! get_transient( '_pretty_opt_in_activation_redirect' ) ) {
                return;
            }
            delete_transient( '_pretty_opt_in_activation_redirect' );
            wp_safe_redirect( admin_url( $page_url ) );
            exit;
		}

        /**
         * @since 1.0.0
         */
        public function create_tables() {
            global $wpdb;
            $wpdb->hide_errors();

            $table_schema = [
                "
            CREATE TABLE IF NOT EXISTS {$wpdb->prefix}pretty_leads (
              ID int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
              lead_email varchar(50) NOT NULL,
              lead_date int(11) NOT NULL,
              lead_subscription_confirmed int(1) NOT NULL DEFAULT 0 COMMENT 'subscription',
              PRIMARY KEY  (ID),
              UNIQUE KEY lead_email (lead_email)
            );",
            ];
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            foreach ( $table_schema as $table ) {
                dbDelta( $table );
            }
        }

    }
}

if ( ! function_exists( 'pretty_opt_in' ) ) {
    function pretty_opt_in() {
        return Pretty_Opt_In::get_instance();
    }

    /**
     * Init the plugin and load the plugin instance
     *
     * @since 1.0.0
     */
    add_action( 'plugins_loaded', 'pretty_opt_in' );
}

if ( ! function_exists( 'poil_fs' ) ) {
    // Create a helper function for easy SDK access.
    function poil_fs() {
        global $poil_fs;

        if ( ! isset( $poil_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $poil_fs = fs_dynamic_init( array(
                'id'                  => '9165',
                'slug'                => 'pretty-opt-in-lite',
                'premium_slug'        => 'pretty-opt-in-premium',
                'type'                => 'plugin',
                'public_key'          => 'pk_7faa888c983176bfbc7164c38cdb1',
                'is_premium'          => false,
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'           => 'pretty-opt-in',
                    'first-path'     => 'admin.php?page=pretty-opt-in',
                    'support'        => false,
                ),
            ) );
        }

        return $poil_fs;
    }

    // Init Freemius.
    poil_fs();
    // Signal that SDK was initiated.
    do_action( 'poil_fs_loaded' );
}