<?php
/**
 * Pretty_Opt_In_Admin_AJAX Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Admin_AJAX' ) ) :

    class Pretty_Opt_In_Admin_AJAX {

        /**
         * @var Pretty_Opt_In_Mailer_Model
         */
        public $mailer;

        /**
         * Pretty_Opt_In_Admin_AJAX constructor.
         *
         * @since 1.0
         */
        public function __construct() {

            $this->mailer = new Pretty_Opt_In_Mailer_Model();

            // WP Ajax Actions.
            add_action( 'wp_ajax_pretty_opt_in_save_locker', array( $this, 'save_locker' ) );
            add_action( 'wp_ajax_pretty_trigger_unlock', array( $this, 'trigger_unlock' ) );   
            add_action( 'wp_ajax_nopriv_pretty_trigger_unlock', array( $this, 'trigger_unlock' ));
            add_action( 'wp_ajax_pretty_save_glabal_settings', array( $this, 'save_glabal_settings' ) );
            add_action( 'wp_ajax_pretty_select_integration', array( $this, 'select_integration' ) );
            add_action( 'wp_ajax_pretty_save_api_data', array( $this, 'save_api_data' ) );


         
        }

        /**
         * Trigger Unlock
         *
         * @since 1.0.0
         */
        public function trigger_unlock() {

            if ( isset( $_POST['fields_data'] ) ) {
                $global_settings = get_option('pretty_global_settings');
                $pretty_cookie_expiry = isset($global_settings['pretty_cookie_expiry']) ? $global_settings['pretty_cookie_expiry'] : '900';
                $mail_service = isset($global_settings['mail_service']) ? $global_settings['mail_service'] : 'none';

                // Set user cookie
                setcookie('pretty_locker_'.COOKIEHASH, 'saved', time() + $pretty_cookie_expiry, COOKIEPATH);
                
                $fields     = $_POST['fields_data'];
                $post_id    = isset( $fields['post_id'] ) ? $fields['post_id'] : null;
                $post_id    = intval( $post_id );
                $lead_email = isset( $fields['email'] ) ? sanitize_email($fields['email']) : null;

                $model = Pretty_Opt_In_Locker_Model::model()->load( $fields['locker_id'] );
                $settings = $model->settings;

                // Check locker opt_in_mode and send double optin email
                if ( $settings['opt_in_mode'] === 'double-opt-in' && !pretty_opt_in_email_exists($lead_email) ) {
                    // Send subscribe confirm email
                    $headers[] = 'Content-type: text/html; charset=utf-8';
                    $result = $this->mailer->send_double_optin_email($fields['email'], $settings['pretty_double_opt_in_subject'], $settings['pretty_double_opt_in_text'], $headers);
                    if ( !$result ) {
                        wp_send_json_error( esc_html__( 'Send subscribe confirm email failed!', 'pretty-opt-in' ) );
                    }
                }

                // Insert user email into pretty_leads
                if ( !is_null( $lead_email ) && !pretty_opt_in_email_exists($lead_email)) {

                    switch ( $mail_service ) {
                        case 'none' :
                                global $wpdb;
                                $wpdb->insert(
				                    "{$wpdb->prefix}pretty_leads",
				                    array(
                                        'lead_email' =>  $lead_email,
                                        'lead_date'  =>  microtime( true ),
                                        'lead_subscription_confirmed' => 0,
				                    )
                                );
                            break;

                        case 'sendgrid' : 
                            pretty_opt_in_lead_to_sendgrid($lead_email, $settings['subscription_list_id']);
                            break;   

                        case 'activecampaign' : 
                            pretty_opt_in_lead_to_activecampaign($lead_email, $settings['subscription_list_id']);
                        break;  
                        
                        case 'mailchimp' : 
                            pretty_opt_in_lead_to_mailchimp($lead_email, $settings['subscription_list_id']);
                        break; 

                        case 'sendinblue' : 
                            pretty_opt_in_lead_to_sendinblue($lead_email, $settings['subscription_list_id']);
                        break; 

                        case 'mailjet' : 
                            pretty_opt_in_lead_to_mailjet($lead_email, $settings['subscription_list_id']);
                        break;

                        case 'mailerlite' : 
                            pretty_opt_in_lead_to_mailerlite($lead_email, $settings['subscription_list_id']);
                        break;

                        case 'freshmail' : 
                            pretty_opt_in_lead_to_freshmail($lead_email, $settings['subscription_list_id']);
                        break;

                        case 'mailpoet' : 
                            pretty_opt_in_lead_to_mailpoet($lead_email, $settings['subscription_list_id']);
                        break;
        
                        default:
                            break;
                    }
                    
                }

                // Display the real content
                if ( !is_null( $post_id ) || $post_id >= 0 ) {
                    // Get shortcode inner content
                    $post_content = get_post($post_id);
                    $content = $post_content->post_content;
                    $pattern = get_shortcode_regex();
                    $matches = array();
                    preg_match("/$pattern/s", $content, $matches); 
                    wp_send_json_success( $matches[5]  );
                }

                
            } else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', 'pretty-opt-in' ) );
            }


        }    

        /**
         * Save Locker
         *
         * @since 1.0.0
         */
        public function save_locker() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'pretty-opt-in') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', 'pretty-opt-in' ) );
            }

            if ( isset( $_POST['fields_data'] ) ) {
                $fields  = $_POST['fields_data'];
                $id      = isset( $fields['locker_id'] ) ? $fields['locker_id'] : null;
                $id      = intval( $id );
                $title   = sanitize_text_field( $fields['pretty_locker_name'] );
                $status  = isset( $fields['locker_status'] ) ? sanitize_text_field( $fields['locker_status'] ) : '';
                
                if ( is_null( $id ) || $id <= 0 ) {
                    $form_model = new Pretty_Opt_In_Locker_Model();
                    $action     = 'create';
    
                    if ( empty( $status ) ) {
                        $status = Pretty_Opt_In_Locker_Model::STATUS_DRAFT;
                    }
                }else{
                    $form_model = Pretty_Opt_In_Locker_Model::model()->load( $id );
                    $action     = 'update';
                }

                // Set Settings to model
                $form_model->settings = $fields;

                // status
                $form_model->status = $status;

                // Save data
                $id = $form_model->save();

                if (!$id) {
                    wp_send_json_error( $id );
                }else{
                    wp_send_json_success( $id );
                }

                wp_send_json_success( esc_html__( 'Locker saved successfully!', 'pretty-opt-in' ) );
            } else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', 'pretty-opt-in' ) );
            }

        }

        /**
         * Save Global Settings
         *
         * @since 1.0.0
         */
        public function save_glabal_settings() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'pretty-opt-in') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', 'pretty-opt-in' ) );
            }

            if ( isset( $_POST['fields_data'] ) ) {
                update_option( 'pretty_global_settings', pretty_recursive_sanitize_text_field($_POST['fields_data']) );
                update_option( 'pretty_predefine_terms', sanitize_text_field( $_POST['fields_data']['pretty_predefine_terms'] ) );
                update_option( 'pretty_predefine_privacy', sanitize_text_field ( $_POST['fields_data']['pretty_predefine_privacy'] ) );    
                wp_send_json_success( esc_html__( 'Global Settings has been connected successfully.', 'pretty-opt-in' ) );
            } else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', 'pretty-opt-in' ) );
            }
            
        }

        /**
        * Select Integration
        *
        * @since 1.0.0
        */
        public function select_integration() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'pretty-opt-in') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', 'pretty-opt-in' ) );
            }

            if ( isset( $_POST['template'] ) ) {
                $template = pretty_opt_in_load_popup($_POST['template']);
                wp_send_json_success( $template );
            }

        }

        /**
        * Save API Data
        *
        * @since 1.0.0
        */
        public function save_api_data() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'pretty-opt-in') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', 'pretty-opt-in' ) );
            }

            if ( isset( $_POST['fields_data'] ) ) {
                // Sanitize api data
                $api_data = pretty_opt_in_sanitize_field( $_POST['fields_data'] );
                pretty_opt_in_save_addon_data($api_data);
                $message = '<strong>' . $api_data['slug'] . '</strong> ' . esc_html__( 'has been connected successfully.', 'pretty-opt-in' );

                wp_send_json_success( $message );
            }else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', 'pretty-opt-in' ) );
            }

        }

    }

endif;
