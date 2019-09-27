<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package UnBreak
 * @subpackage UnBreak
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <?php unbreak_page_loading(); ?>
    <div id="ef5-page" class="<?php unbreak_page_css_class();?>">
    <?php 
        unbreak_header_top();
        unbreak_header_main(); 
        unbreak_page_title();
    ?>
    <main id="ef5-main" class="ef5-main">
