<?php
/**
 * Pretty_Opt_In_Locker_Admin Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Locker_Admin' ) ) :
	
class Pretty_Opt_In_Locker_Admin extends Pretty_Opt_In_Admin_Module {

	/**
	 * Init module admin
	 *
	 * @since 1.0
	 */
	public function init() {
		$this->module       = Pretty_Opt_In_Locker::get_instance();
		$this->page         = 'pretty-opt-in-locker';
		$this->page_edit    = 'pretty-opt-in-locker-wizard';
	}

	/**
	 * Include required files
	 *
	 * @since 1.0
	 */
	public function includes() {
		include_once dirname( __FILE__ ) . '/admin-page-new.php';
		include_once dirname( __FILE__ ) . '/admin-page-view.php';
	}

	/**
	 * Add module pages to Admin
	 *
	 * @since 1.0
	 */
	public function add_menu_pages() {
		new Pretty_Opt_In_Locker_Page( $this->page, 'locker/list', esc_html__( 'Lockers', 'pretty-opt-in' ), esc_html__( 'Lockers', 'pretty-opt-in' ), 'pretty-opt-in' );
		new Pretty_Opt_In_Locker_New_Page( $this->page_edit, 'locker/wizard', esc_html__( 'Edit Locker', 'pretty-opt-in' ), esc_html__( 'New Locker', 'pretty-opt-in' ), 'pretty-opt-in' );
	}

	/**
	 * Remove necessary pages from menu
	 *
	 * @since 1.0
	 */
	public function hide_menu_pages() {
		remove_submenu_page( 'pretty-opt-in', $this->page_edit );
	}

	/**
	 * Return template
	 *
	 * @since 1.0
	 * @return Pretty_Opt_In_Template|false
	 */
	private function get_template() {
		if( isset( $_GET['template'] ) )  {
			$id = trim( sanitize_text_field( $_GET['template'] ) );
		} else {
			$id = 'blank';
		}

		foreach ( $this->module->templates as $key => $template ) {
			if ( $template->options['id'] === $id ) {
				return $template;
			}
		}

		return false;
	}
}

endif;
