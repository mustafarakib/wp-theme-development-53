<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'stock_mr_register_required_plugins' );

function stock_mr_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => esc_html__('Stock Toolkit', 'stock-mr'),
            'slug'               => 'stock-toolkit',
            'source'             => get_template_directory() . '/inc/plugins/stock-toolkit.zip',
            'required'           => true,
            'version'            => esc_attr__('1.0', 'stock-mr'),
            'force_activation'   => true,
            'force_deactivation' => true,
        ),
        array(
            'name'               => esc_html__('WPBakery Visual Composer', 'stock-mr'),
            'slug'               => 'js_composer',
            'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
            'required'           => true,
            'version'            => esc_attr__('5.2.1', 'stock-mr'),
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'      => esc_html__('Contact Form 7', 'stock-mr'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Breadcrumb NavXT', 'stock-mr'),
            'slug'      => 'breadcrumb-navxt',
            'required'  => true,
        ),
    );

    $config = array(
        'id'           => 'stock-mr',
        'default_path' => '',
        'menu'         => 'stock-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}
