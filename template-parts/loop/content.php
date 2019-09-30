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

<div <?php post_class('ef5-list'); ?>>
    <?php overcome_post_media(['thumbnail_size' => 'large', 'default_thumb' => false]); ?>
    <?php 
        overcome_post_header(['class' => 'loop']);
        overcome_post_excerpt();
        overcome_link_pages();
    ?>
    <div class="ef5-loop-footer row justify-content-between align-items-center empty-none">
        <?php do_action('overcome_loop_footer'); ?>
        <div class="col-auto empty-none"><?php overcome_tagged_in();?></div>
        <div class="col-auto empty-none"><?php overcome_post_share(['class' => 'col-auto','show_title' => false, 'social_args' => ['class' => 'shape-circle colored-hover outline']]); ?></div>
    </div>
    <div class="ef5-loop-readmore"><?php overcome_post_read_more(); ?></div>
</div>