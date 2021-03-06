<?php
/**
 * Custom post type Service
 * 
 * This custom make some custom to Service
 *
 */
add_filter('ef5_extra_post_type_service', '__return_false');

add_filter('ef5_extra_post_types', 'overcome_cpts_service', 10 , 1);
function overcome_cpts_service($post_types) {
    $supported_service = apply_filters('ef5_extra_post_type_service', false);
    if($supported_service) {
        $post_types['ef5_service'] = array( 
        	'status'        => true,
    		'name'          => esc_html__('OverCome Services', 'overcome'),
    		'singular_name' => esc_html__('OverCome Service', 'overcome'),
    		'args'          => array(
    			'menu_position' => 15,
    			'menu_icon'     => 'dashicons-image-filter',
    			'rewrite'       => array(
    				'slug'       => overcome_get_theme_opt('service_slug','ef5_service'), 
    				'with_front' => true
                )
            ) 
        );
    }
    return $post_types;
}

add_filter('ef5_extra_taxonomies', 'overcome_cpts_service_tax', 10 , 1);
function overcome_cpts_service_tax($taxo) {
    $supported_service = apply_filters('ef5_extra_post_type_service', false);
    if($supported_service){
        $taxo['service_cat'] = array(
        	'status'     => true,
        	'post_type'  => array('ef5_service'), 
            'taxonomy'   => esc_html__('Service Category', 'overcome'),
            'taxonomies' => esc_html__('Service Categories', 'overcome'),
            'args'       => array(),
            'labels'     => array()
        );
        $taxo['service_tag'] = array(
        	'status'     => true,
        	'post_type'  => array('ef5_service'), 
            'taxonomy'   => esc_html__('Service Tag', 'overcome'),
            'taxonomies' => esc_html__('Service Tags', 'overcome'),
            'args'       => array(
                'hierarchical' => false,
            ),
            'labels'     => array()
        );
    }
    return $taxo;
}