<?php
global $wp_roles;
$global_settings = get_option('pretty_global_settings');
// Initial permission roles
$create_lockers_roles = isset($global_settings['create_lockers_roles']) ? $global_settings['create_lockers_roles'] : array(0 => 'administrator');
$edit_lockers_roles = isset($global_settings['edit_lockers_roles']) ? $global_settings['edit_lockers_roles'] : array(0 => 'administrator');
$access_leads_roles = isset($global_settings['access_leads_roles']) ? $global_settings['access_leads_roles'] : array(0 => 'administrator');
$edit_settings_roles = isset($global_settings['edit_settings_roles']) ? $global_settings['edit_settings_roles'] : array(0 => 'administrator');

?>
<div id="permissions" class="pretty-box-tab" >

    <div class="pretty-box-header">
        <h2 class="pretty-box-title"><?php esc_html_e( 'Permissions', 'pretty-opt-in' ); ?></h2>
    </div>

    <form class="pretty-settings-form" method="post" action="">

    <div class="pretty-box-body">
        <div class="pretty-box-settings-row">
            <div class="pretty-box-settings-col-1">
                <span class="pretty-settings-label"><?php esc_html_e( 'Create Lockers', 'pretty-opt-in' ); ?></span>
                <span class="pretty-description"><?php esc_html_e( 'Choose the user roles which can create new lockers.', 'pretty-opt-in' ); ?></span>    
            </div>
            <div class="pretty-box-settings-col-2">
                <select class="create-lockers-multi-select" multiple="true">
                    <?php
                    foreach ( $wp_roles->roles as $key=>$value ) {
                        pretty_opt_in_display_roles( $key, $value['name'], $create_lockers_roles);
                    }
                    // Always select administrator role
                    if (!in_array('administrator', $create_lockers_roles)) {
                        echo  '<option class="create_lockers_roles" selected="selected" value="administrator">Administrator</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="pretty-box-settings-row">
            <div class="pretty-box-settings-col-1">
                <span class="pretty-settings-label"><?php esc_html_e( 'Edit Existing Lockers', 'pretty-opt-in' ); ?></span>
                <span class="pretty-description"><?php esc_html_e( 'Choose the user roles which can edit the existing lockers.', 'pretty-opt-in' ); ?></span>    
            </div>
            <div class="pretty-box-settings-col-2">
                <select class="edit-lockers-multi-select" multiple="true">
                    <?php
                    foreach ( $wp_roles->roles as $key=>$value ) {
                        pretty_opt_in_display_roles( $key, $value['name'], $edit_lockers_roles);
                    }
                    // Always select administrator role
                    if (!in_array('administrator', $edit_lockers_roles)) {
                        echo  '<option class="edit_lockers_roles" selected="selected" value="administrator">Administrator</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="pretty-box-settings-row">
            <div class="pretty-box-settings-col-1">
                <span class="pretty-settings-label"><?php esc_html_e( 'Access Leads Email List', 'pretty-opt-in' ); ?></span>
                <span class="pretty-description"><?php esc_html_e( 'Choose the user roles which can access the Leads Email List for the opt-in .', 'pretty-opt-in' ); ?></span>    
            </div>
            <div class="pretty-box-settings-col-2">
                <select class="access-leads-multi-select" multiple="true">
                    <?php
                    foreach ( $wp_roles->roles as $key=>$value ) {
                        pretty_opt_in_display_roles( $key, $value['name'], $access_leads_roles);
                    }
                    // Always select administrator role
                    if (!in_array('administrator', $access_leads_roles)) {
                        echo  '<option class="access_leads_roles" selected="selected" value="administrator">Administrator</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="pretty-box-settings-row">
            <div class="pretty-box-settings-col-1">
                <span class="pretty-settings-label"><?php esc_html_e( 'Edit Settings', 'pretty-opt-in' ); ?></span>
                <span class="pretty-description"><?php esc_html_e( 'Choose the user roles which can access the Settings page and update any settings.', 'pretty-opt-in' ); ?></span>    
            </div>
            <div class="pretty-box-settings-col-2">
                <select class="edit-settings-multi-select" multiple="true">
                    <?php
                    foreach ( $wp_roles->roles as $key=>$value ) {
                        pretty_opt_in_display_roles( $key, $value['name'], $edit_settings_roles);
                    }
                    // Always select administrator role
                    if (!in_array('administrator', $edit_settings_roles)) {
                        echo  '<option class="edit_settings_roles" selected="selected" value="administrator">Administrator</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="pretty-box-footer">

        <div class="pretty-actions-right">

            <button class="pretty-button pretty-button-blue pretty-global-settings-button" type="button">
                <span class="pretty-loading-text"><?php esc_html_e( 'Save Settings', 'pretty-opt-in' ); ?></span>
            </button>

        </div>

    </div>

    </form>



</div>