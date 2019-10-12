<?php
/**
 * This required plugin The Events Calendar to work
 * https://wordpress.org/plugins/the-events-calendar/
*/
if(!class_exists('Tribe__Events__Main')) return;

/**
 * Register widget area.
 */
function overcome_tribe_events_widgets()
{
    register_sidebar(array(
        'name'          => esc_html__('Events Widgets', 'overcome'),
        'id'            => 'sidebar-tribe-event',
        'description'   => esc_html__('Add widgets here to appear below Tribe Events content.', 'overcome'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="ef5-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
}
add_action('widgets_init', 'overcome_tribe_events_widgets');

/**
 * Add support payment for post type tribe_event

*/
// Support Payment 
add_filter('ef5payments_post_type_support','ef5payments_post_type_tribe_events');
add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_tribe_events');
add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_tribe_events');

function ef5payments_post_type_tribe_events($post_type){
	$post_type[] = 'tribe_events';
	return $post_type;
}