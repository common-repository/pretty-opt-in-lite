<?php
$global_settings = get_option('pretty_global_settings');
$header_title = isset($settings['pretty_header_title']) && !empty($settings['pretty_header_title']) ? $settings['pretty_header_title'] : "Last day of sale! Hurry before it's over";
$message = isset($settings['pretty_message']) && !empty($settings['pretty_message']) ? $settings['pretty_message'] : 'Today only. Get 20% off any purchase. Sign up to receive the coupon code.';
$button_text = isset($settings['pretty_button_text']) && !empty($settings['pretty_button_text']) ? $settings['pretty_button_text'] : 'CONTINUE';
$after_text = isset($settings['pretty_after_text']) && !empty($settings['pretty_after_text']) ? $settings['pretty_after_text'] : "We won't share your information with anyone";
?>
<div class="pretty-real-content">
</div>
<div class="pretty-commerce-container pretty-locker-container">
    <div class="pretty-commerce-images">
        <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/template/commerce-bg.svg'); ?>" >
    </div>
    <div class="pretty-commerce-body pretty-locker-body">
        <div class="pretty-commerce-content pretty-commerce-no-label">
            <h1 class="pretty-commerce-title">
                <div><?php echo esc_html($header_title); ?></div>
            </h1>
            <p class="pretty-commerce-description">
                <?php echo $message; ?>
            </p>
            <form method="post" class="pretty-commerce-form pretty-subscribe-form">
                <div class="pretty-commerce-fields">
                    <div class="pretty-commerce-field pretty-commerce-email pretty-commerce-first pretty-commerce-last pretty-commerce-valid">
                        <input id="email" class="pretty-commerce-input-text" required="" type="email" name="email" autocomplete="off" placeholder="Email address">
                    </div>
                </div>
                <div class="pretty-commerce-buttons">
                    <button type="submit" class="pretty-commerce-button pretty-commerce-primary pretty-commerce-icon pretty-trigger-unlock">
                        <svg viewBox="0 0 20 18"><path stroke="none" fill="currentColor" fill-rule="nonzero" d="M20 1l-6 14.8c-.1.4-.5.7-.9.8-.4.1-.9 0-1.2-.2l-5.6-3.6L19 1.3 4.6 11.6.6 9C0 8.7 0 8.3 0 7.9c0-.4.4-.8.8-1L19.4.6l.5.1c0 .1.1.3 0 .4zM6 17.4a1 1 0 0 1-.8 0 1 1 0 0 1-.6-.7l-.7-4v-.2l4.6 3.3-2.4 1.6z"></path></svg>
                    </button>
                </div>
                <input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id); ?>">
                <input type="hidden" name="locker_id" value="<?php echo esc_attr($id); ?>">
            </form>
            <p class="pretty-commerce-note">
                <?php echo esc_html($after_text); ?>
            </p>
            <?php 
				if($settings['terms_and_privacy'] == 'terms-on') {
                    if( isset($global_settings['terms_use']) && $global_settings['terms_use'] == 'terms-use-exist'){
                        $terms_url = '<a target="_black" class="pretty-agreement-link" href="'.get_permalink($global_settings['pretty_terms_page_id']).'">Terms of Use</a>';
                    }else{
                        $terms_url = '<a target="_black" class="pretty-agreement-link" href="'.home_url( '/?pretty-opt-in=terms-of-use' ).'">Terms of Use</a>';
                    } 
                    if( isset($global_settings['privacy_use']) && $global_settings['privacy_use'] == 'privacy-use-exist'){
                        $privacy_url = '<a target="_black" class="pretty-agreement-link" href="'.get_permalink($global_settings['pretty_privacy_page_id']).'">Privacy Policy</a>';
                    }else{
                        $privacy_url = '<a target="_black" class="pretty-agreement-link" href="'.home_url( '/?pretty-opt-in=privacy-policy' ).'">Privacy Policy</a>';
                    } 
			?>
				<div class="pretty-agreement-container">
						<input type="checkbox" name="pretty-agreement-checkbox" >
						<span class="pretty-agreement-checkbox-text">
							<?php
                        		printf(
                            		esc_html__( 'I consent to processing of my data according to %1$s &amp; %2$s', 'pretty-opt-in' ),
									$terms_url,
									$privacy_url
                        		);
                        	?>
						</span>
				</div>
            <?php } ?>
        </div>
    </div>
</div>