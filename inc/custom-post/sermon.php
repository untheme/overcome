<?php
/**
 * Custom post type Sermon
 * 
 * This custom make some custom to Sermon
 *
 */
add_filter('ef5_extra_post_type_sermons', '__return_true');

add_filter('ef5_extra_post_types', 'overcome_cpts_sermons', 10 , 1);
function overcome_cpts_sermons($post_types) {
	$supported_sermons = apply_filters('ef5_extra_post_type_sermons', false);
    if($supported_sermons) {
	    $post_types['ef5_sermons'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('OverCome Sermons', 'overcome'),
			'singular_name' => esc_html__('OverCome Sermon', 'overcome'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-universal-access-alt',
				'rewrite'       => array(
					'slug'       => overcome_get_theme_opt('sermons_slug','ef5_sermons'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'overcome_cpts_sermons_tax', 10 , 1);
function overcome_cpts_sermons_tax($taxo) {
	$supported_sermons = apply_filters('ef5_extra_post_type_sermons', false);
    if($supported_sermons) {
	    $taxo['sermons_cat'] = array(
	    	'status'     => true,
    		'post_type'  => array('ef5_sermons'),
	        'taxonomy'   => esc_html__('Category', 'overcome'),
	        'taxonomies' => esc_html__('Categories', 'overcome'),
	        'args'       => array(),
        	'labels'     => array()
	    );
	    $taxo['sermons_tag'] = array(
	    	'status'     => true,
	    	'post_type'  => array('ef5_sermons'),
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

/** Support Payment 
	* add_filter('ef5payments_post_type_support','ef5payments_post_type_sermons');
	* add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_sermons');
	* add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_sermons');
*/
add_filter('ef5payments_post_type_support','ef5payments_post_type_sermons');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_sermons');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_sermons');
function ef5payments_post_type_sermons($post_type){
	$post_type[] = 'ef5_sermons';
	return $post_type;
}

// Elements function
function overcome_sermon_icons($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_sermons') return;

    $args = wp_parse_args($args,[
		'icon_video'    => 'icon-video',
		'icon_audio'    => 'icon-audio',
		'icon_download' => 'icon-download',
		'icon_pdf'      => 'icon-pdf',
		'class'			=> ''
    ]);
}

function overcome_sermon_metas($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_sermons') return;

    $args = wp_parse_args($args,[
		'class'			=> ''
    ]);
    ?>
    <div class="<?php esc_attr_e($args['class']);?>">
    	<div class="sermon-speaker">Speaker:</div>
    	<div class="sermon-date">date:</div>
    	<div class="sermon-location">location:</div>
    </div>
    <?php
}

