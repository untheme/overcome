<?php
function unbreak_page_options_register($metabox)
{
    
    if (!$metabox->isset_args('page')) {
        $metabox->set_args('page', array(
            'opt_name'     => unbreak_get_page_opt_name(),
            'display_name' => esc_html__('Page Settings', 'unbreak'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    $metabox->add_section('page', array(
        'title'  => esc_html__('General', 'unbreak'),
        'desc'   => esc_html__('General settings for the page.', 'unbreak'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'          => 'primary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Primary Color', 'unbreak'),
                    'transparent' => false,
                ),
                array(
                    'id'          => 'accent_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Accent Color', 'unbreak'),
                    'transparent' => false,
                ),
                array(
                    'id'          => 'secondary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Secondary Color', 'unbreak'),
                    'transparent' => false,
                ),
            ),
            unbreak_page_opts(true),
            unbreak_general_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', unbreak_header_top_opts(['default' => true])); 
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header', 'unbreak'),
        'desc'   => esc_html__('Header settings for the page.', 'unbreak'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            unbreak_header_opts(['default' => true]),
            unbreak_header_atts(true)
        )
    ));
    // Logo 
    $metabox->add_section('page', unbreak_header_page_logo());
    // Ontop Header
    $metabox->add_section('page', unbreak_ontop_header_opts(['default' => true,'subsection' => false]));

    $metabox->add_section('page', array(
        'title'  => esc_html__('Page Title', 'unbreak'),
        'desc'   => esc_html__('Settings for page header area.', 'unbreak'),
        'icon'   => 'el-icon-map-marker',
        'fields' => unbreak_page_title_opts(['default' => true])
    ));

    $metabox->add_section('page', unbreak_footer_opts(['default' => true]));

    /* Config Post Options */
    if (!$metabox->isset_args('post')) {
        $metabox->set_args('post', array(
            'opt_name'     => unbreak_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('post', array(
        'title'  => esc_html__('General', 'unbreak'),
        'desc'   => esc_html__('General settings for this post.', 'unbreak'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'post_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'unbreak'),
                    'subtitle' => esc_html__('select a layout for single...', 'unbreak'),
                    'options'  => array(
                        '-1'     => esc_html__('Default', 'unbreak'),
                        'left'   => esc_html__('Left Widget', 'unbreak'),
                        'right'  => esc_html__('Right Widget', 'unbreak'),
                        'none'   => esc_html__('No Widget (Full)', 'unbreak'),
                        'center' => esc_html__('No Widget (Center)', 'unbreak')
                    ),
                    'default'  => '-1'
                )
            )
        )
    ));
    $metabox->add_section('post', array(
        'title'  => esc_html__('Post Title', 'unbreak'),
        'desc'   => esc_html__('Settings for page header area.', 'unbreak'),
        'icon'   => 'el-icon-map-marker',
        'fields' => unbreak_page_title_opts(['default' => true])
    ));

    /**
     * Config post format meta options
     *
    */
    if (!$metabox->isset_args('ef5_pf_audio')) {
        $metabox->set_args('ef5_pf_audio', array(
            'opt_name'     => 'post_format_audio',
            'display_name' => esc_html__('Audio', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_link')) {
        $metabox->set_args('ef5_pf_link', array(
            'opt_name'     => 'post_format_link',
            'display_name' => esc_html__('Link', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_quote')) {
        $metabox->set_args('ef5_pf_quote', array(
            'opt_name'     => 'post_format_quote',
            'display_name' => esc_html__('Quote', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_video')) {
        $metabox->set_args('ef5_pf_video', array(
            'opt_name'     => 'post_format_video',
            'display_name' => esc_html__('Video', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_gallery')) {
        $metabox->set_args('ef5_pf_gallery', array(
            'opt_name'     => 'post_format_gallery',
            'display_name' => esc_html__('Gallery', 'unbreak'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_pf_video', array(
        'title'  => esc_html__('Video', 'unbreak'),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'unbreak' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'unbreak' )
            ),

            array(
                'id'             => 'post-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'unbreak' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'unbreak' ), 
                'url'            => true                       
            ),

            array(
                'id'        => 'post-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video', 'unbreak' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'unbreak' )
            )
        )
    ));

    $metabox->add_section('ef5_pf_gallery', array(
        'title'  => esc_html__('Gallery', 'unbreak'),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__('Lightbox?', 'unbreak'),
                'subtitle' => esc_html__('Enable lightbox for gallery images.', 'unbreak'),
                'default'  => true
            ),
            array(
                'id'          => 'post-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'unbreak'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'unbreak')
            )
        )
    ));

    $metabox->add_section('ef5_pf_audio', array(
        'title'  => esc_html__('Audio', 'unbreak'),
        'fields' => array(
            array(
                'id'       => 'post-audio-url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL', 'unbreak'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','unbreak'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'post-audio-file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio', 'unbreak' ),
                'desc'           => esc_html__( 'Upload or Choose audio file', 'unbreak' ),                        
            ),
        )
    ));

    $metabox->add_section('ef5_pf_link', array(
        'title'  => esc_html__('Link', 'unbreak'),
        'fields' => array(
            array(
                'id'       => 'post-link-title',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'unbreak'),
            ),
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__('URL', 'unbreak'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ));

    $metabox->add_section('ef5_pf_quote', array(
        'title'  => esc_html__('Quote', 'unbreak'),
        'fields' => array(
            array(
                'id'       => 'post-quote-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Quote Text', 'unbreak')
            ),
            array(
                'id'       => 'post-quote-cite',
                'type'     => 'text',
                'title'    => esc_html__('Cite', 'unbreak')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'unbreak_page_options_register');