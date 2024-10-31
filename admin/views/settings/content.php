<div class="pretty-row-with-sidenav">

    <div class="pretty-sidenav">
        <div class="pretty-mobile-select">
            <span class="pretty-select-content"><?php esc_html_e( 'Global Settings', 'pretty-opt-in' ); ?></span>
            <ion-icon name="chevron-down" class="pretty-icon-down"></ion-icon>
        </div>

        <ul class="pretty-vertical-tabs pretty-sidenav-hide-md">

            <li class="pretty-vertical-tab current">
                <a href="#" data-nav="general"><?php esc_html_e( 'General', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="subscription"><?php esc_html_e( 'Subscription', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="lock-options"><?php esc_html_e( 'Lock Options', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="notifications"><?php esc_html_e( 'Notifications', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="terms"><?php esc_html_e( 'Terms & Privacy', 'pretty-opt-in' ); ?></a>
            </li>

        </ul>

    </div>

    <div class="pretty-box-tabs">
         <?php $this->template( 'settings/sections/tab-general' ); ?>
         <?php $this->template( 'settings/sections/tab-subscription' ); ?>
         <?php $this->template( 'settings/sections/tab-lock-options' ); ?>
         <?php $this->template( 'settings/sections/tab-notifications' ); ?>
         <?php $this->template( 'settings/sections/tab-permissions' ); ?>
         <?php $this->template( 'settings/sections/tab-terms' ); ?>
    </div>
</div>