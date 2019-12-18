<?php
/**
 * Page title class for the theme.
 * 
 * @package EF5 Theme
 * @subpackage OverCome
 * @since 1.0.0
 * @author EF5 Team
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title' and 'desc'
 */
function overcome_get_page_titles()
{
    $title = $desc = '';
    // Default titles
    if (!is_archive()) {
        // Posts / page view
        if (is_home()) {

            $page_for_posts = get_option('page_for_posts');
            // Only available if posts page is set.
            if (!is_front_page() && $page_for_posts ) {
                $title = get_the_title($page_for_posts);
                $desc = get_post_meta($page_for_posts, 'page_desc', true);
            } else {
                $title = get_bloginfo('name');
                $desc = get_bloginfo('description');
            }
        }
        // Single page view
        elseif (is_singular()) {
            if(is_singular('tribe_events')){
                global $wp_query;
                while ($wp_query->have_posts() ) {
                    $wp_query->the_post();
                    //var_dump($wp_query->post->ID);
                    $id = $wp_query->post->ID;
                    $title = get_the_title($id);
                    $desc = get_post_meta($id, 'custom_desc', true);
                }
                wp_reset_postdata();
            } else {
                $title = get_post_meta(get_the_ID(), 'custom_title', true);
                if (!$title) {
                    $title = get_the_title();
                }
                $desc = get_post_meta(get_the_ID(), 'custom_desc', true);
            }
        } 
        // 404
        elseif (is_404()) {
            $title = overcome_get_opts('ptitle_404_title', esc_html__('Error 404', 'overcome'));
        } 
        // Search result
        elseif (is_search()) {
            $title = esc_html__('Search results', 'overcome');
            $desc = esc_html__('You searched for:','overcome').' "'. get_search_query(). '" ';
        } 
        // Anything else
        else {
            //die('xx');
            $title = get_the_title();
        }
    } elseif (function_exists('is_shop') && is_shop()){
        $title = get_the_title(get_option('woocommerce_shop_page_id'));
        $desc  = get_the_archive_description();
    } else {
		$title = get_the_archive_title();
		$desc  = get_the_archive_description();
    }
    return array(
        'title' => $title,
        'desc'  => $desc
    );
}