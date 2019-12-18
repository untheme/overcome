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
	$r = new WP_Query( array(
        'post_type'           => 'tribe_events',
        'posts_per_page'      => '3',
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true
    ) );

    if ( $r->have_posts() )
    {
        echo '<div class="posts-list layout-'.esc_attr($layout).'">';

        while ( $r->have_posts() )
        {
            $r->the_post();

            printf(
                '<div class="post-list-item transition %s"><div class="row gutters-20">',
                ( has_post_thumbnail() ? 'has-post-thumbnail' : '' )
            );

            
            $thumbnail_url = overcome_get_image_url_by_size([
                'size'          => $thumbnail_size,
                'default_thumb' => true,
            ]);
            printf(
                '<div class="ef5-featured col-auto">' .
                    '<a href="%1$s" title="%2$s" class="ef5-thumbnail">' .
                        '<img src="%3$s" alt="%2$s" />' .
                    '</a>' .
                '</div>',
                esc_url( get_permalink() ),
                esc_attr( get_the_title() ),
                esc_url( $thumbnail_url )
            );

            echo '<div class="ef5-brief col" style="max-width: calc(100% - '.$thumbnail_size[0].'px);">';

            printf(
                '<h4 class="ef5-heading font-style-500 pb-10"><a href="%1$s" title="%2$s">%3$s</a></h4>',
                esc_url( get_permalink() ),
                esc_attr( get_the_title() ),
                get_the_title()
            );
            
            overcome_tribe_events_time([
                'before' => '<div class="text-15 font-style-500 ef5-text-primary">',
                'after'  => '</div>'
            ]);
            
            echo '</div>';

            echo '</div></div>';
        } // while

        echo '</div>';
    } // have_posts
    wp_reset_postdata();
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