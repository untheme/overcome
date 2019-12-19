<?php 
if(!function_exists('overcome_wp_list_comments_args')){
	function overcome_wp_list_comments_args($args=[]){
		$args = wp_parse_args($args, array(
			'walker'      => new OverCome_Walker_Comment(),
			'avatar_size' => overcome_get_avatar_size(),
			'short_ping'  => true,
			'style'       => 'ol'
		));
		return $args;
	}
}


if(!function_exists('overcome_comment')){
	function overcome_comment(){
		$show_cmt = overcome_get_opts('show_comment_form', '1');
		if ( '1' === $show_cmt && (comments_open() || get_comments_number()) )
        {
            comments_template();
        }
	}
}

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function overcome_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function overcome_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

if ( ! function_exists( 'overcome_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 */
	function overcome_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<div class="discussion-avatar-list d-flex">';
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<div>%s</div>",
				overcome_get_user_avatar_markup( $id_or_email )
			);
		}
		echo '</div>';
	}
endif;

if ( ! function_exists( 'overcome_get_user_avatar_markup' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 */
	function overcome_get_user_avatar_markup( $id_or_email = null ) {

		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="comment-user-avatar comment-author">%s</div>', get_avatar( $id_or_email, overcome_get_avatar_size() ) );
	}
endif;

// Comment Reply link
//add_filter('comment_reply_link','overcome_comment_reply_link', 10, 4);
function overcome_comment_reply_link($link, $args, $comment, $post){
	if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {
		$link = sprintf( '<a rel="nofollow" class="comment-reply-login" href="%s"><span class="fa fa-reply"></span>&nbsp;&nbsp;%s</a>',
			esc_url( wp_login_url( get_permalink() ) ),
			$args['login_text']
		);
	} else {
		$onclick = sprintf( 'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
			$args['add_below'], $comment->comment_ID, $args['respond_id'], $post->ID
		);

		$link = sprintf( "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
			esc_url( add_query_arg( 'replytocom', $comment->comment_ID, get_permalink( $post->ID ) ) ) . "#" . $args['respond_id'],
			$onclick,
			esc_attr( sprintf( $args['reply_to_text'], $comment->comment_author ) ),
			$args['reply_text']
		);
	}
	
	$link =  $args['before'] . $link . $args['after'];
	return $link;
}

/**
 * Move comment field to above comment text
*/
if(!function_exists('overcome_comment_form_fields')){
	add_filter( 'comment_form_fields', 'overcome_comment_form_fields');
    function overcome_comment_form_fields( $fields ) {
        //author, email, url 
        $fields_first = ['rating','open','author','email','url','close'];
        $fields_resort = [];
        foreach ($fields_first as $key) {
            if(array_key_exists($key,$fields))
                $fields_resort[$key] = $fields[$key];
        }
        foreach ($fields as $key => $value) {
            if(in_array($key,$fields_first))
                continue;
            $fields_resort[$key] = $value;
        }
        return $fields_resort;
    }
}

if(!function_exists('overcome_comment_field_to_bottom')){
	/**
	 * add_filter( 'comment_form_fields', 'overcome_comment_field_to_bottom' ); 
	*/
	function overcome_comment_field_to_bottom( $fields ) {
	    $comment_field = $fields['comment'];
	    unset( $fields['comment'] );
	    $fields['comment'] = $comment_field;
	    return $fields;
	}
}

/*
 * Comment Form Output
 * 
*/
if ( ! function_exists( 'overcome_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function overcome_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
			overcome_comment_form_render(
				array(
					'id_form'		=> 'ef5-respond',
					'title_reply'	=> esc_html__('Write a Comment', 'overcome'),
					'label_submit'  => esc_html__( 'Post Your Comment','overcome' ),
					'class_submit'  => 'btn btn-pri',
					'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><span>%4$s</span></button>',
					'submit_field'  => '<div class="form-submit">%1$s %2$s</div>',
					'format'		=> 'html5'
				)
			);
		}
	}
endif;

/**
 * Comment form fields
 * Default Fields
 *
 * Name, Email, Url, Phone ...
 * 'url' => '<div class="comment-form-url col-12 col-md-4">' .
		'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_attr($url_pladeholder).'" />'.
 	'</div>',
*/
if(!function_exists('overcome_comment_form_default_fields')){
	add_filter('comment_form_default_fields', 'overcome_comment_form_default_fields', 10, 2);
	function overcome_comment_form_default_fields($fields){
		$commenter       = wp_get_current_commenter();
		$req             = get_option( 'require_name_email' );
		$html_req        = ( $req ? " required='required'" : '' );
		$html_req_markup = ( $req ? '*' : '' );
		$html5           = true;
		$name_pladeholder  = esc_html__('Name *','overcome');
		$email_pladeholder = esc_html__('Email *','overcome');
		$url_pladeholder   = esc_html__('Website','overcome');
		
		$fields    = [
			'open'	  		=> 	'<div class="row ef5-form-fields">',
			'author'  		=>	'<div class="comment-form-author col-12 col-md-6">'.
							 		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245"' . $html_req . ' placeholder="'.esc_attr($name_pladeholder).'" />'.
							 	'</div>',
			'email'   		=>	'<div class="comment-form-email col-12 col-md-6">' .
								 	'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $html_req . ' placeholder="'.esc_attr($email_pladeholder).'" />'.
								'</div>',
			'close'	  		=>  '</div>',
		];
		return $fields;
	}
}

/**
 * Comment form fields
 *
 * Comment text
 *
*/
if(!function_exists('overcome_comment_form_defaults')){
	add_filter('comment_form_defaults', 'overcome_comment_form_defaults');
	function overcome_comment_form_defaults($fields){
		$msg_placeholder   = esc_html__( 'Your Comment *', 'overcome' );
		$fields['comment_field'] = '<div class="comment-form-comment">'.
									'<textarea id="comment" name="comment" placeholder="'.esc_attr($msg_placeholder).'" required="required"></textarea>'.
								'</div>';
		$fields['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>';
		return $fields;
	}
}

/***
 * WooCommerce Comment Field
 * 
 * Custom WooCommerce Comment list 
 * 
*/

if(!function_exists('overcome_woocommerce_product_review_list_args')){
	add_filter('woocommerce_product_review_list_args','overcome_woocommerce_product_review_list_args');
	add_filter('woocommerce_review_gravatar_size', 'overcome_get_avatar_size');
	remove_action('woocommerce_review_meta', 'woocommerce_review_display_meta');
	remove_action('woocommerce_review_before_comment_meta','woocommerce_review_display_rating');
	function overcome_woocommerce_product_review_list_args($args){
		$args = array_merge($args, [
			'avatar_size'   => overcome_get_avatar_size(),
			'callback' 		=> 'overcome_woocommerce_comments'
		]);

		return $args;
	}
	function overcome_woocommerce_comments($comment, $args, $depth){
		$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
	?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class('comment'); ?>>
			<div id="comment-<?php comment_ID(); ?>" class="comment-body row">
				<div class="comment-avatar col-12 col-md-auto">
					<div class="row align-items-center">
						<div class="col-auto"><?php
							/**
							 * The woocommerce_review_before hook
							 *
							 * @hooked woocommerce_review_display_gravatar - 10
							 */
							do_action( 'woocommerce_review_before', $comment );
							
						?></div>
						<div class="author-info col">
							<div class="author-name h5">
								<?php echo get_comment_author( $comment ); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="comment-info col">
					<div class="d-flex justify-content-between">
						<div class="author-info">
							<div class="author-name h5">
								<?php echo get_comment_author( $comment ); ?>
							</div>
						</div>
						<div class="">
							<?php woocommerce_review_display_rating(); ?>
						</div>
					</div>
					<?php
						/**
						 * The woocommerce_review_meta hook.
						 *
						 * @hooked woocommerce_review_display_meta - 10
						 * @hooked WC_Structured_Data::generate_review_data() - 20
						 */
						do_action( 'woocommerce_review_meta', $comment );
						/**
						 * The woocommerce_review_before_comment_meta hook.
						 *
						 * @hooked woocommerce_review_display_rating - 10
						 */
						do_action( 'woocommerce_review_before_comment_meta', $comment );
					?>
					<div class="comment-content">
						<?php					
						do_action( 'woocommerce_review_before_comment_text', $comment );

						/**
						 * The woocommerce_review_comment_text hook
						 *
						 * @hooked woocommerce_review_display_comment_text - 10
						 */
						do_action( 'woocommerce_review_comment_text', $comment );

						do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
					</div>
					<div class="comment-metadata">
						<?php
						if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
							echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'overcome' ) . ')</em> ';
						}
						?>
						<span class="comment-time meta-color" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></span>
					</div>
				</div>
			</div>
	<?php
	}
}

/***
 * WooCommerce Comment Field
 * 
 * Custom WooCommerce Comment field 
 * 'url'=> '<div class="comment-form-url col-12 col-md-4">' .
		'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_attr($url_pladeholder).'" />'.
 	'</div>',
*/
if(!function_exists('overcome_woocommerce_product_review_comment_form_args')){
	add_filter('woocommerce_product_review_comment_form_args', 'overcome_woocommerce_product_review_comment_form_args');
	function overcome_woocommerce_product_review_comment_form_args($args){
		$commenter       = wp_get_current_commenter();
		$req             = get_option( 'require_name_email' );
		$html_req        = ( $req ? " required='required'" : '' );
		$html_req_markup = ( $req ? '*' : '' );
		$html5           = true;
		$name_pladeholder  = esc_html__('Name *','overcome');
		$email_pladeholder = esc_html__('Email *','overcome');
		$url_pladeholder   = esc_html__('Website','overcome');
		$msg_placeholder   = esc_html__( 'Your Review *', 'overcome' );

		$args = array_merge($args,[
			'title_reply_before' => '<div class="ef5-heading h3">',
			'title_reply_after'  => '</div>',
			'title_reply'   => have_comments() ? esc_html__( 'Write a Review', 'overcome' ) : esc_html__( 'Be the first to Review', 'overcome' ),
			'label_submit'  => esc_html__( 'Post Your Review', 'overcome' ),
			'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>',
			'comment_field' => '<div class="comment-form-comment">'.
									'<textarea id="comment" name="comment" placeholder="'.esc_attr($msg_placeholder).'" required="required"></textarea>'.
								'</div>',
		]);

		$args['fields'] = [
			'open'	  		=> 	'<div class="row ef5-form-fields">',
			'author'  		=>	'<div class="comment-form-author col-12 col-md-6">'.
							 		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245"' . $html_req . ' placeholder="'.esc_attr($name_pladeholder).'" />'.
							 	'</div>',
			'email'   		=>	'<div class="comment-form-email col-12 col-md-6">' .
								 	'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $html_req . ' placeholder="'.esc_attr($email_pladeholder).'" />'.
								'</div>',
			
			'close'	  		=>  '</div>',
		];
		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$args['fields']['rating'] = '<div class="comment-form-rating"><div class="ef5-heading">' . esc_html__( 'Your rating', 'overcome' ) . '</div><select name="rating" id="rating" required>
				<option value="">' . esc_html__( 'Rate&hellip;', 'overcome' ) . '</option>
				<option value="5">' . esc_html__( 'Perfect', 'overcome' ) . '</option>
				<option value="4">' . esc_html__( 'Good', 'overcome' ) . '</option>
				<option value="3">' . esc_html__( 'Average', 'overcome' ) . '</option>
				<option value="2">' . esc_html__( 'Not that bad', 'overcome' ) . '</option>
				<option value="1">' . esc_html__( 'Very poor', 'overcome' ) . '</option>
			</select></div>';
		}

		return $args;
	}
}
/**
 * Remove re-Captcha when user logged in
 * plugin: Google Captcha (reCAPTCHA) by BestWebSoft
 * https://wordpress.org/plugins/google-captcha/
 *
*/
if(function_exists('gglcptch_commentform_display')){
	add_action ('init', 'overcome_remove_default_gglcptch_commentform_display');
	function overcome_remove_default_gglcptch_commentform_display(){
		remove_action( 'comment_form_after_fields', 'gglcptch_commentform_display');
		remove_action( 'comment_form_logged_in_after', 'gglcptch_commentform_display');
	}

	function overcome_gglcptch_commentform_display($submit_button, $args){
		$submit_before =  '<span class="gglcptch-none d-none">'.gglcptch_commentform_display().'</span>';
		return $submit_before . $submit_button;
	}
	add_filter('comment_form_submit_button', 'overcome_gglcptch_commentform_display', 10, 2);
}

/**
 * Commnent Pagination
 *
 * Loadmore button
 *
*/
/* Comment Pagination */
if(!function_exists('overcome_comment_pagination')){
	function overcome_comment_pagination(){
		paginate_comments_links(['echo' => false]);
	}
}

/* Comment loadmore button */
if(!function_exists('overcome_comment_pagination_loadmore')){
	function overcome_comment_pagination_loadmore(){
		$cpage = get_query_var('cpage') ? get_query_var('cpage') : 1;
		if( $cpage > 1 ) {
			wp_enqueue_script('ef5-comment-loadmore');
			echo '<div class="ef5-comment-loadmore transition ef5-btn fill accent ef5-btn-xlg" data-text="'.esc_attr__('Load More Comments','overcome').'" data-text-loading="'.esc_attr__('Loading...','overcome').'" data-text-complete="'.esc_html__('No More Comments','overcome').'">'.esc_html__('Load More Comments','overcome').'</div>
			<'.'script>
			var ajaxurl = \'' . site_url('wp-admin/admin-ajax.php') . '\',
			    parent_post_id = ' . get_the_ID() . ',
		    	    cpage = ' . $cpage . ';
			</'.'script>';
		}
	} 
}
/* Comment Loadmore button */
if(!function_exists('overcome_comments_loadmore_handler')){
	add_action('wp_ajax_cloadmore', 'overcome_comments_loadmore_handler'); // wp_ajax_{action}
	add_action('wp_ajax_nopriv_cloadmore', 'overcome_comments_loadmore_handler'); // wp_ajax_nopriv_{action}
	function overcome_comments_loadmore_handler(){
		// maybe it isn't the best way to declare global $post variable, but it is simple and works perfectly!
		global $post;
		$post = get_post( $_POST['post_id'] );
		setup_postdata( $post );

		$args = overcome_wp_list_comments_args();
		$args['page']    = $_POST['cpage']; // current comment page
		$args['per_page'] = get_option('comments_per_page');
		// actually we must copy the params from wp_list_comments() used in our theme
		wp_list_comments( $args );
		die; // don't forget this thing if you don't want "0" to be displayed
	}
}


function overcome_comment_form_render( $args = array(), $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
 
    // Exit the function when comments for the post are closed.
    if ( ! comments_open( $post_id ) ) {
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );
 
        return;
    }
 
    $commenter     = wp_get_current_commenter();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
 
    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) ) {
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    }
 
    $req      = get_option( 'require_name_email' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];
 
    $fields = array(
        'author' => sprintf(
            '<p class="comment-form-author">%s %s</p>',
            sprintf(
                '<label for="author">%s%s</label>',
                __( 'Name' ),
                ( $req ? ' <span class="required">*</span>' : '' )
            ),
            sprintf(
                '<input id="author" name="author" type="text" value="%s" size="30" maxlength="245"%s />',
                esc_attr( $commenter['comment_author'] ),
                $html_req
            )
        ),
        'email'  => sprintf(
            '<p class="comment-form-email">%s %s</p>',
            sprintf(
                '<label for="email">%s%s</label>',
                __( 'Email' ),
                ( $req ? ' <span class="required">*</span>' : '' )
            ),
            sprintf(
                '<input id="email" name="email" %s value="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
                ( $html5 ? 'type="email"' : 'type="text"' ),
                esc_attr( $commenter['comment_author_email'] ),
                $html_req
            )
        ),
        'url'    => sprintf(
            '<p class="comment-form-url">%s %s</p>',
            sprintf(
                '<label for="url">%s</label>',
                __( 'Website' )
            ),
            sprintf(
                '<input id="url" name="url" %s value="%s" size="30" maxlength="200" />',
                ( $html5 ? 'type="url"' : 'type="text"' ),
                esc_attr( $commenter['comment_author_url'] )
            )
        ),
    );
 
    if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
        $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
 
        $fields['cookies'] = sprintf(
            '<p class="comment-form-cookies-consent">%s %s</p>',
            sprintf(
                '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
                $consent
            ),
            sprintf(
                '<label for="wp-comment-cookies-consent">%s</label>',
                __( 'Save my name, email, and website in this browser for the next time I comment.' )
            )
        );
 
        // Ensure that the passed fields include cookies consent.
        if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
            $args['fields']['cookies'] = $fields['cookies'];
        }
    }
 
    $required_text = sprintf(
        /* translators: %s: Asterisk symbol (*). */
        ' ' . __( 'Required fields are marked %s' ),
        '<span class="required">*</span>'
    );
 
    /**
     * Filters the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param string[] $fields Array of the default comment fields.
     */
    $fields = apply_filters( 'comment_form_default_fields', $fields );
 
    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => sprintf(
            '<p class="comment-form-comment">%s %s</p>',
            sprintf(
                '<label for="comment">%s</label>',
                _x( 'Comment', 'noun' )
            ),
            '<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>'
        ),
        'must_log_in'          => sprintf(
            '<p class="must-log-in">%s</p>',
            sprintf(
                /* translators: %s: Login URL. */
                __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                /** This filter is documented in wp-includes/link-template.php */
                wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            )
        ),
        'logged_in_as'         => sprintf(
            '<p class="logged-in-as">%s</p>',
            sprintf(
                /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
                __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
                get_edit_user_link(),
                /* translators: %s: User name. */
                esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
                $user_identity,
                /** This filter is documented in wp-includes/link-template.php */
                wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            )
        ),
        'comment_notes_before' => sprintf(
            '<p class="comment-notes">%s%s</p>',
            sprintf(
                '<span id="email-notes">%s</span>',
                __( 'Your email address will not be published.' )
            ),
            ( $req ? $required_text : '' )
        ),
        'comment_notes_after'  => '',
        'action'               => site_url( '/wp-comments-post.php' ),
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form',
        'class_submit'         => 'submit',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Reply' ),
        /* translators: %s: Author of the comment being replied to. */
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        'format'               => 'xhtml',
    );
 
    /**
     * Filters the comment form default arguments.
     *
     * Use {@see 'comment_form_default_fields'} to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
 
    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults, $args );
 
    // Remove aria-describedby from the email field if there's no associated description.
    if ( false === strpos( $args['comment_notes_before'], 'id="email-notes"' ) ) {
        $args['fields']['email'] = str_replace(
            ' aria-describedby="email-notes"',
            '',
            $args['fields']['email']
        );
    }
 
    /**
     * Fires before the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_before' );
    ?>
    <div id="ef5-respond" class="ef5-comment-respond">
        <?php
        echo $args['title_reply_before'];
 
        comment_form_title( $args['title_reply'], $args['title_reply_to'] );
 
        echo $args['cancel_reply_before'];
 
        cancel_comment_reply_link( $args['cancel_reply_link'] );
 
        echo $args['cancel_reply_after'];
 
        echo $args['title_reply_after'];
 
        if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) :
 
            echo $args['must_log_in'];
            /**
             * Fires after the HTML-formatted 'must log in after' message in the comment form.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_must_log_in_after' );
 
        else :
 
            printf(
                '<form action="%s" method="post" id="%s" class="%s"%s>',
                esc_url( $args['action'] ),
                esc_attr( $args['id_form'] ),
                esc_attr( $args['class_form'] ),
                ( $html5 ? ' novalidate' : '' )
            );
 
            /**
             * Fires at the top of the comment form, inside the form tag.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_top' );
 
            if ( is_user_logged_in() ) :
 
                /**
                 * Filters the 'logged in' message for the comment form for display.
                 *
                 * @since 3.0.0
                 *
                 * @param string $args_logged_in The logged-in-as HTML-formatted message.
                 * @param array  $commenter      An array containing the comment author's
                 *                               username, email, and URL.
                 * @param string $user_identity  If the commenter is a registered user,
                 *                               the display name, blank otherwise.
                 */
                echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
 
                /**
                 * Fires after the is_user_logged_in() check in the comment form.
                 *
                 * @since 3.0.0
                 *
                 * @param array  $commenter     An array containing the comment author's
                 *                              username, email, and URL.
                 * @param string $user_identity If the commenter is a registered user,
                 *                              the display name, blank otherwise.
                 */
                do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
 
            else :
 
                echo $args['comment_notes_before'];
 
            endif;
 
            // Prepare an array of all fields, including the textarea.
            $comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];
 
            /**
             * Filters the comment form fields, including the textarea.
             *
             * @since 4.4.0
             *
             * @param array $comment_fields The comment fields.
             */
            $comment_fields = apply_filters( 'comment_form_fields', $comment_fields );
 
            // Get an array of field names, excluding the textarea
            $comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );
 
            // Get the first and the last field name, excluding the textarea
            $first_field = reset( $comment_field_keys );
            $last_field  = end( $comment_field_keys );
 
            foreach ( $comment_fields as $name => $field ) {
 
                if ( 'comment' === $name ) {
 
                    /**
                     * Filters the content of the comment textarea field for display.
                     *
                     * @since 3.0.0
                     *
                     * @param string $args_comment_field The content of the comment textarea field.
                     */
                    echo apply_filters( 'comment_form_field_comment', $field );
 
                    echo $args['comment_notes_after'];
 
                } elseif ( ! is_user_logged_in() ) {
 
                    if ( $first_field === $name ) {
                        /**
                         * Fires before the comment fields in the comment form, excluding the textarea.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_before_fields' );
                    }
 
                    /**
                     * Filters a comment form field for display.
                     *
                     * The dynamic portion of the filter hook, `$name`, refers to the name
                     * of the comment form field. Such as 'author', 'email', or 'url'.
                     *
                     * @since 3.0.0
                     *
                     * @param string $field The HTML-formatted output of the comment form field.
                     */
                    echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
 
                    if ( $last_field === $name ) {
                        /**
                         * Fires after the comment fields in the comment form, excluding the textarea.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_after_fields' );
                    }
                }
            }
 
            $submit_button = sprintf(
                $args['submit_button'],
                esc_attr( $args['name_submit'] ),
                esc_attr( $args['id_submit'] ),
                esc_attr( $args['class_submit'] ),
                esc_attr( $args['label_submit'] )
            );
 
            /**
             * Filters the submit button for the comment form to display.
             *
             * @since 4.2.0
             *
             * @param string $submit_button HTML markup for the submit button.
             * @param array  $args          Arguments passed to comment_form().
             */
            $submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );
 
            $submit_field = sprintf(
                $args['submit_field'],
                $submit_button,
                get_comment_id_fields( $post_id )
            );
 
            /**
             * Filters the submit field for the comment form to display.
             *
             * The submit field includes the submit button, hidden fields for the
             * comment form, and any wrapper markup.
             *
             * @since 4.2.0
             *
             * @param string $submit_field HTML markup for the submit field.
             * @param array  $args         Arguments passed to comment_form().
             */
            echo apply_filters( 'comment_form_submit_field', $submit_field, $args );
 
            /**
             * Fires at the bottom of the comment form, inside the closing </form> tag.
             *
             * @since 1.5.0
             *
             * @param int $post_id The post ID.
             */
            do_action( 'comment_form', $post_id );
 
            echo '</form>';
 
        endif;
        ?>
    </div><!-- #respond -->
    <?php
 
    /**
     * Fires after the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_after' );
}
