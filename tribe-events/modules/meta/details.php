<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();

/**
 * Returns a formatted time for a single event
 *
 * @var string Formatted time string
 * @var int Event post id
 */
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );

/**
 * Returns the title of the "Time" section of event details
 *
 * @var string Time title
 * @var int Event post id
 */
$time_title = apply_filters( 'tribe_events_single_event_time_title', __( 'Time:', 'overcome' ), $event_id );

$cost    = tribe_get_formatted_cost();
$website = tribe_get_event_website_link();
?>

<div class="ef5-tribe-single-meta-block ef5-bg-f5f5f5 ef5-rounded-10 mb-30 pt-30 pr-30 pb-25 pl-30 ef5-tribe-events-meta-group ef5-tribe-events-meta-group-details">
	<?php do_action( 'tribe_events_single_meta_details_section_start' ); ?>
	<div class="row">
		<div class="col-auto">
			<div class="ef5-tribe-event-start-date">
				<span class="ef5-tribe-date"><?php overcome_tribe_events_start_date(['format' => 'd']); ?></span>
				<span class="ef5-tribe-month"><?php overcome_tribe_events_start_date(['format' => 'M']); ?></span>
				<span class="ef5-tribe-year"><?php overcome_tribe_events_start_date(['format' => 'Y']); ?></span>
			</div>
		</div>
		<div class="col lh-30 text-13"><?php
			// All day (multiday) events
			if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
				?>
				<div class="ef5-events-all-multiday">
					<div class="row text-13">
						<div class="col-auto ef5-heading text-13"><?php esc_html_e( 'Start:', 'overcome' ) ?></div>
						<div class="col text-end"><?php esc_html_e( $start_date ) ?></div>
					</div>
					<div class="row text-13">
						<div class="col-auto ef5-heading"><?php esc_html_e( 'End:', 'overcome' ) ?></div>
						<div class="col text-end"><?php esc_html_e( $end_date ) ?></div>
					</div>
				</div>
			<?php
			// All day (single day) events
			elseif ( tribe_event_is_all_day() ):
				?>
				<div class="ef5-events-all-day">
					<div class="row text-13">
						<div class="col-auto ef5-heading"><?php esc_html_e( 'Date:', 'overcome' ) ?> </div>
						<div class="col text-end"><?php esc_html_e( $start_date ) ?></div>
					</div>
				</div>

			<?php
			// Multiday events
			elseif ( tribe_event_is_multiday() ) :
				?>
				<div class="ef5-events-multiday">
					<div class="row text-13">
						<div class="col-auto ef5-heading"><?php esc_html_e( 'Start:', 'overcome' ) ?></div>
						<div class="col text-end"><?php esc_html_e( $start_datetime ) ?></div>
					</div>
					<div class="row text-13">
						<div class="col-auto ef5-heading"><?php esc_html_e( 'End:', 'overcome' ) ?></div>
						<div class="col text-end"><?php esc_html_e( $start_datetime ) ?></div>
					</div>
				</div>
			<?php
			// Single day events
			else :
				?>
				<div class="ef5-events-single-day">
					<div class="row text-13">
						<div class="col-auto ef5-heading"><?php echo esc_html( $time_title ); ?></div>
						<div class="col text-end"><?php echo $time_formatted; ?></div>
					</div>
				</div>
			<?php endif ?>

			<?php
			// Event Cost
			if ( ! empty( $cost ) ) : ?>
				<div class="row text-13">
					<div class="col-auto ef5-heading"><?php esc_html_e( 'Cost:', 'overcome' ); ?></div>
					<div class="col text-end"><?php esc_html_e( $cost ); ?></div>
				</div>
			<?php endif;
			echo tribe_get_event_categories(
				get_the_id(), array(
					'before'       => '',
					'sep'          => ', ',
					'after'        => '',
					'label'        => null, // An appropriate plural/singular label will be provided
					'label_before' => '<div class="row text-13"><div class="col-auto ef5-heading">',
					'label_after'  => '</div>',
					'wrap_before'  => '<div class="col text-end">',
					'wrap_after'   => '</div></div>',
				)
			);
		?>
		</div>
	</div>
	<?php
	//Organizer
	$organizer_ids = tribe_get_organizer_ids();
	$organizer_multiple = count( $organizer_ids ) > 1;

	$organizer_phone = tribe_get_organizer_phone();
	$organizer_email = tribe_get_organizer_email();
	$organizer_website = tribe_get_organizer_website_link();
	?>

	<div class="ef5-tribe-events-meta-group-organizer">
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}
			?>
			<div class="row">
				<div class="col-auto ef5-heading"><?php esc_html_e('Organized by: ','overcome'); ?></div>
				<div class="col text-end"><?php echo tribe_get_organizer_link( $organizer ) ?></div>
			</div>
			<?php
		}

		// venues
		if ( tribe_get_venue_id() ) {
			$venue_phone   = tribe_get_phone();
			$venue_website = tribe_get_venue_website_link();
		?>
			<div class="ef5-tribe-single-meta-block tribe-events-meta-group tribe-events-meta-group-venue">
					<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
					<div class="row">
						<div class="col-auto ef5-heading"><?php esc_html_e( 'Venue:', 'overcome' ) ?></div>
						<div class="col text-end"><?php 
							echo tribe_get_venue();
							/* if ( tribe_address_exists() ) : ?>
								<address class="tribe-events-address"><?php 
									echo tribe_get_full_address(); 
									if ( tribe_show_google_map_link() ) echo tribe_get_map_link_html(); 
								?></address>
							<?php endif;
							if ( ! empty( $venue_phone ) ): ?>
							<div class="row">
								<div class="col-auto ef5-heading"><?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?></div>
								<div class="col text-end"><?php echo $venue_phone ?></div>
							</div>
							<?php endif;
							if ( ! empty( $venue_website ) ): ?>
							<div class="row">
								<div class="col-auto ef5-heading"><?php esc_html_e( 'Website:', 'the-events-calendar' ) ?></div>
								<div class="col text-end"><?php echo $venue_website ?></div>
							</div>
							<?php endif; */ ?>
						</div>
					</div>
					<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
			</div>
		<?php }
		if ( ! $organizer_multiple ) { // only show organizer details if there is one
			if ( ! empty( $organizer_phone ) ) {
				?>
				<div class="row">
					<div class="col-auto ef5-heading"><?php esc_html_e( 'Phone:', 'overcome' ) ?></div>
					<div class="col text-end"><?php echo esc_html( $organizer_phone ); ?></div>
				</div>
				<?php
			}//end if

			if ( ! empty( $organizer_email ) ) {
				?>
				<div class="row">
					<div class="col-auto ef5-heading"><?php esc_html_e( 'Email:', 'overcome' ) ?></div>
					<div class="col text-end"><?php echo esc_html( $organizer_email ); ?></div>
				</div>
				<?php
			}//end if

			if ( ! empty( $organizer_website ) ) {
				?>
				<div class="row">
					<div class="col-auto ef5-heading"><?php esc_html_e( 'Website:', 'overcome' ) ?></div>
					<div class="col text-end"><?php echo esc_html( $organizer_website ); ?></div>
				</div>
				<?php
			}//end if
		}//end if

		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
	</div>

	
	<?php
	// Event Website
	if ( ! empty( $website ) ) : ?>
		<div class="row">
			<div class="col-auto ef5-heading"><?php esc_html_e( 'Website:', 'overcome' ) ?></div>
			<div class="col text-end"><?php echo $website; ?></div>
		</div>
	<?php endif ?>

	<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
</div>
