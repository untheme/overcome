<?php
/**
 * Custom post type Sermon
 * 
 * This custom make some custom to Sermon
 *
 */
add_filter('ef5_extra_post_type_sermons', '__return_true');

add_filter('ef5_extra_post_types', 'overcome_cpts_sermons', 10 , 1);
function overcome_cpts_sermons($post_types) {
	$supported_sermons = apply_filters('ef5_extra_post_type_sermons', false);
    if($supported_sermons) {
	    $post_types['ef5_sermons'] = array( 
	    	'status'        => true,
			'name'          => esc_html__('OverCome Sermons', 'overcome'),
			'singular_name' => esc_html__('OverCome Sermon', 'overcome'),
			'args'          => array(
				'menu_position' => 15,
				'menu_icon'     => 'dashicons-universal-access-alt',
				'rewrite'       => array(
					'slug'       => overcome_get_theme_opt('sermons_slug','ef5_sermons'), 
					'with_front' => true
	            )
	        ) 
	    );
	}
    return $post_types;
}
add_filter('ef5_extra_taxonomies', 'overcome_cpts_sermons_tax', 10 , 1);
function overcome_cpts_sermons_tax($taxo) {
	$supported_sermons = apply_filters('ef5_extra_post_type_sermons', false);
    if($supported_sermons) {
	    $taxo['sermons_cat'] = array(
	    	'status'     => true,
    		'post_type'  => array('ef5_sermons'),
	        'taxonomy'   => esc_html__('Category', 'overcome'),
	        'taxonomies' => esc_html__('Categories', 'overcome'),
	        'args'       => array(),
        	'labels'     => array()
	    );
	    $taxo['sermons_tag'] = array(
	    	'status'     => true,
	    	'post_type'  => array('ef5_sermons'),
	        'taxonomy'   => esc_html__('Tag', 'overcome'),
	        'taxonomies' => esc_html__('Tags', 'overcome'),
	        'args'       => array(
	        	'hierarchical' => false,
	        ),
        	'labels'     => array()
	    );
	}
    return $taxo;
}

/** 
 * Support Payment 
 * add_filter('ef5payments_post_type_support','ef5payments_post_type_sermons');
 * add_filter('ef5payments_metabox_attach_post_types','ef5payments_post_type_sermons');
 * add_filter('ef5payments_payment_attach_post_types','ef5payments_post_type_sermons');
*/
function ef5payments_post_type_sermons($post_type){
	$post_type[] = 'ef5_sermons';
	return $post_type;
}

// Elements function
function overcome_sermon_icons($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_sermons') return;

    $args = wp_parse_args($args,[
		'icon_video'    => 'icon-video',
		'icon_audio'    => 'icon-audio',
		'icon_download' => 'icon-download',
		'icon_pdf'      => 'icon-pdf',
		'class'			=> ''
    ]);
}

function overcome_sermon_metas($args = []){
    $post_type = get_post_type(get_the_ID());
    if($post_type !== 'ef5_sermons') return;

    $args = wp_parse_args($args,[
		'class'			=> ''
    ]);
    ?>
    <div class="<?php esc_attr_e($args['class']);?>">
    	<div class="sermon-speaker">Speaker:</div>
    	<div class="sermon-date">date:</div>
    	<div class="sermon-location">location:</div>
    </div>
    <?php
}

/**
 * Add meta for sermon
*/
function overcome_sermon_options_register($metabox)
{
    if (!$metabox->isset_args('ef5_sermons')) {
        $metabox->set_args('ef5_sermons', array(
            'opt_name'     => overcome_get_page_opt_name(),
            'display_name' => esc_html__('Sermon Settings', 'overcome'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
        ));
    }
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Speaker', 'overcome'),
        'desc'   => esc_html__('Add Speaker', 'overcome'),
        'icon'   => 'el-icon-home',
        'fields' => array(
            array(
                'id'          => 'sermon_speaker',
                'type'        => 'text',
                'title'       => esc_html__('Speaker', 'overcome'),
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Date', 'overcome'),
        'desc'   => esc_html__('Add Date', 'overcome'),
        'icon'   => 'el-icon-home',
        'fields' => array(
            array(
                'id'          => 'sermon_date',
                'type'        => 'ef5_datetime',
                'title'       => esc_html__('Date only', 'overcome'),
            ),
            array(
                'id'          => 'sermon_date_1',
                'type'        => 'ef5_datetime',
                'title'       => esc_html__('Date & time', 'overcome'),
                'date_format' => 'dd-mm-yy',
                'time_format' => 'hh:mm',
                'show_time'	  => true
            ),
            array(
                'id'          => 'sermon_date_2',
                'type'        => 'ef5_datetime',
                'title'       => esc_html__('Time only', 'overcome'),
                'date_format' => 'dd-mm-yy',
                'time_format' => 'hh:mm',
                'show_date'	  => false,
                'show_time'	  => true
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Location', 'overcome'),
        'desc'   => esc_html__('Add Location', 'overcome'),
        'icon'   => 'el-icon-home',
        'fields' => array(
            array(
                'id'          => 'sermon_location',
                'type'        => 'text',
                'title'       => esc_html__('Location', 'overcome'),
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Video', 'overcome'),
        'desc'   => esc_html__('Add Video', 'overcome'),
        'fields' => array(
            array(
                'id'    => 'sermon_video_url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'overcome' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'overcome' )
            ),

            array(
                'id'             => 'sermon_video_file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'overcome' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'overcome' ), 
                'url'            => true                       
            ),

            array(
                'id'        => 'sermon_video_html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video', 'overcome' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'overcome' )
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Audio', 'overcome'),
        'desc'   => esc_html__('Add Audio', 'overcome'),
        'fields' => array(
            array(
                'id'       => 'sermon_audio_url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL', 'overcome'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','overcome'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'sermon_audio_file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio', 'overcome' ),
                'desc'           => esc_html__( 'Upload or Choose audio file', 'overcome' ),                        
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Gallery', 'overcome'),
        'desc'   => esc_html__('Add Gallery', 'overcome'),
        'fields' => array(
            array(
                'id'          => 'sermon_gallery_images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'overcome'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'overcome')
            )
        )
    ));
    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('Download', 'overcome'),
        'desc'   => esc_html__('Add download file', 'overcome'),
        'fields' => array(
            array(
                'id'       => 'sermon_download',
                'type'     => 'media',
                'title'    => esc_html__('URL', 'overcome'),
            )
        )
    ));

    $metabox->add_section('ef5_sermons', array(
        'title'  => esc_html__('PDF', 'overcome'),
        'desc'   => esc_html__('Add PDF file', 'overcome'),
        'fields' => array(
            array(
                'id'       => 'sermon_pdf',
                'type'     => 'media',
                'library_filter' => array('pdf'),
                'title'    => esc_html__('PDF File', 'overcome')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'overcome_sermon_options_register');