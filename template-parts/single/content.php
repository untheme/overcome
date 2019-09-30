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
    <div class="ef5-post-footer row justify-content-between align-items-center empty-none"><?php 
        do_action('overcome_single_post_footer');
        overcome_tagged_in(['class' => 'col-auto']);
        overcome_post_share(['class' => 'col-auto']); 
    ?></div>
</div>