<?php
$modules = $this->getModules();
?>
<div class="pretty-box">
    <div class="pretty-box-search">

        <form method="post" name="pretty-bulk-action-form" class="pretty-search-left">

            <input type="hidden" id="pretty-leads-nonce" name="pretty_leads_nonce" value="<?php echo wp_create_nonce( 'pretty-leads-request' );?>">
            <input type="hidden" name="_wp_http_referer" value="<?php admin_url( 'admin.php?page=pretty-opt-in-leads' ); ?>">
            <input type="hidden" name="leads-ids" id="pretty-select-leads-ids" value="">

            <div class="pretty-select-wrapper">
                <select name="pretty_bulk_action" id="bulk-action-selector-top">
                    <option value=""><?php esc_html_e( 'Lockers', 'pretty-opt-in' ); ?></option>
                    <?php foreach ( $modules as $val => $label ) : ?>
                        <option value="<?php echo esc_attr( $label['id']); ?>"><?php echo esc_html( $label['name'] ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="pretty-button pretty-button-blue pretty-leads-bulk-action"><?php esc_html_e( 'Select', 'pretty-opt-in' ); ?></button>
        </form>

    </div>
</div>
<div class="pretty-box pretty-message pretty-message-lg">
    <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/pretty.png'); ?>" class="pretty-image pretty-image-center" aria-hidden="true" alt="<?php esc_attr_e( 'Pretty Opt In', 'pretty-opt-in' ); ?>">
        <div class="pretty-message-content">
            <p><?php esc_html_e( 'Need help? We are here for you. Please open a support ticket and we will help', 'pretty-opt-in' ); ?></p>
            <p>
                <a href="<?php echo esc_url( 'https://1.envato.market/EQ1W4/' ); ?>">
                    <button class="pretty-button pretty-button-blue" data-modal="custom_forms">
                        <i class="pretty-icon-plus" aria-hidden="true"></i> <?php esc_html_e( 'Create', 'pretty-opt-in' ); ?>
                    </button>
                </a>
            </p>
        </div>
</div>