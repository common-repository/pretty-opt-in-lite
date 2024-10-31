<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Get registered addons grouped by connected status
 *
 * @since 1.0.0
 * @return array
 */
function pretty_opt_in_get_addons() {

    // Integrations Addons
    $addons_list = Pretty_Opt_In_Addon_Loader::get_instance()->get_addons();

    $connected_addons     = array();
    $not_connected_addons = array();

    foreach ( $addons_list as $key => $addon ) {
        if ( $addon['is_connected'] ) {
            $connected_addons[] = $addon;
        } else {
            $not_connected_addons[] = $addon;
        }
    }

    return array(
        'connected'     => $connected_addons,
        'not_connected' => $not_connected_addons,
    );
}

/**
 * Load popup template
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_load_popup($template){

    $file    = PRETTY_OPT_IN_DIR . "admin/views/integrations/popups/$template.php";
    $content = '';

    if ( is_file( $file ) ) {
        ob_start();

        include $file;

        $content = ob_get_clean();
    }

    return $content;
}

/**
 * Get addon api data
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_get_addon_data($slug){
    $data = Pretty_Opt_In_Addon_Loader::get_instance()->get_addon_data($slug);
    return $data;
}

/**
 * Save addon api data
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_save_addon_data($data){
    Pretty_Opt_In_Addon_Loader::get_instance()->save_addon_data($data);
}

/**
 * Save lead email to sendgrid
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_sendgrid($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_SendGrid_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to sendgrid
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_activecampaign($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_ActiveCampaign_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to mailchimp
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_mailchimp($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_MailChimp_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to sendinblue
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_sendinblue($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_SendInBlue_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to mailjet
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_mailjet($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_MailJet_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to mailerlite
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_mailerlite($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_MailerLite_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to freshmail
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_freshmail($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_FreshMail_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Save lead email to mailpoet
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_lead_to_mailpoet($lead_email, $list_id){
    // Initial mail service class and subscribe
    $mail_service = new Pretty_MailPoet_Service();
    $result = $mail_service->subscribe($lead_email, $list_id);

    // Return this mail service subscribe result
    return $result;
}

/**
 * Get mail services subscription list
 * 
 * @since 1.0.0
 * @return string
 */
function pretty_get_subscription_lists($mail_service){
    $lists = array();
    switch ( $mail_service ) {

        case 'sendgrid' : 
                $mail_service = new Pretty_SendGrid_Service();
                $lists = $mail_service->get_lists();
            break;  
            
        case 'activecampaign' : 
                $mail_service = new Pretty_ActiveCampaign_Service();
                $lists = $mail_service->get_lists();
            break; 
            
        case 'mailchimp' : 
                $mail_service = new Pretty_MailChimp_Service();
                $lists = $mail_service->get_lists();
            break; 
        
        case 'sendinblue' : 
                $mail_service = new Pretty_SendInBlue_Service();
                $lists = $mail_service->get_lists();
            break;  
            
        case 'mailjet' : 
                $mail_service = new Pretty_MailJet_Service();
                $lists = $mail_service->get_lists();
            break;  
            
        case 'mailerlite' : 
                $mail_service = new Pretty_MailerLite_Service();
                $lists = $mail_service->get_lists();
            break; 
            
        case 'freshmail' : 
                $mail_service = new Pretty_FreshMail_Service();
                $lists = $mail_service->get_lists();
            break; 
           
        case 'mailpoet' : 
                $mail_service = new Pretty_MailPoet_Service();
                $lists = $mail_service->get_lists();
            break;    

        default:
            break;
    }

    return $lists;
}