<?php
$global_settings = get_option('pretty_global_settings');
$header_title = isset($settings['pretty_header_title']) && !empty($settings['pretty_header_title']) ? $settings['pretty_header_title'] : 'Sign up to access content.';
$message = isset($settings['pretty_message']) && !empty($settings['pretty_message']) ? $settings['pretty_message'] : 'Sign up here to get the latest news, updates and special offers delivered directly to your inbox.';
$button_text = isset($settings['pretty_button_text']) && !empty($settings['pretty_button_text']) ? $settings['pretty_button_text'] : 'CONTINUE';
$after_text = isset($settings['pretty_after_text']) && !empty($settings['pretty_after_text']) ? $settings['pretty_after_text'] : "No, I hate discounts";
?>
<div class="pretty-real-content">
</div>
<div class="pretty-fashion-container pretty-locker-container">
	<div class="pretty-fashion-images">
		<img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/template/fashion-bg.png'); ?>" class="pretty-fashion-image" >
	</div>
	<div class="pretty-fashion-body pretty-locker-body">
		<div class="pretty-fashion-content pretty-fashion-no-label">
			<h1 class="pretty-fashion-title">Exclusive offers in your inbox</h1>
			<p class="pretty-fashion-description">
				<div>Subscribe today to receive offers available only to our subscribers.</div>
			</p>
			<form method="post" class="pretty-fashion-form pretty-subscribe-form">
				<div class="pretty-fashion-fields">
					<div class="pretty-fashion-field pretty-fashion-email pretty-fashion-last pretty-fashion-valid">
						<input id="email" class="pretty-fashion-input-text" required="" type="email" name="email" autocomplete="off" placeholder="Enter your email">
					</div>
				</div>
				<div class="pretty-fashion-buttons">
					<button type="submit" class="pretty-fashion-button pretty-fashion-primary pretty-trigger-unlock">SUBSCRIBE</button>
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