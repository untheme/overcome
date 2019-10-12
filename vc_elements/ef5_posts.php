<?php
vc_map(array(
    'name'          => 'OverCome Posts',
    'base'          => 'ef5_posts',
    'category'      => esc_html__('OverCome', 'unbreak'),
    'description'   => esc_html__('Display your posts with grid layout', 'unbreak'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'unbreak' ),
                'param_name'  => 'post_type',
                'value'       => ef5systems_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'unbreak' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'unbreak' ),
                'param_name' => 'taxonomies',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories.', 'unbreak' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'unbreak' ),
                'param_name' => 'taxonomies_exclude',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => ef5systems_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'unbreak' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'unbreak' ),
                'description'   => esc_html__( 'number of post to show per page', 'unbreak' ),
                'std'           => '4',
            ),
            vc_map_add_css_animation(),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'unbreak' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'unbreak' ), '//w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','unbreak'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'unbreak'),
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','unbreak'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1'  => get_template_directory_uri().'/vc_elements/layouts/posts-1.png',
                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','unbreak'),
            ),
        ),
        /* Grid settings */
        ef5systems_grid_settings(
            [
                'group'                  => esc_html__('Layouts','unbreak'), 
                'dependency_element'     => 'layout_template', 
                'dependency_value'       => 'value_not_equal_to',
                'dependency_value_value' => ['1']
            ]
        ),
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','unbreak'),
                'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','unbreak'),
                'std'           => '',
                'group'         => esc_html__('Post Meta','unbreak'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show Pagination', 'unbreak' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Post Meta','unbreak')
            )
        ),
        array(
            array(
                'type'       => 'css_editor',
                'heading'    => '',
                'param_name' => 'css',
                'value'      => '',
                'group'      => esc_html__('Design Options','unbreak'),
            )
        )
    )
));

class WPBakeryShortCode_ef5_posts extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
    protected function overcome_posts_wrap_css_class($atts){
        extract($atts);
        /* get value for Design Tab */
        $css_classes = array(
            'ef5-posts',
            'ef5-posts-'.$layout_template,
            'row',
            'justify-content-center',
            vc_shortcode_custom_css_class( $css ),
        );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

        echo trim($css_class);
    }
    protected function overcome_posts_featured_item($atts, $args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);

        $overlay_content = '<div class="overlay ef5-bg-overlay d-block opacity-1 ef5-rounded-10"><div class="overlay-inner center-align w-100 p-30 pl-lg-75 pr-lg-75">';
        $overlay_content .= overcome_post_title(['echo' => false, 'class'=>'text-lg-36 lh-lg-46 text-white pb-15 pb-lg-58']);
        $overlay_content .= overcome_post_excerpt([
            'show_excerpt' => '1', 
            'length'       => '15', 
            'more'         => '',
            'class'        => 'text-white d-none d-md-block',
            'echo'         => false 
        ]);
        $overlay_content .= overcome_tribe_events_info(['echo' => false, 'class'=>'text-white mb-13 pb-15 pb-lg-45']);
        $overlay_content .= get_post_type() === 'tribe_events'?  overcome_post_read_more(['show_readmore' => '1', 'echo' => false, 'title' => esc_html__('View Event','overcome'),'class'=>'ef5-btn ef5-btn-md accent outline']) :  overcome_post_read_more(['show_readmore' => '1', 'echo' => false,'class'=>'ef5-btn ef5-btn-md accent outline']);
        $overlay_content .= '</div></div>';

        $css_class = ['ef5-post-item-featured','col-lg-6', $args['class']];
        ?>
            <div class="<?php echo trim(implode(' ', $css_class));?>">
                <?php 
                    overcome_post_media([
                        'thumbnail_size' => overcome_default_value($atts['thumbnail_size'], '570x570'), 
                        'default_thumb'  => true,
                        'after' => $overlay_content
                    ]);   
                ?>
            </div>
        <?php
    }
}
