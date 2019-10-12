<?php
if(!class_exists('Tribe__Events__Main')) return;

/**
 * Add support payment for post type tribe_event

*/
// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_tribe_events');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_tribe_events');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_tribe_events');

function ef5payments_post_type_event($post_type){
	$post_type[] = 'tribe_events';
	return $post_type;
}