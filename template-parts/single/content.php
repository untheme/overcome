<?php
/**
 * Template part for displaying posts in loop
 *
 * @package UnBreak
 * @subpackage UnBreak
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<div <?php post_class('ef5-single clearfix'); ?>>
    <?php 
        unbreak_post_header();
        unbreak_post_media(); 
        unbreak_post_content();
        unbreak_link_pages();
    ?>
    <footer class="ef5-post-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('unbreak_single_post_footer');
        unbreak_tagged_in();
        unbreak_post_share([
            'show_title'  => false,
            'social_args' => [
                'class' => 'shape-circle outline colored-hover',
                'size'  => '38'
            ]
        ]); 
    ?></footer>
</div>