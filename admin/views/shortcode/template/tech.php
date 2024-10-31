<?php
$global_settings = get_option('pretty_global_settings');
$header_title = isset($settings['pretty_header_title']) && !empty($settings['pretty_header_title']) ? $settings['pretty_header_title'] : 'Subscribe here to unlock content';
$message = isset($settings['pretty_message']) && !empty($settings['pretty_message']) ? $settings['pretty_message'] : 'Sign up here to get the latest news, updates and special offers delivered directly to your inbox.';
$button_text = isset($settings['pretty_button_text']) && !empty($settings['pretty_button_text']) ? $settings['pretty_button_text'] : "Let's do it!";
?>
    <div class="pretty-real-content">
    </div>
    <div class="pretty-tech-container pretty-locker-container">
        <div class="pretty-tech-images">
            <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/template/tech-bg.svg'); ?>" class="pretty-tech-image">
        </div>
        <div class="pretty-tech-body pretty-locker-body">
            <div class="pretty-tech-content pretty-tech-no-label">
                <h1 class="pretty-tech-title"><?php echo esc_html($header_title); ?></h1>
                <p class="pretty-tech-description">
                    <div><?php echo $message; ?></div>
                </p>
                <form method="post" class="pretty-tech-form pretty-subscribe-form">
                    <div class="pretty-tech-fields">
                        <div class="pretty-tech-field pretty-tech-text">
                        <input id="email" class="pretty-tech-input-text" required="" type="text" name="email" autocomplete="off" placeholder="<?php esc_html_e( 'Your email address', 'pretty-opt-in' ); ?>">
                        </div>
                    </div>
                    <div class="pretty-tech-buttons">
                        <button class="pretty-tech-button pretty-tech-primary pretty-trigger-unlock"><?php echo esc_html($button_text); ?></button>
                        <button class="pretty-tech-button pretty-tech-secondary"><?php esc_html_e( 'No, thanks', 'pretty-opt-in' ); ?></button>
                    </div>
                    <input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id); ?>">
                    <input type="hidden" name="locker_id" value="<?php echo esc_attr($id); ?>">
                </form>
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