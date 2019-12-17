<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

add_filter('tribe_events_featured_image_wrap', '__return_false');
?>
<div class="ef5-tribe-list row align-items-center">
	<div class="col-12 col-md-auto">
		<!-- Event Image 
			variable: $post_id = null, $size = 'full', $link = true, $wrapper = true 
		-->
		<div class="ef5-tribe-list-thumb relative">
			<?php //echo tribe_event_featured_image( null, 'medium'); 
				overcome_post_thumbnail([
					'thumbnail_size' => '300x240'
				]);
			?>
			<div class="ef5-tribe-event-start-date">
				<span class="ef5-tribe-date"><?php overcome_tribe_events_start_date(['format' => 'd']); ?></span>
				<span class="ef5-tribe-month"><?php overcome_tribe_events_start_date(['format' => 'M']); ?></span>
				<span class="ef5-tribe-year"><?php overcome_tribe_events_start_date(['format' => 'Y']); ?></span>
			</div>
		</div>
	</div>
	<div class="col">
		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<div class="ef5-heading text-22 lh-28 font-style-600">
			<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</div>
		<?php overcome_tribe_events_info_hori(['show_date' => false]); ?>
		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="ef5-tribe-desc">
			<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
		</div><!-- .tribe-events-list-event-description -->
		<div class="pt-40">
			<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="ef5-btn accent fill ef5-btn-md" rel="bookmark"><?php esc_html_e( 'Find out more', 'overcome' ) ?></a>
		</div>
		<?php
		do_action( 'tribe_events_after_the_content' );
		?>
	</div>
</div>