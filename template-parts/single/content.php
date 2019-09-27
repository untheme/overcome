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
        overcome_post_header();
        overcome_post_media(); 
        overcome_post_content();
        overcome_link_pages();
    ?>
    <footer class="ef5-post-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('overcome_single_post_footer');
        overcome_tagged_in();
        overcome_post_share([
            'show_title'  => false,
            'social_args' => [
                'class' => 'shape-circle outline colored-hover',
                'size'  => '38'
            ]
        ]); 
    ?></footer>
</div>