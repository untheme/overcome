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

<div class="ef5-tribe-events-meta-group ef5-tribe-events-meta-group-details">
	<?php
	do_action( 'tribe_events_single_meta_details_section_start' );

	// All day (multiday) events
	if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
		?>
		<div class="ef5-events-all-multiday">
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Start:', 'overcome' ) ?></div>
				<div class="col text-end"><?php esc_html_e( $start_date ) ?></div>
			</div>
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'End:', 'overcome' ) ?></div>
				<div class="col text-end"><?php esc_html_e( $end_date ) ?></div>
			</div>
		</div>
	<?php
	// All day (single day) events
	elseif ( tribe_event_is_all_day() ):
		?>
		<div class="ef5-events-all-day">
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Date:', 'overcome' ) ?> </div>
				<div class="col text-end"><?php esc_html_e( $start_date ) ?></div>
			</div>
		</div>

	<?php
	// Multiday events
	elseif ( tribe_event_is_multiday() ) :
		?>
		<div class="ef5-events-multiday">
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Start:', 'overcome' ) ?></div>
				<div class="col text-end"><?php esc_html_e( $start_datetime ) ?></div>
			</div>
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'End:', 'overcome' ) ?></div>
				<div class="col text-end"><?php esc_html_e( $start_datetime ) ?></div>
			</div>
		</div>
	<?php
	// Single day events
	else :
		?>

		<dt class="tribe-events-start-date-label"> <?php esc_html_e( 'Date:', 'overcome' ) ?> </dt>
		<dd>
			<abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="<?php esc_attr_e( $start_ts ) ?>"> <?php esc_html_e( $start_date ) ?> </abbr>
		</dd>
		<div class="row">
			<div class="col-auto"><?php echo esc_html( $time_title ); ?></div>
			<div class="col text-end"><?php echo $time_formatted; ?></div>
		</div>
	<?php endif ?>

	<?php
	// Event Cost
	if ( ! empty( $cost ) ) : ?>
		<div class="row">
			<div class="col-auto"><?php esc_html_e( 'Cost:', 'overcome' ); ?></div>
			<div class="col text-end"><?php esc_html_e( $cost ); ?></div>
		</div>
	<?php endif ?>

	<?php
	echo tribe_get_event_categories(
		get_the_id(), array(
			'before'       => '',
			'sep'          => ', ',
			'after'        => '',
			'label'        => null, // An appropriate plural/singular label will be provided
			'label_before' => '<div class="row"><div class="col-auto">',
			'label_after'  => '</div>',
			'wrap_before'  => '<div class="col text-end">',
			'wrap_after'   => '</div></div>',
		)
	);
	?>

	<?php echo tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'overcome' ), tribe_get_event_label_singular() ), ', ', false ) ?>

	<?php
	// Event Website
	if ( ! empty( $website ) ) : ?>
		<div class="row">
			<div class="col-auto"><?php esc_html_e( 'Website:', 'overcome' ) ?></div>
			<div class="col text-end"><?php echo $website; ?></div>
		</div>
	<?php endif ?>

	<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
</div>
