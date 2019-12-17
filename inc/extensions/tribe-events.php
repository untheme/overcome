<?php
if(function_exists('tribe')){
    add_action('ef5_tribe_events_middle_nav', array( tribe( 'tec.iCal' ), 'maybe_add_link'));
    // remove 
    function tribe_remove_calendar_export_links() {
        remove_action( 'tribe_events_after_footer', array( tribe( 'tec.iCal' ), 'maybe_add_link' ) );
    }
    add_action( 'init', 'tribe_remove_calendar_export_links' );
}

add_filter('tribe_events_the_previous_month_link', 'overcome_tribe_events_the_previous_month_link');
function overcome_tribe_events_the_previous_month_link($date, $url, $text, $html){
    $html = '<a data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="prev"> ' . $text . ' </a>';
    return $html; 
}