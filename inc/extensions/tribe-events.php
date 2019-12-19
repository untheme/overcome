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

// Single event booking form
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_booking_form', 10, 1);
function overcome_single_tribe_event_booking_form(){
	$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
	$end_datetime = tribe_get_end_date();
	$end_date = tribe_get_display_end_date( null, false );
	$end_time = tribe_get_end_date( null, false, $time_format );
	?>
	<div class="ef5-tribe-single-meta-block ef5-bg-f5f5f5 ef5-rounded-10 p-30 mb-30 clearfix">
	    <div class="ef5-heading text-22 font-style-500 mb-25"><?php esc_html_e('Booking Online','overcome'); ?>
	    	<div class="ef5-heading text-15 font-style-400"><?php printf('%s %s - %s', esc_html_e('will be closed until','overcome'), $end_date, $end_time); ?></div>
	    </div>
	    <div class="ef5-tribe-single-book-form pt-30">
	    	<div class="field">
	    		<input class="input" type="text" name="name" placeholder="Name*" required="required" />
	    	</div>
	    	<div class="field">
	    		<input class="input" type="email" name="mail" placeholder="Email*" required="required" />
	    	</div>
	    	<div class="field">
	    		<input class="input" type="text" name="phone" placeholder="Phone number*" required="required" />
	    	</div>
	    	<div class="field">
	    		<textarea class="input" type="textarea" name="message" placeholder="Massage"></textarea>
	    	</div>
	    	<div class="field">
	    		<div class="row align-items-center">
	    			<div class="col-auto"><?php esc_html_e('Booked: 18/100','overcome'); ?></div>
	    			<div class="col text-end"><button type="submit" class="ef5-btn accent fill ef5-btn-md mw-120"><?php esc_html_e('Submit','overcome'); ?></button></div>
	    		</div>
	    	</div>
	    </div>
	</div>
	<?php
}
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_sponsor', 10, 2);
function overcome_single_tribe_event_sponsor(){
	?>
	<div class="ef5-tribe-single-meta-block ef5-bg-f5f5f5 ef5-rounded-10 p-30 mb-65 clearfix">
	    <div class="ef5-heading text-22 font-style-500 mb-40"><?php esc_html_e('Event Sponsor','overcome'); ?></div>
	    <div class="ef5-tribe-single-book-form">
	    	xxx
	    </div>
	</div>
	<?php
}

// Single Event Upcoming
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_upcoming', 10, 3);
function overcome_single_tribe_event_upcoming(){
	$r = new WP_Query( array(
        'post_type'           => 'tribe_events',
        'posts_per_page'      => '3',
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'post__not_in'		  => (array)get_the_ID()
    ) );
	$thumbnail_size = ['85','85'];
    if ( $r->have_posts() )
    {	
    	echo '<div class="ef5-tribe-single-meta-block mb-65 clearfix">';
	    	echo '<div class="ef5-heading text-22 font-style-500 mb-40">'.esc_html__('Upcoming Events','overcome').'</div>';
	        echo '<div class="posts-list layout-1">';

	        while ( $r->have_posts() )
	        {
	            $r->the_post();

	            printf(
	                '<div class="post-list-item transition %s"><div class="row gutters-20">',
	                ( has_post_thumbnail() ? 'has-post-thumbnail' : '' )
	            );

	            
	            $thumbnail_url = overcome_get_image_url_by_size([
	                'size'          => $thumbnail_size,
	                'default_thumb' => true,
	            ]);
	            printf(
	                '<div class="ef5-featured col-auto">' .
	                    '<a href="%1$s" title="%2$s" class="ef5-thumbnail">' .
	                        '<img src="%3$s" alt="%2$s" />' .
	                    '</a>' .
	                '</div>',
	                esc_url( get_permalink() ),
	                esc_attr( get_the_title() ),
	                esc_url( $thumbnail_url )
	            );

	            echo '<div class="ef5-brief col" style="max-width: calc(100% - '.$thumbnail_size[0].'px);">';

	            printf(
	                '<h4 class="ef5-heading font-style-500 pb-10"><a href="%1$s" title="%2$s">%3$s</a></h4>',
	                esc_url( get_permalink() ),
	                esc_attr( get_the_title() ),
	                get_the_title()
	            );
	            
	            overcome_tribe_events_time([
	                'before' => '<div class="text-15 font-style-500 ef5-text-primary">',
	                'after'  => '</div>'
	            ]);
	            
	            echo '</div>';

	            echo '</div></div>';
	        } // while

	        echo '</div>';
	    echo '</div>';
    } // have_posts
    wp_reset_postdata();
}
// Single Events Tags
add_action('tribe_events_single_meta_after','overcome_single_tribe_event_tags', 10, 4);
function overcome_single_tribe_event_tags(){
	?>
	<div class="ef5-tribe-single-meta-block clearfix">
		<div class="ef5-heading text-22 font-style-500 mb-40"><?php esc_html_e('Tags','overcome');?></div>
		<div class="tagcloud"><?php echo get_the_term_list( get_the_ID(), 'post_tag');?></div>
	</div>
	<?php
}