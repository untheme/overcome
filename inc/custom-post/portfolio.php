<?php
/**
 * Custom post type Portfolio
 * 
 * This custom make some custom to Portfolio
 *
 */
add_filter('ef5_extra_post_type_portfolio', '__return_true');

add_filter('ef5_extra_post_types', 'unbreak_cpts_portfolio', 10 , 1);
function unbreak_cpts_portfolio($post_types) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', false);
    if($supported_portfolio) {
	    $post_types['ef5_portfolio'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('UnBreak Projects', 'unbreak'),
			'singular_name' => esc_html__('UnBreak Project', 'unbreak'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-portfolio',
				'rewrite'       => array(
					'slug'       => unbreak_get_theme_opt('portfolio_slug','unbreak'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'unbreak_cpts_portfolio_tax', 10 , 1);
function unbreak_cpts_portfolio_tax($taxo) {
	$supported_portfolio = apply_filters('ef5_extra_post_type_portfolio', false);
    if($supported_portfolio) {
	    $taxo['portfolio_cat'] = array(
	        'taxonomy'   => esc_html__('Project Category', 'unbreak'),
	        'taxonomies' => esc_html__('Project Categories', 'unbreak'),
	    );
	    $taxo['portfolio_tag'] = array(
	        'taxonomy'   => esc_html__('Project Tag', 'unbreak'),
	        'taxonomies' => esc_html__('Project Tags', 'unbreak'),
	    );
	}
    return $taxo;
}