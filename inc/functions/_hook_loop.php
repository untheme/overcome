<?php
/**
 * Add category before loop title
*/
add_action('overcome_before_loop_title', function($args = []){
	$args = wp_parse_args($args, [
		'show_cat' => is_single() ? overcome_get_theme_opt( 'post_categories_on', '1' ) : overcome_get_theme_opt( 'archive_categories_on', '1' ), 
		'icon'     => '', 
		'class'    => 'ef5-box-meta', 
		'sep'      => ''
	]); 
	return overcome_posted_in([
		'show_cat' => $args['show_cat'], 
		'icon'     => $args['icon'], 
		'class'    => $args['class'], 
		'sep'      => $args['sep']
	]); 
});

