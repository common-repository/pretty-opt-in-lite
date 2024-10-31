<?php
// Count total forms
$count        = $this->countModules();
$count_active = $this->countModules( 'publish' );

// available bulk actions
$bulk_actions = $this->bulk_actions();

$this->template( 'locker/list/widget-popup' );

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
                    <input type="hidden" id="pretty-opt-in-nonce" name="pretty_opt_in_nonce" value="<?php echo wp_create_nonce( 'pretty-opt-in-locker-request' );?>">
                    <input type="hidden" name="_wp_http_referer" value="<?php admin_url( 'admin.php?page=auto-pretty-campaign' ); ?>">
                    <input type="hidden" name="ids" id="pretty-select-lockers-ids" value="">

                    <label for="pretty-check-all-lockers" class="pretty-checkbox">
                        <input type="checkbox" id="pretty-check-all-lockers">
                        <span aria-hidden="true"></span>
                        <span class="pretty-screen-reader-text"><?php esc_html_e( 'Select all', 'pretty-opt-in' ); ?></span>
                    </label>

                    <div class="pretty-select-wrapper">
                        <select name="pretty_opt_in_bulk_action" id="bulk-action-selector-top">
                            <option value=""><?php esc_html_e( 'Bulk Action', 'pretty-opt-in' ); ?></option>
                            <?php foreach ( $bulk_actions as $val => $label ) : ?>
                                <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="pretty-button pretty-bulk-action-button"><?php esc_html_e( 'Apply', 'pretty-opt-in' ); ?></button>

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

    <div class="pretty-accordion pretty-accordion-block" id="pretty-modules-list">

        <?php
        foreach ( $this->getModules() as $module ) {
        ?>
            <div class="pretty-accordion-item">
                <div class="pretty-accordion-item-header">

                    <div class="pretty-accordion-item-title pretty-trim-title">
                        <label for="wpf-module-<?php echo esc_attr( $module['id'] ); ?>" class="pretty-checkbox pretty-accordion-item-action">
                            <input type="checkbox" id="wpf-module-<?php echo esc_attr( $module['id'] ); ?>" class="pretty-check-single-campaign" value="<?php echo esc_html( $module['id'] ); ?>">
                            <span aria-hidden="true"></span>
                            <span class="pretty-screen-reader-text"><?php esc_html_e( 'Select this form', 'pretty-opt-in' ); ?></span>
                        </label>
                        <span class="pretty-trim-text">
                            <?php echo pretty_opt_in_get_locker_name( $module['id'] ); ?>
                        </span>
                        <?php
                        if ( 'publish' === $module['status'] ) {
                            echo '<span class="pretty-tag pretty-tag-blue">' . esc_html__( 'Published', 'pretty-opt-in' ) . '</span>';
                        }
                        ?>

                        <?php
                        if ( 'draft' === $module['status'] ) {
                            echo '<span class="pretty-tag">' . esc_html__( 'Draft', 'pretty-opt-in' ) . '</span>';
                        }
                        ?>
                    </div>

                    <div class="pretty-accordion-item-date">
                        <strong><?php esc_html_e( 'Shortcode', 'pretty-opt-in' ); ?></strong>
                        <?php
                            $shortcode_text = '[pretty-locker id="'.$module['id'].'"][/pretty-locker]';
                            esc_html_e( $shortcode_text );
                        ?>
                    </div>

                    <div class="pretty-accordion-col-auto">

                        <a href="<?php echo admin_url( 'admin.php?page=pretty-opt-in-locker-wizard&id=' . $module['id'] ); ?>"
                           class="pretty-button pretty-button-ghost pretty-accordion-item-action pretty-desktop-visible">
                            <ion-icon name="pencil" class="pretty-icon-pencil"></ion-icon>
                            <?php esc_html_e( 'Edit', 'pretty-opt-in' ); ?>
                        </a>

                        <div class="pretty-dropdown pretty-accordion-item-action">
                            <button class="pretty-button-icon pretty-dropdown-anchor">
                                <ion-icon name="settings"></ion-icon>
                            </button>
                            <ul class="pretty-dropdown-list">

                                <li>
                                    <form method="post">
                                        <input type="hidden" id="pretty-opt-in-nonce" name="pretty_opt_in_nonce" value="<?php echo wp_create_nonce( 'pretty-opt-in-locker-request' );?>">
                                        <input type="hidden" name="pretty_opt_in_single_action" value="update-status">
                                        <input type="hidden" name="id" value="<?php echo esc_attr( $module['id'] ); ?>">
                                        <?php
                                        if ( 'publish' === $module['status'] ) {
                                            ?>
                                            <input type="hidden" name="status" value="draft">
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ( 'draft' === $module['status'] ) {
                                            ?>
                                            <input type="hidden" name="status" value="publish">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit">
                                            <ion-icon class="pretty-icon-cloud" name="cloud"></ion-icon>
                                            <?php
                                            if ( 'publish' === $module['status'] ) {
                                                echo esc_html__( 'Unpublish', 'pretty-opt-in' );
                                            }
                                            ?>

                                            <?php
                                            if ( 'draft' === $module['status'] ) {
                                                echo esc_html__( 'Publish', 'pretty-opt-in' );
                                            }
                                            ?>
                                        </button>
                                    </form>
                                </li>

                                <li>
                                    <form method="post">
                                        <input type="hidden" id="pretty-opt-in-nonce" name="pretty_opt_in_nonce" value="<?php echo wp_create_nonce( 'pretty-opt-in-locker-request' );?>">
                                        <input type="hidden" name="pretty_opt_in_single_action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo esc_attr( $module['id'] ); ?>">
                                        <button type="submit">
                                            <ion-icon class="pretty-icon-trash" name="trash"></ion-icon>
                                            <?php esc_html_e( 'Delete', 'pretty-opt-in' ); ?>
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>

                        <button class="pretty-button-icon pretty-accordion-open-indicator" aria-label="<?php esc_html_e( 'Open item', 'pretty-opt-in' ); ?>">
                            <ion-icon name="chevron-down"></ion-icon>
                        </button>


                    </div>

                </div>
            </div>

        <?php

        }

        ?>

    </div>


<?php } else { ?>
<div class="pretty-box pretty-message pretty-message-lg">

    <img src="<?php echo esc_url(PRETTY_OPT_IN_URL.'/assets/images/pretty.png'); ?>" class="pretty-image pretty-image-center" aria-hidden="true" alt="<?php esc_attr_e( 'Pretty Opt-In', 'pretty-opt-in' ); ?>">

    <div class="pretty-message-content">

        <p><?php esc_html_e( 'Create locker for all your needs with customized settings, include backup, cleanup and optimize.', 'pretty-opt-in' ); ?></p>

        <p>
            <a href="#template-popup" class="open-popup-link" data-effect="mfp-zoom-in">
                <button class="pretty-button pretty-button-blue" data-modal="custom_forms">
                    <i class="pretty-icon-plus" aria-hidden="true"></i>
                    <?php esc_html_e( 'Create', 'pretty-opt-in' ); ?>
                </button>
            </a>
        </p>

    </div>

</div>

<?php } ?>