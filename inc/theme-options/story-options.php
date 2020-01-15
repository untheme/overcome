<?php
function overcome_story_options_register($metabox)
{
    
    if (!$metabox->isset_args('ef5_stories')) {
        $metabox->set_args('ef5_stories', array(
            'opt_name'     => overcome_get_page_opt_name(),
            'display_name' => esc_html__('Stories Settings', 'overcome'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_stories', overcome_footer_opts(['default' => true]));
}
add_action('ef5_post_metabox_register', 'overcome_story_options_register');