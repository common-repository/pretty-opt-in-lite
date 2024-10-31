<?php
// Count total leads
$count = $this->countLeads();

$leads = $this->getLeads();

// Available bulk actions
$bulk_actions = $this->bulk_actions();
?>
<?php if ( $count > 0 ) { ?>
    <!-- START: Bulk actions and pagination -->
    <div class="pretty-listings-pagination">

        <div class="pretty-pagination-mobile pretty-pagination-wrap">
            <span class="pretty-pagination-results">
                            <?php /* translators: ... */ echo esc_html( sprintf( _n( '%s result', '%s results', $count, 'pretty-opt-in' ), $count ) ); ?>
                        </span>
            <?php $this->pagination(); ?>
        </div>

        <div class="pretty-pagination-desktop pretty-box">
            <div class="pretty-box-search">

                <form method="post" name="pretty-bulk-action-form" class="pretty-search-left">

                    <input type="hidden" id="pretty-leads-nonce" name="pretty_leads_nonce" value="<?php echo wp_create_nonce( 'pretty-leads-request' );?>">
                    <input type="hidden" name="_wp_http_referer" value="<?php admin_url( 'admin.php?page=pretty-opt-in-leads' ); ?>">
                    <input type="hidden" name="leads-ids" id="pretty-select-leads-ids" value="">

                    <div class="pretty-select-wrapper">
                        <select name="pretty_bulk_action" id="bulk-action-selector-top">
                            <option value=""><?php esc_html_e( 'Bulk Action', 'pretty-opt-in' ); ?></option>
                            <?php foreach ( $bulk_actions as $val => $label ) : ?>
                                <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="pretty-button pretty-leads-bulk-action"><?php esc_html_e( 'Apply', 'pretty-opt-in' ); ?></button>

                </form>

                <div class="pretty-search-right">

                    <div class="pretty-pagination-wrap">
                        <span class="pretty-pagination-results">
                            <?php /* translators: ... */ echo esc_html( sprintf( _n( '%s result', '%s results', $count, 'pretty-opt-in' ), $count ) ); ?>
                        </span>
                        <?php $this->pagination(); ?>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- END: Bulk actions and pagination -->

    <div class="pretty-box pretty-table-list">
        <table class="pretty-table-entries pretty-table pretty-table-flushed pretty-accordion">
        <thead>
        <tr>
            <th class="pretty-column-id">
                <label for="pretty-check-all-leads" class="pretty-checkbox">
                    <input type="checkbox" id="pretty-check-all-leads">
                    <span aria-hidden="true"></span>
                    <span class="pretty-screen-reader-text"><?php esc_html_e( 'Select all', 'pretty-opt-in' ); ?></span>
                </label>
                <label class="pretty-checkbox pretty-checkbox-sm">
                    <span><?php esc_html_e( 'Email', 'pretty-opt-in' ); ?></span>
                </label>
            </th>
            <th class="pretty-column-date"><?php esc_html_e( 'Added Date', 'pretty-opt-in' ); ?></th>
            <th class="pretty-column-apps"><?php esc_html_e( 'Actions', 'pretty-opt-in' ); ?></th>
        </tr>
        </thead>
        <tbody class="pretty-list">
        <?php
            foreach ( $this->getLeads() as $module ) {
        ?>
        <tr class="pretty-accordion-item">
            <td class="pretty-column-id pretty-accordion-item-title">
                <label class="pretty-checkbox pretty-checkbox-sm">
                    <input type="checkbox" class="pretty-leads-listing-checkbox" value="<?php echo esc_html( $module['ID'] ); ?>">
                    <span aria-hidden="true"></span>
                    <span><?php echo esc_html( $module['lead_email'] ); ?></span>
                </label>
            </td>
            <td class="pretty-column-date">
                <?php echo esc_html( wp_date( "M j G:i:s Y", $module['lead_date'], wp_timezone() ) ); ?>
            </td>
            <td class="pretty-column-actions">
                <a href="#" class="pretty-lead-actions pretty-lead-delete" data-name="<?php echo esc_attr( $module['lead_email'] ); ?>">
                    <ion-icon name="trash-outline"></ion-icon>
                </a>
                <a href="<?php echo admin_url( 'admin.php?page=pretty-opt-in-leads&action=pretty_download_lead' ).'&filename='.$module['lead_email']; ?>" class="pretty-lead-actions">
                    
                    <ion-icon name="download-outline"></ion-icon>        
                </a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>  
<?php } else { ?>
    <div class="pretty-box pretty-message pretty-message-lg">

        <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'assets/images/pretty.png'); ?>" class="pretty-image pretty-image-center" aria-hidden="true" alt="<?php esc_attr_e( 'Pretty Opt In', 'pretty-opt-in' ); ?>">

        <div class="pretty-message-content">

            <p><?php esc_html_e( 'Here is no leads to list now, please go back to the dashboard page to create new lead with advanced options first.', 'pretty-opt-in' ); ?></p>

            <p>
                <a href="<?php echo admin_url( 'admin.php?page=pretty-opt-in' ); ?>">
                    <button class="pretty-button pretty-button-blue" data-modal="custom_forms">
                        <i class="pretty-icon-plus" aria-hidden="true"></i> <?php esc_html_e( 'Go to Dashboard', 'pretty-opt-in' ); ?>
                    </button>
                </a>
            </p>


        </div>

    </div>

<?php } ?>