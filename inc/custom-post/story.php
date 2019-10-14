<?php
/**
 * Custom post type Story
 * 
 * This custom make some custom to Story
 *
 */
add_filter('ef5_extra_post_type_stories', '__return_true');

add_filter('ef5_extra_post_types', 'overcome_cpts_stories', 10 , 1);
function overcome_cpts_stories($post_types) {
	$supported_stories = apply_filters('ef5_extra_post_type_stories', false);
    if($supported_stories) {
	    $post_types['ef5_stories'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('OverCome Stories', 'overcome'),
			'singular_name' => esc_html__('OverCome Story', 'overcome'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-universal-access-alt',
				'rewrite'       => array(
					'slug'       => overcome_get_theme_opt('stories_slug','ef5_stories'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'overcome_cpts_stories_tax', 10 , 1);
function overcome_cpts_stories_tax($taxo) {
	$supported_stories = apply_filters('ef5_extra_post_type_stories', false);
    if($supported_stories) {
	    $taxo['stories_cat'] = array(
	    	'status'     => true,
    		'post_type'  => array('ef5_stories'),
	        'taxonomy'   => esc_html__('Category', 'overcome'),
	        'taxonomies' => esc_html__('Categories', 'overcome'),
	        'args'       => array(),
        	'labels'     => array()
	    );
	    $taxo['stories_tag'] = array(
	    	'status'     => true,
	    	'post_type'  => array('ef5_stories'),
	        'taxonomy'   => esc_html__('Tag', 'overcome'),
	        'taxonomies' => esc_html__('Tags', 'overcome'),
	        'args'       => array(
	        	'hierarchical' => false,
	        ),
        	'labels'     => array()
	    );
	}
    return $taxo;
}

// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_stories');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_stories');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_stories');

function ef5payments_post_type_stories($post_type){
	$post_type[] = 'ef5_stories';
	return $post_type;
}