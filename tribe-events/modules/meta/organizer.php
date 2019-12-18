<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="ef5-tribe-single-meta-block tribe-events-meta-group tribe-events-meta-group-organizer">
	<?php
	do_action( 'tribe_events_single_meta_organizer_section_start' );

	foreach ( $organizer_ids as $organizer ) {
		if ( ! $organizer ) {
			continue;
		}
		?>
		<div class="row">
			<div class="col-auto"><?php esc_html_e('Organized by: ','overcome'); ?></div>
			<div class="col text-end"><?php echo tribe_get_organizer_link( $organizer ) ?></div>
		</div>
		<?php
	}

	if ( ! $multiple ) { // only show organizer details if there is one
		if ( ! empty( $phone ) ) {
			?>
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Phone:', 'overcome' ) ?></div>
				<div class="col text-end"><?php echo esc_html( $phone ); ?></div>
			</div>
			<?php
		}//end if

		if ( ! empty( $email ) ) {
			?>
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Email:', 'overcome' ) ?></div>
				<div class="col text-end"><?php echo esc_html( $email ); ?></div>
			</div>
			<?php
		}//end if

		if ( ! empty( $website ) ) {
			?>
			<div class="row">
				<div class="col-auto"><?php esc_html_e( 'Website:', 'overcome' ) ?></div>
				<div class="col text-end"><?php echo esc_html( $website ); ?></div>
			</div>
			<?php
		}//end if
	}//end if

	do_action( 'tribe_events_single_meta_organizer_section_end' );
	?>
</div>
