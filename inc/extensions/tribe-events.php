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
// Single Event Share 
add_action('tribe_events_single_event_after_the_content', 'overcome_single_event_share');
function overcome_single_event_share(){
	overcome_post_share([
		'show_share' => '1',
		'title'		 => esc_html__('Share:','overcome'),
		'row_class'  => 'justify-content-end'
	]);
}

add_action('tribe_events_single_event_after_the_content', 'overcome_single_event_gallery');
function overcome_single_event_gallery(){
?>
	<div class="ef5-event-galleries ef5-bg-f5f5f5 ef5-rounded-10 p-20">
		<?php 
		overcome_post_gallery([
			'show_media'     => '1',
			'thumbnail_size' => '730x381',
			'show_author'    => '0',
			'owl'            => []
		]);
		?>
	</div>
<?php
}

// Single event booking form
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_booking_form', 10, 1);
function overcome_single_tribe_event_booking_form(){
	$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
	$end_datetime = tribe_get_end_date();
	$end_date = tribe_get_display_end_date( null, false );
	$end_time = tribe_get_end_date( null, false, $time_format );
	?>
	<div class="ef5-tribe-single-meta-block ef5-bg-f5f5f5 ef5-rounded-10 pt-20 pr-30 pl-30 pb-30 mb-30 clearfix">
	    <div class="ef5-heading text-22 font-style-500 mb-25"><?php esc_html_e('Booking Online','overcome'); ?>
	    	<div class="ef5-heading text-15 font-style-400"><?php printf('%s %s - %s', esc_html_e('will be closed until','overcome'), $end_date, $end_time); ?></div>
	    </div>
	    <div class="ef5-tribe-single-book-form pt-30">
	    	<div class="field">
	    		<input class="input" type="text" name="name" placeholder="Name*" required="required" />
	    	</div>
	    	<div class="field">
	    		<input class="input" type="email" name="mail" placeholder="Email*" required="required" />
	    	</div>
	    	<div class="field">
	    		<input class="input" type="text" name="phone" placeholder="Phone number*" required="required" />
	    	</div>
	    	<div class="field">
	    		<textarea class="input" type="textarea" name="message" placeholder="Massage"></textarea>
	    	</div>
	    	<div class="field">
	    		<div class="row align-items-center">
	    			<div class="col-auto"><?php esc_html_e('Booked: 18/100','overcome'); ?></div>
	    			<div class="col text-end"><button type="submit" class="ef5-btn accent fill ef5-btn-md mw-120"><?php esc_html_e('Submit','overcome'); ?></button></div>
	    		</div>
	    	</div>
	    </div>
	</div>
	<?php
}
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_sponsor', 10, 2);
function overcome_single_tribe_event_sponsor(){
	?>
	<div class="ef5-tribe-single-meta-block ef5-bg-f5f5f5 ef5-rounded-10 pt-20 pr-30 pl-30 pb-30 mb-65 clearfix">
	    <div class="ef5-heading text-22 font-style-500 mb-20"><?php esc_html_e('Event Sponsor','overcome'); ?></div>
	    <div class="ef5-tribe-single-sponsor-list">
	    	<div class="row align-items-center justify-content-center grid-gutters-30">
	    		<div class="col-auto">
	    			<img src="<?php echo get_template_directory_uri().'/assets/images/tribe-events/event-sponsor-1.png';?>" alt="sponsor"/>
	    		</div>
	    		<div class="col-auto">
	    			<img src="<?php echo get_template_directory_uri().'/assets/images/tribe-events/event-sponsor-2.png';?>" alt="sponsor"/>
	    		</div>
	    		<div class="col-auto">
	    			<img src="<?php echo get_template_directory_uri().'/assets/images/tribe-events/event-sponsor-3.png';?>" alt="sponsor"/>
	    		</div>
	    		<div class="col-auto">
	    			<img src="<?php echo get_template_directory_uri().'/assets/images/tribe-events/event-sponsor-4.png';?>" alt="sponsor"/>
	    		</div>
	    	</div>
	    </div>
	</div>
	<?php
}

// Single Event Upcoming
add_action('tribe_events_single_meta_after', 'overcome_single_tribe_event_upcoming', 10, 3);
function overcome_single_tribe_event_upcoming(){
	$r = new WP_Query( array(
        'post_type'           => 'tribe_events',
        'posts_per_page'      => '3',
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'post__not_in'		  => (array)get_the_ID()
    ) );
	$thumbnail_size = ['85','85'];
    if ( $r->have_posts() )
    {	
    	echo '<div class="ef5-tribe-single-meta-block mb-65 clearfix">';
	    	echo '<div class="ef5-heading text-22 font-style-500 mb-40">'.esc_html__('Upcoming Events','overcome').'</div>';
	        echo '<div class="posts-list layout-1">';

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
	    echo '</div>';
    } // have_posts
    wp_reset_postdata();
}
// Single Events Tags
add_action('tribe_events_single_meta_after','overcome_single_tribe_event_tags', 10, 4);
function overcome_single_tribe_event_tags(){
	?>
	<div class="ef5-tribe-single-meta-block clearfix">
		<div class="ef5-heading text-22 font-style-500 mb-40"><?php esc_html_e('Tags','overcome');?></div>
		<div class="tagcloud"><?php echo get_the_term_list( get_the_ID(), 'post_tag');?></div>
	</div>
	<?php
}

/**
 * Add meta box
*/
add_action('ef5_post_metabox_register', 'overcome_tribe_event_meta_box');
function overcome_tribe_event_meta_box($metabox){
	if (!$metabox->isset_args('tribe_events')) {
        $metabox->set_args('tribe_events', array(
            'opt_name'     => overcome_get_page_opt_name(),
            'display_name' => esc_html__('OverCome Tribe Event Settings', 'overcome'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'high'
        ));
    }

    $metabox->add_section('tribe_events', array(
        'title'  => esc_html__('Gallery', 'overcome'),
        'desc'   => esc_html__('Add gallery for this event', 'overcome'),
        'icon'   => 'el-icon-picture',
        'fields' => array_merge(
            array(
                array(
	                'id'       => 'post-gallery-lightbox',
	                'type'     => 'switch',
	                'title'    => esc_html__('Lightbox?', 'overcome'),
	                'subtitle' => esc_html__('Enable lightbox for gallery images.', 'overcome'),
	                'default'  => true
	            ),
	            array(
	                'id'          => 'post-gallery-images',
	                'type'        => 'gallery',
	                'title'       => esc_html__('Gallery Images ', 'overcome'),
	                'subtitle'    => esc_html__('Upload images or add from media library.', 'overcome')
	            )
            )
        )
    ));
}

/***
 * Comments
**/
function overcome_tribe_event_comments_args($args=[]){
	$args = wp_parse_args($args, array(
		'walker'      => new OverCome_Tribe_Event_Walker_Comment(),
		'avatar_size' => 35,
		'short_ping'  => true,
		'style'       => 'ol'
	));
	return $args;
}
class OverCome_Tribe_Event_Walker_Comment extends Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$comment_author_link = get_comment_author_link( $comment );
		$comment_author_url  = get_comment_author_url( $comment );
		$comment_author      = get_comment_author( $comment );
		$avatar              = get_avatar( $comment, $args['avatar_size'], '', $comment_author, ['class'=>'cmt-avatar circle'] );
		?>
		<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="row gutters-15">
					<?php if ( 0 != $args['avatar_size'] ) { ?>
					<div class="col-auto">
						<?php 
							if ( empty( $comment_author_url ) ) {
								printf('%s', $avatar);
							} else {
								printf( '<a href="%1$s" rel="external nofollow" class="url">%2$s</a>', esc_url($comment_author_url), $avatar );
							} 
						?>
					</div>
					<?php } ?>
					<div class="col">
						<?php $this->overcome_comment_author_info([], $comment , $comment_author ); ?>
						<div class="comment-metadata pt-5">
							<span class="comment-time meta-color"><?php
									/* translators: 1: comment date, 2: comment time */
									$comment_timestamp = sprintf( __( '%1$s at %2$s', 'overcome' ), get_comment_date( '', $comment ), get_comment_time() );
								echo overcome_html($comment_timestamp); 
							?></span>
							<?php
								comment_reply_link(
									array_merge(
										$args,
										array(
											'add_below' => 'div-comment',
											'depth'     => $depth,
											'max_depth' => $args['max_depth'],
											'before'    => '',
											'after'     => '',
										)
									)
								);
								edit_comment_link(esc_html__('Edit','overcome'));
							?>
						</div>
					</div>
				</div>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'overcome' ); ?></div>
				<?php endif; ?>
				<div class="comment-content pt-10">
					<?php comment_text(); ?>
				</div>
			</div>
		<?php
	}
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
	?>
		<<?php echo esc_html($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:', 'overcome' ); ?> 
				<div class="h5"><?php comment_author_link( $comment ); ?></div>
				<?php if(current_user_can( 'edit_comment', $comment->comment_ID )){ ?>
				<div class="comment-links"><?php 
					echo '<span class="edit-edit"><a href="'.esc_url(get_edit_comment_link()).'" class="edit-link"><span class="edit-icon fa fa-edit"></span>&nbsp;&nbsp;'.esc_html__('Edit','overcome').'</a></span>'; 
				?></div>
				<?php } ?>
			</div>
	<?php
		}

	public function overcome_comment_author_info($args = '', $comment , $comment_author ){
		$args = wp_parse_args($args, [
			'class' => ''
		]);
		$classes = ['author-info', $args['class']];
	?>	
		<div class="<?php echo trim(implode(' ', $classes));?>">
			<?php 
				/*
				 * Using the `check` icon instead of `check_circle`, since we can't add a
				 * fill color to the inner check shape when in circle form.
				*/
				$author_badge = '';
				if ( overcome_is_comment_by_post_author( $comment ) ) {
					/* translators: %s: SVG Icon */
					$author_badge = sprintf( '<span class="post-author-badge">%s</span>', '<span class="far fa-user"></span>' );
				}

				printf(
					/* translators: %s: comment author link */
					esc_html__( '%s', 'overcome' ),
					sprintf( '<div class="author-name h5 text-uppercase">%1$s %2$s</div>',$author_badge, $comment_author )
				);
			?>
		</div>
	<?php
		}
}