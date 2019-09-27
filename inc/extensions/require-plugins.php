<?php
add_action( 'tgmpa_register', 'unbreak_required_redux_plugins' );
function unbreak_required_redux_plugins() {
    $config = array(
        'default_path' => unbreak_relative_path().'untheme.net/plugins/',
        'is_automatic' => true
    );
    $plugins = array(
        array(
            'name'               => esc_html__('Redux Framework','unbreak'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
    );
    tgmpa( $plugins, $config );
}
if(class_exists('ReduxFrameworkPlugin')){
    add_action( 'tgmpa_register', 'unbreak_required_theme_plugins' );
    function unbreak_required_theme_plugins() {
        $config = array(
            'default_path' => unbreak_relative_path().'untheme.net/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('EF5 Systems','unbreak'),
                'slug'               => 'ef5-systems',
                'source'             => 'ef5-systems.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('EF5 Import & Export','unbreak'),
                'slug'               => 'ef5-import-export',
                'source'             => 'ef5-import-export.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('WPBakery Page Builder','unbreak'),
                'slug'               => 'js_composer',
                'source'             => 'js_composer.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Slider Revolution','unbreak'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('WooCommerce','unbreak'),
                'slug'               => 'woocommerce',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Compare for WooCommerce','unbreak'),
                'slug'               => 'woo-smart-compare',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Wishlist for WooCommerce','unbreak'),
                'slug'               => 'woo-smart-quick-view',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Quick View for WooCommerce','unbreak'),
                'slug'               => 'woo-smart-wishlist',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Contact Form 7','unbreak'),
                'slug'               => 'contact-form-7',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Newsletter','unbreak'),
                'slug'               => 'newsletter',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Goolge Captcha','unbreak'),
                'slug'               => 'google-captcha',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WP User Avatars','unbreak'),
                'slug'               => 'wp-user-avatars',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Classic Editor','unbreak'),
                'slug'               => 'classic-editor',
                'required'           => false,
            ),
        );
        tgmpa( $plugins, $config );
    }
}
if(class_exists('VC_Manager')){
    add_action( 'tgmpa_register', 'unbreak_required_vc_plugins' );
    function unbreak_required_vc_plugins(){
        $config = array(
            'default_path' => unbreak_relative_path().'untheme.net/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Templatera','unbreak'),
                'slug'               => 'templatera',
                'source'             => 'templatera.zip',
                'required'           => true,
            ),
        );
        tgmpa( $plugins, $config );
    }
}