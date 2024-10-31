<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Return needed cap for admin pages
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_get_admin_cap() {
    $cap = 'manage_options';

    if ( is_multisite() && is_network_admin() ) {
        $cap = 'manage_network';
    }

    return apply_filters( 'pretty_opt_in_admin_cap', $cap );
}

/**
 * Enqueue front styles
 *
 * @since 1.0.0
 *
 * @param $version
 */
function pretty_opt_in_front_enqueue_styles( $version ) {
    wp_enqueue_style( 'pretty-front-style', PRETTY_OPT_IN_URL . 'assets/css/front.css', array(), $version, false );
}

/**
 * Enqueue front scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_front_enqueue_scripts( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
    wp_register_script(
        'pretty-locker-front',
        PRETTY_OPT_IN_URL . 'assets/js/locker-front.js',
        array('jquery'),
        $version,
        false
    );

    wp_enqueue_script( 'pretty-locker-front' );

    $data = array(
        'ajaxurl' => pretty_opt_in_ajax_url(),
    );

    wp_localize_script( 'pretty-locker-front', 'Pretty_Front_Data', $data );
}

/**
 * Enqueue admin styles
 *
 * @since 1.0.0
 *
 * @param $version
 */
function pretty_opt_in_admin_enqueue_styles( $version ) {
    wp_enqueue_style( 'magnific-popup', PRETTY_OPT_IN_URL . 'assets/css/magnific-popup.css', array(), $version, false );
    wp_enqueue_style( 'pretty-opt-in-select2-style', PRETTY_OPT_IN_URL . 'assets/css/select2.min.css', array(), $version, false );
    wp_enqueue_style( 'pretty-opt-in-main-style', PRETTY_OPT_IN_URL . 'assets/css/main.css', array(), $version, false );
}

/**
 * Enqueue admin scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts( $version, $data = array(), $l10n = array() ) {

    if ( function_exists( 'wp_enqueue_editor' ) ) {
        wp_enqueue_editor();
    }
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_enqueue_script( 'jquery-magnific-popup', PRETTY_OPT_IN_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );
}

/**
 * Enqueue admin backups scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_locker_edit( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'jquery-magnific-popup', PRETTY_OPT_IN_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-locker-edit',
        PRETTY_OPT_IN_URL . 'assets/js/locker-edit.js',
        array('jquery'),
        $version,
        false
    );

    wp_enqueue_script( 'pretty-locker-edit' );

    wp_localize_script( 'pretty-locker-edit', 'Pretty_Opt_In_Data', $data );
}

/**
 * Enqueue admin backups scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_locker_list( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_enqueue_script( 'jquery-magnific-popup', PRETTY_OPT_IN_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-opt-in-locker-list',
        PRETTY_OPT_IN_URL . 'assets/js/locker-list.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'pretty-opt-in-locker-list' );

    wp_localize_script( 'pretty-opt-in-locker-list', 'Pretty_Opt_In_Data', $data );
}

/**
 * Enqueue admin dashboard scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_dashboard( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_enqueue_script( 'jquery-magnific-popup', PRETTY_OPT_IN_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-opt-in-dashboard',
        PRETTY_OPT_IN_URL . 'assets/js/dashboard.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'pretty-opt-in-dashboard' );

    wp_localize_script( 'pretty-opt-in-dashboard', 'Pretty_Opt_In_Data', $data );
}
/**
 * Enqueue admin help scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_help( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
}
/**
 * Enqueue admin leads scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_leads( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-opt-in-leads',
        PRETTY_OPT_IN_URL . 'assets/js/leads.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'pretty-opt-in-leads' );

    wp_localize_script( 'pretty-opt-in-leads', 'Pretty_Opt_In_Data', $data );
   
}

/**
 * Enqueue admin leads scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_integrations( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'jquery-magnific-popup', PRETTY_OPT_IN_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-opt-in-integrations',
        PRETTY_OPT_IN_URL . 'assets/js/integrations.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'pretty-opt-in-integrations' );

    wp_localize_script( 'pretty-opt-in-integrations', 'Pretty_Opt_In_Data', $data );
   
}

/**
 * Enqueue admin settings scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function pretty_opt_in_admin_enqueue_scripts_settings( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'pretty-ionicons', PRETTY_OPT_IN_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_enqueue_script( 'pretty-opt-in-select2', PRETTY_OPT_IN_URL . '/assets/js/library/select2.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'pretty-opt-in-settings',
        PRETTY_OPT_IN_URL . 'assets/js/settings.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'pretty-opt-in-settings' );
    
    wp_localize_script( 'pretty-opt-in-settings', 'Pretty_Opt_In_Data', $data );
}

/**
 * Load admin scripts
 *
 * @since 1.0.0
 */
function pretty_opt_in_admin_jquery_ui_init() {
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-widget' );
    wp_enqueue_script( 'jquery-ui-mouse' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-draggable' );
    wp_enqueue_script( 'jquery-ui-droppable' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-resize' );
    wp_enqueue_style( 'wp-color-picker' );
}

/**
 * Return AJAX url
 *
 * @since 1.0.0
 * @return mixed
 */
function pretty_opt_in_ajax_url() {
    return admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' );
}

/**
 * Handle all pagination
 *
 * @since 1.0
 *
 * @param int $total - the total records
 * @param string $type - The type of page (listings or entries)
 *
 * @return string
 */
function pretty_opt_in_list_pagination( $total, $type = 'leads' ) {
    $pagenum     = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0; // phpcs:ignore
    $page_number = max( 1, $pagenum );
    $global_settings = get_option('pretty_global_settings');
    $per_page = isset($global_settings['pretty_leads_per_page']) ? $global_settings['pretty_leads_per_page'] : 10;
    if($type == 'lockers'){
        $per_page = isset($global_settings['pretty_lockers_per_page']) ? $global_settings['pretty_lockers_per_page'] : 10;
    }
    if ( $total > $per_page ) {
        $removable_query_args = wp_removable_query_args();

        $current_url   = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
        $current_url   = remove_query_arg( $removable_query_args, $current_url );
        $current       = $page_number + 1;
        $total_pages   = ceil( $total / $per_page );
        $total_pages   = absint( $total_pages );
        $disable_first = false;
        $disable_last  = false;
        $disable_prev  = false;
        $disable_next  = false;
        $mid_size      = 2;
        $end_size      = 1;
        $show_skip     = false;

        if ( $total_pages > 10 ) {
            $show_skip = true;
        }

        if ( $total_pages >= 4 ) {
            $disable_prev = true;
            $disable_next = true;
        }

        if ( 1 === $page_number ) {
            $disable_first = true;
        }

        if ( $page_number === $total_pages ) {
            $disable_last = true;

        }

        ?>
        <ul class="pretty-pagination">

            <?php if ( ! $disable_first ) : ?>
                <?php
                $prev_url  = esc_url( add_query_arg( 'paged', min( $total_pages, $page_number - 1 ), $current_url ) );
                $first_url = esc_url( add_query_arg( 'paged', min( 1, $total_pages ), $current_url ) );
                ?>
                <?php if ( $show_skip ) : ?>
                    <li class="pretty-pagination--prev">
                        <a href="<?php echo esc_attr( $first_url ); ?>"><i class="pretty-icon-arrow-skip-start" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( $disable_prev ) : ?>
                    <li class="pretty-pagination--prev">
                        <a href="<?php echo esc_attr( $prev_url ); ?>"><i class="pretty-icon-chevron-left" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            $dots = false;
            for ( $i = 1; $i <= $total_pages; $i ++ ) :
                $class = ( $page_number === $i ) ? 'pretty-active' : '';
                $url   = esc_url( add_query_arg( 'paged', ( $i ), $current_url ) );
                if ( ( $i <= $end_size || ( $current && $i >= $current - $mid_size && $i <= $current + $mid_size ) || $i > $total_pages - $end_size ) ) {
                    ?>
                    <li class="<?php echo esc_attr( $class ); ?>"><a href="<?php echo esc_attr( $url ); ?>" class="<?php echo esc_attr( $class ); ?>"><?php echo esc_html( $i ); ?></a></li>
                    <?php
                    $dots = true;
                } elseif ( $dots ) {
                    ?>
                    <li class="pretty-pagination-dots"><span><?php esc_html_e( '&hellip;' ); ?></span></li>
                    <?php
                    $dots = false;
                }

                ?>

            <?php endfor; ?>

            <?php if ( ! $disable_last ) : ?>
                <?php
                $next_url = esc_url( add_query_arg( 'paged', min( $total_pages, $page_number + 1 ), $current_url ) );
                $last_url = esc_url( add_query_arg( 'paged', max( $total_pages, $page_number - 1 ), $current_url ) );
                ?>
                <?php if ( $disable_next ) : ?>
                    <li class="pretty-pagination--next">
                        <a href="<?php echo esc_attr( $next_url ); ?>"><i class="pretty-icon-chevron-right" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( $show_skip ) : ?>
                    <li class="pretty-pagination--next">
                        <a href="<?php echo esc_attr( $last_url ); ?>"><i class="pretty-icon-arrow-skip-end" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <?php
    }
}

/**
 * Get locker name by id
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_get_locker_name($id) {
    $model = Pretty_Opt_In_Locker_Model::model()->load( $id );

	$settings = $model->settings;

    // Return Locker Name
	if ( ! empty( $settings['pretty_locker_name'] ) ) {
		return $settings['pretty_locker_name'];
	}
}

/**
 * Get locker next run time by id
 *
 * @since 1.0.0
 * @return string
 */
function pretty_opt_in_get_next_run_time($id) {
    $model = Pretty_Opt_In_Locker_Model::model()->load( $id );

	$settings = $model->settings;

    // Return locker next run time
	if ( ! empty( $settings['next_run_time'] ) ) {
        return wp_date( "M j G:i:s Y", $settings['next_run_time'], wp_timezone() );
	}
}

/**
 * Central per page for form view
 *
 * @since 1.0.0
 * @return int
 */
function pretty_opt_in_view_per_page( $type = 'listings' ) {

    $global_settings = get_option('pretty_global_settings');
    $per_page = isset($global_settings['pretty_lockers_per_page']) ? $global_settings['pretty_lockers_per_page'] : 10;

	// force at least 1 data per page
	if ( $per_page < 1 ) {
		$per_page = 1;
	}
	return apply_filters( 'pretty_opt_in_per_page', $per_page, $type );
}

/**
 * Display selected user roles
 */

function pretty_opt_in_display_roles($role, $name, $selected_roles){

	echo  '<option class="create_lockers_roles" ';
    if(is_array($selected_roles)){
		if (in_array($role, $selected_roles)) {
			echo ' selected="selected" ';
		}
	}
    echo  ' value="'.$role.'">'.$name.'</option>';

}

function pretty_opt_in_email_exists($email){
    // first check if data exists with select query
    global $wpdb;
    $leads_table = $wpdb->prefix.'pretty_leads';
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $leads_table WHERE lead_email = '$email'");

    if($count == 1) {
      return true;
    }else{
        return false;
    }
}

/**
* Encode request data
*
* @param $data
*
* @return string
*/
function pretty_encode_request_data( $data ) {
	return rtrim( base64_encode( json_encode( $data ) ), '=' );
}

/**
* Decode request data
*
* @param $data
*
* @return array
*/
function pretty_decode_request_data( $data ) {
	$data = json_decode( base64_decode( $data ), true );
	if ( ! is_array( $data ) ) {
		$data = array();
	}

	return $data;
}

/**
 * Recursive sanitize an array
 * 
 * @param $array
 *
 * @return mixed
 */
function pretty_recursive_sanitize_text_field($array) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = pretty_recursive_sanitize_text_field($value);
        }
        else {
            $value = sanitize_text_field( $value );
        }
    }

    return $array;
}

/**
 * Sanitize field
 *
 * @since 1.0.0
 *
 * @param $field
 *
 * @return array|string
 */
function pretty_opt_in_sanitize_field( $field ) {
    // If array map all fields
    if ( is_array( $field ) ) {
        return array_map( 'pretty_opt_in_sanitize_field', $field );
    }

    return wp_strip_all_tags( $field );
}