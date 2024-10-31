<?php
/**
 * Pretty_Opt_In_Leads_Page Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Leads_Page' ) ) :

    class Pretty_Opt_In_Leads_Page extends Pretty_Opt_In_Admin_Page {

        /**
        * Page number
        *
        * @var int
        */
        protected $page_number = 1;

        /**
        * Initialize
        *
        * @since 1.0.0
        */
        public function init() {
            $pagenum           = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0; // WPCS: CSRF OK
            $this->page_number = max( 1, $pagenum );
            $this->processRequest();
        }

        /**
        * Process request
        *
        * @since 1.0.0
        */
        public function processRequest() {
            if ( ! isset( $_POST['pretty_leads_nonce'] ) ) {
                return;
            }

            $nonce = $_POST['pretty_leads_nonce'];
            if ( ! wp_verify_nonce( $nonce, 'pretty-leads-request' ) ) {
                return;
            }

            $is_redirect = true;
            $action = "";
            if(isset($_POST['pretty_bulk_action'])){
                $action = sanitize_text_field($_POST['pretty_bulk_action']);
                $leads_ids = isset( $_POST['leads-ids'] ) ? sanitize_text_field( $_POST['leads-ids'] ) : '';
            }

            switch ( $action ) {
                case 'delete-leads' :
                    if ( isset( $leads_ids ) && !empty( $leads_ids ) ) {
                        $leads = explode( ',', $leads_ids );
                        if ( is_array( $leads ) && count( $leads ) > 0 ) {
                            foreach ( $leads as $lead ) {
                                if (!empty($lead)) {
                                    global $wpdb;
                                    $table = $wpdb->prefix.'pretty_leads';
                                    $wpdb->delete( $table, array( 'id' => $lead ) );
                                }
                            }    
                        }
                    }
                    break;

                default:
                    break;
            }

            if ( $is_redirect ) {
                $fallback_redirect = admin_url( 'admin.php' );
                $fallback_redirect = add_query_arg(
                    array(
                        'page' => $this->get_admin_page(),
                    ),
                    $fallback_redirect
                );

                $this->maybe_redirect_to_referer( $fallback_redirect );
            }

            exit;


        }

        /**
         * Count leads
         *
         * @since 1.0.0
         * @return int
         */
        public function countLeads() {
            global $wpdb;
            $total_query = "SELECT COUNT(*) FROM {$wpdb->prefix}pretty_leads AS total_count";
            $total = $wpdb->get_var( $total_query );
            return $total;
        }

        /**
         * Get leads
         *
         * @since 1.0.0
         * @return int
         */
        public function getLeads( $args = array() ) {
            global $wpdb;
            $pagenum     = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0; // phpcs:ignore
            $page_number = max( 1, $pagenum );
            $global_settings = get_option('pretty_global_settings');
            $per_page = isset($global_settings['pretty_leads_per_page']) ? $global_settings['pretty_leads_per_page'] : 10;
            $default     = array(
                'search'   => '',
                'level'     => '',
                'orderby'  => 'created',
                'order'    => 'DESC',
                'per_page' => $per_page,
                'page'     => $page_number,
                'offset'   => 0,
            );
            $args        = wp_parse_args( $args, $default );
            $query_from  = "FROM {$wpdb->prefix}pretty_leads";
            $query_where = 'WHERE 1=1';

            // limit
            if ( isset( $args['per_page'] ) && $args['per_page'] > 0 ) {
                if ( $args['offset'] ) {
                    $query_limit = $wpdb->prepare( 'LIMIT %d, %d', $args['offset'], $args['per_page'] );
                } else {
                    $query_limit = $wpdb->prepare( 'LIMIT %d, %d', $args['per_page'] * ( $args['page'] - 1 ), $args['per_page'] );
                }
            }

            return $wpdb->get_results( "SELECT * $query_from $query_where $query_limit", ARRAY_A );
        }

        /**
         * Pagination
         *
         * @since 1.0.0
         */
        public function pagination() {
            $count = $this->countLeads();
            pretty_opt_in_list_pagination( $count, 'leads' );
        }


        /**
        * Bulk actions
        *
        * @since 1.0
        * @return array
        */
        public function bulk_actions() {
            return apply_filters(
                'pretty_leads_bulk_actions',
                array(
                    'delete-leads'     => esc_html__( "Delete", 'pretty-opt-in' ),
                )
            );
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

            // Load admin leads scripts
            pretty_opt_in_admin_enqueue_scripts_leads(
                PRETTY_OPT_IN_VERSION,
                $pretty_opt_in_data->get_options_data()
            );
        }

    }

endif;
