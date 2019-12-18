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



// Single Event Upcoming
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_upcoming', 10, 1);
function overcome_single_tribe_event_upcoming(){
	//use Tribe__Date_Utils as Dates;
	$query_args = apply_filters(
		'tribe_events_list_widget_query_args',
		[
			'eventDisplay'         => 'list',
			'posts_per_page'       => '3',
			'is_tribe_widget'      => false,
			'post_status'          => 'publish',
			'tribe_render_context' => 'widget',
			'featured'             => false,
			'ends_after'           => '',
		]
	);

	$query = tribe_get_events( $query_args, true );
	var_dump($query);
	$posts = $query->posts;
	var_dump($posts);
// Check if any event posts are found.
if ( $posts ) : ?>

	<ol class="tribe-list-widget">
		<?php
		// Setup the post data for each event.
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			?>
			<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">
				<?php
				if (
					tribe( 'tec.featured_events' )->is_featured( get_the_ID() )
					&& get_post_thumbnail_id( $post )
				) {
					/**
					 * Fire an action before the list widget featured image
					 */
					do_action( 'tribe_events_list_widget_before_the_event_image' );

					/**
					 * Allow the default post thumbnail size to be filtered
					 *
					 * @param $size
					 */
					$thumbnail_size = apply_filters( 'tribe_events_list_widget_thumbnail_size', 'post-thumbnail' );

					/**
					 * Filters whether the featured image link should be added to the Events List Widget
					 *
					 * @since 4.5.13
					 *
					 * @param bool $featured_image_link Whether the featured image link should be added or not
					 */
					$featured_image_link = apply_filters( 'tribe_events_list_widget_featured_image_link', true );
					$post_thumbnail      = get_the_post_thumbnail( null, $thumbnail_size );

					if ( $featured_image_link ) {
						$post_thumbnail = '<a href="' . esc_url( tribe_get_event_link() ) . '">' . $post_thumbnail . '</a>';
					}
					?>
					<div class="tribe-event-image">
						<?php
						// not escaped because it contains markup
						echo $post_thumbnail;
						?>
					</div>
					<?php

					/**
					 * Fire an action after the list widget featured image
					 */
					do_action( 'tribe_events_list_widget_after_the_event_image' );
				}
				?>

				<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
				<!-- Event Title -->
				<h4 class="tribe-event-title">
					<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>

				<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
				<!-- Event Time -->

				<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

				<div class="tribe-event-duration">
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>

				<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
			</li>
		<?php
		endforeach; ?>
	</ol>
	<?php
endif;
}
// Single Events Tags
add_action('tribe_events_single_meta_after','overcome_single_tribe_event_tags', 10, 2);
function overcome_single_tribe_event_tags(){
	?>
	<div class="clearfix">
		<div class="ef5-heading text-22 font-style-500 mb-40"><?php esc_html_e('Tags','overcome');?></div>
		<div class="tagcloud"><?php echo get_the_term_list( get_the_ID(), 'post_tag');?></div>
	</div>
	<?php
}