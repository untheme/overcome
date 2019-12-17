<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue         = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();
?>
<div class="ef5-tribe-event-day row align-items-center">
	<div class="col-auto">
		<div class="ef5-tribe-thumbnail">
			<?php 
				/**
				 * Event Image
				 * tribe_event_featured_image( null, 'medium' );
				*/
				overcome_post_thumbnail([
					'thumbnail_size' => '500x295',
					'img_class'			 => 'ef5-rounded-10'
				]);
			?>
		</div>
	</div>
	<div class="col">
		<?php 
		/** Event Title */
		do_action( 'tribe_events_before_the_event_title' ) ?>
		<div class="ef5-heading text-22 font-style-600 pb-15">
			<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</div>
		<?php 
			do_action( 'tribe_events_after_the_event_title' );
			do_action( 'tribe_events_before_the_meta' );
			overcome_tribe_events_info_hori(['class' => 'text-13 ef5-text-primary font-style-500']); 
			do_action( 'tribe_events_after_the_meta' );
			do_action( 'tribe_events_before_the_content' ); 
		?>
		<div class="ef5-tribe-desc ef5-text-777777 pt-35">
			<?php echo tribe_events_get_the_excerpt(); ?>
		</div>
		<div class="pt-25 clearfix">
			<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="ef5-btn accent fill ef5-btn-md" rel="bookmark"><?php esc_html_e( 'Find out more', 'overcome' ) ?></a>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ); ?>
	</div>
</div>

