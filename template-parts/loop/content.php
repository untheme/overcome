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

<div <?php post_class('ef5-list'); ?>>
    <?php unbreak_post_media(['thumbnail_size' => 'large', 'default_thumb' => false]); ?>
    <?php 
        unbreak_post_header(['class' => 'loop', 'after_args' => ['show_cat' => false]]);
        unbreak_post_excerpt();
        unbreak_link_pages();
    ?>
    <footer class="ef5-loop-footer ef5-post-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('unbreak_loop_footer');
        unbreak_tagged_in(['class' => 'col-auto']);
        unbreak_post_share(['class' => 'col-auto','show_title' => false, 'social_args' => ['class' => 'shape-circle colored-hover outline']]);
    ?></footer>
    <?php unbreak_post_read_more(['readmore_style' => 'btn-pri']); ?>
</div>