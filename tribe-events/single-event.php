<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">
	<?php 
	tribe_the_notices();
	while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">
				<div class="col-lg-8 ef5-tribe-event-content">					
					<?php //echo tribe_event_featured_image( $event_id, 'full', false ); 
						overcome_post_thumbnail([
							'thumbnail_size' => 'large',
							'img_class'		 => 'ef5-rounded-10 mb-40'
						]);
					?>
					<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="tribe-events-single-event-description tribe-events-content">
						<?php the_content(); ?>
					</div>
					<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
					<nav class="ef5-single-tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'overcome' ), $events_label_singular ); ?>">
						<ul class="tribe-events-sub-nav">
							<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span></span>'.esc_html__('Prev Event') ) ?></li>
							<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( esc_html__('Next Event').'<span></span>' ) ?></li>
						</ul>
					</nav>
					<div class="xxx">123<?php 
						if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) {comments_template();
						}
					?></div>
				</div>
				<div class="col-lg-4 ef5-tribe-event-meta">
					<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
					<?php tribe_get_template_part( 'modules/meta' ); ?>
					<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
</div>