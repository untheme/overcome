<?php
/**
 * Product Image Thumbnail Size 
 * @since 1.0
 * @since WC 3.x
 * @author Chinh Duong Manh
 * @source https://docs.woocommerce.com/document/image-sizes-theme-developers/
*/

function overcome_wc_thumbnail_value($value){
    $image_size_single_width  = overcome_configs('overcome_product_single_image_w');
    $image_size_single_height = overcome_configs('overcome_product_single_image_h');

    $thumbnail_image_width  = overcome_configs('overcome_product_loop_image_w');
    $thumbnail_image_height = overcome_configs('overcome_product_loop_image_h');;

    $custom_width  = $thumbnail_image_width;
    $custom_height = $thumbnail_image_height;

    $wc_gallery_thumbnail_w = overcome_configs('overcome_product_gallery_thumbnail_w');
    $wc_gallery_thumbnail_h = overcome_configs('overcome_product_gallery_thumbnail_h');


    $wc_gallery_thumbnail  = array(
        'width'  => $wc_gallery_thumbnail_w,
        'height' => $wc_gallery_thumbnail_h,
        'crop'   => 1,
    );

    $image_size_thumbnail = array(
        'width'  => $custom_width,
        'height' => $custom_height,
        'crop'   => 1,
    );

    $image_size_single = array(
        'width'  => $image_size_single_width,
        'height' => $image_size_single_height,
        'crop'   => 1,
    );
    switch ($value) {
        case 'image_size_single_width':
            return $image_size_single_width;
            break;
        case 'image_size_single_height':
            return $image_size_single_height;
            break;
        case 'thumbnail_image_width':
            return $thumbnail_image_width;
            break;
        case 'thumbnail_image_height':
            return $thumbnail_image_height;
            break;
        case 'custom_width':
            return $custom_width;
            break;
        case 'custom_height':
            return $custom_height;
            break;
        case 'wc_gallery_thumbnail_w':
            return $wc_gallery_thumbnail_w;
            break;
        case 'wc_gallery_thumbnail_h':
            return $wc_gallery_thumbnail_h;
            break;
        case 'wc_gallery_thumbnail':
            return $wc_gallery_thumbnail;
            break;
        case 'image_size_thumbnail':
            return $image_size_thumbnail;
            break;
        case 'image_size_single':
            return $image_size_single;
            break;
    }
}

/* Loop Thumbnail Size */
/*add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return overcome_wc_thumbnail_value('image_size_thumbnail');
} );*/ 

/* Single Thumbnail Size */
/*add_filter( 'woocommerce_get_image_size_single', function( $size ) {
    return overcome_wc_thumbnail_value('image_size_single');
} );*/
/* Gallery Thumbnail Size */
/*add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return overcome_wc_thumbnail_value('wc_gallery_thumbnail');
} );*/

/**
 * Unset image width theme support.
 */
function overcome_modify_wc_theme_support() {
    //global $image_size_single_width, $thumbnail_image_width, $custom_width, $custom_height;
    //$theme_support = get_theme_support( 'woocommerce' );
    //$theme_support = is_array( $theme_support ) ? $theme_support[0] : array();
 
    //unset( $theme_support['single_image_width'], $theme_support['thumbnail_image_width'] );
 
    //remove_theme_support( 'woocommerce' );

    //add_theme_support( 'woocommerce', $theme_support );

    add_option( 'woocommerce_single_image_width', overcome_wc_thumbnail_value('image_size_single_width') );
    add_option( 'woocommerce_thumbnail_image_width', overcome_wc_thumbnail_value('thumbnail_image_width') );

    add_option( 'woocommerce_thumbnail_cropping', 'custom' );
    add_option( 'woocommerce_thumbnail_cropping_custom_width', overcome_wc_thumbnail_value('custom_width') );
    add_option( 'woocommerce_thumbnail_cropping_custom_height', overcome_wc_thumbnail_value('custom_height') );
}
//add_action( 'after_setup_theme', 'overcome_modify_wc_theme_support', 10 );

// Activation
function name_plugin_activation(){
    do_action( 'name_plugin_default_options' );
}
register_activation_hook( __FILE__, 'name_plugin_activation' );


// Set default values here
function name_plugin_default_values(){

    // Form settings
    add_option('name_form_to', 'info@example.com');
    add_option('name_form_subject', 'New');


}
add_action( 'name_plugin_default_options', 'overcome_modify_wc_theme_support' );