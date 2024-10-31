<?php
$status = isset( $settings['status'] ) ? sanitize_text_field( $settings['status'] ) : 'draft';
?>
<div id="auto-pretty-builder-status" class="pretty-box pretty-box-sticky">
    <div class="pretty-box-status">
        <div class="pretty-status">
            <div class="pretty-status-module">
                <?php esc_html_e( 'Status', 'pretty-opt-in' ); ?>
                    <?php
                    if( $status === 'draft'){
                        ?>
                    <span class="pretty-tag pretty-tag-draft">
                        <?php esc_html_e( 'draft', 'pretty-opt-in' ); ?>
                    </span>
                    <?php
                    }else if($status === 'publish'){
                        ?>
                    <span class="pretty-tag pretty-tag-published">
                       <?php esc_html_e( 'published', 'pretty-opt-in' ); ?>
                    </span>
                    <?php
                    }
                    ?>
            </div>
            <div class="pretty-status-changes">

            </div>
        </div>
        <div class="pretty-actions">
            <button id="pretty-locker-draft" class="pretty-button" type="button">
                <span class="pretty-loading-text">
                    <ion-icon name="reload-circle"></ion-icon>
                    <span class="button-text campaign-save-text">
                        <?php
                        if($status === 'publish'){
                            echo esc_html( 'unpublish', 'pretty-opt-in' );
                        }else{
                            echo esc_html( 'save draft', 'pretty-opt-in' );
                        }
                        ?>
                    </span>
                </span>
            </button>
            <button id="pretty-locker-publish" class="pretty-button pretty-button-blue" type="button">
                <span class="pretty-loading-text">
                    <ion-icon name="save"></ion-icon>
                    <span class="button-text campaign-publish-text">
                        <?php
                        if($status === 'publish'){
                            echo esc_html( 'update', 'pretty-opt-in' );
                        }else{
                            echo esc_html( 'publish', 'pretty-opt-in' );
                        }
                        ?>
                    </span>
                </span>
            </button>
        </div>
    </div>
</div>
