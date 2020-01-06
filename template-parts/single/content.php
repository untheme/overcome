<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<div <?php post_class('ef5-single clearfix'); ?>>
    <?php 
        //overcome_post_header(['class' => 'ef5-single-header']);
        overcome_post_media([
            'class' => 'mb-40',
            'img_class' => 'ef5-rounded-10 ef5-overlay-gradient-1',
            'after' => '<div class="single-post-meta row justify-content-between text-white ef5-link-inherit"><div class="col">'.overcome_post_meta([
                'echo'          => false,
                'show_cmt_text' => false
            ]).'</div><div class="col-auto">' . overcome_post_share([
                'class'      => 'text-12 size-small', 
                'echo'       => false,
                'show_title' => false,
                'show_all'   => 'false',
            ]).'</div></div>'
        ]); 
        overcome_post_content(['class' => 'ef5-single-content']);
        overcome_link_pages(['class' => 'ef5-single-page-links']);
    ?>
    <div class="ef5-single-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('overcome_single_post_footer');
        overcome_tagged_in(['class' => 'col-auto']);
        
    ?></div>
</div>