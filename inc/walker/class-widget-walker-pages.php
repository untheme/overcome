<?php
/**
 * UnBreak_Page_Walker
 *
 * @version 1.0
 * @package UnBreak
 * @since   1.0.2
 *
 */

if ( ! defined( 'ABSPATH' ) )
{
    die();
}
class UnBreak_Page_Walker extends Walker_Page {
	/**
     * Outputs the beginning of the current element in the tree.
     *
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string  $output       Used to append additional content. Passed by reference.
     * @param WP_Post $page         Page data object.
     * @param int     $depth        Optional. Depth of page. Used for padding. Default 0.
     * @param array   $args         Optional. Array of arguments. Default empty array.
     * @param int     $current_page Optional. Page ID. Default 0.
     */
    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        if ( $depth ) {
            $indent = str_repeat( $t, $depth );
        } else {
            $indent = '';
        }
 
        $css_class = array( 'ef5-menu-item', 'ef5-page-item', 'ef5-page-item-' . $page->ID );
 
        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $css_class[] = 'page-item-has-children';
        }
 
        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current-page-ancestor';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'current-page-item';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current-page-parent';
            }
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current-page-parent';
        }
 
        /**
         * Filters the list of CSS classes to include with each page item in the list.
         *
         * @since 2.8.0
         *
         * @see wp_list_pages()
         *
         * @param array   $css_class    An array of CSS classes to be applied
         *                              to each list item.
         * @param WP_Post $page         Page data object.
         * @param int     $depth        Depth of page, used for padding.
         * @param array   $args         An array of arguments.
         * @param int     $current_page ID of the current page.
         */
        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
 
        if ( '' === $page->post_title ) {
            /* translators: %d: ID of a post */
            $page->post_title = sprintf( __( '#%d (no title)', 'unbreak' ), $page->ID );
        }
 
        $args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
        $args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];
 
        $atts = array();
        $atts['href'] = get_permalink( $page->ID );
 
        /**
         * Filters the HTML attributes applied to a page menu item's anchor element.
         *
         * @since 4.8.0
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $href The href attribute.
         * }
         * @param WP_Post $page         Page data object.
         * @param int     $depth        Depth of page, used for padding.
         * @param array   $args         An array of arguments.
         * @param int     $current_page ID of the current page.
         */
        $atts = apply_filters( 'page_menu_link_attributes', $atts, $page, $depth, $args, $current_page );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
 
        $output .= $indent . sprintf(
            '<li class="%s"><a%s>%s<span class="title">%s</span>',
            $css_classes,
            $attributes,
            $args['link_before'],
            /** This filter is documented in wp-includes/post-template.php */
            apply_filters( 'the_title', $page->post_title, $page->ID )
        );
 
        if ( ! empty( $args['show_date'] ) ) {
            if ( 'modified' == $args['show_date'] ) {
                $time = $page->post_modified;
            } else {
                $time = $page->post_date;
            }
 
            $date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
            $output .=  '<span class="date clearfix">'. mysql2date( $date_format, $time ).'</span>';
        }

        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $output .= unbreak_widget_expander();
        }

        $output .= '</a>'.$args['link_after'];
    }
}