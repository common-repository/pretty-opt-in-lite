<?php
$global_settings = get_option('pretty_global_settings');
$header_title = isset($settings['pretty_header_title']) && !empty($settings['pretty_header_title']) ? $settings['pretty_header_title'] : "VIP MEMBERS GET MORE ON BLACK FRIDAY";
$message = isset($settings['pretty_message']) && !empty($settings['pretty_message']) ? $settings['pretty_message'] : 'Get a 20% OFF in addition to the discount displayed on the website.';
$button_text = isset($settings['pretty_button_text']) && !empty($settings['pretty_button_text']) ? $settings['pretty_button_text'] : 'JOIN VIP CLUB';
?>
<div class="pretty-real-content">
</div>
<div class="pretty-black-container pretty-locker-container">
    <div class="pretty-black-images">
        <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/template/black-bg.png'); ?>" class="pretty-black-image" >
    </div>
    <div class="pretty-black-body pretty-locker-body">
        <div class="pretty-black-content pretty-black-no-label">
            <h1 class="pretty-black-title"><?php echo esc_html($header_title); ?></h1>
            <p class="pretty-black-description"><?php echo $message; ?></p>
            <form method="post" class="pretty-black-form pretty-subscribe-form">
                <div class="pretty-black-fields">
                    <div class="pretty-black-field pretty-black-email pretty-black-last pretty-black-valid">
                        <input id="email" class="pretty-black-input-text" required="" type="email" name="email" autocomplete="off" placeholder="<?php esc_html_e( 'Enter your email', 'pretty-opt-in' ); ?>">
                    </div>
                </div>
                <div class="pretty-black-buttons">
                    <button type="submit" class="pretty-black-button pretty-black-primary pretty-trigger-unlock"><?php echo esc_html($button_text); ?></button>
                </div>
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
                <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
                <input type="hidden" name="locker_id" value="<?php echo esc_attr($id); ?>">
            </form>
        </div>
    </div>
</div>