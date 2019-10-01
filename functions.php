<?php
/**
 * OverCome functions and definitions
 *
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
*/
if(!function_exists('overcome_configs')){
    function overcome_configs($value){
        $configs = [
            'primary_color'   => '#303030',
            'accent_color'    => '#f5b91b',
            'secondary_color' => '#e6a423',
            'invalid_color'   => 'red',
            'color_red'       => 'red',
            'color_green'     => 'green',
            'white'           => 'white',
            // Typo
            'google_fonts'          => 'Poppins:400,500,700',
            'body_bg'               => '#fff',
            'body_font'             => '\'Poppins\', sans-serif',
            'body_font_size'        => '15px',
            'body_font_size_large'  => '18px',
            'body_font_size_medium' => '16px',
            'body_font_size_small'  => '14px',
            'body_font_size_xsmall' => '13px',
            'body_font_size_xxsmall'=> '12px',
            'body_font_color'       => '#303030',
            'body_line_height'      => '1.6',
            'content_width'         => 1170,
            'h1_size'               => '36px',
            'h2_size'               => '30px',
            'h3_size'               => '22px',
            'h4_size'               => '18px',
            'h5_size'               => '16px',
            'h6_size'               => '14px',
            'heading_font'          => '\'Poppins\', sans-serif',
            'heading_color'         => 'var(--primary-color)',
            'heading_color_hover'   => 'var(--accent-color)',
            'heading_font_weight'   => 700,
            'meta_font'             => '\'Poppins\', sans-serif',    
            'meta_color'            => '#777777',    
            'meta_color_hover'      => 'var(--accent-color)',
            'text-grey'            => '#b0b0b0',
            // Boder
            'main_border'           => '1px solid #DDDDDD', 
            'main_border2'          => '2px solid #DDDDDD', 
            'main_border_color'     => '#DDDDDD', 
            // Thumbnail Size
            'large_size_w'                   => 770,
            'large_size_h'                   => 353,
            'medium_size_w'                  => 370,
            'medium_size_h'                  => 250,
            'thumbnail_size_w'               => 86,
            'thumbnail_size_h'               => 80,
            'post_thumbnail_size_w'          => 1170,
            'post_thumbnail_size_h'          => 500,
            'overcome_default_post_thumbnail' => true,
            'overcome_thumbnail_is_bg'        => true,
            // Header 
            'logo_width'       => '192',
            'logo_height'      => '38',
            'logo_units'       => 'px',
            'main_menu_height' => '100px',
            'header_sidewidth' => '320px',
            'dropdown_bg'      => 'rgba(#000000, 1)',
            'dropdown_regular' => '#c0c0c0',
            'dropdown_hover'   => 'var(--accent-color)',
            'dropdown_active'  => 'var(--accent-color)',
            // Comments 
            'cmt_avatar_size'  => 100,
            'cmt_border'       => '1px solid #DDDDDD',
            // WooCommerce,
            'overcome_product_single_image_w' => '455',
            'overcome_product_single_image_h' => '605',

            'overcome_product_loop_image_w' => '205',
            'overcome_product_loop_image_h' => '162',

            'overcome_product_gallery_thumbnail_w' => '115',
            'overcome_product_gallery_thumbnail_h' => '140',

            'overcome_product_gallery_thumbnail_v_w' => '115',
            'overcome_product_gallery_thumbnail_v_h' => '140',

            'overcome_product_gallery_thumbnail_h_w' => '115',
            'overcome_product_gallery_thumbnail_h_h' => '140',

            'overcome_product_gallery_thumbnail_space' => '14',

            // API 
            'google_api_key' => apply_filters('ef5systems-google-api-key', false)

        ];
        return $configs[$value];
    }
}
function overcome_relative_path(){
    if(is_ssl())
        return 'https://';
    else 
        return 'http://';
}
if (!function_exists('overcome_setup')) {
    function overcome_setup()
    {
        // Make theme available for translation.
        load_theme_textdomain('overcome', get_template_directory() . '/languages');

        // Custom Header
        add_theme_support("custom-header");

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');
        
        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails'); 
        set_post_thumbnail_size(overcome_configs('post_thumbnail_size_w'), overcome_configs('post_thumbnail_size_h'), 1);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'ef5-primary'     => esc_html__('Primary Menu', 'overcome'),
            'ef5-menu-icon'   => esc_html__('Menu with Icon', 'overcome')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('overcome_custom_background_args', array(
            'default-color' => '#ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'width'       => overcome_configs('logo_width'),
            'height'      => overcome_configs('logo_height'),
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
            'audio',
            'quote',
            'link',
            'image'
        ));

        /* WooCommerce */
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');    
        /*
         * Add style for editor
        */
        overcome_require_folder( '/inc/editor',get_template_directory());
        /**
         * Load custom font icon
        */
        overcome_require_folder( '/assets/icon_fonts',get_template_directory());
    }
    add_action('after_setup_theme', 'overcome_setup');
}

function overcome_update(){
    /* Change default image thumbnail sizes in wordpress */
    $thumbnail_size = array(
        'large_size_w'        => overcome_configs('large_size_w'),
        'large_size_h'        => overcome_configs('large_size_h'),
        'large_crop'          => 1, 
        'medium_size_w'       => overcome_configs('medium_size_w'),
        'medium_size_h'       => overcome_configs('medium_size_h'),
        'medium_crop'         => 1, 
        'thumbnail_size_w'    => overcome_configs('thumbnail_size_w'),
        'thumbnail_size_h'    => overcome_configs('thumbnail_size_h'),
        'thumbnail_crop'      => 1,
    );
    foreach ($thumbnail_size as $option => $value) {
        if (get_option($option, '') != $value)
            update_option($option, $value);
    }
}
add_action('after_switch_theme', 'overcome_update');

/* add editor styles */
function overcome_editor_styles()
{
    add_editor_style('assets/admin/css/editor.css');
}
add_action('admin_init', 'overcome_editor_styles');

/* add admin styles */
function overcome_admin_style()
{
    wp_enqueue_style('overcome', get_template_directory_uri() . '/assets/admin/css/admin.css');
}
add_action('admin_enqueue_scripts', 'overcome_admin_style');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width))
    $content_width = apply_filters('overcome_content_width', 1170);
function overcome_content_width()
{
    $GLOBALS['content_width'] = apply_filters('overcome_content_width', 1170);
}
add_action('after_setup_theme', 'overcome_content_width', 0);

/**
 * Incudes file
 *
*/
if(!function_exists('overcome_require_folder')){
    function overcome_require_folder($foldername,$path)
    {
        $dir = $path . DIRECTORY_SEPARATOR . $foldername;
        if (!is_dir($dir)) {
            return;
        }
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            $patch = $dir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($patch) && strpos($file, ".php") !== false) {
                require_once $patch;
            }
        }
    }
}

/**
 * Register widget area.
 */
function overcome_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Blog Widgets', 'overcome'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Add widgets here to appear below Blog content.', 'overcome'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="ef5-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
    if(class_exists('EF5Systems')){
        register_sidebar(array(
            'name'          => esc_html__('Hidden Navigation Menu', 'overcome'),
            'id'            => 'sidebar-nav',
            'description'   => esc_html__('Add widgets here to appear when click on Hidden Navigation Icon.', 'overcome'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ef5-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
    }
    if(class_exists('WooCommerce')){
        register_sidebar(array(
            'name'          => esc_html__('Shop Widgets', 'overcome'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Add widgets here to appear in widget area of single product', 'overcome'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="ef5-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
    }
}
add_action('widgets_init', 'overcome_widgets_init');
/**
 * Script Debug
 * Add suffix '.min' to scripts file
 *
*/
if(!function_exists('overcome_script_debug')){
    function overcome_script_debug() {
        $suffix   = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
        $dev_mode = overcome_get_opts('dev_mode', true);
        if(!$dev_mode) $suffix = '.min';
        return apply_filters( 'overcome_get_dev_mode', $suffix );
    }
}
/**
 * Enqueue scripts and styles.
 */
function overcome_scripts()
{
    $min = overcome_script_debug();
    // Comment
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // Custom Options
    $filter_reset = function_exists('ef5systems_uri') ? ef5systems_uri() : '';
    $overcome_ajax_opts = array(
        'ajaxurl'             => admin_url( 'admin-ajax.php' ),
        'primary_color'       => overcome_configs('primary_color'),
        'accent_color'        => overcome_configs('accent_color'),
        'shop_url'            => function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id( 'shop' )) : '',
        'filter_reset'        => ( strpos($filter_reset,'filter_') !== false || strpos($filter_reset,'min_price') !== false || strpos($filter_reset,'max_price') || strpos($filter_reset, 'rating_filter')) ? 'true' : 'false',
        'filter_clear_text'   => esc_html__('Clear All', 'overcome'),
        'is_rtl'              => is_rtl() ? 'true' : 'false'
    );
    // Scripts
    wp_enqueue_script('overcome', get_template_directory_uri() . '/assets/js/theme'.$min.'.js', array('jquery'), '', true);
    wp_localize_script( 'overcome', 'overcome_ajax_opts', $overcome_ajax_opts);
}
add_action('wp_enqueue_scripts', 'overcome_scripts', 0);

function overcome_styles()
{
    $min = overcome_script_debug();
    
    // Theme Style
    wp_enqueue_style('overcome', get_template_directory_uri() . '/assets/css/theme'.$min.'.css', array(), wp_get_theme()->get( 'Version' ) );
    // add CSS Variations
    $overcome_inline_styles = overcome_inline_styles();
    wp_add_inline_style( 'overcome', $overcome_inline_styles );
}
add_action('wp_enqueue_scripts', 'overcome_styles', 0);

function overcome_inline_styles() {
    ob_start();
    $preset_primary_color = overcome_get_opts( 'primary_color', apply_filters('overcome_primary_color', overcome_configs('primary_color')) );
    $preset_accent_color  = overcome_get_opts( 'accent_color', apply_filters('overcome_accent_color', overcome_configs('accent_color')) );
    $preset_secondary_color = overcome_get_opts( 'secondary_color', apply_filters('overcome_secondary_color',overcome_configs('secondary_color') ));
    $main_menu_height = overcome_get_opts( 'main_menu_height', ['height' => overcome_configs('main_menu_height')]);
    // CSS Variable
    printf(':root{--primary-color:%s;}', $preset_primary_color);
    printf(':root{--accent-color:%s;}', $preset_accent_color);
    printf(':root{--secondary-color:%s;}', $preset_secondary_color);
    printf(':root{--main-menu-height:%s;}', $main_menu_height['height']);
    return ob_get_clean();
}

function overcome_google_api_key(){
    $api = overcome_get_theme_opt('google_api_key','');
    return $api;
}
add_filter('ef5-google-api-key','overcome_google_api_key');
/**
 * Remove all Font Awesome from 3rd extension 
 * to use only font-awesome latest from our theme
 * //'font-awesome',
 * //'gglcptch',
*/
add_filter('ef5_remove_styles', 'overcome_remove_styles');
function overcome_remove_styles($styles){
    $_styles = [
        'newsletter'
    ];
    $styles = array_merge($styles, $_styles);
    return $styles;
}


/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
*/
function overcome_fonts_url() {
    $font_url = add_query_arg( 
        'family', 
        urlencode(overcome_configs('google_fonts')), 
        "//fonts.googleapis.com/css"
    );
    return $font_url;
}
function overcome_font_scripts() {
    wp_enqueue_style( 'ef5-fonts', overcome_fonts_url() );
}
add_action( 'wp_enqueue_scripts', 'overcome_font_scripts' );
/**
 * All Theme Function
*/
overcome_require_folder('inc', get_template_directory());
overcome_require_folder('inc/extends', get_template_directory());
overcome_require_folder('inc/classes', get_template_directory());
overcome_require_folder('inc/walker', get_template_directory());
overcome_require_folder('inc/core', get_template_directory());
overcome_require_folder('inc/functions', get_template_directory());
overcome_require_folder('inc/theme-options', get_template_directory());
overcome_require_folder('inc/custom-post', get_template_directory());
overcome_require_folder('inc/icons', get_template_directory());

if(class_exists('EF5Systems_MegaMenu_Walker')){
    overcome_require_folder('inc/mega-menu', get_template_directory());
}

if(function_exists('register_ef5_widget')){
    overcome_require_folder('inc/widgets', get_template_directory());
}

if(class_exists('VC_Manager') && class_exists('EF5Systems')){
    overcome_require_folder('vc_extends', get_template_directory());
    add_action('vc_after_init', 'overcome_vc_after_init');
    function overcome_vc_after_init(){ 
        overcome_require_folder('vc_elements', get_template_directory());
    }
}

if(class_exists('WooCommerce')){
    overcome_require_folder('inc/woo', get_template_directory());
}
/**
 * Custom Extensions
 * Custom some extension used in theme
 *
*/
overcome_require_folder('inc/extensions', get_template_directory());