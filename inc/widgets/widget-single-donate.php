<?php 
defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 *
 * @package EF5 Theme
 * @version 1.0
 */
if(!class_exists('EF5Payments')) return;

add_action('widgets_init', 'overcome_wg_single_donate');
function overcome_wg_single_donate() {
    register_ef5_widget('OverCome_WG_Single_Donate');
}

class OverCome_WG_Single_Donate extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'overcome_wg_single_donate',
            esc_html__( '[OverCome] Single Donate', 'overcome' ),
            array(
                'description' => __( 'Shows donate button single', 'overcome' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => '',
            'thumbnail_size'=> '80x80',
            'layout'        => 1,
            'show_author'   => true,
            'show_date'     => true,
            'show_comments' => true,
            'show_cat'      => false,
        ) );

        if(!in_array(get_post_type(), ef5payments_supported_post_type())){
            return;
        }

        $title = !empty($instance['title']) ? $instance['title'] : get_the_title();
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $layout         = absint($instance['layout']);
        $thumbnail_size = $instance['thumbnail_size'];
        $show_author    = (bool)$instance['show_author'];
        $show_date      = (bool)$instance['show_date'];
        $show_comments  = (bool)$instance['show_comments'];
        $show_cat       = (bool)$instance['show_cat'];

        printf('%s', $args['before_widget']);
            if(!empty($title)) printf('%s', $args['before_title'] . $title . $args['after_title']);
            if ( $show_author || $show_comments || $show_date || $show_cat )
            {
                ob_start();
                if($show_author) overcome_posted_by();
                if($show_date) overcome_posted_on();
                if($show_comments) overcome_comments_popup_link(['show_text'=> true]);
                if($show_cat) overcome_posted_in();
                $post_meta = ob_get_clean();

                if ( $post_meta )
                {
                    printf( '<div class="ef5-meta row gutter-20 justify-content-between">%s</div>', $post_meta );
                }
            }

            printf(
                '<div class="post-list-item transition %s"><div class="row gutters-20">',
                ( has_post_thumbnail() ? 'has-post-thumbnail' : '' )
            );

            
                $thumbnail_url = overcome_get_image_url_by_size([
                    'size'          => $thumbnail_size,
                    'default_thumb' => true,
                ]);
                printf(
                    '<div class="ef5-featured col-auto">' .
                        '<a href="%1$s" title="%2$s" class="ef5-thumbnail">' .
                            '<img src="%3$s" alt="%2$s" />' .
                        '</a>' .
                    '</div>',
                    esc_url( get_permalink() ),
                    esc_attr( get_the_title() ),
                    esc_url( $thumbnail_url )
                );

                echo '<div class="ef5-brief col" style="max-width: calc(100% - '.$thumbnail_size[0].'px);">';
                
                
                    if(class_exists('EF5Payments')) {
                        ef5payments_donation_layout_1(['progress_bar' => false, 'show_percent'=>false]);
                    }
                echo '</div>';

            echo '</div></div>';
        printf('%s', $args['after_widget']);
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {
        $instance                   = $old_instance;
        $instance['title']          = sanitize_text_field( $new_instance['title'] );
        $instance['thumbnail_size'] = sanitize_text_field( $new_instance['thumbnail_size'] );
        $instance['layout']         = absint($new_instance['layout']) ;
        $instance['show_author']    = (bool)$new_instance['show_author'] ;
        $instance['show_date']      = (bool)$new_instance['show_date'] ;
        $instance['show_comments']  = (bool)$new_instance['show_comments'];
        $instance['show_cat']       = (bool)$new_instance['show_cat'];
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'          => '',
            'thumbnail_size' => '80x80',
            'layout'         => 1,
            'show_author'    => true,
            'show_date'      => true,
            'show_comments'  => true,
            'show_cat'       => false
        ) );

        $title          = $instance['title'] ? $instance['title']  : '';;
        $thumbnail_size = $instance['thumbnail_size'] ? $instance['thumbnail_size']  : '80x80';
        $layout         = absint($instance['layout']);
        $show_author    = (bool) $instance['show_author'];
        $show_date      = (bool) $instance['show_date'];
        $show_comments  = (bool) $instance['show_comments'];
        $show_cat       = (bool) $instance['show_cat'];

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'overcome' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>"><?php esc_html_e( 'Thumbnail Size', 'overcome' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumbnail_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumbnail_size' ) ); ?>" type="text" value="<?php echo esc_attr( $thumbnail_size ); ?>" />
        </p>
        <p>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                <option value="1" <?php if( $layout == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 1', 'overcome');?></option>
                <option value="2" <?php if( $layout == '2' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 2', 'overcome');?></option>
                <option value="3" <?php if( $layout == '3' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 3', 'overcome');?></option>
            </select>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_author ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php esc_html_e( 'Display post Author?', 'overcome' ); ?></label>
        </p>

        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'overcome' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cat' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_cat' ) ); ?>"><?php esc_html_e( 'Display post Category?', 'overcome' ); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $show_comments ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comments' ) ); ?>" value="1" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_comments' ) ); ?>"><?php esc_html_e( 'Display post comments?', 'overcome' ); ?></label>
        </p>
        <?php
    }
}