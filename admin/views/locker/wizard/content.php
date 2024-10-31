<?php
$id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : '';
$template = isset( $_GET['template'] ) ? sanitize_text_field( $_GET['template'] ) : 'minimal';

// Campaign Settings
$settings = array();
$shortcode = 'You shortcode is empty now, Please add your instagram to build the shortcode';
if(!empty($id)){
    $model    = $this->get_single_model( $id );
    $settings = $model->settings;
    $settings['status'] = $model->status;
    $template = $settings['template'];
    $shortcode = '[pretty-locker id="'.$id.'"]Here is hidden content[/pretty-locker]';
}

$opt_in_mode = isset( $settings['opt_in_mode'] ) ? $settings['opt_in_mode'] : 'single-opt-in';

?>
<div class="pretty-row-with-sidenav">

    <div class="pretty-sidenav">

        <div class="pretty-mobile-select">
            <span class="pretty-select-content"><?php esc_html_e( 'General', 'pretty-opt-in' ); ?></span>
            <ion-icon name="chevron-down" class="pretty-icon-down"></ion-icon>
        </div>

        <ul class="pretty-vertical-tabs pretty-sidenav-hide-md">

            <li class="pretty-vertical-tab current">
                <a href="#" data-nav="general"><?php esc_html_e( 'General', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="subscription"><?php esc_html_e( 'Subscription', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="visibility"><?php esc_html_e( 'Visibility', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="terms"><?php esc_html_e( 'Terms & Privacy', 'pretty-opt-in' ); ?></a>
            </li>
        </ul>

        <div class="pretty-sidenav-settings">
          <a href="#pretty-shortcode-popup" class="open-popup-preview" data-effect="mfp-zoom-in">
            <button id="pretty-preview-button" class="pretty-button pretty-sidenav-hide-md" accesskey="p">
                <?php esc_html_e( 'Shortcode', 'pretty-opt-in' ); ?>
            </button>
          </a>
        </div>

    </div>

    <form class="pretty-locker-form" method="post" name="pretty-locker-form" action="">

    <div class="pretty-box-tabs">
        <?php $this->template( 'locker/wizard/sections/tab-save',  $settings); ?>
        <?php $this->template( 'locker/wizard/sections/tab-general', $settings); ?>
        <?php $this->template( 'locker/wizard/sections/tab-subscription',  $settings); ?>
        <?php $this->template( 'locker/wizard/sections/tab-visibility',  $settings); ?>
        <?php $this->template( 'locker/wizard/sections/tab-terms',  $settings); ?>
    </div>
        <input type="hidden" name="locker_id" value="<?php echo esc_html($id); ?>">
        <input type="hidden" name="template" value="<?php echo esc_html($template); ?>">
    </form>
</div>

<div id="pretty-shortcode-popup" class="white-popup mfp-with-anim mfp-hide">

	<div class="pretty-box-header pretty-block-content-center">
		<h3 class="pretty-box-title type-title"><?php esc_html_e( 'Locker Shortcode', 'pretty-opt-in' ); ?></h3>
	</div>

    <div class="pretty-box-body pretty-block-content-center">
			<p>
                <small>
                    <?php esc_html_e( 'Wrap content you want to lock via the following shortcode in your post editor manually.', 'pretty-opt-in' ); ?>
                </small>
            </p>
            <div id="pretty-form-name-input" class="pretty-form-field">
                <div class="pretty-with-button pretty-with-button-icon">
                    <input type="text" id="pretty-form-shortcode" class="pretty-form-control text-center" value="<?php echo esc_attr( $shortcode ); ?>">
                    <button class="pretty-button-icon pretty-button-copy-icon">
                        <ion-icon class="pretty-icon-document" name="document-text-sharp"></ion-icon>
                        <span class="pretty-screen-reader-text"><?php esc_html_e( 'Copy Shortcode', 'pretty-opt-in' ); ?></span>
                    </button>
                </div>
            </div>
    </div>

    <div class="pretty-box-body pretty-block-content-center">
        <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'/assets/images/pretty.png'); ?>" class="pretty-image pretty-image-center" aria-hidden="true" alt="<?php esc_attr_e( 'Pretty Opt In', 'pretty-opt-in' ); ?>">
    </div>
</div>

