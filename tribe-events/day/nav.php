<?php
/**
 * Day View Nav
 * This file contains the day view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<nav class="tribe-events-nav-pagination" aria-label="<?php esc_html_e( 'Day Navigation', 'overcome' ) ?>">
	<ul class="tribe-events-sub-nav">

		<!-- Previous Page Navigation -->
		<li class="tribe-events-nav-previous"><?php tribe_the_day_link( 'previous day' ) ?></li>
		<li class="ef5-tribe-events-nav-export">
			<?php do_action('ef5_tribe_events_middle_nav'); ?>
		</li>
		<!-- Next Page Navigation -->
		<li class="tribe-events-nav-next"><?php tribe_the_day_link( 'next day' ) ?></li>

	</ul>
</nav>