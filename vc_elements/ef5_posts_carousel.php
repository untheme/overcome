<?php
vc_map(array(
    'name'          => 'OverCome Posts Carousel',
    'base'          => 'ef5_posts_carousel',
    'category'      => esc_html__('OverCome', 'overcome'),
    'description'   => esc_html__('Display your posts with carousel layout', 'overcome'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'overcome' ),
                'param_name'  => 'post_type',
                'value'       => ef5systems_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'overcome' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'overcome' ),
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
                'description' => esc_html__( 'Enter categories.', 'overcome' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'overcome' ),
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
                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'overcome' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'overcome' ),
                'description'   => esc_html__( 'number of post to show per page', 'overcome' ),
                'std'           => '8',
            ),
            vc_map_add_css_animation(),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'overcome' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'overcome' ), '//w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','overcome'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'overcome'),
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','overcome'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    //'1' => get_template_directory_uri().'/vc_elements/layouts/post-1.png',
                    '2' => get_template_directory_uri().'/vc_elements/layouts/post-2.png',
                    '3' => get_template_directory_uri().'/vc_elements/layouts/post-3.png',
                    '4' => get_template_directory_uri().'/vc_elements/layouts/post-4.png',
                    '10' => get_template_directory_uri().'/vc_elements/layouts/post-10.png',
                ),
                'std'   => '2',
                'group' => esc_html__('Layouts','overcome'),
            ),
        ),
        array(
            array(
                'param_name'  => 'grid_settings',
                'type'        => 'custom_markup',
                'value'       => '<strong>'.esc_html__('Carousel Settings','overcome').'</strong>',
                'std'         => '<strong>'.esc_html__('Carousel Settings','overcome').'</strong>',
                'group'       => esc_html__('Layouts','overcome'),
            )
        ),
        /* Grid settings */
        ef5systems_owl_settings(array(
            'group'      => esc_html__('Layouts','overcome'), 
            'param_name' => 'layout_type', 
            'value'      => 'carousel'
        )),
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','overcome'),
                'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','overcome'),
                'std'           => '',
                'group'         => esc_html__('Post Meta','overcome'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'show_view_all',
                'value'      => array(
                    esc_html__('None','overcome')          => 'none',
                    esc_html__('Select a Page','overcome') => 'page' 
                ),
                'std'        => 'none',
                'heading'    => esc_html__('Show View All','overcome'),
                'group'      => esc_html__('Post Meta','overcome'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'show_view_all_page',
                'value'      => ef5systems_vc_list_page(['default' => false]),
                'std'        => '',
                'dependency'    => array(
                    'element'   => 'show_view_all',
                    'value'     => 'page',
                ),
                'heading'    => esc_html__('Choose a Page for view all!','overcome'),
                'group'      => esc_html__('Post Meta','overcome'),
            ),
            array(
                'type'       => 'textfield',
                'param_name' => 'show_view_all_text',
                'value'      => 'View All',
                'std'        => 'View All',
                'dependency'    => array(
                    'element'            => 'show_view_all',
                    'value_not_equal_to' => 'none',
                ),
                'heading'    => esc_html__('View All Text','overcome'),
                'group'      => esc_html__('Post Meta','overcome'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'view_all_style',
                'value'      => array(
                    esc_html__('Default','overcome') => '',
                ),
                'std'        => '',
                'dependency' => array(
                    'element'            => 'show_view_all',
                    'value_not_equal_to' => 'none',
                ),
                'heading'    => esc_html__('View All Style','overcome'),
                'group'      => esc_html__('Post Meta','overcome'),
            ),
        ),
        array(
            array(
                'type'       => 'css_editor',
                'heading'    => '',
                'param_name' => 'css',
                'value'      => '',
                'group'      => esc_html__('Design Options','overcome'),
            )
        )
    )
));

class WPBakeryShortCode_ef5_posts_carousel extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        $atts['layout_style'] = 'carousel';
        ef5systems_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
    protected function view_all($atts = ''){
        extract($atts);
        if($show_view_all === 'none') return;
        ?>
            <div class="view-all-wrap text-center">
                <a href="<?php echo get_permalink($show_view_all_page);?>" class="ef5-btn ef5-btn-md fill accent <?php echo esc_attr($view_all_style);?>"><?php echo esc_html($show_view_all_text);?></a>
            </div>
        <?php
    }
}
