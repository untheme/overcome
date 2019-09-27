<?php
/**
 * Template part for displaying posts in loop
 *
 * @package UnBreak
 * @subpackage UnBreak
 */
?>

<div <?php post_class('related-item'); ?>>
    <?php 
        unbreak_post_media();
        unbreak_post_header(['heading_tag' => 'h3'])
    ?>
</div>