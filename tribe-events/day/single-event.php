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
<div class="ef5-tribe-event-day row">
	<div class="col-auto">
		<div class="ef5-tribe-thumbnail">
			<?php 
				/**
				 * Event Image
				 * tribe_event_featured_image( null, 'medium' );
				*/
				overcome_post_thumbnail([
					'thumbnail_size' => '500x295',
					'class'			 => 'ef5-rounded-10'
				]);
			?>
		</div>
	</div>
	<div class="col">
		<?php 
		/** Event Title */
		do_action( 'tribe_events_before_the_event_title' ) ?>
		<h3 class="tribe-events-list-event-title summary">
			<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h3>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>
		<?php do_action( 'tribe_events_before_the_meta' ) ?>
		<div class="tribe-events-event-meta <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">
			<div class="tribe-updated published time-details">
				<?php echo tribe_events_event_schedule_details(); ?>
			</div>
			<?php if ( $venue_details ) : ?>
				<div class="tribe-events-venue-details">
				<?php
					$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
					// These details are already escaped in various ways earlier in the code.
					echo implode( $address_delimiter, $venue_details );

					if ( tribe_show_google_map_link() ) {
						echo tribe_get_map_link_html();
					}
				?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost">
				<span class="ticket-cost"><?php echo tribe_get_cost( null, true ); ?></span>
				<?php
				/** This action is documented in the-events-calendar/src/views/list/single-event.php */
				do_action( 'tribe_events_inside_cost' )
				?>
			</div>
		<?php endif; ?>
		<?php do_action( 'tribe_events_after_the_meta' ) ?>
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
			<?php echo tribe_events_get_the_excerpt(); ?>
			<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="ef5-btn accent fill ef5-btn-md" rel="bookmark"><?php esc_html_e( 'Find out more', 'overcome' ) ?></a>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ); ?>
	</div>
</div>

