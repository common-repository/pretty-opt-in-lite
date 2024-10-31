<?php
$main_demo_link = '<a href="https://1.envato.market/EQ1W4" target="_blank">' . esc_html__( 'locker layout demos', 'pretty-opt-in' ) . '</a>';
$demos = array(
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Minimal'
	),
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Black'
	),
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Stay'
	),
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Fashion'
	),
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Commerce'
	),
	array(
		'href' => 'https://1.envato.market/EQ1W4',
		'demo' => 'Tech'
	),
);
$support_url = 'https://1.envato.market/EQ1W4';
$document_url = 'https://1.envato.market/EQ1W4';
?>
<div class="wrap about-wrap">
	<h1><?php _e( 'Welcome to Pretty Opt-In', 'pretty-opt-in' ); ?></h1>
	<div class="about-text">
		<?php
              printf(
                  esc_html__( 'Thank you for choosing Pretty Opt-In, the most intuitive and extensible tool for Lead Generation in WordPress! - %1$s', 'pretty-opt-in' ),
                  '<a href="https://1.envato.market/EQ1W4" target="_blank">Visit Plugin Homepage</a>'
              );
        ?>
	</div>
		<div class="pretty-badge-logo">
			<img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'/assets/images/pretty.png'); ?>"aria-hidden="true" alt="<?php esc_attr_e( 'Pretty Opt-In', 'pretty-opt-in' ); ?>">
		</div>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab nav-tab-active" href="#" data-nav="help">
				<?php esc_html_e( 'Getting Started', 'pretty-opt-in' ); ?>
			</a>
			<a class="nav-tab" href="#" data-nav="demo">
				<?php esc_html_e( 'Demos', 'pretty-opt-in' ); ?>
			</a>
			<a class="nav-tab" href="#" data-nav="support">
				<?php esc_html_e( 'Support', 'pretty-opt-in' ); ?>
			</a>
	</h2>
	<div class="pretty-welcome-tabs">
	<div id="help" class="active nav-container">
		<div class="changelog section-getting-started">
			<div class="feature-section">
				<h2><?php esc_html_e( 'Create Your First Locker', 'pretty-opt-in' ); ?></h2>

				<img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/welcome/pretty-edit-locker.png'); ?>" class="pretty-help-screenshot" alt="<?php esc_attr_e( 'Pretty Opt-In', 'pretty-opt-in' ); ?>">
				<h4><?php printf( __( '1. <a href="%s" target="_blank">Add New Locker</a>', 'pretty-opt-in' ), esc_url ( admin_url( 'admin.php?page=pretty-opt-in-locker' ) ) ); ?></h4>
				<p><?php _e( 'To create your first locker, simply click the Create button.', 'pretty-opt-in' ); ?></p>

				<h4><?php _e( '2. Select Locker Template', 'pretty-opt-in' );?></h4>
				<p><?php _e( 'You will need to select between different lockers templates.', 'pretty-opt-in' ); ?></p>

				<h4><?php _e( '3. Save Your Locker Settings', 'pretty-opt-in' );?></h4>
				<p><?php _e( 'There are tons of settings to help you customize the locker to suit your needs.', 'pretty-opt-in' );?></p>
			</div>
		</div>
		<div class="changelog section-getting-started">
			<div class="pretty-tip">
			<?php printf( esc_html__( 'Not sure which locker layout template to use? Check out all our different %s.', 'pretty-opt-in' ), $main_demo_link ); ?>
			</div>
		</div>
		<div class="changelog section-getting-started">
			<div class="feature-section">
				<h2><?php _e( 'Show Off Your Locker', 'pretty-opt-in' ); ?></h2>

				<img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/welcome/pretty-locker-list.png'); ?>" class="pretty-help-screenshot" alt="<?php esc_attr_e( 'Pretty Opt-In', 'pretty-opt-in' ); ?>">

				<h4><?php printf( __( 'The <em>[%s]</em> Short Code','pretty-opt-in' ), 'pretty-locker' );?></h4>
				<p><?php _e( 'Simply copy the shortcode code from the locker edit page and paste it into your posts or pages.', 'pretty-opt-in' );?></p>

				<h4><?php _e( 'Copy To Clipboard','pretty-opt-in' );?></h4>
				<p><?php _e( 'We make your life easy! Just click the shortcodes and they get copied to your clipboard automatically. ', 'pretty-opt-in' );?></p>

                <h4><?php _e( 'Wrapping The Lock Content','pretty-opt-in' );?></h4>
                <p><?php _e( 'In your post or page editor, Wrapping the lock content within <em>pretty-locker</em> shortcode. ', 'pretty-opt-in' );?></p>

			</div>
		</div>
	</div>
	<div id="demo" class="nav-container">
		<h2><?php _e( 'Demos', 'pretty-opt-in' ); ?></h2>
		<div class="demos_masonry">
		<?php
			foreach ( $demos as $demo ) {
		?>
				<div class="demo_section">
					<h3><a href="<?php echo esc_url($demo['href']); ?>" target="_blank" title="<?php esc_html__('Open demo in new tab','pretty-opt-in'); ?>"><?php echo esc_html( $demo['demo'] ); ?></a></h3>
				</div>
		<?php
			}
		?>

		</div>
	</div>
	<div id="support" class="nav-container">
		<h2><?php _e( "Need help? We're here for you...", 'pretty-opt-in' ); ?></h2>
		<p class="document-center">
			<span class="dashicons dashicons-editor-help"></span>
			<a href="<?php echo esc_url ( $document_url ); ?>" target="_blank">
			<?php _e('Document','pretty-opt-in'); ?>
			- <?php _e('The document articles will help you troubleshoot issues that have previously been solved.', 'pretty-opt-in'); ?>
			</a>
		</p>
		<div class="feature-cta">
			<p><?php _e('Still stuck? Please open a support ticket and we will help:', 'pretty-opt-in'); ?></p>
			<a target="_blank" href="<?php echo esc_url ( $support_url ); ?>"><?php _e('Open a support ticket', 'pretty-opt-in' ); ?></a>
		</div>
	</div>
	</div>
</div>