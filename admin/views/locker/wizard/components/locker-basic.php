<div class="pretty-box-settings-row">

    <div class="pretty-box-settings-col-1">
        <span class="pretty-settings-label"><?php esc_html_e( 'Locker Name', 'pretty-opt-in' ); ?></span>
    </div>

    <div class="pretty-box-settings-col-2">

        <div>
            <input
                type="text"
                name="pretty_locker_name"
                placeholder="<?php esc_html_e( 'Enter your Locker Name here', 'pretty-opt-in' ); ?>"
                value="<?php if(isset($settings['pretty_locker_name'])){echo esc_attr($settings['pretty_locker_name']);}?>"
                id="pretty_locker_name"
                class="pretty-form-control"
                aria-labelledby="pretty_locker_name"
            />
        </div>


    </div>

</div>

<div class="pretty-box-settings-row">

    <div class="pretty-box-settings-col-1">
        <span class="pretty-settings-label"><?php esc_html_e( 'Header Title', 'pretty-opt-in' ); ?></span>
        <span class="pretty-description"><?php esc_html_e( 'Type a header which attracts attention or calls to action. You can leave this field empty.', 'pretty-opt-in' ); ?></span>
    </div>

    <div class="pretty-box-settings-col-2">

        <div>
            <input
                type="text"
                name="pretty_header_title"
                placeholder="<?php esc_html_e( 'Enter your header title here', 'pretty-opt-in' ); ?>"
                value="<?php if(isset($settings['pretty_header_title'])){echo esc_attr($settings['pretty_header_title']);}?>"
                id="pretty_header_title"
                class="pretty-form-control"
                aria-labelledby="pretty_header_title"
            />
        </div>


    </div>

</div>

<div class="pretty-box-settings-row">

    <div class="pretty-box-settings-col-1">
        <span class="pretty-settings-label"><?php esc_html_e( 'Locker Message', 'pretty-opt-in' ); ?></span>
        <span class="pretty-description"><?php esc_html_e( 'Type a message which will appear under the header.', 'pretty-opt-in' ); ?></span>
    </div>

    <div class="pretty-box-settings-col-2">

        <div class='pretty-form-wp-editor'>
            <?php 
                $value = isset($settings['pretty_message']) ? $settings['pretty_message'] : '<p>Please unlock this content. Just enter your email below.</p>';
                wp_editor( $value, 'pretty_message', array(
                    'textarea_name' => 'pretty_message',
                    'wpautop' => false,
                    'teeny' => true,
                    'tinymce' => true
                )); 
            ?> 
        </div>


    </div>

</div>

<div class="pretty-box-settings-row">

    <div class="pretty-box-settings-col-1">
        <span class="pretty-settings-label"><?php esc_html_e( 'Button Text', 'pretty-opt-in' ); ?></span>
        <span class="pretty-description"><?php esc_html_e( 'The text on the button. Call to action!', 'pretty-opt-in' ); ?></span>
    </div>

    <div class="pretty-box-settings-col-2">

    <div>
            <input
                type="text"
                name="pretty_button_text"
                placeholder="<?php esc_html_e( 'Enter your button text here', 'pretty-opt-in' ); ?>"
                value="<?php if(isset($settings['pretty_button_text'])){echo esc_attr($settings['pretty_button_text']);}?>"
                id="pretty_button_text"
                class="pretty-form-control"
                aria-labelledby="pretty_button_text"
            />
        </div>


    </div>

</div>

<div class="pretty-box-settings-row">

    <div class="pretty-box-settings-col-1">
        <span class="pretty-settings-label"><?php esc_html_e( 'After Button', 'pretty-opt-in' ); ?></span>
        <span class="pretty-description"><?php esc_html_e( 'The text below the button. Guarantee something.', 'pretty-opt-in' ); ?></span>    
    </div>

    <div class="pretty-box-settings-col-2">

    <div>
            <input
                type="text"
                name="pretty_after_text"
                placeholder="<?php esc_html_e( 'Enter your after button text here', 'pretty-opt-in' ); ?>"
                value="<?php if(isset($settings['pretty_after_text'])){echo esc_attr($settings['pretty_after_text']);}?>"
                id="pretty_after_text"
                class="pretty-form-control"
                aria-labelledby="pretty_after_text"
            />
        </div>


    </div>

</div>