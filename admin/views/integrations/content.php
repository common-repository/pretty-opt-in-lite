<div class="pretty-row-with-sidenav">

    <div class="pretty-sidenav">
        <div class="pretty-mobile-select">
            <span class="pretty-select-content"><?php esc_html_e( 'API Settings', 'pretty-opt-in' ); ?></span>
            <ion-icon name="chevron-down" class="pretty-icon-down"></ion-icon>
        </div>

        <ul class="pretty-vertical-tabs pretty-sidenav-hide-md">

            <li class="pretty-vertical-tab current">
                <a href="#" data-nav="apps"><?php esc_html_e( 'API Settings', 'pretty-opt-in' ); ?></a>
            </li>

            <li class="pretty-vertical-tab">
                <a href="#" data-nav="others"><?php esc_html_e( 'More APIs', 'pretty-opt-in' ); ?></a>
            </li>

        </ul>

    </div>

    <div class="pretty-box-tabs">
         <?php $this->template( 'integrations/sections/tab-apps' ); ?>
         <?php $this->template( 'integrations/sections/tab-others' ); ?>
    </div>
</div>