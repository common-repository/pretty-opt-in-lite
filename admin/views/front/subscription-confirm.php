<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$main_message = esc_html__('Subscription confirmed !', 'pretty-opt-in' );
$site_name 			= get_option( 'blogname' );
$home_url  			= home_url( '/' );
?>
	<html>
	  <head>
			<title><?php echo esc_html( $site_name ); ?></title>
			<meta http-equiv="refresh" content="10; url=<?php echo esc_url( $home_url ); ?>" charset="<?php echo esc_attr( get_option( 'blog_charset' ) ); ?>"/>
	  </head>
	  <body>
			  <div>
				<h3>
				  <?php echo esc_html($main_message); ?>
				</h3>
			  </div> 
		</body>
  </html>
  <?php

	die();
