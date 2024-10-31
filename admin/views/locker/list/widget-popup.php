<?php
$templates = array(
    'minimal' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-minimal.png',
        'label'       => '',
        'description' => ''
    ),
    'fashion' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-fashion.png',
        'label'       => '',
        'description' => ''
    ),
    'commerce' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-commerce.png',
        'label'       => '',
        'description' => ''
    ),
    'tech' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-tech.png',
        'label'       => '',
        'description' => ''
    ),
    'black' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-black.png',
        'label'       => '',
        'description' => ''
    ),
    'stay' => array(
        'thumbnail'   => PRETTY_OPT_IN_URL.'assets/images/template/pretty-stay.png',
        'label'       => '',
        'description' => ''
    ),
);
?>
<div id="template-popup" class="white-popup mfp-with-anim mfp-hide">

	<div class="pretty-box-header pretty-block-content-center">
		<h3 class="pretty-box-title type-title"><?php esc_html_e( 'Choose a template', 'pretty-opt-in' ); ?></h3>
	</div>

    <div class="pretty-box-body pretty-block-content-center">
        <p class="pretty-description">
            <?php esc_html_e( 'Select your new locker template.', 'pretty-opt-in' ); ?>
        </p>
    </div>

    <div class="pretty-box-body hui-templates-wrapper ">
        <div class="hui-templates">
            <?php foreach ( $templates as $template_name => $data ) { ?>
            <div class="hui-template-card" tabindex="0">
                <div class="hui-template-card--image" aria-hidden="true">
                    <img src="<?php echo esc_url( $data['thumbnail'] );?>" aria-hidden="true">
                    <div class="hui-template-card--mask" aria-hidden="true"></div>
                </div>
                <h4><?php echo esc_html($template_name);?></h4>
                <p class="hui-screen-reader-highlight" tabindex="0"><?php esc_html_e( 'Tailored to promote your seasonal offers in a modern layout.', 'pretty-opt-in' ); ?></p>
                <button class="pretty-button pretty-button-blue pretty-template-select-button" aria-label="Build from Minimalist template" data-template="<?php echo esc_attr( $template_name );?>">
                    <?php esc_html_e( 'Choose Template', 'pretty-opt-in' ); ?>    
                </button>
            </div>
            <?php } ?>
        </div>
    </div>

	<div class="pretty-box-footer">
	</div>

</div>

