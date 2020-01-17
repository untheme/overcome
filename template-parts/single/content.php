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
        if(has_post_thumbnail() || overcome_config('overcome_default_post_thumbnail')){
            overcome_post_media([
                'class'     => 'mb-40',
                'img_class' => 'ef5-rounded-10 ef5-overlay-gradient-1',
                'after'     => '<div class="single-post-meta row justify-content-between grid-gutters-20 text-white ef5-link-inherit"><div class="col">'.overcome_post_meta([
                    'class'         => 'text-white ef5-link-inherit',
                    'echo'          => false,
                    'show_cmt_text' => false
                ]).'</div><div class="col-12 col-md-auto">' . overcome_post_share([
                    'class'      => 'text-12 size-small', 
                    'echo'       => false,
                    'show_title' => false,
                    'show_all'   => 'false',
                ]).'</div></div>'
            ]);
        }
        overcome_post_content(['class' => 'ef5-single-content']);
        overcome_link_pages(['class' => 'ef5-single-page-links']);
    ?>
    <div class="ef5-single-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('overcome_single_post_footer');
        overcome_tagged_in(['class' => 'col-auto']);
        
    ?></div>
</div>