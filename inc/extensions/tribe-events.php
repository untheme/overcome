<?php
// Remove calendar export link
if(function_exists('tribe')){
    add_action('ef5_tribe_events_middle_nav', array( tribe( 'tec.iCal' ), 'maybe_add_link'));
    // remove 
    function tribe_remove_calendar_export_links() {
        remove_action( 'tribe_events_after_footer', array( tribe( 'tec.iCal' ), 'maybe_add_link' ) );
    }
    add_action( 'init', 'tribe_remove_calendar_export_links' );
}


// Single Events 
add_action('tribe_events_single_meta_after','overcome_single_tribe_event_tags');
function overcome_single_tribe_event_tags(){
	?>
	<div class="clearfix">
		<div class="ef5-heading text-22 font-style-500 mb-40"><?php esc_html_e('Tags','overcome');?></div>
		<div class="tagcloud"><?php echo get_the_term_list( get_the_ID(), 'post_tag');?></div>
	</div>
	<?php
}