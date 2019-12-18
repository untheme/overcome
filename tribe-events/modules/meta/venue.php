<?php
/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if ( ! tribe_get_venue_id() ) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();

?>

<div class="ef5-tribe-single-meta-block tribe-events-meta-group tribe-events-meta-group-venue">
		<?php do_action( 'tribe_events_single_meta_venue_section_start' ) ?>
		<div class="row">
			<div class="col-auto"><?php esc_html_e( 'Venue:', 'overcome' ) ?></div>
			<div class="col text-end"><?php 
				echo tribe_get_venue();
				if ( tribe_address_exists() ) : ?>
					<address class="tribe-events-address"><?php 
						echo tribe_get_full_address(); 
						if ( tribe_show_google_map_link() ) echo tribe_get_map_link_html(); 
					?></address>
				<?php endif;
				if ( ! empty( $phone ) ): ?>
				<div class="row">
					<div class="col-auto"><?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?></div>
					<div class="col text-end"><?php echo $phone ?></div>
				</div>
				<?php endif;
				if ( ! empty( $website ) ): ?>
				<div class="row">
					<div class="col-auto"><?php esc_html_e( 'Website:', 'the-events-calendar' ) ?></div>
					<div class="col text-end"><?php echo $website ?></div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php do_action( 'tribe_events_single_meta_venue_section_end' ) ?>
</div>
