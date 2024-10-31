<?php
/**
 * Pretty_Opt_In_Core Class
 *
 * Plugin Core Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Core' ) ) :

    class Pretty_Opt_In_Core {

        /**
         * @var Pretty_Opt_In_Admin
         */
        public $admin;

        /**
         * Store modules objects
         *
         * @var array
         */
        public $modules = array();

        /**
         * Store forms objects
         *
         * @var array
         */
        public $forms = array();

        /**
         * Plugin instance
         *
         * @var null
         */
        private static $instance = null;

        /**
         * Return the plugin instance
         *
         * @since 1.0.0
         * @return Pretty_Opt_In_Core
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Pretty_Opt_In_Core constructor.
         *
         * @since 1.0
         */
        public function __construct() {
            // Include all necessary files
            $this->includes();

            if ( is_admin() ) {
                // Initialize admin core
                $this->admin = new Pretty_Opt_In_Admin();         
                // Enabled modules
                $modules = new Pretty_Opt_In_Modules();
                // Add sub pages 
                $this->admin->add_leads_page(); 
                $this->admin->add_integrations_page();
                $this->admin->add_settings_page();
                $this->admin->add_help_page();
            }

            // Enqueue scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

            // Add shortcode
            add_shortcode ('pretty-locker', array( $this, 'display_locker' ), 10, 2);

            add_action( 'init', array( $this, 'verify_subscribe_confirm_link' ) );

            add_action('template_redirect', array( $this, 'process_frontend_action' ));

        }

        /**
        * Add enqueue scripts hooks
        *
        * @since 1.0.0
        *
        * @param $hook
        */
       public function enqueue_scripts( $hook ) {

            // Enqueue front styles
            pretty_opt_in_front_enqueue_styles( PRETTY_OPT_IN_VERSION );

            // Enqueue front scripts
            pretty_opt_in_front_enqueue_scripts( PRETTY_OPT_IN_VERSION );

       }

        /**
        * Display Shortcode
        *
        * @since 1.0.0
        *
        * @param $atts
        */
        public function display_locker($atts) {

            // Get shortcode inner content
            $content = get_the_content();
            $pattern = get_shortcode_regex();
            $matches = array();
            preg_match("/$pattern/s", $content, $matches); 
            $real_content = '<div class="pretty-real-content">'.$matches[5].'</div>';

            $defaults = array(
                'id'  => '',
                'post_id' => get_the_ID(),
                'text' => 'Locker Content'
            );

            $atts = shortcode_atts( $defaults, $atts, 'pretty-locker' );

            extract($atts);

            $template = 'minimal';
            if(!empty($id)){
                $model = Pretty_Opt_In_Locker_Model::model()->load( $id );
                if(is_object($model)){
                    $settings = $model->settings;
                    $template = $settings['template'];

                    // Hide locker when user on mobile devices
                    if($settings['show_on_mobile'] == 'mobile-off'){
                        $useragent=$_SERVER['HTTP_USER_AGENT'];

                        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                            return $real_content; 
                        }
                    }

                    // Hide locker for website register members
                    if($settings['show_on_members'] == 'members-off'){
                        if(is_user_logged_in()){
                            return $real_content; 
                        }
                    }
                }
            }

            $cookie_saved = ( !empty($_COOKIE['pretty_locker_'.COOKIEHASH]) && 'saved' == $_COOKIE['pretty_locker_'.COOKIEHASH] ) ? true : false;	     

            if(!$cookie_saved){
                ob_start();
                include PRETTY_OPT_IN_DIR . 'admin/views/shortcode/template/'.$template.'.php';
                $locker_content = ob_get_contents();
                ob_end_clean();
                return $locker_content; 
            }else{
                return $real_content; 
            }
                      

        }

        /**
         * Includes
         *
         * @since 1.0.0
         */
        private function includes() {
            // Helpers
            require_once PRETTY_OPT_IN_DIR . 'includes/helpers/helper-core.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/helpers/helper-addons.php';

            // Model
            require_once PRETTY_OPT_IN_DIR . 'includes/model/class-locker-model.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/model/class-mailer-model.php';

            // Modules
            require_once PRETTY_OPT_IN_DIR . 'includes/class-modules.php';

            // Mail Services
            require_once PRETTY_OPT_IN_DIR . 'includes/services/abstract-class-mail-services.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-sendgrid-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-activecampaign-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-mailchimp-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-sendinblue-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-mailjet-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-mailerlite-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-freshmail-service.php';
            require_once PRETTY_OPT_IN_DIR . 'includes/services/class-mailpoet-service.php';

            if ( is_admin() ) {
                require_once PRETTY_OPT_IN_DIR . 'admin/abstracts/class-admin-page.php';
                require_once PRETTY_OPT_IN_DIR . 'admin/abstracts/class-admin-module.php';
                require_once PRETTY_OPT_IN_DIR . 'admin/classes/class-admin.php';
            }

        }

        /**
         * Verify double opt-in confirm link
         *
         * @since 1.0.0
         */
        public function verify_subscribe_confirm_link() {
            global $wpdb;
    
            $option = isset($_GET['pretty_confirm']) ? wp_unslash( $_GET['pretty_confirm'] ) : '';
            $hash   = isset($_GET['hash']) ? wp_unslash( $_GET['hash'] ) : '';
    
            if ( ! empty( $hash ) ) {
                $data   = pretty_decode_request_data( $hash );
                $email  = ! empty( $data['email'] ) ? $data['email'] : '';
                $email  = sanitize_email( $email );

                if(pretty_opt_in_email_exists($email)){
                    //Update lead status
                    $where = array('lead_email' => $email);
                    $data = array( 'lead_subscription_confirmed' => '1' );
                    $table_name  = $wpdb->prefix."pretty_leads";
                    $wpdb->update($table_name, $data, $where);

                    // Display subscrube confirm success page
				    include PRETTY_OPT_IN_DIR . "/admin/views/front/subscription-confirm.php";
                }
            }
    
        }

        /**
         * Process frontend actions
         *
         * @since 1.0.0
         */
        public function process_frontend_action() {
            if ( isset( $_REQUEST['pretty-opt-in'] ) ) {
        
                $action = sanitize_text_field( $_REQUEST['pretty-opt-in'] );
        
                if ( 'terms-of-use' === $action ) {
                    return $this->show_terms_of_use();
                }
        
                if ( 'privacy-policy' === $action ) {
                    return $this->show_privacy_policy();
                }
        
            }
        }

        /**
        * Displays the text of the Terms of Use.
        * 
        * @since 1.1.0
        * @return void
        */
        public function show_terms_of_use() {

        ?>

            <html>
                <title><?php echo get_bloginfo('name'); ?></title>
                <body>
                    <?php echo get_option('pretty_predefine_terms', false); ?>
                </body>
            <html>
        
        <?php
        exit;
        }

        /**
        * Displays the text of the privacy & policy.
        * 
        * @since 1.1.0
        * @return void
        */
        public function show_privacy_policy() {

            ?>
    
                <html>
                    <title><?php echo get_bloginfo('name'); ?></title>
                    <body>
                        <?php echo get_option('pretty_predefine_privacy', false); ?>
                    </body>
                <html>
            
            <?php
            exit;
            }       

    }

endif;
