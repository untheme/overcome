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
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return overcome_wc_thumbnail_value('image_size_thumbnail');
} ); 

/* Single Thumbnail Size */
add_filter( 'woocommerce_get_image_size_single', function( $size ) {
    return overcome_wc_thumbnail_value('image_size_single');
} );
/* Gallery Thumbnail Size */
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return overcome_wc_thumbnail_value('wc_gallery_thumbnail');
} );

/**
 * Register an activation hook
 * Do action when active plugin, 
 * need to move it to functions.php file
 */
function woocommerce_activation(){
    do_action( 'woocommerce_default_options' );
}
register_activation_hook( 'woocommerce/woocommerce.php', 'woocommerce_activation' );
function overcome_woocommerce_default_options() {
    update_option( 'woocommerce_single_image_width', overcome_wc_thumbnail_value('image_size_single_width') );
    update_option( 'woocommerce_thumbnail_image_width', overcome_wc_thumbnail_value('thumbnail_image_width') );

    update_option( 'woocommerce_thumbnail_cropping', 'custom' );
    update_option( 'woocommerce_thumbnail_cropping_custom_width', overcome_wc_thumbnail_value('custom_width') );
    update_option( 'woocommerce_thumbnail_cropping_custom_height', overcome_wc_thumbnail_value('custom_height') );
}
//add_action( 'woocommerce_default_options', 'overcome_woocommerce_default_options' );