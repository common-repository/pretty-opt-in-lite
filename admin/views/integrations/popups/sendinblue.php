<?php
$current_addon_data = pretty_opt_in_get_addon_data('sendinblue');
?>
<div class="pretty-box" role="document">

    <div class="pretty-box-header pretty-block-content-center">

        <div class="pretty-dialog-image" aria-hidden="true">

            <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'/assets/images/integrations/sendinblue.png'); ?>" alt="<?php esc_attr_e( 'SendInBlue API', 'pretty-opt-in' ); ?>">

        </div>

        <div class="pretty-box-content integration-header">

            <h3 class="pretty-box-title" id="dialogTitle2"><?php esc_html_e( 'Setup SendInBlue API', 'pretty-opt-in' ); ?></h3>

			<span class="pretty-description">
                <?php esc_html_e( 'Setup your SendInBlue API key. Grant Full Access in settings of your API key.', 'pretty-opt-in' ); ?>
			</span>

        </div>

    </div>

    <div class="pretty-box-body">
        <form class="pretty-integration-form" method="post" name="pretty-integration-form" action="">

            <div class="pretty-form-field">
                <label class="pretty-label"><?php esc_html_e( 'API Key', 'pretty-opt-in' ); ?></label>
                <div class="pretty-control-with-icon">
                    <ion-icon class="pretty-icon-key" name="key"></ion-icon>
                    <input name="api_key" placeholder="<?php esc_html_e( 'API Key', 'pretty-opt-in' ); ?>" value="<?php if(!empty($current_addon_data['api_key'])){echo esc_attr( $current_addon_data['api_key'] );}?>" class="pretty-form-control">
                </div>
            </div>

            <input type="hidden" name="slug" value="<?php echo esc_attr('sendinblue');?>" >
            <input type="hidden" name="is_connected" value="<?php echo esc_attr($current_addon_data['is_connected']);?>" >

            <div class="pretty-border-frame pretty-description">

                <span>
                    <?php esc_html_e( 'Follow these instructions to retrieve your Client ID and Secret.', 'pretty-opt-in' ); ?>
                </span>

            </div>

        </form>

    </div>

    <div class="pretty-box-footer pretty-box-footer-center">
        <button type="button" class="pretty-button pretty-addon-connect">
            <span class="pretty-loading-text"><?php esc_html_e( 'Connect', 'pretty-opt-in' ); ?></span>
        </button>
    </div>

</div>