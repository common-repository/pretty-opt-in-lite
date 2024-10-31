<?php
/**
 * Pretty_Opt_In_Locker_New_Page Class
 *
 * @since  1.0.0
 * @package Pretty Opt In
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Pretty_Opt_In_Locker_New_Page' ) ) :

class Pretty_Opt_In_Locker_New_Page extends Pretty_Opt_In_Admin_Page {
    
  
    /**
     * Get wizard title
     *
     * @since 1.0
     * @return mixed
     */
    public function getWizardTitle() {
        if ( isset( $_REQUEST['id'] ) ) { // WPCS: CSRF OK
            return esc_html__( "Edit Locker", 'pretty-opt-in' );
        } else {
            return esc_html__( "New Locker", 'pretty-opt-in' );
        }
    }

    /**
     * Add page screen hooks
     *
     * @since 1.0.0
     * @param $hook
     */
    public function enqueue_scripts( $hook ) {
        // Load admin styles
        pretty_opt_in_admin_enqueue_styles( PRETTY_OPT_IN_VERSION );

        $pretty_opt_in_data = new Pretty_Opt_In_Admin_Data();

        // Load admin locker edit scripts
        pretty_opt_in_admin_enqueue_scripts_locker_edit(
            PRETTY_OPT_IN_VERSION,
            $pretty_opt_in_data->get_options_data()
        );    
        
    }

    /**
     * Render page header
     *
     * @since 1.0
     */
    protected function render_header() { ?>
        <?php
        if ( $this->template_exists( $this->folder . '/header' ) ) {
            $this->template( $this->folder . '/header' );
        } else {
            ?>
            <h1 class="pretty-header-title"><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <?php } ?>
        <?php
    }

    /**
     * Return single model
     *
     * @since 1.0.0
     *
     * @param int $id
     *
     * @return array
     */
    public function get_single_model( $id ) {
        $data = Pretty_Opt_In_Locker_Model::model()->get_single_model( $id );

        return $data;
    }



}

endif;
