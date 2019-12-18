<?php
if(function_exists('tribe')){
    add_action('ef5_tribe_events_middle_nav', array( tribe( 'tec.iCal' ), 'maybe_add_link'));
    // remove 
    function tribe_remove_calendar_export_links() {
        remove_action( 'tribe_events_after_footer', array( tribe( 'tec.iCal' ), 'maybe_add_link' ) );
    }
    add_action( 'init', 'tribe_remove_calendar_export_links' );
}

//add_filter('tribe_events_the_previous_month_link', 'overcome_tribe_events_the_previous_month_link', 10, 4);
/*function overcome_tribe_events_the_previous_month_link($date, $url, $text, $html){
    $html = '<a data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="prev"> ' . $text . ' </a>';
    return $html; 
}*/


// Single Events 
add_action('tribe_events_single_meta_after','overcome_single_tribe_event_tags');
function overcome_single_tribe_event_tags(){
	echo tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'overcome' ), tribe_get_event_label_singular() ), ', ', false );
}