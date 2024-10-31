<?php
$global_settings = get_option('pretty_global_settings');
$header_title = isset($settings['pretty_header_title']) && !empty($settings['pretty_header_title']) ? $settings['pretty_header_title'] : "Stay Tuned";
$message = isset($settings['pretty_message']) && !empty($settings['pretty_message']) ? $settings['pretty_message'] : 'Subscribe to our newsletter and get 15% off your first order.';
$button_text = isset($settings['pretty_button_text']) && !empty($settings['pretty_button_text']) ? $settings['pretty_button_text'] : 'SIGN UP';
?>
<div class="pretty-real-content">
</div>
<div class="pretty-stay-container pretty-locker-container">
    <div class="pretty-stay-body pretty-locker-body">
        <div class="pretty-stay-content pretty-stay-no-label">
            <h1 class="pretty-stay-title"><?php echo esc_html($header_title); ?></h1>
            <p class="pretty-stay-description"><?php echo $message; ?></p>
            <form method="post" class="pretty-stay-form pretty-subscribe-form">
                <div class="pretty-stay-fields">
                    <div class="pretty-stay-field pretty-stay-email pretty-stay-first pretty-stay-last pretty-stay-valid">
                        <input id="email" class="pretty-stay-input-text" required="" type="email" name="email" autocomplete="off" placeholder="Your email address">
                    </div>
                </div>
                <div class="pretty-stay-buttons">
                    <button type="submit" class="pretty-stay-button pretty-stay-primary pretty-trigger-unlock"><?php echo esc_html($button_text); ?></button>
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
				<div class="pretty-stay-fields">
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
				</div>
			<?php } ?>
        </div>
    </div>
</div>